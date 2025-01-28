@extends('layouts.theme1')
@section('content')

            <!-- PRICING
            ============================================= -->
            <section class="gr--whitesmoke py-100 pricing-2 inner-page-hero pricing-section division">
                <div class="container">


                    <!-- SECTION TITLE -->  
                    <div class="row justify-content-center">    
                        <div class="col-md-9 col-lg-8">
                            <div class="section-title mb-60 text-center">   

                                <!-- Title -->
                                <h2 class="h2-title">Start, Connect, Enjoy</h2>

                                <!-- Text -->
                                <p class="p-lg">Ligula risus auctor tempus magna feugiat lacinia laoreet sapien luctus</p>

                            </div>  
                        </div>
                    </div>  <!-- END SECTION TITLE -->  


                    <!-- PRICING TABLES -->
                    <div class="pricing-2-wrapper">
                        <div class="row">


                            <!-- FREE PLAN -->
                            <div class="col-md-4">
                                <div id="pt-2-1" class="p-table pricing-2-table bg--white r-24 wow animate__animated animate__fadeInUp animate__delay-1">   


                                    <!-- TABLE HEADER -->   
                                    <div class="pricing-table-header text-center">

                                        <!-- Title -->
                                        <h5 class="h5-md color--theme">Pintex Free</h5>

                                        <!-- Price -->  
                                        <div class="price">                             
                                            <sup>$</sup>                                
                                            <span>0.00</span>
                                            <sup class="validity">&nbsp;/&ensp;mo</sup>
                                        </div>

                                    </div>  <!-- END TABLE HEADER -->   

                                    <!-- PRICING FEATURES -->
                                    <ul class="pricing-features ico-10 ico--theme-2">
                                        <li><p><span class="flaticon-check"></span> 1 GB of cloud storage</p></li>
                                        <li><p><span class="flaticon-check"></span> Weekly data backup</p></li>
                                        <li><p><span class="flaticon-check"></span> No Ads. No trackers</p></li>
                                        <li><p><span class="flaticon-check"></span> 12/5 email support</p></li>
                                    </ul>   

                                </div>
                            </div>  <!-- END FREE PLAN -->


                            <!-- PREMIUM PLAN -->
                            <div class="col-md-4">


                                <!-- PRICING TABLE -->  
                                <div id="pt-2-2" class="p-table pricing-2-table bg--white r-24 wow animate__animated animate__fadeInUp animate__delay-2">   


                                    <!-- TABLE HEADER -->
                                    <div class="pricing-table-header text-center">

                                        <!-- Title -->
                                        <h5 class="h5-md color--theme">Pintex PRO</h5>

                                        <!-- Price -->  
                                        <div class="price">                             
                                            <sup>$</sup>                                
                                            <span>4.99</span>
                                            <sup class="validity">&nbsp;/&ensp;mo</sup>
                                        </div>

                                    </div>  <!-- END TABLE HEADER -->

                                    <!-- PRICING FEATURES -->
                                    <ul class="pricing-features ico-10 ico--theme-2">
                                        <li><p><span class="flaticon-check"></span> 15 GB of cloud storage</p></li>
                                        <li><p><span class="flaticon-check"></span> Daily data backup</p></li>
                                        <li><p><span class="flaticon-check"></span> No Ads. No trackers</p></li>
                                        <li><p><span class="flaticon-check"></span> 24/7 email support</p></li>
                                    </ul>   

                                </div>  <!-- END PRICING TABLE -->  


                            </div>  <!-- END PREMIUM PLAN  -->


                            <!-- PREMIUM PLAN -->
                            <div class="col-md-4">


                                <!-- PRICING TABLE -->  
                                <div id="pt-2-3" class="p-table pricing-2-table bg--white r-24 wow animate__animated animate__fadeInUp animate__delay-3">   


                                    <!-- TABLE HEADER -->
                                    <div class="pricing-table-header text-center">

                                        <!-- Title -->
                                        <h5 class="h5-md color--theme">Pintex Family</h5>

                                        <!-- Price -->  
                                        <div class="price">                             
                                            <sup>$</sup>                                
                                            <span>9.99</span>
                                            <sup class="validity">&nbsp;/&ensp;mo</sup>
                                        </div>

                                    </div>  <!-- END TABLE HEADER -->

                                    <!-- PRICING FEATURES -->
                                    <ul class="pricing-features ico-10 ico--theme-2">
                                        <li><p><span class="flaticon-check"></span> 15 GB of cloud storage</p></li>
                                        <li><p><span class="flaticon-check"></span> Daily data backup</p></li>
                                        <li><p><span class="flaticon-check"></span> No Ads. No trackers</p></li>
                                        <li><p><span class="flaticon-check"></span> 24/7 email support</p></li>
                                    </ul>   

                                </div>  <!-- END PRICING TABLE -->  


                            </div>  <!-- END PREMIUM PLAN  -->


                        </div>
                    </div>  <!-- PRICING TABLES -->


                    <!-- PRICING NOTICE TEXT -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-9">
                            <div class="pricing-notice wow animate__animated animate__fadeInUp">    

                                <!-- Text -->
                                <p class="p-sm ">The above prices don't include applicable taxes based on your billing address.
                                   The final price will be displayed on the checkout page, before the payment is completed
                                </p>

                            </div>  
                        </div>
                    </div>  <!-- END PRICING NOTICE TEXT -->


                </div>     <!-- End container -->
            </section>  <!-- END PRICING -->




@endsection

@section('modal')
    @include('modal.plan_subscribe')
@endsection