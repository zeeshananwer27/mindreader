@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row g-4">

            <!-- Left Sidebar (3 columns) -->
            <div class="col-md-3 i-card-md vh-100 overflow-auto border-end p-4">
                <div class="sticky sticky-top">
                    <!-- Book Cover -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/global/books/php-book-pic.jpeg') }}"
                             alt="Book Cover" class="img-fluid rounded shadow" width="250">
                    </div>

                    <!-- Book Title -->
                    <h4 class="text-center fw-bold">{{ $book->title }}</h4>

                    <!-- Chapters List -->
                    <div class="mt-3">
                        @foreach($book->chapters as $chapter)
                            <div class="border-bottom py-2 pointer fw-bold text-truncate chapter-link"
                                 data-bs-toggle="tooltip" title="{{ $chapter->title }}" data-uid="{{ $chapter->uid }}">
                                <div class="pre-wrap">{{ $chapter->title }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Content (9 columns) -->
            <div class="col-md-9 i-card-md vh-100 overflow-auto p-4">
                @foreach($book->chapters as $chapter)
                    <div id="chapter-{{ $chapter->uid }}" class="chapter-content d-none">
                        <h3 class="fw-bold">{{ $chapter->title }}</h3>
                        {!! nl2br(e($chapter->content)) !!}
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

<!-- jQuery and Bootstrap Script -->
@push('script-push')
    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {
            // Initialize Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Handle chapter clicks
            $(".chapter-link").click(function () {
                var targetUid = $(this).data("uid");

                $(".chapter-content").removeClass('d-block').addClass('d-none');

                // Show the content for the clicked chapter
                $("#chapter-" + targetUid).removeClass('d-none').addClass('d-block');
            });

            // Show the first chapter by default (if any chapters exist)
            @if($book->chapters->count() > 0)
            var firstUid = "{{ $book->chapters[0]->uid }}";
            $("#chapter-" + firstUid).removeClass('d-none').addClass('d-block'); // Show the first chapter
            @endif
        });
    </script>
@endpush

<!-- CSS for pointer cursor -->
@push('style-push')
    <style>
        .chapter-link {
            cursor: pointer;
        }

        .chapter-link:hover {
            color: #007bff;
        }

        .pre-wrap {
            white-space: pre-wrap;
        }

        .chapter-content {
            display: none;
        }
    </style>
@endpush
