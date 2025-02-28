@extends('admin.layouts.master')

@section('head-tag')
<title>منو</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.8/lib/draggable.bundle.css"/>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> منو</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  منو
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.menu.create') }}" class="btn btn-info btn-sm">ایجاد منوی جدید</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام منو</th>
                            <th>منوی والد</th>
                            <th> لینک منو</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-table">
                        @foreach ($menus as $key => $menu)
                        <tr data-id="{{ $menu->id }}">
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->parent_id ? $menu->parent->name : 'منوی اصلی' }}</td>
                            <td>{{ $menu->url }}</td>
                            <td>
                                <label>
                                    <input id="{{ $menu->id }}" onchange="changeStatus({{ $menu->id }})" data-url="{{ route('admin.content.menu.status', $menu->id) }}" type="checkbox" @if ($menu->status === 1)
                                    checked
                                    @endif>
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.content.menu.edit', $menu->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.content.menu.destroy', $menu->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </form>                            </td>
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
                            successToast('منو  با موفقیت فعال شد')
                        }
                        else{
                            element.prop('checked', false);
                            successToast('منو  با موفقیت غیر فعال شد')
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

            // ارسال داده‌ها به سرور
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
                    // نمایش پیام موفقیت‌آمیز
                    successToast('ترتیب منوها با موفقیت ذخیره شد');
                } else {
                    // نمایش پیام خطا
                    errorToast('خطا در ذخیره‌سازی ترتیب منوها');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('خطا در ذخیره‌سازی ترتیب منوها');
            });
        }
    });
});
</script>

@endsection
