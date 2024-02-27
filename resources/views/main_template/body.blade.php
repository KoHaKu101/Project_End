<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.4.2/css/all.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @yield('css')
</head>

<body>
    @php
        $emp_id = session()->get('emp');
        $emp_data = App\Models\Emp::find($emp_id);
        $fullname = $emp_data->f_name . ' ' . $emp_data->l_name;
    @endphp
    @include('sweetalert::alert')

    <div class="wrapper">
        <div id="loading-overlay">
            <img src="{{ asset('assets/images/loadingImg.gif') }}" alt="Loading..." />
        </div>
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
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @yield('js')
    <script>
        $(document).ready(function () {
            number_bell();
            setInterval(number_bell, 5 * 60 * 1000);
        });
        function number_bell(){
            let url = "{{ route('fetchNotificationNumber') }}";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    $('#number_bell').html(response);
                }
            });
        }
        $('#bell').on('click', function() {
            let url = "{{ route('fetchNotification') }}";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function(response) {
                    $('#bell_detail').html(response);
                }
            });
        });
    </script>
</body>

</html>
