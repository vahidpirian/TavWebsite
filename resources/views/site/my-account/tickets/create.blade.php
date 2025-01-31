@extends('site.layouts.my-account')

@section('account-content')
<div class="p-4">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('account.tickets.index') }}" class="btn btn-link p-0 me-3">
            <i class="fas fa-arrow-right"></i>
        </a>
        <h4 class="mb-0">
            <i class="fas fa-plus-circle text-success me-2"></i>
            ارسال تیکت جدید
        </h4>
    </div>

    <form action="{{ route('account.tickets.store') }}" method="POST" enctype="multipart/form-data" class="ticket-form">
        @csrf
        <div class="row">
            <div class="col-12 mb-4">
                <div class="form-group">
                    <label class="form-label required">موضوع تیکت</label>
                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror"
                           value="{{ old('subject') }}" placeholder="موضوع تیکت را وارد کنید...">
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label required">دسته‌بندی</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">انتخاب دسته‌بندی</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label class="form-label required">اولویت</label>
                    <select name="priority_id" class="form-select @error('priority_id') is-invalid @enderror">
                        <option value="">انتخاب اولویت</option>
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                {{ $priority->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('priority_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="form-group">
                    <label class="form-label required">متن پیام</label>
                    <textarea name="description" rows="6"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="متن پیام خود را وارد کنید...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 mb-4">
                <div class="form-group">
                    <label class="form-label">فایل پیوست</label>
                    <div class="custom-file-upload">
                        <input type="file" name="file" id="file" class="file-input @error('file') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png,.zip">
                        <label for="file" class="file-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="file-name">انتخاب فایل یا رها کردن فایل در این محل</span>
                        </label>
                        <small class="form-text text-muted">
                            حداکثر حجم فایل: 5 مگابایت | فرمت‌های مجاز: pdf, jpg, png, zip
                        </small>
                        @error('file')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>
                    ارسال تیکت
                </button>
                <a href="{{ route('account.tickets.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-times me-2"></i>
                    انصراف
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
<title>حساب کاربری - ایجاد تیکت</title>
<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #444;
    }

    .form-label.required::after {
        content: '*';
        color: #dc3545;
        margin-right: 4px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        border: 1px solid rgba(0,0,0,0.1);
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4776E6;
        box-shadow: 0 0 0 0.2rem rgba(71, 118, 230, 0.1);
    }

    .custom-file-upload {
        position: relative;
        width: 100%;
        margin-top: 0.5rem;
    }

    .file-input {
        opacity: 0;
        position: absolute;
        width: 0;
        height: 0;
    }

    .file-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 1rem 1.5rem;
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
        min-height: 60px;
    }

    .file-label:hover {
        background: #e9ecef;
        border-color: #4776E6;
    }

    .file-label i {
        font-size: 1.5rem;
        color: #6c757d;
        flex-shrink: 0;
    }

    .file-name {
        color: #6c757d;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .form-text {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.875rem;
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }

    .btn {
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-primary {
        background: linear-gradient(45deg, #4776E6, #8E54E9);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #3d66cc, #7e4bd3);
    }

    /* Drag & Drop States */
    .file-label.dragover {
        background: rgba(71, 118, 230, 0.1);
        border-color: #4776E6;
    }
</style>
@endsection

@section('scripts')
<script>
    // File Upload Handler
    const fileInput = document.querySelector('.file-input');
    const fileLabel = document.querySelector('.file-label');
    const fileName = document.querySelector('.file-name');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        updateFileName(file);
    });

    // Drag and Drop Support
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileLabel.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileLabel.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileLabel.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        fileLabel.classList.add('dragover');
    }

    function unhighlight(e) {
        fileLabel.classList.remove('dragover');
    }

    fileLabel.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const file = dt.files[0];

        fileInput.files = dt.files;
        updateFileName(file);
    }

    function updateFileName(file) {
        if (file) {
            fileName.textContent = file.name;

            // اضافه کردن کلاس برای نمایش فایل انتخاب شده
            fileLabel.classList.add('has-file');
        } else {
            fileName.textContent = 'انتخاب فایل';
            fileLabel.classList.remove('has-file');
        }
    }
</script>
@endsection
