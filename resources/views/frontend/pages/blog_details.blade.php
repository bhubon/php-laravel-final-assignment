@extends('frontend.frontend-layout')
@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('frontend') }}/assets/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $blog->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="assets/img/blog/single_blog_1.png" alt="">
                            @if (!empty($blog->thumbnail))
                                <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" class="img-fluid">
                            @else
                                <img src="{{ asset('admin/assets/images/placeholder.jpg') }}" alt="{{ $blog->title }}"
                                    class="img-fluid">
                            @endif
                        </div>
                        <div class="blog_details">
                            <h2>{{ $blog->title }}</h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="/blogs?category={{ $blog->category_id }}"><i
                                            class="fa fa-user"></i>{{ $blog->category->name }}</a></li>
                            </ul>
                            <p class="excert">{{ $blog->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="{{ route('frontend.blogs') }}" method="GET">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            name="s" value="{{ request()->s }}">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="category" value="{{ request()->category }}">
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('frontend.blogs') }}?category={{ $category->id }}&s={{ request()->s }}"
                                            class="d-flex">
                                            <p>{{ $category->name }}</p>
                                            <p>({{ count($category->blogs) }})</p>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
@endsection
