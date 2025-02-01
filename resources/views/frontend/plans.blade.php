@extends('layouts.theme1')
@section('content')


@php
   $content  = get_content("content_plan")->first();
   $content = $content->value;

@endphp

<?php 

 //echo "<pre>"; print_r($plans); exit(' vii'); 



?>


            <!-- PRICING
            ============================================= -->
            <section class="gr--whitesmoke py-100 pricing-2 inner-page-hero pricing-section division">
                <div class="container">


                    <!-- SECTION TITLE -->  
                    <div class="row justify-content-center">    
                        <div class="col-md-9 col-lg-8">
                            <div class="section-title mb-60 text-center">   

                                <!-- Title -->
                                <h2 class="h2-title">{{$content->title}}</h2>

                                <!-- Text -->
                                <p class="p-lg">{{$content->description}}</p>

                            </div>  
                        </div>
                    </div>  <!-- END SECTION TITLE -->  


                    <!-- PRICING TABLES -->
                    <div class="pricing-2-wrapper">
                        <div class="row">

                        @foreach($plans as $plan)
                            <!-- FREE PLAN -->
                            <div class="col-md-4">
                                <div id="pt-2-1" class="p-table pricing-2-table bg--white r-24 wow animate__animated animate__fadeInUp animate__delay-1">   


                                    <!-- TABLE HEADER -->   
                                    <div class="pricing-table-header text-center">

                                        <!-- Title -->
                                        <h5 class="h5-md color--theme">{{ $plan->title }}</h5>

                                        <!-- Price -->  
                                        <div class="price">                             
                                            <sup>$</sup>                                
                                            <span>{{ $plan->price }}</span>
                                            <sup class="validity">&nbsp;/&ensp;mo</sup>
                                        </div>

                                    </div>  <!-- END TABLE HEADER -->   

                                    <!-- PRICING FEATURES -->
                                    <ul class="pricing-features ico-10 ico--theme-2">
                                        <li><p><span class="flaticon-check"></span> {{ $plan->social_access}}</p></li>
                                        <li><p><span class="flaticon-check"></span> {{$plan->ai_configuration}}</p></li>
                                        <li><p><span class="flaticon-check"></span> No Ads. No trackers</p></li>
                                        <li><p><span class="flaticon-check"></span> 12/5 email support</p></li>
                                    </ul>   

                                </div>
                            </div>  <!-- END FREE PLAN -->

                        @endforeach
                        

                        </div>
                    </div>  <!-- PRICING TABLES -->


                </div>     <!-- End container -->
            </section>  <!-- END PRICING -->




@endsection

@section('modal')
    @include('modal.plan_subscribe')
@endsection