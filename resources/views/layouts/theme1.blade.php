<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="sr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ @site_settings('user_site_name', site_settings('site_name')) }} {{ site_settings('title_separator') }}
        {{ Arr::get($meta_data, 'title', trans('default.home')) }}</title>
    @include('partials.meta_content')



    <!-- Favicon and Touch Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/theme1/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/theme1/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ asset('assets/theme1/images/apple-touch-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ asset('assets/theme1/images/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/theme1/images/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/theme1/images/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('assets/theme1/images/apple-touch-icon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/dropdown-effects/fade-down.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/lunar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/violet-red-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme1/css/custom.css') }}">

    @if (site_settings('google_analytics') == App\Enums\StatusEnum::true->status())
        <script nonce="{{ csp_nonce() }}" async
            src="https://www.googletagmanager.com/gtag/js?id={{ site_settings('google_analytics_tracking_id') }}"></script>
        <script nonce="{{ csp_nonce() }}">
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ site_settings('google_analytics_tracking_id') }}');
        </script>
    @endif

    @if (site_settings('google_ads') == App\Enums\StatusEnum::true->status())
        <script nonce="{{ csp_nonce() }}" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-{{ site_settings('google_adsense_publisher_id') }}"
            crossorigin="anonymous"></script>
    @endif
    @include('partials.theme')
    @stack('styles')
    @stack('style-include')

    @cspMetaTag(App\Policies\CustomCspPolicy::class)
</head>



<body class="theme--dark">




    <!-- PRELOADER SPINNER
  ============================================= -->
    <div id="loading">
        <div id="loader" class="loading--theme">
            <div class="cssload-spinner"></div>
        </div>
    </div>


    <!-- PAGE CONTENT
  ============================================= -->
    <div id="page" class="page">

        <!-- HEADER
   ============================================= -->
        <header id="header" class="tra-menu navbar-dark white-scroll">
            <div class="header-wrapper">

               <!-- MOBILE HEADER -->
<div class="wsmobileheader clearfix">
    <span class="smllogo">
        <a href="{{ route('home') }}">
            <img src="{{ imageUrl(@site_logo('user_site_logo')->file, 'user_site_logo', true) }}" 
                 alt="{{ @site_logo('user_site_logo')->file->name ?? 'mobile-logo.jpg' }}">
        </a>
    </span>
    <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
</div>


                <!-- NAVIGATION MENU -->
                <div class="wsmainfull menu clearfix">
                    <div class="wsmainwp clearfix">

                       <!-- HEADER BLACK LOGO -->
<div class="desktoplogo">
    <a href="{{ route('home') }}" class="logo-black">
        <img src="{{ imageUrl(@site_logo('user_site_logo')->file, 'user_site_logo', true) }}" 
             alt="{{ @site_logo('user_site_logo')->file->name ?? 'site-logo.jpg' }}">
    </a>
</div>

<!-- HEADER WHITE LOGO -->
<div class="desktoplogo">
    <a href="{{ route('home') }}" class="logo-white">
        <img src="{{ imageUrl(@site_logo('user_site_logo')->file, 'user_site_logo', true) }}" 
             alt="{{ @site_logo('user_site_logo')->file->name ?? 'site-logo.jpg' }}">
    </a>
</div>


                     <!-- MAIN MENU -->
<nav class="wsmenu clearfix">
    <ul class="wsmenu-list nav-theme">

        <!-- DROPDOWN SUB MENU -->
        <!-- <li aria-haspopup="true">
            <a href="#" class="h-link">About <span class="wsarrow"></span></a>
            <ul class="sub-menu ico-10">
                <li aria-haspopup="true" class="h-link"><a href="#benefits">Why Pintex?</a></li>
                <li aria-haspopup="true" class="h-link"><a href="#how-it-works">How It Works</a></li>
                <li aria-haspopup="true" class="h-link"><a href="#">Release Notes</a></li>
            </ul>
        </li> -->

        <!-- SIMPLE NAVIGATION LINK -->
        <li class="nl-simple" aria-haspopup="true">
            <a href="{{ route('contact')}}" class="h-link">Contact us</a>
        </li>

        <!-- SIMPLE NAVIGATION LINK -->
        <li class="nl-simple" aria-haspopup="true">
            <a href="{{ route('plan') }}" class="h-link">Plans</a>
        </li>

        <!-- DROPDOWN SUB MENU -->
        <li aria-haspopup="true">
            <a href="#" class="h-link">Resources <span class="wsarrow"></span></a>
            <ul class="sub-menu ico-10">
                <li aria-haspopup="true" class="h-link"><a href="#reviews">Testimonials</a></li>
                <li aria-haspopup="true" class="h-link"><a href="#">More Products</a></li>
                <li aria-haspopup="true" class="h-link"><a href="#">Pintex Blog</a></li>
            </ul>
        </li>

        <li class="nl-simple" aria-haspopup="true">
            <a href="{{ route('blog') }}" class="h-link">Blogs</a>
        </li>

        <!-- SIMPLE NAVIGATION LINK -->
        <li class="nl-simple" aria-haspopup="true">
            <a href="#faqs" class="h-link">FAQs</a>
        </li>

        <!-- LOGIN OR DASHBOARD BUTTON -->
        <li class="nl-simple mobile-last-link" aria-haspopup="true">
            @if(auth()->check())
                <a href="{{ route('user.home') }}" class="btn r-36 ico-20 ico-right btn--theme hover--tra-black last-link">
                    Dashboard
                    <span class="flaticon-dashboard"></span>
                </a>
            @else
                <a href="{{ route('auth.login') }}" class="btn r-36 ico-20 ico-right btn--theme hover--tra-black last-link">
                    Login
                    <span class="flaticon-user"></span>
                </a>
            @endif
        </li>

    </ul>
