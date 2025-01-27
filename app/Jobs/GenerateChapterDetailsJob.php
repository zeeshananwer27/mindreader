<?php

namespace App\Jobs;

use App\Models\Book;
use App\Services\BookService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GenerateChapterDetailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; // Retry job 3 times in case of failure
    protected $book;
    protected $bookService;

    /**
     * Create a new job instance.
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     */
    public function handle(BookService $bookService)
    {
        Log::info("Generating chapter details for book: " . $this->book->id);

        foreach ($this->book->chapters as $chapter) {
            try {
                $inputData = [
                    'book_title' => $this->book->title,
                    'chapter_title' => $chapter->title,
                    'genre' => $this->book->genre,
                    'language' => $this->book->language,
                ];

                $result = $bookService->getChapterDetailsByAi($inputData);

                if ($result['status'] === false) {
                    throw new Exception("Failed to generate content for chapter: " . $chapter->title);
                }

// Save generated chapter details in the database
                $chapter->update([
                    'details' => $result['content'], // Assuming 'content' contains generated text
                ]);

                Log::info("Chapter details saved for: " . $chapter->title);
            } catch (Exception $e) {
                Log::error("Error generating chapter details: " . $e->getMessage());
                throw $e; // Job will retry automatically
            }
        }

        Log::info("All chapter details generated successfully for book: " . $this->book->id);
    }

    /**
     * Handle job failure.
     */
    public function failed(Exception $exception)
    {
        Log::error("GenerateChapterDetailsJob failed for book: " . $this->book->id . " Error: " . $exception->getMessage());
    }
}
