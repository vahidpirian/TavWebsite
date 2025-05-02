<footer class="footer-area">
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper py-60">
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                            <img src="{{asset($setting->logo_footer)}}" alt="{{$setting->title}}">
                        </a>
                        <p class="mb-20">
                            راه های ارتباطی
                        </p>
                        <div class="footer-contact">
                            <ul>
                                <li><i class="far fa-map-marker-alt"></i>{{$setting->address}}</li>
                                <li><i class="far fa-phone"></i>{{$setting->mobile}}</li>
                                <li><i class="far fa-envelope"></i><span>{{$setting->email}}</span></li>
                            </ul>
                        </div>
                        <ul class="footer-social">
                            @if(!is_null($setting->socials ))
                                @foreach($setting->socials as $social)
                                    @if($social['status'] == '1')
                                        <li><a href="{{$social['link']}}" target="_blank"><i
                                                    class="{{$social['icon']}}"></i></a></li>
                                    @endif

                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">پیوندهای سریع</h4>
                        <ul class="footer-list">
                            @foreach($pages as $page)
                                <li><a href="{{route('page',$page->slug)}}"><i
                                            class="fas fa-caret-left"></i>{{$page->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">خدمات ما</h4>
                        <ul class="footer-list">
                            @foreach($services as $service)
                                <li><a href="{{route('service.show',$service->id)}}"><i
                                            class="fas fa-caret-left"></i>{{$service->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">{{$setting_footer && $setting_footer->title_enamad ?  $setting_footer->title_enamad : 'نمادهای اعتماد'  }}</h4>
                        <div class="enamad-container">
                            @if($setting_footer && $setting_footer->enamads)
                                @foreach($setting_footer->enamads ?? [] as $enamad)
                                    <div class="footer-box" >
                                        <a href="{{asset($enamad['link'])}}">
                                            <img
                                                src="{{asset($enamad['image'])}}"
                                                alt="{{asset($enamad['title'])}}"
                                            />
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center copyright-text">
                    @if($setting_footer && $setting_footer->text_copyright)
                        {!! $setting_footer->text_copyright !!}
                    @else
                        کلیه حقوق این وبسایت برای گروه
                        <a href="#"> تجارت آفرینان ورزان </a> محفوظ میباشد.
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
