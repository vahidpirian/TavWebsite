@extends('site.layouts.master')
@section('head-tag')
    <title>{{$service->title}}</title>
@endsection
@section('content')
        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">جزئیات سرویس</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active"> جزئیات سرویس</li>
                </ul>
            </div>
            <div class="breadcrumb-shape">
                <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
            </div>
        </div>


        <div class="service-single-area py-120">
            @if($banners && $banners->where('position',9)->first())

                <div class="container">
                    <a class="w-100" href="{{$banners->where('position',9)->first()->url}}" title="{{ $banners->where('position',9)->first()->title }}">
                        <img src="{{ asset($banners->where('position',9)->first()->image) }}"
                             alt="{{ $banners->where('position',9)->first()->title }}"
                             class="banner-image">
                    </a>
                </div>
            @endif
            <div class="container">
                <div class="service-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="service-sidebar">
                                <div class="widget category">
                                    <h4 class="widget-title">کلیه خدمات
                                    </h4>
                                    <div class="category-list">
                                        @foreach($services as $service)
                                            <a href="{{route('service.show',$service->id)}}"><i class="far fa-angle-double-left"></i>
                                                {{strlen($service->title) > 35 ? mb_substr($service->title,0,35).'...' : $service->title}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="service-details">
                                <div class="service-details-img mb-30">
                                    <img src="{{asset($service->image)}}" alt="thumb">
                                </div>
                                <div class="service-details">
                                    <h3 class="mb-30">
                                       {{$service->title}}
                                    </h3>
                                   {!! $service->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @if($banners && $banners->where('position',12)->first())
                    <div class="container">
                        <a class="w-100" href="{{ $banners->where('position',12)->first()->url}}" title="{{ $banners->where('position',12)->first()->title }}">
                            <img src="{{ asset($banners->where('position',12)->first()->image) }}"
                                 alt="{{ $banners->where('position',12)->first()->title }}"
                                 class="banner-image">
                        </a>
                    </div>
                @endif
        </div>
@endsection
