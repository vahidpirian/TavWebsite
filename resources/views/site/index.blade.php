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
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
            border: 1px solid #eee;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(90deg, #896eff 0, #5f3bff 51%, #896eff);
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
        }

        .feature-content h5 {
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: 600;
            color: #333;
        }

        .feature-content p {
            font-size: 15px;
            line-height: 1.6;
            color: #666;
            margin: 0;
        }

        .feature-item.active {
            background: #896eff;
        }

        .feature-item.active .feature-icon {
            background: #fff;
        }

        .feature-item.active .feature-icon i {
            color: var(--bs-primary);
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
    </style>
@endsection
@section('content')
    <div class="hero-section">
        <div class="hero-wrapper">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-6">
                        <div class="hero-content">
                            <h6 class="hero-sub-title">
                                {{$setting->main_page_subtitle}}
                            </h6>
                            <h1 class="hero-title">
                                {{$setting->main_page_title}}
                            </h1>
                            <p>
                              {{$setting->main_page_service_summary}}
                            </p>
                            <div class="hero-btn wow animate__ animate__fadeInUp animated">
                                <a href="{{ route('contact.index') }}" class="theme-btn theme-btn2">تماس با ما</a>
{{--                                <a href="{{ route('about') }}" class="theme-btn">درباره ما</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="hero-img">
                            <img src="{{ asset($images->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-shape">
                <img src="{{asset('app-assets/img/shape-1.png')}}" alt="">
            </div>
        </div>
    </div>

    <div class="feature-area pt-120">
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
                                <p>واردات انواع کالاهای تجاری و صنعتی با بهترین کیفیت از معتبرترین تولیدکنندگان جهانی</p>
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
                                <p>ترخیص سریع و تخصصی کالا از تمامی گمرکات کشور با کادری مجرب و حرفه‌ای</p>
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
                                <p>صادرات محصولات ایرانی به بازارهای جهانی با رعایت استانداردهای بین‌المللی</p>
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
                                <p>ارائه مشاوره تخصصی در زمینه واردات، صادرات و سرمایه‌گذاری بین‌المللی</p>
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
                    <span class="site-title-tagline">خدمات تخصصی</span>
                    <h2 class="site-title">خدمات <span>بازرگانی تاو 360</span></h2>
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
                            <a href="{{route('service.show',$service->id)}}" class="service-read-btn">جزئیات بیشتر<i class="far fa-long-arrow-left"></i></a>
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
                    <div class="skill-left">
                        <div class="skill-img">
                            <img src="{{asset($images->where('position',2)->first()->image)}}" alt="تصویر ">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="skill-right">
                        <span class="site-title-tagline">چرا تاو 360؟</span>
                        <h2 class="site-title">ما به شما <span>خدمات جامع بازرگانی</span> در سطح بین‌المللی ارائه می‌دهیم</h2>
                        <p class="skill-details">
                            با بیش از یک دهه تجربه در زمینه تجارت بین‌الملل و همکاری با معتبرترین شرکت‌های جهانی، ما مفتخریم که خدمات جامع بازرگانی را با بالاترین استانداردها به مشتریان خود ارائه می‌دهیم.
                        </p>
                        <div class="skills-section">
                            <div class="progress-box">
                                <h5>رضایت مشتریان <span class="pull-right">۹۵٪</span></h5>
                                <div class="progress" data-value="95">
                                    <div class="progress-bar" role="progressbar" style="width: 95%;"></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <h5>سرعت ترخیص کالا <span class="pull-right">۸۸٪</span></h5>
                                <div class="progress" data-value="88">
                                    <div class="progress-bar" role="progressbar" style="width: 88%;"></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <h5>پوشش شبکه بین‌المللی <span class="pull-right">۹۲٪</span></h5>
                                <div class="progress" data-value="92">
                                    <div class="progress-bar" role="progressbar" style="width: 92%;"></div>
                                </div>
                            </div>
                            <div class="progress-box">
                                <h5>موفقیت در پروژه‌ها <span class="pull-right">۹۰٪</span></h5>
                                <div class="progress" data-value="90">
                                    <div class="progress-bar" role="progressbar" style="width: 90%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <div class="case-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">نمونه‌ها</span>
                        <h2 class="site-title">پروژه‌های <span>ویژه</span></h2>
                        <div class="heading-divider"></div>
                    </div>
                </div>
            </div>

            <div class="row filter-box popup-gallery">
                @foreach($projects as $project)
                    <div class="col-md-6 col-lg-4 filter-item cat1 cat2" style="position: absolute; left: 0px; top: 0px;">
                        <div class="case-item">
                            <div class="case-img">
                                <img class="img-fluid" src="{{asset($project->image)}}"
                                     alt="{{$project->name}}">
                                <a class="popup-img case-link"
                                   href="{{asset($project->image)}}"> <i
                                        class="far fa-plus"></i></a>
                            </div>
                            <div class="case-content">
                                <div class="case-content-info">
                                    <small>{{$project->name}}</small>
                                </div>
                                <a href="{{route('project.show',$project->id)}}" class="case-arrow"><i class="far fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>


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
                        <span class="site-title-tagline">فرآیند کاری</span>
                        <h2 class="site-title">چگونه <span>کار می‌کند</span></h2>
                        <div class="heading-divider"></div>
                        <p>
                            این یک واقعیت است که خواننده توسط محتوای خواندنی یک صفحه هنگام نگاه به طرح‌بندی آن منحرف
                            می‌شود.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <div class="process-single">
                        <div class="icon">
                            <i class="fas fa-comments"></i> <!-- آیکون مشاوره -->
                            <span>01</span>
                        </div>
                        <h4>مشاوره اولیه</h4>
                        <p>بررسی نیازها و ارائه راهکارهای مناسب</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <div class="process-single">
                        <div class="icon">
                            <i class="fas fa-search-dollar"></i> <!-- آیکون سورسینگ و تحقیق قیمت -->
                            <span>02</span>
                        </div>
                        <h4>سورسینگ</h4>
                        <p>یافتن بهترین تامین‌کنندگان و مذاکره</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <div class="process-single">
                        <div class="icon">
                            <i class="fas fa-shipping-fast"></i> <!-- آیکون حمل و نقل سریع -->
                            <span>03</span>
                        </div>
                        <h4>خرید و حمل</h4>
                        <p>انجام فرآیند خرید و حمل بین‌المللی</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-30">
                    <div class="process-single">
                        <div class="icon">
                            <i class="fas fa-clipboard-check"></i> <!-- آیکون ترخیص و تحویل -->
                            <span>04</span>
                        </div>
                        <h4>ترخیص و تحویل</h4>
                        <p>ترخیص کالا از گمرک و تحویل به مشتری</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">وبلاگ ما</span>
                        <h2 class="site-title">اخبار و <span>وبلاگ</span></h2>
                        <div class="heading-divider"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($latestPosts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-item">
                        <div class="blog-item-img">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="blog-item-info">
                            <div class="blog-item-meta">
                                <ul>
                                    <li><a href="#"><i class="far fa-user-circle"></i> {{ $post->author->full_name }}</a></li>
                                    <li><a href="#"><i class="far fa-calendar-alt"></i> {{ jdate($post->created_at)->format('%d %B %Y') }}</a></li>
                                </ul>
                            </div>
                            <h4 class="blog-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h4>
                            <p>{{ mb_substr($post->summary,0,150).'...' }}</p>
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
