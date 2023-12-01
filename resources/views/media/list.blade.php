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
                                    @foreach ($dataMedia as $dataMedialist)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $dataMedialist->Book->name }}</td>
                                            <td>{{ $dataMedialist->Book->TypeBook->name }}</td>
                                            <td>{{ $dataMedialist->TypeMedia->name }}</td>
                                            @php
                                                $statusNumber = $dataMedialist->status;
                                                $statusArray = [1 => 'กำลังผลิต', 2 => 'ตรวจเช็คเรียบร้อย'];
                                                $color_status = [1 => 'bg-warning', 2 => 'bg-success'];
                                                $statusBadge = '<span class="badge ' . $color_status[$statusNumber] . ' text-dark" >' . $statusArray[$statusNumber] . '</span>';
                                            @endphp
                                            <td>{!! $statusBadge !!}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="editmodal('{{ $dataMedialist->media_id }}')"><i
                                                        class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                                @if ($statusNumber == 1)
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary"data-bs-toggle="modal"
                                                        data-bs-target="#status_insert">อัพเดพสถานะ</button>
                                                @endif
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
    @include('media.status')
    @include('media.modal')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#modal_Book_insert').modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        function createmodal() {
            let url = "{{ route('media.create') }}";
            let formSubmit = $('#FormSubmit');
            let input_book_id = $(`<select id="book_id" name="book_id" ></select>`);
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            $('#modal-title').text('เพิ่มสื่อ');
            $('#modal_media').modal('show');
            $('#book_id').replaceWith(input_book_id);

            $('#type_media_id').prop('disabled', false);
            createSelect2();
            function fetchData(url, params, successCallback) {
                $.ajax({
                    type: "GET",
                    url: url,
                    data: params,
                    dataType: "json",
                    success: successCallback
                });
            }

            function showBookType(book_id) {
                let url = `{{ route('media.fetchData.bookType') }}`;
                fetchData(url, {
                    'book_id': book_id
                }, function(data) {
                    $('#book_type').val(data.name);
                });
            }

            function showNumber(book_id, type_media_id) {
                let url = `{{ route('media.fetchData.number') }}`;
                fetchData(url, {
                    'book_id': book_id,
                    'type_media_id': type_media_id
                }, function(number) {
                    $('#number').val(number);
                });
            }

            $('#book_id').on('change', function() {
                let book_id = $('#book_id').val();
                let type_media_id = $('#type_media_id').val();
                showBookType(book_id);
                showNumber(book_id, type_media_id);
            });

            $('#type_media_id').on('change', function() {
                let type_media_id = $('#type_media_id').val();
                let book_id = $('#book_id').val();
                showNumber(book_id, type_media_id);
            });
        }

        function editmodal(id) {
            let urlUpdate = "{{ route('media.update', ['id' => ':id']) }}";
            let urlFetch = "{{ route('media.fetchData') }}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    createSelect2();
                    $('#book_id').select2('destroy');
                    let input_book_id = $(`<input type="text" class="form-control form-control-sm" id="book_id" name="book_id" disabled>`);
                    $('#book_id').replaceWith(input_book_id);
                    urlUpdate = urlUpdate.replace(':id', id);
                    $('#type_media_id').prop('disabled', true);
                    $('#modal-title').text('แก้ไขข้อมูลสื่อ');
                    $('#FormSubmit').attr('action', urlUpdate);
                    var fields = ['number', 'type_media_id', 'sound_sys', 'braille_page', 'amount_end',
                        'source', 'translator'
                    ];
                    fields.forEach(function(field) {
                        if (data.media_data[field]) {
                            $('#' + field).val(data.media_data[field]);
                        }
                    });

                    $('#modal_media').modal('show');

                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }



        function createSelect2() {
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
                // minimumInputLength: 1,
                dropdownParent: '#modal_media',
            });
        }
    </script>
@endsection()
