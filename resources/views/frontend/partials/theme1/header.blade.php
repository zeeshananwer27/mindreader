@php
    $currencies = site_currencies()->where("code", '!=', session()->get('currency')->code);
    $lastSegment = collect(request()->segments())->last();

    $lang = $languages->where('code', session()->get('locale'));
    $code = count($lang) != 0 ? $lang->first()->code : "en";
    $languages = $languages->where('status', App\Enums\StatusEnum::true->status())
                           ->where('code', '!=', $code);
@endphp

<header id="header" class="tra-menu navbar-dark white-scroll">
    <div class="header-wrapper">
        <!-- MOBILE HEADER -->
        <div class="wsmobileheader clearfix">
            <span class="smllogo">
                <a href="{{ route('home') }}">
                    <img src="{{ imageURL(@site_logo('user_site_logo')->file, 'user_site_logo', true) }}" 
                         alt="{{ @site_logo('user_site_logo')->file->name ?? 'site-logo.jpg' }}">
                </a>
            </span>
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>

        <!-- NAVIGATION MENU -->
        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix">
                <!-- HEADER LOGO -->
                <div class="desktoplogo">
                    <a href="{{ route('home') }}">
                        <img src="{{ imageURL(@site_logo('user_site_logo')->file, 'user_site_logo', true) }}" 
                             alt="{{ @site_logo('user_site_logo')->file->name ?? 'site-logo.jpg' }}">
                    </a>
                </div>

                <!-- MAIN MENU -->
                <nav class="wsmenu clearfix">
                    <ul class="wsmenu-list nav-theme">
                        @foreach ($menus as $menu)
                            <li class="menu-item">
                                <a href="{{ url($menu->url) }}" class="menu-link 
                                    @if(!request()->routeIs('home') && URL::current() == url($menu->url)) active @endif">
                                    {{ $menu->name }}
                                </a>
                            </li>
                        @endforeach

                        @foreach ($pages as $page)
                            <li class="menu-item">
                                <a href="{{ route('page', $page->slug) }}" class="menu-link 
                                    @if(request()->is($page->slug)) active @endif">
                                    {{ $page->title }}
                                </a>
                            </li>
                        @endforeach

                        <!-- Dropdown Menu -->
                        @php
                            $megaMenu = get_content("content_mega_menu")->first();
                        @endphp
                        @if($megaMenu && $megaMenu->value->select_input->status == App\Enums\StatusEnum::true->status())
                            <li class="menu-item">
                                <a href="javascript:void(0)" class="menu-link mega-menu-click">
                                    {{ @$megaMenu->value->title }}
                                    <div class="menu-link-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </a>
                                <div class="mega-menu container-lg px-0">
                                    <div class="mega-menu-wrapper">
                                        <div class="row g-4 h-100">
                                            <div class="col-lg-12">
                                                <div class="mega-menu-right">
                                                    <!-- Integrations -->
                                                    @php
                                                        $intregrationsElements = get_content("element_integration");
                                                        $hoverImageSize = get_appearance_img_size('integration', 'element', 'hover_image');
                                                    @endphp
                                                    @if($intregrationsElements->count() > 0)
                                                        <ul class="nav nav-tabs gap-xxl-3 gap-2 border-0" id="customTab" role="tablist">
                                                            @foreach ($intregrationsElements as $element)
                                                                @php
                                                                    $file = $element->file->where('type', "feature_image")->first();
                                                                @endphp
                                                                <li class="nav-item" role="presentation">
                                                                    <a href="{{ route('integration', ['slug' => make_slug($element->value->title), 'uid' => $element->uid]) }}" 
                                                                       class="nav-link mega-menu-tab {{ $loop->index == 0 ? 'active' : '' }}">
                                                                        <div class="social-item-img">
                                                                            <img src="{{ imageURL($file, 'frontend', true, $hoverImageSize) }}" 
                                                                                 alt="{{ @$file->name ?? $element->value->title }}">
                                                                        </div>
                                                                        <h6>{{ $element->value->title }}</h6>
                                                                        <p>{{ $element->value->short_description }}</p>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </nav> <!-- END MAIN MENU -->
            </div>
        </div> <!-- END NAVIGATION MENU -->

        <!-- Sidebar and Action Buttons -->
        <div class="nav-right d-flex justify-content-end align-items-center gap-3">
            <div class="language">
                <button class="dropdown-toggle lang--toggle" type="button" 
                        @if($languages->count() > 0) data-bs-toggle="dropdown" aria-expanded="false" @endif>
                    <img src="{{ asset('assets/images/global/flags/' . strtoupper($code) . '.png') }}" 
                         alt="{{ $code . '.jpg' }}">
                </button>
                @if($languages->count() > 0)
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach($languages as $language)
                            <li>
                                <a class="dropdown-item" href="{{ route('language.change', $language->code) }}">
                                    <img src="{{ asset('assets/images/global/flags/' . strtoupper($language->code) . '.png') }}" 
                                         alt="{{ $language->code . '.jpg' }}"> {{ $language->code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="currency">
                <button class="{{ $currencies->count() > 0 ? 'dropdown-toggle' : '' }} custom--toggle" 
                        type="button" @if($currencies->count() > 0) data-bs-toggle="dropdown" aria-expanded="false" @endif>
                    {{ session()->get('currency')->code ?? 'USD' }}
                </button>
                @if($currencies->count() > 0)
                    <ul class="dropdown-menu dropdown-menu-end">
                        @foreach($currencies as $currency)
                            <li>
                                <a class="dropdown-item" href="{{ route('currency.change', $currency->code) }}">
                                    {{ $currency->code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div> <!-- End header-wrapper -->
</header>
