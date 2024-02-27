<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.4.2/css/all.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <title>SearchBook</title>
    <style>
        body {
            background-color: #A29BFE;
        }

        .not-found {
            min-height: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .col-3 .card {
            border-radius: 34px;

        }

        .card img {
            border-radius: 34px;
            height: 44vh;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main">
            <div class="content py-3">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="col-lg-2">
                                        <a href="{{ route('searchBook', ['search' => $search]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-arrow-left"></i> ย้อนกลับ
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-lg text-center">
                                            <h2>หนังสือ : {{ $dataBook->name }}</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @if ($dataBook->img_book != null)
                                                        <img id="img_book" class="img-fluid"
                                                            src="{{ asset('assets/images/book/' . $dataBook->img_book) }}"
                                                            width="100%" style="border: 2px solid #000;">
                                                    @else
                                                        <img id="img_book" class="img-fluid"
                                                            src="{{ asset('assets/images/book_not_found.jpg') }}"
                                                            width="100%" style="border: 2px solid #000;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <label><b>เรื่องย่อ</b></label>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <label style="text-indent: 35px;">{{ $dataBook->abstract }}</label>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 mb-3">
                                                        <label><b>หมวดหมู่หนังสือ :</b>
                                                            <label>{{ $dataBook->TypeBook->name }}</label></label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label><b>สำนักพิมพ์ :</b>
                                                            <label>{{ $dataBook->publisher }}</label></label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label><b>จำนวนหน้าตัวพิมพ์ :</b> <label
                                                                class="me-1">{{ $dataBook->original_page }}</label>หน้า</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-3">
                                                    <label><b>สื่อที่พร้อมให้บริการ</b></label>
                                                </div>
                                                <div class="col-lg-12">
                                                    @foreach ($dataMedia as $datalist)
                                                        {{-- datalist->media_id --}}
                                                    @endforeach
                                                    @foreach ($dataTypeMedia as $datalist)
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="modalShow('{{ $dataBook->book_id }}','{{ $datalist->type_media_id }}')">{{ $datalist->name }}</button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 py-2">
                                            <div class="card">
                                                <div class="card-header ">
                                                    <h3>รายละเอียดเพิ่มเติม</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table class="table">
                                                                <tbody>
                                                                    @php
                                                                        $bookFields = [
                                                                            'เลข ISBN' => $dataBook->isbn,
                                                                            'ภาษา' => $dataBook->language,
                                                                            'ผู้แต่ง/ผู้ประพันธ์' => $dataBook->author,
                                                                            'ชื่อเรื่อง' => $dataBook->name,
                                                                            'สำนักพิมพ์' => $dataBook->publisher,
                                                                            'จำนวนหน้าตัวพิมพ์' => $dataBook->original_page . ' หน้า',
                                                                            'ประเภทหนังสือ' => $dataBook->TypeBook->name,
                                                                            'บทคัดย่อ' => $dataBook->abstract,
                                                                            'ระดับชั้น' => $dataBook->level,
                                                                        ];
                                                                        $html = '';
                                                                        foreach ($bookFields as $label => $value) {
                                                                            $html .= "<tr><td width='25%'>$label</td><td>: $value</td></tr>";
                                                                        }
                                                                        echo $html;
                                                                    @endphp
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalShowDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header" id="modalHeader">
                </div>
                <div class="modal-body">
                    <table class="table" id="tableBody">
                    </table>
                    <hr>
                    <form method="POST" action="" id="form_requestMedia">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>ชื่อผู้ติดต่อ</label>
                                <input type="text" class="form-control" id="f_name" name="f_name" required
                                    placeholder="กรอกชื่อผู้ติดต่อ">
                                <p id="error_f_name" class="text-danger" hidden>กรุณาใส่ชื่อผู้ติดต่อ</p>
                            </div>
                            <div class="col-md-6">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" id="l_name" name="l_name" required
                                    placeholder="กรอกนามสกุล">
                                    <p id="error_l_name" class="text-danger" hidden>กรุณาใส่นามสกุล</p>
                            </div>
                            <div class="col-md-12">
                                <label>เบอร์โทร</label>
                                <input type="text" class="form-control" id="tel" name="tel" required
                                    placeholder="เบอร์โทร">
                                    <p id="error_tel" class="text-danger" hidden>กรุณาใส่เบอร์โทร</p>
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียดวิธีการรับสื่อที่ต้องการ</label>
                                <textarea class="form-control" rows="3" id="desc" name="desc" required
                                    placeholder="เช่น กรุณาส่งไปที่ Line 08x-xxxx-xxx"></textarea>
                                    <p id="error_desc" class="text-danger" hidden>กรุณาใส่รายละเอียดวิธีการรับสื่อที่ต้องการ</p>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="submitBTN"><i class="fas fa-plus me-1"
                            id="icon"></i>ส่งคำขอ</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
    <script src="{{ asset('assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/fontawesome-free-6.4.2/js/all.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script>
        const modalShowDedtail = $('#modalShowDetail');
        const form = $('#form_requestMedia');
        $(document).ready(function() {
            modalShowDedtail.modal({
                backdrop: 'static',
                keyboard: false
            })
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $('#submitBTN').on('click', function() {
            form.submit();
        })
        form.on('submit', function(event) {
            event.preventDefault();
            var isValid = true;
            form.find(
                'input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])'
            ).each(function() {
                let id_input = $(this).attr('id');
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    $('#' + id_input).addClass('input-error');
                    $('#' + id_input).removeClass('input-success');
                    $('#error_' + id_input).attr('hidden', false);
                } else {
                    $('#' + id_input).addClass('input-success');
                    $('#' + id_input).removeClass('input-error');
                    $('#error_' + id_input).attr('hidden', true);
                }
            });
            if (isValid) {
                let url = form.attr('action');
                let dataForm = form.serialize();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: dataForm,
                    dataType: "JSON",
                    processData: false,
                    success: function(response) {
                        if (response.status == true) {
                            Swal.fire({
                                title: 'ส่งคำขอสำเร็จ',
                                text: "ต้องการกลับหน้าหลักหรือไม่",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#157347',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'ใช่',
                                cancelButtonText: 'ไม่'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    modalShowDedtail.modal('hide');
                                    window.location.replace(
                                        `{{ route('searchBook', ['search' => $search]) }}`);
                                } else {
                                    modalShowDedtail.modal('hide');
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาด',
                                text: response.message,
                                icon: 'error',
                                confirmButtonColor: '#157347',
                                confirmButtonText: 'ตกลง',
                            }).then((result) => {});
                        }
                    }
                });
            }

        });

        // function modalShow(id) {
        //     let url = `{{ route('showBookDetail', ['id' => ':id']) }}`.replace(':id', id);
        //     $.ajax({
        //         type: "GET",
        //         url: url,
        //         dataType: "JSON",
        //         success: function(response) {
        //             if (response.status) {
        //                 let url_action = `route('requestMedia.create', ['id' => ':id']) }}`
        //                     .replace(':id', id);
        //                 $('#modalHeader').html(response.modalHeader);
        //                 $('#tableBody').html(response.tableBody);
        //                 form.attr('action', url_action);
        //                 modalShowDedtail.modal('show');
        //             } else {
        //                 Swal.fire("Error!", 'เกิดข้อผิดพลาด', "error");
        //             }
        //         }
        //     });
        // }
        function modalShow(id, typeMedia) {
            let url = `{{ route('showBookDetail', ['id' => ':id']) }}`.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    typeMedia: typeMedia
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status) {
                        let url_action =
                            `{{ route('requestMedia.create', ['bookId' => ':bookId', 'typeMediaId' => ':typeMedia']) }}`
                            .replace(':bookId', id).replace(':typeMedia', typeMedia);
                        $('#modalHeader').html(response.modalHeader);
                        $('#tableBody').html(response.tableBody);
                        form.attr('action', url_action);
                        modalShowDedtail.modal('show');
                    } else {
                        Swal.fire("Error!", 'เกิดข้อผิดพลาด', "error");
                    }
                }
            });
        }
    </script>
</body>

</html>
