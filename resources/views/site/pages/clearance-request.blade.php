@extends('site.layouts.master')

@section('content')
<div class="contact-area py-40" >
    <div class="container">
        <div class="contact-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <div class="contact-form-header mb-4">
                            <h2 class="text-center">فرم درخواست ترخیص کالا</h2>
                            <p class="text-center">پس از تکمیل و ارسال فرم درخواست زیر، کارشناسان ما در اسرع وقت با شما تماس خواهند گرفت.</p>
                        </div>
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label">نام و نام خانوادگی</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">شماره تماس <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">پست الکترونیک</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="item_owner" class="form-label">نام صاحب کالا</label>
                                    <input type="text" class="form-control" id="item_owner" name="item_owner">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="item_location" class="form-label">گمرک محل کالا <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="item_location" name="item_location" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="item_desc" class="form-label">توضیحات کالا</label>
                                    <textarea class="form-control" id="item_desc" name="item_desc" rows="3"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pre_invoice" class="form-label">پیش فاکتور</label>
                                    <input type="file" class="form-control" id="pre_invoice" name="pre_invoice">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="packing_list" class="form-label">لیست بسته بندی</label>
                                    <input type="file" class="form-control" id="packing_list" name="packing_list">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="confirm_code" class="form-label">کد تایید <span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="confirm_code" name="confirm_code" required>
                                        <button class="theme-btn-sm theme-btn" type="button" id="send_code">ارسال کد</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="theme-btn w-100 mt-3">ارسال درخواست</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection