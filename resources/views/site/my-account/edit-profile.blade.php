@extends('site.layouts.my-account')
@section('styles')
    <title>حساب کاربری - ویرایش اطلاعات کاربری</title>
@endsection
@section('account-content')
<div class="p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">
            <i class="fas fa-user-edit text-primary me-2"></i>
            ویرایش اطلاعات کاربری
        </h4>
    </div>

    <form action="{{ route('account.profile.update') }}" method="POST" class="row">
        @csrf
        @method('PUT')

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">نام</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                       value="{{ old('first_name', $user->first_name) }}">
                @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">نام خانوادگی</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                       value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">شماره موبایل</label>
                <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                       value="{{ old('mobile', $user->mobile) }}" readonly>
                @error('mobile')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">ایمیل</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">کد ملی</label>
                <input type="text" name="national_code" class="form-control @error('national_code') is-invalid @enderror"
                       value="{{ old('national_code', $user->national_code) }}">
                @error('national_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <hr class="my-4">
            <h5 class="mb-3">تغییر رمز عبور</h5>
            <p class="text-muted small mb-3">در صورتی که قصد تغییر رمز عبور را ندارید، فیلدهای زیر را خالی بگذارید.</p>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">رمز عبور جدید</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label class="form-label">تکرار رمز عبور جدید</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" class="form-control">
                    <button class="btn btn-outline-secondary toggle-password" type="button">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>
                ذخیره تغییرات
            </button>
            <a href="{{ route('account.dashboard') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-times me-2"></i>
                انصراف
            </a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection
