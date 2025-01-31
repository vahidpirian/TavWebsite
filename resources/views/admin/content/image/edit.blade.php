@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش تصویر</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#">تصاویر</a></li>
        <li class="breadcrumb-item active font-size-12" aria-current="page">ویرایش تصویر</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>ویرایش تصویر</h5>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.image.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.image.update', $image->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">
                        <section class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                                <img src="{{ asset($image->image) }}" alt="" width="100" class="mt-3">
                            </div>
                            @error('image')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </section>
                        <section class="col-12 col-md-12">
                            <div class="form-group">
                                <label for="position">جایگاه</label>
                                <select name="position" id="position" class="form-control form-control-sm">
                                    <option value="">جایگاه را انتخاب کنید</option>
                                    <option value="1" {{ old('position',$image->position) == 1 ? 'selected' : '' }}>صحفه اصلی</option>
                                    <option value="2" {{ old('position',$image->position) == 2 ? 'selected' : '' }}>بخش چرا تاو 360</option>
                                    <option value="3" {{ old('position',$image->position) == 3 ? 'selected' : '' }}>پیش نمایش ویدیو صحفه اصلی</option>
                                </select>
                            </div>
                            @error('position')
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
