@extends('layouts.master')
@push('styles')
    <link href="{{asset('assets/global/css/editor.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container mt-4">

        <div class="row mt-5">
            <div id="container" class="col-12 col-md-11 d-flex justify-content-center">
                <div class="col-12 col-md-9">
                    <div class="i-card  d-flex mb-4 align-items-center justify-content-between mx-2">
                        <div class="flex-grow-1">
                            <button
                                class="btn btn-outline-secondary d-flex align-items-center justify-content-center px-2"
                                {{ $currentChapterNumber == 1 ? 'disabled' :''}}>
                                <i class="bi bi-arrow-left"></i>
                            </button>
                        </div>

                        <div class="text-center">
                            Chapter: {{$currentChapterNumber}} / {{$totalChapters}}
                        </div>

                        <div class="d-flex flex-grow-1 justify-content-end">
                            <button
                                class="btn btn-outline-secondary d-flex align-items-center justify-content-center px-2"
                                {{ $currentChapterNumber == $totalChapters ? 'disabled' :''}}>
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="i-card-md py-4">
                        <div class="d-flex w-100 align-items-center justify-content-between ps-5 pe-2 gap-2">
                            <input type="text" required placeholder="Add Heading" value="{{$chapter->title}}"
                                   class="form-control fs-3 py-1 px-4 ms-3 fw-medium text-black" name="title" disabled>

                            <button type="button"
                                    class="btn d-flex align-items-center justify-content-center px-1 border-0 hover-border"
                                    id="edit-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="bi bi-pencil">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                                    <path d="m15 5 4 4"></path>
                                </svg>
                            </button>

                            <div id="action-buttons" class="d-none">
                                <div class="d-flex">
                                    <button type="button"
                                            class="btn d-flex align-items-center justify-content-center px-1 border-0 hover-border"
                                            id="save-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="bi bi-check">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                    </button>

                                    <button type="button"
                                            class="btn d-flex align-items-center justify-content-center px-1 border-0 hover-border"
                                            id="cancel-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="bi bi-x">
                                            <path d="M18 6 6 18"></path>
                                            <path d="m6 6 12 12"></path>
                                        </svg>
                                    </button>

                                </div>
                            </div>
                        </div>

                        <div id="editor"></div>

                        <div class="d-flex justify-content-center mt-3">
                            <button id="saveChapterBtn" type="button" class="btn btn-primary ">Update Chapter</button>
                        </div>
                    </div>
                </div>
                <div class="position-fixed end-0 me-4 i-card border-start px-4 py-3">
                    <h5 class="mt-2">AI Tools</h5>
                    <p class="fs-6  mt-2">Total Words: <span id="words-count" class="text-muted"></span> words</p>

                    <button type="button" class="btn btn-outline-secondary w-100 text-start my-2">
                        <i class="bi bi-arrow-repeat me-2"></i> Regenerate Chapter
                    </button>

                    <hr>

                    <h6 class="fw-semibold mb-3">AI Actions</h6>
                    <div class="d-grid gap-2 mb-2">
                        <button type="button" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-arrow-clockwise me-2"></i> Rewrite
                        </button>

                        <button type="button" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-spellcheck me-2"></i> Correct Grammar
                        </button>

                        <button type="button" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-chat-dots me-2"></i> Ask AI
                        </button>

                        <button type="button" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-file-earmark-text me-2"></i> Generate Paragraph
                        </button>

                        <button type="button" class="btn btn-outline-secondary text-start">
                            <i class="bi bi-image me-2"></i> Generate Image
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-push')

    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {
            let debounceTimer;
            let editor = new EditorJS({
                readOnly: false,
                holder: 'editor',
                inlineToolbar: true,
                tools: {
                    header: {
                        class: Header,
                        config: {
                            placeholder: 'Enter a header',
                            levels: [1, 2, 3, 4, 5, 6],
                            defaultLevel: 3
                        }
                    },
                    image: SimpleImage
                },

                defaultBlock: 'paragraph',
                data: @json($chapter->chapterTopics),
                onReady: function () {
                    $('#container').removeClass('d-none');
                    // saveButton.click();
                    new Undo({editor});
                    updateWordCount()
                },
                onChange: function (api, event) {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        updateWordCount();
                    }, 1500);
                }
            });

            $('#edit-btn').on('click', function () {
                $('input[name="title"]').prop('disabled', false);
                $(this).addClass('d-none');
                $('#action-buttons').removeClass('d-none');
            });

            $('#cancel-btn').on('click', function () {
                $('input[name="title"]').prop('disabled', true);
                $('#edit-btn').removeClass('d-none');
                $('#action-buttons').addClass('d-none');
            });

            $('#save-btn').on('click', function () {
                $('input[name="title"]').prop('disabled', true);
                $('#edit-btn').removeClass('d-none');
                $('#action-buttons').addClass('d-none');
            });

            $('#saveChapterBtn').on('click', function () {
                editor.save()
                    .then(async (savedData) => {
                        console.log(savedData);

                        const formData = new FormData();
                        const blocks = savedData.blocks; // Ensure we're using the correct data structure

                        for (let i = 0; i < blocks.length; i++) {
                            const block = blocks[i];

                            if (block.type === 'image' && block.data.url.startsWith('blob:')) {
                                try {
                                    const response = await fetch(block.data.url);
                                    const blob = await response.blob();
                                    const file = new File([blob], `image_${Date.now()}_${block.id}.png`, { type: blob.type });

                                    formData.append(`images[${i}]`, file); // Append the image file
                                    block.data.temp_image_key = i; // Add temp key for server-side reference
                                } catch (error) {
                                    console.error('Image processing error:', error);
                                }
                            }
                        }

                        formData.append('blocks', JSON.stringify(blocks));
                        formData.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            url: '{{ route('user.book.edit.chapters.update', ['id' => $book->uid, 'chapter' => $chapter->uid]) }}',
                            type: 'POST',
                            data: formData,
                            processData: false,      // Prevent jQuery from processing the data
                            contentType: false,      // Prevent jQuery from setting content type
                            success: function (response) {
                                if (response.status) {
                                    toastr.success(response.message);
                                } else {
                                    toastr.error(response.message || '{{ translate("Something went wrong. Please try again.") }}');
                                }
                            },
                            error: function (xhr, status, error) {
                                toastr.error('{{ translate("An error occurred. Please try again.") }}');
                                console.error("Error:", error);
                            }
                        });
                    })
                    .catch((error) => {
                        console.error('Saving error:', error);
                    });

            });

            function updateWordCount() {
                editor.save().then((outputData) => {
                    let wordCount = 0;
                    outputData.blocks.forEach((block) => {
                        if (block.type === 'paragraph' || block.type === 'header') {
                            const text = block.data.text || '';
                            const words = text.trim().split(/\s+/);
                            wordCount += words.length;
                        }
                    });
                    $('#words-count').text(`${wordCount}`);
                }).catch((error) => {
                    console.error('Error retrieving blocks from editor: ', error);
                });
            }
        });
    </script>
@endpush
