<!-- Photo Gallery Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>फोटो ग्यालरी</h2>
            <p>हाम्रा तालिम कार्यक्रमहरूको फोटोहरू हेर्नुहोस्</p>
            <div class="divider"></div>
        </div>

        <div class="row g-3">
            @for($i = 1; $i <= 8; $i++)
                <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                    <div class="gallery-item" style="height: 250px;">
                        <img src="{{ asset('dist/img/gallery/gallery-' . $i . '.jpg') }}" alt="Gallery Image {{ $i }}">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('gallery.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-images me-2"></i>सबै फोटोहरू हेर्नुहोस्
            </a>
        </div>
    </div>
</section>
