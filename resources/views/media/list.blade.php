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
                    <h3>สื่อสำหรับผู้พิการทางสายตา</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="#" class="col-md-11">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="ค้นหาสื่อสำหรับผู้พิการทางสายตา" aria-label="ค้นหาหนังสือ"
                                    aria-describedby="basic-addon1">
                                <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                            </div>
                        </form>
                        <button class="btn btn-sm btn-success col-md-1" onclick="createmodal_media()">
                            <i class="fas fa-plus"></i> เพิ่มข้อมูล
                        </button>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item " role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#new_order" type="button" role="tab" aria-controls="new_order"
                                    onclick="tabsShowOrder()" aria-selected="true">รายการสั่งผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#process_order" onclick="tabShowMedia('process_order')" type="button"
                                    role="tab" aria-controls="wait_order"
                                    aria-selected="false">รายการสื่อกำลังผลิต</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#process_order"onclick="tabShowMedia('success_order')" type="button"
                                    role="tab" aria-controls="process_order"
                                    aria-selected="false">รายการสื่อผลิตเสร็จ</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="new_order" role="tabpanel"
                                aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    <table class="table table-bordered border-black">
                                        <thead class="bg-grayCustom">
                                            <tr>
                                                <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                                <th scope="col">ชื่อหนังสือ</th>
                                                <th scope="col" style="width: 8%">ประเภทสื่อ</th>
                                                <th scope="col" style="width: 10%">วันที่สั่งสื่อ</th>
                                                <th scope="col" style="width: 20%">เจ้าหน้าที่</th>
                                                <th scope="col" style="width: 16%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableDataRequestMedia">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="process_order" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    <table class="table table-bordered border-black">
                                        <thead class="bg-grayCustom">
                                            <tr>
                                                <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                                <th scope="col">ชื่อหนังสือ</th>
                                                <th scope="col" style="width: 11%">หมวดหมู่หนังสือ</th>
                                                <th scope="col" style="width: 8%">ประเภทสื่อ</th>
                                                <th scope="col" style="width: 10%">สถานะการผลิต</th>
                                                <th scope="col" style="width: 15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableDataMedia">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('media.status')
    @include('media.modal')
    @include('media.modalConfirm')

    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        const formSubmit = $('#FormSubmit');
        const modal_title = $('#modal-title');
        const modal_media = $('#modal_media');
        const input_type_media_id = $('#type_media_id');
        const modalSelect_order = $('#confirm_oder_modal');

        $(document).ready(function() {
            modal_media.modal({
                backdrop: 'static',
                keyboard: false
            })
            tabsShowOrder();
        });
        //Start function modal
        function createmodal_media() {
            const url = "{{ route('media.create') }}";
            const input_change = '<select id="book_id" name="book_id" ></select>';
            changeInput(input_change, false);
            setModal_Media('เพิ่มสื่อ', url);
            Select2_book();
            modal_media.modal('show');
        }

        function editmodal_media(id) {
            let urlUpdate = "{{ route('media.update', ['id' => ':id']) }}".replace(':id', id);
            const urlFetch = "{{ route('media.fetchData') }}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    //ตั้งค่าต่างๆ
                    setModal_Media('แก้ไขข้อมูลสื่อ', urlUpdate);
                    Select2_book();
                    $('#book_id').select2('destroy');
                    const input_change = $(
                        `<input type="text" class="form-control form-control-sm" id="book_id" name="book_id" disabled>`
                    );
                    changeInput(input_change, true);
                    //เริ่มกรอกข้อมูล
                    var fields = ['number', 'type_media_id', 'sound_sys', 'braille_page', 'amount_end',
                        'source', 'translator'
                    ];
                    fields.forEach(function(field) {
                        if (data.media_data[field]) {
                            $('#' + field).val(data.media_data[field]);
                        }
                    });
                    $('#book_type').val(data.book_type);
                    $('#book_id').val(data.book_name);
                    modal_media.modal('show');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }

        function show_ConfirmDataOrder(id) {
            const url = `{{ route('media.fetchDataConfirmOrder') }}`;
            $.ajax({
                type: "GET",
                url,
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#confirm_oder_modal_body').html(response);
                }
            });
            modalSelect_order.modal('show');
        }
        // function
        //End
        function setModal_Media(title, url) {
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            modal_title.text(title);
        }

        function changeInput(html, status) {
            const input_book = $('#book_id');
            input_book.replaceWith(html);
            input_type_media_id.attr('disabled', status);
        }
        $(document).on('change', '#book_id, #type_media_id', fetchDataInput);

        function fetchDataInput() {
            const [book_id, type_media_id] = [$('#book_id').val(), $('#type_media_id').val()];
            const url = `{{ route('media.fetchDataInput') }}`;
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    book_id,
                    type_media_id
                },
                dataType: "JSON",
                success: function(data) {
                    $('#book_type').val(data.typeBook)
                    $('#number').val(data.number)
                }
            });
        }
        //start funtion table
        function tabsShowOrder() {
            const url = `{{ route('media.fetchDataTableOrder') }}`;
            $.ajax({
                type: "GET",
                url,
                dataType: "JSON",
                success: (response) => $('#tableDataRequestMedia').html(response)
            });
        }

        function tabShowMedia(tabName) {
            const statusMapping = {
                'process_order': 1,
                'success_order': 2,
            };
            const status = statusMapping[tabName];
            let url = "{{ route('media.fetchDataTable', ['status' => ':status']) }}".replace(':status', status);
            $.ajax({
                type: "GET",
                url,
                dataType: "JSON",
                success: (response) => $('#tableDataMedia').html(response)
            });
        }
        //start function select2
        function Select2_book() {
            let url = `{{ route('media.fetchData.book') }}`;
            $('#book_id').select2({
                theme: 'bootstrap-5',
                containerCssClass: "select2--small",
                dropdownCssClass: "select2--small",
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.book_id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'ค้นหาหนังสือ',
                minimumInputLength: 1,
                dropdownParent: '#modal_media',
            });
        }
        //End
        function confirm_delete(id) {
            let url = `{{ route('media.delete', ['id' => ':id']) }}`.replace(':id', id);;
            alertConfirmDelete(url, '{{ csrf_token() }}');
        }
    </script>
@endsection()
