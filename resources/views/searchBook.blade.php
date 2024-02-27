<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.4.2/css/all.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <title>SearchBook</title>
    <style>
        body {
            background-color: #A29BFE;
        }

        .searchCenter {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .not-found {
            min-height: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-search {
            width: 80%;
            display: block;
            margin-top: 0em;
            margin-block-end: 1em;
            margin-bottom: 10em;
        }

        .title-serach {
            margin-bottom: 20px;
        }

        .form-control,
        .btn-search {
            border-radius: 34px;
            background-color: #ffffff;
            border-color: #ffffff;
        }

        .title-serach {
            margin-bottom: 50px;
        }

        .col-3 .card {
            border-radius: 34px;

        }
        .card img{
            border-radius: 34px;
            height: 44vh;
        }
    </style>
</head>

<body>

    @if ($dataBook == null)
        <div class="searchCenter">
            <form method="GET" action="{{ route('searchBook') }}" class="form-search">
                @csrf
                <h1 class="text-center text-white title-serach">
                    ค้นหาหนังสือ
                </h1>
                <div class="row">
                    <div class="col input-group">
                        <input type="text" class="form-control form-control-lg" id="search"name="search"
                            placeholder="Search books..." value="{{ $search }}">
                        <button class="btn btn-outline-secondary btn-search" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="container mt-5">
            <div class="row py-2">
                <div class="col">
                    <form method="GET" action="{{ route('searchBook') }}">
                        @csrf
                        <h1 class="text-center text-white title-serach">
                            ค้นหาหนังสือ
                        </h1>
                        <div class="row">
                            <div class="col input-group">
                                <input type="text" class="form-control form-control-lg" id="search"name="search"
                                    placeholder="Search books..." value="{{ $search }}">
                                <button class="btn btn-outline-secondary btn-search" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @if($dataBook->count() == 0)
                <div class="text-center text-white not-found" >
                    <h1>ไม่พบข้อมูล</h1>
                </div>
                @endif
                @foreach($dataBook as $datalist)
                    <div class="col-3 py-2">
                        <div class="card">
                            @if($datalist->img_book == null)
                                <img src="{{ asset('assets/images/book_not_found.jpg') }}">
                            @else
                                <img src="{{ asset('assets/images/book/'.$datalist->img_book.'') }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">หนังสือ : {{$datalist->name}}</h5>
                                <p class="card-text">
                                    isbn : {{$datalist->isbn}} <br>
                                    ชื่อผู้แต่ง : {{$datalist->author}} <br>
                                    สำนักพิมพ์ : {{$datalist->publisher}} <br>
                                    พิมพ์ครั้งที่ : {{$datalist->edition}} <br>
                                    ปีที่พิมพ์ : {{$datalist->year}} <br>
                                    จำนวนหน้า : {{$datalist->original_page}} <br>
                                    หมวดหมู่ : {{$datalist->TypeBook->name}}
                                </p>
                                    <div class="text-center">
                                        <a href="{{route('searchBookDetail',['id' => $datalist->book_id,'search' => $search])}}" class="btn btn-primary"><i class="fas fa-magnifying-glass me-2"></i>ดูข้อมูลเพิ่มเติม</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script> --}}
    <script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

</body>

</html>
