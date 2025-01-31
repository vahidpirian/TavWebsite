<div class="preloader" style="display: none;">
    <div class="loader">
        <div class="loader-box-1"></div>
        <div class="loader-box-2"></div>
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
                                <a class="nav-link px-1" href="{{ route('auth.user.login-form') }}">ورود به حساب کاربری</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
