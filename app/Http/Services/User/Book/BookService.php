<?php

namespace App\Http\Services\User\Book;

use App\Http\Requests\User\Book\BookRequest;
use App\Http\Services\AiService;
use App\Jobs\GenerateChapterDetailsJob;
use App\Models\AiTemplate;
use App\Models\AuthorProfile;
use App\Models\Book;
use App\Models\Chapter;
use Exception;

class BookService
{
    private AiService $aiService;

    public function __construct(AiService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function createBook(BookRequest $request): Book
    {
        $book = $this->saveBookToDb($request);
        $this->saveChaptersToDb($request->chapters, $book);

        // here write the functionality to run job class
        GenerateChapterDetailsJob::dispatch($book)->onQueue('default');

        return $book;
    }

    private function saveBookToDb($request, Book $book = null): Book
    {
        $book = $book ?? new Book();

        $book->fill($request->only([
            'author_profile_id', 'about_author', 'title', 'purpose',
            'genre', 'target_audience', 'language', 'length', 'synopsis'
        ]));
        $book->status = "draft";
        if (!$book->exists) {
            $book->user_id = auth()->id();
            $book->genre = "-";
            $book->length = "small";
        }

        $book->save();
        $book->refresh();

        return $book;
    }

    private function saveChaptersToDb($chaptersArray, $book): void
    {
        $chapters = collect($chaptersArray)->map(function ($chapter) use ($book) {
            return [
                'uid' => uniqid(),
                'title' => $chapter['title'],
                'content' => json_encode($chapter['sections']),
                'book_id' => $book->id,
                'has_image' => $chapter['has_image'] ?? false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        Chapter::insert($chapters->toArray());
    }

    public function reCreateBook($request, $book): Book
    {
        $book = $this->saveBookToDb($request, $book);
        //create required object to pass to AI model
        $inputData['synopsis'] = $book->synopsis;
        $inputData['author'] = $book->about_author;
        $inputData['title'] = $book->title;
        $inputData['language'] = $book->language;

        $chaptersData = $this->getBookChapterAndOutlinesByAi($inputData);
        $chaptersArray = $chaptersData['message']['chapters'];
        $this->saveChaptersToDb($chaptersArray, $book);

        GenerateChapterDetailsJob::dispatch($book)->onQueue('default');
        return $book;
    }

    public function getBookChapterAndOutlinesByAi($inputData): array
    {
        //get template to generate Chapters Outlines string from default template created by AiTemplate seeder
        $chaptersTemplate = AiTemplate::query()->where('uid', '61d0079c-abc1-4be6-90f1-9998ec2d6f53')->first();
        try {
//            $response = $this->aiService->generateAiContent($inputData, $chaptersTemplate);
            $response = 'Title: PHP Programming



          Introduction:

          Welcome to "PHP Programming," a concise guide aimed at readers looking to transition from Java to PHP. This book is designed to help you understand the fundamental differences between the two programming languages and master key concepts in PHP. Whether you are a beginner in PHP or an experienced developer looking to expand your skills, this book will provide you with practical examples and exercises to reinforce your learning. Join us on this journey to excel in PHP programming within the Art & Photography industry.



          Chapter 1: Introduction to PHP

          - Overview of PHP

          - History of PHP

          - Setting up a PHP development environment



          Chapter 2: PHP Syntax

          - Basic syntax

          - Variables and constants

          - Operators

          - Control structures



          Chapter 3: PHP Data Types

          - Scalar data types

          - Compound data types

          - Type juggling



          Chapter 4: PHP Functions

          - Declaring functions

          - Passing arguments

          - Return values

          - Variable scope



          Chapter 5: Object-Oriented Programming in PHP

          - Classes and objects

          - Properties and methods

          - Inheritance

          - Interfaces



          Chapter 6: Practical Examples

          - Building a simple website

          - Implementing a user registration system

          - Creating a photo gallery



          Chapter 7: Advanced Topics

          - Error handling

          - Working with databases

          - Using PHP frameworks

          - Best practices in PHP development



          Conclusion:

          Congratulations on completing "PHP Programming"! Whether you are just starting out in PHP or looking to enhance your skills, this book has provided you with the knowledge and tools to excel in PHP programming within the Art & Photography industry. Keep exploring and practicing, and you will soon become a proficient PHP developer. Thank you for joining us on this learning journey.
          ';

            $data = $this->parseTextToJson($response);

            return [
                "status" => true,
                "message" => $data,
            ];
        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => $e->getMessage(),
            ];
        }
    }

    private function parseTextToJson($response): array
    {
        $lines = explode("\n", $response);
        $jsonData = ["title" => "", "introduction" => ["content" => ""], "chapters" => [], "conclusion" => ["content" => ""]];

        $currentChapter = "";
        $currentSections = [];
        $inIntroduction = false;
        $inConclusion = false;

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line)) continue;

            if (str_starts_with($line, "Title:")) {
                $jsonData["title"] = trim(substr($line, 6));
            } elseif (str_starts_with($line, "Introduction:")) {
                $inIntroduction = true;
                $inConclusion = false;
            } elseif (str_starts_with($line, "Conclusion:")) {
                if (!empty($currentChapter)) {
                    $jsonData["chapters"][] = ["title" => trim($currentChapter), "sections" => $currentSections];
                }
                $currentChapter = "";
                $currentSections = [];
                $inIntroduction = false;
                $inConclusion = true;
            } elseif (preg_match("/^Chapter [0-9]+:/", $line)) {
                if (!empty($currentChapter)) {
                    $jsonData["chapters"][] = ["title" => trim($currentChapter), "sections" => $currentSections];
                }
                $currentChapter = trim($line);
                $currentSections = [];
                $inIntroduction = false;
                $inConclusion = false;
            } elseif ($inIntroduction) {
                $jsonData["introduction"]["content"] .= " " . $line;
            } elseif ($inConclusion) {
                $jsonData["conclusion"]["content"] .= " " . $line;
            } elseif (!empty($currentChapter)) {
                $currentSections[] = $line;
            }
        }

        if (!empty($currentChapter)) {
            $jsonData["chapters"][] = ["title" => trim($currentChapter), "sections" => $currentSections];
        }

        return $jsonData;
    }

