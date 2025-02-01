@php
   $blogContent  = get_content("content_blog")->first();
   $blogs        = get_feature_blogs()->take(3);
   
@endphp


      <!-- FEATURES
      ============================================= -->
      <section class="py-100 features-6 features-section division">
        <div class="container">


          <!-- SECTION TITLE -->  
          <div class="row justify-content-center">  
            <div class="col-md-8">
              <div class="section-title text-center mb-80"> 

                <!-- Title -->  
                <div class="subtitle">{{@$blogContent->value->sub_title}}</div>
                <h2 class="h2-title">@php echo (@$blogContent->value->title) @endphp</h2>  
                <!-- Text -->
                <p class="p-lg">{{@$blogContent->value->description}}</p>
                  
              </div>  
            </div>
          </div>


          <!-- FEATURES WRAPPER -->
          <div class="fbox-wrapper text-center">
            <div class="row row-cols-1 row-cols-md-3">

              <!-- FEATURE BOX #1 -->
              @forelse ($blogs as $blog)
              <div class="col">
                <div class="fbox-6 fb-1 wow animate_animated animatefadeInUp animate_delay-1">

                  <!-- Image -->
                  <div class="fbox-img h-180">
                    <img class="img-fluid" src='{{imageURL(@$blog->file,"blog",true)}}'
                                  alt="{{@$blog->file->name ?? 'blog-image.jpg'}}"/>
                  </div>

                  <!-- Text -->
                  <div class="fbox-txt">
                    <h6 class="h6-xl">{{$blog->title}}</h6>
                    <p>{{$blog->description}}
                    </p>
                  </div>

                </div>
              </div>  <!-- END FEATURE BOX #1 --> 
            @empty

            @endforelse

            </div>  <!-- End row -->  
          </div>  <!-- END FEATURES WRAPPER -->


        </div>     <!-- End container -->
      </section>  <!-- END FEATURES -->

