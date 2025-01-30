@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column: Form -->
            <div class="col-lg-12">
                <div class="i-card-md">
                    <div class="card-body">
                        <div class="row">
                            <!-- Author Profile -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="authorProfile"
                                           class="form-label">{{ translate("Author Profile") }}</label>
                                    <select name="author_profile_id" id="authorProfile" class="form-control"
                                            disabled>
                                        @foreach ($authorProfiles as $profile)
                                            <option value="{{ $profile->id }}"
                                                {{ $book->author_profile_id == $profile->id ? 'selected' : '' }}>
                                                {{ $profile->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Genre -->
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="genre"
                                           class="form-label">{{ translate("What is the genre of the book?") }}</label>
                                    <select name="genre" id="genre" class="form-control" disabled>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre }}"
                                                {{ $book->genre == $genre ? 'selected' : '' }}>
                                                {{ $genre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Purpose -->
                        <div class="form-group mb-4">
                            <label for="purpose"
                                   class="form-label">{{ translate("What is the purpose of the book?") }}</label>
                            <textarea name="purpose" id="purpose" rows="3" class="form-control" readonly
                                      placeholder="{{ translate("Describe the book's purpose.") }}">{{ $book->purpose }}</textarea>
                        </div>

                        <!-- Target Audience -->
                        <div class="form-group mb-4">
                            <label for="targetAudience"
                                   class="form-label">{{ translate("Who is the target audience?") }}</label>
                            <textarea name="target_audience" id="targetAudience" rows="3" class="form-control"
                                      readonly
                                      placeholder="{{ translate("Define the target audience.") }}">{{ $book->target_audience }}</textarea>
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

        });
    </script>
@endpush
