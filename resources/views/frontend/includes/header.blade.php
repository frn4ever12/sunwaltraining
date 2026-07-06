@include('frontend.includes.top-header')
<header class="bg-white pt-1">
    <div class="container">

        <!-- Logo and Details Section -->
        <div class="row mb-2 align-items-center">
            <!-- Left Side - Organization Info -->
            <div class="col-lg-7 col-md-7 col-sm-12">
                <a class="text-decoration-none" href="/">
                    <div class="row align-items-center">
                        <div class="col-3 col-sm-3 col-md-2 text-center my-2 my-md-0">
                            <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" class="img-fluid"
                                style="max-width: 75px; width: 100%;" alt="GOV Logo">
                        </div>
                        <div class="col-9 col-sm-9 col-md-10">
                            <p class="mb-1 fw-bold text-main">{{ get_detail()->palika_name ?? '' }}</p>
                            <p class="mb-1 text-danger">{{ get_detail()->palika_karyalaya ?? '' }}</p>
                            <p class="mb-1 text-danger small">
                                {{ get_detail()->address ?? '' }}, {{ get_detail()->district->name ?? '' }},
                                {{ get_detail()->province->name ?? '' }},
                                {{ get_detail()->country ?? 'नेपाल' }}
                            </p>
                            <p class="mb-0 fw-bold text-main fs-6">तालिम व्यवस्थापन प्रणाली</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Right Side - Login and Logos -->
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="d-flex justify-content-end align-items-center">
                    <div>
                        @if (isset(get_detail()->logo))
                            <img src="{{ asset('files/' . get_detail()->logo) }}" class="img-fluid"
                                style="height: 10vh;" alt="Palika Logo">
                        @else
                            <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" class="img-fluid"
                                style="height: 10vh;" alt="Main Logo">
                        @endif
                    </div>
                    <div class="ms-4">
                        <img src="{{ asset('dist/img/flag/Flag_of_Nepal.gif') }}" class="img-fluid"
                            style="height: 10vh;" alt="Nepal Flag">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Responsive Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-main p-md-0">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav me-auto justify-content-start gap-0 gap-md-5">
                <li class="nav-item">
                    <a class="nav-link text-white px-2 py-3" href="{{ route('home') }}">गृह पृष्ठ</a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link dropdown-toggle text-white px-2 py-3" href="#" id="prakashanDropdown"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">सूचनाहरू
                    </a>
                    <div class="dropdown-menu" aria-labelledby="prakashanDropdown">
                        <a class="dropdown-item" href="{{ route('samachar.index') }}">समाचारहरू </a>
                        <a class="dropdown-item" href="{{ route('notice.index') }}">नोटिसहरू </a>
                        <a class="dropdown-item" href="{{ route('karyabidhi.index') }}">कार्यविधिहरू</a>
                        <a class="dropdown-item" href="{{ route('scheme.index') }}">स्कीमहरु </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-2 py-3" href="{{ route('training.index') }}">तालिमहरू</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white px-2 py-3" href="{{ route('gallery.index') }}">ग्यालेरी</a>
                </li>
                <li class="nav-item dropdown position-relative">
                    <a class="nav-link dropdown-toggle text-white px-2 py-3" href="#" id="aboutDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        हाम्रो बारेमा
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
                    <a class="nav-link text-white px-2 py-3" href="{{ route('contact.index') }}">सम्पर्क</a>
                </li>

            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center gap-3">
                    @auth
                        <a class="nav-link btn-nav rounded  text-main d-flex align-items-center"
                            style="padding: 7px 16px;" href="{{ route('dashboard') }}">
                            <i class="fas fa-desktop me-2"></i> ड्यासवोर्ड
                        </a>
                        <a class="nav-link btn-nav rounded  text-main d-flex align-items-center"
                            style="padding: 7px 16px;" href="#" id="logOutBtn">
                            <i class="fas fa-sign-out me-2"></i> लगआउट 
                        </a>
                    @else
                        <a class="nav-link btn-nav rounded  text-main d-flex align-items-center"
                            style="padding: 7px 16px;" href="{{ route('login') }}">
                            <small><i class="fas fa-user me-2"></i> लगइन</small>
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
