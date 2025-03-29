<div class="preloader" style="display: none;">
    <div class="loader">
        <div class="loader-box-1"></div>
        <div class="loader-box-2"></div>
    </div>
</div>

<div class="header-wrapper">
    <div class="top-header-desktop">
        <div class="container bd-bt">
            <div class="top-header-nav">
                <div class="menu-nav-top">
                    <nav>
                        <ul>
                            @foreach($menus->where('type','normal') as $menu)
                                @if($menu->children->count() > 0)
                                    <li class="has-dropdown">
                                        <a href="#">{{$menu->name}} <i class="fas fa-chevron-down"></i></a>
                                        <ul class="dropdown-menu">
                                            @foreach($menu->children as $item)
                                                <li><a href="{{$item->url}}">{{$item->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{$menu->url}}"
                                           class="{{$menu->url == request()->url() ? 'active' : ''}}">{{$menu->name}}</a></li>
                                @endif

                            @endforeach


                            <li><a href="{{route('login')}}">ورود/ثبت نام</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="contact-nav-top">
                    <p class="support-text">
                        <i class="fas fa-headset support-icon"></i>
                        پاسخگوی پرسش‌های شما هستیم...
                    </p>
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
                        @foreach($service_menus as $menu)
                            <li class="menu-item {{ $menu->children->count() > 0 ? 'has-submenu' : '' }}">
                                <a href="{{$menu['url']}}">
                                    <div class="service-menu-item">
                                        <div class="icon-box-menu-service">
                                            <i class="{{$menu->icon}}"></i>
                                        </div>
                                        <div class="menu-content">
                                            <div class="menu-subtitle-top">{{$menu->sub_top}}</div>
                                            <h3 class="menu-subtitle-bottom">{{$menu->sub_bottom}}  @if($menu->children->count() > 0)
                                                    &nbsp;<i class="fas fa-chevron-down"></i>
                                                @endif</h3>
                                        </div>
                                    </div>
                                </a>
                                @if($menu->children->count() > 0)
                                    <div class="submenu-container">
                                        <div class="submenu-wrapper">
                                            @foreach($menu->children as $submenu)
                                                <a href="{{$submenu->url}}" class="submenu-item">
                                                    <div class="submenu-icon">
                                                        <i class="{{$submenu->icon}}"></i>
                                                    </div>
                                                    <div class="submenu-content">
                                                        <div class="submenu-subtitle">{{$submenu->sub_top}}</div>
                                                        <div class="submenu-title">{{$submenu->sub_bottom}}</div>

                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href="tel:{{$setting->mobile}}" class="phone-number">
                    <i class="fas fa-phone-alt phone-icon"></i>
                    <span class="number IRANSans">{{str_replace('021-','',$setting->mobile)}}</span>
                    <span class="area-code IRANSans">021</span>
                </a>


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
                    <li><a href="{{$menu->url}}"
                           class="{{$menu->url == request()->url() ? 'active' : ''}}">{{$menu->name}}</a></li>
                @endforeach
                <li><a href="{{route('login')}}">ورود/ثبت نام</a></li>
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const headerWrapper = document.querySelector('.header-wrapper');
    const topHeaderDesktop = document.querySelector('.top-header-desktop');
    const topHeader = document.querySelector('.top-header');
    let lastScrollTop = 0;
    let headerHeight = headerWrapper.offsetHeight;

    // Clone headers for fixed version
    const fixedHeaders = headerWrapper.cloneNode(true);
    fixedHeaders.classList.add('header-fixed');
    document.body.appendChild(fixedHeaders);

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Show/hide fixed header based on scroll direction
        if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
            // Scrolling down & past header
            fixedHeaders.classList.add('show');
            // Add padding only when fixed header is shown
            document.body.style.paddingTop = headerHeight + 'px';
        } else {
            // Scrolling up or at top
            fixedHeaders.classList.remove('show');
            // Remove padding when fixed header is hidden
            document.body.style.paddingTop = '0';
        }
        
        lastScrollTop = scrollTop;
    });
});
</script>
