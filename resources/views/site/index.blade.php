@extends('site.layouts.master')
@section('head-tag')
    <title>{{$setting->title}}</title>
    <style>
      .video-container {
        background: #000;
        width: 100%;
        position: relative;
      }

      #closeButton {
        position: absolute;
        right: 15px;
        top: 15px;
        z-index: 1000;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
      }

      #closeButton:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
      }

      .video-wrapper {
        position: relative;
      }
      .feature-item {
        padding: 30px 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
        border: 1px solid #eee;
        background-color: #fff;
      }

      .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        background-color: #1e99e6;
      }

      .feature-icon {
        width: 80px;
        height: 80px;
        background-color: #1e99e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
      }

      .feature-icon i {
        font-size: 35px;
        color: #fff;
      }

      .feature-item:hover .feature-icon {
        transform: rotate(360deg);
        background-color: #fff;
      }

      .feature-item:hover .feature-icon i {
        color: #1e99e6;
      }

      .feature-content h5 {
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: 600;
        color: #333;
        transition: all 0.3s ease;
      }

      .feature-content p {
        font-size: 15px;
        line-height: 1.6;
        color: #666;
        margin: 0;
        transition: all 0.3s ease;
      }

      .feature-item:hover .feature-content h5,
      .feature-item:hover .feature-content p {
        color: #fff;
      }

      .feature-item.active {
        background: #1e99e6;
      }

      .feature-item.active .feature-icon {
        background: #fff;
      }

      .feature-item.active .feature-icon i {
        color: #1e99e6;
      }

      .feature-item.active .feature-content h5,
      .feature-item.active .feature-content p {
        color: #fff;
      }

      @media (max-width: 768px) {
        .feature-item {
          margin-bottom: 20px;
        }
      }

      .hero-wrapper {
        padding: 80px 0;
        overflow: hidden;
      }

      .hero-content {
        max-width: 90%;
      }

      .hero-content .hero-title {
        font-size: 42px;
        margin: 15px 0;
        line-height: 1.3;
      }

      .hero-content p {
        font-size: 16px;
        line-height: 1.6;
      }

      .hero-img {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .hero-img img {
        max-width: 100%;
        height: auto;
        transform: scale(1.1);
      }

      @media (max-width: 1199px) {
        .hero-content .hero-title {
          font-size: 38px;
        }

        .hero-img img {
          transform: scale(1.05);
        }
      }

      @media (max-width: 991px) {
        .hero-wrapper {
          padding: 120px 0 60px;
        }

        .hero-content {
          max-width: 100%;
          padding-right: 0;
          margin-bottom: 30px;
          text-align: center;
          position: relative;
          z-index: 10;
        }

        .hero-content .hero-title {
          font-size: 34px;
        }

        .hero-content .hero-btn {
          justify-content: center;
        }

        .hero-img {
          position: relative;
          z-index: 10;
        }

        .hero-img img {
          transform: scale(1);
          max-width: 90%;
          margin: 0 auto;
        }
      }

      @media (max-width: 767px) {
        .hero-wrapper {
          padding: 100px 0 40px;
        }

        .hero-content .hero-title {
          font-size: 28px;
        }

        .hero-content .hero-sub-title {
          font-size: 18px;
        }

        .hero-img img {
          max-width: 85%;
        }
      }

      .blog-item {
          background: #fff;
          border-radius: 10px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
          transition: all 0.3s ease;
          margin-bottom: 30px;
          height: 100%;
          display: flex;
          flex-direction: column;
      }

      .blog-item:hover {
          transform: translateY(-5px);
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      }

      .blog-item-img {
          position: relative;
          overflow: hidden;
          border-radius: 10px 10px 0 0;
          height: 200px; /* Fixed height for images */
      }

      .blog-item-img img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.3s ease;
      }

      .blog-item:hover .blog-item-img img {
          transform: scale(1.1);
      }

      .blog-item-info {
          padding: 20px;
          flex-grow: 1;
          display: flex;
          flex-direction: column;
      }

      .blog-item-meta {
          margin-bottom: 15px;
      }

      .blog-item-meta ul {
          padding: 0;
          margin: 0;
          list-style: none;
      }

      .blog-item-meta ul li {
          display: inline-block;
          margin-left: 15px;
          font-size: 14px;
          color: #666;
      }

      .blog-item-meta ul li:last-child {
          margin-left: 0;
      }

      .blog-item-meta ul li i {
          margin-left: 5px;
          color: #1e99e6;
      }

      .blog-title {
          margin-bottom: 15px;
          font-size: 18px;
          font-weight: 600;
          line-height: 1.4;
      }

      .blog-title a {
          color: #333;
          text-decoration: none;
          transition: color 0.3s ease;
      }

      .blog-title a:hover {
          color: #1e99e6;
      }

      .blog-item p {
          color: #666;
          margin-bottom: 20px;
          flex-grow: 1;
          line-height: 1.6;
      }


      .blog-item .theme-btn:hover {
          background: #1677b5;
          transform: translateY(-2px);
      }
    </style>
