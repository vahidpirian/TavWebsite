@extends('admin.layouts.master')

@section('head-tag')
<title>تنظیمات</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> تنظیمات</li>
    </ol>
  </nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تنظیمات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.setting.edit', $setting->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> ویرایش تنظیمات
                </a>
            </section>

            <section class="row mt-4">
                <section class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="border p-3 h-100">
                                        <h6 class="text-muted mb-3">تنظیمات عمومی سایت</h6>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">عنوان سایت:</label>
                                            <p>{{ $setting->title }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">توضیحات سایت:</label>
                                            <p>{{ $setting->description }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">کلمات کلیدی:</label>
                                            <p>{{ $setting->keywords }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="border p-3 h-100">
                                        <h6 class="text-muted mb-3">تنظیمات صفحه اصلی</h6>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">عنوان اصلی:</label>
                                            <p>{{ $setting->main_page_title }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">عنوان فرعی:</label>
                                            <p>{{ $setting->main_page_subtitle }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">خلاصه خدمات:</label>
                                            <p>{{ $setting->main_page_service_summary }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="border p-3 h-100">
                                        <h6 class="text-muted mb-3">لوگو و آیکون</h6>
                                        <div class="mb-3">
                                            <label class="font-weight-bold">لوگو سایت:</label>
                                            <div class="mt-2">
                                                @if(!is_null($setting->logo))
                                                    <img src="{{ asset($setting->logo) }}" alt="لوگو سایت" class="img-fluid" style="max-height: 100px">
                                                @else
                                                    <span class="badge badge-info">تصویر لوگو موجود نیست</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">آیکون سایت:</label>
                                            <div class="mt-2">
                                                @if($setting->icon)
                                                    <img src="{{ asset($setting->icon) }}" alt="آیکون سایت" class="img-fluid" style="max-height: 100px">
                                                @else
                                                    <span class="badge badge-info">تصویر آیکون موجود نیست</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="border p-3 h-100">
                                        <h6 class="text-muted mb-3">اطلاعات تماس</h6>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">آدرس:</label>
                                            <p>{{ $setting->address }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">شماره تماس:</label>
                                            <p>{{ $setting->mobile }}</p>
                                        </div>
                                        <div class="mb-2">
                                            <label class="font-weight-bold">ایمیل:</label>
                                            <p>{{ $setting->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="border p-3 h-100">
                                        <h6 class="text-muted mb-3">شبکه‌های اجتماعی</h6>
                                        @if(isset($setting->socials) && count($setting->socials) > 0)
                                            @foreach($setting->socials as $social)
                                                <div class="mb-2">
                                                    <i class="{{ $social['icon'] }}"></i>
                                                    <span class="mr-2">{{ $social['name'] }}</span>
                                                    <span class="badge {{ $social['status'] ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $social['status'] ? 'فعال' : 'غیرفعال' }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">هیچ شبکه اجتماعی تعریف نشده است.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>

        </section>
    </section>
</section>

@endsection
