@extends('site.layouts.my-account')
@section('styles')
    <title>حساب کاربری - داشبورد</title>
@endsection
@section('account-content')
<div class="p-4">
    <div class="row mb-5">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="dashboard-card stat-card primary-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h5 class="card-title mb-0 text-white">تیکت‌های باز</h5>
                    </div>
                    <h2 class="stat-number mb-2">{{ $openTickets }}</h2>
                    <p class="text-white-50 mb-0">تیکت در انتظار پاسخ</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="dashboard-card stat-card success-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="card-title mb-0 text-white">تیکت‌های بسته</h5>
                    </div>
                    <h2 class="stat-number mb-2">{{ $closedTickets }}</h2>
                    <p class="text-white-50 mb-0">تیکت حل شده</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="dashboard-card stat-card info-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h5 class="card-title mb-0 text-white">کل تیکت‌ها</h5>
                    </div>
                    <h2 class="stat-number mb-2">{{ $openTickets + $closedTickets }}</h2>
                    <p class="text-white-50 mb-0">مجموع تیکت‌ها</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list-alt text-primary me-2"></i>
                            <h5 class="mb-0">آخرین تیکت‌ها</h5>
                        </div>
                        <a href="{{ route('account.tickets.index') }}" class="btn btn-primary action-btn">
                            <i class="fas fa-eye me-1"></i>
                            مشاهده همه
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($latestTickets->count() > 0)
                        <div class="table-responsive">
                            <table class="table ticket-table">
                                <thead>
                                    <tr>
                                        <th class="px-4">عنوان تیکت</th>
                                        <th>وضعیت</th>
                                        <th>تاریخ ثبت</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestTickets as $ticket)
                                        <tr>
                                            <td class="px-4">
                                                <div class="fw-500">{{ $ticket->subject }}</div>
                                            </td>
                                            <td>
                                                <span class="status-badge {{ $ticket->status == 0 ? 'status-open' : 'status-closed' }}">
                                                    <i class="fas {{ $ticket->status == 'open' ? 'fa-clock' : 'fa-check' }}"></i>
                                                    {{ $ticket->status == 0 ? 'باز' : 'بسته' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="ticket-date">
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d H:i') }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('account.tickets.show', $ticket->id) }}"
                                                   class="action-btn btn-view">
                                                    <i class="fas fa-eye"></i>
                                                    مشاهده
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-ticket-alt"></i>
                            <p>در حال حاضر هیچ تیکتی ثبت نشده است</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
