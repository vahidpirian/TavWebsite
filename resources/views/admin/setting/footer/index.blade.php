@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات فوتر</title>
    <style>
        .setting-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
        }
        .setting-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
            padding: 20px;
            position: relative;
        }
        .card-header h5 {
            margin: 0;
            font-weight: 600;
        }
        .edit-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255,255,255,0.2);
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            color: white;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .edit-btn i {
            font-size: 14px;
        }
        .edit-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }
        .setting-section {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
        }
        .setting-section:last-child {
            border-bottom: none;
        }
        .setting-label {
            color: #6c757d;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .setting-value {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 500;
        }
        .enamad-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        .enamad-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            transition: all 0.3s;
            border: 1px solid #e9ecef;
        }
        .enamad-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-color: #dee2e6;
        }
        .enamad-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 15px;
            border-radius: 8px;
            background: white;
            padding: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .enamad-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }
        .enamad-link {
            color: #4e73df;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .enamad-link:hover {
            color: #224abe;
            text-decoration: none;
        }
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: #f8f9fa;
            border-radius: 15px;
            margin: 20px 0;
        }
        .empty-state i {
            font-size: 64px;
            color: #4e73df;
            margin-bottom: 20px;
            opacity: 0.7;
        }
        .empty-state h4 {
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .empty-state p {
            color: #6c757d;
            margin-bottom: 25px;
        }
        .create-btn {
            background: linear-gradient(45deg, #4e73df, #224abe);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .create-btn i {
            font-size: 14px;
        }
        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
            color: white;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">تنظیمات فوتر</h1>
    </section>

    <section class="row my-3">
        <section class="col-12">
            @if($settingFooter)
                <div class="setting-card">
                    <div class="card-header">
                        <h5>تنظیمات فعلی فوتر</h5>
                        <a href="{{ route('admin.setting.footer.edit') }}" class="edit-btn">
                            <i class="fas fa-edit"></i>
                            <span>ویرایش تنظیمات</span>
                        </a>
                    </div>

                    <div class="setting-section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <div class="setting-label">عنوان اینماد</div>
                                    <div class="setting-value">{{ $settingFooter->title_enamad ?? 'تعیین نشده' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <div class="setting-label">متن کپی رایت</div>
                                    <div class="setting-value">{!! $settingFooter->text_copyright ?? 'تعیین نشده' !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="setting-section">
                        <div class="setting-label">اینمادها</div>
                        @if($settingFooter->enamads && count($settingFooter->enamads) > 0)
                            <div class="enamad-grid">
                                @foreach($settingFooter->enamads as $enamad)
                                    <div class="enamad-card">
                                        @if(isset($enamad['image']) && !empty($enamad['image']))
                                            <img src="{{ asset($enamad['image']) }}" class="enamad-image" alt="{{ $enamad['title'] ?? '' }}">
                                        @endif
                                        <div class="enamad-title text-center">{{ $enamad['title'] ?? 'بدون عنوان' }}</div>
                                        @if(isset($enamad['link']) && !empty($enamad['link']))
                                            <a href="{{ $enamad['link'] }}" target="_blank" class="enamad-link">
                                                <i class="fas fa-external-link-alt"></i>
                                                <span>مشاهده لینک</span>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-image"></i>
                                <h4 class="text-center">هیچ اینمادی ثبت نشده است</h4>
                                <p class="text-center">برای افزودن اینماد جدید، روی دکمه ویرایش تنظیمات کلیک کنید</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-cog"></i>
                    <h4 class="text-center">تنظیمات فوتر هنوز ایجاد نشده است</h4>
                    <p class="text-center">برای شروع کار، تنظیمات جدید فوتر را ایجاد کنید</p>
                    <a href="{{ route('admin.setting.footer.edit') }}" class="create-btn">
                        <i class="fas fa-plus"></i>
                        <span>ایجاد تنظیمات جدید</span>
                    </a>
                </div>
            @endif
        </section>
    </section>
@endsection

@section('script')
    <script>
        // Add any necessary JavaScript here
    </script>
@endsection
