<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>सम्पर्क गर्नुहोस्</h2>
            <p>कुनै पनि प्रश्न वा सुझाव भएमा हामीलाई सम्पर्क गर्नुहोस्</p>
            <div class="divider"></div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-12" data-aos="fade-right" data-aos-delay="200">
                <div class="contact-info-card">
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-text">
                            <h5>ठेगाना</h5>
                            <p>{{ get_detail()->address ?? '' }}, {{ get_detail()->district->name ?? '' }}, {{ get_detail()->province->name ?? '' }}, {{ get_detail()->country ?? 'नेपाल' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-info-text">
                            <h5>फोन</h5>
                            <p>{{ get_detail()->phone ?? '' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-text">
                            <h5>इमेल</h5>
                            <p>{{ get_detail()->email ?? '' }}</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-info-text">
                            <h5>कार्यालय समय</h5>
                            <p>सोमबार - शुक्रबार: १०:०० - ५:००</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12" data-aos="fade-left" data-aos-delay="400">
                <div class="contact-form">
                    <h4 class="mb-4">सन्देश पठाउनुहोस्</h4>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">पूरा नाम</label>
                                <input type="text" class="form-control" name="name" required placeholder="आफ्नो नाम लेख्नुहोस्">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">इमेल</label>
                                <input type="email" class="form-control" name="email" required placeholder="इमेल ठेगाना लेख्नुहोस्">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">फोन नम्बर</label>
                                <input type="tel" class="form-control" name="phone" placeholder="फोन नम्बर लेख्नुहोस्">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">विषय</label>
                                <input type="text" class="form-control" name="subject" required placeholder="विषय लेख्नुहोस्">
                            </div>
                            <div class="col-12">
                                <label class="form-label">सन्देश</label>
                                <textarea class="form-control" name="message" rows="5" required placeholder="आफ्नो सन्देश लेख्नुहोस्"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>सन्देश पठाउनुहोस्
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
