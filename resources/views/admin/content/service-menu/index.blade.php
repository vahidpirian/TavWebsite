@extends('admin.layouts.master')

@section('head-tag')
<title>منو سرویس</title>
<script src="{{asset('admin-assets/js/Sortable.min.js')}}"></script>
<style>
    .menu-table {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .menu-table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding: 1rem;
        font-weight: 600;
        color: #495057;
        white-space: nowrap;
    }
    .menu-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }
    .menu-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    .menu-actions .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    .menu-actions .btn:hover {
        transform: translateY(-2px);
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        border-radius: 50rem;
    }
    .parent-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
        border-radius: 50rem;
    }
</style>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page"> منو سرویس</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    <i class="fas fa-list"></i> منوهای سرویس
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.content.service-menu.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> ایجاد منوی جدید
                    </a>
                </div>
            </section>

            <section class="table-responsive">
                <table class="table menu-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ساب کلمه بالا</th>
                            <th>ساب کلمه پایین</th>
                            <th>منوی والد</th>
                            <th>لینک منو</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-table">
                        @foreach($menus as $key => $menu)
                        <tr data-id="{{ $menu->id }}">
                            <th>{{ $key + 1 }}</th>
                            <td>
                                <div class="menu-hierarchy">
                                    {{ $menu->sub_top }}
                                </div>
                            </td>
                            <td>{{ $menu->sub_bottom }}</td>
                            <td>
                                @if($menu->parent_id)
                                    <span class="badge bg-info text-white parent-badge">
                                        <i class="fas fa-level-up-alt"></i> {{ $menu->parent->full_name }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white parent-badge">منوی اصلی</span>
                                @endif
                            </td>
                            <td class="menu-url" title="{{ $menu->url }}">
                                <i class="fas fa-link text-muted"></i> {{ $menu->url }}
                            </td>
                            <td>
                                <label>
                                    <input id="{{ $menu->id }}" onchange="changeStatus({{ $menu->id }})" data-url="{{ route('admin.content.service-menu.status', $menu->id) }}" type="checkbox" @if ($menu->status == 1)
                                        checked
                                        @endif>
                                </label>
                            </td>

                            <td class="menu-actions">
                                <a href="{{ route('admin.content.service-menu.create', ['parent_id' => $menu->id]) }}"
                                   class="btn btn-outline-primary btn-sm"
                                   title="افزودن زیرمجموعه">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('admin.content.service-menu.edit', $menu->id) }}"
                                   class="btn btn-outline-info btn-sm"
                                   title="ویرایش">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="d-inline" action="{{ route('admin.content.service-menu.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-outline-danger btn-sm delete" type="submit" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')
<script type="text/javascript">
    function changeStatus(id){
        var element = $("#" + id)
        var url = element.attr('data-url')
        var elementValue = !element.prop('checked');

        $.ajax({
            url : url,
            type : "GET",
            success : function(response){
                if(response.status){
                    if(response.checked){
                        element.prop('checked', true);
                        successToast('منو با موفقیت فعال شد')
                    }
                    else{
                        element.prop('checked', false);
                        successToast('منو با موفقیت غیر فعال شد')
                    }
                }
                else{
                    element.prop('checked', elementValue);
                    errorToast('هنگام ویرایش مشکلی بوجود امده است')
                }
            },
            error : function(){
                element.prop('checked', elementValue);
                errorToast('ارتباط برقرار نشد')
            }
        });
    }
</script>

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

<script>
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('sortable-table');
    var sortable = Sortable.create(el, {
        animation: 150,
        ghostClass: 'bg-light',
        onEnd: function(evt) {
            var itemEl = evt.item;
            var rows = Array.from(el.getElementsByTagName('tr'));
            var sortData = rows.map((row, index) => {
                return {
                    id: row.dataset.id,
                    sort: index + 1
                };
            });

            fetch('{{ route("admin.content.menu.sort") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items: sortData })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    successToast('ترتیب منوها با موفقیت ذخیره شد');
                } else {
                    errorToast('خطا در ذخیره‌سازی ترتیب منوها');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorToast('خطا در ذخیره‌سازی ترتیب منوها');
            });
        }
    });
});
</script>
@endsection
