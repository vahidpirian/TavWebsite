@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد آمار جدید</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#">آمار شرکت</a></li>
        <li class="breadcrumb-item active font-size-12" aria-current="page">ایجاد آمار جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>ایجاد آمار جدید</h5>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.company-statistic.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.company-statistic.store') }}" method="post">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input type="text" class="form-control form-control-sm" name="title" id="title" value="{{ old('title') }}">
                            </div>
                            @error('title')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="number">درصد</label>
                                <input type="number" class="form-control form-control-sm" name="number" id="number" value="{{ old('number') }}">
                            </div>
                            @error('number')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>
        </section>
    </section>
</section>
@endsection
