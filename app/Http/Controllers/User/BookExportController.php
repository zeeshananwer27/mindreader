<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BookExportController extends Controller
{
    /**
     * Export the book as a PDF.
     *
     * @param string $id
     * @return Response
     */
    public function exportPdf(string $id): Response
    {
        $book = Book::findOrFail($id);

        // Simulate PDF generation (using raw text as placeholder)
        $pdfContent = "Book Title: {$book->title}\n\n";
        $pdfContent .= "Genre: {$book->genre}\n\n";
        $pdfContent .= "Language: {$book->language}\n\n";
        $pdfContent .= "Synopsis: {$book->synopsis}\n\n";

        foreach ($book->chapters as $chapter) {
            $pdfContent .= "\nChapter: {$chapter->title}\n{$chapter->content}\n";
        }

        $filePath = "books/{$book->id}.pdf";
        Storage::put($filePath, $pdfContent);

        return response()->download(storage_path("app/{$filePath}"), "{$book->title}.pdf");
    }

    /**
     * Export the book as a Word document.
     *
     * @param string $id
     * @return Response
     */
    public function exportWord(string $id): Response
    {
        $book = Book::findOrFail($id);

        // Simulate Word document generation (using raw text as placeholder)
        $wordContent = "Book Title: {$book->title}\n\n";
        $wordContent .= "Genre: {$book->genre}\n\n";
        $wordContent .= "Language: {$book->language}\n\n";
        $wordContent .= "Synopsis: {$book->synopsis}\n\n";

        foreach ($book->chapters as $chapter) {
            $wordContent .= "\nChapter: {$chapter->title}\n{$chapter->content}\n";
        }

        $filePath = "books/{$book->id}.docx";
        Storage::put($filePath, $wordContent);

        return response()->download(storage_path("app/{$filePath}"), "{$book->title}.docx");
    }

    /**
     * Export the book for Kindle Direct Publishing (KDP).
     *
     * @param string $id
     * @return Response
     */
    public function exportKdp(string $id): Response
    {
        $book = Book::findOrFail($id);

        // Simulate KDP-compatible export
        $kdpContent = "<kdp>\n<title>{$book->title}</title>\n";
        $kdpContent .= "<genre>{$book->genre}</genre>\n";
        $kdpContent .= "<language>{$book->language}</language>\n";
        $kdpContent .= "<synopsis>{$book->synopsis}</synopsis>\n";

        foreach ($book->chapters as $chapter) {
            $kdpContent .= "<chapter><title>{$chapter->title}</title><content>{$chapter->content}</content></chapter>\n";
        }

        $kdpContent .= "</kdp>";

        $filePath = "books/{$book->id}_kdp.xml";
        Storage::put($filePath, $kdpContent);

        return response()->download(storage_path("app/{$filePath}"), "{$book->title}_kdp.xml");
    }
}
