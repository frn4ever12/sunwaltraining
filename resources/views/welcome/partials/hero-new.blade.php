<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12" data-aos="fade-right" data-aos-delay="200">
                <div class="hero-content">
                    <h1 class="hero-title">{{ get_detail()->palika_name ?? '' }}</h1>
                    <p class="hero-description">
                        गुणस्तरीय तालिम तथा सीप विकास कार्यक्रममा सहभागी हुनुहोस्। 
                        हामी तपाईंलाई व्यावसायिक र टेक्निकल सीपहरू प्रदान गर्दछौं।
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('training.index') }}" class="btn btn-primary">
                            <i class="fas fa-graduation-cap me-2"></i>तालिम हेर्नुहोस्
                        </a>
                        <a href="{{ route('training.index') }}?status=upcoming" class="btn btn-secondary">
                            <i class="fas fa-calendar-alt me-2"></i>आगामी तालिम
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-delay="400">
                <div class="hero-slider swiper">
                    <div class="swiper-wrapper">
                        @if(isset($banners) && $banners->count() > 0)
                            @foreach($banners as $banner)
                                <div class="swiper-slide">
                                    <div class="hero-slider-item">
                                        <img src="{{ asset('files/' . $banner->image) }}" alt="{{ $banner->title ?? 'Banner' }}">
                                        <div class="slider-overlay">
                                            <h4>{{ $banner->title ?? '' }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <div class="hero-slider-item">
                                    <img src="{{ asset('dist/img/hero/default.jpg') }}" alt="Default Banner">
                                    <div class="slider-overlay">
                                        <h4>तालिम व्यवस्थापन प्रणाली</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>
