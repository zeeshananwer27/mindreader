@extends('layouts.master')

@section('content')
    @include("frontend.partials.breadcrumb")
    <div class="container mt-4">
        <div class="row g-4 d-flex justify-content-center">
            <div class="flip-book html-book" id="book">
                <div>
                    <!-- Cover Page -->
                    <div class="page page-cover page-cover-top" data-density="hard">
                        <div class="page-content">
                            <h2>{{ $book->title }}</h2>
                            <p>{{ $book->authorProfile->name ?? 'Unknown Author' }}</p>
                            <p><strong>Genre:</strong> {{ $book->genre ?? 'Not Specified' }}</p>
                            <p><strong>Language:</strong> {{ $book->language ?? 'English' }}</p>
                        </div>
                    </div>

                    <!-- Introduction -->
                    @php
                        $introPages = str_split(strip_tags($book->synopsis), 800); // Split intro for pagination
                    @endphp
                    @foreach($introPages as $intro)
                        <div class="page">
                            <div class="page-content">
                                <h2 class="page-header">Introduction</h2>
                                <p>{{ $intro }}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Chapters and Topics -->
                    @foreach($book->chapters as $chapter)
                        <div class="page">
                            <div class="page-content">
                                <h2>Chapter {{ $loop->iteration }}: {{ $chapter->title }}</h2>
                                @foreach($chapter->topics as $topic)

                                    <h3>{{ $topic->title }}</h3>
                                    @foreach($topic->content as $content)

                                        @if($content['type'] == 'header')

                                            <h{{ $content['content']['level'] }}>
                                                {{ $content['content']['text'] }}
                                            </h{{ $content['content']['level'] }}>

                                        @elseif($content['type'] == 'paragraph')
                                            @php
                                                $paragraphPages = str_split(strip_tags($content['content']['text']), 1000);
                                            @endphp
                                            @foreach($paragraphPages as $paragraph)
                                                <div class="page">
                                                    <div class="page-content">
                                                        <p>{{ $paragraph }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif($content['type'] === 'image')
                                            <img src="{{ $content['content']['url'] }}" alt="Image" class="img-fluid">
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- End Page -->
                    <div class="page page-cover page-cover-bottom" data-density="hard">
                        <div class="page-content">
                            <h2>THE END</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-push')
    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {
            const bookElement = document.getElementById('book');
            if (bookElement) {
                const pageFlip = new St.PageFlip(bookElement, {
                    width: 400,
                    height: 500,
                    showCover: true
                });
                pageFlip.loadFromHTML(document.querySelectorAll('.page'));
            }
        });
    </script>
@endpush
