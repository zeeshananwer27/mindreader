<?php

namespace App\Jobs;

use App\Http\Services\User\Book\BookService;
use App\Models\Book;
use App\Models\ChapterTopic;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

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
     * @throws Exception
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
                $decodedData = json_decode($chapter->content, true);
                $titles = array_column($decodedData, 'title');
                $chapterTopics = implode(', ', $titles);

                $inputData = [
                    'author' => $this->book->about_author,
                    'chapter' => $chapter->title,
                    'synopsis' => $this->book->synopsis,
                    'title' => $this->book->title,
                    'language' => $this->book->language,
                    'topics' => $chapterTopics,
                ];

                // uncomment when going live to test with open AI
//                $result = $bookService->getChapterDetailsByAi($inputData);
                $result = [
                    "status" => true,
                    "message" => "Topic: Overview of PHP\n\nParagraph: PHP, which stands for Hypertext Preprocessor, is a widely used open-source scripting language that is especially suited for web development and can be embedded into HTML. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994 and has since evolved into a powerful tool for creating dynamic and interactive web pages. PHP is known for its simplicity, flexibility, and ease of use, making it a popular choice for developers around the world. With a rich set of built-in functions and support for a wide range of databases, PHP allows developers to build robust and scalable web applications.\n\nParagraph: One of the key features of PHP is its ability to interact seamlessly with databases, making it an essential tool for building dynamic websites that rely on backend data storage. PHP can connect to various database management systems, such as MySQL, PostgreSQL, and SQLite, allowing developers to create sophisticated web applications that can handle large amounts of data. Additionally, PHP supports a wide range of protocols, including HTTP, POP3, IMAP, and LDAP, making it a versatile language for web development. Its cross-platform compatibility and support for multiple operating systems have also contributed to its widespread adoption in the industry. \n\nTopic: History of PHP\n\nParagraph: PHP has a rich history that dates back to the mid-1990s when Rasmus Lerdorf first created a set of Perl scripts to manage his personal website. These scripts eventually evolved into PHP\/FI (Personal Home Page\/Forms Interpreter), which was released to the public in 1995. Over the years, PHP has undergone several major revisions and updates, with PHP 3 being a significant milestone in the language's development. With the release of PHP 4 in 2000, PHP became a more mature and powerful language, with support for object-oriented programming and improved performance. Subsequent versions, such as PHP 5 and PHP 7, introduced additional features and enhancements, further solidifying PHP's status as a leading language for web development.\n\nParagraph: Today, PHP is used by millions of developers worldwide and powers a significant portion of the websites on the internet. Its active community, extensive documentation, and rich ecosystem of libraries and frameworks have contributed to its continued popularity and relevance in the ever-evolving landscape of web development. As technology continues to advance, PHP continues to evolve, with regular updates and new features being introduced to keep pace with the changing needs of developers and users. Whether you are a seasoned PHP developer or a newcomer to the language, understanding its history and evolution can provide valuable insights into its strengths, weaknesses, and potential for future growth. \n\nTopic: Setting up a PHP development environment\n\nParagraph: Setting up a PHP development environment is an essential step in getting started with PHP programming. To begin, you will need to install a web server, such as Apache or Nginx, on your local machine to handle requests and serve PHP files. Additionally, you will need to install PHP on your system, along with a database management system like MySQL or PostgreSQL if you plan to work with databases. There are several popular software bundles available, such as XAMPP, which provide a convenient way to set up a local development environment with all the necessary components pre-configured.\n\nParagraph: Once you have set up your web server and installed PHP, you can start creating and testing PHP scripts in a local development environment. A text editor or integrated development environment (IDE) can be used to write and edit PHP code, while a browser can be used to view the output of your scripts. It is important to configure your development environment properly to ensure that your PHP scripts run smoothly and efficiently. By following best practices for setting up a PHP development environment, you can streamline your workflow, improve productivity, and create high-quality web applications that meet the needs of your users."
                ];

                Log::info("Chapter details saved for: " . json_encode($result));

                if ($result['status'] === false) {
                    throw new Exception("Failed to generate content for chapter: {$chapter->title}");
                }

                $this->saveChapterDetails($chapter->id, $this->parseMessage($result));

                // Save generated chapter details in the database
                $chapter->update([
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

        $this->book->update([
            'status' => "active",
        ]);

        Log::info("Finished processing chapters for book: {$this->book->id}");
    }

    private function saveChapterDetails($chapterId, $parsedData): void
    {
        Log::info("Finished processing chapters for book: " . json_encode($parsedData));

        foreach ($parsedData as $index => $item) {
            ChapterTopic::create([
                'chapter_id' => $chapterId,
                'order' => $index + 1,
                'type' => $item['type'],
                'content' => json_encode($item['data'],)
            ]);
        }
    }

    private function parseMessage($result): array
    {
        $parsedData = [];

        if (!empty($result['message'])) {
            // Split the message content into lines
            $lines = preg_split('/\n+/', $result['message']);
            $currentTopic = null;

            foreach ($lines as $line) {
                $line = trim($line);

                // Check if the line is a topic
                if (str_starts_with($line, 'Topic:')) {
                    $currentTopic = substr($line, 7); //  remove "Topic:" keyword and get next string
                    $parsedData[] = [
                        'type' => 'header',
                        'data' => ['text' => $currentTopic, 'level' => 3],
                    ];
                } // Check if the line is a paragraph
                elseif (str_starts_with($line, 'Paragraph:')) {
                    $paragraph = substr($line, 11); // remove "paragraph:" keyword and get next string
                    $parsedData[] = [
                        'type' => 'paragraph',
                        'data' => ['text' => $paragraph],
                        'topic' => $currentTopic, //we can use this to associate with topic id
                    ];
                }
            }
        }

        return $parsedData;
    }

    /**
     * Handle job failure.
     */
    public function failed(Throwable $exception)
    {
        Log::error("GenerateChapterDetailsJob failed for book: {$this->book->id} with error: {$exception->getMessage()}");
    }
}
