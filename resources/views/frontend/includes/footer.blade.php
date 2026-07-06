<!-- New Footer Section -->
<footer class="bg-main text-white py-4">
    <div class="container">
        <div class="row">
            <!-- Organization Details -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <h5 class="mb-3 border-bottom pb-2">संस्था विवरण</h5>
                <div class="d-flex mb-3 gap-2">
                    @if (isset(get_detail()->logo))
                        <img src="{{ asset('files/' . get_detail()->logo) }}" alt="Organization Logo" class="me-2"
                            style="width: 60px; height: 60px;">
                    @else
                        <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" alt="Organization Logo"
                            class="me-2" style="width: 60px; height: 60px;">
                    @endif
                    <ul class="list-unstyled">
                        @if (!empty(get_detail()->palika_name))
                            <li class="fs-5 fw-bold mb-1">{{ get_detail()->palika_name }}</li>
                        @endif

                        @if (!empty(get_detail()->address))
                            <li class="mb-1"><strong>ठेगाना:</strong> {{ get_detail()->address }}</li>
                        @endif

                        @if (!empty(get_detail()->email))
                            <li class="mb-1"><strong>इमेल:</strong> {{ get_detail()->email }}</li>
                        @endif

                        @if (!empty(get_detail()->contact_no))
                            <li class="mb-1"><strong>फोन नम्बर:</strong> {{ get_detail()->contact_no }}</li>
                        @endif
                    </ul>
                </div>

            </div>

            <!-- Useful Links -->
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <h5 class="mb-3 border-bottom pb-2">उपयोगी लिंकहरू</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>गृहपृष्ठ</a></li>
                    <li class="mb-2"><a href="{{ route('about.index') }}" class="text-white text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>हाम्रो बारेमा</a></li>
                    <li class="mb-2"><a href="{{ route('gallery.index') }}" class="text-white text-decoration-none"><i
                                class="fas fa-angle-right me-2"></i>ग्यालेरी</a></li>
                    <li class="mb-2"><a href="{{ route('training.index') }}"
                            class="text-white text-decoration-none"><i class="fas fa-angle-right me-2"></i>तालिमहरू</a>
                    </li>
                </ul>
            </div>


            <!-- Location Map -->
            <div class="col-lg-5 col-md-5 col-sm-12 mb-4">
                <h5 class="mb-3 border-bottom pb-2">हाम्रो स्थान</h5>
                <div class=" mb-2">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113125.13927941359!2d83.55436803473482!3d27.619542218488697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3994289735b6f177%3A0xbdee44270b1410d!2z4KS44KWB4KSo4KS14KSy!5e0!3m2!1sne!2snp!4v1783338592190!5m2!1sne!2snp" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                </div>
                <p class="small">{{ get_detail()->district->name ?? '' }}, नेपाल</p>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-3">
            <div class="col-12">
                <hr>
                <p class="text-center mb-0">© {{ date('Y') }} तालिम व्यवस्थापन प्रणाली। सर्वाधिकार सुरक्षित।</p>
            </div>
        </div>
    </div>
</footer>
