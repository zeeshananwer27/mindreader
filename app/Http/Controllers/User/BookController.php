<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Book\BookRequest;
use App\Http\Requests\User\Book\GenerateSynopsisRequest;
use App\Http\Services\User\Book\BookService;
use App\Models\Book;
use App\Models\BookMedia;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Smalot\PdfParser\Parser;

class BookController extends Controller
{
    protected $user, $subscription, $remainingBooks;
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth_user('web');
            $this->subscription = $this->user->runningSubscription;
            $this->remainingBooks = (int)($this->subscription ? $this->subscription->remaining_books : 0);

            return $next($request);
        });
        $this->bookService = $bookService;
    }

    public function dashboard(): View
    {
        $user = auth_user('web');

        // Fetch necessary data
        $totalBooks = Book::where('user_id', $user->id)->count();
        $genresCount = Book::where('user_id', $user->id)->distinct('genre')->count('genre');
        $potentialReaders = User::all()->count(); // Adjust column if necessary
        $bookGalleryCount = BookMedia::whereNotNull('file_path')->count();

        // Fetch paginated books
        $books = Book::where('user_id', $user->id)->paginate(10);

        return view('user.books.dashboard', [
            'total_books' => $totalBooks,
            'genres_count' => $genresCount,
            'potential_readers' => $potentialReaders,
            'book_gallery_count' => $bookGalleryCount,
            'books' => $books,
            'meta_data' => $this->metaData(['title' => translate("AI Books")]),
        ]);
    }

    public function showGallery(): View
    {
        $user = auth_user('web');
        $books = Book::with('authorProfile')->where('user_id', $user->id)->paginate(10);
        return view('user.books.gallery', [
            'books' => $books,
            'meta_data' => $this->metaData(['title' => translate("AI Books")]),
        ]);
    }

    /**
     * Create a new book
     *
     * @return View
     */
    public function create(): View
    {
        $user = auth()->user();
        $authorProfiles = $user->authorProfiles()->get(); // Assuming a relation between users and author profiles

        $genres = get_genre_list();
        $languages = getLanguages();

        return view('user.books.create', [
            'meta_data' => $this->metaData(['title' => translate('Create Your Book')]),
            'authorProfiles' => $authorProfiles,
            'genres' => $genres,
            'book_languages' => $languages,
        ]);
    }

    /**
     * Store a new book
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function store(BookRequest $request): JsonResponse
    {
        $response = $this->bookService->createBook($request);
        return response()->json([
            'status' => true,
            'message' => translate("Book is on his way. Please wait for a moment. Notify you when book is ready."),
            'data' => $response
        ]);
    }

    /**
     * Update book details
     *
     * @param BookRequest $request
     * @return RedirectResponse
     */
    public function update(BookRequest $request): RedirectResponse
    {
        $book = Book::where('uid', $request->uid)->where('user_id', $this->user->id)->firstOrFail();
        $book->update($request->all());

        return redirect()->route('book.manager.list')->with('success', translate('Book updated successfully.'));
    }

    /**
     * Delete a book
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $book = Book::where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();
        $book->delete();

        return back()->with('success', translate('Book deleted successfully.'));
    }

    /**
     * Recreate External book
     *
     * @return View
     */
    public function recreateExternal(): View
    {
        $user = auth()->user();
        $authorProfiles = $user->authorProfiles()->get(); // Assuming a relation between users and author profiles
        $languages = getLanguages();

        return view('user.books.recreate-external', [
            'meta_data' => $this->metaData(['title' => translate('Recreate External Book')]),
            'authorProfiles' => $authorProfiles,
            'book_languages' => $languages,
        ]);
    }

    /**
     * Store a recreated book
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function recreateExternalSave(Request $request): JsonResponse
    {
        $this->bookService->reCreateBook($request, null);

        return response()->json([
            'status' => true,
            'message' => translate("Book recreated successfully from external book"),
        ]);
    }


    /**
     * recreate a book
     *
     * @param $id
     * @return View
     */
    public function recreate($id): View
    {
        $user = auth()->user();
        $bookWithChapters = Book::with(['authorProfile'])->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();
        $authorProfiles = $user->authorProfiles()->get();
        $languages = getLanguages();

        return view('user.books.recreate', [
            'meta_data' => $this->metaData(['title' => translate('Recreate Your Book')]),
            'authorProfiles' => $authorProfiles,
            'book_languages' => $languages,
            'book' => $bookWithChapters,
        ]);
    }

    /**
     * Store a recreated book
     *
     * @param string $id
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function recreateSave(string $id, Request $request): JsonResponse
    {
        $book = Book::query()->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();

        $this->bookService->reCreateBook($request, $book);

        return response()->json([
            'status' => true,
            'message' => translate("Book recreated successfully"),
            'data' => $book,
        ]);
    }

    /**
     * Check remaining book balance
     *
     * @return bool
     */
    public function checkRemainingBooks(): bool
    {
        return ($this->remainingBooks === -1 || $this->remainingBooks > 0);
    }

    /**
     * Generate a synopsis for the book.
     *
     * @param GenerateSynopsisRequest $request
     * @return JsonResponse
     */
    public function generateSynopsis(GenerateSynopsisRequest $request): JsonResponse
    {
        $pdfText = null;
        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
            $pdfPath = $pdfFile->getPathname();

            try {
                $parser = new Parser();
                $pdf = $parser->parseFile($pdfPath);
                $details = $pdf->getDetails();
                $bookTitle = $details['Title'] ?? null;
                // Get all pages
                $pages = $pdf->getPages();
                $text = '';
                for ($i = 0; $i < min(2, count($pages)); $i++) {
                    $text .= $pages[$i]->getText() . "\n\n"; // Append each page's text
                }
                $pdfText = 'Title of book="' . $bookTitle . '" Description of book="' . trim($text) . '"';
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error extracting text from PDF: ' . $e->getMessage(),
                ], 500);
            }
        }

        //filter only required data
        $inputData = $request->only(['author_profile_id', 'title', 'purpose', 'target_audience', 'language']);
        $inputData['pdf_text'] = $pdfText;

        // For Testing remove this when ready for live.
        $data['title'] = 'PHP Programming';
        $data['synopsis'] = '"PHP Programming" is a concise guide aimed at readers looking to transition from Java to PHP. This book serves as a resource for understanding the fundamental differences between the two programming languages and mastering key concepts in PHP. Covering topics such as syntax, data types, functions, and object-oriented programming, "PHP Programming" provides practical examples and exercises to reinforce learning. Whether you are a beginner in PHP or an experienced developer looking to expand your skills, this book is designed to help you make a seamless switch and excel in PHP programming within the Art & Photography industry.';
        $data['author'] = 'Willium is a young and innovative author with a background in data science and technology. He has a passion for using data-driven solutions to solve complex problems and has worked on projects involving machine learning and web development. Despite his busy academic schedule, Willium remains dedicated to his family and is known for his reliability and commitment. He aims to contribute to industries such as production engineering and digital transformation through his innovative data-driven solutions.';
        return response()->json([
            'data' => $data,
            'status' => true,
        ]);
        // For Testing remove this when ready for live.


        // code to get Author Details generated by AI
        $authorData = $this->bookService->getAuthorDetailsByAi($inputData);
        if ($authorData['status']) {
            $data['author'] = $authorData['message'];
        } else {
            return response()->json([
                'message' => $authorData['message'],
                'status' => false,
            ]);
        }

        $data['title'] = $inputData['title'];

        // code to get Synopsis generated by AI
        $synopsisData = $this->bookService->getSynopsisByAi($inputData);
        if ($synopsisData['status']) {
            $data['synopsis'] = $synopsisData['message'];
            return response()->json([
                'data' => $data,
                'status' => true,
            ]);
        } else {
            return response()->json([
                'message' => $synopsisData['message'],
                'status' => false,
            ]);
        }
    }

    /**
     * Generate an outline for the book.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generateOutline(Request $request): JsonResponse
    {
        $inputData['synopsis'] = $request->get('synopsis') ?? null;
        $inputData['author'] = $request->get('about_author') ?? null;
        $inputData['title'] = $request->get('title') ?? "";
        $inputData['language'] = $request->get('language') ?? "English";

        $chapterData = $this->bookService->getBookChapterAndOutlinesByAi($inputData);

        if ($chapterData['status']) {
            return response()->json([
                'data' => $chapterData['message'],
                'status' => true,
            ]);
        } else {
            return response()->json([
                'message' => $chapterData['message'],
                'status' => false,
            ]);
        }
    }
}
