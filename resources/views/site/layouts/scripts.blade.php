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

<script>
    $(document).ready(function() {
        let searchTimeout;
        const searchInput = $('#liveSearch');
        const searchResults = $('#searchResults');
        const searchLoading = $('#searchLoading');

        searchInput.on('input', function() {
            clearTimeout(searchTimeout);
            const query = $(this).val();

            if (query.length < 2) {
                searchResults.hide();
                return;
            }

            // نمایش لودینگ
            searchResults.show();
            searchLoading.show();

            searchTimeout = setTimeout(() => {
                $.ajax({
                    url: '{{ route("site.search") }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        searchLoading.hide();
                        displayResults(response.data);
                    },
                    error: function() {
                        searchLoading.hide();
                        searchResults.html('<div class="p-3 text-center">خطا در جستجو</div>');
                    }
                });
            }, 300);
        });

        function displayResults(results) {
            searchResults.empty();

            if (results.length === 0) {
                searchResults.html('<div class="p-3 text-center">نتیجه‌ای یافت نشد</div>');
            } else {
                results.forEach(item => {
                    const resultHtml = `
                <div class="search-result-item" onclick="window.location.href='${item.url}'">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="result-title">${item.title}</div>
                        <span class="search-badge ${item.type_class}">${item.type}</span>
                    </div>
                    <div class="result-description text-muted">${item.description}</div>
                </div>
            `;
                    searchResults.append(resultHtml);
                });
            }
        }

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-container').length) {
                searchResults.hide();
            }
        });
    });
</script>
