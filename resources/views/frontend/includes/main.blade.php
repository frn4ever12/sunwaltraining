<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>तालिम व्यवस्थापन प्रणाली</title>
    @include('frontend.includes.top')
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Devanagari', sans-serif;
            background-color: rgb(255, 255, 255);
        }
        .bg-primary,.btn-primary{
            background-color: rgb(0, 83, 172) !important;
            color: #fff;
        }
        .text-primary{
            color: rgb(0, 83, 172) !important;
        }
    </style>
    @yield('head')
</head>

<body>
    @include('frontend.includes.header')
    <main  style="min-height: 50vh;">
        @include('frontend.includes.message')
        @yield('content')
    </main>
    @include('frontend.includes.footer')
    @include('frontend.includes.bottom')
    @yield('scripts')
</body>

</html>
