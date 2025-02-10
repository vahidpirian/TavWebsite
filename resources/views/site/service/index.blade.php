@extends('site.layouts.master')
@section('head-tag')
    <title>خدمات ها</title>
@endsection
@section('content')
    <div class="site-breadcrumb">
        <div class="container">
            <h2 class="breadcrumb-title">خدمات ها</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                    </a></li>
                <li class="active">خدمات ها</li>
            </ul>
        </div>
        <div class="breadcrumb-shape">
            <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
        </div>
    </div>


    <div class="service-area bg py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">خدمات تخصصی</span>
                    <h2 class="site-title">خدمات <span>بازرگانی تاو 360</span></h2>
                    <div class="heading-divider"></div>
                </div>
            </div>
        </div>
        @if($banners && $banners->where('position',3)->first())
            <div class="container">
                <a class="w-100" href="{{ $banners->where('position',3)->first()->url }}" title="{{ $banners->where('position',3)->first()->title }}">
                    <img src="{{ asset($banners->where('position',3)->first()->image) }}"
                         alt="{{ $banners->where('position',3)->first()->title }}"
                         class="banner-image">
                </a>
            </div>
        @endif
        <div class="row">
            @foreach($services as $service)
            <div class="col-md-6 col-lg-3">
                <div class="service-item h295px">
                    <div class="service-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="service-title">
                        <a href="{{ route('service.show', $service->id) }}">{{ $service->title }}</a>
                    </h3>
                    <p class="service-text">
                        {{ mb_substr($service->summary,0,85).'...' }}
                    </p>
                    <div class="service-arrow">
                        <a href="{{ route('service.show', $service->id) }}" class="service-read-btn">
                            جزئیات بیشتر<i class="far fa-long-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($banners && $banners->where('position',6)->first())
            <div class="container">
                <a class="w-100" href="{{ $banners->where('position',6)->first()->url }}" title="{{ $banners->where('position',6)->first()->title }}">
                    <img src="{{ asset($banners->where('position',6)->first()->image) }}"
                         alt="{{ $banners->where('position',6)->first()->title }}"
                         class="banner-image">
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
