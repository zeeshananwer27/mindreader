@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-8">
                <div class="i-card-md">
                    <div class="card-body">

                        <div id="chapters-container" class="chapters-container mx-3">
                            @foreach ($book->chapters as $index => $chapter)
                                @php
                                    $sections = json_decode($chapter->content, true);
                                @endphp

                                <div class="chapter mb-3" data-chapter-index="{{ $index }}"
                                     data-chapter-id="{{ $chapter->uid }}">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="chapter-number"></span>
                                        <input type="text"
                                               name="chapters[{{ $index }}][title]"
                                               value="{{ $chapter->title }}"
                                               class="form-control border-0 flex-grow-1">
                                        <a href="#" class="delete-chapter btn-sm btn btn-outline-danger">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                        <a href="#" class="add-chapter btn-sm btn btn-outline-success">
                                            <i class="bi bi-plus-lg"></i>
                                        </a>
                                        <label class="d-flex align-items-center gap-1 mb-0">
                                            <input type="checkbox" id="hasImage[{{ $index }}][hasImage]"
                                                   name="chapters[{{ $index }}][hasImage]"
                                                   class="form-check-input chapter-has-image" {{$chapter->has_image == 1 ?'checked' :''}}>
                                            <span>Image</span>
                                        </label>
                                    </div>

                                    <div class="sections-container mt-2 ms-4" id="sections-{{ $index }}">
                                        @foreach ($sections as $sectionIndex => $section)
                                            <div
                                                class="section border-bottom mb-2 pb-1 d-flex align-items-center gap-2">
                                                <span class="section-number"></span>
                                                <input type="text"
                                                       name="chapters[{{ $index }}][sections][{{ $sectionIndex }}][title]"
                                                       value="{{ $section['title'] }}"
                                                       class="form-control border-0 flex-grow-1">
                                                <a href="#"
                                                   class="delete-section btn-sm btn btn-outline-warning d-none">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>
                                                <a href="#" class="add-section btn-sm btn btn-outline-success d-none">
                                                    <i class="bi bi-plus-lg"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button class="update-chapter w-100 btn btn-sm btn-outline-primary mt-2">
                                        Update Book Outline
                                    </button>
                                </div>
                            @endforeach
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
            reNumberChapters();

            // Event listener for update button
            $(document).on('click', '.update-chapter', function (e) {
                e.preventDefault();
                const chapterElement = $(this).closest('.chapter');
                const chapterId = chapterElement.data('chapter-id');
                const chapterTitle = chapterElement.find('input[name^="chapters"]').val();
                const chapterHasImage = chapterElement.find('input[id^="hasImage"]');

                let sections = [];
                chapterElement.find('.section').each(function () {
                    sections.push({
                        order: $(this).index() + 1,
                        title: $(this).find('input').val()
                    });
                });

                // Prepare data
                const chapterData = {
                    id: chapterId,
                    title: chapterTitle,
                    hasImage: chapterHasImage.prop('checked') ? 1 : 0,
                    sections: sections
                };

                // Show SweetAlert confirmation
                Swal.fire({
                    title: '{{translate('Update Chapter?')}}',
                    text: "{{translate('This action cannot be undone. This will permanently override your current chapter content with AI generated content.')}}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{translate('Yes, Update it!')}}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request
                        $.ajax({
                            url: "/update-chapter",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            contentType: "application/json",
                            data: JSON.stringify(chapterData),
                            success: function (response) {
                                Swal.fire('Updated!', 'Your chapter has been updated.', 'success');
                            },
                            error: function () {
                                Swal.fire('Error!', 'Something went wrong. Try again.', 'error');
                            }
                        });
                    }
                });
            });

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
                                    <input type="checkbox" id="hasImage[${chapterIndex}][hasImage]" name="chapters[${chapterIndex}][hasImage]" class="form-check-input chapter-has-image" checked>
                                    <span>Image</span>
                                </label>
                            </div>
                            <div class="sections-container mt-2 ms-4" id="sections-${chapterIndex}">
                                ${createSection(chapterIndex, 0)} <!-- Add a default section -->
                            </div>
                            <button class="update-chapter w-100 btn btn-sm btn-outline-primary mt-2">
                                Update Book Outline
                             </button>
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
                const chapterElement = $(this);

                // Show SweetAlert confirmation
                Swal.fire({
                    title: '{{translate('Update Chapter?')}}',
                    text: "{{translate('This action cannot be undone. This will permanently override your current chapter content with AI generated content.')}}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{translate('Yes, Update it!')}}'
                }).then((result) => {
                    if (result.isConfirmed) {

                        chapterElement.closest('.chapter').remove();
                        reNumberChapters();

                        $.ajax({
                            url: "/update-chapter",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            contentType: "application/json",
                            data: JSON.stringify(chapterData),
                            success: function (response) {


                                Swal.fire('Updated!', 'Your chapter has been updated.', 'success');
                            },
                            error: function () {
                                Swal.fire('Error!', 'Something went wrong. Try again.', 'error');
                            }
                        });
                    }
                });
            });

            // Function to renumber sections within a chapter
            function reNumberSections(chapterIndex) {
                $(`#sections-${chapterIndex} .section`).each(function (index) {
                    $(this).find('.section-number').text(`${index + 1}.`);
                    $(this).data('section-index', index); // Update section index
                    $(this).find('input').attr('name', `chapters[${chapterIndex}][sections][${index}][title]`);
                });
            }

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
