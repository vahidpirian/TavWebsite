@extends('admin.layouts.master')

@section('head-tag')
    <title>منو</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }
        .select2-selection__rendered {
            line-height: 36px !important;
        }
        .select2-selection__arrow {
            height: 36px !important;
        }
        /* استایل برای نمایش آیکون در select2 */
        .icon-select-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .icon-select-option i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">منو سرویس</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد منو
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.service-menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.service-menu.update',$menu->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">ساب کلمه بالا</label>
                                    <input type="text" name="sub_top" class="form-control form-control-sm" value="{{ old('sub_top',$menu->sub_top) }}">
                                </div>
                                @error('sub_top')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">ساب کلمه پایین</label>
                                    <input type="text" name="sub_bottom" class="form-control form-control-sm" value="{{ old('sub_bottom',$menu->sub_bottom) }}">
                                </div>
                                @error('name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="">منوی اصلی</option>
                                        @foreach ($parent_menus as $menu)
                                            <option value="{{ $menu->id }}"  @if(old('parent_id',$menu->parent_id) == $menu->id) selected @endif>{{ $menu->sub_top . ' ' . $menu->sub_bottom }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>



                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">آیکون منو</label>
                                    <select name="icon" id="iconSelect" class="form-control form-control-sm">
                                        <option value="">بدون آیکون</option>
                                        @foreach($icons as $icon)
                                            <option
                                                data-icon="{{ $icon['icon'] }}"
                                                value="{{$icon->icon}}"
                                                {{old('icon',$menu->icon) == $icon->icon ? 'selected' : ''}}
                                            >
                                                <i class="{{$icon->icon}}"></i> -  {{$icon->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نوع لینک</label>
                                    <select name="url_type" id="urlType" class="form-control form-control-sm">
                                        <option value="url" @if(old('url_type', $menu->url_type) == 'url') selected @endif>لینک مستقیم</option>
                                        <option value="page" @if(old('url_type', $menu->url_type) == 'page') selected @endif>انتخاب صفحه</option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">آدرس URL</label>
                                    <input value="{{ old('url', $menu->url) }}" name="url" class="form-control form-control-sm" id="urlInput"
                                           @if(old('url_type', $menu->url_type) == 'page') type="hidden" @else type="text" @endif>

                                    <select name="page_id" id="pageSelect" class="form-control form-control-sm"
                                            @if(old('url_type', $menu->url_type) != 'page') disabled @endif
                                            style="display: @if(old('url_type', $menu->url_type) != 'page') none @endif">
                                        <option value="">انتخاب صفحه</option>
                                        <optgroup label="ثابت ها">
                                            <option value="{{route('home')}}" @if(old('page_id', $menu->url) == route('home')) selected @endif>خانه</option>
                                            <option value="{{route('service.index')}}" @if(old('page_id', $menu->url) == route('service.index')) selected @endif>خدمات ها</option>
                                            <option value="{{route('project.index')}}" @if(old('page_id', $menu->url) == route('project.index')) selected @endif>پروژه ها</option>
                                            <option value="{{route('blog.index')}}" @if(old('page_id', $menu->url) == route('blog.index')) selected @endif>وبلاگ</option>
                                            <option value="{{route('faq')}}" @if(old('page_id', $menu->url) == route('faq')) selected @endif>سوالات متداول</option>
                                            <option value="{{route('contact.index')}}" @if(old('page_id', $menu->url) == route('contact.index')) selected @endif>تماس باما</option>
                                        </optgroup>
                                        <optgroup label="صحفه ها">
                                            @foreach ($pages as $page)
                                                <option value="{{ route('page',$page->slug) }}" @if(old('page_id', $menu->url) == route('page',$page->slug)) selected @endif>
                                                    {{ $page->title }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="سرویس ها">
                                            @foreach ($services as $service)
                                                <option value="{{ route('service.show',$service->id) }}" @if(old('page_id', $menu->url) == route('service.show',$service->id)) selected @endif>
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
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="0" @if (old('status', $menu->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if (old('status', $menu->status) == 1) selected @endif>فعال</option>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // راه‌اندازی select2
            $('#iconSelect').select2({
                placeholder: 'یک آیکون انتخاب کنید...',
                dir: 'rtl',
                language: 'fa',
                templateResult: formatIconOption,
                templateSelection: formatIconOption
            });

            // فرمت‌بندی نمایش آیکون‌ها در select2
            function formatIconOption(option) {
                if (!option.id) {
                    return option.text;
                }

                var icon = $(option.element).data('icon');
                if (!icon) {
                    return option.text;
                }

                var $option = $(
                    '<span class="icon-select-option">' +
                    '<i class="' + icon + '"></i>' +
                    '<span>' + option.text + '</span>' +
                    '</span>'
                );

                return $option;
            }


            // اجرای اولیه برای نمایش آیکون انتخاب شده
            if ($('#iconSelect').val()) {
                $('#iconSelect').trigger('change');
            }

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
        });
    </script>
@endsection
