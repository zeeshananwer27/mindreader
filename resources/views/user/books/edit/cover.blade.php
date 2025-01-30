@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row">
        </div>
    </div>
@endsection

@push('script-push')

    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {

        });
    </script>
@endpush