    public function getChapterDetailsByAi($inputData): array
    {
        //get template to generate Chapter topics details string from default template created by AiTemplate seeder
        $authorTemplate = AiTemplate::query()->where('uid', '61d2279c-abc1-4be6-90f1-9448ec2d6f55')->first();
        try {
            return $this->aiService->generateAiContent($inputData, $authorTemplate);
        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => $e->getMessage(),
            ];
        }
    }

    public function getAuthorDetailsByAi($inputData): array
    {
        $author = AuthorProfile::query()->find($inputData['author_profile_id']);
        $tempData['name'] = $author->name;
        $tempData['biography'] = $author->biography;
        $tempData['tone'] = $author->tone;
        $tempData['style'] = $author->style;
        $tempData['language'] = $inputData['language'] ?? "English";
        $tempData['pdf_text'] = $inputData['pdf_text'] ?? null;

        //get template to generate author string from default template created by AiTemplate seeder
        $authorTemplate = AiTemplate::query()->where('uid', '61d3379c-abc1-4be6-90f1-9998ec2d6110')->first();
        try {
            return $this->aiService->generateAiContent($tempData, $authorTemplate);
        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => $e->getMessage(),
            ];
        }
    }

    public function getSynopsisByAi($inputData): array
    {
        //get template to generate synopsis string from default template created by AiTemplate seeder
        $synopsisTemplate = AiTemplate::query()->where('uid', 'c4e1e23d-11dd-4545-a080-eeb4e25f5f74')->first();
        try {
            $response = $this->aiService->generateAiContent($inputData, $synopsisTemplate);
            preg_match('/Synopsis:(.+)/s', $response['message'], $matches);
            $synopsis = $matches[1] ?? $response['message'];
            return [
                "status" => true,
                "message" => trim($synopsis),
            ];
        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => $e->getMessage(),
            ];
        }
    }
}
