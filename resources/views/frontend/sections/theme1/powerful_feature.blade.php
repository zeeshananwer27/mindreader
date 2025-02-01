
@php

   $featureContent        = get_content("content_powerful_feature")->first();
   $featureElements       = get_content("element_powerful_feature");
   $featureImageSize      = get_appearance_img_size('powerful_feature','content','feature_image');
   $featureImage          = @$featureContent->file?->where("type",'feature_image')->first();

@endphp
<!--Start Powerful Features -->

            <!-- TEXT CONTENT
            ============================================= -->
            <section class="pt-100 ct-01 content-section division">
                <div class="container">
                    <div class="row d-flex align-items-center">


                        <!-- IMAGE BLOCK -->
                        <div class="col-md-6">
                            <div class="img-block left-column wow animate__animated animate__fadeInRight">
                                <img src="{{imageURL($featureImage,'frontend',true,$featureImageSize)}}" class="rounded-5 img-fluid" alt="{{ @$featureImage->name ?? 'feature.jpg'}}">
                            </div>
                        </div>


                        <!-- TEXT BLOCK --> 
                        <div class="col-md-6">
                            <div class="txt-block right-column wow animate__animated animate__fadeInLeft">

                                <!-- Title -->
                                <div class="subtitle">{{@$featureContent->value->sub_title}}</div>
                                <h2 class="h2-md">@php echo (@$featureContent->value->title) @endphp</h2>

                                <!-- Text -->   
                                <p>{{@$featureContent->value->description}}
                                </p>

                                <!-- Text -->   
                                <p><ul class="power-feature-list">
                                    @forelse($featureElements as $feature)
                                    <li>
                                        <div class="icon">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </div>
                                        <div class="content">
                                            <h5>
                                                {{$feature->value->title}}
                                            </h5>
                                            <p> {{$feature->value->description}}</p>
                                        </div>
                                    </li>
                                    @empty
                                    <li>
                                        @include("frontend.partials.not_found")
                                    </li>
                                    @endforelse

                                </ul>
                            </p>

                            </div>
                        </div>  <!-- END TEXT BLOCK --> 


                    </div>    <!-- End row -->
                </div>     <!-- End container -->
            </section>  <!-- END TEXT CONTENT -->


            <!-- End of Powerful Features -->