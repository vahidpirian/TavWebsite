@extends('site.layouts.master')
@section('head-tag')
    <title>پروژه ها</title>
@endsection
@section('content')
        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">پروژه
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{route('project.index')}}"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active">پروژه
                    </li>
                </ul>
            </div>
            <div class="breadcrumb-shape">
                <img src="{{asset('app-assets/img/shape-4.svg')}}" alt="">
            </div>
        </div>


        <div class="case-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">نمونه‌ها</span>
                            <h2 class="site-title">پروژه‌های <span>ویژه</span></h2>
                            <div class="heading-divider"></div>
                        </div>
                    </div>
                </div>
                <div class="row filter-box popup-gallery">
                    @foreach($projects as $project)
                    <div class="col-md-6 col-lg-4 filter-item">
                        <div class="case-item">
                            <div class="case-img">
                                <img class="img-fluid" src="{{ asset($project->image) }}" alt="{{ $project->name }}">
                                <a class="popup-img case-link" href="{{ asset($project->image) }}">
                                    <i class="far fa-plus"></i>
                                </a>
                            </div>
                            <div class="case-content">
                                <div class="case-content-info">
                                    <small>{{ $project->status_project_persian }}</small>
                                    <h4><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></h4>
                                </div>
                                <a href="{{ route('project.show', $project->id) }}" class="case-arrow">
                                    <i class="far fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
