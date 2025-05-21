@extends('admin.layouts.master')

@section('head-tag')
<title>سوالات متداول</title>
    <style>
        .text-lg{
            font-size: 13px;
        }
    </style>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> سوالات متداول</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                سوالات متداول
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.faq.create') }}" class="btn btn-info btn-sm">ایجاد سوال جدید</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>پرسش</th>
                            <th>خلاصه پاسخ</th>
                            <th>نمایش در صحفه اصلی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($faqs as $key => $faq)

                        <tr>
                            <th class="text-center">{{ $key += 1 }}</th>
                            <td class="text-center">{{ $faq->question }}</td>
                            <td class="text-center">{!! mb_substr($faq->answer,0,95) !!}</td>
                            <td class="text-center">
                                <span class="text-lg badge {{$faq->is_show_on_home ? 'badge-success' : 'badge-primary'}}">{{$faq->is_show_on_home ? 'فعال' : 'غیرفعال'}}</span>
                            </td>
                            <td class="text-center">
                                <label>
                                    <input id="{{ $faq->id }}" onchange="changeStatus({{ $faq->id }})" data-url="{{ route('admin.content.faq.status', $faq->id) }}" type="checkbox" @if ($faq->status === 1)
                                    checked
                                    @endif>
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.content.faq.edit', $faq->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.content.faq.destroy', $faq->id) }}" method="post">
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
                        successToast('پرسش  با موفقیت فعال شد')
                    }
                    else{
                        element.prop('checked', false);
                        successToast('پرسش  با موفقیت غیر فعال شد')
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


@endsection
