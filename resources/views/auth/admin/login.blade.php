<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">

    <title>صفحه ورود</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            background-color: #2a2a2a; /* رنگ پس‌زمینه فیلدها */
            color: #ffffff; /* رنگ متن فیلدها */
            border: 1px solid #444; /* رنگ حاشیه فیلدها */
        }
        .form-control:focus {
            background-color: #333; /* رنگ پس‌زمینه فیلد در حالت فوکوس */
            border-color: #007bff; /* رنگ حاشیه فیلد در حالت فوکوس */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-login {
            width: 100%;
            background-color: #007bff; /* رنگ دکمه */
            border: none;
        }
        .btn-login:hover {
            background-color: #0056b3; /* رنگ دکمه در حالت هاور */
        }
        .text-center {
            margin-top: 20px;
        }
    </style>
</head>

<body dir="rtl">

<div class="login-container">
    <div class="logo">
        <img src="{{asset('logo.png')}}" alt="لوگو">
    </div>
    <h4 class="text-center">ورود به حساب کاربری</h4>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{session('error')}}</div>
    @endif

    <form action="{{route('auth.admin.check_login')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="mobile">شماره موبایل</label>
            <input type="text" class="form-control" id="mobile" name="mobile" required>
        </div>
        <div class="form-group">
            <label for="password">رمز عبور</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-login">ورود</button>
    </form>
{{--    <div class="text-center">--}}
{{--        <a href="#" class="text-white">فراموشی رمز عبور؟</a>--}}
{{--    </div>--}}
</div>



<script src="{{ asset('admin-assets/js/bootstrap/bootstrap.min.js') }}"></script>
</body>

</html>
