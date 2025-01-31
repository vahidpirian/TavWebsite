@extends('site.layouts.my-account')

@section('account-content')
<div class="p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ route('account.tickets.index') }}" class="btn btn-link p-0 me-3">
                <i class="fas fa-arrow-right"></i>
            </a>
            <h4 class="mb-0">
                <i class="fas fa-ticket-alt text-primary me-2"></i>
                تیکت #{{ $ticket->id }}
            </h4>
        </div>
        @if($ticket->status == 0)
            <form action="{{ route('account.tickets.close', $ticket->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-outline-warning" onclick="return confirm('آیا از بستن این تیکت اطمینان دارید؟')">
                    <i class="fas fa-lock me-2"></i>
                    بستن تیکت
                </button>
            </form>
        @endif
    </div>

    <div class="ticket-details mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-title mb-3">{{ $ticket->subject }}</h5>
                        <div class="ticket-meta">
                            <span class="me-3">
                                <i class="fas fa-user text-muted me-1"></i>
                                {{ $ticket->user->full_name }}
                            </span>
                            <span class="me-3">
                                <i class="fas fa-calendar text-muted me-1"></i>
                                {{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d H:i') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="badge bg-{{ $ticket->priority->color ?? 'secondary' }} me-2">
                            {{ $ticket->priority->name }}
                        </span>
                        <span class="badge bg-info me-2">
                            {{ $ticket->category->name }}
                        </span>
                        <span class="status-badge {{ $ticket->status == 0 ? 'status-open' : 'status-closed' }}">
                            <i class="fas {{ $ticket->status == 0 ? 'fa-clock' : 'fa-check' }}"></i>
                            {{ $ticket->status == 0 ? 'باز' : 'بسته' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ticket-messages">
        <div class="message main-message">
            <div class="message-header">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="message-info">
                    <h6>{{ $ticket->user->full_name }}</h6>
                    <small>
                        <i class="far fa-clock"></i>
                        {{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->ago() }}
                    </small>
                </div>
            </div>
            <div class="message-content">
                {!! nl2br(e($ticket->description)) !!}
            </div>
            @if($ticket->file)
                <div class="message-attachment">
                    <a href="{{ asset($ticket->file->file_path) }}" class="attachment-link" target="_blank">
                        <i class="fas fa-paperclip me-2"></i>
                        دانلود فایل پیوست
                        <small class="ms-2">({{ round($ticket->file->file_size / 1024) }} KB)</small>
                    </a>
                </div>
            @endif
        </div>

        @foreach($ticket->children as $reply)
            <div class="message {{ $reply->is_admin == 0 ? 'user-message' : 'admin-message' }}">
                <div class="message-header">
                    <div class="user-avatar">
                        <i class="fas {{ $reply->is_admin == 0 ? 'fa-user' : 'fa-headset' }}"></i>
                    </div>
                    <div class="message-info">
                        <h6> {{ $reply->is_admin == 0 ? $reply->user->full_name : $reply->admin->user->full_name }}</h6>
                        <small>
                            <i class="far fa-clock"></i>
                            {{ \Morilog\Jalali\Jalalian::fromDateTime($reply->created_at)->ago() }}
                        </small>
                    </div>
                </div>
                <div class="message-content">
                    {!! nl2br(e($reply->description)) !!}
                </div>
                @if($reply->file)
                    <div class="message-attachment">
                        <a href="{{ asset($reply->file->file_path) }}" class="attachment-link" target="_blank">
                            <i class="fas fa-paperclip me-2"></i>
                            دانلود فایل پیوست
                            <small class="ms-2">({{ round($reply->file->file_size / 1024) }} KB)</small>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @if($ticket->status == 0)
        <div class="reply-form mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">ارسال پاسخ</h5>
                    <form action="{{ route('account.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <textarea name="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="پاسخ خود را بنویسید...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-file-upload">
                                <input type="file" name="file" id="reply-file" class="file-input @error('file') is-invalid @enderror">
                                <label for="reply-file" class="file-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span class="file-name">انتخاب فایل</span>
                                </label>
                                <small class="form-text text-muted">
                                    حداکثر حجم فایل: 5 مگابایت | فرمت‌های مجاز: pdf, jpg, png, zip
                                </small>
                            </div>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>
                            ارسال پاسخ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="ticket-closed-message mt-4">
            <div class="alert alert-warning mb-0">
                <i class="fas fa-lock me-2"></i>
                این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.
            </div>
        </div>
    @endif
</div>
@endsection

@section('styles')
<title>حساب کاربری - مشاهده تیکت</title>
<style>
    .ticket-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .ticket-messages {
        position: relative;
        padding-left: 50px;
    }

    .ticket-messages::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 60px;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
        border-radius: 2px;
    }

    .message {
        position: relative;
        background: #fff;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .message:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .message.main-message {
        background: linear-gradient(45deg, #4776E6, #8E54E9);
        color: white;
        margin-left: -50px;
        margin-bottom: 3rem;
    }

    .message.main-message .message-content,
    .message.main-message .message-info h6,
    .message.main-message .message-info small {
        color: white !important;
    }

    .message.admin-message {
        background: #f8f9fa;
        margin-left: 2rem;
        border-right: 4px solid #0dcaf0;
    }

    .message.user-message {
        margin-right: 2rem;
        border-left: 4px solid #4776E6;
    }

    .message-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .main-message .message-header {
        border-bottom-color: rgba(255,255,255,0.2);
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: #e9ecef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: #6c757d;
        font-size: 1.2rem;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .main-message .user-avatar {
        background: rgba(255,255,255,0.2);
        color: white;
        border-color: rgba(255,255,255,0.3);
    }

    .admin-message .user-avatar {
        background: #cff4fc;
        color: #055160;
        border-color: #0dcaf0;
    }

    .message-info h6 {
        font-size: 1rem;
        margin-bottom: 0.2rem;
        color: #444;
    }

    .message-info small {
        color: #6c757d;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .message-content {
        line-height: 1.8;
        color: #444;
        font-size: 0.95rem;
    }

    .message-attachment {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0,0,0,0.1);
    }

    .main-message .message-attachment {
        border-top-color: rgba(255,255,255,0.2);
    }

    .attachment-link {
        display: inline-flex;
        align-items: center;
        padding: 0.7rem 1.2rem;
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        color: inherit;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .main-message .attachment-link {
        background: rgba(255,255,255,0.2);
        color: white;
    }

    .attachment-link:hover {
        background: rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    .main-message .attachment-link:hover {
        background: rgba(255,255,255,0.3);
    }

    .attachment-link i {
        font-size: 1.2rem;
    }

    .reply-form {
        position: relative;
        margin-top: 3rem;
        padding-top: 2rem;
    }

    .reply-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 20px;
        right: 20px;
        height: 1px;
        background: #dee2e6;
    }

    .ticket-closed-message {
        text-align: center;
        padding: 2rem;
        background: #fff3cd;
        border-radius: 15px;
        color: #856404;
    }

    .ticket-closed-message i {
        font-size: 2rem;
        margin-bottom: 1rem;
        display: block;
    }
</style>
@endsection

@section('scripts')
<script>
    // نمایش نام فایل انتخاب شده در فرم پاسخ
    document.querySelector('#reply-file')?.addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'انتخاب فایل';
        this.closest('.custom-file-upload').querySelector('.file-name').textContent = fileName;
    });
</script>
@endsection