</nav>


                    </div>
                </div> <!-- END NAVIGATION MENU -->
            </div> <!-- End header-wrapper -->
        </header> <!-- END HEADER -->

       



			<!-- HERO
			============================================= -->	
			@yield('content')

			<section id="hero-9" class="bg--fixed hero-section division">
				<div class="container">	
					<div class="row d-flex align-items-center">


						<!-- HERO TEXT -->
						<div class="col-md-6">
							<div class="hero-9-txt wow animate__animated animate__fadeInRight">

								<!-- Title -->
								<h2>Expand your creative skills with Pintex</h2>

								<!-- Text -->
								<p class="p-lg">Feugiat primis ligula sapien and mauris auctor ipsum laoreet and pretium augue 
									egestas cubilia cursus
								</p>

								<!-- STORE BADGES -->												
								<div class="stores-badge badge-img-md">

									<!-- AppStore -->
									<a href="#" class="store">
										<img class="appstore" src="{{ asset('assets/theme1/images/store_badges/appstore.png') }}" alt="appstore-badge">
									</a>
													
									<!-- Google Play -->
									<a href="#" class="store">
										<img class="googleplay" src="{{ asset('assets/theme1/images/store_badges/googleplay.png') }}" alt="googleplay-badge">
									</a> 
							
								</div>	<!-- END STORE BADGES -->	

								<!-- OS Prerequisite -->
								<div class="os-version-ext">
									<div class="star-rating clearfix ico-10">
										<span class="flaticon-star color--yellow"></span>
										<span class="flaticon-star color--yellow"></span>
										<span class="flaticon-star color--yellow"></span>
										<span class="flaticon-star color--yellow"></span>
										<span class="flaticon-star-half-empty color--yellow"></span>	
										<small>4,78K+ Pintex users reviews.</small>
									</div>		
								</div>

							</div>
						</div>	<!-- END HERO TEXT -->	


						<!-- HERO IMAGE -->
						<div class="col-md-6">	
							<div class="hero-9-img wow animate__animated animate__fadeInLeft">				
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-02d.png') }}" alt="hero-image">						
							</div>
						</div>


					</div>    <!-- End row --> 	
				</div>	   <!-- End container --> 
			</section>	

			<!-- END HERO -->




			<!-- FEATURES
			============================================= -->
			<section id="features" class="py-100 features-2 features-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-9 col-lg-8">
							<div class="section-title text-center mb-80">	

								<!-- Title -->	
								<h2 class="h2-xl">Ready to Try Pintex?</h2>	

								<!-- Text -->
								<p class="p-lg">Ligula risus auctor tempus magna feugiat lacinia laoreet luctus</p>
									
							</div>	
						</div>
					</div>


					<!-- FEATURES WRAPPER -->
					<div class="fbox-wrapper">
						<div class="row row-cols-1 row-cols-md-2 rows-2">


							<!-- FEATURE BOX #1 -->
		 					<div class="col">
		 						<div class="fbox-2 fb-1 wow animate__animated animate__fadeInUp animate__delay-1">

		 							<!-- Icon -->
									<div class="fbox-ico-wrap ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-cube"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h5>Exclusive AI Effects</h5>
										<p>Porta semper lacus cursus feugiat a primis ligula ultrice risus an auctor tempus feugiat
										   diam turpis impedit auctor felis and augue mauris blandit
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #1 -->	


		 					<!-- FEATURE BOX #2 -->
		 					<div class="col">
		 						<div class="fbox-2 fb-2 wow animate__animated animate__fadeInUp animate__delay-2">

		 							<!-- Icon -->
									<div class="fbox-ico-wrap ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-push-pin"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h5>Animated Stickers & Text</h5>
										<p>Porta semper lacus cursus feugiat a primis ligula ultrice risus an auctor tempus feugiat
										   diam turpis impedit auctor felis and augue mauris blandit
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #2 -->	


		 					<!-- FEATURE BOX #3 -->
		 					<div class="col">
		 						<div class="fbox-2 fb-3 wow animate__animated animate__fadeInUp animate__delay-1">

		 							<!-- Icon -->
									<div class="fbox-ico-wrap ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-audio-message"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h5>Sound & Music Effects</h5>
										<p>Porta semper lacus cursus feugiat a primis ligula ultrice risus an auctor tempus feugiat
										   diam turpis impedit auctor felis and augue mauris blandit
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #3 -->	


		 					<!-- FEATURE BOX #4 -->
		 					<div class="col">
		 						<div class="fbox-2 fb-4 wow animate__animated animate__fadeInUp animate__delay-2">

		 							<!-- Icon -->
									<div class="fbox-ico-wrap ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-union"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h5>Trendy & Unique Filters</h5>
										<p>Porta semper lacus cursus feugiat a primis ligula ultrice risus an auctor tempus feugiat
										   diam turpis impedit auctor felis and augue mauris blandit
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #4 -->	


		 					<!-- FEATURE BOX #5 -->
		 					<div class="col">
		 						<div class="fbox-2 fb-5 wow animate__animated animate__fadeInUp animate__delay-1">

		 							<!-- Icon -->
									<div class="fbox-ico-wrap ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-typography"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h5>Amazing Font Collection</h5>
										<p>Porta semper lacus cursus feugiat a primis ligula ultrice risus an auctor tempus feugiat
										   diam turpis impedit auctor felis and augue mauris blandit
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #5 -->	


		 					<!-- FEATURE BOX #6 -->
		 					<div class="col">
		 						<div class="fbox-2 fb-6 wow animate__animated animate__fadeInUp animate__delay-2">

		 							<!-- Icon -->
									<div class="fbox-ico-wrap ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-search-engine-1"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h5>Access Stock Footage</h5>
										<p>Porta semper lacus cursus feugiat a primis ligula ultrice risus an auctor tempus feugiat
										   diam turpis impedit auctor felis and augue mauris blandit
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #6 -->	


						</div>  <!-- End row -->  
					</div>	<!-- END FEATURES WRAPPER -->


				</div>     <!-- End container -->
			</section>	<!-- END FEATURES -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- TEXT CONTENT
			============================================= -->
			<section class="pt-100 ct-01 content-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-md-6">
							<div class="img-block left-column wow animate__animated animate__fadeInRight">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-01.png') }}" alt="content-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
						<div class="col-md-6">
							<div class="txt-block right-column wow animate__animated animate__fadeInLeft">

								<!-- Title -->	
								<h2 class="h2-md">Creative solutions, creative results</h2>

								<!-- Text -->	
								<p>Sapien tempor sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum auris suscipit
								</p>

								<!-- Text -->	
								<p>Tempor sapien sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit aliquet in dapibus
								   libero at blandit fusce neque sagittis
								</p>

							</div>
						</div>	<!-- END TEXT BLOCK -->	


					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END TEXT CONTENT -->




			<!-- TEXT CONTENT
			============================================= -->
			<section class="pt-80 ct-03 content-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- TEXT BLOCK -->	
			 			<div class="col-md-6 order-last order-md-2">
			 				<div class="txt-block left-column wow animate__animated animate__fadeInRight">

								<!-- Title -->	
								<h2 class="h2-md">Work smarter with powerful features</h2>

								<!-- Text -->	
								<p>Tempor sapien sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit auris
								</p>

								<!-- Text -->	
								<p>Tempor sapien sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit aliquet in dapibus
								   libero at blandit fusce neque sagittis
								</p>

								<!-- STATISTIC -->	
								<div class="txt-block-stat mt-35">
									
									<!-- STATISTIC BLOCK #1 -->
									<div id="sb-3-1" class="statistic-block wow animate__animated animate__fadeInUp">	
										<div class="statistic-block">
											<h2 class="statistic-number"><span class="count-element">65</span>k</h2>
											<p>Porta justo integer <br> a velna vitae auctor</p>
										</div>		
									</div>

									<!-- STATISTIC BLOCK #2 -->
									<div id="sb-3-2" class="statistic-block wow animate__animated animate__fadeInUp">	
										<div class="statistic-block">
											<h2 class="statistic-number"><span class="count-element">86</span>%</h2>
											<p>Porta justo integer <br> velna a vitae auctor</p>
										</div>	
									</div>	<!-- END STATISTIC BLOCK #2 -->

								</div>	<!-- END STATISTIC -->	

			 				</div>
					 	</div>	<!-- END TEXT BLOCK -->		


						<!-- IMAGE BLOCK -->	
						<div class="col-md-6 order-first order-md-2">
							<div class="img-block wow animate__animated animate__fadeInLeft">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/tablet-01.png') }}" alt="content-image">
							</div>	
						</div>


					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END TEXT CONTENT -->




			<!-- IMAGE CONTENT
			============================================= -->
			<section class="py-100 ct-05 content-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-8">
							<div class="section-title text-center mb-60">	

								<!-- Title -->	
								<h2 class="h2-xl">Create Better and Faster</h2>	

								<!-- Text -->
								<p class="p-lg">Ligula risus auctor tempus magna feugiat lacinia laoreet luctus</p>
								
							</div>	
						</div>
					</div>


					<!-- IMAGE BLOCK -->
					<div class="row">	
						<div class="col">
							<div class="img-block wow animate__animated animate__fadeInUp">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-21d.png') }}" alt="content-image">
							</div>
						</div>
					</div>


					<!-- ACTION BUTTON -->		
			 		<div class="row">
			 			<div class="col">
			 				<div class="img-block-btn wow animate__animated animate__fadeInUp">

			 					<!-- Button -->
								<a href="#download" class="btn btn-md r-36 btn--theme hover--tra-black">Get started -it's free</a> 

								<!-- Advantages List -->
								<ul class="advantages ico-15 clearfix">
									<li><p>Free 14 days trial</p></li>
									<li class="advantages-links-divider"><p><span class="flaticon-minus-1"></span></p></li>
									<li><p>Exclusive Support</p></li>
									<li class="advantages-links-divider"><p><span class="flaticon-minus-1"></span></p></li>
									<li><p>No Fees</p></li>
								</ul>

							</div>
						</div>
					</div>

					
				</div>	   <!-- End container -->
			</section>	<!-- END IMAGE CONTENT -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- TEXT CONTENT
			============================================= -->
			<section id="how-it-works" class="pt-100 ct-01 content-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-md-6">
							<div class="img-block left-column wow animate__animated animate__fadeInRight">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-06.png') }}" alt="content-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
						<div class="col-md-6">
							<div class="txt-block right-column wow animate__animated animate__fadeInLeft">

								<!-- Title -->	
								<h2 class="h2-md">Intuitive photo & video editing tools</h2>

								<!-- Text -->	
								<p>Sapien tempor sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum auris suscipit
								</p>

								<!-- Text -->	
								<p>Tempor sapien sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit aliquet in dapibus
								   libero at blandit fusce neque sagittis
								</p>

							</div>
						</div>	<!-- END TEXT BLOCK -->	


					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END TEXT CONTENT -->




			<!-- BOX CONTENT
			============================================= -->
			<section id="benefits" class="pt-100 bc-04 ws-wrapper content-section">
				<div class="container">
					<div class="bc-04-wrapper r-24">
						<div class="row d-flex align-items-center">


							<!-- TEXT BLOCK -->	
							<div class="col-md-5 col-lg-6 order-last order-md-2">
								<div class="txt-block left-column wow animate__animated animate__fadeInRight">

									<!-- Title -->	
									<h2 class="h2-md">Edit your media files like a pro</h2>

									<!-- Text -->	
									<p>Sodales tempor sapien diam quaerat congue primis ipsum laoreet turpis neque auctor 
										vitae fusce dolor laoreet placerat magna ligula and cursus purus nulla
									</p>

									<!-- Text -->	
									<ul class="simple-list">

										<li class="list-item">
											<p>Tempor sapien quaerat undo ipsum laoreet purus and sapien dolor ociis ultrice 
											   quisque and cursus
											</p>
										</li>

										<li class="list-item">
											<p class="mb-0">Quaerat sapien tempor undo ipsum laoreet purus and sapien dolor 
											   ociis ultrice quisque magna
											</p>
										</li>

									</ul>

								</div>
							</div>	<!-- END TEXT BLOCK -->	


							<!-- IMAGE BLOCK -->
							<div class="col-md-7 col-lg-6 order-first order-md-2">
								<div class="bc-4-img video-preview right-column">

									<!-- Play Icon --> 
									<a class="video-popup2" href="https://www.youtube.com/embed/7e90gBu4pas">				
										<div class="video-btn video-btn-xl bg--theme-2">	
											<div class="video-block-wrapper"><span class="flaticon-play-button"></span></div>
										</div>
									</a>

									<!-- Preview Image --> 
									<img class="img-fluid r-24 block--shadow" src="{{ asset('assets/theme1/images/img-17.jpg') }}" alt="content-image">

								</div>
							</div>


						</div>   <!-- End row -->	
					</div>    <!-- End content wrapper -->
				</div>     <!-- End container -->	
			</section>	<!-- END BOX CONTENT -->




			<!-- FEATURES
			============================================= -->
			<section class="py-100 features-3 features-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-8">
							<div class="section-title text-center mb-70">	

								<!-- Title -->	
								<h2 class="h2-xl">Affordable solutions for your creativity needs</h2>	

								<!-- Text -->
								<p class="p-lg">Ligula risus auctor tempus magna feugiat lacinia laoreet luctus</p>
									
							</div>	
						</div>
					</div>


					<!-- FEATURES WRAPPER -->
					<div class="fbox-wrapper text-center">
						<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">


							<!-- FEATURE BOX #1 -->
		 					<div class="col">
		 						<div class="fbox-3 fb-1 r-12 wow fadeInUp">

		 							<!-- Icon -->
									<div class="fbox-ico ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-alter"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-lg">Intuitive</h6>
										<p class="p-sm">Feugiat primis ipsum and ultrice a semper lacus</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #1 -->	


		 					<!-- FEATURE BOX #2 -->
		 					<div class="col">
		 						<div class="fbox-3 fb-2 r-12 wow fadeInUp">

									<!-- Icon -->
									<div class="fbox-ico ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-prioritize"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-lg">Flexible</h6>
										<p class="p-sm">Feugiat primis ipsum and ultrice a semper lacus</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #2 -->	


		 					<!-- FEATURE BOX #3 -->
		 					<div class="col">
		 						<div class="fbox-3 fb-3 r-12 wow fadeInUp">

		 							<!-- Icon -->
									<div class="fbox-ico ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-dice"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-lg">Creative</h6>
										<p class="p-sm">Feugiat primis ipsum and ultrice a semper lacus</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #3 -->	


		 					<!-- FEATURE BOX #4 -->
		 					<div class="col">
		 						<div class="fbox-3 fb-4 r-12 wow fadeInUp">

		 							<!-- Icon -->
									<div class="fbox-ico ico-55">
										<div class="shape-ico color--theme-2">

											<!-- Vector Icon -->
											<span class="flaticon-scale"></span>

											<!-- Shape -->
											<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
											  <path d="M66.1,-32.6C77.9,-17.7,74.4,11.6,60.8,35.7C47.2,59.7,23.6,78.5,2.8,76.9C-18,75.2,-35.9,53.2,-47.7,30.1C-59.5,7.1,-65.1,-16.9,-56.1,-30.1C-47.1,-43.4,-23.6,-46,1.8,-47C27.2,-48.1,54.3,-47.6,66.1,-32.6Z" transform="translate(100 100)" />
											</svg>

										</div>
									</div>	<!-- End Icon -->

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-lg">Efficient</h6>
										<p class="p-sm">Feugiat primis ipsum and ultrice a semper lacus</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #4 -->	


						</div>  <!-- End row -->  
					</div>	<!-- END FEATURES WRAPPER -->


				</div>     <!-- End container -->
			</section>	<!-- END FEATURES -->




			<!-- TEXT CONTENT
			============================================= -->
			<section class="bg--whitesmoke py-100 ct-01 content-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-md-6">
							<div class="img-block left-column wow animate__animated animate__fadeInRight">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-03d.png') }}" alt="content-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
						<div class="col-md-6">
							<div class="txt-block right-column wow animate__animated animate__fadeInLeft">


								<!-- TEXT BOX -->	
								<div class="txt-box">

									<!-- Title -->	
									<h5 class="h5-lg">Save time with AI</h5>

									<!-- Text -->	
									<p>Tempor sapien sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
									   luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit aliquet in dapibus
									   libero at blandit fusce neque sagittis
									</p>

								</div>	<!-- END TEXT BOX -->


								<!-- TEXT BOX -->	
								<div class="txt-box">

									<!-- Title -->	
									<h5 class="h5-lg">Editing tools and exports</h5>

									<!-- Text -->	
									<ul class="simple-list">

										<li class="list-item">
											<p>Tempor sapien quaerat ipsum laoreet purus and sapien dolor diam ultrice ipsum aliquam 
											   congue and dolor cursus dolor cursus justo congue ipsum in purus sapien blandit
											</p>
										</li>

										<li class="list-item">
											<p class="mb-0">Tempor sapien quaerat ipsum laoreet purus dolor a sapien turpis ultrice 
											   pulvinar congue aliquam an ispum congue
											</p>
										</li>

									</ul>

								</div>	<!-- END TEXT BOX -->
								

							</div>
						</div>	<!-- END TEXT BLOCK -->	


					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END TEXT CONTENT -->




			<!-- FEATURES
			============================================= -->
			<section class="py-100 features-6 features-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-8">
							<div class="section-title text-center mb-80">	

								<!-- Title -->	
								<h2 class="h2-title">The Complete Solutions</h2>	

								<!-- Text -->
								<p class="p-lg">Ligula risus auctor tempus magna feugiat lacinia laoreet luctus</p>
									
							</div>	
						</div>
					</div>


					<!-- FEATURES WRAPPER -->
					<div class="fbox-wrapper text-center">
						<div class="row row-cols-1 row-cols-md-3">


							<!-- FEATURE BOX #1 -->
		 					<div class="col">
		 						<div class="fbox-6 fb-1 wow animate__animated animate__fadeInUp animate__delay-1">

		 							<!-- Image -->
									<div class="fbox-img h-180">
										<img class="img-fluid" src="{{ asset('assets/theme1/images/f_05d.png') }}" alt="feature-image">
									</div>

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-xl">Available Everywhere</h6>
										<p>Egestas luctus augue undo ultrice quisque in lacus cursus feugiat eget ultrice 
										   laoreet cubilia sagittis
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #1 -->	


		 					<!-- FEATURE BOX #2 -->
		 					<div class="col">
		 						<div class="fbox-6 fb-2 wow animate__animated animate__fadeInUp animate__delay-2">

		 							<!-- Image -->
									<div class="fbox-img h-180">
										<img class="img-fluid" src="{{ asset('assets/theme1/images/f_07d.png') }}" alt="feature-image">
									</div>

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-xl">Intuitive Editing Tools</h6>
										<p>Augue egestas luctus undo ultrice quisque in lacus cursus feugiat eget ultrice 
										   sagittis cubilia laoreet
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #2 -->	


		 					<!-- FEATURE BOX #3 -->
		 					<div class="col">
		 						<div class="fbox-6 fb-3 wow animate__animated animate__fadeInUp animate__delay-3">

		 							<!-- Image -->
									<div class="fbox-img h-180">
										<img class="img-fluid" src="{{ asset('assets/theme1/images/f_08d.png') }}" alt="feature-image">
									</div>

									<!-- Text -->
									<div class="fbox-txt">
										<h6 class="h6-xl">AI-Powered Algorithm</h6>
										<p>Egestas luctus augue undo ultrice quisque in lacus cursus feugiat eget ultrice 
										   laoreet sagittis cubilia
										</p>
									</div>

		 						</div>
		 					</div>	<!-- END FEATURE BOX #3 -->	


						</div>  <!-- End row -->  
					</div>	<!-- END FEATURES WRAPPER -->


				</div>     <!-- End container -->
			</section>	<!-- END FEATURES -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- TEXT CONTENT
			============================================= -->
			<section class="pt-100 ct-01 content-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- TEXT BLOCK -->	
						<div class="col-md-6 order-last order-md-2">
							<div class="txt-block left-column wow animate__animated animate__fadeInRight">

								<!-- Title -->
								<h2 class="h2-md">Save your time & effort with Pintex</h2>

								<!-- Text -->	
								<p>Tempor sapien sodales quaerat ipsum congue undo laoreet turpis neque auctor turpis vitae dolor
								   luctus placerat magna and ligula cursus purus vitae purus an ipsum suscipit aliquet in dapibus
								   libero at blandit fusce neque sagittis
								</p>

								<!-- Text -->	
								<ul class="simple-list">

									<li class="list-item">
										<p>Tempor sapien quaerat ipsum laoreet purus dolor a sapien turpis ultrice pulvinar congue 
										   aliquam an ispum congue
										</p>
									</li>

									<li class="list-item">
										<p class="mb-0">Tempor sapien quaerat ipsum laoreet purus and sapien dolor diam ultrice 
										   ipsum aliquam congue and dolor cursus
										</p>
									</li>

								</ul>

							</div>
						</div>	<!-- END TEXT BLOCK -->	


						<!-- IMAGE BLOCK -->
						<div class="col-md-6 order-first order-md-2">
							<div class="img-block right-column wow animate__animated animate__fadeInLeft">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-07d.png') }}" alt="content-image">
							</div>
						</div>


					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END TEXT CONTENT -->




			<!-- TEXT CONTENT
			============================================= -->
			<section class="py-100 ct-02 content-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-md-6 col-lg-7">
							<div class="img-block left-column wow animate__animated animate__fadeInRight">
								<img class="img-fluid" src="{{ asset('assets/theme1/images/img-05d.png') }}" alt="content-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
			 			<div class="col-md-6 col-lg-5">
			 				<div class="txt-block right-column wow animate__animated animate__fadeInLeft">

			 					<!-- Title -->	
								<h2 class="h2-md">A single tool for all your needs</h2>

			 					<!-- Text -->
								<p>Sodales sapien tempor quaerat ipsum congue and laoreet turpis undo neque auctor sagittis a
							       quisque justo luctus placerat magna sodales egestas ligula 
								</p>

								<!-- Text -->	
								<ul class="simple-list">

									<li class="list-item">
										<p>Tempor sapien quaerat undo ipsum laoreet purus and sapien dolor ociis ultrice quisque
										   and magna aliquam dolor cursus a congue varius
										</p>
									</li>

									<li class="list-item">
										<p class="mb-0">Quaerat sapien tempor undo ipsum laoreet purus and sapien dolor ociis
										   ultrice quisque magna
										</p>
									</li>

								</ul>

			 				</div>
					 	</div>	<!-- END TEXT BLOCK -->			


					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END TEXT CONTENT -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- STATISTIC
			============================================= -->
			<section class="py-100 statistic-2 statistic-section division">
				<div class="container">


					<!-- STATISTIC WRAPPER -->
					<div class="statistic-2-wrapper">
						<div class="row">


							<!-- TEXT BLOCK -->	
							<div class="col-md-7 col-xl-6">
								<div class="txt-block right-column wow animate__animated animate__fadeInUp animate__delay-1">
									<h3>More than 890K users worldwide using Pintex</h3>
								</div>
							</div>


							<!-- STATISTIC BLOCK #1 -->
							<div class="col-sm-5 col-md-3 offset-sm-1 offset-md-0 offset-xl-1">					
								<div id="sb-2-1" class="statistic-block wow animate__animated animate__fadeInUp animate__delay-2">	

									<!-- Text -->
									<h2 class="h2-md statistic-number"><span class="count-element">99</span>%</h2>
									<p>Satisfied Users <br> Worldwide</p>	

								</div>						
							</div>


							<!-- STATISTIC BLOCK #2 -->
							<div class="col-sm-5 col-md-2">						
								<div id="sb-2-2" class="statistic-block wow animate__animated animate__fadeInUp animate__delay-3">	

									<!-- Text -->
									<h2 class="h2-md statistic-number">
										<span class="count-element">4</span>.<span class="count-element">93</span>
									</h2>

									<!-- Rating -->
									<div class="txt-block-rating ico-15 color--yellow">
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star-half-empty"></span>	
									</div>

									<p>5,376 Rating</p>																									
								</div>								
							</div>


						</div>  <!-- End row -->
					</div>	<!-- END STATISTIC WRAPPER -->


				</div>	   <!-- End container -->		
			</section>	<!-- END STATISTIC -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- TESTIMONIALS
			============================================= -->
			<section id="reviews" class="pt-100 reviews-1 reviews-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-9 col-lg-8">
							<div class="section-title text-center mb-80">	

								<!-- Title -->	
								<h2 class="h2-xl">Our Happy Customers</h2>	

								<!-- Text -->
								<p class="p-lg">Ligula risus auctor tempus magna feugiat lacinia laoreet luctus</p>
									
							</div>	
						</div>
					</div>


					<!-- TESTIMONIALS CAROUSEL -->
					<div class="row">
						<div class="col">					
							<div class="owl-carousel owl-theme reviews-carousel">


								<!-- TESTIMONIAL #1 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>	
										</div>

										<!-- Text -->
										<p>Etiam sapien sagittis congue augue a massa varius egestas ultrice varius magna 
										   a tempus aliquet undo cursus suscipit 			   
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-1.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Alexander McCaig</h6>
												<p class="p-sm">Internet Surfer</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #1 -->


								<!-- TESTIMONIAL #2 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star-half-empty"></span>	
										</div>

										<!-- Text -->
										<p>At sagittis congue augue diam egestas magna an ipsum vitae purus ipsum primis 
										   and cubilia laoreet augue egestas a luctus donec ltrice ligula porta augue
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-2.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Paul S. Chun</h6>
												<p class="p-sm">Web Developer</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #2 -->
						
						
								<!-- TESTIMONIAL #3 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star-1"></span>	
										</div>

										<!-- Text -->
										<p>Mauris gestas magnis a sapien etiam sapien congue an augue egestas and ultrice 
										   vitae purus diam an integer congue magna and egestas magna suscipit 
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-3.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Maria Haverman</h6>
												<p class="p-sm">App Developer</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #3 -->


								<!-- TESTIMONIAL #4 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star-half-empty"></span>	
										</div>

										<!-- Text -->
										<p>Mauris donec a magnis sapien etiam pretium a congue augue volutpat lectus aenean 
											magna undo mauris lectus laoreet
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-4.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>David Bromberg</h6>
												<p class="p-sm">Web Developer</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #4 -->
								
								
								<!-- TESTIMONIAL #5 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>	
										</div>

										<!-- Text -->
										<p>An augue cubilia undo laoreet magna suscipit egestas ipsum lectus purus ipsum 
										   and primis augue an ultrice ligula egestas suscipit lectus gestas auctor
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-5.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Marisol_22</h6>
												<p class="p-sm">@marisol_22</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #5 -->
								
								
								<!-- TESTIMONIAL #6 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star-1"></span>
											<span class="flaticon-star-1"></span>	
										</div>

										<!-- Text -->
										<p>An augue cubilia laoreet undo magna ipsum semper suscipit egestas magna ipsum 
										   ligula a vitae purus and ipsum primis!		   
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-6.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Marc Swanson</h6>
												<p class="p-sm">Sales Manager</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #6 -->
								
								
								<!-- TESTIMONIAL #7 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star-1"></span>	
										</div>

										<!-- Text -->
										<p>Augue egestas porta tempus volutpat egestas augue cubilia laoreet a magna 
										   suscipit luctus dolor blandit vitae purus neque tempus aliquet porta gestas
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-7.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Paul Briggs</h6>
												<p class="p-sm">Graphic Designer</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #7 -->


								<!-- TESTIMONIAL #8 -->
								<div class="review-1 bg--magnolia r-16">

									<!-- Quote Icon -->
		 							<div class="review-ico ico-45"><span class="flaticon-quote"></span></div>

									<!-- Text -->
									<div class="review-1-txt">

										<!-- Rating -->
										<div class="review-rating ico-15 color--yellow">
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>
											<span class="flaticon-star"></span>	
										</div>

										<!-- Text -->
										<p>Augue at vitae purus tempus egestas volutpat augue undo cubilia laoreet magna 
										   suscipit luctus dolor blandit purus and tempus feugiat impedit!
										</p>

										<!-- Author -->
										<div class="author-data clearfix">

											<!-- Avatar -->
											<div class="review-avatar">
												<img src="{{ asset('assets/theme1/images/review-author-8.jpg') }}" alt="review-avatar">
											</div>
														
											<!-- Data -->
											<div class="review-author">
												<h6>Evelyn Martinez</h6>
												<p class="p-sm">WordPress Consultant</p>
											</div>	

										</div>	<!-- End Author -->

									</div>	<!-- End Text -->

								</div>	<!-- END TESTIMONIAL #8 -->


							</div>
						</div>
					</div>	<!-- END TESTIMONIALS CAROUSEL -->


				</div>	   <!-- End container -->
			</section>	<!-- END TESTIMONIALS -->




			<!-- RATING
			============================================= -->
			<div class="pt-80 pb-100 rating-1 rating-section division">
				<div class="container">


					<!-- RATING TITLE -->
					<div class="row justify-content-center">	
						<div class="col-md-10 col-lg-9">
							<div class="rating-title mb-40">
								<h6 class="h6-md color--gray w-500">Our users love us as much as we love them</h6>
							</div>
						</div>
					</div>


					<!-- RATING WRAPPER -->
					<div class="rating-1-wrapper text-center">
						<div class="row justify-content-md-center row-cols-1 row-cols-md-3">


							<!-- RATING BOX #1 -->
							<div class="col">
								<div id="rb-1-1" class="rbox-1">

									<!-- Brand Logo -->
									<div class="rbox-1-img">
										<a href="#"><img class="img-fluid" src="{{ asset('assets/theme1/images/capterra-dark.png') }}" alt="brand-logo"></a>
									</div>

									<!-- Rating Stars -->
									<div class="star-rating ico-15 r-100 block--border block--shadow clearfix">
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star-half-empty mr-5"></span>	
										&nbsp; 4.7/5
									</div>

								</div>
							</div>


							<!-- RATING BOX #2 -->
							<div class="col">
								<div id="rb-1-2" class="rbox-1">

									<!-- Brand Logo -->
									<div class="rbox-1-img">
										<a href="#"><img class="img-fluid" src="{{ asset('assets/theme1/images/trustpilot-dark.png') }}" alt="brand-logo"></a>
									</div>

									<!-- Rating Stars -->
									<div class="star-rating ico-15 r-100 block--border block--shadow clearfix">
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star mr-5"></span>	
										&nbsp; 4.95/5
									</div>

								</div>
							</div>


							<!-- RATING BOX #3 -->
							<div class="col">
								<div id="rb-1-3" class="rbox-1">

									<!-- Brand Logo -->
									<div class="rbox-1-img">
										<a href="#"><img class="img-fluid" src="{{ asset('assets/theme1/images/growd-dark.png') }}" alt="brand-logo"></a>
									</div>

									<!-- Rating Stars -->
									<div class="star-rating ico-15 r-100 block--border block--shadow clearfix">
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star"></span>
										<span class="flaticon-star-1 mr-5"></span>	
										&nbsp; 4.24/5
									</div>

								</div>
							</div>


						</div>  <!-- End row -->
					</div>	<!-- END RATING WRAPPER -->

						
				</div>	<!-- End container -->
			</div>	<!-- END RATING -->




			<!-- BANNER
			============================================= -->
			<section id="download" class="banner-1 banner-section">
				<div class="container">


					<!-- BANNER WRAPPER -->
					<div class="banner-1-wrapper bg--01 bg--fixed r-24">
						<div class="banner-overlay">
							<div class="row d-flex align-items-center">


								<!-- BANNER TEXT -->
								<div class="col-md-7">
									<div class="banner-1-txt color--white">

										<!-- Title -->	
										<h2 class="h2-xl">Getting started with Pintex today!</h2>

										<!-- Text -->	
										<p class="p-lg">Aliquam augue suscipit luctus neque purus ipsum neque and dolor primis 
										   tempus suscipit cursus
										</p>

										<!-- STORE BADGES -->												
										<div class="stores-badge badge-img-md">

											<!-- AppStore -->
											<a href="#" class="store">
												<img class="appstore" src="{{ asset('assets/theme1/images/store_badges/appstore.png') }}" alt="appstore-badge">
											</a>
															
											<!-- Google Play -->
											<a href="#" class="store">
												<img class="googleplay" src="{{ asset('assets/theme1/images/store_badges/googleplay.png') }}" alt="googleplay-badge">
											</a> 
									
										</div>	<!-- END STORE BADGES -->	

										<!-- OS Prerequisite -->
										<div class="os-version-ext">
											<div class="star-rating clearfix ico-10">
												<span class="flaticon-star color--yellow"></span>
												<span class="flaticon-star color--yellow"></span>
												<span class="flaticon-star color--yellow"></span>
												<span class="flaticon-star color--yellow"></span>
												<span class="flaticon-star-half-empty color--yellow"></span>	
												<small>4,78K+ Pintex users reviews.</small>
											</div>		
										</div>

									</div>
								</div>	<!-- END BANNER TEXT -->


								<!-- BANNER QR CODE -->
								<div class="banner-qr-code">
									<img class="img-fluid" src="{{ asset('assets/theme1/images/qr-code.png') }}" alt="qr-code-image">
									<p>Scan to get Pintex App</p>
								</div>


							</div>   <!-- End row -->	
						</div>   <!-- End banner overlay -->	
					</div>    <!-- END BANNER WRAPPER -->


				</div>     <!-- End container -->	
			</section>	<!-- END BANNER -->




			<!-- FAQs
			============================================= -->
			<section id="faqs" class="py-100 faqs-1 faqs-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row justify-content-center">	
						<div class="col-md-9 col-lg-8">
							<div class="section-title text-center mb-60">	

								<!-- Title -->	
								<h2 class="h2-xl">Troubles with Pintex?</h2>	

								<!-- Text -->	
								<p class="p-lg">Some questions about Pintex are asked frequently. We've answered the most 
								   frequent of those frequent questions below
								</p>
								
							</div>	
						</div>
					</div>


					<!-- FAQs QUESTIONS -->	
					<div class="faqs-1-questions">
						<div class="row justify-content-center">


							<!-- QUESTIONS ACCORDION -->
							<div class="col-xl-11">
					 			<div class="accordion-wrapper">
									<ul class="accordion">


										<!-- QUESTION #1 -->
										<li class="accordion-item is-active wow animate__animated animate__fadeInUp">

											<!-- Question -->
											<div class="accordion-thumb">
												<h5>Get started with Pintex</h5>
											</div>

											<!-- Answer -->
											<div class="accordion-panel">

												<!-- Text -->	
									      		<p>Sagittis congue augue egestas volutpat ipsum egestas suscipit egestas magna 
									      		   ipsum cursus purus congue efficitur and ipsum primis dolor cubilia laoreet 
									      		   augue an egestas luctus donec dapibus and curabitur 
												</p>

											</div>

										</li>	<!-- END QUESTION #1 -->


										<!-- QUESTION #2 -->
										<li class="accordion-item wow animate__animated animate__fadeInUp">

											<!-- Question -->
											<div class="accordion-thumb">
												<h5>What devices are compatible with Pintex?</h5>
											</div>

											<!-- Answer -->
											<div class="accordion-panel">

										       	<!-- Text -->	
									      		<p>Sagittis congue augue egestas volutpat ipsum egestas suscipit egestas magna 
									      		   ipsum cursus purus congue efficitur and ipsum primis dolor cubilia laoreet 
									      		   augue an egestas luctus donec dapibus and curabitur 
												</p>
									        
									      		<!-- Text -->	
												<p>Sapien egestas, congue gestas diam posuere cubilia congue in ipsum mauris lectus 
												   laoreet gestas undo neque vitae ipsum auctor dolor luctus placerat a magna cursus congue nihil magna mpedit ligula congue and maecenas gravida porttitor quis congue vehicula magna luctus tempor quisque laoreet turpis. Viverra augue augue eget dictum tempor diam. Sed pulvinar consectetur  nibh, imperdiet varius viverra
												   cursus purus congue efficitur
												</p>

											</div>			

										</li>	<!-- END QUESTION #2 -->


										<!-- QUESTION #3 -->
										<li class="accordion-item wow animate__animated animate__fadeInUp">

											<!-- Question -->
											<div class="accordion-thumb">
												<h5>Update to the latest version of Pintex</h5>
											</div>

											<!-- Answer -->
											<div class="accordion-panel">
										       
												<!-- Text -->	
												<p>Sapien egestas, congue gestas diam posuere cubilia congue in ipsum mauris lectus 
												   laoreet gestas undo neque vitae ipsum auctor dolor luctus placerat a magna cursus congue nihil magna mpedit ligula congue and maecenas gravida porttitor quis congue vehicula magna luctus tempor quisque laoreet turpis. Viverra augue augue eget dictum tempor diam. Sed pulvinar consectetur  nibh, imperdiet varius viverra
												   cursus purus congue efficitur
												</p>

												<!-- Text -->	
									      		<p>Sagittis congue augue egestas volutpat ipsum egestas suscipit egestas magna 
									      		   ipsum cursus purus congue efficitur and ipsum primis dolor cubilia laoreet augue an egestas luctus donec dapibus and curabitur 
												</p>

											</div>
											
										</li>	<!-- END QUESTION #3 -->


										<!-- QUESTION #4 -->
										<li class="accordion-item wow animate__animated animate__fadeInUp">

											<!-- Question -->
											<div class="accordion-thumb">
												<h5>How do I choose a plan?</h5>
											</div>

											<!-- Answer -->
											<div class="accordion-panel">

												<!-- Text -->
												<ul class="simple-list">

													<li class="list-item">
														<p>Curabitur dapibus libero quisque eu congue tristique neque. Phasellus 
														   blandit tristique in justo lectus aliquam. Aliquam vitae molestie nunc. Quisque sapien justo, aliquet molestie sed purus, venenatis tempor gravida lacinia. Augue aliquam a suscipit tincidunt tincidunt massa 
														   porttitor ipsum
														</p>
													</li>

													<li class="list-item">
														<p>Aliquam vitae molestie nunc quisque sapien justo, aliquet non molestie
															purus, venenatis
														</p>
													</li>

													<li class="list-item">
														<p>Sagittis congue augue and egestas volutpat egestas magna suscipit an 
														   egestas magna ipsum vitae purus efficitur ipsum primis in cubilia laoreet
														   augue egestas luctus donec curabitur dapibus libero
														</p>
													</li>

												</ul>
										       
											</div>
											
										</li>	<!-- END QUESTION #4 -->


										<!-- QUESTION #5 -->
										<li class="accordion-item acc-last-item wow animate__animated animate__fadeInUp">

											<!-- Question -->
											<div class="accordion-thumb">
												<h5>What is the refund policy?</h5>
											</div>

											<!-- Answer -->
											<div class="accordion-panel">

												<!-- Text -->
									      		<p>An augue cubilia laoreet and magna suscipit egestas magna ipsum purus and felis 
									      		   primis augue ultrice ligula turpis egestas a suscipit lectus gestas integer congue a lectus porta neque phasellus blandit tristique
												</p> 

												<!-- Text -->	
									      		<p>Sagittis congue augue egestas volutpat diam egestas a magna suscipit egestas and 
									      		   magna ipsum vitae
												</p>

												<!-- Text -->	
									      		<p>Sagittis congue augue and egestas volutpat egestas and magna suscipit egestas 
									      		   magna ipsum vitae purus congue and efficitur ipsum primis in cubilia laoreet augue
									      		   egestas luctus donec and curabitur dapibus
												</p>

											</div>			

										</li>	<!-- END QUESTION #5 -->


									</ul>
								</div>
					 		</div>	<!-- END QUESTIONS ACCORDION -->


					 		<!-- MORE QUESTIONS -->	
							<div class="more-questions clearfix">
								<div class="more-questions-holder wow animate__animated animate__fadeInUp">
								
									<div class="more-questions-txt">
										<h6 class="h6-xl">Can’t find the answer to your question?</h6>
										<p class="p-sm">Contact us and we’ll get back to you as soon as we can.</p>
									</div>

									<div class="more-questions-btn">
										<a href="contacts.html" class="btn r-36 btn--theme hover--tra-black">Contact Us</a>
									</div>

								</div>
							</div>


						</div>  <!-- End row -->	
					</div>	<!-- END FAQs QUESTIONS -->	


				</div>	   <!-- End container  -->
			</section>	<!-- END FAQs -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- NEWSLETTER
			============================================= -->
			<section class="newsletter-1 newsletter-section division">
				<div class="newsletter-overlay">
					<div class="container">
						<div class="row d-flex align-items-center row-cols-1 row-cols-lg-2">


							<!-- NEWSLETTER TEXT -->	
							<div class="col">
								<div class="newsletter-txt">	
									<h4 class="h4-lg">Stay up to date with our news, ideas and updates</h4>	
								</div>								
							</div>


							<!-- NEWSLETTER FORM -->
							<div class="col">
								<form class="newsletter-form">
											
									<div class="input-group">
										<input type="email" autocomplete="off" class="form-control" placeholder="Your email address" required id="s-email">								
										<span class="input-group-btn">
											<button type="submit" class="btn btn--theme hover--black">Subscribe Now</button>
										</span>										
									</div>

									<!-- Newsletter Form Notification -->	
									<label for="s-email" class="form-notification"></label>
												
								</form>							
							</div>	  <!-- END NEWSLETTER FORM -->


						</div>	  <!-- End row -->
					</div>    <!-- End container -->	
				</div>     <!-- End newsletter-overlay -->
			</section>	<!-- END NEWSLETTER -->




			<!-- DIVIDER LINE -->
			<hr class="divider">




			<!-- FOOTER
			============================================= -->
			<footer class="pt-100 footer-3 footer division">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">


						<!-- FOOTER INFO -->
						<div class="col-lg-3">
							<div class="footer-info">

								<!-- LOGO -->
								<img class="footer-logo" src="{{ asset('assets/theme1/images/logo-white.png') }}" alt="footer-logo">

								<!-- QR CODE -->
								<div class="footer-qr-code r-16">
									<img class="img-fluid" src="{{ asset('assets/theme1/images/qr-code.png') }}" alt="qr-code-image">
								</div>

							</div>	
						</div>


						<!-- FOOTER LINKS -->
						<div class="col-md-9 col-lg-6 col-xl-7">
							<div class='row footer-links clearfix'>
					

								<!-- FOOTER LINKS #1 -->
							 	<div class="col-md-4">
							 		<div class="fl-1">
							 		
								 		<!-- Title -->
								        <h6 class="d-title">Pintex</h6>
								        <h6 class="m-title">Pintex</h6>

									    <!-- Links -->
								     	<ul class="foo-links clearfix">
											<li><p><a href="features.html">Why Pintex?</a></p></li>
											<li><p><a href="changelog.html">What’s New</a></p></li>		
											<li><p><a href="pricing-2.html">Pricing Plans</a></p></li>
											<li><p><a href="download.html">Download</a></p></li>								
										</ul>

									</div>
							    </div>	<!-- END FOOTER LINKS #1 -->


							    <!-- FOOTER LINKS #2 -->
							 	<div class="col-md-4">
							 		<div class="fl-2">

								 		<!-- Title -->
								        <h6 class="d-title">Discover</h6>
						        		<h6 class="m-title">Discover</h6>

									    <!-- Links -->
								     	<ul class="foo-links clearfix">				
											<li><p><a href="reviews.html">Testimonials</a></p></li>
											<li><p><a href="faqs.html">Help & Support</a></p></li>	
											<li><p><a href="contacts.html">Editor Help</a></p></li>
											<li><p><a href="more-apps.html">More Products</a></p></li>			
										</ul>

									</div>
							    </div>	<!-- END FOOTER LINKS #2 -->


							    <!-- FOOTER LINKS #3 -->
							 	<div class="col-md-4">
							 		<div class="fl-3">

								 		<!-- Title -->
								        <h6 class="d-title">Company</h6>
									    <h6 class="m-title">Company</h6>

									    <!-- Links -->
								     	<ul class="foo-links clearfix">
											<li><p><a href="about.html">About Us</a></p></li>	
											<li><p><a href="careers.html">Careers</a></p></li>
											<li><p><a href="blog-listing.html">Our Blog</a></p></li>
											<li><p><a href="contacts.html">Contact Us</a></p></li>				
										</ul>

									</div>
							    </div>	<!-- END FOOTER LINKS #3 -->


							</div>
						</div>	<!-- END FOOTER LINKS -->


						<!-- FOOTER CONNECT -->
						<div class="col-md-3 col-lg-3 col-xl-2">
							<div class="footer-connect">
												
								<!-- Title -->
								<h6>Connect With Us</h6>

								<!-- Social Links -->	
								<ul class="footer-socials ico-25 clearfix">		
									<li><a href="#"><span class="flaticon-facebook"></span></a></li>
									<li><a href="#"><span class="flaticon-twitter-1"></span></a></li>
									<li><a href="#"><span class="flaticon-github"></span></a></li>
									<li><a href="#"><span class="flaticon-youtube"></span></a></li>
								</ul>

							</div>	
						</div>	


					</div>	<!-- END FOOTER CONTENT -->


					<hr>	<!-- FOOTER DIVIDER LINE -->	


					<!-- BOTTOM FOOTER -->
					<div class="bottom-footer">
						<div class="row row-cols-1 row-cols-md-2 d-flex align-items-center">


							<!-- FOOTER COPYRIGHT -->
							<div class="col">
								<div class="footer-copyright"><p class="p-sm">&copy; 2024 Pintex. <span>All Rights Reserved</span></p></div>
							</div>


							<!-- FOOTER LINKS -->
							<div class="col">
								<ul class="bottom-footer-list ico-10 text-end">
									<li><p class="p-sm"><a href="privacy.html">Privacy Policy</a></p></li>
									<li class="footer-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
									<li><p class="p-sm"><a href="terms.html">Terms & Conditions</a></p></li>
								</ul>
							</div>


						</div>  <!-- End row -->
					</div>	<!-- BOTTOM FOOTER -->


				</div>     <!-- End container -->	
			</footer>   <!-- END FOOTER -->

    </div>





    <!-- EXTERNAL SCRIPTS ============================================= -->
    <script src="{{ asset('assets/theme1/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/menu.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/lunar.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/wow.js') }}"></script>
    <script src="{{ asset('assets/theme1/js/cookies-message.js') }}"></script>

    <!-- Custom Script -->
    <script src="{{ asset('assets/theme1/js/custom.js') }}"></script>




    <!-- COOKIES MESSAGE -->
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $.CookiesMessage();
            }, 1800)
        });
    </script>

    <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
    <!--
  <script>
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-XXXXX-X']);
      _gaq.push(['_trackPageview']);

      (function() {
          var ga = document.createElement('script');
          ga.type = 'text/javascript';
          ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
              '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(ga, s);
      })();
  </script>
  -->

    <script>
        $(document).on({
            "contextmenu": function(e) {
                console.log("ctx menu button:", e.which);

                // Stop the context menu
                e.preventDefault();
            },
            "mousedown": function(e) {
                console.log("normal mouse down:", e.which);
            },
            "mouseup": function(e) {
                console.log("normal mouse up:", e.which);
            }
        });
    </script>


</body>



</html>











