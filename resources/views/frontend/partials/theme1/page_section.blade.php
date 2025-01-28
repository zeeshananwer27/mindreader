@if(@$menu->section)
    @foreach(@$menu->section as $section)
            @include('frontend.sections.theme1.'.$section)
    @endforeach
@endif