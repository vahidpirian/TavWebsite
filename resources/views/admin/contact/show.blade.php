@extends('admin.layouts.master')

@section('head-tag')
<title>نمایش پیام</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.contact.index') }}">پیام های تماس با ما</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">نمایش پیام</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>نمایش پیام</h5>
            </section>
            <section class="card mb-3">
                <section class="card-header text-white bg-custom-blue">
                    {{ $contact->subject }}
                </section>
                <section class="card-body">
                    <h5 class="card-title">از طرف: {{ $contact->name }}</h5>
                    <p class="card-text">ایمیل: {{ $contact->email }}</p>
                    <p class="card-text">موبایل: {{ $contact->mobile }}</p>
                    <p class="card-text">متن پیام:</p>
                    <p class="card-text">{{ $contact->message }}</p>
                </section>
                <section class="card-footer">
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-warning">بازگشت</a>
                </section>
            </section>
        </section>
    </section>
</section>
@endsection 