@extends('admin.layouts.master')

@section('head-tag')
    <title>ویدیوها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">ویدیوها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویدیوها
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.video.create') }}" class="btn btn-info btn-sm">ایجاد ویدیو جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان ویدیو</th>
                            <th>نوع ویدیو</th>
                            <th>موقعیت</th>
                            <th>نمایش</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($videos as $video)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $video->title }}</td>
                                <td>{{ $video->type == 'upload' ? 'آپلود' : 'لینک' }}</td>
                                <td>{{ $video->position }}</td>
                                <td>
                                    @if($video->type == 'upload')
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#videoModal-{{ $video->id }}">
                                            <i class="fa fa-play"></i> نمایش ویدیو
                                        </button>
                                    @else
                                        <a href="{{ $video->url_video }}" target="_blank" class="text-primary">مشاهده لینک</a>
                                    @endif
                                </td>
                                <td>
                                    <label>
                                        <input id="{{ $video->id }}"
                                               onchange="changeStatus({{ $video->id }})"
                                               data-url="{{ route('admin.content.video.status', $video->id) }}"
                                               type="checkbox"
                                               @if ($video->status === 1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.video.edit', $video->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> ویرایش
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('admin.content.video.destroy', $video->id) }}"
                                          method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm delete" type="submit">
                                            <i class="fa fa-trash-alt"></i> حذف
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
    @foreach ($videos as $video)
        @if($video->type == 'upload')
            <div class="modal fade" id="videoModal-{{ $video->id }}" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel-{{ $video->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="videoModalLabel-{{ $video->id }}">{{ $video->title }}</h5>
                            <button type="button" class="close mr-auto ml-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center bg-dark p-3">
                            <video width="100%" controls class="rounded" id="video-player-{{ $video->id }}">
                                <source src="{{ asset($video->video) }}" type="video/mp4">
                                مرورگر شما از این ویدیو پشتیبانی نمی‌کند.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('script')
    <script type="text/javascript">

        $('.modal').on('hidden.bs.modal', function () {
            var video = $(this).find('video').get(0);
            if(video) {
                video.pause();
                video.currentTime = 0;
            }
        });

        $('.modal').on('shown.bs.modal', function () {
            var video = $(this).find('video').get(0);
            if(video) {
                video.play();
            }
        });

        function changeStatus(id){
            var element = $("#" + id);
            var url = element.attr('data-url');
            var elementValue = !element.prop('checked');

            $.ajax({
                url : url,
                type : "GET",
                success : function(response){
                    if(response.status){
                        if(response.checked){
                            element.prop('checked', true);
                            successToast('ویدیو با موفقیت فعال شد')
                        }
                        else{
                            element.prop('checked', false);
                            successToast('ویدیو با موفقیت غیر فعال شد')
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
