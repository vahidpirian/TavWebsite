@extends('site.layouts.master')
@section('head-tag')
    <title>وبلاگ</title>
@endsection
@section('content')
        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">وبلاگ ما</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active">وبلاگ ما</li>
                </ul>
            </div>
            <div class="breadcrumb-shape">
                <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
            </div>
        </div>


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
                <div class="row">
                    @foreach($posts as $post)
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
                <div class="row">
                    <div class="col-12">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection

