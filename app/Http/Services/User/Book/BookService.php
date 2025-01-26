<?php

namespace App\Http\Services\User\Book;

use App\Http\Services\AiService;
use App\Models\AiTemplate;
use App\Models\AuthorProfile;
use Exception;

class BookService
{
    private AiService $aiService;

    public function __construct(AiService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function getAuthorDetailsByAi($inputData): array
    {
        $author = AuthorProfile::query()->find($inputData['author_profile_id']);
        $tempData['name'] = $author->name;
        $tempData['biography'] = $author->biography;
        $tempData['tone'] = $author->tone;
        $tempData['style'] = $author->style;
        $tempData['language'] = $inputData['language'] ?? "English";

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
