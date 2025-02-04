<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->title }}</title>
    <style>
        body {
            font-family: serif;
            background-color: ghostwhite;
            margin: 0;
            padding: 16px;
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
            font-size: 20px;
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
            color: black;
            font-weight: bold;
        }

        .toc-chapter-entry a:hover {
            background-color: #f8c8d7; /* Light pink background */
        }

        .chapter {
            background-color: ghostwhite;
            border-radius: 8px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .chapter h3 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 8px;
        }

        .chapter h4 {
            font-size: 28px;
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .chapter p {
            font-size: 22px;
            line-height: 1.6;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .chapter img {
            display: block;
            margin-top: -20px;
            margin-bottom: 60px;
            max-width: 100%;
            object-fit: cover;
            vertical-align: bottom;
            border-radius: 8px;
        }

        .chapter-content {
            padding: 2px;
            display: block;
            width: 100%;
        }

        /* Footer with page number */
        footer {
            padding: 0;
            margin: 0;
            bottom: 0;
            text-align: center;
            font-size: 14px;
            position: fixed;
            width: 100%;
            color: #7f8c8d;
        }

        @media print {
            @page {
                background-color: ghostwhite;
                margin: 0; /* top, right, bottom, left */
            }
            body {
                margin: 0;
                padding: 4px;
            }

            .table-of-contents, .chapter {
                page-break-before: always;
            }
        }

        .footer-container footer::before {
            content: counter(page);
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
<div class="footer-container">
    <!-- Chapters -->
    @foreach ($book->chapters as $index=> $chapter)
        <div class="chapter" id="chapter-{{ $chapter->id }}">
            <h3>Chapter {{($index+1)}}: {{ $chapter->title }}</h3>

            <div class="chapter-content">
                @foreach($chapter->topics->sortBy('order') as $topic)
                    @if($topic->type === 'header')
                        <h4 class="fw-bold mb-3">{{ $topic->content['text'] }}</h4>
                    @elseif($topic->type === 'paragraph')
                        <p>{!! nl2br(e($topic->content['text'])) !!}</p>
                    @elseif($topic->type === 'image')
                        @php
                            $topicImage = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($topic->content['url']));
                        @endphp
                        <img src="{{ $topicImage }}" alt="Image">
                    @endif
                    <footer></footer>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
<div style="page-break-before: always; height: 100vh;"></div>
</body>
</html>
