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

                                <button type="button" class="btn btn-sm btn-success" onclick="openModal()">
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
                                    data-bs-target="#new_order" type="button" role="tab" aria-controls="new_order" onclick="tabsShow('new_order')" 
                                    aria-selected="true">สั่งผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#wait_order" onclick="tabsShow('wait_order')"
                                    type="button" role="tab" aria-controls="wait_order"
                                    aria-selected="false">รอผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#ready_out" onclick="tabsShow('ready_out')"
                                    type="button" role="tab" aria-controls="ready_out"
                                    aria-selected="false">พร้อมจ่าย</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#out_success"onclick="tabsShow('out_success')"
                                    type="button" role="tab" aria-controls="out_success"
                                    aria-selected="false">จ่ายเรียบร้อย</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="new_order"
                                role="tabpanel"aria-labelledby="ex1-tab-1">
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
                                        <tbody id="tableData">
                                            @foreach ($dataRequestMedia->where('status', 1) as $datalist)
                                                <tr>
                                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                                    <td>{{ $datalist->Book->name }}</td>
                                                    <td>{{ $datalist->TypeMedia->name }}</td>
                                                    <td>{{ $datalist->request_date }}</td>
                                                    <td>{{ $datalist->Emp->f_name . ' ' . $datalist->Emp->l_name }}</td>
                                                    <td>{{ $datalist->RequestUser->f_name . ' ' . $datalist->RequestUser->l_name }}
                                                    </td>
                                                    @php
                                                        $text = [1 => 'สั่งผลิต', 2 => 'พร้อมจ่ายสื่อ', 3 => 'รอผลิต', 4 => 'จ่ายสื่อเรียบร้อย'];
                                                        echo '<td>' . $text[$datalist->status] . '</td>';
                                                    @endphp
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#order_insert">
                                                            สั่งผลิต
                                                        </button>
                                                        {{-- @if ($arr[0] == 'สั่งผลิต')
                                                            
                                                        @elseif ($arr[0] == 'รอผลิต')
                                                            <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                                กำลังดำเนินการ
                                                            </button>
                                                        @elseif ($arr[0] == 'พร้อมจ่ายสื่อ')
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                data-bs-toggle="modal" data-bs-target="#media_out_insert">
                                                                จ่ายสื่อ
                                                            </button>
                                                        @else
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endforeach
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
    @include('order.insert')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        function tabsShow(tabName){
            if(tabName==='new_order'){
                fetchDataTable(1);
            }else if(tabName === 'ready_out'){
                fetchDataTable(2);
            }else if(tabName === 'wait_order'){
                fetchDataTable(3);
            }else if(tabName === 'out_success'){
                fetchDataTable(4);
            }
            
            

        }
        function fetchDataTable(status){
            let url = `{{route('requestMedia.fetchDataTable', ['status' => ':status'])}}`;
            url = url.replace(':status', status);

            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function (response) {
                    $('#tableData').html(response);
                }
            });
        }
        function openModal() {
            let modalSelect = $('#request_media_modal');
            select2_BookId(modalSelect);
            select2_User(modalSelect);
            modalSelect.modal('show');
        }

        function fetchStatus() {
            let book_id = $('#book_id').val();
            let type_media_id = $('#type_media_id').val();
            if (book_id !== null) {
                let url = `{{ route('requestMedia.fetchStatus') }}`;
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        book_id: book_id,
                        type_media_id: type_media_id,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.result === 'true') {
                            $('#status').val('พร้อมจ่าย');
                        } else {
                            $('#status').val('สั่งผลิต');
                        }

                    }
                });
            }
        }

        function fetchLastName() {
            let requesters_id = $('#f_name').val();
            if (book_id !== null) {
                let url = `{{ route('requestMedia.fetchUserLastName') }}`;
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        requesters_id: requesters_id,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.l_name !== null) {
                            $('#l_name').val(response.l_name);
                        } else {
                            $('#l_name').val('');
                        }

                    }
                });
            }
        }
        $('#book_id').on('change', function() {
            fetchStatus();
        });
        $('#type_media_id').on('change', function() {
            fetchStatus();
        });
        $('#f_name').on('change', function() {
            fetchLastName();
        });

        function select2_BookId(modalSelect) {
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
                dropdownParent: modalSelect,
            });
        }

        function select2_User(modalSelect) {
            let url = `{{ route('requestMedia.fetchUser') }}`;
            $('#f_name').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.requesters_id,
                                    text: item.f_name
                                };
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'กรอกชื่อผู้ขอรับสื่อ',
                minimumInputLength: 1,
                dropdownParent: modalSelect,
                tags: true,
            });
        }

        function SubmitForm(form) {
            var form = $('#' + form);
            var btn = form.find('button#submitBTN');
            loadingButton(btn);
            form.submit();

        }
    </script>
@endsection()
