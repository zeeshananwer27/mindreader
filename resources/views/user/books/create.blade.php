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

                                <div class="h3 mb-3" id="book-title"></div>
                                <div id="chapters-container" class="chapters-container mx-3"></div>

                                <button type="submit" id="save_details"
                                        class="i-btn btn--primary btn--sm my-5 step-btn">{{ translate("Generate Book Using AI Magic") }}</button>
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
                showLoadingSwal("{{translate('Generating book outlines for you')}}");

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
                                $('#book-title').empty(); // Clear existing content
                                $('#book-title').append(response.data.title); // Clear existing content
                                loadBookData(response);

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

            $('#generate_data').on('submit', function (e) {
                e.preventDefault();  // Prevent the form from submitting normally

                // Serialize the form data (this will include the CSRF token)
                var formData = $('#generate_data').serializeArray();
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
                const bookData = data.data;

                // Set the book title
                $('#book-title').text(bookData.title);

                // Clear existing chapters
                $('#chapters-container').empty();

                // Add select-all checkbox at the start of the chapters container
                $('#chapters-container').prepend(`
                    <div class="d-flex justify-content-end align-items-center gap-2 mb-3 right">
                        <input class="form-check-input" type="checkbox" value="1" id="select-all-images" checked>
                        <label for="select-all-images" class="mb-0">Add images to all chapters</label>
                    </div>
                `);

                // Loop through chapters and create them
                bookData.chapters.forEach((chapter, index) => {
                    const chapterHTML = `
                        <div class="chapter mb-3" data-chapter-index="${index}">
                            <div class="d-flex align-items-center gap-2">
                                <span class="chapter-number">${index + 1}.</span>
                                <input type="text"
                                       name="chapters[${index}][title]"
                                       value="${chapter.title}"
                                       class="form-control border-0 flex-grow-1">
                                <a href="#" class="delete-chapter btn-sm btn btn-outline-danger">
                                                <i class="bi bi-x-lg"></i>
                                </a>
                                <a href="#" class="add-chapter btn-sm btn btn-outline-success">
                                        <i class="bi bi-plus-lg"></i>
                                </a>
                                <label class="d-flex align-items-center gap-1 mb-0">
                                    <input type="checkbox" value="1" name="chapters[${index}][hasImage]" class="form-check-input chapter-has-image" checked>
                                    <span>Image</span>
                                </label>
                            </div>
                            <div class="sections-container mt-2 ms-4" id="sections-${index}">
                                ${chapter.sections.map((section, sectionIndex) => `
                                    <div class="section mb-2 d-flex align-items-center gap-2">
                                        <span class="section-number">${sectionIndex + 1}.</span>
                                        <input type="text"
                                               name="chapters[${index}][sections][${sectionIndex}][title]"
                                               value="${section.replace(/^-\s*/, '')}"
                                               class="form-control border-0 flex-grow-1">
                                        <a href="#" class="delete-section btn-sm btn btn-outline-warning d-none">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                        <a href="#" class="add-section btn-sm btn btn-outline-success d-none">
                                            <i class="bi bi-plus-lg"></i>
                                        </a>
                                </div>`).join('')}
                            </div>
                        </div>`;
                    $('#chapters-container').append(chapterHTML);
                });

                // Renumber all chapters and sections
                reNumberChapters();
            }

            // Function to create a chapter template
            function createChapter(chapterIndex) {
                return `
                        <div class="chapter mb-3" data-chapter-index="${chapterIndex}">
                            <div class="d-flex align-items-center gap-2">
                                <span class="chapter-number">${chapterIndex + 1}.</span>
                                <input type="text"
                                       name="chapters[${chapterIndex}][title]"
                                       placeholder="Chapter Title"
                                       class="form-control border-0 flex-grow-1">

                                <a href="#" class="delete-chapter btn-sm btn btn-outline-danger">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                                <a href="#" class="add-chapter btn-sm btn btn-outline-success">
                                    <i class="bi bi-plus-lg"></i>
                                </a>
                                <label class="d-flex align-items-center gap-1 mb-0">
                                    <input type="checkbox" name="chapters[${chapterIndex}][hasImage]" class="form-check-input chapter-has-image" checked>
                                    <span>Image</span>
                                </label>
                            </div>
                            <div class="sections-container mt-2 ms-4" id="sections-${chapterIndex}">
                                ${createSection(chapterIndex, 0)} <!-- Add a default section -->
                            </div>
                        </div>`;
            }

            // Function to create a section template
            function createSection(chapterIndex, sectionIndex) {
                return `
                        <div class="section mb-2 d-flex align-items-center gap-2 section-hover" data-section-index="${sectionIndex}">
                            <span class="section-number">${sectionIndex + 1}.</span>
                            <input type="text"
                                   name="chapters[${chapterIndex}][sections][${sectionIndex}][title]"
                                   placeholder="Section Title"
                                   class="form-control border-0 flex-grow-1">
                            <a href="#" class="delete-section btn-sm btn btn-outline-warning d-none">
                                <i class="bi bi-x-lg"></i>
                            </a>
                            <a href="#" class="add-section btn-sm btn btn-outline-success d-none">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>`
                    ;
            }

            // Event listener for the "Select All" checkbox
            $(document).on('change', '#select-all-images', function () {
                const isChecked = $(this).is(':checked');
                $('.chapter-has-image').prop('checked', isChecked); // Check/uncheck all chapter checkboxes
            });

            // Event listener to update the "Select All" checkbox based on individual checkboxes
            $(document).on('change', '.chapter-has-image', function () {
                const allChecked = $('.chapter-has-image').length === $('.chapter-has-image:checked').length;
                $('#select-all-images').prop('checked', allChecked); // Update the "Select All" checkbox state
            });

            // Event listeners for adding/deleting sections
            $(document).on('click', '.add-section', function (e) {
                e.preventDefault();
                const chapterIndex = $(this).closest('.chapter').data('chapter-index');
                const section = $(this).closest('.section');
                const sectionIndex = section.data('section-index') + 1;

                const sectionHTML = createSection(chapterIndex, sectionIndex);
                section.after(sectionHTML);
                reNumberSections(chapterIndex);
            });

            $(document).on('click', '.delete-section', function (e) {
                e.preventDefault();
                const chapterIndex = $(this).closest('.chapter').data('chapter-index');
                const sectionCount = $(`#sections-${chapterIndex} .section`).length;

                // Only allow deletion if there's more than one section
                if (sectionCount > 1) {
                    $(this).closest('.section').remove();
                    reNumberSections(chapterIndex);
                } else {
                    alert('Each chapter must have at least one section.');
                }
            });

            // Event listeners for adding/deleting chapters
            $(document).on('click', '.add-chapter', function (e) {
                e.preventDefault();
                const currentChapter = $(this).closest('.chapter');
                const chapterIndex = currentChapter.data('chapter-index') + 1;

                const chapterHTML = createChapter(chapterIndex);
                currentChapter.after(chapterHTML);
                reNumberChapters();
            });

            $(document).on('click', '.delete-chapter', function (e) {
                e.preventDefault();
                $(this).closest('.chapter').remove();
                reNumberChapters();
            });

            // Function to renumber sections within a chapter
            function reNumberSections(chapterIndex) {
                $(`#sections-${chapterIndex} .section`).each(function (index) {
                    $(this).find('.section-number').text(`${index + 1}.`);
                    $(this).data('section-index', index); // Update section index
                    $(this).find('input').attr('name', `chapters[${chapterIndex}][sections][${index}][title]`);
                });
            }

            // Function to renumber chapters and ensure correct numbering for sections
            function reNumberChapters() {
                $('#chapters-container .chapter').each(function (index) {
                    $(this).find('.chapter-number').text(`${index + 1}.`);
                    $(this).data('chapter-index', index);
                    $(this).find('input[name^="chapters"]').attr('name', function (_, attr) {
                        return attr.replace(/\chapters\[\d+\]/, `chapters[${index}]`);
                    });
                    $(this).find('.sections-container').attr('id', `sections-${index}`);
                    reNumberSections(index); // Renumber sections in this chapter
                });
            }
        });
    </script>
@endpush

