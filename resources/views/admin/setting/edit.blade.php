@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection

@section('content')


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> تنظیمات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تنظیمات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش تنظیمات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="post"
                        enctype="multipart/form-data" id="form">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row">
                            <section class="col-12">
                                <div class="accordion" id="settingsAccordion">
                                    <!-- بخش تنظیمات عمومی -->
                                    <div class="card">
                                        <div class="card-header" id="headingGeneral">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse" data-target="#collapseGeneral">
                                                    تنظیمات عمومی سایت
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseGeneral" class="collapse show" data-parent="#settingsAccordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="name">عنوان سایت</label>
                                                            <input type="text" class="form-control form-control-sm" name="title" id="name"
                                                                value="{{ old('title', $setting->title) }}">
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
                                                            <label for="name">توضیحات سایت</label>
                                                            <input type="text" class="form-control form-control-sm" name="description" id="name"
                                                                value="{{ old('description', $setting->description) }}">
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
                                                            <label for="name">کلمات کلیدی سایت</label>
                                                            <input type="text" class="form-control form-control-sm" name="keywords" id="name"
                                                                value="{{ old('keywords', $setting->keywords) }}">
                                                        </div>
                                                        @error('keywords')
                                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- بخش لوگو و آیکون -->
                                    <div class="card">
                                        <div class="card-header" id="headingLogo">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right collapsed" type="button" data-toggle="collapse" data-target="#collapseLogo">
                                                    تنظیمات لوگو و آیکون
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseLogo" class="collapse" data-parent="#settingsAccordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <section class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="logo">لوگو</label>
                                                            <input type="file" class="form-control form-control-sm" name="logo" id="logo">
                                                            <div class="mt-2">
                                                                @if($setting->logo)
                                                                    <img src="{{ asset($setting->logo) }}" alt="لوگو" class="img-fluid" style="max-width: 100px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @error('logo')
                                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>

                                                    <section class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="logo_footer">لوگو فوتر</label>
                                                            <input type="file" class="form-control form-control-sm" name="logo_footer" id="logo_footer">
                                                            <div class="mt-2">
                                                                @if($setting->logo_footer)
                                                                    <img src="{{ asset($setting->logo_footer) }}" alt="لوگو" class="img-fluid" style="max-width: 100px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @error('logo_footer')
                                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>

                                                    <section class="col-12 col-md-6">
                                                        <div class="form-group">
                                                            <label for="icon">آیکون (favicon)</label>
                                                            <input type="file" class="form-control form-control-sm" name="icon" id="icon">
                                                            <div class="mt-2">
                                                                @if($setting->icon)
                                                                    <img src="{{ asset($setting->icon) }}" alt="آیکون" class="img-fluid" style="max-width: 32px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @error('icon')
                                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- بخش تنظیمات صفحه اصلی -->
                                    <div class="card">
                                        <div class="card-header" id="headingMainPage">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right collapsed" type="button" data-toggle="collapse" data-target="#collapseMainPage">
                                                    تنظیمات صفحه اصلی
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseMainPage" class="collapse" data-parent="#settingsAccordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="main_page_subtitle">عنوان فرعی در صحفه اصلی</label>
                                                            <input type="text" class="form-control form-control-sm" name="main_page_subtitle" id="main_page_subtitle"
                                                                   value="{{ old('main_page_subtitle', $setting->main_page_subtitle) }}">
                                                        </div>
                                                        @error('main_page_subtitle')
                                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>

                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="main_page_title">عنوان در صحفه اصلی</label>
                                                            <input type="text" class="form-control form-control-sm" name="main_page_title" id="main_page_title"
                                                                   value="{{ old('main_page_title', $setting->main_page_title) }}">
                                                        </div>
                                                        @error('main_page_title')
                                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>

                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="main_page_service_summary">خلاصه خدمات در صحفه اصلی</label>
                                                            <input type="text" class="form-control form-control-sm" name="main_page_service_summary" id="main_page_service_summary"
                                                                   value="{{ old('main_page_service_summary', $setting->main_page_service_summary) }}">
                                                        </div>
                                                        @error('main_page_service_summary')
                                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                                <strong>
                                                                    {{ $message }}
                                                                </strong>
                                                            </span>
                                                        @enderror
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- بخش اطلاعات تماس -->
                                    <div class="card">
                                        <div class="card-header" id="headingContact">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right collapsed" type="button" data-toggle="collapse" data-target="#collapseContact">
                                                    اطلاعات تماس
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseContact" class="collapse" data-parent="#settingsAccordion">
                                            <div class="card-body">
                                                <div class="row">
                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="address">آدرس</label>
                                                            <input type="text" class="form-control form-control-sm" name="address" id="address"
                                                                value="{{ old('address', $setting->address) }}">
                                                        </div>
                                                    </section>

                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="mobile">شماره تماس</label>
                                                            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile"
                                                                value="{{ old('mobile', $setting->mobile) }}">
                                                        </div>
                                                    </section>

                                                    <section class="col-12">
                                                        <div class="form-group">
                                                            <label for="mobile">ایمیل</label>
                                                            <input type="text" class="form-control form-control-sm" name="email" id="email"
                                                                   value="{{ old('email', $setting->email) }}">
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- بخش شبکه‌های اجتماعی -->
                                    <div class="card">
                                        <div class="card-header" id="headingSocial">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right collapsed" type="button" data-toggle="collapse" data-target="#collapseSocial">
                                                    شبکه‌های اجتماعی
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseSocial" class="collapse" data-parent="#settingsAccordion">
                                            <div class="card-body">
                                                <div id="social-inputs">
                                                    @if(isset($setting->socials))
                                                        @foreach($setting->socials as $key => $social)
                                                            <div class="row social-item">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>نام شبکه</label>
                                                                        <input type="text" class="form-control" name="socials[{{$key}}][name]" value="{{ $social['name'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>آیکون</label>
                                                                        <select class="form-control" name="socials[{{$key}}][icon]">
                                                                            <option value="">انتخاب آیکون</option>
                                                                            <optgroup label="شبکه‌های اجتماعی">
                                                                                <option value="fab fa-instagram" {{ isset($social['icon']) && $social['icon'] == 'fab fa-instagram' ? 'selected' : '' }}>اینستاگرام</option>
                                                                                <option value="fab fa-telegram" {{ isset($social['icon']) && $social['icon'] == 'fab fa-telegram' ? 'selected' : '' }}>تلگرام</option>
                                                                                <option value="fab fa-whatsapp" {{ isset($social['icon']) && $social['icon'] == 'fab fa-whatsapp' ? 'selected' : '' }}>واتساپ</option>
                                                                                <option value="fab fa-twitter" {{ isset($social['icon']) && $social['icon'] == 'fab fa-twitter' ? 'selected' : '' }}>توییتر</option>
                                                                                <option value="fab fa-facebook" {{ isset($social['icon']) && $social['icon'] == 'fab fa-facebook' ? 'selected' : '' }}>فیسبوک</option>
                                                                                <option value="fab fa-linkedin" {{ isset($social['icon']) && $social['icon'] == 'fab fa-linkedin' ? 'selected' : '' }}>لینکدین</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>لینک</label>
                                                                        <input type="text" class="form-control" name="socials[{{$key}}][link]" value="{{ $social['link'] ?? '' }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>وضعیت</label>
                                                                        <select class="form-control" name="socials[{{$key}}][status]">
                                                                            <option value="1" {{ isset($social['status']) && $social['status'] == 1 ? 'selected' : '' }}>فعال</option>
                                                                            <option value="0" {{ isset($social['status']) && $social['status'] == 0 ? 'selected' : '' }}>غیرفعال</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-success btn-sm" id="add-social">افزودن شبکه اجتماعی</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </section>

                        <section class="col-12 my-3">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </form>
                    </section>
                </section>

            </section>
        </section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let socialCounter = {{ isset($setting->socials) ? count($setting->socials) : 0 }};

        $('#add-social').click(function() {
            let newSocial = `
            <div class="row social-item">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>نام شبکه</label>
                        <input type="text" class="form-control" name="socials[${socialCounter}][name]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>آیکون</label>
                        <select class="form-control" name="socials[${socialCounter}][icon]">
                            <option value="">انتخاب آیکون</option>
                            <optgroup label="شبکه‌های اجتماعی">
                                <option value="fab fa-instagram">اینستاگرام</option>
                                <option value="fab fa-telegram">تلگرام</option>
                                <option value="fab fa-whatsapp">واتساپ</option>
                                <option value="fab fa-twitter">توییتر</option>
                                <option value="fab fa-facebook">فیسیبوک</option>
                                <option value="fab fa-linkedin">لینکدین</option>
                            </optgroup>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>لینک</label>
                        <input type="text" class="form-control" name="socials[${socialCounter}][link]">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>وضعیت</label>
                        <select class="form-control" name="socials[${socialCounter}][status]">
                            <option value="1">فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                </div>
            </div>
        `;
            $('#social-inputs').append(newSocial);
            socialCounter++;
        });
    });
</script>
@endsection
