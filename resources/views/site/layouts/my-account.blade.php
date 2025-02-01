@extends('site.layouts.master')

@section('head-tag')
    @yield('styles')
    <style>
        .sidebar {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #6c757d;
            text-decoration: none;
            border-radius: 10px;
            margin: 5px;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .sidebar-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .sidebar-link i {
            width: 24px;
            font-size: 1.1rem;
            margin-left: 10px;
        }

        .account-header {
            background: linear-gradient(45deg, #4776E6, #8E54E9);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .account-header h1 {
            color: white;
            margin: 0;
            font-size: 1.8rem;
        }

        .account-header p {
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }

        .content-wrapper {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Dashboard Cards Styles */
        .dashboard-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            min-height: 180px;
        }

        .stat-card.primary-card {
            background: linear-gradient(45deg, #4776E6, #8E54E9);
        }

        .stat-card.success-card {
            background: linear-gradient(45deg, #11998e, #38ef7d);
        }

        .stat-card.info-card {
            background: linear-gradient(45deg, #2193b0, #6dd5ed);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .stat-card .icon-box {
            width: 65px;
            height: 65px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
        }

        .stat-card .icon-box i {
            font-size: 28px;
            color: rgba(255, 255, 255, 0.9);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Table Styles */
        .ticket-table {
            border-radius: 15px;
            overflow: hidden;
            margin: 0;
        }

        .ticket-table thead th {
            background: linear-gradient(45deg, #f8f9fa, #ffffff);
            border: none;
            padding: 15px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #444;
            white-space: nowrap;
        }

        .ticket-table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .ticket-table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
            transform: translateY(-1px);
        }

        .ticket-table td {
            padding: 15px;
            vertical-align: middle;
            color: #555;
            font-size: 0.9rem;
        }

        .status-badge {
            padding: 8px 12px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-width: 100px;
            justify-content: center;
        }

        .status-badge.status-open {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
            border: 1px solid rgba(25, 135, 84, 0.2);
        }

        .status-badge.status-closed {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
            border: 1px solid rgba(108, 117, 125, 0.2);
        }

        .ticket-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .action-btn.btn-view {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }

        .action-btn.btn-view:hover {
            background-color: rgba(13, 202, 240, 0.2);
            transform: translateY(-1px);
        }

        .empty-state {
            padding: 40px 20px;
            text-align: center;
        }

        .empty-state i {
            font-size: 48px;
            color: #6c757d;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state p {
            color: #6c757d;
            font-size: 0.95rem;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="site-breadcrumb">
        <div class="container">
            <h2 class="breadcrumb-title">
                حساب کاربری
            </h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                    </a></li>
                <li class="active">
                    <a href="{{route('account.dashboard')}}">حساب کاربری</a>
                </li>
            </ul>
        </div>
        <div class="breadcrumb-shape">
            <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
        </div>
    </div>

    <div class="container py-5">
        <div class="account-header">
            <h1>حساب کاربری من</h1>
            <p>{{ Auth::user()->full_name }} عزیز، خوش آمدید</p>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar p-3">
                    <a href="{{ route('account.dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('account.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        داشبورد
                    </a>

                    <a href="{{ route('account.profile') }}"
                       class="sidebar-link {{ request()->routeIs('account.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        ویرایش پروفایل
                    </a>

                    <a href="{{ route('account.tickets.index') }}"
                       class="sidebar-link {{ request()->routeIs('account.tickets.*') ? 'active' : '' }}">
                        <i class="fas fa-ticket-alt"></i>
                        تیکت‌های پشتیبانی
                    </a>


                    <form action="{{ route('auth.user.logout') }}" class="mt-3">
                        <button type="submit" class="sidebar-link w-100 text-right border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt"></i>
                            خروج از حساب
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="content-wrapper">
                    @if(session('error'))
                        <div class="alert alert-danger text-center">{{session('error')}}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success text-center">{{session('success')}}</div>
                    @endif
                    @yield('account-content')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://kit.fontawesome.com/your-code.js"></script>
    @yield('scripts')
@endsection
