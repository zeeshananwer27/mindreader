@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex flex-wrap gap-4">
            @foreach($books as $book)
                <div class="border book-card card position-relative shadow-sm overflow-hidden radius-8">
                    <div class="relative">
                        <a href="{{ route('user.book.manager.show', $book->id) }}">
                            <div class="position-relative d-flex flex-row rounded-end-2">
                                <div class="rounded-end-2">
                                    <img
                                        src="https://i.pinimg.com/originals/0b/45/fb/0b45fb8b19aeedc4150bf3d3559fe86d.jpg"
                                        alt="{{ $book->title }}"
                                        width="210" height="295" class="object-fit-cover h-full" loading="lazy">
                                </div>
                            </div>
                        </a>
                        <div class="position-absolute end-0 top-0">
                            <div
                                class="badge bg-primary px-2 py-1 d-inline-flex align-items-center radius-8 border fw-semibold border-0 link-opacity-10-hover">
                                {{ $book->genre }}
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('user.book.manager.show', $book->id) }}">
                        <div class="p-3">
                            <h6 class="fw-semibold line-clamp-2 text-truncate">{{ $book->title }}</h6>
                            <p class="text-muted small mt-1">By <span class="text-primary">{{ $book->authorProfile->name }}</span>
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                {{ $books->links() }} <!-- Add pagination links -->
            </div>
        </div>
    </div>
@endsection
