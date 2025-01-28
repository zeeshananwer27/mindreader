@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row g-4">
            <!-- Left Column: Form -->
            <div class="col-lg-8">
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
                                    <small
                                        class="text-muted">{{ translate("Select an author profile for the book.") }}</small>
                                </div>

                                <!-- Language -->
                                <div class="form-group mb-4">
                                    <label for="language"
                                           class="form-label">{{ translate("What is the language of the book?") }}</label>
                                    <select name="language" id="language" class="form-control">
                                        @foreach ($book_languages as $language)
                                            <option value="{{ $language }}">{{ $language }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">{{ translate("Select a language for the book.") }}</small>
                                </div>

                                <!-- Personal -->
                                <div class="form-group mb-4">
                                    <label for="isPersonal"
                                           class="form-label">{{ translate("Is this book for you personally or your audience?") }}</label>
                                    <select name="isPersonal" id="isPersonal" class="form-control">
                                        <option value="audience">{{ translate("Audience") }}</option>
                                        <option value="personal">{{ translate("Personal") }}</option>
                                    </select>
                                    <small class="text-muted">{{ translate("Select a book generated for.") }}</small>
                                </div>

                                <!-- change -->
                                <div class="form-group mb-4">
                                    <label for="change"
                                           class="form-label">{{ translate("What do you want changed about this book?") }}</label>
                                    <textarea name="change" id="change" rows="3" class="form-control"
                                              placeholder="{{ translate("An example might be to educate and inform college students on how to find a job out of college.") }}"></textarea>
                                    <small
                                        class="text-muted">{{ translate("Please describe the changes you wanted to make to the existing book.") }}</small>
                                </div>

                                <!-- Target Audience -->
                                <div class="form-group mb-4">
                                    <label for="targetAudience"
                                           class="form-label">{{ translate("Who is the target audience?") }}</label>
                                    <textarea name="target_audience" id="targetAudience" rows="3" class="form-control"
                                              placeholder="{{ translate("Define the target audience.") }}"></textarea>
                                    <small
                                        class="text-muted">{{ translate("Define who this book is written to.") }}</small>
                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" id="generate_synopsis"
                                            class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Synopsis") }}</button>
                                    <small class="text-muted">{{ translate("key require.") }}</small>
                                </div>

                            </div>

                            <div id="step2" class="d-none">
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">{{ translate("Book Title") }}</label>
                                    <input type="text" id="title" name="title"/>
                                </div>

                                <!-- About Auther -->
                                <div class="form-group mb-4">
                                    <label for="aboutauther" class="form-label">{{ translate("About Author:") }}</label>
                                    <textarea name="aboutauther" id="aboutauther" rows="5" class="form-control"
                                              placeholder="{{ translate("Details about author.") }}"></textarea>

                                </div>

                                <!-- book synopsis -->
                                <div class="form-group mb-4">
                                    <label for="booksynopsis"
                                           class="form-label">{{ translate("Book Synopsis:") }}</label>
                                    <textarea name="booksynopsis" id="booksynopsis" rows="7" class="form-control"
                                              placeholder="{{ translate("Details about book.") }}"></textarea>

                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" id="book_outline"
                                            class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Book Outline") }}</button>
                                    <small class="text-muted">{{ translate("key require.") }}</small>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right Column: Steps to Generate Book -->
            <div class="col-xl-4">
                <div class="sticky sticky-top">

                    <div class="i-card h-100">
                        <div class="p-3">
                            <h4 class="card--title">{{ translate("Steps to Recreate Book") }}</h4>
                            <div class="mb-3 mt-3">
                                <h5 class="card--title-sm">{{ translate("Step 1: Book Details") }}</h5>
                                <p class="fs-14">{{ translate("Provide book details like author profile, purpose, and more.") }}</p>
                                <button id="complete-step-1"
                                        class="i-btn btn--primary btn--sm capsuled step-btn">{{ translate("Next Step") }}</button>
                            </div>
                            <div class="mb-3">
                                <h5 class="card--title-sm">{{ translate("Step 2: Book Synopsis") }}</h5>
                                <p class="fs-14">{{ translate("Generate a synopsis for your book with AI assistance.") }}</p>
                                <button id="complete-step-2" class="i-btn btn--outline btn--sm capsuled step-btn"
                                        disabled>{{ translate("Locked") }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
<!-- jQuery AJAX Script -->
<!-- jQuery Script -->

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
                $('#generate_synopsis').prop('disabled', true).text('{{ translate("Generating...") }}');

                // Perform AJAX request
                $.ajax({
                    url: '{{ route("user.book.manager.synopsis.generate") }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#generate_synopsis').prop('disabled', false).text('{{ translate("Generate Synopsis") }}');

                        if (response.status) {
                            // Populate the synopsis field in step 2
                            $('#title').val("{{$book->title}}");
                            $('#aboutauther').val(response.data.title);
                            $('#booksynopsis').val(response.data.synopsis);

                            // Show step 2
                            $('#step2').removeClass('d-none').fadeIn();
                            $('#complete-step-2')
                                .prop('disabled', false)
                                .removeClass('btn--outline')
                                .addClass('btn--primary')
                                .text('Next Step');
                        } else {
                            $('#book_outline').prop('disabled', false).text('{{ translate("Generate Book Outline") }}');
                            toastr(response.message || '{{ translate("Something went wrong. Please try again.") }}', 'danger')
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#book_outline').prop('disabled', false).text('{{ translate("Generate Book Outline") }}');
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
                $('#book_outline').prop('disabled', true).text('{{ translate("Generating...") }}');

                // Perform AJAX request
                $.ajax({
                    url: '{{route('user.book.manager.recreate.store', $book->id)}}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#book_outline').prop('disabled', false).text('{{ translate("Generate Book Outline") }}');

                        if (response.status) {
                            toastr(response.message, 'success')
                            window.location.href = "{{route('user.book.dashboard')}}";
                        } else {
                            toastr(response.message || '{{ translate("Something went wrong. Please try again.") }}', 'danger')
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#book_outline').prop('disabled', false).text('{{ translate("Generate Book Outline") }}');
                        toastr('{{ translate("An error occurred. Please try again") }}', 'danger')
                        console.error("Error: " + error);
                    }
                });
            });

        });
    </script>
@endpush

