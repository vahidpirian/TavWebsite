@extends('site.layouts.master')
@section('head-tag')
    <title>وبلاگ</title>
    <style>
        .post-img{
            height: 260px !important;
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
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">وبلاگ ما</span>
                            <h2 class="site-title">اخبار و <span>مقالات</span></h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                @if($banners && $banners->where('position',5)->first())
                    <div class="container">
                        <a class="w-100" href="{{ $banners->where('position',5)->first()->url }}" title="{{ $banners->where('position',5)->first()->title }}">
                            <img src="{{ asset($banners->where('position',5)->first()->image) }}"
                                 alt="{{ $banners->where('position',5)->first()->title }}"
                                 class="banner-image">
                        </a>
                    </div>
                @endif
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-6 col-lg-4 mt-2">
                        <div class="blog-item">
                            <div class="blog-item-img">
                                <img class="post-img" style="width: 100%" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="far fa-user-circle"></i> {{ $post->author->full_name }}</a></li>
                                        <li><a href="#"><i class="far fa-calendar-alt"></i> {{ jdate($post->published_at)->format('%d %B %Y') }}</a></li>
                                    </ul>
                                </div>
                                <h4 class="blog-title">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h4>
                                <p style="min-height: 86px">{{ mb_substr($post->summary,0,85).'...' }}</p>
                                <a class="theme-btn" href="{{ route('blog.show', $post->slug) }}">بیشتر بخوانید</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                @if($banners && $banners->where('position',8)->first())
                    <div class="container">
                        <a class="w-100" href="{{ $banners->where('position',8)->first()->url }}" title="{{ $banners->where('position',8)->first()->title }}">
                            <img src="{{ asset($banners->where('position',8)->first()->image) }}"
                                 alt="{{ $banners->where('position',5)->first()->title }}"
                                 class="banner-image">
                        </a>
                    </div>
                @endif
            </div>
        </div>
@endsection

