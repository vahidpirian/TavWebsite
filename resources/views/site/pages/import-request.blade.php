@extends('site.layouts.master')

@section('content')
<div class="contact-area py-40">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <div class="contact-form-header mb-4">
                            <h2 class="text-center">فرم درخواست واردات کالا</h2>
                            <p class="text-center">پس از تکمیل و ارسال فرم درخواست زیر، کارشناسان ما در اسرع وقت با شما تماس خواهند گرفت.</p>
                        </div>
                        <form method="POST" >
                           
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
                                    <label for="total_amount" class="form-label">مبلغ کل واردات <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="total_amount" name="total_amount" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="item_name" class="form-label">نام کالا <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="item_type" class="form-label">نوع واردات <span style="color: red;">*</span></label>
                                    <select class="form-select" id="item_type" name="item_type" required>
                                        <option value="" selected disabled>انتخاب کنید</option>
                                        <option value="کالا">کالا</option>
                                        <option value="نمونه (سمپل)">نمونه (سمپل)</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="confirm_code" class="form-label">کد تایید <span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="confirm_code" name="confirm_code" required>
                                        <button class="theme-btn-sm theme-btn" type="button" id="send_code">ارسال کد</button>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="invoice_attachment" class="form-label">پرفرما اینویس <span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" id="invoice_attachment" name="invoice_attachment" required>
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