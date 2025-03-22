@extends('site.layouts.master')
@section('head-tag')
    <title>{{$post->title}}</title>
    <style>
        .tags-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .tags-wrapper li {
            margin: 0;
        }

        .tags-wrapper li a {
            display: inline-block;
            padding: 5px 12px;
            background-color: #f5f5f5;
            border-radius: 20px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .comments-section {
            margin-top: 40px;
        }

        .comments-title {
            font-size: 24px;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .comments-count {
            color: #666;
            font-size: 18px;
        }

        .comment-item {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .comment-item.reply {
            margin-right: 50px;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #eee;
        }

        .comment-avatar {
            flex-shrink: 0;
        }

        .avatar-placeholder {
            width: 50px;
            height: 50px;
            background-color: #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #666;
        }

        .avatar-placeholder.admin {
            background-color: #4CAF50;
            color: white;
        }

        .comment-content {
            flex-grow: 1;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-author {
            font-size: 16px;
            margin: 0;
            color: #333;
        }

        .comment-author.admin {
            color: #4CAF50;
        }

        .comment-date {
            font-size: 14px;
            color: #888;
        }

        .comment-date i {
            margin-left: 5px;
        }

        .comment-body {
            font-size: 15px;
            line-height: 1.6;
            color: #444;
        }

        @media (max-width: 768px) {
            .comment-item {
                flex-direction: column;
                gap: 10px;
            }

            .comment-item.reply {
                margin-right: 20px;
            }

            .comment-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }

    </style>
@endsection
@section('content')
    <div class="site-breadcrumb">
        <div class="container">
            <h2 class="breadcrumb-title">وبلاگ</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                <li class="active">{{$post->title}}</li>
            </ul>
        </div>
        <div class="breadcrumb-shape">
            <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
        </div>
    </div>


    <div class="blog-single-area pt-120 pb-120">
        @if($banners && $banners->where('position',11)->first())
            <div class="container">
                <a class="w-100" href="{{ $banners->where('position',11)->first()->url }}"
                   title="{{ $banners->where('position',11)->first()->title }}">
                    <img src="{{ asset($banners->where('position',11)->first()->image) }}"
                         alt="{{ $banners->where('position',11)->first()->title }}"
                         class="banner-image">
                </a>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-single-wrapper">
                        <div class="blog-single-content">
                            <div class="blog-thumb-img">
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <div class="blog-meta-left">
                                        <ul>
                                            <li><i class="far fa-user"></i><a href="#">{{$post->author->full_name}}</a>
                                            </li>
                                            <li><i class="far fa-comments"></i>{{ $comments->count() }} نظر</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog-details">
                                    <h3 class="blog-details-title mb-20">{{ $post->title }}</h3>
                                    {!! $post->body !!}
                                    <hr>
                                    <div class="blog-details-tags pb-20">
                                        <h5> برچسب‌ها: </h5>
                                        <ul class="tags-wrapper">
                                            @if($post->tags)
                                                @foreach(explode(',', $post->tags) as $tag)
                                                    <li><a href="#">{{ trim($tag) }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-comments mt-5">
                                <div class="comments-section">
                                    <h4 class="comments-title">نظرات <span class="comments-count">({{ $comments->count() }})</span>
                                    </h4>
                                    <div class="blog-comments-wrapper">
                                        @foreach($comments as $comment)
                                            <div class="comment-item">
                                                <div class="comment-avatar">
                                                    <div class="avatar-placeholder">
                                                        {{ substr($comment->user->full_name ?? 'کاربر', 0, 1) }}
                                                    </div>
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-header">
                                                        <h5 class="comment-author">{{ $comment->user->full_name ?? 'کاربر' }}</h5>
                                                        <span class="comment-date">
                                                        <i class="far fa-calendar-alt"></i>
                                                        {{ jdate($comment->created_at)->format('%B %d، %Y') }}
                                                    </span>
                                                    </div>
                                                    <div class="comment-body">
                                                        {{ $comment->body }}
                                                    </div>

                                                    @if($comment->answers->count() > 0)
                                                        @foreach($comment->answers as $reply)
                                                            <div class="comment-item reply">
                                                                <div class="comment-avatar">
                                                                    <div class="avatar-placeholder admin">
                                                                        {{ substr($reply->user->full_name ?? 'مدیر', 0, 1) }}
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content">
                                                                    <div class="comment-header">
                                                                        <h5 class="comment-author admin">{{ $reply->user->full_name ?? 'مدیر' }}</h5>
                                                                        <span class="comment-date">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ jdate($reply->created_at)->format('%B %d، %Y') }}
                                        </span>
                                                                    </div>
                                                                    <div class="comment-body">
                                                                        {{ $reply->body }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="blog-comments-form">
                                    <h4>نظر بدهید</h4>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('comment.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                                        <input type="hidden" name="commentable_type" value="App\Models\Content\Post">
                                        <div class="row">
                                            @if(!auth()->check())
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control"
                                                               placeholder="نام شما*" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control"
                                                               placeholder="آدرس ایمیل" required>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="body" rows="5"
                                                              placeholder="نظر*"></textarea>
                                                </div>
                                                <button type="submit" class="theme-btn">نظر ارسال کنید <i
                                                        class="far fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar">

                        <div class="widget category">
                            <h5 class="widget-title">دسته</h5>
                            <div class="category-list">
                                @foreach($categories as $category)
                                    <a href="{{route('blog.category',$category->slug)}}"><i
                                            class="far fa-angle-double-left"></i>{{$category->name}}<span>({{$category->posts->count()}})</span></a>
                                @endforeach
                            </div>
                        </div>

                        <div class="widget recent-post">
                            <h5 class="widget-title">پست اخیر</h5>
                            @foreach($relatedPosts as $item)
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6><a href="#">{{$item->title}}</a></h6>
                                        <span><i class="far fa-clock"></i>12{{ jdate($item->created_at)->format('%d %B %Y') }}</span>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </aside>
                </div>
            </div>
        </div>
        @if($banners && $banners->where('position',14)->first())
            <div class="container">
                <a class="w-100" href="{{ $banners->where('position',14)->first()->url }}"
                   title="{{ $banners->where('position',14)->first()->title }}">
                    <img src="{{ asset($banners->where('position',14)->first()->image) }}"
                         alt="{{ $banners->where('position',14)->first()->title }}"
                         class="banner-image">
                </a>
            </div>
        @endif
    </div>
@endsection
