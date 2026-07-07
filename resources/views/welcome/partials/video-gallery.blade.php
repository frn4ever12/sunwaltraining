<!-- Video Gallery Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>भिडियो ग्यालरी</h2>
            <p>हाम्रा तालिम कार्यक्रमहरूको भिडियोहरू हेर्नुहोस्</p>
            <div class="divider"></div>
        </div>

        <div class="row g-4">
            @for($i = 1; $i <= 4; $i++)
                <div class="col-lg-3 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="video-card">
                        <div class="video-thumbnail" style="position: relative; height: 200px; overflow: hidden; border-radius: 12px;">
                            <img src="{{ asset('dist/img/video/video-' . $i . '.jpg') }}" alt="Video Thumbnail {{ $i }}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                <div style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-play" style="color: var(--primary-navy); font-size: 24px;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="video-info" style="padding: 15px 0;">
                            <h5 style="font-size: 16px; font-weight: 600; margin-bottom: 5px;">तालिम भिडियो {{ $i }}</h5>
                            <p style="font-size: 13px; color: var(--text-muted); margin: 0;">{{ get_detail()->palika_name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="text-center mt-4" data-aos="fade-up">
            <a href="#" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-play-circle me-2"></i>सबै भिडियोहरू हेर्नुहोस्
            </a>
        </div>
    </div>
</section>
