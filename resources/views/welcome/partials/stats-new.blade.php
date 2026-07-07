<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stats-number">{{ \App\Models\Training::count() ?? 0 }}</div>
                    <div class="stats-label">कुल तालिम</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-number">{{ $totalCounts->grand_total_count ?? 0 }}</div>
                    <div class="stats-label">कुल सहभागी</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-female"></i>
                    </div>
                    <div class="stats-number">{{ $totalCounts->total_female_count ?? 0 }}</div>
                    <div class="stats-label">महिला सहभागी</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-male"></i>
                    </div>
                    <div class="stats-number">{{ $totalCounts->total_male_count ?? 0 }}</div>
                    <div class="stats-label">पुरुष सहभागी</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="stats-number">{{ \App\Models\TrainingCertification::count() ?? 0 }}</div>
                    <div class="stats-label">प्रमाणपत्र वितरण</div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="600">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="stats-number">{{ \App\Models\Category::count() ?? 0 }}</div>
                    <div class="stats-label">साझेदार संस्था</div>
                </div>
            </div>
        </div>
    </div>
</section>
