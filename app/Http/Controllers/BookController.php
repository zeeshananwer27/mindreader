<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class BookController extends Controller
{

    /**
     * @param string $uid
     * @return View
     */
    public function landing(string $uid): View
    {
        $book = Book::withCount('chapters')
            ->status('active')->where('uid', $uid)->firstOrfail();

        // Get 4 random books by the same author, excluding the current book
        $relatedBooks = Book::with('authorProfile')->status('active')
            ->where('author_profile_id', $book->author_profile_id)
            ->where('id', '!=', $book->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.book.landing', [
            'meta_data' => $this->metaData(["title" => $book->title]),
            'book' => $book,
            'breadcrumbs' => ['Home' => 'home', $book->title => null],
            'relatedBooks' => $relatedBooks,
        ]);
    }

    /**
     * Show book details
     *
     * @param string $id
     * @return View
     */
    public function view(string $id): View
    {
        $book = Book::with(['chapters.topics', 'authorProfile'])
            ->status('active')->where('uid', $id)->firstOrfail();

        return view('frontend.book.show', [
            'meta_data' => $this->metaData(["title" => $book->title]),
            'book' => $book,
            'breadcrumbs' => ['Home' => 'home', $book->title => null],
        ]);
    }

    /**
     * Show book details
     *
     * @param string $id
     * @return View
     */
    public function preview(string $id): View
    {
        $book = Book::with(['chapters.topics', 'authorProfile'])
            ->status('active')->where('uid', $id)->firstOrfail();

        return view('frontend.book.preview', [
            'meta_data' => $this->metaData(["title" => $book->title]),
            'book' => $book,
            'breadcrumbs' => ['Home' => 'home', $book->title => null],
        ]);
    }


    public function generatePdf($id)
    {
        // Fetch the book with its chapters and topics
        $book = Book::with(['chapters.topics', 'authorProfile'])
            ->where('uid', $id)
            ->firstOrFail();

        $tableOfContents = [];
        foreach ($book->chapters as $index => $chapter) {
            $chapterTitle = $chapter->title;
            $chapterNumber = $index + 1;

            // Chapter entry with chapter number and title on separate lines
            $chapterLink = "<a href='#chapter-{$chapter->id}' class='toc-chapter'>
                        <div class='toc-chapter-number'>Chapter {$chapterNumber}:</div>
                        <div class='toc-chapter-title'>{$chapterTitle}</div>
                    </a>";

            // Add chapter to table of contents
            $tocEntry = "<li class='toc-chapter-entry'>{$chapterLink}</li>";
            $tableOfContents[] = $tocEntry;
        }
        $tableOfContentsHtml = "<ul class='table-of-contents-list'>" . implode('', $tableOfContents) . "</ul>";

        $pdfContent = view('pdf.book', [
            'book' => $book,
            'tableOfContentsHtml' => $tableOfContentsHtml
        ])->render();

        // Generate the PDF
        $pdf = PDF::loadHTML($pdfContent);

        return $pdf->download('book_content.pdf');
    }
}
