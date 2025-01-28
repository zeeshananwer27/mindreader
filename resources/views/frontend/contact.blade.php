@extends('layouts.theme1')
@section('content')

@php

   $file         = $contact_section->file->where("type",'image')->first();
   $size         = get_appearance_img_size('contact_us','content','image');

@endphp

      <!-- CONTACTS
      ============================================= -->
      <section class="pb-40 inner-page-hero contacts-1 contacts-section division">        
        <div class="container">


          <!-- SECTION TITLE -->  
          <div class="row justify-content-center">  
            <div class="col-md-9 col-xl-8">
              <div class="section-title text-center mb-80">

                <!-- Title -->    
                <h2 class="h2-title">Questions? Let's Talk</h2>

                <!-- Text -->     
                <p class="p-lg">Want to learn more about Pintex, get a quote, or speak with an expert? 
                  Let us know what you are looking for and we’ll get back to you right away
                </p>
              </div>  
            </div>
          </div>


          <!-- CONTACT FORM -->
          <div class="row justify-content-center">  
            <div class="col-md-11 col-lg-9 col-xl-8">
              <div class="form-holder">
                <form action = "{{route('contact.store')}}" name="contactform" class="row contact-form" method="post">
                  @csrf
                  <!-- Form Select -->
                                            
                  <!-- Contact Form Input -->
                  <div class="col-md-12">
                    <p>{{translate("Name")}}: </p>
                    <input type="text" name="name" value = "{{old('name')}}" class="form-control name" placeholder="{{translate('Name')}}"> 
                  </div>
                  
                  <div class="col-md-12">
                    <p>{{translate("Phone")}}: </p>
                    <input type="text" name="phone" value = "{{old('phone')}}" class="form-control name" placeholder="{{translate('Phone')}}"> 
                  </div>

                  <div  class="col-md-12">
                    <p>Your Email Address: </p>
                    <input type="email" name="email" value = "{{old('email')}}" class="form-control email" placeholder="{{translate('Email')}}"> 
                  </div>
                  
                  <div  class="col-md-12">
                    <p>{{translate("Subject")}}: </p>
                    <input type="text" name="subject" value = "{{old('subject')}}" class="form-control email" placeholder="{{translate('Subject')}}"> 
                  </div>

                  <div class="col-md-12">
                    <p>Explain your question in details: </p>
                    <textarea class="form-control message" name="message" rows="6" placeholder="{{translate('Message')}}"> {{old('message')}} </textarea>
                  </div> 
                                            
                  <!-- Contact Form Button -->
                  <div class="col-md-12 mt-15 form-btn text-right"> 
                    <button type="submit" class="btn r-36 btn--theme hover--black submit">{{translate("Send Message")}}</button> 
                  </div>
                                                              
                  <!-- Contact Form Message -->
                  <div class="col-lg-12 contact-form-msg">
                    <span class="loading"></span>
                  </div>  
                                              
                </form> 
              </div>  
            </div>  
          </div>     <!-- END CONTACT FORM -->


        </div>     <!-- End container --> 
      </section>  <!-- END CONTACTS -->

@endsection

