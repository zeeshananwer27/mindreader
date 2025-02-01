@php
   $aboutContent  = get_content("content_about")->first();
   $aboutElements = get_content("element_about");

   $aboutCounters = get_content("element_about_counter");

@endphp


      <!-- FEATURES
      ============================================= -->
      <section id="features" class="py-100 features-2 features-section division">
        <div class="container">


          <!-- SECTION TITLE -->  
          <div class="row justify-content-center">  
            <div class="col-md-9 col-lg-8">
              <div class="section-title text-center mb-80"> 
                
                <div class="subtitle">{{@$aboutContent->value->sub_title}}</div>
                <!-- Title -->  
                <h2 class="h2-xl">@php echo @$aboutContent->value->title @endphp </h2>

                <!-- Text -->
                <p class="p-lg">{{@$aboutContent->value->description}}</p>

              </div>  
            </div>
          </div>

          <!-- FEATURES WRAPPER -->
          <div class="fbox-wrapper">
            <div class="row row-cols-1 row-cols-md-2 rows-2">

              @foreach ($aboutElements as $about)
              <!-- FEATURE BOX #1 -->
              <div class="col">
                <div class="fbox-2 fb-1 wow animate_animated animatefadeInUp animate_delay-1">

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
                  </div>  <!-- End Icon -->

                  <!-- Text -->
                  <div class="fbox-txt">
                    <h5>{{@$about->value->title}}</h5>
                    <p>{{@$about->value->description}}</p>
                  </div>

                </div>
              </div>  <!-- END FEATURE BOX #1 --> 
              @endforeach


            </div>  <!-- End row -->  
          </div>  <!-- END FEATURES WRAPPER -->
          
        </div>     <!-- End container -->
      </section>  <!-- END FEATURES -->