<!DOCTYPE html>
<html lang="en">

<head>
   @include('admin.includes.top')
   @yield('head')
   <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@300&display=swap" rel="stylesheet">
   <style>
       body {
           font-family: 'Noto Sans Devanagari', sans-serif;
           background-color: rgb(255, 255, 255);
       }
   </style>
</head>

<body>
    <div class="wrapper">
        @include('admin.includes.sidebar')

        <div class="main-panel">
            @include('admin.includes.header')

            <div class="container ">
                <div class="mt-4 page-inner">
                    @yield('content')
                </div>
            </div>
        </div>


    </div>
    @include('admin.includes.bottom')
    @yield('scripts')
</body>

</html>
