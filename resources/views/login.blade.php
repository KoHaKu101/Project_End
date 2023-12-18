<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.4.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <style>
        /* .card {
            min-width: 700px;
            position: absolute;

            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 0 !important;
        } */
        img {
            margin-top: 10%;
            width: 180px;
        }
        .input-group-text {
            width: 48px;
            text-align: center;
        }
        body{
            background: #A29BFE;
        }

    </style>
</head>

<body>

    @include('sweetalert::alert')
    <div class="wrapper">
        <div class="main">
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center mb-4">
                            <img src="{{ asset('assets/images/logo/LogoImg.png') }}" class="img-fluid rounded mx-auto d-block">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center  ">
                    <div class="col-md-5 ">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>เข้าสู่ระบบ</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login.post') }}" class="mb-4">
                                    @csrf
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user fa-xl"></i>
                                            </span>
                                        </div>
                                        <input id="username" type="text" class="form-control" name="username" required autofocus placeholder="ชื่อผู้ใช้งาน">
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-key fa-xl"></i>
                                            </span>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" required placeholder="รหัสผ่าน">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

</html>
