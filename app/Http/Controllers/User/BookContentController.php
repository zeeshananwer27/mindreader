<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\Book\BookService;
use App\Models\Audiobook;
use App\Models\AuthorProfile;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookContentController extends Controller
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

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function details(string $id): View
    {
        $book = Book::with(['chapters.topics', 'authorProfile'])
            ->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();
        $authorProfiles = AuthorProfile::where('user_id', $this->user->id)->get();
        $genres = get_genre_list(); // Fetch available genres
        $languages = ['English', 'German']; // Language options

        return view('user.books.edit.detail', [
            'meta_data' => $this->metaData(['title' => translate('Book Detail')]),
            'book' => $book,
            'authorProfiles' => $authorProfiles,
            'genres' => $genres,
            'book_languages' => $languages,
        ]);
    }

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function synopsis(string $id): View
    {
        $book = Book::with(['chapters.topics'])->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();
        return view('user.books.edit.synopsis', [
            'meta_data' => $this->metaData(['title' => translate('Book Synopsis')]),
            'book' => $book,
        ]);
    }

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function outlines(string $id): View
    {
        $book = Book::with(['chapters.topics'])
            ->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();

        return view('user.books.edit.outlines', [
            'meta_data' => $this->metaData(['title' => translate('Book Detail')]),
            'book' => $book,
        ]);
    }

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function cover(string $id): View
    {
        $book = Book::with(['chapters.topics', 'authorProfile'])
            ->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();
        $authorProfiles = AuthorProfile::where('user_id', $this->user->id)->get();
        $genres = get_genre_list(); // Fetch available genres
        $languages = ['English', 'German']; // Language options

        return view('user.books.edit.cover', [
            'meta_data' => $this->metaData(['title' => translate('Book Detail')]),
            'book' => $book,
            'authorProfiles' => $authorProfiles,
            'genres' => $genres,
            'book_languages' => $languages,
        ]);
    }

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function chapters(string $id, string $chapterId): View
    {
        $book = Book::with(['chapters', 'authorProfile'])
            ->where('uid', $id)
            ->where('user_id', $this->user->id)
            ->firstOrFail();

        $chapter = $book->chapters()
            ->where('uid', $chapterId)
            ->with('topics')
            ->firstOrFail();
        $chapterTopics = $this->convertChapterToEditorJsFormat($chapter->topics);
        $chapter->chapterTopics = $chapterTopics;

        $totalChapters = $book->chapters->count();
        $currentChapterNumber = $book->chapters->search(function ($item) use ($chapter) {
                return $item->uid === $chapter->uid;
            }) + 1;


        $authorProfiles = AuthorProfile::where('user_id', $this->user->id)->get();
        $genres = get_genre_list(); // Fetch available genres
        $languages = ['English', 'German']; // Language options

        return view('user.books.edit.chapter', [
            'meta_data' => $this->metaData(['title' => translate('Book Detail')]),
            'book' => $book,
            'authorProfiles' => $authorProfiles,
            'genres' => $genres,
            'chapter' => $chapter,
            'book_languages' => $languages,
            'currentChapterNumber' => $currentChapterNumber,
            'totalChapters' => $totalChapters
        ]);
    }

    function convertChapterToEditorJsFormat($topics): array
    {
        $sortedTopics = collect($topics)->sortBy('order')->values()->toArray();
        $blocks = [];

        foreach ($sortedTopics as $topic) {
            $block = [
                'type' => $topic['type'], // 'header', 'paragraph', or 'image'
                'data' => [],
                'uid' => $topic['uid'],
                'chapter_id' => $topic['chapter_id'],
                'order' => $topic['order']
            ];

            if ($topic['type'] === 'header') {
                $block['data'] = [
                    'text' => $topic['content']['text'],
                    'level' => $topic['content']['level'] ?? 3 // Default to level 3 if missing
                ];
            } elseif ($topic['type'] === 'paragraph') {
                $block['data'] = [
                    'text' => $topic['content']['text']
                ];
            } elseif ($topic['type'] === 'image') {
                $block['data'] = [
                    'file' => [
                        'url' => $topic['content']['url']
                    ]
                ];
            }

            $blocks[] = $block;
        }

        return [
            'blocks' => $blocks
        ];
    }

    function updateChapterFromEditorJsFormat(array $editorJsResponse): array
    {
        $topics = [];

        foreach ($editorJsResponse['data']['blocks'] as $block) {
            $topic = [
                'type' => $block['type'], // 'header', 'paragraph', or 'image'
                'content' => [],
                'uid' => $block['uid'],
                'order' => $block['order']
            ];

            if ($block['type'] === 'header') {
                $topic['content'] = [
                    'text' => $block['data']['text'],
                    'level' => $block['data']['level'] ?? 3
                ];
            } elseif ($block['type'] === 'paragraph') {
                $topic['content'] = [
                    'text' => $block['data']['text']
                ];
            } elseif ($block['type'] === 'image') {
                $topic['content'] = [
                    'url' => $block['data']['image']['url']
                ];
            }

            $topics[] = $topic;
        }

        return $topics;
    }

    /**
     * Edit a book
     *
     * @param string $id
     * @return View
     */
    public function audio(string $id): View
    {
        $book = Book::with(['chapters.topics', 'authorProfile'])
            ->where('uid', $id)->where('user_id', $this->user->id)->firstOrFail();
        $authorProfiles = AuthorProfile::where('user_id', $this->user->id)->get();
        $genres = get_genre_list(); // Fetch available genres
        $languages = ['English', 'German']; // Language options

        return view('user.books.edit.audio', [
            'meta_data' => $this->metaData(['title' => translate('Book Detail')]),
            'book' => $book,
            'authorProfiles' => $authorProfiles,
            'genres' => $genres,
            'book_languages' => $languages,
        ]);
    }

    /**
     * Generate a synopsis for the book.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function generateSynopsis(Request $request): RedirectResponse
    {
        // Simulate AI-based synopsis generation
        $synopsis = "This is a generated synopsis for the book titled '" . $request->input('title') . "'.";

        // Save synopsis to the book
        $book = Book::findOrFail($request->input('book_id'));
        $book->update(['synopsis' => $synopsis]);

        return back()->with('success', 'Synopsis generated successfully.');
    }

    /**
     * Generate an outline for the book.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function generateOutline(Request $request): RedirectResponse
    {
        // Simulate AI-based outline generation
        $chapters = [
            ['title' => 'Introduction', 'content' => 'This is the introduction.'],
            ['title' => 'Chapter 1', 'content' => 'This is chapter 1.'],
            ['title' => 'Chapter 2', 'content' => 'This is chapter 2.'],
        ];

        $book = Book::findOrFail($request->input('book_id'));

        foreach ($chapters as $chapterData) {
            Chapter::create([
                'book_id' => $book->id,
                'title' => $chapterData['title'],
                'content' => $chapterData['content'],
            ]);
        }

        return back()->with('success', 'Outline generated successfully.');
    }

    /**
     * Generate an audiobook for the book.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function generateAudiobook(Request $request): RedirectResponse
    {
        $book = Book::findOrFail($request->input('book_id'));

        // Simulate audiobook generation
        $audiobook = Audiobook::create([
            'book_id' => $book->id,
            'file_path' => '/audiobooks/' . $book->id . '.mp3',
            'status' => 'completed',
        ]);

        return back()->with('success', 'Audiobook generated successfully.');
    }

}
