<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }}</title>
    <style>
        body {
            font-family: serif;
            margin: 0;
            padding: 0;
            color: #272424;
        }

        .cover-page {
            text-align: center;
            padding: 50px 20px;
            border-bottom: 2px solid #ddd;
        }

        .cover-page h1 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .cover-page p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .intro {
            margin-top: 50px;
            padding: 16px;
            font-size: 22px;
            line-height: 1.8;
            text-align: justify;
        }

        .table-of-contents, .intro, .chapter {
            page-break-before: always;
        }

        .table-of-contents h1 {
            text-align: center;
        }

        .table-of-contents-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .toc-chapter-entry {
            margin-bottom: 12px;
        }

        .toc-chapter-entry a {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s ease;
            padding: 8px;
            border-radius: 5px;
        }

        .toc-chapter-number {
            font-size: 16px;
            color: #7f8c8d;
        }

        .toc-chapter-title {
            font-size: 24px;
            color: #272424;
            font-weight: bold;
        }

        .toc-chapter-entry a:hover {
            background-color: #f8c8d7; /* Light pink background */
        }

        .chapter {
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .chapter h3 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 20px;
        }

        .chapter h4 {
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .chapter p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .chapter img {
            display: block;
            margin: 50px auto;
            max-width: 80%;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Footer with page number */
        footer {
            bottom: 0;
            text-align: center;
            font-size: 14px;
            position: fixed;
            width: 100%;
            color: #7f8c8d;
        }

        @media print {
            body {
                counter-reset: page 3;
            }

            footer {
                display: block;
            }

            .table-of-contents, .chapter {
                page-break-before: always;
            }
        }

        footer::before {
            content: "Page " counter(page);
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

<!-- Cover Page -->
<div class="cover-page">
    <h1>{{ $book->title }}</h1>
    <p>{{ $book->description }}</p>
    <p><strong>Author: {{ $book->authorProfile->name }}</strong></p>
</div>

<!-- Table of Contents (on the 3rd page) -->
<div class="intro">
    {{ $book->synopsis }}
</div>

<!-- Table of Contents (on the 3rd page) -->
<div class="table-of-contents">
    <h1>Table of Contents</h1>
    {!! $tableOfContentsHtml !!}
</div>

<!-- Chapters -->
@foreach ($book->chapters as $chapter)
    <div class="chapter" id="chapter-{{ $chapter->id }}">
        <h3>{{ $chapter->title }}</h3>

        @foreach($chapter->topics->sortBy('order') as $topic)
            @if($topic->type === 'header')
                <h4 class="fw-bold mb-3">{{ $topic->content['text'] }}</h4>
            @elseif($topic->type === 'paragraph')
                <p class="mb-3 text-justify">{!! nl2br(e($topic->content['text'])) !!}</p>
            @elseif($topic->type === 'image')
                <div class="my-3">
                    <img src="{{ $topic->content['url'] }}" alt="Image" class="img-fluid rounded shadow">
                {{$topic->content['url'] }}
                </div>
            @endif
        @endforeach
    </div>
@endforeach
<footer></footer>
</body>
</html>
