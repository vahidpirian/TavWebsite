@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش پست</title>
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/select2/css/select2.css') }}">
<style>
    .image-upload-box {
        width: 100%;
        height: 300px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .image-upload-box:hover {
        border-color: #007bff;
    }
    .image-upload-box.dragover {
        border-color: #28a745;
        background-color: rgba(40, 167, 69, 0.1);
    }
    .image-upload-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    .image-upload-icon {
        font-size: 48px;
        color: #ccc;
        margin-bottom: 10px;
    }
    .image-upload-text {
        color: #666;
        font-size: 14px;
    }
    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: contain;
        position: absolute;
        top: 0;
        left: 0;
    }
    #currentImage {
        display: block;
    }
    #imagePreview {
        display: none;
    }
    .image-actions {
        position: absolute;
        bottom: 10px;
        right: 10px;
        z-index: 10;
    }
    .image-action-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        margin-left: 5px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .image-action-btn:hover {
        background: #fff;
    }
</style>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">پست</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ویرایش پست
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.content.post.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    {{ method_field('put') }}
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title">عنوان پست</label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title', $post->title) }}" id="title">
                            </div>
                            @error('title')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category_id">انتخاب دسته</label>
                                <select name="category_id" id="category_id" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach ($postCategories as $postCategory)
                                    <option value="{{ $postCategory->id }}" @if(old('category_id', $post->category_id) == $postCategory->id) selected @endif>{{ $postCategory->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('category_id')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="study_time">زمان مطالعه (دقیقه)</label>
                                <input type="number" class="form-control form-control-sm" name="study_time" value="{{ old('study_time', $post->study_time) }}" id="study_time">
                            </div>
                            @error('study_time')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $post->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if (old('status', $post->status) == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="commentable">امکان درج کامنت</label>
                                <select name="commentable" id="commentable" class="form-control form-control-sm">
                                    <option value="0" @if (old('commentable', $post->commentable) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if (old('commentable', $post->commentable) == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('commentable')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="text" name="published_at" id="published_at" value="{{ old('published_at', $post->published_at) }}" class="form-control form-control-sm d-none">
                                <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{ old('published_at', $post->published_at) }}">
                            </div>
                            @error('published_at')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 mb-4">
                            <div class="form-group">
                                <label>تصویر پست</label>
                                <div class="image-upload-box" id="imageUploadBox">
                                    <input type="file" name="image" id="image" class="d-none" accept="image/*">
                                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="image-preview" id="currentImage">
                                    <div class="image-upload-content d-none" id="uploadContent">
                                        <i class="fas fa-cloud-upload-alt image-upload-icon"></i>
                                        <div class="image-upload-text">برای انتخاب تصویر کلیک کنید یا آن را اینجا رها کنید</div>
                                    </div>
                                    <img id="imagePreview" class="image-preview d-none">
                                    <div class="image-actions">
                                        <button type="button" class="image-action-btn" id="changeImage" title="تغییر تصویر">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <button type="button" class="image-action-btn" id="removeImage" title="حذف تصویر">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="tags">تگ‌ها</label>
                                <input type="hidden" class="form-control form-control-sm" name="tags" id="tags" value="{{ old('tags', $post->tags) }}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>
                            @error('tags')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="related_posts">پست‌های مرتبط</label>
                                <select name="related_posts[]" id="related_posts" class="select2 form-control form-control-sm" multiple>
                                    @foreach($posts as $relatedPost)
                                    <option value="{{ $relatedPost->id }}"
                                        @if($relatedPosts->contains('related_post_id', $relatedPost->id)) selected @endif>
                                        {{ $relatedPost->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('related_posts')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="summary">خلاصه پست</label>
                                <textarea name="summary" class="form-control form-control-sm" rows="4" id="summary">{{ old('summary', $post->summary) }}</textarea>
                            </div>
                            @error('summary')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for="body">متن پست</label>
                                <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body', $post->body) }}</textarea>
                            </div>
                            @error('body')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
  </section>

@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/select2/js/select2.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>

    <script>
        $(document).ready(function () {

            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at',
                initialValue: true,
                observer: true,
                calendar: {
                    persian: {
                        locale: 'fa',
                        showHint: true,
                        leapYearMode: 'astronomical'
                    }
                }
            });

        });
    </script>

<script>
    $(document).ready(function () {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if(tags_input.val() !== null && tags_input.val().length > 0)
        {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder : 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data
        });
        select_tags.children('option').attr('selected', true).trigger('change');

        // Initialize select2 for related posts
        $('#related_posts').select2({
            placeholder: 'لطفا پست‌های مرتبط را انتخاب کنید',
            allowClear: true
        });

        $('#form').submit(function ( event ){
            if(select_tags.val() !== null && select_tags.val().length > 0){
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        const imageUploadBox = $('#imageUploadBox');
        const imageInput = $('#image');
        const imagePreview = $('#imagePreview');
        const currentImage = $('#currentImage');
        const uploadContent = $('#uploadContent');
        const imageActions = $('.image-actions');
        const changeImageBtn = $('#changeImage');
        const removeImageBtn = $('#removeImage');

        // Handle click to upload
        imageUploadBox.on('click', function(e) {
            if (!$(e.target).closest('.image-action-btn').length) {
                imageInput[0].click();
            }
        });

        // Handle file selection
        imageInput.on('change', function() {
            const file = this.files[0];
            if (file) {
                handleImage(file);
            }
        });

        // Handle drag and drop
        imageUploadBox.on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('dragover');
        });

        imageUploadBox.on('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
        });

        imageUploadBox.on('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
            const file = e.originalEvent.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                handleImage(file);
            }
        });

        // Handle image preview
        function handleImage(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                currentImage.hide();
                uploadContent.hide();
                imagePreview.attr('src', e.target.result).removeClass('d-none').show();
                imageActions.show();
            }
            reader.readAsDataURL(file);
        }

        // Handle change image
        changeImageBtn.on('click', function(e) {
            e.stopPropagation();
            imageInput[0].click();
        });

        // Handle remove image
        removeImageBtn.on('click', function(e) {
            e.stopPropagation();
            imagePreview.hide().addClass('d-none');
            currentImage.hide();
            uploadContent.show();
            imageInput.val('');
        });
    });
</script>

@endsection
