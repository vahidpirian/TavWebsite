<div class="preloader" style="display: none;">
    <div class="loader">
        <div class="loader-box-1"></div>
        <div class="loader-box-2"></div>
    </div>
</div>

<div class="top-header-desktop">
    <div class="container">
        <div class="top-header-nav">
            <div class="menu-nav-top">
                <nav>
                    <ul>
                        <li><a href="" class="active">صفحه نخست</a></li>
                        <li><a href="">وبلاگ</a></li>
                        <li><a href="">سوالات متداول</a></li>
                        <li><a href="">درباره ما</a></li>
                        <li><a href="">تماس با ما</a></li>
                    </ul>
                </nav>
            </div>

            <div class="contact-nav-top">
                <p class="support-text">
                    <i class="fas fa-headset support-icon"></i>
                    پاسخگوی پرسش‌های شما هستیم...
                </p>
                <a href="tel:02188815408" class="phone-number">
                    <i class="fas fa-phone-alt phone-icon"></i>
                    <span class="number">88815408</span>
                    <span class="area-code">021</span>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="top-header">
    <div class="container">
        <div class="top-header-content">
            <div class="brand">
                <a href="{{ route('home') }}">
                    <img class="header-logo" src="{{asset($setting->logo)}}" alt="{{$setting->site_name}}">
                </a>
            </div>
            <div class="service-menu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            <div class="icon-box">
                                <i class="fas fa-th"></i>
                            </div>
                            سایر خدمات
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-box">
                                <i class="fas fa-box"></i>
                            </div>
                            ارسال سمپل
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-box">
                                <i class="fas fa-plane"></i>
                            </div>
                            حمل و نقل هوایی
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-box">
                                <i class="fas fa-ship"></i>
                            </div>
                            حمل و نقل دریایی
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-box">
                                <i class="fas fa-building"></i>
                            </div>
                            صفر تا صد واردات از چین
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- overlay مجزا برای کل صفحه -->
<div class="site-overlay"></div>

<!-- هدر موبایل -->
<div class="mobile-header">
    <div class="container w-100">
        <div class="mobile-header-content">
            <div class="mobile-logo">
                <a href="{{ route('home') }}">
                    <img src="{{asset($setting->logo)}}" alt="{{$setting->site_name}}">
                </a>
            </div>
            <div class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </div>
</div>

<!-- منوی موبایل -->
<div class="mobile-menu">
    <div class="mobile-menu-container">
        <div class="mobile-menu-header">
            <div class="mobile-menu-close">
                <i class="fas fa-times"></i>
            </div>
            <div class="mobile-menu-logo">
                <img src="{{asset($setting->logo)}}" alt="{{$setting->site_name}}">
            </div>
        </div>
        <div class="mobile-menu-body">
            <ul class="mobile-nav">
                <li><a href="" class="active">صفحه نخست</a></li>
                <li><a href="">وبلاگ</a></li>
                <li><a href="">سوالات متداول</a></li>
                <li><a href="">درباره ما</a></li>
                <li><a href="">تماس با ما</a></li>
            </ul>
            <ul class="mobile-services">
                <li>
                    <a href="#">
                        <div class="icon-box">
                            <i class="fas fa-box"></i>
                        </div>
                        ارسال سمپل
                    </a>
                </li>
                <!-- سایر آیتم‌های منو -->
            </ul>
        </div>
    </div>
</div>
