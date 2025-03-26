<div class="preloader" style="display: none;">
    <div class="loader">
        <div class="loader-box-1"></div>
        <div class="loader-box-2"></div>
    </div>
</div>

<div class="top-header-desktop">
    <div class="container bd-bt">
        <div class="top-header-nav">
            <div class="menu-nav-top">
                <nav>
                    <ul>
                        @foreach($menus->where('type','normal') as $menu)
                            <li><a href="{{$menu->url}}" class="{{$menu->url == request()->url() ? 'active' : ''}}">{{$menu->name}}</a></li>
                        @endforeach

{{--                        <li class="has-dropdown">--}}
{{--                            <a href="#">صفحه‌ها <i class="fas fa-chevron-down"></i></a>--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                @foreach($pages as $page)--}}
{{--                                    <li><a href="{{route('service.show',$page->id)}}">{{$page->title}}</a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <li><a href="{{route('login')}}">ورود/ثبت نام</a></li>
                    </ul>
                </nav>
            </div>

            <div class="contact-nav-top">
                <p class="support-text">
                    <i class="fas fa-headset support-icon"></i>
                    پاسخگوی پرسش‌های شما هستیم...
                </p>
                <a href="tel:{{$setting->mobile}}" class="phone-number">
                    <i class="fas fa-phone-alt phone-icon"></i>
                    <span class="number IRANSans">{{$setting->mobile}}</span>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="top-header">
    <div class="container bd-bt">
        <div class="top-header-content">
            <div class="brand">
                <a href="{{ route('home') }}">
                    <img class="header-logo" src="{{asset($setting->logo)}}" alt="{{$setting->site_name}}">
                </a>
            </div>
            <div class="service-menu">
                <ul>
                    @foreach($menus->where('type','service') as $menu)
                        <li>
                            <a href="{{$menu['url']}}">
                                <div class="icon-box">
                                    <i class="{{$menu['icon']}}"></i>
                                </div>
                                {{$menu['name']}}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('service.index') }}">
                            <div class="icon-box">
                                <i class="fas fa-th"></i>
                            </div>
                            سایر خدمات
                        </a>
                    </li>
                </ul>
            </div>

            <div class="search-box">
                <div class="search-container">
                    <input type="text" id="liveSearch" placeholder="جستجو..." autocomplete="off">
                    <button type="button"><i class="fas fa-search"></i></button>

                    {{-- نتایج جستجو --}}
                    <div class="search-results" id="searchResults">
                        <div class="search-loading" id="searchLoading">
                            <div class="spinner"></div>
                        </div>
                    </div>
                </div>
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
                @foreach($menus->where('type','normal') as $menu)
                    <li><a href="{{$menu->url}}" class="{{$menu->url == request()->url() ? 'active' : ''}}">{{$menu->name}}</a></li>
                @endforeach
                <li><a href="{{route('login')}}">ورود/ثبت نام</a></li>
            </ul>
        </div>
    </div>
</div>
