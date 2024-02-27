@extends('main_template/body')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.css') }}">
@endsection
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายการ สั่งผลิตสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{route('order.list')}}" class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="ค้นหาสื่อสำหรับผู้พิการทางสายตา"  id="search_data" name="search_data" value="{{ $search_data }}">
                                <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'0') }}" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab"
                                    aria-controls="order" aria-selected="false">รอสั่งผลิต</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'1') }}" data-bs-toggle="tab" data-bs-target="#OrderProcessWait" type="button" role="tab"
                                    aria-controls="OrderProcessWait" aria-selected="false">รอดําเนินการ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'2') }}" data-bs-toggle="tab" data-bs-target="#OrderProcess" type="button" role="tab"
                                    aria-controls="OrderProcess" aria-selected="false">กําลังผลิต</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'3') }}" data-bs-toggle="tab" data-bs-target="#OrderSuccess" type="button" role="tab" aria-controls="OrderSuccess"
                                    aria-selected="false">เสร็จสิ้นการผลิต</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content" >
                            <div class="tab-pane fade {{isActiveShow($active,'0')}} " id="order"role="tabpanel" aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('order.tableOrder')
                                </div>
                                {{$dataRequestMedia->links('pagination::bootstrap-4', ['RequestMedia'])}}
                            </div>
                            <div class="tab-pane fade {{isActiveShow($active,'1')}}" id="OrderProcessWait"role="tabpanel"aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('order.tableProcessWait')
                                </div>
                                {{$dataOrderProcessWait->links('pagination::bootstrap-4', ['OrderProcessWait'])}}
                            </div>
                            <div class="tab-pane fade {{isActiveShow($active,'2')}}" id="OrderProcess"role="tabpanel"aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('order.tableProcess')
                                </div>
                                {{$dataOrderProcess->links('pagination::bootstrap-4', ['OrderProcess'])}}
                            </div>
                            <div class="tab-pane fade {{isActiveShow($active,'3')}}" id="OrderSuccess"role="tabpanel"aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('order.tableSuccess')
                                </div>
                                {{$dataOrderSuccess->links('pagination::bootstrap-4', ['OrderSuccess'])}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('order.modal')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>


    <script>
        //เริ่มตั้งค่าตัวแปร
        const order_modal = $('#order_modal');

        $(document).ready(function() {

            order_modal.modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        function deleteshow(id) {
            Swal.fire({
                title: 'ต้องการลบจริงมั้ย ? ',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#157347',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = `{{ route('requestMedia.delete', ['id' => ':id']) }}`;
                    url = url.replace(':id', id);
                    $.ajax({
                        url: url,
                        method: 'get',
                        success: function(response) {
                            if (response == true) {
                                Swal.fire({
                                    title: 'ลบรายการสำเร็จ',
                                    icon: 'success',
                                    confirmButtonColor: '#157347',
                                    confirmButtonText: 'ยืนยัน',
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: 'ไม่สามารถลบได้เนื่องจากมีหนังสือใช้งานอยู่',
                                    icon: 'error',
                                    confirmButtonText: 'รับทราบ'
                                })
                            }

                        },
                        error: function(xhr, status, error) {

                        }
                    });
                }
            });
        }
        function modalOrder(id){
            let url = `{{route('order.fetchRequestMedia')}}`;
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id:id
                },
                dataType: "JSON",
                success: function (data) {
                    let urlAction = `{{route('order.create',['id' => ':id'])}}`.replace(':id',id);
                    $('#ISBN').val(data.book.isbn);
                    $('#book_name').val(data.book.name);
                    $('#type_book').val(data.typeBook.name);
                    $('#type_media').val(data.TypeMedia.name);
                    $('#form_order').attr('action',urlAction);
                    $('#submit_order,#btn_cancel').show();
                    $('#btn_close').hide();
                    order_modal.modal('show');
                }
            });
        }
        function modalDetail(id){
            let url = `{{route('order.fetchRequestMedia')}}`;
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id:id
                },
                dataType: "JSON",
                success: function (data) {
                    $('#ISBN').val(data.book.isbn);
                    $('#book_name').val(data.book.name);
                    $('#type_book').val(data.typeBook.name);
                    $('#type_media').val(data.TypeMedia.name);
                    $('#submit_order,#btn_cancel').hide();
                    $('#btn_close').show();
                    order_modal.modal('show');
                }
            });

        }
        function showModalCancelRequset(id){
            let url = `{{route('order.cancel',['id' => ':id'])}}`.replace(':id', id) ;
            fetchCancel(url)
        }
        function fetchCancel(url){
            Swal.fire({
                icon: 'warning',
                title: 'ต้องการยกเลิกรายการไหม ?',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#157347',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'ระบุเหตุผลในการยกเลิก',
                        input: "textarea",
                        showCancelButton: true,
                        confirmButtonText: 'ยืนยัน',
                        cancelButtonText: 'ยกเลิก',
                        confirmButtonColor: '#157347',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "GET",
                                url: url,
                                dataType: "JSON",
                                data: {
                                    desc: result.value
                                },
                                success: function (response) {
                                    if(response.status){
                                        Swal.fire({
                                            icon: "Success",
                                            title: "ยกเลิกรายการสำเร็จ",
                                            }).then((result) => { location.reload() });
                                    }else{
                                        Swal.fire({
                                            icon: "Error",
                                            title: "เกิดข้อผิดพลาดกรุณาลองใหม่",
                                            }).then((result) => { location.reload() });
                                    }
                                },
                            });
                        }
                    });

                }
            })
        }
        //จบ

    </script>
@endsection()
