
<footer class="footer-area">
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-100 pb-70">
                <div class="col-md-6 col-lg-4">
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
                                <li><i class="far fa-envelope"></i><span>{{$setting->email}}</span> </li>
                            </ul>
                        </div>
                        <ul class="footer-social">
                            @if(!is_null($setting->socials ))
                                @foreach($setting->socials as $social)
                                    @if($social['status'] == '1')
                                        <li><a href="{{$social['link']}}" target="_blank"><i class="{{$social['icon']}}"></i></a></li>
                                    @endif

                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">پیوندهای سریع</h4>
                        <ul class="footer-list">
                            @foreach($pages as $page)
                                <li><a href="{{route('page',$page->slug)}}"><i class="fas fa-caret-left"></i>{{$page->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">خدمات ما</h4>
                        <ul class="footer-list">
                            @foreach($services as $service)
                                <li><a href="{{route('service.show',$service->id)}}"><i class="fas fa-caret-left"></i>{{$service->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="copyright-text">
                        کلیه حقوق این وبسایت برای گروه
                        <a href="#"> تجارت آفرینان ورزان </a> محفوظ میباشد.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
