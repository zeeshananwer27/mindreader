<?php

namespace App\Http\Controllers\User;
// namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Book\BookRequest;
use App\Http\Requests\User\Book\GenerateSynopsisRequest;
use App\Http\Services\AiService;
use App\Models\AuthorProfile;
use App\Models\Book;
use App\Models\BookMedia;
use App\Models\Chapter;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use setasign\Fpdi\Tcpdf\Fpdi;
use Smalot\PdfParser\Parser;

class BookController extends Controller
{
    protected $user, $subscription, $remainingBooks;

    protected AiService $aiService;


    public function __construct(AiService $aiService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth_user('web');
            $this->subscription = $this->user->runningSubscription;
            $this->remainingBooks = (int)($this->subscription ? $this->subscription->remaining_books : 0);

            return $next($request);
        });
        $this->aiService = $aiService;
    }


    public function dashboard()
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
     * Store a new book
     *
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function store(BookRequest $request): JsonResponse
    {
        // Convert JSON string to PHP array
        $chaptersArray = json_decode($request->chapters, true);
        $book = new Book();
        $book->user_id = auth()->id();
        $book->author_profile_id = $request->author_profile_id;
        $book->about_author = $request->aboutauther;
        $book->genre = $request->genre_id;
        $book->title = $request->title;
        $book->purpose = $request->purpose;
        $book->target_audience = $request->target_audience;
        $book->length = $request->length;
        $book->language = $request->language;
        $book->synopsis = $request->booksynopsis;
        $book->save();

        // Use Eloquent relationships to create chapters in bulk
        $chapters = collect($chaptersArray)->map(function ($chapter) use ($book) {
            return [
                'uid' => uniqid(),
                'title' => $chapter['title'],
                'content' => $chapter['content'],
                'book_id' => $book->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        // Insert all chapters at once
        Chapter::insert($chapters->toArray());

        $bookWithChapters = $book->load('chapters');

        return response()->json([
            'status' => true,
            'message' => 'Book and chapters saved successfully',
            'data' => $bookWithChapters,
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

        $genres = get_genre_list(); // Fetch available genres
        $languages = ['English', 'German']; // Language options

        return view('user.books.create', [
            'meta_data' => $this->metaData(['title' => translate('Create Your Book')]),
            'authorProfiles' => $authorProfiles,
            'genres' => $genres,
            'book_languages' => $languages,
        ]);

    }

    /**
     * Create a new book
     *
     * @return View
     */
    public function recreateExternal(): View
    {
        $user = auth()->user();
        $authorProfiles = $user->authorProfiles()->get(); // Assuming a relation between users and author profiles
        $languages = ['English', 'German']; // Language options

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
        $book = new Book();
        $book->author_profile_id = $request->author_profile_id;
        $book->about_author = $request->aboutauther;
        $book->title = $request->title;
        $book->purpose = $request->change;
        $book->target_audience = $request->target_audience;
        $book->length = $request->length;
        $book->language = $request->language;
        $book->synopsis = $request->booksynopsis;
        $book->save();

        return response()->json([
            'status' => true,
            'message' => 'Book recreated successfully',
            'data' => $book,
        ]);
    }


    /**
     * Create a new book
     *
     * @return View
     */
    public function recreate(Book $book): View
    {
        $user = auth()->user();
        $authorProfiles = $user->authorProfiles()->get(); // Assuming a relation between users and author profiles
        $bookWithChapters = $book->load(['authorProfile', 'chapters']);
        $languages = ['English', 'German']; // Language options

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
     * @param Book $book
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function recreateSave(Book $book, Request $request): JsonResponse
    {
        $book->author_profile_id = $request->author_profile_id;
        $book->about_author = $request->aboutauther;
        $book->title = $request->title;
        $book->purpose = $request->change;
        $book->target_audience = $request->target_audience;
        $book->length = $request->length;
        $book->language = $request->language;
        $book->synopsis = $request->booksynopsis;
        $book->save();

        return response()->json([
            'status' => true,
            'message' => 'Book recreated successfully',
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
     * Show book details
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        $book = Book::with(['chapters', 'authorProfile'])
            ->where('id', $id)
            ->where('user_id', $this->user->id)
            ->firstOrFail();
        return view('user.books.show', [
            'meta_data' => $this->metaData(['title' => translate('Book Details')]),
            'book' => $book,
        ]);
    }

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $book = Book::where('id', $id)->where('user_id', $this->user->id)->firstOrFail();
        $profiles = AuthorProfile::where('user_id', $this->user->id)->get();

        return view('user.book.edit', [
            'meta_data' => $this->metaData(['title' => translate('Edit Book')]),
            'book' => $book,
            'profiles' => $profiles,
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
        $book = Book::where('id', $request->id)->where('user_id', $this->user->id)->firstOrFail();
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
        $book = Book::where('id', $id)->where('user_id', $this->user->id)->firstOrFail();
        $book->delete();

        return back()->with('success', translate('Book deleted successfully.'));
    }

    /**
     * Generate a synopsis for the book.
     *
     * @param GenerateSynopsisRequest $request
     * @return JsonResponse
     */
    public function generateSynopsis(GenerateSynopsisRequest $request): JsonResponse
    {
        if ($request->hasFile('pdf_file')){
            $pdfFile = $request->file('pdf_file');
            $pdfPath = $pdfFile->getPathname();

            try {
                $parser = new Parser();
                $pdf = $parser->parseFile($pdfPath);
                $text = $pdf->getText();

                dd($text);

                return response()->json([
                    'success' => true,
                    'text' => trim($text),
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error extracting text from PDF: ' . $e->getMessage(),
                ], 500);
            }
        }
        $inputData = $request->only([
            'author_profile_id',
            'title',
            'genre_id',
            'purpose',
            'target_audience',
            'length',
            'language'
        ]);

        $author = AuthorProfile::query()->find($inputData['author_profile_id']) ?? null;
        $authorString = $author ? "(Author details:- Name: {$author->name}, Biography: {$author->biography} , Tone: {$author->tone}, Style: {$author->style} )" : "";
        $inputFields['author'] = $authorString;
        $inputFields['genre'] = !empty($inputData['genre_id']) ? get_genre_list()[$inputData['genre_id']] : null;
        $inputFields['title'] = $inputData['title'] ?? null;
        $inputFields['purpose'] = $inputData['purpose'] ?? null;
        $inputFields['targetAudience'] = $inputData['target_audience'] ?? null;
        $inputFields['length'] = $inputData['length'] ?? null;
        $inputFields['language'] = $inputData['language'] ?? null;

        $request['custom'] = $inputFields;

        /*$synopsisTemplate = AiTemplate::query()->find(1);
        try {
            $response = $this->aiService->generatreContent($request, $synopsisTemplate);
            $response['author'] = $authorString;
            // Return the JSON response
            return response()->json(json_decode($response));

        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ]);
        }*/

        // Generate the synopsis
        $data['title'] = $authorString;
        $data['synopsis'] = "This is a generated synopsis for the book titled '" . $inputFields['title'] . "'.";

        // Return the JSON response
        return response()->json([
            'data' => $data,
            'status' => true,
        ]);
    }


    /**
     * Generate an outline for the book.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function generateOutline(Request $request): JsonResponse
    {
        $inputData = $request->only([
            'booksynopsis',
            'aboutauther',
        ]);

        $inputFields['synopsis'] = $inputData['booksynopsis'] ?? null;
        $inputFields['author'] = $inputData['aboutauther'] ?? null;

        $request['custom'] = $inputFields;

        /* $outlineTemplate = AiTemplate::query()->find(2);
         try {
             $response = $this->aiService->generatreContent($request, $outlineTemplate);
             // Return the JSON response
             return response()->json(json_decode($response));

         } catch (Exception $e) {
             return response()->json([
                 "status" => false,
                 "message" => $e->getMessage(),
             ]);
         }*/

        $chapters = [
            ['title' => 'Introduction', 'content' => 'This is the introduction.'],
            ['title' => 'Chapter 1', 'content' => 'This is chapter 1.'],
            ['title' => 'Chapter 2', 'content' => 'This is chapter 2.'],
        ];

        // Return the JSON response
        return response()->json([
            'data' => $chapters,
            'status' => true,
        ]);
    }
}
