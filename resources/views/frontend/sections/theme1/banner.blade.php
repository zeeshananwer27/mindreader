@php

   $bannerContent      = get_content("content_banner")->first();
   $bannerElements     = get_content("element_banner");
   $bannerIMG          = @$bannerContent->file?->where("type",'banner_image')->first();
   $bannerSize         = get_appearance_img_size('banner','content','banner_image');
   $titleVector        = @$bannerContent->file?->where("type",'title_vector_image')->first();
   $titleVectorSize    = get_appearance_img_size('banner','content','title_vector_image');
   $bannerElementSize  = get_appearance_img_size('banner','element','image');

@endphp



            <!-- HERO
            ============================================= -->   
            

            <section id="hero-9" class="bg--fixed hero-section division">
                <div class="container"> 
                    <div class="row d-flex align-items-center">


                        <!-- HERO TEXT -->
                        <div class="col-md-6">
                            <div class="hero-9-txt wow animate__animated animate__fadeInRight">

                                <!-- Title -->
                                <h2>

                                     @php echo (@$bannerContent->value->title) @endphp

                                </h2>

                                <!-- Text -->
                                <p class="p-lg">
                                    {{@$bannerContent->value->description}}
                                </p>

                    

                            </div>
                        </div>  <!-- END HERO TEXT -->  


                        <!-- HERO IMAGE -->
                        <div class="col-md-6">  
                            <div class="hero-9-img wow animate__animated animate__fadeInLeft">              
                                <img class="img-fluid" src="{{imageURL($bannerIMG,'frontend',true,$bannerSize)}}" alt="{{@$titleVector->file->name??'banner.jpg'}}">                        
                            </div>
                        </div>


                    </div>    <!-- End row -->  
                </div>     <!-- End container --> 
            </section>  

            <!-- END HERO -->
