@extends('site.layouts.master')

@section('content')
{{--    <div class="site-breadcrumb">--}}
{{--        <div class="container">--}}
{{--            <ul class="breadcrumb-menu">--}}
{{--                <li><a href="{{ route('home') }}"><i class="far fa-home"></i> صفحه اصلی</a></li>--}}
{{--                <li class="active">تماس با ما</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="breadcrumb-shape">--}}
{{--            <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="contact-area py-120">
        @if($banner)
            <div class="container">
                <a class="w-100" href="{{ $banner->url }}" title="{{ $banner->title }}">
                    <img src="{{ asset($banner->image) }}"
                         alt="{{ $banner->title }}"
                         class="banner-image">
                </a>
            </div>
        @endif
        <div class="container">
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-md-8 align-self-center">
                        <div class="contact-form">
                            <div class="contact-form-header">
                                <h2>تماس بگیرید</h2>
                                <p>برای ارتباط با ما می‌توانید از طریق فرم زیر پیام خود را ارسال کنید.</p>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{{ old('name') }}" placeholder="نام شما">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control @error('mobile') is-invalid @enderror"
                                                   name="mobile" value="{{ old('mobile') }}" placeholder="موبایل شما">
                                            @error('mobile')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                           name="subject" value="{{ old('subject') }}" placeholder="موضوع پیام">
                                    @error('subject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                              rows="5" placeholder="پیام خود را بنویسید">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="theme-btn">ارسال پیام<i class="far fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-content">
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>آدرس دفتر</h5>
                                    <p>{{$setting->address}}</p>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-phone"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>تماس مستقیم</h5>
                                    <p>{{$setting->mobile}}</p>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>ایمیل ما</h5>
                                    <p>{{$setting->email}}</p>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-clock"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>ساعات کاری</h5>
                                    <p>شنبه تا چهارشنبه (8 صبح تا 6 عصر)</p>
                                </div>
                            </div>
                            <div class="contact-info">
                                <div class="contact-info-icon">
                                    <i class="fal fa-link"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h5>شبکه های اجتماعی</h5>
                                    <ul>
                                        @foreach($setting->socials ?? [] as $social)
                                            @if($social['status'] == '1')
                                                <li><a href="{{$social['link']}}"><i class="{{$social['icon']}}"></i></a></li>
                                            @endif

                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
