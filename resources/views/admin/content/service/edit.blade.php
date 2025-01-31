@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش خدمت</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#">خدمات</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش خدمت</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش خدمت
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.service.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.service.update', $service->id) }}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                    {{ method_field('put') }}
                    <section class="row">

                        <section class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="">عنوان خدمت</label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title', $service->title) }}">
                            </div>
                            @error('title')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            @error('image')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            <section class="row">
                                @if($service->image)
                                    <section class="col-md-6 mt-2">
                                        <div class="mt-2">
                                            <img src="{{ asset($service->image) }}" alt="" width="100" height="50">
                                        </div>
                                    </section>
                                @endif
                            </section>
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">خلاصه</label>
                                <textarea name="summary" id="summary" class="form-control form-control-sm" rows="6">{{ old('summary', $service->summary) }}</textarea>
                            </div>
                            @error('summary')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">توضیحات</label>
                                <textarea name="description" id="description" class="form-control form-control-sm" rows="6">{{ old('description', $service->description) }}</textarea>
                            </div>
                            @error('description')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status', $service->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status', $service->status) == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
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

@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('admin.content.ckeditor.upload') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form',
            height: 300,
            extraPlugins: 'uploadimage',
            uploadUrl: "{{ route('admin.content.ckeditor.upload') }}?_token={{ csrf_token() }}",
            imageUploadUrl: "{{ route('admin.content.ckeditor.upload') }}?_token={{ csrf_token() }}",
            removeDialogTabs: 'image:advanced;link:advanced',
            removeButtons: 'PasteFromWord'
        });
    </script>
@endsection
