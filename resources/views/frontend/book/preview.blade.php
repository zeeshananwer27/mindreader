@extends('layouts.master')

@section('content')
    @include("frontend.partials.breadcrumb")
    <div class="container mt-4">
        <div class="row g-4 d-flex justify-content-center">
            <div class="flip-book html-book" id="book">
                <div>
                    <div class="page page-cover page-cover-top" data-density="hard">
                        <div class="page-content">
                            <h2>BOOK TITLE</h2>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">Page header - 1</h2>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">1</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">Page header - 2</h2>
                            <div class="page-image" style="background-image: url(images/html/2.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">2</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">Page header - 3</h2>
                            <div class="page-image" style="background-image: url(images/html/3.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">3</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">HARD Page header - 4</h2>
                            <div class="page-image" style="background-image: url(images/html/4.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">4</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">HARD Page header - 5</h2>
                            <div class="page-image" style="background-image: url(images/html/5.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">5</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">Page header - 6</h2>
                            <div class="page-image" style="background-image: url(images/html/6.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">6</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">Page header - 7</h2>
                            <div class="page-image" style="background-image: url(images/html/7.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">7</div>
                        </div>
                    </div>
                    <div class="page">
                        <div class="page-content">
                            <h2 class="page-header">Page header - 8</h2>
                            <div class="page-image" style="background-image: url(images/html/8.jpg)"></div>
                            <div class="page-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                cursus mollis nibh, non convallis ex convallis eu. Suspendisse potenti. Aenean vitae
                                pellentesque erat. Integer non tristique quam. Suspendisse rutrum, augue ac
                                sollicitudin mollis, eros velit viverra metus, a venenatis tellus tellus id magna.
                                Aliquam ac nulla rhoncus, accumsan eros sed, viverra enim. Pellentesque non justo
                                vel nibh sollicitudin pharetra suscipit ut ipsum. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. In cursus mollis nibh, non convallis ex convallis eu.
                                Suspendisse potenti. Aenean vitae pellentesque erat. Integer non tristique quam.
                                Suspendisse rutrum, augue ac sollicitudin mollis, eros velit viverra metus, a
                                venenatis tellus tellus id magna.
                            </div>
                            <div class="page-footer">8</div>
                        </div>
                    </div>
                    <div class="page page-cover page-cover-bottom" data-density="hard">
                        <div class="page-content">
                            <h2>THE END</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- jQuery and Bootstrap Script -->
@push('script-push')

    <script nonce="{{ csp_nonce() }}">
        $(document).ready(function () {
            const pageFlip = new St.PageFlip(document.getElementById('book'),
                {
                    width: 400,
                    height: 500,
                    showCover: true
                }
            );
            pageFlip.loadFromHTML(document.querySelectorAll('.page'));

        });
    </script>
@endpush
