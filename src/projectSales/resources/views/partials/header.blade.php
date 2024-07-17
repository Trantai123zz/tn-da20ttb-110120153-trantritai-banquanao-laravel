<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<div class="header">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="banner-image" src="{{ asset('images/banner3.jpg') }}" alt="Banner 3">
                    </div>
                    <div class="swiper-slide">
                        <img class="banner-image" src="{{ asset('images/banner4.jpg') }}" alt="Banner 4">
                    </div>
                    <div class="swiper-slide">
                        <img class="banner-image" src="{{ asset('images/banenr5.jpg') }}" alt="Banner 4">
                    </div>
                </div>
            </div>
        </div>
  
    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>
