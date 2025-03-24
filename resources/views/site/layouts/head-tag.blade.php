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
        padding: 10px 0;
        font-family: Yekan;
        border-bottom: 1px solid #eee9e9;
    }

    .top-header-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .top-header-content,
    .top-header-nav {
        padding: 0;
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

    /* استایل اصلی منو بدون تغییر */
    .menu-nav-top nav > ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 25px;
    }

    .menu-nav-top nav ul li.has-dropdown > a {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 0; /* حذف padding اضافی */
        margin: 0; /* حذف margin اضافی */
        height: 100%; /* اطمینان از یکسان بودن ارتفاع */
    }

    .menu-nav-top nav ul li.has-dropdown {
        position: relative;
        display: flex;
        align-items: center;
        margin-top: 3px;
    }

    .menu-nav-top nav ul li.has-dropdown > a i {
        font-size: 12px;
        margin-right: 3px;
        margin-top: 2px; /* تنظیم موقعیت آیکون */
    }

    /* استایل زیرمنو */
    .menu-nav-top nav ul li.has-dropdown .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        min-width: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        padding: 8px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1000;
        display: block !important;
    }

    /* نمایش زیرمنو در هنگام هاور */
    .menu-nav-top nav ul li.has-dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    /* استایل آیتم‌های زیرمنو */
    .menu-nav-top nav ul li.has-dropdown .dropdown-menu li {
        display: block;
        margin: 0;
        padding: 0;
    }

    .menu-nav-top nav ul li.has-dropdown .dropdown-menu li a {
        display: block;
        padding: 8px 20px;
        color: #64748b;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .menu-nav-top nav ul li.has-dropdown .dropdown-menu li a:hover {
        background-color: #f8fafc;
        color: #0088ff;
        padding-right: 25px;
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


    .top-header {
        background-color: #fff;
        padding: 15px 0;
        border-bottom: 1px solid #f0dede;
    }

    .top-header-content {
        display: flex;
        align-items: center;
        gap: 50px;
    }

    .brand {
        flex-shrink: 0;
    }

    .brand a {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .brand img {
        height: 35px;
        width: 145px;
    }

    .brand span {
        color: #1e3a8a;
        font-family: 'yekan', sans-serif;
        font-size: 18px;
    }

    .service-menu {
        flex-grow: 1;
    }

    .service-menu ul {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 25px;
        font-family: Yekan;
    }

    .service-menu ul li a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #8c919c;
        font-size: 14px;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .service-menu .icon-box {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8fafc; /* همیشه خاکستری روشن */
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .service-menu .icon-box i {
        font-size: 20px;
        color: #8c919c;
        transition: all 0.3s ease;
    }

    /* Hover Effects */
    .service-menu ul li a:hover {
        color: #0088ff;
    }

    .service-menu ul li a:hover .icon-box i {
        color: #0088ff; /* فقط آیکون آبی می‌شود */
    }

    /* Active state */
    .service-menu ul li a.active {
        color: #0088ff;
    }

    .service-menu ul li a.active .icon-box i {
        color: #0088ff; /* فقط آیکون آبی می‌شود */
    }

    /* Desktop/Mobile Visibility */
    @media (max-width: 992px) {
        .top-header-desktop,
        .service-menu {
            display: none;
        }

        .mobile-menu-toggle {
            display: block;
        }
    }

    @media (min-width: 993px) {
        .mobile-menu,
        .mobile-menu-toggle {
            display: none;
        }
    }

    /* Mobile Menu Styles */
    .mobile-menu-toggle {
        cursor: pointer;
    }

    .mobile-menu {
        position: fixed;
        top: 0;
        right: -300px;
        width: 300px;
        height: 100vh;
        background: #fff;
        z-index: 1000;
        transition: 0.3s ease;
        font-family: Yekan;
    }

    .mobile-menu.active {
        right: 0;
    }

    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        visibility: hidden;
        transition: 0.3s ease;
    }

    .mobile-menu.active .mobile-menu-overlay {
        opacity: 1;
        visibility: visible;
    }

    .mobile-menu-container {
        height: 100%;
        overflow-y: auto;
        padding: 20px;
    }

    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .mobile-menu-close {
        cursor: pointer;
        font-size: 20px;
    }

    .mobile-menu-logo img {
        height: 40px;
    }

    .mobile-nav,
    .mobile-services {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-nav li a,
    .mobile-services li a {
        display: flex;
        align-items: center;
        padding: 12px 0;
        color: #64748b;
        text-decoration: none;
        border-bottom: 1px solid #eee;
    }

    .mobile-services li a .icon-box {
        width: 35px;
        height: 35px;
        margin-left: 10px;
    }

    /* Site Overlay */
    .site-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 997;
        display: none;
    }

    .site-overlay.active {
        display: block;
    }

    /* Mobile Header */
    .mobile-header {
        display: none;
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        background: #fff;
        z-index: 998;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        height: 60px;
    }

    .mobile-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
        padding: 0 15px;
    }

    .mobile-logo {
        margin-right: 0; /* لوگو سمت راست */
    }

    .mobile-logo img {
        height: 35px;
        width: 130px;
    }

    .mobile-menu-toggle {
        margin-left: 0; /* دکمه سمت چپ */
    }

    .mobile-menu-toggle i {
        font-size: 24px;
    }

    /* Desktop/Mobile Visibility */
    @media (max-width: 992px) {
        .top-header-desktop,
        .top-header {
            display: none;
        }

        .mobile-header {
            display: block;
        }

        body {
            padding-top: 60px;
        }
    }

    @media (min-width: 993px) {
        .mobile-header,
        .mobile-menu,
        .site-overlay {
            display: none;
        }
    }

    /* فقط این دو استایل را اضافه/اصلاح کنید */
    .dropdown-menu {
        display: block !important; /* مهم: برای اطمینان از عمودی بودن */
    }

    .dropdown-menu li {
        display: block !important;
        width: 100%;
    }
</style>
