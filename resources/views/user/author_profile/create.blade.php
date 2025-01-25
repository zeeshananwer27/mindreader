@extends('layouts.master')
@section('content')
    <form action="{{ route('user.book.author.store') }}" class="add-listing-form" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row g-4">
            <div class="i-card-md">
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
                                    <img src="{{ asset('assets/images/default/DEFAULT.png') }}" id="authorImagePreview"
                                         alt="Author Image" class="avatar-16 img-fluid rounded-circle">
                                    <div class="camera-icon d-none">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                <!-- Hidden file input -->
                                <input type="file" class="form-control" id="image" name="image"
                                       accept="image/png, image/jpeg, image/jpg, image/webp" style="display: none;">
                                <!-- Custom upload button -->
                                <button type="button" class="btn btn-outline-primary" id="uploadButton">
                                    <i class="fa fa-upload"></i> Upload Image
                                </button>
                            </div>
                        </div>

                        <!-- Form fields -->
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter author's name">
                            </div>

                            <div class="mb-3">
                                <label for="biography" class="form-label">Biography</label>
                                <textarea class="form-control" id="biography" name="biography" rows="3"
                                          placeholder="Enter author's biography"></textarea>
                            </div>

                            <!-- Style and Tone on a single row -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tone" class="form-label">Tone</label>
                                    <select class="form-select select2" id="tone" name="tone">
                                        <option selected disabled>Select tone</option>
                                        @foreach ($tones as $tone)
                                            <option value="{{ $tone }}">{{ $tone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="style" class="form-label">Style</label>
                                    <select class="form-select select2" id="style" name="style">
                                        <option selected disabled>Select style</option>
                                        @foreach ($styles as $style)
                                            <option value="{{ $style }}">{{ $style }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Save button aligned left -->
                            <div class="d-flex justify-content-start gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('style-push')
    <style>
        .image-upload-container {
            position: relative;
            text-align: center;
        }

        .image-wrapper {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f0f0f0;
            position: relative;
        }

        #authorImagePreview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .camera-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #888;
            font-size: 24px;
        }

        #uploadButton {
            margin-top: 10px;
            font-size: 14px;
            padding: 5px 15px;
        }

        .form-select.select2 {
            width: 100%;
        }

        .card-body {
            padding: 2rem;
        }

        .row.mb-3 .col-md-6 {
            padding: 0 10px;
        }

        .d-flex {
            justify-content: flex-start !important;
        }
    </style>
@endpush

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
                        // Hide the camera icon when an image is selected
                        $('.camera-icon').addClass('d-none');
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }

                // Bind the click event for the custom upload button
                $('#uploadButton').on('click', function () {
                    $('#image').click(); // Trigger the file input click
                });

                // Bind the change event to handle image file selection
                $('#image').on('change', function () {
                    if (this.files && this.files[0]) {
                        // Hide the camera icon when the image is selected
                        $('.camera-icon').addClass('d-none');
                    } else {
                        // Show the camera icon again if no image is selected
                        $('.camera-icon').removeClass('d-none');
                        $('#authorImagePreview').attr('src', '{{ asset('assets/images/default/DEFAULT.png') }}'); // Reset to default image
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
