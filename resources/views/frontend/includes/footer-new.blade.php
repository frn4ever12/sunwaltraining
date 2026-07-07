<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- About Column -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h4>हाम्रो बारेमा</h4>
                <p class="text-white-50 mb-3">
                    {{ get_detail()->palika_name ?? '' }} तालिम व्यवस्थापन प्रणाली नागरिकहरूलाई गुणस्तरीय तालिम प्रदान गर्ने उद्देश्यले स्थापना गरिएको हो।
                </p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Important Links Column -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="200">
                <h4>महत्त्वपूर्ण लिंकहरू</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right me-2"></i>गृहपृष्ठ</a></li>
                    <li><a href="{{ route('about.index') }}"><i class="fas fa-chevron-right me-2"></i>हाम्रो बारेमा</a></li>
                    <li><a href="{{ route('training.index') }}"><i class="fas fa-chevron-right me-2"></i>तालिमहरू</a></li>
                    <li><a href="{{ route('samachar.index') }}"><i class="fas fa-chevron-right me-2"></i>समाचारहरू</a></li>
                    <li><a href="{{ route('notice.index') }}"><i class="fas fa-chevron-right me-2"></i>नोटिसहरू</a></li>
                    <li><a href="{{ route('gallery.index') }}"><i class="fas fa-chevron-right me-2"></i>ग्यालरी</a></li>
                </ul>
            </div>

            <!-- Downloads Column -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="300">
                <h4>डाउनलोडहरू</h4>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-file-pdf me-2"></i>आवेदन फारम</a></li>
                    <li><a href="#"><i class="fas fa-file-pdf me-2"></i>तालिम गाइडलाइन</a></li>
                    <li><a href="#"><i class="fas fa-file-pdf me-2"></i>पाठ्यक्रम</a></li>
                    <li><a href="#"><i class="fas fa-file-pdf me-2"></i>वार्षिक प्रतिवेदन</a></li>
                    <li><a href="#"><i class="fas fa-file-pdf me-2"></i>नीति तथा कार्यविधि</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="400">
                <h4>सम्पर्क</h4>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-text">
                        <h5>ठेगाना</h5>
                        <p>{{ get_detail()->address ?? '' }}, {{ get_detail()->district->name ?? '' }}</p>
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

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ get_detail()->palika_name ?? '' }}। सर्वाधिकार सुरक्षित।</p>
        </div>
    </div>
</footer>
