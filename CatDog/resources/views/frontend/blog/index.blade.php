@extends('layouts.master')


@section('content')

<div class="search-icon">
    <i class="las la-search"></i>
</div>
<!--button-subscribe-->
<div class="botton-sub">
    <a href="signup.html" class="btn-subscribe">Sign Up</a>
</div>
<!--navbar-toggler-->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
</div>
</div>
</div>
</header>

<!--section-heading-->
<div class="section-heading " >
<div class="container-fluid">
<div class="section-heading-2">
<div class="row">
<div class="col-lg-12">
    <div class="section-heading-2-title">
        <h1>Blog's Page</h1>
        <p class="links"><a href="{{ route('frontend') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
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
@foreach ($blogs as $blog)
        <div class="post-list post-list-style2">
            <div class="post-list-image" style="height: 30%;width:30%">
                <a href="post-single.html">
                    <img src="{{ asset('upload/blog') }}/{{ $blog->thumbnail }}" alt="">
                </a>
            </div>
            <div class="post-list-content">
                <h3 class="entry-title">
                    <a href="post-single.html">{{ $blog->title }}.</a>
                </h3>
                <ul class="entry-meta">
                    <li class="post-author-img"><img src="{{ Avatar::create($blog->oneuser->name)->toBase64(); }}" alt=""></li>
                    <li class="post-author"> <a href="author.html">{{ $blog->oneuser->name }}</a></li>
                    <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{ $blog->oneuser->role }}</a></li>
                    <li class="post-date"> <span class="line"></span>{{ Carbon\Carbon::parse($blog->created_at)->format('F D, Y') }}</li>
                </ul>
                <div class="post-exerpt">
                    <p>{!! $blog->short_description !!}</p>
                </div>
                <div class="post-btn">
                    <a href="{{ route('frontend.blog.single',$blog->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
@endforeach

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
