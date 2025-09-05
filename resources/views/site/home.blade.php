@extends('site.layouts.master')
@section('title')
    {{ $config->meta_title ?? $config->web_title }}
@endsection
@section('description')
    {{ $config->web_des }}
@endsection
@section('image')
    {{ url('' . $banners[0]->image ? $banners[0]->image->path : 'https://placehold.co/1920x1080') }}
@endsection
@section('css')
    <style>
        .limit-5-line {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .limit-3-line {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
@section('content')
    <!-- CONTENT START -->
    <div class="page-content">
        <!-- Swiper -->
        <div class="twm-slider1-wrap slider-circle-pic-wrap">

            {{-- <div class="slider2-left-sidebar">
                <div class="slider2-left-sidebar-position">
                    <div class="slider2-l-social">
                        <ul class="social2-icons">
                            <li><a class="bg-dribble-clr" href="javascript:void(0);">dribbble<i class="bi bi-dribbble"></i></a>
                            </li>
                            <li><a class="bg-behance-clr" href="javascript:void(0);">behance<i class="bi bi-behance"></i></a>
                            </li>
                            <li><a class="bg-twitter-clr" href="javascript:void(0);">twitter<i
                                        class="bi bi-twitter-x"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div> --}}

            <!-- banner desktop -->
            <div class="swiper twm-slider1 d-none d-md-block">

                <div class="swiper-wrapper  twm-slider1-slides">
                    @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ $banner->image ? $banner->image->path : 'https://placehold.co/1920x1080' }}"
                                alt="" loading="lazy">
                        </div>
                    @endforeach
                </div>
                <div class="controls-area">
                    <div class="swiper-pagination"></div>
                    <div class="buttons-controls">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div class="swiper-scrollbar"></div>

                </div>
            </div>
            <!-- banner mobile -->
            <div class="swiper twm-slider1 d-block d-md-none">

                <div class="swiper-wrapper  twm-slider1-slides">
                    @foreach ($smallBanners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ $banner->image ? $banner->image->path : 'https://placehold.co/400x600' }}"
                                alt="banner mobile" loading="lazy">
                        </div>
                    @endforeach
                </div>
                <div class="controls-area">
                    <div class="swiper-pagination"></div>
                    <div class="buttons-controls">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <div class="swiper-scrollbar"></div>

                </div>
            </div>

        </div>
        <!-- Swiper -->


        <!-- WE PROVIDE SERVICE SECTION START -->
        <div class="section-full p-t60 p-b60 twm-we-pro-service-wrap">
            <div class="container">

                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <h2 class="wt-title title_split_anim ">Dịch Vụ Của Chúng Tôi</h2>
                </div>
                <!-- TITLE END-->

                <div class="section-content">
                    <div class="service-icon-box-wrap">
                        <div class="row justify-content-center d-flex">

                            <!--Column 1-->
                            @foreach ($services as $service)
                                <div class="col-xl-4 col-lg-4 col-md-6 m-b30">
                                    <div class="service-icon-box-two">
                                        <div class="service-media">
                                            <a href="{{ route('front.service-detail', $service->slug) }}">
                                                <img src="{{ $service->image ? $service->image->path : 'https://placehold.co/100x100' }}"
                                                    alt="" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="service-icon-content">
                                            <h3 class="wt-title"><a
                                                    href="{{ route('front.service-detail', $service->slug) }}">{{ $service->name }}</a>
                                            </h3>
                                            <p>{!! $service->description !!}</p>
                                        </div>
                                        <div class="service-icon-box-bootom">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- LATEST PROJECTS SLIDER START -->
        <div class="section-full p-t60 pro-filtr-cate-wrap">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <h2 class="wt-title  title_split_anim">Dự Án Của Chúng Tôi</h2>
                </div>
                <!-- TITLE END-->
            </div>
            <!-- IMAGE CAROUSEL START -->
            <div class="pro-filtr-cate-carousal-wrap">
                <div class="swiper-container pro-filtr-cate-bx">

                    <div class="swiper-wrapper">

                        <!-- COLUMNS 1 -->
                        @foreach ($projects as $project)
                            <div class="swiper-slide">
                                <div class="effect-hvr3">
                                    <div class="effect-sarah">
                                        <img src="{{ $project->image ? $project->image->path : 'https://placehold.co/400x600' }}"
                                            alt="img20" loading="lazy">
                                        <a class="elem pic-long project-view-btn"
                                            href="{{ $project->image ? $project->image->path : 'https://placehold.co/400x600' }}"
                                            title="Commercial Building" data-lcl-txt="" data-lcl-author=""
                                            data-lcl-thumb="{{ $project->image ? $project->image->path : 'https://placehold.co/400x600' }}"><i
                                                class="fa fa-search-plus"></i>
                                        </a>
                                    </div>
                                    <div class="effect-hvr3-inner">
                                        <h3 class="wt-title"><a
                                                href="{{ route('front.show-project-detail', $project->slug) }}">{{ $project->title }}</a>
                                        </h3>
                                        <span class="project-new-category">{{ $project->category->name }}</span>
                                        <a href="{{ route('front.show-project-detail', $project->slug) }}"
                                            class="site-button-icon site-text-primary"><i class="flaticon-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>
            </div>
        </div>
        <!-- LATEST PROJECTS SLIDER END -->

        <!-- ABOUT ONE SECTION START -->
        <div class="section-full p-t60  about-section-one-wrap">
            <div class="about-section-one">
                <div class="container">
                    <div class="section-content">
                        <div class="row">
                            <div class="col-lg-5 col-md-12 m-b30">
                                <div class="company-exp-full-info">
                                    <!-- TITLE START-->
                                    <div class="section-head left wt-small-separator-outer">
                                        <h2 class="wt-title title_split_anim">{{ $config->short_name_company }}</h2>
                                        <p>{!! $config->web_des !!}</p>
                                    </div>
                                    <!-- TITLE END-->
                                    <a href="{{ route('front.about-us') }}" class="site-button">Xem Thêm</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 m-b30 company-exp-position">
                                <div class="company-exp">
                                    <div class="company-exp-media"><img
                                            src="{{ $config->introduction_image ? $config->introduction_image->path : 'https://placehold.co/100x100' }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="circle-text1">
                                        <div class="emblem-wrap">
                                            <div class="emblem">Architecture-And-Interior-Design-</div>
                                            <i><img src="{{ $config->image ? $config->image->path : 'https://placehold.co/100x100' }}"
                                                    alt="{{ $config->short_name_company }}"
                                                    style="height: 100%; width: auto; max-width: 100%; vertical-align: middle; object-fit: cover;" loading="lazy"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ABOUT ONE SECTION END -->

        <!-- WHAT WE DO SECTION START -->
        <div class="section-full  p-t60 p-b60">
            <div class="container">
                <div class="s-section-three">
                    <div class="row d-flex justify-content-center">

                        <!-- COLUMNS 1 -->
                        <div class="col-lg-4 col-md-6  m-b30">
                            <div class="icon-box-style-three-title">
                                <div class="icon-box-style-three-title-bg">
                                    <!-- TITLE START-->
                                    <div class="section-head left wt-small-separator-outer ">
                                        <div class="wt-small-separator site-text-primary">
                                            <i class="bi bi-house"></i>
                                            <div>Tại Sao ?</div>
                                        </div>
                                        <h2 class="wt-title title_split_anim">Nên Chọn Chúng Tôi</h2>
                                    </div>
                                    <!-- TITLE END-->
                                </div>
                            </div>
                        </div>

                        <!-- COLUMNS 2 -->
                        <div class="col-lg-4 col-md-6  m-b30">
                            <div class="icon-box-style-three-wrap">
                                <div class="icon-box-style-three">

                                    <div class="wt-icon-box-wraper">
                                        <div class="icon-lg d-flex">
                                            <span class="icon-cell site-text-primary">
                                                <img src="/site/images/furniture-2.png" alt="Image"
                                                    loading="lazy"></span>
                                            <h3 class="wt-title"><a href="">Kinh nghiệm lâu năm</a></h3>
                                        </div>
                                    </div>

                                    <div class="icon-box-three-content">
                                        <p>Đã thực hiện hàng trăm công trình nội, ngoại thất lớn nhỏ trên toàn quốc.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6  m-b30">
                            <div class="icon-box-style-three-wrap">
                                <div class="icon-box-style-three">

                                    <div class="wt-icon-box-wraper">
                                        <div class="icon-lg d-flex">
                                            <span class="icon-cell site-text-primary">
                                                <img src="/site/images/furniture-2.png" alt="Image"
                                                    loading="lazy"></span>
                                            <h3 class="wt-title"><a href="">Đội ngũ chuyên nghiệp</a></h3>
                                        </div>
                                    </div>

                                    <div class="icon-box-three-content">
                                        <p>Kiến trúc sư, kỹ sư và thợ thi công tay nghề cao, giàu nhiệt huyết.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6  m-b30">
                            <div class="icon-box-style-three-wrap">
                                <div class="icon-box-style-three">

                                    <div class="wt-icon-box-wraper">
                                        <div class="icon-lg d-flex">
                                            <span class="icon-cell site-text-primary">
                                                <img src="/site/images/furniture-2.png" alt="Image"
                                                    loading="lazy"></span>
                                            <h3 class="wt-title"><a href="">Vật liệu cao cấp</a></h3>
                                        </div>
                                    </div>

                                    <div class="icon-box-three-content">
                                        <p>Đặc biệt là vật liệu {{ $config->web_title }} bền đẹp, chống nước,
                                            chống mối mọt</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6  m-b30">
                            <div class="icon-box-style-three-wrap">
                                <div class="icon-box-style-three">

                                    <div class="wt-icon-box-wraper">
                                        <div class="icon-lg d-flex">
                                            <span class="icon-cell site-text-primary">
                                                <img src="/site/images/furniture-2.png" alt="Image"
                                                    loading="lazy"></span>
                                            <h3 class="wt-title"><a href="">Quy trình rõ ràng</a></h3>
                                        </div>
                                    </div>

                                    <div class="icon-box-three-content">
                                        <p>Báo giá chi tiết, tối ưu ngân sách khách hàng.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6  m-b30">
                            <div class="icon-box-style-three-wrap">
                                <div class="icon-box-style-three">

                                    <div class="wt-icon-box-wraper">
                                        <div class="icon-lg d-flex">
                                            <span class="icon-cell site-text-primary">
                                                <img src="/site/images/furniture-2.png" alt="Image"
                                                    loading="lazy"></span>
                                            <h3 class="wt-title"><a href="">Cam kết tiến độ</a></h3>
                                        </div>
                                    </div>

                                    <div class="icon-box-three-content">
                                        <p>bảo hành dài hạn: Hoàn thiện đúng thời gian, bảo hành tận tâm sau thi
                                            công.</p>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!-- WHAT WE DO SECTION END -->

        <div class="section-full testimonial2-outer-wrap p-t60 p-b60 parallax-section ">
            <div class="parallax-image" style="background-image: url(/site/images/testimonial-bg.jpg);"></div>
            <div class="container">
                <div class="testimonial2-outer">
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer when-bg-dark">
                        <h2 class="wt-title  title_split_anim">Những Đánh Giá Từ Khách Hàng</h2>
                    </div>
                    <!-- TITLE END-->

                    <div class="section-content">
                        <!-- Swiper -->
                        <div class="swiper twm-t-monial-2-slider testimonial-2-content">
                            <div class="swiper-wrapper">
                                <!-- COLUMNS 1 -->
                                @foreach ($reviews as $review)
                                    <div class="swiper-slide">
                                        <div class="testimonial-2">
                                            <div class="testimonial-content">
                                                <div class="testimonial-text">
                                                    <p>"{{ $review->message }}"</p>
                                                    <i class="bi bi-quote"></i>
                                                </div>

                                                <div class="testimonial-detail">
                                                    <div class="testimonial-pic-block">

                                                        <div class="testimonial-pic">
                                                            <img src="{{ $review->image ? $review->image->path : 'https://placehold.co/100x100' }}"
                                                                alt="" loading="lazy">
                                                        </div>

                                                    </div>
                                                    <div class="testimonial-info">
                                                        <span class="testimonial-name">{{ $review->name }}</span>
                                                        <span
                                                            class="testimonial-position text-white">{{ $review->position }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- CLIENT LOGO SECTION START -->
        <div class="section-full  p-t60 p-b20 twm-home-client-carousel-wrap">
            <div class="container">
                <div class="section-content">
                    <div class="home-client-carousel1-wrap">
                        <!-- TITLE START-->
                        <div class="section-head center wt-small-separator-outer">
                            <h2 class="wt-title title_split_anim">Đối Tác Chiến Lược</h2>
                        </div>
                        <!-- TITLE END-->

                        <!-- Swiper -->
                        <div class="swiper home-client-carousel">
                            <div class="swiper-wrapper">
                                @foreach ($partners as $partner)
                                    <div class="swiper-slide">
                                        <div class="ow-client-logo">
                                            <div class="client-logo client-logo-media">
                                                <a href="{{ $partner->link }}"><img
                                                        src="{{ $partner->image ? $partner->image->path : 'https://placehold.co/100x100' }}"
                                                        alt="" loading="lazy"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CLIENT LOGO  SECTION End -->

        <!-- OUR TEAM START -->
        <div class="section-full p-t30 p-b30 ">
            <div class="container">
                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <h2 class="wt-title title_split_anim">Đội Ngũ Nhân Sự</h2>
                </div>
                <!-- TITLE END-->
                <div class="swiper home-client-founder">
                    <div class="swiper-wrapper">
                        @foreach ($founders as $founder)
                            <div class="swiper-slide">
                                <div class="team-effect-hvr2">
                                    <div class="team-hvr2-media">
                                        <img src="{{ $founder->image ? $founder->image->path : 'https://placehold.co/400x600' }}"
                                            alt="" loading="lazy">
                                    </div>

                                    <div class="content-info">
                                        <div class="content-info-inner">

                                            <div class="info-detail">
                                                <h3 class="wt-title"><a
                                                        href="{{ $founder->link_website }}">{{ $founder->name }}</a>
                                                </h3>
                                                <p class="wt-title-position">{{ $founder->position }}</p>
                                            </div>
                                            <p class="icon-links">
                                                <a href="{{ $founder->link_facebook }}"><i
                                                        class="bi bi-facebook"></i></a>
                                                <a href="{{ $founder->link_instagram }}"><i
                                                        class="bi bi-twitter-x"></i></a>
                                                <a href="{{ $founder->link_website }}"><i class="bi bi-dribbble"></i></a>
                                                <a href="{{ $founder->link_twitter }}"><i class="bi bi-twitter"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- OUR TEAM SECTION END -->


        <!-- GET IN TOUCH -->
        <div class="section-full  get-intouch-style-2-wrap parallax-section">
            <video muted loop autoplay>
                <source src="https://thewebmax.org/hvillas/images/video-1.mp4" type="video/mp4">
            </video>
            <div class="get-intouch-style-2-inner site-text-white">
                <span>{{ $config->short_name_company }}</span>
                <h2 class="wt-title site-text-white title_split_anim ">Kiến tạo không gian sống và làm việc đẹp –
                    bền – tiện nghi – phù hợp phong cách </h2>
                <div class="site-center-btn text-center">
                    <a href="tel:{{ str_replace(' ', '', $config->hotline) }}" class="site-button">Liên Hệ Ngay</a>
                </div>
            </div>
        </div>
        <!-- GET IN TOUCH -->

        <!-- OUR BLOG START -->
        <div class="section-full  p-t60 p-b60 twm-blog-outer-area">
            <div class="blog-gallery-block-outer">
                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer">
                        <h2 class="wt-title title_split_anim">Tin Tức Nổi Bật</h2>
                    </div>
                    <div class="swiper home-client-founder">
                        <div class="swiper-wrapper">
                            @foreach ($newBlogs as $blog)
                                <div class="swiper-slide">
                                    <div class="blog-post blog-post-5-outer">
                                        <div class="wt-post-media">
                                            <a href="{{ route('front.detail-blog', $blog->slug) }}"><img
                                                    src="{{ $blog->image ? $blog->image->path : 'https://placehold.co/400x600' }}"
                                                    alt="" loading="lazy"></a>
                                        </div>

                                        <div class="wt-post-info">
                                            <div class="wt-post-meta ">
                                                <ul>
                                                    <li class="post-category">{{ $blog->category->name }}</li>
                                                    <li class="post-date">
                                                        <span>{{ $blog->created_at->format('d') }}</span>
                                                        {{ $blog->created_at->format('M') }}
                                                        {{ $blog->created_at->format('Y') }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="wt-post-title ">
                                                <h3 class="post-title"><a
                                                        href="{{ route('front.detail-blog', $blog->slug) }}">{{ $blog->name }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- OUR BLOG END -->

    </div>
    <!-- CONTENT END -->
@endsection
@push('script')
@endpush
