@extends('layouts.master')
@section('content')
    <div class="i-card-md">
        <div class="card-body">
            <div class="search-action-area">
                <div class="row g-3">
                    <div class="col-md-6 d-flex justify-content-start gap-2">
                        <div class="action">
                            <a href="{{ route('user.book.author.create')}}"
                               class="i-btn btn--sm success">
                                <i class="las la-plus me-1"></i> {{translate('Add New')}}
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="search-area">
                            <form action="{{route(Route::currentRouteName())}}" method="get">
                                <div class="form-inner">
                                    <input name="search" value="{{request()->input('search')}}" type="search"
                                           placeholder="{{translate('Search by Name')}}">
                                </div>
                                <button class="i-btn btn--sm info">
                                    <i class="las la-sliders-h"></i>
                                </button>
                                <a href="{{route(Route::currentRouteName())}}" class="i-btn btn--sm danger">
                                    <i class="las la-sync"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mt-4">
                <div class="row">
                    @forelse ($profiles as $author)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-md">
                                <div class="card-body text-center">
                                    <div class="d-flex flex-column align-items-center  mb-3">
                                        @if ($author->image)
                                            <img src="{{  asset('storage/' . $author->image) }}"
                                                 alt="{{ $author->name }}"
                                                 class="rounded-circle-text rounded-circle shadow-md">
                                        @else
                                            <div
                                                class="rounded-circle-text rounded-circle shadow-md d-flex align-items-center justify-content-center bg-secondary text-white">
                                                {{ strtoupper(substr($author->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <h5 class="card-title mb-3">{{ $author->name }}</h5>

                                        <div class="d-flex flex-row gap-4 mb-3">
                                            <div class="badge bg-primary text-white">{{ $author->style }}</div>
                                            <div class="badge bg-dark text-white">{{ $author->style }}</div>
                                        </div>

                                        <p class="text-muted text-center" style="min-height: 100px;">
                                            <span
                                                class="short-text">{{ Str::limit($author->biography, 150, '...') }}</span>
                                            <span class="full-text d-none">{{ $author->biography }}</span>
                                        </p>

                                        @if(strlen($author->biography) > 150)
                                            <button class="toggle-text btn btn-link p-0 text-primary">Read More</button>
                                        @endif

                                    </div>
                                    <div class="mt-3 d-flex justify-content-center gap-2">
                                        <a href="{{ route('user.book.author.edit', $author->uid) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Edit Profile
                                        </a>
                                        <form action="{{ route('user.book.author.destroy', $author->uid) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                        <a href="{{ route('user.book.author.show', $author->uid) }}"
                                           class="btn btn-sm btn-outline-dark">
                                            <i class="bi bi-eye"></i> View Page
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td class="border-bottom-0" colspan="7">
                                @include('user.partials.not_found',['custom_message' => "No Authors Profile found!!"])
                            </td>
                        </tr>
                    @endforelse

                    <div class="Paginations">
                        {{ $profiles->links() }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('modal')
    @include('modal.delete_modal')
@endsection

@push('script-push')
    <script nonce="{{ csp_nonce() }}">
        (function ($) {
            "use strict";
            $(".toggle-text").click(function () {
                let parent = $(this).closest(".card-body");
                let shortText = parent.find(".short-text");
                let fullText = parent.find(".full-text");

                if (fullText.hasClass("d-none")) {
                    shortText.addClass("d-none");
                    fullText.removeClass("d-none");
                    $(this).text("Show Less");
                } else {
                    shortText.removeClass("d-none");
                    fullText.addClass("d-none");
                    $(this).text("Read More");
                }
            });

        })(jQuery);
    </script>
@endpush







