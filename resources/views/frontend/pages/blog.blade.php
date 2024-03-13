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
                            <h2>Single Blog</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        @if (!empty($blog->thumbnail))
                                            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}"
                                                class="card-img rounded-0">
                                        @else
                                            <img src="{{ asset('admin/assets/images/placeholder.jpg') }}"
                                                alt="{{ $blog->title }}" class="card-img rounded-0">
                                        @endif
                                        <a href="javascript::void(0)" class="blog_item_date">
                                            <h3>{{ date('d', strtotime($blog->created_at)) }}</h3>
                                            <p>{{ date('M', strtotime($blog->created_at)) }}</p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="{{ route('frontend.blogs.details',$blog->slug) }}">
                                            <h2>{{ $blog->title }}</h2>
                                        </a>
                                        <p>{{ $blog->short_description }}</p>
                                        <ul class="blog-info-link">
                                            <li><a href="?category={{ $blog->category_id }}"><i
                                                        class="fa fa-user"></i>{{ $blog->category->name }}</a></li>
                                        </ul>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <h2 class="text-center">No Blogs Found</h2>
                        @endif


                        <nav class="blog-pagination justify-content-center d-flex">
                            {{ $blogs->links() }}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="{{ url()->current() }}" method="GET">
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
                                        <a href="{{ url()->current() }}?category={{ $category->id }}&s={{ request()->s }}"
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
@endsection
