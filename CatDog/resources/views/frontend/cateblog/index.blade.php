@extends('layouts.master')


@section('content')

   <!--section-heading-->
   <div class="section-heading " >
       <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>{{ $category->title }}</h1>
                            <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>


    <!-- Blog Layout-2-->
    <section class="blog-layout-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--post 1-->
                    @forelse ($blogs as $blog)
                        <div class="post-list post-list-style2">
                            <div class="post-list-image">
                                <a href="post-single.html">
                                    <img src="{{ asset('upload/blog') }}\{{ $blog->thumbnail }}" alt="" style="height: 95%;width:90%">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <h3 class="entry-title">
                                    <a href="post-single.html">{{ $blog->title }}</a>
                                </h3>
                                <ul class="entry-meta">
                                    @if ($blog->oneuser->image == 'CatDog.jpg')
                                    <li class="post-author-img"><img src="{{ Avatar::create($blog->oneuser->name)->toBase64(); }}" alt=""></li>
                                    @else
                                    <li class="post-author-img"><img src="{{ asset('upload/default/CatDog.jpg') }}" alt=""></li>
                                    @endif
                                    <li class="post-author"> <a href="author.html">{{ $blog->oneuser->name }}</a></li>
                                    <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{ $blog->oneuser->role }}</a></li>
                                    <li class="post-date"> <span class="line"></span>{{ Carbon\Carbon::parse($blog->created_at )->format('F D ,Y') }}</li>
                                </ul>
                                <div class="post-exerpt">
                                    <p>{!! $blog->short_description !!}</p>
                                </div>
                                <div class="post-btn">
                                    <a href="post-single.html" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                     <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html" style="padding-left: 80%">
                                <img src="{{ Avatar::create('No Data Found..!')->toBase64(); }}" alt=""
                                style="padding-bottom: 10%">
                            </a>
                        </div>
                        <div class="post-list-content" style="margin-left:-20%">
                            <h3 class="entry-title text-danger" style=" padding-top: 40%">
                                There Have No Data..!
                            </h3>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>


   <!--pagination-->
   <div class="pagination">
        <div class="container-fluid">
            <div class="pagination-area">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
