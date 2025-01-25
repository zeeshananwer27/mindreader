@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row mb-12 py-5 i-card">
            <!-- Author Image -->
            <div class="col-12  col-md-3 d-flex justify-content-center mb-4 mb-md-0">
                <div class="h-64 w-64 rounded-circle overflow-hidden">
                    <img
                        src="{{ $author->image ? asset('storage/' . $author->image)  : asset('assets/images/default/DEFAULT.png') }}"
                        id="authorImagePreview"
                        alt="{{ $author->name }}" class="avatar-16 img-fluid rounded-circle" loading="lazy">
                </div>
            </div>

            <!-- Author Information -->
            <div class="col-12 col-md-9 px-5 d-flex flex-column justify-content-center">
                <h1 class="mb-3">{{ $author->name }}</h1>

                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <!-- Rating Stars (For demonstration, using 5 stars as an example) -->
                        <div class="d-flex">
                            @for ($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="lucide lucide-star text-muted-foreground">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-muted ms-2">0 reviews</p>
                    </div>
                </div>

                <!-- Biography -->
                <div class="mb-4">
                    <h4 class="mb-2">Biography</h4>
                    <p class="text-muted">{{ $author->biography }}</p>
                </div>

                <!-- Writing Style and Tone -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="mb-2">Writing Style</h5>
                        <div class="badge bg-primary text-white">{{ $author->style }}</div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-2">Tone</h5>
                        <div class="badge bg-dark text-white">{{ $author->tone }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
