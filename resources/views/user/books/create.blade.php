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
                                            <select name="genre" id="genre" class="form-control">
                                                @foreach ($genres as $genre)
                                                    <option value="{{ $genre }}">{{ $genre }}</option>
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
                                <!-- About Author -->
                                <div class="form-group mb-4">
                                    <label for="about_author"
                                           class="form-label">{{ translate("About Author:") }}</label>
                                    <textarea name="about_author" id="about_author" rows="5" class="form-control"
                                              placeholder="{{ translate("Details about Author.") }}"></textarea>

                                </div>

                                <!-- book synopsis -->
                                <div class="form-group mb-4">
                                    <label for="book_synopsis"
                                           class="form-label">{{ translate("Book Synopsis:") }}</label>
                                    <textarea name="book_synopsis" id="book_synopsis" rows="7" class="form-control"
                                              placeholder="{{ translate("Details about book.") }}"></textarea>

                                </div>

                                <div class="form-group mb-4">
                                    <button type="button" id="book_outline"
                                            class="i-btn btn--primary btn--sm  step-btn">{{ translate("Generate Book Outline") }}</button>
                                </div>

                            </div>

                            <div id="step3" class="d-none">

                                <h6 class="mt-3">Book Details:</h6>

                                <button type="button" id="add-chapter" class="btn btn-primary">Add Chapter</button>

                                <div id="chapters-container">
                                    <!-- Chapters will be appended here dynamically -->
                                </div>

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
            let chapterCount = 0;

            $('#generate_synopsis').on('click', function () {
                // Collect form data
                let formData = {
                    title: $('#title').val(),
                    author_profile_id: $('#authorProfile').val(),
                    genre: $('#genre').val(),
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
                            $('#title').val(response.data.title);
                            $('#about_author').val(response.data.author);
                            $('#book_synopsis').val(response.data.synopsis);

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
                    about_author: $('#about_author').val(),
                    book_synopsis: $('#book_synopsis').val(),
                    title: $('#title').val(),
                    language: $('#language').val(),
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
                            if (response.data.chapters.length > 0) {
                                $('#chapters-container').empty(); // Clear existing content
                                loadBookData(response.data);

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

            // Function to load the content into the form
            function loadBookData(data) {
                // Set the title
                $('#book-form').prepend(`
                    <h2>${data.title}</h2>
                    <p>${data.introduction.content}</p>
                `);

                // Loop through chapters and create them
                data.chapters.forEach((chapter, index) => {
                    const chapterHTML = createChapter(index, chapter);
                    $('#chapters-container').append(chapterHTML);
                });

                // Set conclusion content
                $('#book-form').append(`
                        <p>${data.conclusion.content}</p>
                    `);
            }

            // Function to create a chapter template
            function createChapter(chapterIndex) {
                return `
                        <div class="chapter" data-chapter-index="${chapterIndex}">
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-medium">${chapterIndex + 1}.</span>
                                <input type="text" name="chapters[${chapterIndex}].title" placeholder="Chapter Title" class="chapter-title">
                                <button type="button" class="delete-chapter btn btn-danger">Delete Chapter</button>
                            </div>

                            <div class="sections-container" id="sections-${chapterIndex}">
                                <!-- Sections will be appended here dynamically -->
                            </div>

                            <button type="button" class="add-section btn btn-secondary">Add Section</button>
                        </div>`;
            }

            // Function to create a section template
            function createSection(chapterIndex, sectionIndex) {
                return `
                        <div class="section" data-section-index="${sectionIndex}">
                            <div class="flex items-center justify-between">
                                <span class="font-medium">${sectionIndex + 1}.</span>
                                <input type="text" name="chapters[${chapterIndex}].sections[${sectionIndex}].title" placeholder="Section Title" class="section-title">
                                <button type="button" class="delete-section btn btn-warning">Delete Section</button>
                            </div>
                        </div>`;
            }

            // Add a new chapter
            $('#add-chapter').click(function () {
                chapterCount++;
                const chapterHTML = createChapter(chapterCount - 1);
                $('#chapters-container').append(chapterHTML);
            });

            // Add a new section to a chapter
            $(document).on('click', '.add-section', function () {
                const chapterIndex = $(this).closest('.chapter').data('chapter-index');
                const sectionCount = $(`#sections-${chapterIndex} .section`).length;
                const sectionHTML = createSection(chapterIndex, sectionCount);
                $(`#sections-${chapterIndex}`).append(sectionHTML);
                reNumberSections(chapterIndex);  // Renumber sections after adding
            });

            // Delete a chapter and its sections
            $(document).on('click', '.delete-chapter', function () {
                const chapterIndex = $(this).closest('.chapter').data('chapter-index');
                $(this).closest('.chapter').remove();
                reNumberChapters();  // Renumber chapters after deletion
            });

            // Delete a section
            $(document).on('click', '.delete-section', function () {
                const chapterIndex = $(this).closest('.chapter').data('chapter-index');
                const sectionIndex = $(this).closest('.section').data('section-index');
                $(this).closest('.section').remove();
                reNumberSections(chapterIndex);  // Renumber sections after deletion
            });

            // Insert a new section after the clicked section
            $(document).on('click', '.add-section', function () {
                const chapterIndex = $(this).closest('.chapter').data('chapter-index');
                const sectionIndex = $(this).closest('.section').data('section-index');
                // Create a new section after the clicked section
                const newSectionHTML = createSection(chapterIndex, sectionIndex + 1);
                $(`#sections-${chapterIndex}`).append(newSectionHTML);
            });

            // Function to renumber sections after add/delete
            function reNumberSections(chapterIndex) {
                $(`#sections-${chapterIndex} .section`).each(function (index) {
                    $(this).find('span').text(index + 1 + '.');
                    $(this).data('section-index', index); // Update section index
                });
            }

            // Function to renumber chapters after add/delete
            function reNumberChapters() {
                $('#chapters-container .chapter').each(function (index) {
                    $(this).find('span').text(index + 1 + '.');  // Renumber chapter numbers
                    $(this).data('chapter-index', index);  // Update chapter index
                });
            }

        });
    </script>
@endpush

