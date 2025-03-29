@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش آیکون</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">آیکون‌ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش آیکون</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ویرایش آیکون
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.icon.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.icon.update', $icon->id) }}" method="post" id="form">
                    @csrf
                    {{ method_field('put') }}
                    <section class="row">

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">نام آیکون</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ old('name', $icon->name) }}">
                            </div>
                            @error('name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">کلاس آیکون</label>
                                <input type="text" class="form-control form-control-sm" name="icon" id="icon" value="{{ old('icon', $icon->icon) }}" placeholder="مثال: fas fa-user">
                            </div>
                            @error('icon')
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
                                    <option value="0" @if(old('status', $icon->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status', $icon->status) == 1) selected @endif>فعال</option>
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
