@extends('admin.layouts.master')

@section('head-tag')
<title>آمار شرکت</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item active font-size-12" aria-current="page">آمار شرکت</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>آمار شرکت</h5>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                @if(count($statistics) < 4)
                <a href="{{ route('admin.content.company-statistic.create') }}" class="btn btn-info btn-sm">ایجاد آمار جدید</a>
                @endif
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>تعداد</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statistics as $key => $statistic)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $statistic->title }}</td>
                            <td>{{ $statistic->number }}</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.content.company-statistic.edit', $statistic->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.content.company-statistic.destroy', $statistic->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </section>
    </section>
</section>
@endsection 