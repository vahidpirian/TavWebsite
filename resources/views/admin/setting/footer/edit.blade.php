@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش تنظیمات فوتر</title>
    <link href="{{ asset('admin-assets/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/quill/editor-fa.css') }}" rel="stylesheet">
    <style>
        .enamad-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: relative;
        }
        .enamad-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .enamad-preview {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
        }
        .remove-enamad {
            color: #dc3545;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1.2rem;
            position: absolute;
            top: 10px;
            left: 10px;
            background: white;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1;
        }
        .remove-enamad:hover {
            color: #c82333;
            transform: scale(1.1);
        }
        .add-enamad {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .add-enamad:hover {
            background: #e9ecef;
            border-color: #ced4da;
        }
        .image-upload {
            position: relative;
            width: 100%;
            height: 120px;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s;
            overflow: hidden;
        }
        .image-upload:hover {
            border-color: #4e73df;
            background: #f0f4ff;
        }
        .image-upload input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }
        .image-upload-content {
            text-align: center;
            padding: 15px;
            position: relative;
            z-index: 1;
        }
        .image-upload-icon {
            font-size: 24px;
            color: #4e73df;
            margin-bottom: 10px;
        }
        .image-upload-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .image-upload-hint {
            color: #adb5bd;
            font-size: 0.8rem;
        }
        .image-preview {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 10px;
            background: white;
            display: none;
            z-index: 1;
        }
        .image-preview.active {
            display: block;
        }
        .image-upload.active {
            border-style: solid;
            background: white;
        }
        .enamad-header {
            margin-bottom: 15px;
            padding-top: 10px;
        }
        .image-upload-wrapper {
            position: relative;
        }
        .change-image-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            color: #4e73df;
            cursor: pointer;
            z-index: 3;
            display: none;
        }
        .image-upload:hover .change-image-btn {
            display: block;
        }
    </style>
@endsection

@section('content')
    <section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">ویرایش تنظیمات فوتر</h1>
    </section>

    <section class="row my-3">
        <section class="col-12">
            <form action="{{ route('admin.setting.footer.update', $settingFooter->id ?? 0) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="title_enamad">عنوان اینماد</label>
                    <input type="text" class="form-control" id="title_enamad" name="title_enamad"
                           value="{{ old('title_enamad', $settingFooter->title_enamad ?? '') }}" placeholder="عنوان اینماد را وارد کنید">
                    @error('title_enamad')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="text_copyright">متن کپی رایت</label>
                    <div id="editor" style="height: 300px;"> {{ old('text_copyright', $settingFooter->text_copyright ?? '') }}</div>
                    <input type="hidden" name="text_copyright" id="text_copyright">
                    @error('text_copyright')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>اینمادها</label>
                    <div id="enamads-container">
                        @php
                            $enamads = old('enamads', $settingFooter->enamads ?? []);
                        @endphp

                        @foreach($enamads as $index => $enamad)
                            <div class="enamad-item" data-index="{{ $index }}">
                                <i class="fas fa-times remove-enamad" onclick="removeEnamad({{ $index }})"></i>
                                <div class="row enamad-header">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>عنوان</label>
                                            <input type="text" class="form-control" name="enamads[{{ $index }}][title]"
                                                   value="{{ $enamad['title'] ?? '' }}" placeholder="عنوان اینماد">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>لینک</label>
                                            <input type="url" class="form-control" name="enamads[{{ $index }}][link]"
                                                   value="{{ $enamad['link'] ?? '' }}" placeholder="لینک اینماد">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>تصویر</label>
                                            <div class="image-upload" id="image-upload-{{ $index }}">
                                                <input type="file" name="enamads[{{ $index }}][image]"
                                                       id="enamad-image-{{ $index }}" onchange="previewImage(this, {{ $index }})">
                                                <div class="image-upload-content">
                                                    <i class="fas fa-cloud-upload-alt image-upload-icon"></i>
                                                    <div class="image-upload-text">تصویر را انتخاب کنید</div>
                                                    <div class="image-upload-hint">یا فایل را اینجا رها کنید</div>
                                                </div>
                                                @if(isset($enamad['image']) && !empty($enamad['image']))
                                                    <img src="{{ asset($enamad['image']) }}" class="image-preview active" id="preview-{{ $index }}">
                                                @else
                                                    <img src="" class="image-preview" id="preview-{{ $index }}">
                                                @endif
                                                <div class="change-image-btn">تغییر تصویر</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="add-enamad mt-3" onclick="addEnamad()">
                        <i class="fas fa-plus"></i> افزودن اینماد جدید
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </section>
    </section>
@endsection

@section('script')
    <script src="{{ asset('admin-assets/quill/quill.js') }}"></script>
    <script>
        // Initialize Quill editor
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'font': [] }, { 'size': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'super' }, { 'script': 'sub' }],
                    [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }, { 'align': [] }],
                    ['link', 'formula'],
                    ['clean']
                ],
                formula: true,
                imageResize: {
                    displaySize: true
                }
            },
        });

        // Set initial content if exists
        @if(old('text_copyright', $settingFooter->text_copyright ?? ''))
            quill.root.innerHTML = `{!! old('text_copyright', $settingFooter->text_copyright ?? '') !!}`;
        @endif

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            // Get the HTML content from Quill
            const content = quill.root.innerHTML;
            // Set the content to the hidden input
            document.getElementById('text_copyright').value = content;
        });
    </script>
    <script>
        function addEnamad() {
            const container = document.getElementById('enamads-container');
            const index = container.children.length;

            const enamadItem = document.createElement('div');
            enamadItem.className = 'enamad-item';
            enamadItem.setAttribute('data-index', index);

            enamadItem.innerHTML = `
                <i class="fas fa-times remove-enamad" onclick="removeEnamad(${index})"></i>
                <div class="row enamad-header">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" name="enamads[${index}][title]" placeholder="عنوان اینماد">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>لینک</label>
                            <input type="url" class="form-control" name="enamads[${index}][link]" placeholder="لینک اینماد">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>تصویر</label>
                            <div class="image-upload" id="image-upload-${index}">
                                <input type="file" name="enamads[${index}][image]"
                                       id="enamad-image-${index}" onchange="previewImage(this, ${index})">
                                <div class="image-upload-content">
                                    <i class="fas fa-cloud-upload-alt image-upload-icon"></i>
                                    <div class="image-upload-text">تصویر را انتخاب کنید</div>
                                    <div class="image-upload-hint">یا فایل را اینجا رها کنید</div>
                                </div>
                                <img src="" class="image-preview" id="preview-${index}">
                                <div class="change-image-btn">تغییر تصویر</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(enamadItem);
        }

        function removeEnamad(index) {
            const container = document.getElementById('enamads-container');
            const item = container.querySelector(`[data-index="${index}"]`);
            item.remove();
        }

        function previewImage(input, index) {
            const uploadContainer = document.getElementById(`image-upload-${index}`);
            const preview = document.getElementById(`preview-${index}`);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('active');
                    uploadContainer.classList.add('active');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

