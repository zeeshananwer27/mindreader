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
                                    <div class="step-line"></div>
                                    <div class="step-item text-center">
                                        <button id="complete-step-3"
                                                class="i-btn btn--outline btn--sm capsuled step-btn" disabled>
                                            {{ translate("3: Book Outline") }}
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
                <form id="generate_data" action="{{route('user.book.manager.store')}}" method="POST">
                    @csrf
                    <div class="i-card-md">
                        <div class="card-header">
                            <h4 class="card--title text-center">{{ translate("Create Your Book") }}</h4>
                            <p class="text-center fs-14">{{ translate("Complete the steps to Generate your magical ai book.") }}</p>
                        </div>
                        <div class="card-body">
                            <div id="step1">
                                <div class="form-group mb-4">
                                    <label for="authorProfile" class="form-label">{{ translate("Book Title") }}</label>
                                    <input type="text" id="title" name="title"/>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="authorProfile"
                                                   class="form-label">{{ translate("Author Profile") }}</label>
                                            <select name="author_profile_id" id="authorProfile" class="form-control">
                                                @foreach ($authorProfiles as $profile)
                                                    <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="genre"
                                                   class="form-label">{{ translate("What is the genre of the book?") }}</label>
                                            <select name="genre_id" id="genre" class="form-control">
                                                @foreach ($genres as $key => $genre)
                                                    <option value="{{ $key }}">{{ $genre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purpose -->
                                <div class="form-group mb-4">
                                    <label for="purpose"
                                           class="form-label">{{ translate("What is the purpose of the book?") }}</label>
                                    <textarea name="purpose" id="purpose" rows="3" class="form-control"
                                              placeholder="{{ translate("Describe the book's purpose.") }}"></textarea>
                                </div>

                                <!-- Target Audience -->
                                <div class="form-group mb-4">
                                    <label for="targetAudience"
                                           class="form-label">{{ translate("Who is the target audience?") }}</label>
                                    <textarea name="target_audience" id="targetAudience" rows="3" class="form-control"
                                              placeholder="{{ translate("Define the target audience.") }}"></textarea>
                                </div>


                                <!-- Book Length & Language -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="length"
                                                   class="form-label">{{ translate("What is the length of the book?") }}</label>
                                            <select name="length" id="length" class="form-control">
                                                <option value="small">{{ translate("Small Book") }}</option>
                                                <option value="medium">{{ translate("Medium Book") }}</option>
                                                <option value="large">{{ translate("Large Book") }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" id="generate_synopsis"
                                            class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Synopsis") }}</button>
                                </div>

                            </div>

                            <div id="step2" class="d-none">
                                <!-- About Auther -->
                                <div class="form-group mb-4">
                                    <label for="aboutauther" class="form-label">{{ translate("About Auther:") }}</label>
                                    <textarea name="aboutauther" id="aboutauther" rows="5" class="form-control"
                                              placeholder="{{ translate("Details about auther.") }}"></textarea>

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
                                </div>

                            </div>

                            <div id="step3" class="d-none">

                                <h6 class="mt-3">Book Details:</h6>
                                <input hidden="hidden" id="chapters" name="chapters" type="text">
                                <div id="chapters-container"></div>
                                <button type="submit" id="save_details"
                                        class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Book Using AI Magic") }}</button>
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

            // Handle the button click event
            $('#save_details').on('click', function (e) {
                e.preventDefault();  // Prevent the form from submitting normally

                // Serialize the form data (this will include the CSRF token)
                var formData = $('#generate_data').serialize();

                // Disable the button to prevent multiple submissions
                $('#save_details').prop('disabled', true);
                showLoadingSwal("{{translate('Doing Magic')}}");
                // Perform the AJAX POST request
                $.ajax({
                    url: '{{ route('user.book.manager.store') }}',
                    type: 'POST',  // HTTP method (POST)
                    data: formData,  // Form data to be sent
                    success: function (response) {
                        // Enable the button back and reset the text
                        $('#save_details').prop('disabled', false);
                        hideLoadingSwal();
                        // Check if the response indicates success
                        if (response.status) {
                            toastr(response.message, 'success')
                            window.location.href = "{{route('user.book.dashboard')}}";
                        } else {
                            // If there's an error in the response, display the error message
                            alert(response.message || '{{ translate("Something went wrong. Please try again.") }}');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle any errors that occurred during the AJAX request
                        $('#save_details').prop('disabled', false);
                        hideLoadingSwal();
                        alert('{{ translate("An error occurred. Please try again.") }}');
                        console.error("Error: " + error);
                    }
                });
            });

            $('#generate_synopsis').on('click', function () {

                // Collect form data
                let formData = {
                    title: $('#title').val(),
                    author_profile_id: $('#authorProfile').val(),
                    genre_id: $('#genre').val(),
                    purpose: $('#purpose').val(),
                    target_audience: $('#targetAudience').val(),
                    length: $('#length').val(),
                    language: $('#language').val(),
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
                            $('#aboutauther').val(response.data.title);
                            $('#booksynopsis').val(response.data.synopsis);

                            // Show step 2
                            $('#step1').addClass('d-none');
                            $('#step2').removeClass('d-none');
                            $('#complete-step-2')
                                .prop('disabled', false)
                                .removeClass('btn--outline')
                                .addClass('btn--primary');
                        } else {
                            alert(response.message || '{{ translate("Something went wrong. Please try again.") }}');
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#generate_synopsis').prop('disabled', false);
                        hideLoadingSwal();
                        alert('{{ translate("An error occurred. Please try again.") }}');
                        console.error("Error: " + error);
                    }
                });
            });

            $('#book_outline').on('click', function () {

                // Collect form data
                let formData = {
                    aboutauther: $('#aboutauther').val(),
                    booksynopsis: $('#booksynopsis').val(),
                    _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel security
                };

                // Disable button and show loading state
                $('#book_outline').prop('disabled', true);

                // Perform AJAX request
                $.ajax({
                    url: '{{ route("user.book.manager.outline.generate") }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        $('#book_outline').prop('disabled', false);
                        hideLoadingSwal();

                        if (response.status) {

                            // Show step 3
                            $('#step3').removeClass('d-none');
                            $('#step2').addClass('d-none');
                            $('#complete-step-3')
                                .prop('disabled', false)
                                .removeClass('btn--outline')
                                .addClass('btn--primary');
                            if (response.data.length > 0) {
                                $('#chapters-container').empty(); // Clear existing content

                                $('#chapters').val(JSON.stringify(response.data));

                                // Loop through the chapters array and generate HTML
                                $.each(response.data, function (index, chapter) {
                                    var chapterId = 'chapter' + index;

                                    var chapterHtml = `
                                            <div class="card mb-3">
                                                <div class="fw-bold px-3 py-2 border-bottom"
                                                     data-bs-toggle="collapse"
                                                     data-bs-target="#${chapterId}"
                                                     aria-expanded="false"
                                                     aria-controls="${chapterId}"
                                                     role="button">
                                                    ${chapter.title}
                                                </div>
                                                <div id="${chapterId}" class="collapse">
                                                    <div class="p-3">
                                                        ${chapter.content}
                                                    </div>
                                                </div>
                                            </div>
                                        `;

                                    // Append generated HTML to the container
                                    $('#chapters-container').append(chapterHtml);
                                });
                            } else {
                                $('#chapters-container').html('<p class="text-danger">No chapters available.</p>');
                            }

                        } else {
                            alert(response.message || '{{ translate("Something went wrong. Please try again.") }}');
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#chapters-container').html('<p class="text-danger">Failed to load chapters. Please try again later.</p>');
                        $('#book_outline').prop('disabled', false);
                        hideLoadingSwal();
                        alert('{{ translate("An error occurred. Please try again.") }}');
                        console.error("Error: " + error);
                    }
                });
            });

        });
    </script>
@endpush

