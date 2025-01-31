@extends('site.layouts.master')
@section('head-tag')
    <title>{{$post->title}}</title>
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
                                                <li><i class="far fa-user"></i><a href="#">{{$post->author->full_name}}</a></li>
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
                                            <ul>
                                                @if($post->tags)
                                                @foreach(explode(',', $post->tags) as $tag)
                                                <li><a href="#">{{ $tag }}</a></li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-comments mt-5">
                                    <h4>نظرات ({{ $comments->count() }})</h4>
                                    <div class="blog-comments-wrapper">
                                        @foreach($comments as $comment)
                                        <div class="blog-comments-item">
                                            <div class="blog-comments-info">
                                                <h5>{{ $comment->user->full_name ?? 'کاربر' }}</h5>
                                                <span><i class="far fa-calendar-alt"></i>{{ jdate($comment->created_at)->format('%B %d، %Y') }}</span>
                                            </div>
                                            <p>{{ $comment->body }}</p>

                                            <!-- Nested Comments -->
                                            @if($comment->answers->count() > 0)
                                            @foreach($comment->answers as $reply)
                                            <div class="blog-comments-item reply">
                                                <div class="blog-comments-info">
                                                    <h5>{{ $reply->user->full_name ?? 'مدیر' }}</h5>
                                                    <span><i class="far fa-calendar-alt"></i>{{ jdate($reply->created_at)->format('%B %d، %Y') }}</span>
                                                </div>
                                                <p>{{ $reply->body }}</p>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        @endforeach
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
                                                            <input type="text" name="name" class="form-control" placeholder="نام شما*" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="email" class="form-control" placeholder="آدرس ایمیل" required>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="body" rows="5" placeholder="نظر*"></textarea>
                                                    </div>
                                                    <button type="submit" class="theme-btn">نظر ارسال کنید <i class="far fa-paper-plane"></i></button>
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
                                        <a href="{{route('blog.category',$category->slug)}}"><i class="far fa-angle-double-left"></i>{{$category->name}}<span>({{$category->posts->count()}})</span></a>
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
        </div>
@endsection
