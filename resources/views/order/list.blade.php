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
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-11">
                                <form action="#">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหารายการจ่ายสื่อ" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#order"
                                    onclick="tabsShowRequestMedia('order')" type="button" role="tab"
                                    aria-controls="order" aria-selected="false">สั่งผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#process_order"
                                    onclick="tabsShowOrder('wait_order')" type="button" role="tab"
                                    aria-controls="process_order" aria-selected="false">รอดําเนินการ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#process_order"
                                    onclick="tabsShowOrder('process_order')" type="button" role="tab"
                                    aria-controls="process_order" aria-selected="false">กําลังผลิต</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#process_order"
                                    onclick="tabsShowOrder('success_order')" type="button" role="tab" aria-controls="process_order"
                                    aria-selected="false">เสร็จสิ้นการผลิต</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="order"role="tabpanel"aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                                <th scope="col" style="width: 30%">ชื่อหนังสือ</th>
                                                <th scope="col" style="width: 8%">ประเภทสื่อ</th>
                                                <th scope="col" style="width: 10%">วันที่รับคำขอ</th>
                                                <th scope="col" style="width: 12%">เจ้าหน้าที่</th>
                                                <th scope="col" style="width: 12%">ผู้ขอรับสื่อ</th>
                                                <th scope="col">สถานะ</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableDataRequestMedia">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="process_order"role="tabpanel"aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                                <th scope="col" style="width: 35%">ชื่อหนังสือ</th>
                                                <th scope="col" style="width: 8%">ประเภทสื่อ</th>
                                                <th scope="col" style="width: 10%">วันที่สั่งผลิต</th>
                                                <th scope="col" style="width: 12%">เจ้าหน้าที่</th>
                                                <th scope="col" ></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableDataOrder">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('order.modal')
    @include('request_media.modal')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>


    <script>
        //เริ่มตั้งค่าตัวแปร
        const modalSelect_requestMedia = $('#request_media_modal');
        const modalSelect_order = $('#order_modal');
        const bookIdSelect = $('#book_id');
        const typeMediaIdSelect = $('#type_media_id');
        const fNameSelect = $('#f_name');
        const form = $('#FormRequestMedia');
        //จบการตั้งค่าตัวแปร

        $(document).ready(function() {
            modalSelect_requestMedia.modal({
                backdrop: 'static',
                keyboard: false
            })
            modalSelect_order.modal({
                backdrop: 'static',
                keyboard: false
            })
            tabsShowRequestMedia();
        });
        // เริ่ม เมื่อเลือกตัวเลือกให้เรียกโดยเงื่อไข ให้เรียก function ต่างๆ
        bookIdSelect.add(typeMediaIdSelect).on('change', fetchStatus);
        fNameSelect.on('change', fetchLastName);
        modalSelect_requestMedia.on('hidden.bs.modal', function() {
            $('#book_id, #f_name').empty().select2('destroy').val(null).trigger('change');
            form[0].reset();
        });
        //จบ

        //เริ่ม ตั้งค่า modal ของ requestMedia
        function modal_requestMedia(title) {
            select2_BookId(modalSelect_requestMedia);
            select2_User(modalSelect_requestMedia);
            $('#titleModal').html(title);
            modalSelect_requestMedia.modal('show');
        }
        //จบ
        //เริ่ม ตั้งค่า เปิด modal ของ requestMedia โดยอยู่ในส่วนของแก้ไขข้อมูล
        async function editModal_requestMedia(id) {
            const url = `{{ route('requestMedia.fetchDataEdit') }}`;
            const urlupdate = `{{ route('requestMedia.update', ['id' => ':id']) }}`.replace(':id', id);

            form.attr('action', urlupdate);
            loadingButtonEdit('start');
            try {
                const data = await $.ajax({
                    type: "GET",
                    url,
                    data: {
                        id
                    },
                    dataType: "JSON"
                });
                const [selectUser, selectBook] = [fNameSelect, bookIdSelect];
                $('#tel').val(data.requestUser.tel);
                typeMediaIdSelect.val(data.typeMedia);
                $('#emp_name').val(data.emp.f_name + ' ' + data.emp.l_name);

                await Promise.all([
                    setSelected2(selectUser, data.requestUser.f_name, data.requestUser.requesters_id),
                    setSelected2(selectBook, data.book.name, data.book.book_id),
                    fetchLastName(),
                    fetchStatus()
                ]);

                modal_requestMedia('แก้ไขข้อมูล');
                $(document).on('click', (e) => e.target.closest('.modal-content') || e.stopPropagation());
                $('#submitBTN').html(`<i class='fas fa-save'></i> บันทึก`);
                loadingButtonEdit('success');

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }
        //จบ

        // เริ่ม ประมวลผล เพื่อเติมข้อมูลลงใน นามสกุล และ สถานะ
        async function fetchLastName() {
            try {
                const requesters_id = fNameSelect.val();
                if (requesters_id !== null) {
                    const url = `{{ route('requestMedia.fetchUserLastName') }}`;
                    const response = await $.ajax({
                        type: "GET",
                        url,
                        data: {
                            requesters_id
                        },
                        dataType: "JSON"
                    });

                    $('#l_name').val(response.l_name || '');
                    $('#tel').val(response.tel || '');
                }
            } catch (error) {
                console.error('Error fetching last name:', error);
            }
        }
        async function fetchStatus() {
            try {
                const [book_id, type_media_id] = [bookIdSelect.val(), typeMediaIdSelect.val()];
                if (book_id !== null) {
                    const url = `{{ route('requestMedia.fetchStatus') }}`;
                    const response = await $.ajax({
                        type: "GET",
                        url,
                        data: {
                            book_id,
                            type_media_id
                        },
                        dataType: "JSON"
                    });

                    $('#status').val(response.result === 'true' ? 'พร้อมจ่าย' : 'สั่งผลิต');
                }
            } catch (error) {
                console.error('Error fetching status:', error);
            }
        }
        //จบ

        // เริ่ม แสดง ตารางข้อมูล
        function tabsShowRequestMedia(){
            const url = `{{ route('requestMedia.fetchDataTable', ['status' => 1]) }}`;
            $.ajax({
                type: "GET",
                url,
                dataType: "JSON",
                success: (response) => $('#tableDataRequestMedia').html(response)
            });
        }

        function tabsShowOrder(tabName){
            const statusMapping = {
                'wait_order': 1,
                'process_order': 2,
                'success_order': 3,
            };
            const status = statusMapping[tabName];
            const url = `{{route('order.tableData')}}`;
            $.ajax({
                type: "get",
                url: url,
                data: {status:status},
                dataType: "JSON",
                success: (response) => $('#tableDataOrder').html(response)
            });
        }
        //จบ
        //เริ่ม การตั้งค่า select2
        function select2_BookId() {
            const url = `{{ route('media.fetchData.book') }}`;
            bookIdSelect.select2({
                theme: 'bootstrap-5',
                containerCssClass: "select2--small",
                dropdownCssClass: "select2--small",
                ajax: {
                    url,
                    dataType: 'json',
                    delay: 250,
                    data: (params) => ({
                        term: params.term,
                        page: params.page
                    }),
                    processResults: (data) => ({
                        results: data.map((item) => ({
                            id: item.book_id,
                            text: item.name
                        }))
                    }),
                    cache: true
                },
                placeholder: 'ค้นหาหนังสือ',
                minimumInputLength: 1,
                dropdownParent: modalSelect_requestMedia,
            });
        }
        function select2_User() {
            const url = `{{ route('requestMedia.fetchUser') }}`;
            fNameSelect.select2({
                theme: 'bootstrap-5',
                ajax: {
                    url,
                    dataType: 'json',
                    delay: 250,
                    processResults: (data) => ({
                        results: data.map((item) => ({
                            id: item.requesters_id,
                            text: item.f_name
                        }))
                    }),
                    cache: true
                },
                placeholder: 'กรอกชื่อผู้ขอรับสื่อ',
                minimumInputLength: 1,
                dropdownParent: modalSelect_requestMedia,
                tags: true,
            });
        }
        function setSelected2(selectId, name, id) {
            const optionExists = selectId.find(":contains('" + name + "')").length > 0;
            selectId.val(name).trigger('change');

            if (!optionExists) {
                const newOption = new Option(name, id, true, true);
                selectId.append(newOption).trigger('change');
            }
        }
        //จบ
        //เริ่ม การตั้งค่า เมื่อกดปุ่มแก้ไข ให้ปุ่มแก้ไขแสดงไอคอน กำลังโหลด
        function loadingButtonEdit(status) {
            const btn = $('#btn_edit');
            btn.attr('disabled', status === 'start').html(status === 'start' ?
                '<i class="fas fa-arrows-rotate fa-spin me-2"></i>' : '<i class="fas fa-edit"></i>');
        }
        //จบ
        //เริ่ม แสดงข้อความเพื่อยืนยันการลบ
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
        //จบ
        //เริ่ม เปิด modal ของ order
        function createModal_order(id) {
            const url = `{{ route('order.fetchRequestMedia') }}`;
            $.ajax({
                type: "GET",
                url,
                data: {id:id},
                dataType: "JSON",
                success: function(response) {
                    if(response.status == 3){
                        $('#btn_form_order').attr('hidden',true);
                    }else{
                        $('#btn_form_order').attr('hidden',false);
                    }
                    $('#order_modal_body').html(response.html);
                }
            });
            modalSelect_order.modal('show');
        }
        //จบ

    </script>
@endsection()
