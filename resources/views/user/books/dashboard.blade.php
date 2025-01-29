@extends('layouts.master')

@section('content')
    @php
        $user = auth_user('web');
        $data = [
            'total_books' => $total_books ?? 0,
            'genres_count' => $genres_count ?? 0,
            'potential_readers' => $potential_readers ?? 'N/A',
            'book_gallery' => $total_books ?? 0,
        ];
    @endphp

    <div class="row g-4 mb-4">

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="row g-3">
                    @foreach([
                        'Total Books' => ['key' => 'total_books', 'icon' => 'bi-book', 'description' => 'Explore the total number of books you have created.'],
                        'Genres' => ['key' => 'genres_count', 'icon' => 'bi-tags', 'description' => 'Explore the variety of genres in your books.'],
                        'Potential Readers' => ['key' => 'potential_readers', 'icon' => 'bi-people', 'description' => 'Gauge the reach of your books among readers.'],
                        'Book Gallery' => ['key' => 'book_gallery', 'icon' => 'bi-image', 'description' => 'Showcase the visual aspects of your books.'],
                    ] as $title => $info)
                        <div id="{{$info['key']}}" class="col-md-3 d-flex pointer">
                            <div class="i-card border p-3 d-flex flex-column justify-content-between w-100">
                                <div class="icon text--primary mb-30">
                                    <i class="bi {{ $info['icon'] }} fs-30"></i>
                                </div>
                                <div class="content mb-3">
                                    <h4 class="card--title">{{ translate($title) }}</h4>
                                    <p class="fs-24 mb-1">{{ $data[$info['key']] }}</p>
                                </div>
                                <div class="footer">
                                    <p class="mb-0 fs-14">{{ translate($info['description']) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Your Books Section -->
            <div class="col-lg-9 col-md-12">
                <div class="i-card-md card-height-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card--title">{{ translate("Your Books") }}</h4>
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <a href="{{ route('user.book.manager.create') }}"
                               class="i-btn btn--sm btn--primary capsuled">
                                <i class="bi bi-plus-lg"></i>
                                {{ translate("Create New Book") }}
                            </a>
                            <a href="{{ route('user.book.manager.recreate.external') }}"
                               class="i-btn btn--sm btn--outline capsuled">
                                <i class="bi bi-box-arrow-up-right"></i>
                                {{ translate("Recreate External Book") }}
                            </a>
                        </div>

                    </div>
                    <div class="card-body px-0">
                        <div class="table-accordion">
                            @if($books && $books->count() > 0)
                                <div class="accordion" id="bookReports">
                                    @foreach($books as $book)
                                        <div class="accordion-item">
                                            <div class="accordion-header">
                                                <div class="accordion-button collapsed" role="button"
                                                     data-bs-toggle="collapse"
                                                     data-bs-target="#collapse{{ $book->uid }}" aria-expanded="false"
                                                     aria-controls="collapse{{ $book->uid }}">
                                                    <div class="row align-items-center w-100 gy-4 gx-sm-3 gx-0">
                                                        <div class="col-lg-3 col-sm-4 col-12">
                                                            <div class="table-accordion-header transfer-by">
                                                            <span class="icon-btn icon-btn-sm primary circle">
                                                                <i class="bi bi-book"></i>
                                                            </span>
                                                                <div>
                                                                    <h6>{{ translate("Book Title") }}</h6>
                                                                    <p>{{ $book->title }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-4 col-6 text-lg-center text-start">
                                                            <div class="table-accordion-header">
                                                                <h6>{{ translate("Status") }}</h6>
                                                                <p class="{{ $book->status == 'Published' ? 'text--success' : 'text--danger' }}">
                                                                    {{ $book->status }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-4 col-6 text-lg-center text-start">
                                                            <div class="table-accordion-header">
                                                                <h6>{{ translate("Author Name") }}</h6>
                                                                <p>{{ $book->authorProfile->name ?? '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-4 col-6 text-lg-center text-start">
                                                            <div class="table-accordion-header">
                                                                <h6>{{ translate("Language") }}</h6>
                                                                <p>{{ $book->language }}</p>
                                                            </div>
                                                        </div>
                                                        {{--<div class="col-lg-2 col-sm-4 col-6 text-lg-center text-start">
                                                            <div class="table-accordion-header">
                                                                <h6>{{ translate("Created At") }}</h6>
                                                                <p>{{ $book->created_at->format('d M Y') }}</p>
                                                            </div>
                                                        </div>--}}
                                                        <div class="col-lg-1 col-sm-4 col-6 text-lg-end text-start">
                                                            <div class="table-accordion-header">
                                                                <h6>{{ translate("Actions") }}</h6>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('user.book.manager.recreate', $book->uid) }}"
                                                                       class="btn btn-sm btn-secondary mx-1">
                                                                        <i class="bi bi-reply"></i>
                                                                    </a>
                                                                    <a href="{{ route('book.view', $book->uid) }}"
                                                                       class="btn btn-sm btn-info mx-1">
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route('user.book.manager.edit.detail', $book->uid) }}"
                                                                       class="btn btn-sm btn-warning mx-1">
                                                                        <i class="bi bi-pencil"></i>
                                                                    </a>
                                                                    <a href="{{ route('user.book.manager.destroy', $book->uid) }}"
                                                                       class="btn btn-sm btn-danger mx-1">
                                                                        <i class="bi bi-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse{{ $book->uid }}" class="accordion-collapse collapse"
                                                 data-bs-parent="#bookReports">
                                                <div class="accordion-body">
                                                    <p>{{ translate("Additional book details can go here if needed.") }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div>
                                    @include('admin.partials.not_found')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Section -->
            <div class="col-lg-3 col-md-12">

                <div class="i-card upgrade-card mb-4">

                    <h4 class="card--title text-white">
                        {{ translate("Manage Author Profiles") }}
                    </h4>
                    <p>
                        {{ translate("Keep track of your author profiles with ease.") }}
                    </p>

                    <a href="{{ route('user.book.author.list') }}" class="i-btn btn--md btn--white capsuled mx-auto">

                        {{translate('Manage Authors')}}

                    </a>
                </div>

                <div class="i-card h-550">

                    <div class="row g-3">


                        <div class="col-12">
                            <div class="i-card no-border p-0 border position-relative bg--light">
                                <div class="shape-one">
                                    <svg width="65" height="65" viewBox="0 0 65 65" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M52.3006 64.8958L64.4805 64.9922L64.9908 0.510364L0.508992 1.7845e-05L0.412593 12.1799L35.5193 12.4578C45.016 12.533 52.6536 20.2924 52.5784 29.789L52.3006 64.8958Z"
                                              fill="white"/>
                                    </svg>
                                </div>
                                <div class="shape-two">
                                    <svg width="65" height="65" viewBox="0 0 65 65" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M52.3006 64.8958L64.4805 64.9922L64.9908 0.510364L0.508992 1.7845e-05L0.412593 12.1799L35.5193 12.4578C45.016 12.533 52.6536 20.2924 52.5784 29.789L52.3006 64.8958Z"
                                              fill="white"/>
                                    </svg>
                                </div>
                                <span class="icon-image position-absolute top-0 end-0">
                    <div class="icon text--primary mb-30">
                        <i class="bi bi-lightbulb fs-30"></i>
                    </div>
                </span>
                                <div class="p-3">
                                    <h5 class="card--title-sm">{{ translate("Looking for book ideas?") }}</h5>
                                    <p class="mb-3 fs-14">{{ translate("Generate Book Ideas with AI.") }}</p>
                                    <a href="{{ route('user.book.author.list') }}"
                                       class="i-btn btn--sm btn--outline capsuled">
                                        <i class="bi bi-lightbulb-fill"></i>
                                        {{ translate("Generate Ideas") }}
                                    </a>
                                </div>
                            </div>


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
            // Handle the button click event
            $('#book_gallery').on('click', function (e) {
                window.location.href = "{{route('user.book.gallery')}}";
            });
        });
    </script>
@endpush
