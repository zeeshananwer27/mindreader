@extends('layouts.master')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="i-card-md p-4">

                <form action="{{ route('user.book.author.store') }}" class="add-listing-form" enctype="multipart/form-data" method="post" id="authorForm">
                    @csrf
                    <div class="card--header">
                        <h4 class="card-title">
                            {{ translate('Basic Information') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Image section -->
                            <div class="col-md-3 mb-4">
                                <div class="image-upload-container">
                                    <div class="image-wrapper">
                                        <img src="{{ asset('assets/images/default/DEFAULT.png') }}"
                                             id="authorImagePreview"
                                             alt="{{ translate('Author Image') }}" class="avatar-16 img-fluid rounded-circle">
                                    </div>
                                    <!-- Hidden file input -->
                                    <input type="file" class="form-control d-none" id="image" name="image"
                                           accept="image/png, image/jpeg, image/jpg, image/webp">
                                    <!-- Custom upload button -->
                                    <button type="button" class="btn btn-outline-primary" id="uploadButton">
                                        <i class="fa fa-upload"></i> {{ translate('Upload Image') }}
                                    </button>
                                </div>
                            </div>

                            <!-- Form fields -->
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ translate('Name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="{{ translate('Enter author\'s name') }}">
                                    <div id="nameError" class="text-danger d-none">{{ translate('Name is required.') }}</div>
                                </div>

                                <div class="mb-3">
                                    <label for="biography" class="form-label">{{ translate('Biography') }}</label>
                                    <textarea class="form-control" id="biography" name="biography" rows="3"
                                              placeholder="{{ translate('Enter author\'s biography') }}"></textarea>
                                    <div id="biographyError" class="text-danger d-none">{{ translate('Biography is required.') }}</div>
                                </div>

                                <!-- Style and Tone on a single row -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tone" class="form-label">{{ translate('Tone') }}</label>
                                        <select class="form-select select2" id="tone" name="tone">
                                            <option selected disabled>{{ translate('Select tone') }}</option>
                                            @foreach ($tones as $tone)
                                                <option value="{{ $tone }}">{{ $tone }}</option>
                                            @endforeach
                                        </select>
                                        <div id="toneError" class="text-danger d-none">{{ translate('Tone is required.') }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="style" class="form-label">{{ translate('Style') }}</label>
                                        <select class="form-select select2" id="style" name="style">
                                            <option selected disabled>{{ translate('Select style') }}</option>
                                            @foreach ($styles as $style)
                                                <option value="{{ $style }}">{{ $style }}</option>
                                            @endforeach
                                        </select>
                                        <div id="styleError" class="text-danger d-none">{{ translate('Style is required.') }}</div>
                                    </div>
                                </div>

                                <!-- Save button aligned left -->
                                <div class="d-flex justify-content-start gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary" id="saveButton">{{ translate('Create Author') }}</button>
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
        (function ($) {
            "use strict";

            $(document).ready(function () {
                // Initialize Select2 for tone and style dropdowns
                $('#tone').select2({});
                $('#style').select2({});

                // Image preview functionality
                function previewImage(event) {
                    var reader = new FileReader();
                    reader.onload = function () {
                        var output = document.getElementById('authorImagePreview');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }

                // Bind the click event for the custom upload button
                $('#uploadButton').on('click', function () {
                    $('#image').click(); // Trigger the file input click
                });

                // Bind the change event to handle image file selection
                $('#image').on('change', function (e) {
                    if (this.files && this.files[0]) {
                        // Display the selected image in the preview
                        previewImage(e);
                    } else {
                        // Reset to the default image if no image is selected
                        $('#authorImagePreview').attr('src', '{{ asset('assets/images/default/DEFAULT.png') }}');
                    }
                });

                // Form validation
                $('#authorForm').on('submit', function (e) {
                    e.preventDefault(); // Prevent form submission for validation

                    // Reset errors
                    $('.text-danger').addClass('d-none');

                    let isValid = true;

                    // Validate Name
                    if ($('#name').val() === '') {
                        $('#nameError').removeClass('d-none');
                        isValid = false;
                    }

                    // Validate Biography
                    if ($('#biography').val() === '') {
                        $('#biographyError').removeClass('d-none');
                        isValid = false;
                    }

                    // Validate Tone
                    if ($('#tone').val() === null) {
                        $('#toneError').removeClass('d-none');
                        isValid = false;
                    }

                    // Validate Style
                    if ($('#style').val() === null) {
                        $('#styleError').removeClass('d-none');
                        isValid = false;
                    }

                    // If valid, submit the form
                    if (isValid) {
                        this.submit();  // Form will be submitted after validation passes
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
