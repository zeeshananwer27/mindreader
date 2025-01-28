<?php

namespace App\Jobs;

use App\Http\Services\User\Book\BookService;
use App\Models\Book;
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

    protected $book;
    protected $chapterIds;
    protected $maxRetries = 3; // Maximum retries per chapter

    /**
     * Create a new job instance.
     *
     * @param Book $book
     * @param array|null $chapterIds Specific chapters to process (null = all chapters)
     */
    public function __construct(Book $book, array $chapterIds = null)
    {
        $this->book = $book;
        $this->chapterIds = $chapterIds ?? $book->chapters->pluck('id')->toArray();
    }

    /**
     * Execute the job.
     */
    public function handle(BookService $bookService)
    {
        Log::info("Generating chapter details for book: {$this->book->id}");

        foreach ($this->book->chapters()->whereIn('id', $this->chapterIds)->get() as $chapter) {
            // Skip chapters that have already reached the maximum retry limit
            if ($chapter->retry_attempts >= $this->maxRetries) {
                Log::warning("Skipping chapter {$chapter->id} due to max retry attempts.");
                continue;
            }

            try {
                $decodedData = json_decode($chapter->topics, true);
                $titles = array_column($decodedData, 'title');
                $chapterTopics = implode(', ', $titles);

                $inputData = [
                    'author' => $this->book->about_author,
                    'chapter_name' => $chapter->title,
                    'synopsis' => $this->book->synopsis,
                    'title' => $this->book->title,
                    'language' => $this->book->language,
                    'topics' => $chapterTopics,
                ];

                $result = $bookService->getChapterDetailsByAi($inputData);

                if ($result['status'] === false) {
                    throw new Exception("Failed to generate content for chapter: {$chapter->title}");
                }

                // Save generated chapter details in the database
                $chapter->update([
                    'details' => $result['content'],
                    'retry_attempts' => 0, // Reset retry attempts on success
                ]);

                Log::info("Chapter details saved for: {$chapter->title}");
            } catch (Exception $e) {
                // Increment the retry_attempts field
                $chapter->increment('retry_attempts');

                Log::error("Error generating chapter details for chapter {$chapter->title}: " . $e->getMessage());

                // Log if the chapter has reached the maximum retries
                if ($chapter->retry_attempts >= $this->maxRetries) {
                    Log::error("Chapter {$chapter->id} has failed after {$this->maxRetries} attempts and will not be retried.");
                }

                // Allow the job to fail normally after handling the chapter retries
                throw $e;
            }
        }

        Log::info("Finished processing chapters for book: {$this->book->id}");
    }

    /**
     * Handle job failure.
     */
    public function failed(Exception $exception)
    {
        Log::error("GenerateChapterDetailsJob failed for book: {$this->book->id} with error: {$exception->getMessage()}");
    }
}
