@extends('site.layouts.master')
@section('head-tag')
    <title>ورود به حساب کاربری</title>
@endsection
@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">وارد شوید
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active">ورود به سیستم
                    </li>
                </ul>
            </div>
            <div class="breadcrumb-shape">
                <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
            </div>
        </div>


        <div class="login-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <h3>وارد شوید
                            </h3>
                            <p>با حساب tab360 خود وارد شوید
                            </p>
                        </div>
                        <form action="{{ route('auth.user.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>شماره موبایل</label>
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="شماره موبایل شما">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>رمز عبور</label>
                                <input type="password" name="password" class="form-control" placeholder="رمز عبور شما">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        مرا به خاطر بسپار
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn">وارد شوید
                                    <i class="far fa-sign-in"></i></button>
                            </div>
                        </form>
                        <div class="login-footer">
                            <p>حساب کاربری ندارید؟
                                <a href="{{ route('auth.user.register-form') }}">ثبت نام کنید.</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
