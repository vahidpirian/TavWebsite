<script src="{{asset('app-assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('app-assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('app-assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('app-assets/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('app-assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('app-assets/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('app-assets/js/jquery.appear.min.js')}}"></script>
<script src="{{asset('app-assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('app-assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('app-assets/js/counter-up.js')}}"></script>
<script src="{{asset('app-assets/js/wow.min.js')}}"></script>
<script src="{{asset('app-assets/js/main.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');

        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }

        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    });
</script>
