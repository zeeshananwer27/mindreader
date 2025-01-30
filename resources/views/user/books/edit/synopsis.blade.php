@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="row mt-5">
            <div class="i-card-md">
                <div class="card-body">
                    <div id="step1">
                        <div class="form-group mb-4">
                            <label for="authorProfile" class="form-label">{{ translate("Book Title") }}</label>
                            <input type="text" value="{{$book->title}}" id="title" name="title" disabled/>
                        </div>

                    </div>
                    <!-- About Author -->
                    <div class="form-group mb-4">
                        <label for="about_author"
                               class="form-label">{{ translate("About Author:") }}</label>
                        <textarea name="about_author" id="about_author" rows="5" class="form-control"
                                  placeholder="{{ translate("Details about Author.") }}" disabled>{{$book->about_author}}</textarea>

                    </div>

                    <!-- book synopsis -->
                    <div class="form-group mb-4">
                        <label for="book_synopsis"
                               class="form-label">{{ translate("Book Synopsis:") }}</label>
                        <textarea name="book_synopsis" id="book_synopsis" rows="7" class="form-control"
                                  placeholder="{{ translate("Details about book.") }}" disabled>{{$book->synopsis}}</textarea>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script-push')

    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {
        });
    </script>
@endpush

