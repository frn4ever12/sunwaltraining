<!DOCTYPE html>
<html lang="ne">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ get_detail()->palika_name ?? '' }} - तालिम व्यवस्थापन प्रणाली">
    <meta name="keywords" content="तालिम, व्यवस्थापन, प्रणाली, नगरपालिका, सरकार">
    <title>{{ get_detail()->palika_name ?? '' }} - तालिम व्यवस्थापन प्रणाली</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.css" rel="stylesheet">
    
    <!-- OpenLayers CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.1.0/ol.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Government Portal CSS -->
    <link href="{{ asset('dist/css/government-portal.css') }}" rel="stylesheet">
    
    @include('frontend.includes.top')
    
    @yield('head')
</head>

<body>
    @include('frontend.includes.header-new')
    
    <main style="min-height: 50vh;">
        @include('frontend.includes.message')
        @yield('content')
    </main>
    
    @include('frontend.includes.footer-new')
    @include('frontend.includes.bottom')
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.js"></script>
    
    <!-- OpenLayers JS -->
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.1.0/dist/ol.js"></script>
    
    <!-- Custom Government Portal JS -->
    <script src="{{ asset('dist/js/government-portal.js') }}"></script>
    
    @yield('scripts')
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    </script>
</body>

</html>
