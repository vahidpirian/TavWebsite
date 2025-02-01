@extends('site.layouts.master')

@section('content')
    <div class="site-breadcrumb">
        <div class="container">
            <h2 class="breadcrumb-title">{{$page->title}}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                <li class="active">{{$page->title}}</li>
            </ul>
        </div>
        <div class="breadcrumb-shape">
            <img src="{{asset('app-assets/img/shape-4-svg')}}" alt="">
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

    <div class="contact-area py-120">
        <div class="container">
            <div class="contact-wrapper">
               {!! $page->body !!}
            </div>
        </div>
    </div>
@endsection
