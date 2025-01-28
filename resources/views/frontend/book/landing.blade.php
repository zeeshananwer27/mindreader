@extends('layouts.master')
@section('content')

    @include("frontend.partials.breadcrumb")

    <section class="service-details-section pb-110">
        <div class="container">
            <div class="container-fluid p-4">
                <div class="row mb-2 gy-4">
                    <!-- Left Column -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card border shadow-sm">
                            <div class="card-body p-4">
                                <div class="position-relative overflow-hidden rounded-lg mb-4">
                                    <img
                                        src="{{ $book->cover_image ?? asset('assets/images/global/books/php-book-pic.jpeg') }}"
                                        alt="{{ $book->title }}"
                                        class="img-fluid object-cover w-100"
                                        loading="lazy"
                                    />
                                    {{--                                    <p class="position-absolute top-50 start-0 translate-middle-y text-light fs-5 ms-2">--}}
                                    {{--                                        {{ $book->title }}--}}
                                    {{--                                    </p>--}}
                                    <p class="position-absolute bottom-0 start-0 text-light fs-6 ms-2">{{ $book->author_name }}</p>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <button
                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-download"></i> Download
                                    </button>
                                    <a
                                        href="/books/{{ $book->uid }}/audio"
                                        class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2"
                                    >
                                        <i class="bi bi-play-fill"></i> Audio Book
                                    </a>
                                    <div class="d-flex gap-2">
                                        <button
                                            class="btn btn-outline-secondary flex-1 d-flex align-items-center justify-content-center gap-2">
                                            <i class="bi bi-share-fill"></i> Share
                                        </button>
                                        <a
                                            href="/books/{{ $book->uid }}/preview?cover=true"
                                            class="btn btn-outline-secondary flex-1 d-flex align-items-center justify-content-center gap-2"
                                        >
                                            <i class="bi bi-eye-fill"></i> Online Preview
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="row gy-4">
                            <!-- Title and Rating -->
                            <div class="col-12">
                                <h2 class="fw-bold text-center text-md-start">
                                    {{ $book->title }}
                                </h2>
                                <div
                                    class="d-flex align-items-center gap-2 mt-3 justify-content-center justify-content-md-start">
                                    <div>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </div>
                                    <p class="text-muted mb-0">0 reviews</p>
                                </div>
                            </div>

                            <!-- Book Details -->
                            <div class="col-12">
                                <div class="card border shadow-sm">
                                    <div class="row row-cols-2 row-cols-md-4 p-3">
                                        <div>
                                            <p class="text-muted">Chapters</p>
                                            <p class="fs-5 fw-semibold">{{$book->chapters_count}}</p>
                                        </div>
                                        <div>
                                            <p class="text-muted">Language</p>
                                            <p class="fs-5 fw-semibold">{{ $book->language ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-muted">Genre</p>
                                            <span class="badge mt-2 bg-secondary">{{ $book->genre ?? 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <p class="text-muted">Purpose</p>
                                            <p class="fs-5 fw-semibold">{{ $book->purpose ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Synopsis -->
                            <div class="col-12">
                                <h4 class="fw-semibold">Synopsis</h4>
                                <p class="text-muted mt-3 text-justify">
                                    {{ $book->synopsis ?? 'No synopsis available.' }}
                                </p>
                            </div>

                            <!-- About the Author -->
                            <div class="col-12">
                                <div class="card border shadow-sm">
                                    <div class="card-body">
                                        <h5 class="fw-semibold">About the Author</h5>
                                        <div class="d-flex gap-4 mt-3">
                                            <div
                                                class="rounded-circle h-16 w-16 bg-light d-flex justify-content-center align-items-center">
                                                {{ $book->author_name[0] ?? 'A' }}
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="fw-bold mb-1">{{ $book->author_name }}</h5>
                                                <p class="text-muted mb-0 text-justify">
                                                    {{ $book->about_author ?? 'No information about the author.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h3>More Books by the Author</h3>
                                <div class="row g-3 mt-3">
                                    @foreach ($relatedBooks as $relatedBook)
                                        <div
                                            class="border col-6 col-md-3 mx-2 card position-relative shadow-sm overflow-hidden radius-8">
                                            <div class="relative">
                                                <a href="{{ route('book.landing', $relatedBook->uid) }}">
                                                    <div class="position-relative d-flex flex-row rounded-end-2">
                                                        <div class="rounded-end-2">
                                                            <img
                                                                src="https://i.pinimg.com/originals/0b/45/fb/0b45fb8b19aeedc4150bf3d3559fe86d.jpg"
                                                                alt="{{ $relatedBook->title }}"
                                                                width="210" height="295" class="object-fit-cover h-full"
                                                                loading="lazy">
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="position-absolute end-0 top-0">
                                                    <div
                                                        class="badge bg-primary px-2 py-1 d-inline-flex align-items-center radius-8 border fw-semibold border-0 link-opacity-10-hover">
                                                        {{ $relatedBook->genre }}
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route('book.landing', $relatedBook->uid) }}">
                                                <div class="p-3">
                                                    <h6 class="fw-semibold line-clamp-2 text-truncate">{{ $relatedBook->title }}</h6>
                                                    <p class="text-muted small mt-1">By <span
                                                            class="text-primary">{{ $relatedBook->authorProfile->name }}</span>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Create Your Book -->
                <div class="col-12 text-center mt-5">
                    <div class="bg-light p-4 rounded">
                        <h4 class="fw-bold">Create Your Own Book</h4>
                        <p class="text-muted mb-4">
                            Inspired by what you've read? Turn your ideas into reality with FastRead's
                            AI-powered book creation tool.
                        </p>
                        <a href="/home/books/create"
                           class="btn btn-primary d-inline-flex justify-content-center align-items-center gap-2">
                            <i class="bi bi-book"></i> Start Writing Now
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
