<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
            ->status('active')->where('uid',$uid)->firstOrfail();

        // Get 4 random books by the same author, excluding the current book
        $relatedBooks = Book::with('authorProfile')->status('active')
            ->where('author_profile_id', $book->author_profile_id)
            ->where('id', '!=', $book->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.book.landing', [
            'meta_data'    => $this->metaData(["title" => $book->title]),
            'book'         => $book,
            'breadcrumbs'  => ['Home' => 'home', $book->title => null],
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
            ->status('active')->where('uid',$id)->firstOrfail();

        return view('frontend.book.show', [
            'meta_data'    => $this->metaData(["title" => $book->title]),
            'book'         => $book,
            'breadcrumbs'  => ['Home' => 'home', $book->title => null],
        ]);
    }

}
