@extends('layouts.master')
@push('styles')
    <link nonce="{{ csp_nonce() }}" href="{{asset('assets/book/css/dflip.min.css')}}?v={{ time() }}" rel="stylesheet"
          type="text/css"/>
    <link nonce="{{ csp_nonce() }}" href="{{asset('assets/book/css/themify-icons.min.css')}}?v={{ time() }}"
          rel="stylesheet"
          type="text/css"/>

    <style>
        .annotationDiv {
            border-top: 1px solid #f8f9fb;
            border-left: 1px solid #f8f9fb;
        }

        .df-share-button.ti-whatsapp:before {
            content: url('https://api.iconify.design/simple-icons:whatsapp.svg?color=%23777&width=20&height=20');
        }

        .df-share-button.df-icon-close {
            position: absolute;
            top: 0px;
            right: 0px;
        }

    </style>
@endpush
@section('content')
    @include("frontend.partials.breadcrumb")
    <div class="container mt-4">
        <div class="row g-4 d-flex justify-content-center">

            @php
                $title = str_replace(' ', '_', $book->title)
            @endphp

            <div class="_df_book"
                 height="700"
                 source="{{ asset('storage/' .$book->book_url) }}"
                 id="{{$title}}"
            >
            </div>
        </div>
    </div>
@endsection

@push('script-push')

    {{--    <script nonce="{{ csp_nonce() }}" src="{{asset('assets/book/js/libs/jquery.min.js')}}?v={{ time() }}"></script>--}}
    <script nonce="{{ csp_nonce() }}" src="{{asset('assets/book/js/libs/three.min.js')}}?v={{ time() }}"></script>
    <script nonce="{{ csp_nonce() }}" src="{{asset('assets/book/js/libs/compatibility.js')}}?v={{ time() }}"></script>
    <script nonce="{{ csp_nonce() }}" src="{{asset('assets/book/js/libs/mockup.min.js')}}?v={{ time() }}"></script>
    <script nonce="{{ csp_nonce() }}" src="{{asset('assets/book/js/libs/pdf.min.js')}}?v={{ time() }}"></script>
    <script nonce="{{ csp_nonce() }}" src="{{asset('assets/book/js/dflip.min.js')}}?v={{ time() }}"></script>

    <script nonce="{{ csp_nonce() }}">
        var option_{{$title}} = {
            webgl: true,
            sharePrefix: "{{$book->title}}",
            hard: "cover",
        };

    </script>

    <script>

        jQuery(function() {

            DFLIP.defaults.onReady = function(flipbook){
                console.log("flipbook ready");
                flipbook.ui.fullScreen.trigger("click");
            }

        });

    </script>

@endpush
