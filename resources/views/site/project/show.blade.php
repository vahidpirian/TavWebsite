@extends('site.layouts.master')
@section('head-tag')
    <title>{{$project->name}}</title>
@endsection
@section('content')
        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title"> جزئیات پروژه
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{route('home')}}"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active"> جزئیات پروژه </li>
                </ul>
            </div>
            <div class="breadcrumb-shape">
                <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
            </div>
        </div>


        <div class="case-single-area py-120">
            <div class="container">
                <div class="case-single-wrapper">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4">
                            <div class="case-sidebar">
                                <div class="widget case-sidebar-content">
                                    <h4 class="case-sidebar-title">جزئیات پروژه
                                    </h4>
                                    <ul>
                                        <li>
                                            تاریخ شروع <span>{{$project->start_date}}</span>
                                        </li>
                                        <li>
                                            تاریخ تکمیل <span>{{$project->status_project == 'completed' ? $project->end_date : ' درحال انجام '}} </span>
                                        </li>
                                        <li>
                                            وضعیت <span>{{$project->status_project_perisan}}</span>
                                        </li>
                                        <li>
                                            شماره موبایل <span>{{$project->company_mobile}}</span>
                                        </li>
                                        <li>
                                            شماره موبایل مشتری <span>{{$project->customer_mobile}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="widget case-new-project">
                                    <h4>به یک پروژه کاملاً جدید نیاز دارید؟</h4>
                                    <a href="{{route('contact.index')}}" class="new-project-btn">اکنون تماس بگیرید
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8">
                            <div class="case-details">
                                <div class="case-details-img mb-30">
                                    <img src="{{asset($project->image)}}" alt="thumb">
                                </div>
                                <div class="case-details">
                                    <h3 class="mb-30">
                                        {{$project->name}}
                                    </h3>
                                    {!! $project->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
