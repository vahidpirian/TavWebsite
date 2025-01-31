@extends('site.layouts.my-account')

@section('account-content')
<div class="p-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0">
            <i class="fas fa-ticket-alt text-primary me-2"></i>
            تیکت‌های پشتیبانی
        </h4>
        <a href="{{ route('account.tickets.create') }}" class="create-ticket-btn">
            <i class="fas fa-plus"></i>
            ارسال تیکت جدید
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="ticket-filters">
                <div class="btn-group" role="group">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}"
                       class="btn {{ !request('status') || request('status') == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                        همه تیکت‌ها
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'open']) }}"
                       class="btn {{ request('status') == 'open' ? 'btn-primary' : 'btn-outline-primary' }}">
                        تیکت‌های باز
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'closed']) }}"
                       class="btn {{ request('status') == 'closed' ? 'btn-primary' : 'btn-outline-primary' }}">
                        تیکت‌های بسته
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($tickets->count() > 0)
        <div class="table-responsive">
            <table class="table ticket-table">
                <thead>
                    <tr>
                        <th>شماره تیکت</th>
                        <th>موضوع</th>
                        <th>دسته‌بندی</th>
                        <th>اولویت</th>
                        <th>وضعیت</th>
                        <th>آخرین بروزرسانی</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>
                                <span class="text-muted">#{{ $ticket->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($ticket->file)
                                        <i class="fas fa-paperclip text-muted me-2" title="دارای فایل پیوست"></i>
                                    @endif
                                    {{ $ticket->subject }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $ticket->category->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $ticket->priority->color ?? 'secondary' }}">
                                    {{ $ticket->priority->name }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge {{ $ticket->status == 0 ? 'status-open' : 'status-closed' }}">
                                    <i class="fas {{ $ticket->status == 'open' ? 'fa-clock' : 'fa-check' }}"></i>
                                    {{ $ticket->status == 0 ? 'باز' : 'بسته' }}
                                </span>
                            </td>
                            <td>
                                <span class="ticket-date">
                                    <i class="far fa-clock"></i>
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->updated_at)->ago() }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('account.tickets.show', $ticket->id) }}"
                                       class="action-btn view-btn">
                                        <i class="fas fa-eye"></i>
                                        <span>مشاهده</span>
                                    </a>
                                    @if($ticket->status == 0)
                                        <form action="{{ route('account.tickets.close', $ticket->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="action-btn close-btn"
                                                    onclick="return confirm('آیا از بستن این تیکت اطمینان دارید؟')">
                                                <i class="fas fa-lock"></i>
                                                <span>بستن</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-ticket-alt"></i>
            <p>هیچ تیکتی یافت نشد</p>
            <a href="{{ route('account.tickets.create') }}" class="create-ticket-btn">
                <i class="fas fa-plus"></i>
                ارسال تیکت جدید
            </a>
        </div>
    @endif
</div>
@endsection
@section('styles')
<title>حساب کاربری - تیکت ها</title>
<style>
    .ticket-filters {
        margin-bottom: 1.5rem;
    }

    .ticket-filters .btn-group {
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border-radius: 15px;
        overflow: hidden;
    }

    .ticket-filters .btn {
        padding: 0.5rem 1.5rem;
        border: none;
    }

    .badge {
        padding: 0.5em 1em;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .create-ticket-btn {
        background: linear-gradient(45deg, #00b09b, #96c93d);
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 15px;
        color: white;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 176, 155, 0.2);
    }

    .create-ticket-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 176, 155, 0.3);
        color: white;
    }

    .create-ticket-btn i {
        background: rgba(255, 255, 255, 0.2);
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    /* اصلاح استایل دکمه در empty state */
    .empty-state .create-ticket-btn {
        margin-top: 1.5rem;
        padding: 1rem 2rem;
    }

    /* Action Buttons Styles */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        background: transparent;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .action-btn i {
        font-size: 0.9rem;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .view-btn {
        color: #0dcaf0;
        background-color: rgba(13, 202, 240, 0.1);
    }

    .view-btn:hover {
        background-color: rgba(13, 202, 240, 0.2);
        color: #0dcaf0;
    }

    .view-btn i {
        background-color: rgba(13, 202, 240, 0.2);
    }

    .close-btn {
        color: #ffc107;
        background-color: rgba(255, 193, 7, 0.1);
    }

    .close-btn:hover {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .close-btn i {
        background-color: rgba(255, 193, 7, 0.2);
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .action-btn span {
            display: none;
        }

        .action-btn {
            padding: 0.5rem;
        }

        .action-btn i {
            margin: 0;
            font-size: 1rem;
        }

        .action-buttons {
            gap: 4px;
        }
    }
</style>
@endsection
