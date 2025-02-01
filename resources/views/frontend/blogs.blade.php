@extends('layouts.theme1')
@section('content')

@php
      $blogContent  = get_content("content_blog")->first();
  @endphp


      <!-- BLOG POSTS LISTING
      ============================================= -->
      <section id="blog-page" class="pb-40 inner-page-hero blog-page-section division">
        <div class="container">


          <!-- WIDE BLOG POST -->
          <div class="blog-post wide-post wow animate__animated animate__fadeInUp">
            <div class="row d-flex align-items-center">

              <!-- BLOG POST TEXT -->


              <div class="col-md-12">
                <div class="blog-post-txt">

                  <!-- Post Tag -->
                  <div class="subtitle"></div>
                  <span class="post-tag color--theme">{{@$blogContent->value->sub_title}}</span>  

                  <!-- Post Link -->
                  <h4 class="h4-xl">
                    <a href="single-post.html">@php echo (@$blogContent->value->title) @endphp
                    </a>
                  </h4>
                  <!-- Text -->
                  <p>{{@$blogContent->value->description}}</p>

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
              @forelse ($blogs as $blog)

              <!-- BLOG POST #1 -->
              <div class="col">
                <div class="blog-post wow animate__animated animate__fadeInUp">

                  <!-- BLOG POST IMAGE -->
                  <div class="blog-post-img r-12">
                    <img class="img-fluid" src='{{imageURL(@$blog->file,"blog",true)}}'
                                  alt="{{@$blog->file->name ?? 'blog-image.jpg'}}"/>
                  </div>

                  <!-- BLOG POST TEXT -->
                  <div class="blog-post-txt">

                    <!-- Post Tag -->
                    <span class="post-tag color--theme">Tutorials</span>  

                    <!-- Post Link -->
                    <h6 class="h6-xl">{{$blog->title}}</h6>

                    <!-- Short Description -->
                    <p>{{$blog->description}}</p>

  

                  </div>  <!-- END BLOG POST TEXT -->

                </div>
              </div>  <!-- END  BLOG POST #1 -->

              @empty

            @endforelse


             





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
                    {{$blogs->links() }}
                </ul>
              </nav>
            </div>
          </div>  <!-- End row -->  
        </div> <!-- End container -->
      </div>  <!-- END PAGE PAGINATION -->



@endsection

