@extends('admin.layouts.master')

@section('head-tag')
<title>پشتیبانی سرویس</title>
<link href="{{ asset('admin-assets/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/quill/editor-fa.css') }}" rel="stylesheet">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">پشتیبانی سرویس</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پشتیبانی سرویس</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد پشتیبانی سرویس
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.service-support.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.service-support.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان خلاصه</label>
                                <input type="text" name="small_title" class="form-control form-control-sm" value="{{ old('small_title') }}">
                            </div>
                            @error('small_title')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان</label>
                                <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title') }}">
                            </div>
                            @error('title')
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
                                <div id="editor" style="height: 300px;">{{ old('description') }}</div>
                                <input type="hidden" name="description" id="description">
                            </div>
                            @error('description')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">متن دکمه</label>
                                <input type="text" name="button_text" class="form-control form-control-sm" value="{{ old('button_text') }}">
                            </div>
                            @error('button_text')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نوع لینک</label>
                                <select name="url_type" id="urlType" class="form-control form-control-sm">
                                    <option value="url">لینک مستقیم</option>
                                    <option value="page">انتخاب صفحه</option>
                                </select>
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">آدرس URL</label>
                                <input type="text" name="url" value="{{ old('url') }}" class="form-control form-control-sm" id="urlInput"
                                       @if(old('url_type') == 'page') type="hidden" @endif>

                                <select name="page_id" id="pageSelect" class="form-control form-control-sm"
                                        @if(old('url_type') != 'page') style="display: none;" @endif>
                                    <option value="">انتخاب صفحه</option>
                                    <optgroup label="ثابت ها">
                                        <option value="{{route('home')}}" @if(old('page_id') == route('home')) selected @endif>خانه</option>
                                        <option value="{{route('service.index')}}" @if(old('page_id') == route('service.index')) selected @endif>خدمات ها</option>
                                        <option value="{{route('project.index')}}" @if(old('page_id') == route('project.index')) selected @endif>پروژه ها</option>
                                        <option value="{{route('blog.index')}}" @if(old('page_id') == route('blog.index')) selected @endif>وبلاگ</option>
                                        <option value="{{route('faq')}}" @if(old('page_id') == route('faq')) selected @endif>سوالات متداول</option>
                                        <option value="{{route('contact.index')}}" @if(old('page_id') == route('home')) selected @endif>تماس باما</option>
                                    </optgroup>
                                    <optgroup label="صفحه ها">
                                        @foreach ($pages as $page)
                                            <option value="{{ route('page',$page->slug) }}" @if(old('page_id') == route('page',$page->slug)) selected @endif>
                                                {{ $page->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="سرویس ها">
                                        @foreach ($services as $service)
                                            <option value="{{ route('service.show',$service->id) }}" @if(old('page_id') == route('service.show',$service->id)) selected @endif>
                                                {{ $service->title }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            @error('url')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            @error('page_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
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
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
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
<script src="{{ asset('admin-assets/quill/quill.js') }}"></script>

<script>
$(document).ready(function() {
    // تغییر نمایش فیلدها بر اساس نوع لینک
    $('#urlType').on('change', function() {
        var urlType = $(this).val();

        if (urlType === 'url') {
            $('#urlInput').attr('type', 'text').show();
            $('#pageSelect').hide();
        } else {
            $('#urlInput').attr('type', 'hidden');
            $('#pageSelect').show();
            // اگر صفحه‌ای قبلاً انتخاب شده، مقدار آن را در urlInput قرار بده
            if ($('#pageSelect').val()) {
                $('#urlInput').val($('#pageSelect').val());
            }
        }
    });

    // وقتی صفحه‌ای انتخاب می‌شود
    $('#pageSelect').on('change', function() {
        var selectedPageUrl = $(this).val();
        if (selectedPageUrl) {
            // قرار دادن آدرس صفحه در فیلد url
            $('#urlInput').val(selectedPageUrl);
        }
    });

    // اجرای اولیه برای تنظیم حالت صحیح نمایش
    $('#urlType').trigger('change');

    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'font': [] }, { 'size': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'super' }, { 'script': 'sub' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }, { 'align': [] }],
                ['link', 'formula'],
                ['clean']
            ],
            formula: true,
            imageResize: {
                displaySize: true
            }
        },
    });

    // Set initial content if there's any
    @if(old('description'))
        quill.root.innerHTML = `{!! old('description') !!}`;
    @endif

    // Update hidden input before form submission
    $('form').on('submit', function() {
        $('#description').val(quill.root.innerHTML);
    });
});
</script>
@endsection
