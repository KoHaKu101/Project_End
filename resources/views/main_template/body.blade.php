<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.4.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @yield('css')
</head>

<body>
    @include('sweetalert::alert')
    <div class="wrapper">
        {{-- ส่วนเมนูด้านข้าง --}}
        @include('main_template.sidebar')

        <div class="main">
            {{-- ส่วนเมนูด้านบน --}}
            @include('main_template.header')

            <div class="content py-2">
                {{-- ส่วนของการแสดงข้อมูล --}}
                <div class="container-fluid">
                    @yield('body')
                </div>
            </div>


        </div>

    </div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
    @yield('js')



</body>

</html>
