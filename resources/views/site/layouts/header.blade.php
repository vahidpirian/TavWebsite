<div class="preloader" style="display: none;">
    <div class="loader">
        <div class="loader-box-1"></div>
        <div class="loader-box-2"></div>
    </div>
</div>

<div class="top-header-desktop">
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


<header class="header-wrapper">
    <div class="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset($setting->logo)}}" class="logo" alt="{{$setting->site_name}}">
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav me-auto">
                        @foreach($menus as $menu)
                            <li class="nav-item">
                                <a class="nav-link px-1" href="{{$menu->url}}">{{$menu->name}}</a>
                            </li>
                        @endforeach

                        @if(count($pages))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-1" href="#" data-bs-toggle="dropdown">صفحه‌ها</a>
                                <ul class="dropdown-menu fade-up">
                                    @foreach($pages as $page)
                                        <li><a class="dropdown-item py-1" href="{{route('page',$page->slug)}}">{{$page->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item">
                            @auth
                                <a class="nav-link px-1" href="{{route('account.dashboard')}}">حساب کاربری</a>
                            @else
                                <a class="nav-link px-1" href="{{ route('login') }}">ورود/ثبت نام</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