@endsection
@section('content')
    <div class="hero-section">
        <div class="hero-wrapper">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5 col-lg-5">
                        <div class="hero-content">
                            <h6 class="hero-sub-title">
                                {{$setting->main_page_subtitle}}
                            </h6>
                            <h1 class="hero-title">
                                <span>فراتر</span> از <span>مرزها</span>
                            </h1>
                            <p>
                              {{$setting->main_page_service_summary}}
                            </p>
                            <div class="hero-btn wow animate__ animate__fadeInUp animated">
                                <a href="{{ route('contact.index') }}" class="theme-btn">تماس با ما</a>
{{--                                <a href="{{ route('about') }}" class="theme-btn">درباره ما</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7">
                        <div class="hero-img">

                        <img src="{{ asset($images->image) }}" alt="تاو 360 - خدمات بازرگانی">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="contact-search">
        <div class="search-box">
            <div class="search-container">
                <input
                    type="text"
                    id="liveSearch"
                    placeholder="جستجو..."
                    autocomplete="off"
                />
                <button type="button"><i class="fas fa-search"></i></button>
                <div class="search-results" id="searchResults">
                    <div class="search-loading" id="searchLoading">
                        <div class="spinner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-curve">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200">
            <rect width="100%" height="100%" fill="#f9f9f9" />
            <path
                fill="#fff"
                fill-opacity="1"
                d="M0,0L80,0C160,0,320,0,480,0C640,0,800,0,960,0C1120,0,1280,0,1360,0L1440,0L1440,200L1360,200C1280,200,1120,200,960,180C800,160,640,120,480,120C320,120,160,160,80,180L0,200Z"
            ></path>
        </svg>
    </div>


    <div class="feature-area">
        <div class="container">
            <div class="feature-area-wrapper">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-ship"></i>
                            </div>
                            <div class="feature-content">
                                <h5>واردات تخصصی</h5>
                                <p>
                                    واردات انواع کالاهای تجاری و صنعتی با بهترین کیفیت از
                                    معتبرترین تولیدکنندگان جهانی
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div class="feature-content">
                                <h5>ترخیص کالا</h5>
                                <p>
                                    ترخیص سریع و تخصصی کالا از تمامی گمرکات کشور با کادری مجرب
                                    و حرفه‌ای
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item active">
                            <div class="feature-icon">
                                <i class="fas fa-globe-asia"></i>
                            </div>
                            <div class="feature-content">
                                <h5>صادرات محصولات</h5>
                                <p>
                                    صادرات محصولات ایرانی به بازارهای جهانی با رعایت
                                    استانداردهای بین‌المللی
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="feature-content">
                                <h5>مشاوره بازرگانی</h5>
                                <p>
                                    ارائه مشاوره تخصصی در زمینه واردات، صادرات و سرمایه‌گذاری
                                    بین‌المللی
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($banner)
    <div class="container">
                <a class="w-100" href="{{ $banner->url }}" title="{{ $banner->title }}">
                    <img src="{{ asset($banner->image) }}"
                         alt="{{ $banner->title }}"
                         class="banner-image">
                </a>
        </div>
    @endif
    <div class="service-area bg py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <h2>همراه شما در مسیر تجارت جهانی</h2>
                    <div class="heading-divider"></div>
                    <p>
                        ارائه خدمات جامع در زمینه واردات، صادرات و امور بازرگانی با بهترین کیفیت و مناسب‌ترین قیمت
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($services as $service)

                <div class="col-md-6 col-lg-3">
                    <div class="service-item h295px">
                        <div class="service-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="service-title">
                            <a href="#">{{$service->title}}</a>
                        </h3>
                        <p class="service-text">
                            {{mb_substr($service->summary,0,85).'...'}}
                        </p>
                        <div class="service-arrow">
                            <a href="{{route('service.show',$service->id)}}" class="service-read-btn"> ثبت درخواست<i class="far fa-long-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>

    <div class="skill-area py-120">
        <div class="container">
            <div class="skill-wrapper">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 col-12">
                        <div class="skill-right">
                            <span class="site-title-tagline">چرا تاو 360؟</span>
                            <h2 class="site-title">
                                ما به شما <span>خدمات جامع بازرگانی</span> در سطح بین‌المللی
                                ارائه می‌دهیم
                            </h2>
                            <p class="skill-details">
                                با بیش از یک دهه تجربه در زمینه تجارت بین‌الملل و همکاری با
                                معتبرترین شرکت‌های جهانی، ما مفتخریم که خدمات جامع بازرگانی
                                را با بالاترین استانداردها به مشتریان خود ارائه می‌دهیم.
                            </p>
                            <div class="skills-section">
                                <div class="progress-box">
                                    <h5>رضایت مشتریان <span class="pull-right">۹۵٪</span></h5>
                                    <div class="progress" data-value="95">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                            style="width: 95%"
                                        ></div>
                                    </div>
                                </div>
                                <div class="progress-box">
                                    <h5>
                                        سرعت ترخیص کالا <span class="pull-right">۸۸٪</span>
                                    </h5>
                                    <div class="progress" data-value="88">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                            style="width: 88%"
                                        ></div>
                                    </div>
                                </div>
                                <div class="progress-box">
                                    <h5>
                                        پوشش شبکه بین‌المللی <span class="pull-right">۹۲٪</span>
                                    </h5>
                                    <div class="progress" data-value="92">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                            style="width: 92%"
                                        ></div>
                                    </div>
                                </div>
                                <div class="progress-box">
                                    <h5>
                                        موفقیت در پروژه‌ها <span class="pull-right">۹۰٪</span>
                                    </h5>
                                    <div class="progress" data-value="90">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                            style="width: 90%"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="skill-left">
                            <div class="skill-img">
                                <img src="{{asset($images->where('position',2)->first()->image)}}" alt="تصویر ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="cta-content">
                    <h5>خدمات تخصصی بازرگانی بین‌المللی</h5>
                    <h2 class="cta-title">خدمات بازرگانی<span> تاو 360</span></h2>

                    <p>
                        با بیش از یک دهه تجربه در زمینه واردات و صادرات، ما شریک تجاری
                        مطمئن شما هستیم.
                    </p>
                    <a href="{{route('contact.index')}}" class="cta-btn">درخواست مشاوره رایگان</a>
                </div>
            </div>
        </div>
        <div class="cta-shape">
            <img src="{{asset('app-assets/img/shape-3.png')}}" alt="" />
        </div>
    </div>


    <div class="counter-area">
        <div class="container">
            <div class="row">
                @foreach($statistics as $statistic)
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon"><i class="fas fa-chart-line"></i></div>
                        <span class="counter" data-count="+" data-to="{{ $statistic->number }}" data-speed="3000">{{ $statistic->number }}</span>
                        <h6 class="title">{{ $statistic->title }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

{{--    <div class="case-area py-120">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 mx-auto">--}}
{{--                    <div class="site-heading text-center">--}}
{{--                        <span class="site-title-tagline">نمونه‌ها</span>--}}
{{--                        <h2 class="site-title">پروژه‌های <span>ویژه</span></h2>--}}
{{--                        <div class="heading-divider"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row filter-box popup-gallery">--}}
{{--                @foreach($projects as $project)--}}
{{--                    <div class="col-md-6 col-lg-4 filter-item cat1 cat2" style="position: absolute; left: 0px; top: 0px;">--}}
{{--                        <div class="case-item">--}}
{{--                            <div class="case-img">--}}
{{--                                <img class="img-fluid" src="{{asset($project->image)}}"--}}
{{--                                     alt="{{$project->name}}">--}}
{{--                                <a class="popup-img case-link"--}}
{{--                                   href="{{asset($project->image)}}"> <i--}}
{{--                                        class="far fa-plus"></i></a>--}}
{{--                            </div>--}}
{{--                            <div class="case-content">--}}
{{--                                <div class="case-content-info">--}}
{{--                                    <small>{{$project->name}}</small>--}}
{{--                                </div>--}}
{{--                                <a href="{{route('project.show',$project->id)}}" class="case-arrow"><i class="far fa-arrow-left"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    @if($mainVideo)
    <div class="video-area pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto mb-5">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">معرفی ما</span>
                    <h2 class="site-title">گروه بازرگانی <span>تاو 360</span></h2>
                    <div class="heading-divider"></div>
                    <p>
                        با ما در مسیر تجارت جهانی همراه شوید و از خدمات تخصصی واردات و صادرات بهره‌مند شوید
                    </p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="video-wrapper">
                    @if($mainVideo->isUploadType())
                        <div class="video-container" id="videoContainer" style="display: none; position: relative;">
                            <button id="closeButton" onclick="closeVideo()">
                                <i class="fas fa-times"></i>
                            </button>
                            <video id="mainVideo" style="width: 100%;" controls>
                                <source src="{{ asset($mainVideo->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="thumbnail-container" id="thumbnailContainer">
                            <img src="{{asset($images->where('position',3)->first()->image)}}" alt="{{ $mainVideo->title }}" id="videoThumbnail">
                            <a class="play-btn" id="playButton" onclick="playVideo()">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    @else
                        <img src="{{asset($images->where('position',3)->first()->image)}}" alt="{{ $mainVideo->title }}">
                        <a class="play-btn popup-youtube" href="{{ $mainVideo->url_video }}">
                            <i class="fas fa-play"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    @endif


    <div class="process-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                <span class="site-title-tagline"
                >فرآیند کاری <span>در تاو 360</span></span
                >
                        <h2 class="site-title">چگونه کار می‌کند</h2>
                        <div class="heading-divider"></div>
                        <p>
                            این یک واقعیت است که خواننده توسط محتوای خواندنی یک صفحه هنگام
                            نگاه به طرح‌بندی آن منحرف می‌شود.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <a href="#" class="process-link">
                        <div class="process-single">
                            <div class="icon">
                                <i class="fas fa-comments"></i>
                                <!-- آیکون مشاوره -->
                                <span>01</span>
                            </div>
                            <h4>مشاوره اولیه</h4>
                            <p>بررسی نیازها و ارائه راهکارهای مناسب</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <a href="#" class="process-link">
                        <div class="process-single">
                            <div class="icon">
                                <i class="fas fa-search-dollar"></i>
                                <!-- آیکون سورسینگ و تحقیق قیمت -->
                                <span>02</span>
                            </div>
                            <h4>سورسینگ</h4>
                            <p>یافتن بهترین تامین‌کنندگان و مذاکره</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <a href="#" class="process-link">
                        <div class="process-single">
                            <div class="icon">
                                <i class="fas fa-shipping-fast"></i>
                                <!-- آیکون حمل و نقل سریع -->
                                <span>03</span>
                            </div>
                            <h4>خرید و حمل</h4>
                            <p>انجام فرآیند خرید و حمل بین‌المللی</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <a href="#" class="process-link">
                        <div class="process-single">
                            <div class="icon">
                                <i class="fas fa-clipboard-check"></i>
                                <!-- آیکون ترخیص و تحویل -->
                                <span>04</span>
                            </div>
                            <h4>ترخیص و تحویل</h4>
                            <p>ترخیص کالا از گمرک و تحویل به مشتری</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @foreach($serviceSupports as $key => $serviceSupport)
        <div class="sections py-120">
            <div class="container">
                <div class="row gap-5 align-items-center">
                    @if($key % 2 == 0)
                        <div class="col-sm image-container">
                            <figure class="image-frame">
                                <img
                                    class="img-fluid"
                                    src="{{ asset($serviceSupport->image) }}"
                                    alt="{{ $serviceSupport->title }}"
                                />
                            </figure>
                        </div>
                        <div class="col-sm">
                            <div class="text-section">
                                <div class="small-text">{{ $serviceSupport->small_title }}</div>
                                <h4>{{ $serviceSupport->title }}</h4>
                            </div>
                            <div class="content">
                                {!! $serviceSupport->description !!}
                            </div>
                            <div class="button-section">
                                <a href="{{ $serviceSupport->url }}" class="btn">{{ $serviceSupport->button_text }}</a>
                            </div>
                        </div>
                    @else
                        <div class="col-sm">
                            <div class="text-section">
                                <div class="small-text">{{ $serviceSupport->small_title }}</div>
                                <h4>{{ $serviceSupport->title }}</h4>
                            </div>
                            <div class="content">
                                {!! $serviceSupport->description !!}
                            </div>
                            <div class="button-section">
                                <a href="{{ $serviceSupport->url }}" class="btn">{{ $serviceSupport->button_text }}</a>
                            </div>
                        </div>
                        <div class="col-sm image-container">
                            <figure class="image-frame">
                                <img
                                    class="img-fluid"
                                    src="{{ asset($serviceSupport->image) }}"
                                    alt="{{ $serviceSupport->title }}"
                                />
                            </figure>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div class="blog-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <h2 class="site-title">اخبار و <span>وبلاگ</span></h2>
                        <div class="heading-divider"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latestPosts as $post)
                <div class="col-md-6 col-lg-3">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="blog-item-info">
                            <h4 class="blog-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h4>
                            <p>{{ mb_substr($post->summary, 0, 85).'...' }}</p>
                            <a class="theme-btn" href="{{ route('blog.show', $post->slug) }}">بیشتر بخوانید</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        function playVideo() {
            const video = document.getElementById('mainVideo');
            const videoContainer = document.getElementById('videoContainer');
            const thumbnailContainer = document.getElementById('thumbnailContainer');

            thumbnailContainer.style.display = 'none';
            videoContainer.style.display = 'block';
            video.play();
        }

        function closeVideo() {
            const video = document.getElementById('mainVideo');
            const videoContainer = document.getElementById('videoContainer');
            const thumbnailContainer = document.getElementById('thumbnailContainer');

            video.pause();
            video.currentTime = 0;
            videoContainer.style.display = 'none';
            thumbnailContainer.style.display = 'block';
        }

        document.getElementById('mainVideo').addEventListener('ended', function() {
            closeVideo();
        });
    </script>
@endsection
