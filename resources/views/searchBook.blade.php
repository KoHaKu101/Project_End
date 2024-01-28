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
                                        <button type="button" onclick="openModal('{{$datalist->book_id}}')" class="btn btn-primary">ขอสื่อ</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
    <div class="modal fade" id="modalShowDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg   ">
            <form action="{{ route('book_type.create') }}" method="POST" id="FormSubmit">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >รายละเอียดหนังสือ : <label id="book_name"></label></h5>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>ชื่อหนังสือ : <label id="name_title"></label></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <img id="img_book" class="img-fluid" width="100%" style="border: 2px solid #000;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label><b>เรื่องย่อ</b> <br><label id="abstract"></label></label>
                                    </div>
                                    <div class="row py-3">
                                        <div class="col-lg-6">
                                            <label><b>หมวดหมู่หนังสือ :</b> <label id="book_type_title"></label></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><b>สำนักพิมพ์ :</b> <label id="publisher_title"></label></label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><b>จำนวนหน้าตัวพิมพ์ :</b> <label id="original_page_title"></label> หน้า</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 py-2">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>ข้อมูลหนังสือ</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table">
                                                    <tbody id="table_detail">
                                                    </tbody>
                                                  </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer" >
                        <button type="submit" class="btn btn-success" id="submitBTN" onclick="loadingSubmit()"><i class="fas fa-plus me-1" id="icon"></i>เพิ่มรายการ</button>
                        <button type="button" class="btn btn-danger"  data-bs-dismiss="modal"><i
                                class="fas fa-xmark me-2"></i>ยกเลิก</button>
                    </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script> --}}
    <script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        function openModal(id){
            $('#modalShowDetail').modal('show');
            fetchData(id);
        }
        function fetchData(id){
            $.ajax({
                type: "GET",
                url: "{{route('showBookDetail')}}",
                data: {id:id},
                dataType: "JSON",
                success: function (data) {
                    $('#book_name, #name_title').html(data.book.name);
                    $('#publisher_title').html(data.book.publisher);
                    $('#original_page_title').html(data.book.original_page);
                    $('#book_type,#book_type_title').html(data.book_type);
                    $('#abstract').html(data.book.abstract);
                    if(data.book.img_book != null){
                        $('#img_book').attr('src',"{{asset('assets/images/book')}}"+'/'+data.book.img_book);
                    }else{
                        $('#img_book').attr('src',"{{asset('assets/images/book_not_found.jpg')}}");
                    }
                    $('#table_detail').html(data.html)

                }
            });
        }
    </script>
</body>

</html>
