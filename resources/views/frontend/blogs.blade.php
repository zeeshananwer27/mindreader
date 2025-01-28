@extends('layouts.theme1')
@section('content')

      <!-- BLOG POSTS LISTING
      ============================================= -->
      <section id="blog-page" class="pb-40 inner-page-hero blog-page-section division">
        <div class="container">


          <!-- WIDE BLOG POST -->
          <div class="blog-post wide-post wow animate__animated animate__fadeInUp">
            <div class="row d-flex align-items-center">


              <!-- BLOG POST IMAGE -->
              <div class="col-md-6">
                <div class="blog-post-img r-12">
                  <img class="img-fluid" src="{{ asset('assets/theme1/images/img-10.jpg') }}" alt="blog-post-image">
                </div>  
              </div>


              <!-- BLOG POST TEXT -->
              <div class="col-md-6">
                <div class="blog-post-txt">

                  <!-- Post Tag -->
                  <span class="post-tag color--theme">Tutorials</span>  

                  <!-- Post Link -->
                  <h4 class="h4-xl">
                    <a href="single-post.html">Posuere tempor aliquet and Pintex sapien turpis laoreet augue
                       posuere
                    </a>
                  </h4>

                  <!-- Text -->
                  <p>Aliqum mullam blandit vitae tempor in sapien and donec lipsum gravida porta augue velna 
                     dolor libero an aliquet risus tempus a tempor posuere velna tempus posuere
                  </p>

                  <!-- Post Meta -->
                  <div class="blog-post-meta">
                    <ul class="post-meta-list ico-10">
                      <li><p>July 31, 2024</p></li>
                      <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                      <li><p>8 min read</p></li>
                    </ul>
                  </div>

                </div>
              </div>  <!-- END BLOG POST TEXT -->


            </div>  <!-- End row -->
          </div>  <!-- END WIDE BLOG POST -->


          <!-- BLOG POSTS CATEGORY --> 
          <div class="row">
            <div class="col">
              <div class="posts-category ico-20 animate__animated animate__fadeInUp">
                <h4>Latest News <span class="flaticon-next"></span></h4>
              </div>
            </div>
          </div>


          <!-- POSTS WRAPPER -->
          <div class="posts-wrapper">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">


              <!-- BLOG POST #1 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-01.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Tutorials</span>  

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Integer posuere AI donec ipsum a porta justo auctor</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Sagittis congue augue egestas a velna integer purus filis magna suscipit...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">July 25, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">8 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #1 -->


              <!-- BLOG POST #2 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-02.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Pintex News</span>  

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">A ligula risus diam auctor</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Congue sagittis augue egestas velna integer and purus filis suscipit magna felis turpis 
                       and blandit augue mauris..
                    </p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">July 19, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">5 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #2 -->


              <!-- BLOG POST #3 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-03.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Insights</span> 

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Donec sapien augue and integer turpis cursus</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Congue sagittis augue egestas a velna integer purus filis suscipit magna...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">July 02, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">6 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #3 -->


              <!-- BLOG POST #4 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-04.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Pintex News</span>  

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Risus ociis integer auctor</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Congue sagittis augue egestas velna integer and purus filis suscipit magna felis turpis 
                       and blandit augue mauris..
                    </p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">June 26, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">8 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #4 -->


              <!-- BLOG POST #5 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-05.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Guides</span> 

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Sagittis sapien augue undo integer turpis cursus</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Congue sagittis augue egestas a velna integer purus filis suscipit magna...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">June 11, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">7 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #5 -->


              <!-- BLOG POST #6 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-06.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Pintex News</span>  

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Turpis integer urna donec ipsum a porta auctor justo</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Sagittis congue augue egestas a velna integer purus filis magna suscipit...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">June 04, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">10 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #6 -->


              <!-- BLOG POST #7 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-07.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Guides</span> 

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Donec sapien augue and integer turpis cursus</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Congue sagittis augue egestas a velna integer purus filis suscipit magna...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">May 25, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">9 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #7 -->


              <!-- BLOG POST #8 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-08.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Insights</span> 

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Augue sapien sagittis diam integer turpis cursus purus 
                         and filis suscipit magna
                      </a>
                    </h5>

                    <!-- Short Description -->
                    <p>Congue sagittis augue egestas a velna integer purus filis suscipit magna...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">May 20, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">5 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #8 -->


              <!-- BLOG POST #9 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src="{{ asset('assets/theme1/images/img-09.jpg') }}" alt="blog-post-image">
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Tutorials</span>  

                    <!-- Post Link -->
                    <h5>
                      <a href="single-post.html">Integer posuere AI donec ipsum a porta justo auctor</a>
                    </h5>

                    <!-- Short Description -->
                    <p>Sagittis congue augue egestas a velna integer purus filis magna suscipit...</p>

                    <!-- Post Meta -->
                    <div class="blog-post-meta">
                      <ul class="post-meta-list ico-10">
                        <li><p class="p-sm">May 18, 2024</p></li>
                        <li class="meta-list-divider"><p><span class="flaticon-minus-1"></span></p></li>
                        <li><p class="p-sm">8 min read</p></li>
                      </ul>
                    </div>  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #9 -->


            </div>  <!-- End row -->
          </div>  <!-- END POSTS WRAPPER -->


        </div>     <!-- End container --> 
      </section>  <!-- END BLOG POSTS LISTING -->




      <!-- PAGE PAGINATION
      ============================================= -->
      <div class="pb-100 page-pagination">
        <div class="container">
          <div class="row"> 
            <div class="col-md-12">
              <nav aria-label="Page navigation">
                <ul class="pagination ico-20 justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><span class="flaticon-back"></span></a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span class="flaticon-next"></span></a></li>
                </ul>
              </nav>
            </div>
          </div>  <!-- End row -->  
        </div> <!-- End container -->
      </div>  <!-- END PAGE PAGINATION -->



@endsection

