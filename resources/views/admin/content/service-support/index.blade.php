@extends('admin.layouts.master')

@section('head-tag')
<title>پشتیبانی سرویس</title>
<script src="{{asset('admin-assets/js/Sortable.min.js')}}"></script>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> پشتیبانی سرویس</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  پشتیبانی سرویس
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.service-support.create') }}" class="btn btn-info btn-sm">ایجاد پشتیبانی سرویس جدید</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان خلاصه</th>
                            <th>عنوان</th>
                            <th>متن دکمه</th>
                            <th>لینک</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-table">
                        @foreach ($serviceSupports as $key => $serviceSupport)
                        <tr data-id="{{ $serviceSupport->id }}">
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $serviceSupport->small_title }}</td>
                            <td>{{ $serviceSupport->title }}</td>
                            <td>{{ $serviceSupport->button_text }}</td>
                            <td>{{ $serviceSupport->url }}</td>
                            <td>
                                @if($serviceSupport->image)
                                    <img src="{{ asset($serviceSupport->image) }}" alt="" style="max-width: 50px;">
                                @endif
                            </td>
                            <td>
                                <label>
                                    <input id="{{ $serviceSupport->id }}" onchange="changeStatus({{ $serviceSupport->id }})" data-url="{{ route('admin.content.service-support.status', $serviceSupport->id) }}" type="checkbox" @if ($serviceSupport->status == 1)
                                    checked
                                    @endif>
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.content.service-support.edit', $serviceSupport->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.content.service-support.destroy', $serviceSupport->id) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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
                        successToast('پشتیبانی سرویس با موفقیت فعال شد')
                    }
                    else{
                        element.prop('checked', false);
                        successToast('پشتیبانی سرویس با موفقیت غیر فعال شد')
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
            fetch('{{ route("admin.content.service-support.sort") }}', {
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
                    successToast('ترتیب پشتیبانی سرویس با موفقیت ذخیره شد');
                } else {
                    // نمایش پیام خطا
                    errorToast('خطا در ذخیره‌سازی ترتیب پشتیبانی سرویس');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('خطا در ذخیره‌سازی ترتیب پشتیبانی سرویس');
            });
        }
    });
});
</script>
@endsection
