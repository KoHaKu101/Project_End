@extends('main_template/body')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.css') }}">
    
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>สื่อสำหรับผู้พิการทางสายตา</h3>
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
                                            placeholder="ค้นหาหนังสือ" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-sm btn-success" onclick="createmodal()">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มข้อมูล
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 15%">หมวดหมู่หนังสือ</th>
                                        <th scope="col" style="width: 15%">ประเภทสื่อ</th>
                                        <th scope="col" style="width: 15%">สถานะการผลิต</th>
                                        <th scope="col" style="width: 15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <tr>
                                            <td class="text-center">{{ $i + 1 }}</td>
                                            <td>เพรชสังหาร</td>
                                            <td>นิยาย</td>
                                            <td>อักษรเบลล์</td>
                                            @php
                                                $arr = ['a' => 'กำลังผลิต', 'b' => 'ตรวจเช็คเรียบร้อย'];
                                                shuffle($arr);
                                                $color_status = ['กำลังผลิต' => 'bg-warning', 'ตรวจเช็คเรียบร้อย' => 'bg-success'];
                                                echo '<td><span class="badge ' . $color_status[$arr[0]] . '">' . $arr[0] . '</span></td>';
                                            @endphp

                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @if (Str::is('กำลังผลิต', $arr[0]))
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#status_insert">
                                                        อัพเดพสถานะ
                                                    </button>
                                                @endif

                                            </td>

                                        </tr>
                                    @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('media.status')
    @include('media.insert')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#modal_Book_insert').modal({backdrop: 'static', keyboard: false})  
        });
        function createmodal() {
            createSelect2();
            let url = "{{ route('book.create') }}";
            let formSubmit = $('#FormSubmit');
            formSubmit.attr('action', url);
            formSubmit[0].reset();

            $('#modal-title').text('เพิ่มหนังสือ');
            $('#modal_Book_insert').modal('show');
        }
        $('#book_id').on('change', function() {
            let book_id = $('#book_id').val();
            let url = `{{route('media.fetchData.bookType')}}`;
            $.ajax({
                type: "GET",
                url: url,
                data: {'book_id':book_id},
                dataType: "json",
                success: function (data) {
                    $('#book_type').val(data.name);
                }
            });
        });
        function createSelect2(){
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
                dropdownParent: '#modal_Book_insert',
            });
        }
        function editmodal(id) {
            let urlUpdate = "{{ route('book.update', ['id' => ':id']) }}";
            let urlFetch = "{{ route('book.fetchData') }}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    var fields = ['name', 'type_book_id', 'author', 'publisher', 'edition', 'year',
                        'original_page', 'isbn', 'level'
                    ];
                    fields.forEach(function(field) {
                        if (data[field]) {
                            $('#' + field).val(data[field]);
                        }
                    });
                    urlUpdate = urlUpdate.replace(':id', id);
                    $('#FormSubmit').attr('action', urlUpdate);
                    $('#modal-title').text('แก้ไขข้อมูลหนังสือ');
                    $('#modal_Book_insert').modal('show');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }
    </script>
@endsection()
