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
                    <h3>รายการ รับคำขอสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                                <form action="#" class="col-lg-12">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="ค้นหารายการรับคำขอสื่อ" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ready_out"
                                    onclick="tabsShow('ready_out')" type="button" role="tab" aria-controls="ready_out"
                                    aria-selected="false">พร้อมให้บริการสื่อ</button>
                            </li><li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ready_out"
                                    onclick="tabsShow('ready_out')" type="button" role="tab" aria-controls="ready_out"
                                    aria-selected="false">พร้อมให้บริการสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ready_out"
                                    onclick="tabsShow('ready_out')" type="button" role="tab" aria-controls="ready_out"
                                    aria-selected="false">พร้อมให้บริการสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#out_success"onclick="tabsShow('out_success')" type="button"
                                    role="tab" aria-controls="out_success" aria-selected="false">ให้บริการสื่อเรียบร้อย</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content">
                            <div class="tab-pane fade {{ isActiveShow($active, '0') }} " id="tab_book"role="tabpanel"
                                aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12" id="book-table">
                                    @include('book.tableBook')
                                </div>
                                {{ $book->links('pagination::bootstrap-4', ['booksPage']) }}
                            </div>
                            <div class="tab-pane fade  {{ isActiveShow($active, '1') }}" id="tab_newBook" role="tabpanel"
                                aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12" id="bookNew-table">
                                    @include('book.tableNewBook')
                                </div>
                                {{ $receiveBookDesc->links('pagination::bootstrap-4', ['bookNewPage']) }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    @include('request_media.modal')
    @include('media_out.modalConfirm')
    @include('order.modal')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

    <script>
        const modalSelect_order = $('#order_modal');
        const bookIdSelect = $('#book_id');
        const typeMediaIdSelect = $('#type_media_id');
        const fNameSelect = $('#f_name');
        const form = $('#FormRequestMedia');

        $(document).ready(function() {
            modalSelect_order.modal({
                backdrop: 'static',
                keyboard: false
            })
            // fetchDataTable(2);
        });
        function tabsShow(tabName) {
            const statusMapping = {
                'ready_out': 2,
                'out_success': 4
            };
            fetchDataTable(statusMapping[tabName]);
        }

        function fetchDataTable(status) {
            const url = `{{ route('requestMedia.fetchDataTable', ['status' => ':status']) }}`.replace(':status', status);
            $.ajax({
                type: "GET",
                url,
                dataType: "JSON",
                success: (response) => $('#tableData').html(response)
            });
        }

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

        function createModal_order(id) {
            const url = `{{ route('order.fetchRequestMedia') }}`;
            $.ajax({
                type: "GET",
                url,
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status == 3) {
                        $('#btn_form_order').attr('hidden', true);
                    } else {
                        $('#btn_form_order').attr('hidden', false);
                    }
                    $('#order_modal_body').html(response.html);
                }
            });
            modalSelect_order.modal('show');
        }
    </script>
@endsection()
