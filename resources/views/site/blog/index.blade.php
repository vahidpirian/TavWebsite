@extends('site.layouts.master')
@section('head-tag')
    <title>وبلاگ</title>
    <style>
        .post-img{
            height: 260px !important;
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
                        {{ $posts->links() }}
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

