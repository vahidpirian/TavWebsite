@extends('site.layouts.master')

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="container">
                <h2 class="breadcrumb-title">پرسش و پاسخ</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html"><i class="far fa-home"></i> صفحه اصلی
                        </a></li>
                    <li class="active"> پرسش و پاسخ</li>
                </ul>
            </div>
            <div class="breadcrumb-shape">
                <img src="{{asset('app-assets/img/shape-4-svg')}}" alt="">
            </div>
        </div>


        <div class="faq-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="faq-left">
                            <div class="site-heading mb-3 text-center">
                                <span class="site-title-tagline">سوالات متداول</span>
                                <h2 class="site-title my-3">اغلب<span> سوالات</span> عمومی پرسیده شده</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mx-auto">
                        <div class="accordion mx-auto" id="accordionExample">
                            @foreach($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$faq->id}}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse{{$faq->id}}">
                                            <span><i class="far fa-question"></i></span>{{$faq->question}}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$faq->id}}" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
