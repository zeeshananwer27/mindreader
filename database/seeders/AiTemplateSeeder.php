<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Create Author Details Template to generate string query to OpenAI
            [
                'uid' => '61d3379c-abc1-4be6-90f1-9998ec2d6110',
                'category_id' => 1,
                'sub_category_id' => null,
                'user_id' => null,
                'admin_id' => null,
                'name' => 'Create Author Details',
                'slug' => 'create-author-details',
                'icon' => 'bi bi-app-indicator',
                'description' => 'Author Details',
                'prompt_fields' => json_encode([
                    'name' => [
                        'instraction' => 'name',
                        'field_name' => 'name',
                        'field_label' => 'Name',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'biography' => [
                        'instraction' => 'biography',
                        'field_name' => 'biography',
                        'field_label' => 'Biography',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'tone' => [
                        'instraction' => 'tone',
                        'field_name' => 'tone',
                        'field_label' => 'Tone',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'style' => [
                        'instraction' => 'style',
                        'field_name' => 'style',
                        'field_label' => 'Style',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                ]),
                'custom_prompt' => 'write a summary of 4 to 5 lines about book author using following details.
                Name of Author is:"{name}",
                Biography of Author is:"{biography}",
                Tone of Author is:"{tone}",
                Style of Author is:"{style}"',
                'total_words' => 0,
                'status' => "1",
                'is_default' => "0"
            ],
            // Create Synopsis Template to generate string query to OpenAI
            [
                'uid' => 'c4e1e23d-11dd-4545-a080-eeb4e25f5f74',
                'category_id' => 1,
                'sub_category_id' => null,
                'user_id' => null,
                'admin_id' => null,
                'name' => 'Create Synopsis for book',
                'slug' => 'create-synopsis',
                'icon' => 'bi bi-align-middle',
                'description' => 'create new Synopsis',
                'prompt_fields' => json_encode([
                    'title' => [
                        'instraction' => 'use this title',
                        'field_name' => 'title',
                        'field_label' => 'title',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'genre' => [
                        'instraction' => 'this is genre',
                        'field_name' => 'genre',
                        'field_label' => 'genre',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'target' => [
                        'instraction' => 'target',
                        'field_name' => 'target',
                        'field_label' => 'target',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'length' => [
                        'instraction' => 'length',
                        'field_name' => 'length',
                        'field_label' => 'length',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'purpose' => [
                        'instraction' => 'purpose',
                        'field_name' => 'purpose',
                        'field_label' => 'purpose',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                ]),
                'custom_prompt' => 'generate and return book Synopsis in response using following instructions:-
                Title of book is: "{title}",
                genre of book is: "{genre}",
                target audience of book is: "{target}",
                length of book is: "{length}",
                purpose of book of book is: "{purpose}"',

                'total_words' => 0,
                'status' => "1",
                'is_default' => "0"
            ],
            // Create Book chapters and outlines Template to generate string query to OpenAI
            [
                'uid' => '61d0079c-abc1-4be6-90f1-9998ec2d6f53',
                'category_id' => 1,
                'sub_category_id' => null,
                'user_id' => null,
                'admin_id' => null,
                'name' => 'Create Book chapters',
                'slug' => 'create-book-chapters',
                'icon' => 'bi bi-app-indicator',
                'description' => 'book chapters',
                'prompt_fields' => json_encode([
                    'author' => [
                        'instraction' => 'author',
                        'field_name' => 'author',
                        'field_label' => 'author',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'synopsis' => [
                        'instraction' => 'synopsis',
                        'field_name' => 'synopsis',
                        'field_label' => 'synopsis',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'title' => [
                        'instraction' => 'title',
                        'field_name' => 'title',
                        'field_label' => 'title',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                ]),
                'custom_prompt' => 'create book introduction page and chapters with outlines using following details of book:-
                Title of book is: "{title}"
                Synopsis of book is: "{synopsis}"
                author details of book is:"{author}"',
                'total_words' => 0,
                'status' => "1",
                'is_default' => "0"
            ],
            // Create chapters details Template to generate string query to OpenAI
            [
                'uid' => '61d2279c-abc1-4be6-90f1-9448ec2d6f55',
                'category_id' => 1,
                'sub_category_id' => null,
                'user_id' => null,
                'admin_id' => null,
                'name' => 'Create chapters details',
                'slug' => 'create-chapter-details',
                'icon' => 'bi bi-app-indicator',
                'description' => 'book chapter details',
                'prompt_fields' => json_encode([
                    'author' => [
                        'instraction' => 'author',
                        'field_name' => 'author',
                        'field_label' => 'author',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'chapter_name' => [
                        'instraction' => 'chapter_name',
                        'field_name' => 'chapter_name',
                        'field_label' => 'Chapter Name',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'synopsis' => [
                        'instraction' => 'synopsis',
                        'field_name' => 'synopsis',
                        'field_label' => 'synopsis',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'title' => [
                        'instraction' => 'title',
                        'field_name' => 'title',
                        'field_label' => 'title',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'topics' => [
                        'instraction' => 'topics',
                        'field_name' => 'topics',
                        'field_label' => 'topics',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                    'language' => [
                        'instraction' => 'language',
                        'field_name' => 'language',
                        'field_label' => 'language',
                        'type' => 'text',
                        'validation' => 'required',
                    ],
                ]),
                'custom_prompt' => 'write detail paragraphs for book with following details:-
                language of book is: "{language}"
                author details of book is:"{author}"
                Synopsis of book is: "{synopsis}"
                name of book is: "{title}"
                chapter name is: "{chapter}"
                topics are: "{topics}"
                note: do not write book synopsis and author details. do not write "topic" keyword with topic title',
                'total_words' => 0,
                'status' => "1",
                'is_default' => "0"
            ],
            [
                'uid' => '293a8bec-39f2-418a-99bf-d0f18ffeab2b',
                'category_id' => 1,
                'sub_category_id' => null,
                'user_id' => null,
                'admin_id' => null,
                'name' => 'book cover image',
                'slug' => 'book-cover-image',
                'icon' => 'bi bi-aspect-ratio-fill',
                'description' => 'book cover image',
                'prompt_fields' => json_encode([]),
                'custom_prompt' => 'The cover should have a modern and professional design suitable for the book.
                Include the title in bold, modern typography, and the author\'s name in a smaller, elegant font.
                Ensure the image is in high resolution (800x1400 pixels) suitable for print use.
                Create a high-resolution book cover for a book using following data:
                "{data}"',
                'total_words' => 0,
                'status' => "1",
                'is_default' => '0'
            ],
            [
                'uid' => '293a8bec-2323-418a-99bf-d0f18ffabab2',
                'category_id' => 1,
                'sub_category_id' => null,
                'user_id' => null,
                'admin_id' => null,
                'name' => 'Chapter cover image',
                'slug' => 'chapter-cover-image',
                'icon' => 'bi bi-aspect-ratio-fill',
                'description' => 'chapter cover image',
                'prompt_fields' => json_encode([]),
                'custom_prompt' => 'Create a high-resolution cover image for a book using following data: "{data}".
                and other general instructions are: chapter cover should have a modern and professional design suitable for the book.
                Include the title in bold, modern typography, elegant font. Ensure the image is in high resolution suitable for print use.',
                'total_words' => 0,
                'status' => '1',
                'is_default' => '0'
            ]
        ];

        foreach ($data as $item) {
            DB::table('ai_templates')->updateOrInsert(
                ['uid' => $item['uid']],
                [
                    'category_id' => $item['category_id'],
                    'sub_category_id' => $item['sub_category_id'],
                    'user_id' => $item['user_id'],
                    'admin_id' => $item['admin_id'],
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'icon' => $item['icon'],
                    'description' => $item['description'],
                    'prompt_fields' => $item['prompt_fields'],
                    'custom_prompt' => $item['custom_prompt'],
                    'total_words' => $item['total_words'],
                    'status' => $item['status'],
                    'is_default' => $item['is_default'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
