<!-- Success Stories Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>सफलता कथाहरू</h2>
            <p>हाम्रा सफल प्रशिक्षार्थीहरूको अनुभव सुन्नुहोस्</p>
            <div class="divider"></div>
        </div>

        <div class="success-stories-slider swiper">
            <div class="swiper-wrapper">
                @for($i = 1; $i <= 6; $i++)
                    <div class="swiper-slide" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="success-card">
                            <div class="success-image">
                                <img src="{{ asset('dist/img/success/story-' . $i . '.jpg') }}" alt="Success Story">
                            </div>
                            <div class="success-content">
                                <h4 class="success-name">प्रशिक्षार्थी {{ $i }}</h4>
                                <p class="success-training">{{ get_detail()->palika_name ?? '' }}</p>
                                <p class="success-story">
                                    यो तालिमले मेरो जीवनमा ठूलो परिवर्तन ल्यायो। 
                                    अब म राम्रो रोजगारी पाएको छु।
                                </p>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-book-open me-2"></i>पूरा कथा पढ्नुहोस्
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
