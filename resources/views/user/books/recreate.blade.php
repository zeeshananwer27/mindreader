@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="row">
            <div class="steps-wrapper">
                <div class="container pt-2">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-12">
                            <div class="steps-container">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="step-item text-center">
                                        <button id="complete-step-1"
                                                class="i-btn btn--primary btn--sm capsuled step-btn">
                                            {{ translate("1: Book Details") }}
                                        </button>
                                    </div>
                                    <div class="step-line"></div>
                                    <div class="step-item text-center">
                                        <button id="complete-step-2"
                                                class="i-btn btn--outline btn--sm capsuled step-btn" disabled>
                                            {{ translate("2: Book Synopsis") }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Left Column: Form -->
            <div class="col-lg-12">
                <form id="generate_data" method="POST">
                    @csrf
                    <div class="i-card-md">
                        <div class="card-header">
                            <h4 class="card--title text-center">{{ translate("Recreate Your Book") }}</h4>
                            <p class="text-center fs-14">{{ translate("Fill in the form below and click next to recreate your book.") }}</p>
                        </div>
                        <div class="card-body">
                            <div id="step1">
                                <!-- Author Profile -->
                                <div class="form-group mb-4">
                                    <label for="authorProfile"
                                           class="form-label">{{ translate("Author Profile") }}</label>
                                    <select name="author_profile_id" id="authorProfile" class="form-control">
                                        @foreach ($authorProfiles as $profile)
                                            <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Language -->
                                        <div class="form-group mb-4">
                                            <label for="language"
                                                   class="form-label">{{ translate("What is the language of the book?") }}</label>
                                            <select name="language" id="language" class="form-control">
                                                @foreach ($book_languages as $language)
                                                    <option value="{{ $language }}">{{ $language }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Personal -->
                                        <div class="form-group mb-4">
                                            <label for="isPersonal"
                                                   class="form-label">{{ translate("Is this book for you personally or your audience?") }}</label>
                                            <select name="isPersonal" id="isPersonal" class="form-control">
                                                <option value="audience">{{ translate("Audience") }}</option>
                                                <option value="personal">{{ translate("Personal") }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Change -->
                                <div class="form-group mb-4">
                                    <label for="change"
                                           class="form-label">{{ translate("What do you want changed about this book?") }}</label>
                                    <textarea name="change" id="change" rows="3" class="form-control"
                                              placeholder="{{ translate("An example might be to educate and inform college students on how to find a job out of college.") }}"></textarea>
                                </div>

                                <!-- Target Audience -->
                                <div class="form-group mb-4">
                                    <label for="targetAudience"
                                           class="form-label">{{ translate("Who is the target audience?") }}</label>
                                    <textarea name="target_audience" id="targetAudience" rows="3" class="form-control"
                                              placeholder="{{ translate("Define the target audience.") }}"></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" id="generate_synopsis"
                                            class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Synopsis") }}</button>
                                </div>

                            </div>

                            <div id="step2" class="d-none">
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">{{ translate("Book Title") }}</label>
                                    <input type="text" id="title" name="title" class="form-control"/>
                                </div>

                                <!-- About Author -->
                                <div class="form-group mb-4">
                                    <label for="aboutauther" class="form-label">{{ translate("About Author:") }}</label>
                                    <textarea name="aboutauther" id="aboutauther" rows="5" class="form-control"
                                              placeholder="{{ translate("Details about author.") }}"></textarea>
                                </div>

                                <!-- Book Synopsis -->
                                <div class="form-group mb-4">
                                    <label for="booksynopsis"
                                           class="form-label">{{ translate("Book Synopsis:") }}</label>
                                    <textarea name="booksynopsis" id="booksynopsis" rows="7" class="form-control"
                                              placeholder="{{ translate("Details about book.") }}"></textarea>
                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" id="book_outline"
                                            class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Book Outline") }}</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script-push')

    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {

            $('#generate_synopsis').on('click', function () {
                // Collect form data
                let formData = {
                    title: "{{$book->title}}",
                    length: "{{$book->length}}",
                    author_profile_id: $('#authorProfile').val(),
                    language: $('#language').val(),
                    is_personal: $('#isPersonal').val(),
                    purpose: $('#change').val(),
                    target_audience: $('#targetAudience').val(),
                    _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel security
                };

                // Disable button and show loading state
                $('#generate_synopsis').prop('disabled', true);
                showLoadingSwal("{{translate('Generating synopsis only for you')}}");

                // Perform AJAX request
                $.ajax({
                    url: '{{ route("user.book.manager.synopsis.generate") }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#generate_synopsis').prop('disabled', false);
                        hideLoadingSwal();

                        if (response.status) {
                            // Populate the synopsis field in step 2
                            $('#title').val("{{$book->title}}");
                            $('#aboutauther').val(response.data.title);
                            $('#booksynopsis').val(response.data.synopsis);

                            // Show step 2
                            $('#step2').removeClass('d-none');
                            $('#step1').addClass('d-none');

                            $('#complete-step-2')
                                .prop('disabled', false)
                                .removeClass('btn--outline')
                                .addClass('btn--primary');
                        } else {
                            $('#book_outline').prop('disabled', false);
                            toastr(response.message || '{{ translate("Something went wrong. Please try again.") }}', 'danger')
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#book_outline').prop('disabled', false);
                        hideLoadingSwal();
                        toastr('{{ translate("An error occurred. Please try again") }}', 'danger')
                        console.error("Error: " + error);
                    }
                });
            });

            $('#book_outline').on('click', function () {

                // Collect form data
                let formData = {
                    title: $('#title').val(),
                    length: "{{$book->length}}",
                    aboutauther: $('#aboutauther').val(),
                    booksynopsis: $('#booksynopsis').val(),
                    author_profile_id: $('#authorProfile').val(),
                    language: $('#language').val(),
                    is_personal: $('#isPersonal').val(),
                    change: $('#change').val(),
                    target_audience: $('#targetAudience').val(),
                    _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel security
                };

                // Disable button and show loading state
                $('#book_outline').prop('disabled', true);
                showLoadingSwal("{{translate('Doing Magic')}}");

                // Perform AJAX request
                $.ajax({
                    url: '{{route('user.book.manager.recreate.store', $book->id)}}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#book_outline').prop('disabled', false);
                        hideLoadingSwal();

                        if (response.status) {
                            toastr(response.message, 'success')
                            window.location.href = "{{route('user.book.dashboard')}}";
                        } else {
                            toastr(response.message || '{{ translate("Something went wrong. Please try again.") }}', 'danger')
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#book_outline').prop('disabled', false);

                        hideLoadingSwal();
                        toastr('{{ translate("An error occurred. Please try again") }}', 'danger')
                        console.error("Error: " + error);
                    }
                });
            });

        });
    </script>
@endpush
