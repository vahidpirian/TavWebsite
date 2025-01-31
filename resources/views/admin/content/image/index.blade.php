@extends('admin.layouts.master')

@section('head-tag')
<title>تصاویر</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item active font-size-12" aria-current="page">تصاویر</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>تصاویر</h5>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.image.create') }}" class="btn btn-info btn-sm">ایجاد تصویر جدید</a>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>جایگاه</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $key => $image)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>
                                <img src="{{ asset($image->image) }}" alt="" width="100" height="50">
                            </td>
                            <td>{{ $image->position_persian }}</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.content.image.edit', $image->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.content.image.destroy', $image->id) }}" method="post">
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
