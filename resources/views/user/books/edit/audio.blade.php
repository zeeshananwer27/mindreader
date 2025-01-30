@extends('layouts.master')

@section('content')
    <div class="container mt-4">

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-12 col-md-8">
                <div class="i-card-md">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="h5 text-dark">Audio Book Chapters</h2>
                                <div class="d-flex align-items-center gap-2">
                                    <p class="mb-0 text-muted">Voice: <span class="fw-medium text-primary">Echo</span></p>
                                    <span class="badge bg-primary text-white">Published</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm rounded-circle"><i class="bi bi-globe"></i></button>
                                <button class="btn btn-outline-danger btn-sm rounded-circle"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <div class="list-group">
                            <!-- Chapter 1 -->
                            <div class="list-group-item border-primary bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-link text-primary p-0"><i class="bi bi-play-circle h4"></i></button>
                                        <div>
                                            <span class="fw-medium text-dark">01. Diving into PHP and Back-End Development</span><br>
                                            <small class="text-primary">0:03 / 7:51</small>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-secondary btn-sm rounded-circle"><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                                <div class="progress mt-2" role="progressbar">
                                    <div class="progress-bar bg-primary" style="width: 0.79%;"></div>
                                </div>
                            </div>

                            <!-- Chapter 2 -->
                            <div class="list-group-item border-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-link text-primary p-0"><i class="bi bi-play-circle h4"></i></button>
                                        <span class="fw-medium text-dark">02. Integrating Front-End and Back-End</span>
                                    </div>
                                    <button class="btn btn-outline-secondary btn-sm rounded-circle"><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                            </div>

                            <!-- Chapter 3 -->
                            <div class="list-group-item border-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-link text-primary p-0"><i class="bi bi-play-circle h4"></i></button>
                                        <span class="fw-medium text-dark">03. Advanced Topics in Full Stack Development</span>
                                    </div>
                                    <button class="btn btn-outline-secondary btn-sm rounded-circle"><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                            </div>

                            <!-- Chapter 4 -->
                            <div class="list-group-item border-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-link text-primary p-0"><i class="bi bi-play-circle h4"></i></button>
                                        <span class="fw-medium text-dark">04. Practical Projects and Case Studies</span>
                                    </div>
                                    <button class="btn btn-outline-secondary btn-sm rounded-circle"><i class="bi bi-arrow-clockwise"></i></button>
                                </div>
                            </div>
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
