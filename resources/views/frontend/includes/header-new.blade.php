<!-- Top Header -->
<div class="top-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a href="tel:+977{{ get_detail()->phone ?? '' }}" class="text-decoration-none">
                    <i class="fas fa-phone-alt me-2"></i>
                    {{ get_detail()->phone ?? '' }}
                </a>
                <a href="mailto:{{ get_detail()->email ?? '' }}" class="text-decoration-none">
                    <i class="fas fa-envelope me-2"></i>
                    {{ get_detail()->email ?? '' }}
                </a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="lang-switch">
                    <button class="active" data-lang="ne">नेपाली</button>
                    <button data-lang="en">English</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <a href="{{ route('home') }}" class="header-logo text-decoration-none">
                    <div class="d-flex align-items-center gap-3">
                        <div>
                            @if (isset(get_detail()->logo))
                                <img src="{{ asset('files/' . get_detail()->logo) }}" alt="{{ get_detail()->palika_name ?? '' }}">
                            @else
                                <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" alt="Government Logo">
                            @endif
                        </div>
                        <div class="header-info">
                            <h1>{{ get_detail()->palika_name ?? '' }}</h1>
                            <h2>{{ get_detail()->palika_karyalaya ?? '' }}</h2>
                            <p>
                                {{ get_detail()->address ?? '' }}, {{ get_detail()->district->name ?? '' }},
                                {{ get_detail()->province->name ?? '' }}, {{ get_detail()->country ?? 'नेपाल' }}
                            </p>
                            <span class="header-tagline">तालिम व्यवस्थापन प्रणाली</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="header-actions justify-content-end">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('dist/img/flag/Flag_of_Nepal.gif') }}" alt="Nepal Flag" style="height: 50px;">
                    </div>
                    <div class="auth-buttons">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-desktop me-2"></i> ड्यासवोर्ड
                            </a>
                            <a href="#" id="logOutBtn" class="btn btn-outline-primary">
                                <i class="fas fa-sign-out-alt me-2"></i> लगआउट
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-user me-2"></i> लगइन
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                <i class="fas fa-user-plus me-2"></i> दर्ता
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Sticky Navigation -->
<nav class="sticky-nav navbar navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i> गृहपृष्ठ
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-info-circle me-1"></i> हाम्रो बारेमा
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('about.index') }}">हाम्रो बारेमा</a>
                        </li>
                        @foreach (\App\Models\AboutUs::orderBy('id', 'ASC')->select('title','id')->get() as $about)
                            <li>
                                <a class="dropdown-item" href="{{ route('about-us', $about->id) }}">
                                    {{ $about->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('training.index') }}">
                        <i class="fas fa-graduation-cap me-1"></i> तालिमहरू
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('training.index') }}?status=upcoming">
                        <i class="fas fa-clock me-1"></i> आगामी तालिम
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="applicationDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt me-1"></i> आवेदन
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="applicationDropdown">
                        @auth
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">मेरो आवेदनहरू</a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('login') }}">आवेदन गर्नुहोस्</a>
                            </li>
                        @endauth
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="prakashanDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell me-1"></i> सूचना तथा समाचार
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="prakashanDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('samachar.index') }}">समाचारहरू</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('notice.index') }}">नोटिसहरू</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('karyabidhi.index') }}">कार्यविधिहरू</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('scheme.index') }}">स्कीमहरु</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="downloadDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download me-1"></i> डाउनलोड
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                        <li>
                            <a class="dropdown-item" href="#">फारमहरू</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">गाइडलाइन</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">पाठ्यक्रम</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">प्रतिवेदनहरू</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery.index') }}">
                        <i class="fas fa-images me-1"></i> ग्यालरी
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}">
                        <i class="fas fa-envelope me-1"></i> सम्पर्क
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-question-circle me-1"></i> FAQ
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
