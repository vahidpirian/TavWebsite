@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش ویدیو</title>
    <style>
        .progress-bar-container {
            margin: 15px 0;
        }

        .progress {
            height: 20px;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: #f5f5f5;
            border-radius: 4px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        }

        .progress-bar {
            float: left;
            width: 0;
            height: 100%;
            font-size: 12px;
            line-height: 20px;
            color: #fff;
            text-align: center;
            background-color: #337ab7;
            box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
            transition: width .6s ease;
        }
    </style>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">ویدیو</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش ویدیو</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش ویدیو
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.video.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.video.update', $video->id) }}" method="POST"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <section class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="" class="font-weight-bold">عنوان ویدیو</label>
                                            <input type="text" class="form-control form-control-sm" name="title"
                                                   value="{{ old('title', $video->title) }}">
                                        </div>
                                        @error('title')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="type" class="font-weight-bold">نوع ویدیو</label>
                                            <select name="type" id="type" class="form-control form-control-sm">
                                                <option value="">نوع را انتخاب کنید</option>
                                                <option value="upload"
                                                        @if(old('type', $video->type) == 'upload') selected @endif>آپلود
                                                </option>
                                                <option value="link"
                                                        @if(old('type', $video->type) == 'link') selected @endif>لینک
                                                </option>
                                            </select>
                                        </div>
                                        @error('type')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="position">موقعیت</label>
                                            <select name="position" id="position" class="form-control form-control-sm">
                                                <option value="">موقعیت را انتخاب کنید</option>
                                                <option value="slider" @if(old('position',$video->position) == 'slider') selected @endif>اسلایدر</option>
                                                <option value="top" @if(old('position',$video->position) == 'top') selected @endif>بالا</option>
                                                <option value="bottom" @if(old('position',$video->position) == 'bottom') selected @endif>پایین</option>
                                            </select>
                                        </div>
                                        @error('position')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </section>

                                    <section class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="status" class="font-weight-bold">وضعیت</label>
                                            <select name="status" class="form-control form-control-sm" id="status">
                                                <option value="0"
                                                        @if(old('status', $video->status) == 0) selected @endif>غیرفعال
                                                </option>
                                                <option value="1"
                                                        @if(old('status', $video->status) == 1) selected @endif>فعال
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </section>

                                    <section class="col-12" id="upload-section" style="display: none;">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="video" class="font-weight-bold">فایل ویدیو</label>
                                                    <input type="file" name="video" class="form-control form-control-sm"
                                                           id="video">
                                                </div>
                                                @if($video->video && $video->type == 'upload')
                                                    <div class="mt-2 mb-3">
                                                        <video width="300" controls>
                                                            <source src="{{ asset($video->video) }}" type="video/mp4">
                                                            مرورگر شما از این ویدیو پشتیبانی نمی‌کند.
                                                        </video>
                                                    </div>
                                                @endif
                                                <div class="progress mt-3" style="display: none;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 0%;" aria-valuenow="0"
                                                         aria-valuemin="0" aria-valuemax="100">0%
                                                    </div>
                                                </div>
                                                @error('video')
                                                <span class="alert_required bg-danger text-white p-1 rounded"
                                                      role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </section>

                                    <section class="col-12" id="link-section" style="display: none;">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="url_video" class="font-weight-bold">آدرس ویدیو</label>
                                                    <input type="text" name="url_video"
                                                           value="{{ old('url_video', $video->url_video) }}"
                                                           class="form-control form-control-sm">
                                                </div>
                                                @error('url_video')
                                                <span class="alert_required bg-danger text-white p-1 rounded"
                                                      role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="card-footer text-left">
                                <button class="btn btn-primary btn-sm">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Handle type selection
            function toggleSections(type) {
                if(type === 'upload') {
                    $('#upload-section').slideDown();
                    $('#link-section').slideUp();
                }
                else if(type === 'link') {
                    $('#link-section').slideDown();
                    $('#upload-section').slideUp();
                }
                else {
                    $('#upload-section').slideUp();
                    $('#link-section').slideUp();
                }
            }

            // Initial state
            toggleSections('{{ $video->type }}');

            // On type change
            $('#type').change(function() {
                toggleSections($(this).val());
            });

            // Handle form submission with progress bar
            $('#form').on('submit', function(e) {
                if($('#type').val() === 'upload' && $('#video').val()) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    formData.append('_method', 'PUT'); // Add PUT method

                    $.ajax({
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = ((evt.loaded / evt.total) * 100);
                                    $(".progress-bar").width(percentComplete + '%');
                                    $(".progress-bar").html(percentComplete.toFixed(0) + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            $(".progress").show();
                            $(".progress-bar").width('0%');
                        },
                        success: function(response) {
                            window.location.href = "{{ route('admin.content.video.index') }}";
                        },
                        error: function(xhr, status, error) {
                            if(xhr.status === 422) {
                                // نمایش خطاهای اعتبارسنجی
                                var errors = xhr.responseJSON.errors;
                                Object.keys(errors).forEach(function(key) {
                                    errorToast(errors[key][0]);
                                });
                            } else {
                                errorToast('خطا در آپلود فایل');
                            }
                            $(".progress").hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection
