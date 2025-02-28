@extends('site.layouts.master')
@section('head-tag')
    <title>ثبت نام</title>
@endsection
@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">ثبت نام
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active">ثبت نام
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
                            <h3>ثبت نام کنید
                            </h3>
                            <p>حساب tav360 خود را ایجاد کنید
                            </p>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger text-center">{{session('error')}}</div>
                        @endif
                        <form action="{{ route('auth.user.register') }}" method="POST">
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
                            <div class="form-group">
                                <label>تکرار رمز عبور</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="تکرار رمز عبور شما">
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="theme-btn">ثبت نام
                                    <i class="far fa-sign-in"></i></button>
                            </div>
                        </form>
                        <div class="login-footer">
                            <p>حساب کاربری دارید؟
                                <a href="{{ route('login') }}">وارد شوید.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
