@extends('admin.layouts.master')

@section('head-tag')
    <title>داشبورد مدیریت</title>
    <style>
        .stat-card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .gradient-purple {
            background: linear-gradient(45deg, #6b46c1 0%, #9f7aea 100%);
        }

        .gradient-blue {
            background: linear-gradient(45deg, #2c5282 0%, #4299e1 100%);
        }

        .gradient-green {
            background: linear-gradient(45deg, #276749 0%, #48bb78 100%);
        }

        .gradient-orange {
            background: linear-gradient(45deg, #c05621 0%, #ed8936 100%);
        }

        .activity-timeline {
            position: relative;
            padding-left: 30px;
        }

        .activity-timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -34px;
            top: 0;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #4a5568;
            border: 2px solid #fff;
        }

        .data-card {
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .progress-thin {
            height: 4px;
        }
        /* اضافه کردن به بخش style در head-tag */
        .video-card {
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .video-card:hover {
            transform: translateY(-5px);
        }

        .video-thumbnail {
            background-color: #f8f9fa;
        }

        .play-button {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .video-card:hover .play-button {
            transform: translate(-50%, -50%) scale(1.2);
            opacity: 1 !important;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* برای نمایش بهتر آیکون پخش روی تصویر */
        .video-thumbnail::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-card:hover .video-thumbnail::after {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <!-- آمار کلی -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ number_format($data['total_users']) }}</h3>
                            <p class="text-muted mb-0">کاربران</p>
                            <div class="mt-3">
                            <span class="text-success">
                                <i class="fas fa-arrow-up me-1"></i>
                                {{ $data['new_users_today'] }} امروز
                            </span>
                            </div>
                        </div>
                        <div class="stat-icon gradient-purple text-white">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ number_format($data['total_posts']) }}</h3>
                            <p class="text-muted mb-0">مقالات</p>
                            <div class="mt-3">
                            <span class="text-primary">
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $data['active_posts'] }} فعال
                            </span>
                            </div>
                        </div>
                        <div class="stat-icon gradient-blue text-white">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ number_format($data['total_tickets']) }}</h3>
                            <p class="text-muted mb-0">تیکت‌ها</p>
                            <div class="mt-3">
                            <span class="text-warning">
                                <i class="fas fa-clock me-1"></i>
                                {{ $data['new_tickets'] }} جدید
                            </span>
                            </div>
                        </div>
                        <div class="stat-icon gradient-green text-white">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 fw-bold">{{ number_format($data['total_comments']) }}</h3>
                            <p class="text-muted mb-0">نظرات</p>
                            <div class="mt-3">
                            <span class="text-danger">
                                <i class="fas fa-comment-dots me-1"></i>
                                {{ $data['pending_comments'] }} در انتظار
                            </span>
                            </div>
                        </div>
                        <div class="stat-icon gradient-orange text-white">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="row mb-5">--}}
{{--            <div class="col-12">--}}
{{--                <div class="data-card p-4">--}}
{{--                    <div class="d-flex justify-content-between align-items-center mb-4">--}}
{{--                        <h5 class="mb-0">--}}
{{--                            <i class="fas fa-video me-2 text-primary"></i>--}}
{{--                            مدیریت ویدیوها--}}
{{--                        </h5>--}}
{{--                        <div class="d-flex align-items-center gap-3">--}}
{{--                            <span class="badge bg-primary">{{ $data['total_videos'] }} ویدیو</span>--}}
{{--                            <a href="#" class="btn btn-sm btn-outline-primary">مدیریت ویدیوها</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-hover align-middle">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>عنوان</th>--}}
{{--                                <th>نوع</th>--}}
{{--                                <th>موقعیت</th>--}}
{{--                                <th>وضعیت</th>--}}
{{--                                <th>تاریخ ایجاد</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($data['recent_videos'] ?? [] as $video)--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="video-icon me-3">--}}
{{--                                                <i class="fas fa-{{ $video->type == 'upload' ? 'file-video' : 'link' }}--}}
{{--                                           fs-4 text-{{ $video->type == 'upload' ? 'info' : 'primary' }}">--}}
{{--                                                </i>--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                                <h6 class="mb-0">{{ $video->title }}</h6>--}}
{{--                                                <small class="text-muted">--}}
{{--                                                    {{ Str::limit($video->type == 'upload' ? $video->video : $video->url_video, 30) }}--}}
{{--                                                </small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                <span class="badge bg-{{ $video->type == 'upload' ? 'info' : 'primary' }}">--}}
{{--                                    {{ $video->type == 'upload' ? 'آپلود مستقیم' : 'لینک خارجی' }}--}}
{{--                                </span>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                <span class="badge bg-secondary">--}}
{{--                                    موقعیت {{ $video->position }}--}}
{{--                                </span>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="form-check form-switch">--}}
{{--                                            <input class="form-check-input" type="checkbox"--}}
{{--                                                   {{ $video->status == 1 ? 'checked' : '' }} disabled>--}}
{{--                                            <label class="form-check-label text-{{ $video->status == 1 ? 'success' : 'danger' }}">--}}
{{--                                                {{ $video->statusPersian }}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <small class="text-muted">--}}
{{--                                            {{ \Morilog\Jalali\Jalalian::fromDateTime($video->created_at)->format('Y/m/d H:i') }}--}}
{{--                                        </small>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- بخش اصلی -->
        <div class="row">
            <!-- ستون سمت راست -->
            <div class="col-xl-8 mb-4">
                <div class="data-card p-4">
                    <h5 class="mb-4">آخرین فعالیت‌ها</h5>
                    <div class="activity-timeline">
                        @foreach($data['recent_posts'] as $post)
                            <div class="timeline-item">
                                <h6 class="mb-1">{{ $post->title }}</h6>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($post->created_at)->ago() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="data-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">آخرین پروژه‌ها</h5>
{{--                        <a href="#" class="btn btn-sm btn-outline-primary">مشاهده همه</a>--}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>نام پروژه</th>
                                <th>وضعیت</th>
                                <th>پیشرفت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['recent_projects'] as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>
                                    <span class="badge bg-{{ $project->status == 1 ? 'success' : 'warning' }}">
                                        {{ $project->status_persian }}
                                    </span>
                                    </td>
                                    <td>
                                        <div class="progress progress-thin">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ستون سمت چپ -->
            <div class="col-xl-4">
                <div class="data-card p-4 mb-4">
                    <h5 class="mb-4">آخرین تیکت‌ها</h5>
                    @foreach($data['recent_tickets'] as $ticket)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm bg-light rounded-circle p-2">
                                    <i class="fas fa-ticket-alt text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">{{ Str::limit($ticket->subject, 30) }}</h6>
                                <p class="text-muted small mb-0">{{ $ticket->user->full_name }}</p>
                            </div>
                            <span class="badge bg-{{ $ticket->status == 'open' ? 'success' : 'warning' }}">
                        {{ $ticket->status == 'open' ? 'باز' : 'بسته' }}
                    </span>
                        </div>
                    @endforeach
                </div>

                <div class="data-card p-4">
                    <h5 class="mb-4">آخرین نظرات</h5>
                    @foreach($data['recent_comments'] as $comment)
                        <div class="d-flex align-items-start mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm bg-light rounded-circle p-2">
                                    <i class="fas fa-comment text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1">{{ Str::limit($comment->body, 50) }}</p>
                                <span class="text-muted small mb-0">
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($comment->created_at)->ago() }}
                                </span>
                                -
                                <span>
                                    {{ $comment->user->full_name ?? $comment->author_name }}
                                </span>


                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
