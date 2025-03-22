<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{$setting->description}}">
<meta name="keywords" content="{{$setting->keywords}}">
<link rel="icon" type="image/x-icon" href="{{asset($setting->icon)}}">

<link rel="stylesheet" href="{{asset('app-assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('app-assets/css/all-fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('app-assets/css/flaticon.css')}}">
<link rel="stylesheet" href="{{asset('app-assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('app-assets/css/magnific-popup.min.css')}}">
<link rel="stylesheet" href="{{asset('app-assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('app-assets/css/style.css')}}">

<style>
    .top-header-desktop {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 40px;
        background: #fff;
        height: 45px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 10px;
    }

    .menu-nav-top nav ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 25px;
    }

    .menu-nav-top nav ul li a {
        color: #666;
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 400;
        transition: color 0.2s ease;
        position: relative;
    }

    /* استایل برای لینک فعال */
    .menu-nav-top nav ul li a.active {
        color: #0088ff;
    }

    /* افکت هاور ساده */
    .menu-nav-top nav ul li a:hover {
        color: #0088ff;
    }

    @media (max-width: 992px) {
        .top-header-desktop {
            display: none;
        }
    }
    .contact-nav-top {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        padding-right: 20px;
    }

    .contact-nav-top::before {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 30px;
        width: 2px;
        background: linear-gradient(to bottom, transparent, #0088ff, transparent);
    }

    .contact-nav-top .phone-number {
        display: flex;
        align-items: center;
        text-decoration: none;
        font-weight: bold;
        padding: 8px 15px;
        border-radius: 20px;
        background-color: rgba(0,136,255,0.05);
        transition: all 0.3s ease;
    }

    .contact-nav-top .phone-number:hover {
        background-color: rgba(0,136,255,0.1);
        transform: translateY(-1px);
    }

    .contact-nav-top .phone-icon {
        color: #0088ff;
        margin-left: 8px;
        font-size: 14px;
    }

    .contact-nav-top .number {
        color: #0088ff;
        font-size: 18px;
    }

    .contact-nav-top .area-code {
        color: #666;
        font-size: 14px;
        margin-right: 5px;
    }

    .contact-nav-top .support-text {
        color: #666;
        font-size: 13px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .contact-nav-top .support-icon {
        color: #0088ff;
        font-size: 14px;
    }

    @media (max-width: 992px) {
        .top-header-desktop {
            display: none;
        }
    }

    /* افکت انیمیشن برای لود شدن */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .top-header-desktop {
        animation: fadeInDown 0.5s ease-out;
    }



</style>
