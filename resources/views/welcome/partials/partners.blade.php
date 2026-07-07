<!-- Partners Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>हाम्रा साझेदारहरू</h2>
            <p>हाम्रा महत्त्वपूर्ण साझेदार संस्थाहरू</p>
            <div class="divider"></div>
        </div>

        <div class="partners-slider swiper">
            <div class="swiper-wrapper">
                @for($i = 1; $i <= 10; $i++)
                    <div class="swiper-slide">
                        <div class="partner-logo">
                            <img src="{{ asset('dist/img/partners/partner-' . $i . '.png') }}" alt="Partner {{ $i }}">
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</section>
