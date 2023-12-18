<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.4.2/css/all.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @yield('css')
</head>

<body>

    @php
        $username = session()->get('username');
        $emp_data = App\Models\Emp::where('username', $username)->first();
        $fullname = $emp_data->f_name  .' '. $emp_data->l_name
    @endphp
    @include('sweetalert::alert')

    <div class="wrapper">
    @include('main_template.sidebar')

        {{-- ส่วนเมนูด้านข้าง --}}
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @yield('js')



</body>

</html>
