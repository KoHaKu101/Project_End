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
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-11">
                                <form action="#">
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
                            <div class="col-lg-1">

                                <button type="button" class="btn btn-sm btn-success" onclick="createModal_requestMedia()">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มรายการ
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#new_order" type="button" role="tab" aria-controls="new_order"
                                    onclick="tabsShow('new_order')" aria-selected="true">สั่งผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#wait_order"
                                    onclick="tabsShow('wait_order')" type="button" role="tab"
                                    aria-controls="wait_order" aria-selected="false">รอผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ready_out"
                                    onclick="tabsShow('ready_out')" type="button" role="tab" aria-controls="ready_out"
                                    aria-selected="false">พร้อมจ่าย</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#out_success"onclick="tabsShow('out_success')" type="button"
                                    role="tab" aria-controls="out_success" aria-selected="false">จ่ายเรียบร้อย</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="ex1-content">
                            <div class="col-lg-12">
                                <table class="table table-bordered border-black" >
                                    <thead class="bg-grayCustom">
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
                                    <tbody id="tableData">
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
    @include('request_media.modal')
    @include('media_out.insert')
    @include('order.modal')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>


    <script>
        const modalSelect_requestMedia = $('#request_media_modal');
        const modalSelect_order = $('#order_modal');
        const bookIdSelect = $('#book_id');
        const typeMediaIdSelect = $('#type_media_id');
        const fNameSelect = $('#f_name');
        const form = $('#FormRequestMedia');

        $(document).ready(function() {
            modalSelect_requestMedia.modal({
                backdrop: 'static',
                keyboard: false
            })
            modalSelect_order.modal({
                backdrop: 'static',
                keyboard: false
            })
            fetchDataTable(1);
        });
        bookIdSelect.add(typeMediaIdSelect).on('change', fetchStatus);
        fNameSelect.on('change', fetchLastName);

        function createModal_requestMedia() {
            const url = `{{ route('requestMedia.create') }}`;
            form.attr('action', url);
            $('#submitBTN').html(`<i class="fas fa-plus me-1"></i>เพิ่มรายการ`);
            modal_requestMedia('รับคำขอสื่อ');
        }

        function modal_requestMedia(title) {
            select2_BookId(modalSelect_requestMedia);
            select2_User(modalSelect_requestMedia);
            $('#titleModal').html(title);
            modalSelect_requestMedia.modal('show');
        }

        async function editModal_requestMedia(id) {
            const url = `{{ route('requestMedia.fetchDataEdit') }}`;
            const urlupdate = `{{ route('requestMedia.update', ['id' => ':id']) }}`.replace(':id', id);
            let btn = $('#btn_edit_'+id);
            form.attr('action', urlupdate);
            loadingButtonEdit('start',btn);
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
                loadingButtonEdit('success',btn);

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        modalSelect_requestMedia.on('hidden.bs.modal', function() {
            $('#book_id, #f_name').empty().select2('destroy').val(null).trigger('change');
            form[0].reset();
        });

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

                    $('#status').val(response);
                }
            } catch (error) {
                console.error('Error fetching status:', error);
            }
        }

        function tabsShow(tabName) {
            const statusMapping = {
                'new_order': 1,
                'ready_out': 2,
                'wait_order': 3,
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
                            text: item.f_name + ' ' + item.l_name
                        }))
                    }),
                    cache: true
                },
                placeholder: 'กรอกชื่อผู้ขอรับสื่อ',
                minimumInputLength: 1,
                dropdownParent: modalSelect_requestMedia,
                tags: true,
                templateResult: formatResult,
                templateSelection: formatSelection
            });

            function formatResult(result) {
                if (!result.id) {
                    return result.text;
                }
                return $('<span>' + result.text + '</span>');
            }

            // Custom function to format selections (input value)
            function formatSelection(selection) {
                return selection.text.split(' ')[0]; // Display only the first name
            }
        }

        function setSelected2(selectId, name, id) {
            const optionExists = selectId.find(":contains('" + name + "')").length > 0;
            selectId.val(name).trigger('change');

            if (!optionExists) {
                const newOption = new Option(name, id, true, true);
                selectId.append(newOption).trigger('change');
            }
        }

        function loadingButtonEdit(status,btn) {
            // const btn = $('#btn_edit');
            btn.attr('disabled', status === 'start').html(status === 'start' ? '<i class="fas fa-arrows-rotate fa-spin me-2"></i>' : '<i class="fas fa-edit"></i>');
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
