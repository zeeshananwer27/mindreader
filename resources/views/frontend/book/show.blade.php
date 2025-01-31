@extends('layouts.master')

@section('content')
    @include("frontend.partials.breadcrumb")

    <div class="container mt-4">
        <div class="row g-4">
            <!-- Left Sidebar (3 columns) -->
            <div class="col-md-3 i-card-md border-end p-4">
                <div class="sticky sticky-top">
                    <!-- Book Cover -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/global/books/php-book-pic.jpeg') }}"
                             alt="Book Cover" class="img-fluid rounded shadow" width="250">
                    </div>

                    <!-- Book Title -->
                    <h4 class="text-center fw-bold">{{ $book->title }}</h4>

                    <!-- Chapters List with Expandable Sections -->
                    <div class="accordion mt-3" id="chaptersAccordion">
                        @foreach($book->chapters as $chapter)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{ $chapter->uid }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $chapter->uid }}" aria-expanded="false"
                                            aria-controls="collapse-{{ $chapter->uid }}" data-uid="{{ $chapter->uid }}">
                                        {{ $chapter->title }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $chapter->uid }}" class="accordion-collapse collapse"
                                     aria-labelledby="heading-{{ $chapter->uid }}" data-bs-parent="#chaptersAccordion">
                                    <div class="accordion-body">
                                        @foreach($chapter->topics->where('type', 'title')->sortBy('order') as $topic)
                                            <div class="border-bottom py-2 pointer text-truncate section-link"
                                                 data-chapter="{{ $chapter->uid }}"
                                                 data-section="{{ $topic->uid }}">
                                                {{ $topic->content }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <!-- Right Content (9 columns) -->
            <div class="col-md-9 i-card-md p-4">
                @foreach($book->chapters as $chapter)
                    <div id="chapter-{{ $chapter->uid }}" class="chapter-content d-none">
                        <h3 class="fw-bold mb-3">{{ $chapter->title }}</h3>

                        @if($chapter->topics->count() > 0)
                            <div class="chapter-container mb-5">
                                @foreach($chapter->topics->sortBy('order') as $topic)
                                    <div id="section-{{ $topic->uid }}" class="chapter-container-item">
                                        @if($topic->type === 'title')
                                            <h4 class="fw-bold mb-3">{{ $topic->content }}</h4>
                                        @elseif($topic->type === 'paragraph')
                                            <p class="mb-3 text-justify">{!! nl2br(e($topic->content)) !!}</p>
                                        @elseif($topic->type === 'image')
                                            <div class="my-3">
                                                <img src="{{ asset('storage/' . $topic->content) }}" alt="Image" class="img-fluid rounded shadow">
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No topics available for this chapter.</p>
                        @endif
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
            $('[data-bs-toggle="tooltip"]').tooltip();

            function updateURL(chapterUid, sectionUid = null) {
                let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?chapter=" + chapterUid;
                if (sectionUid) {
                    newUrl += "&section=" + sectionUid;
                }
                window.history.pushState({ path: newUrl }, "", newUrl);
            }

            function loadChapter(uid) {
                $(".chapter-content").removeClass('d-block').addClass('d-none');
                $(".accordion-button").removeClass('active');

                $("#chapter-" + uid).removeClass('d-none').addClass('d-block');
                $("#heading-" + uid + " .accordion-button").addClass('active');
                $("#collapse-" + uid).collapse('show');

                updateURL(uid);
            }

            function scrollToSection(sectionUid) {
                $(".section-link").removeClass("text-primary fw-bold");

                let sectionElement = $("#section-" + sectionUid);
                let sectionLink = $(".section-link[data-section='" + sectionUid + "']");

                if (sectionElement.length) {
                    $("html, body").animate({
                        scrollTop: sectionElement.offset().top - 80
                    }, 500);

                    sectionLink.addClass("text-primary fw-bold");
                }
            }

            // Handle chapter clicks - Prevent duplicate binding
            $(document).off("click", ".accordion-button").on("click", ".accordion-button", function () {
                var targetUid = $(this).data("uid");
                loadChapter(targetUid);
            });

            // Handle section clicks - Prevent duplicate binding
            $(document).off("click", ".section-link").on("click", ".section-link", function () {
                var chapterUid = $(this).data("chapter");
                var sectionUid = $(this).data("section");

                loadChapter(chapterUid);
                setTimeout(function () {
                    scrollToSection(sectionUid);
                }, 300);

                updateURL(chapterUid, sectionUid);
            });

            // Check for chapter and section in the URL on page load
            const urlParams = new URLSearchParams(window.location.search);
            const chapterFromUrl = urlParams.get("chapter");
            const sectionFromUrl = urlParams.get("section");

            if (chapterFromUrl && $("#chapter-" + chapterFromUrl).length) {
                loadChapter(chapterFromUrl);
                if (sectionFromUrl) {
                    setTimeout(function () {
                        scrollToSection(sectionFromUrl);
                    }, 500);
                }
            } else {
                @if($book->chapters->count() > 0)
                var firstUid = "{{ $book->chapters[0]->uid }}";
                loadChapter(firstUid);
                @endif
            }
        });
    </script>
@endpush
