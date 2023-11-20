@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>ข้อมูลหนังสือทั่วไป</h3>
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
                                        <th scope="col" style="width: 15%">เลข ISBN</th>
                                        <th scope="col" style="width: 15%">สถานะสำเนา</th>
                                        <th scope="col" style="width: 15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $datalist->name }}</td>
                                            <td>{{ $datalist->TypeBook->name }}</td>
                                            <td>{{ $datalist->isbn }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $datalist->copyBook->amount > 0 ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $datalist->copyBook->amount > 0 ? 'มีสำเนา' : 'ยังไม่มี' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="editmodal('{{ $datalist->getKey() }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @if ($datalist->copyBook->amount == 0)
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        onclick="openModal('minus', '{{ $datalist->copyBook->copy_id }}', '{{ $datalist->name }}')">
                                                        <i class="fas fa-copy"></i>
                                                        เพิ่มสำเนา
                                                    </button>
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
    @include('copy_book.insert')
    @include('book.insert')
    <script>
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function createmodal() {
            let urlcreate = "{{ route('book.create') }}";
            let formSubmit = $('#FormSubmit');
            $('#modal-title').text('เพิ่มหนังสือ');
            formSubmit.attr('action', urlcreate);
            $('#modal_Book_insert').modal('show');
            formSubmit[0].reset();
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
        $(document).ready(function() {
            $('#increaseBtn').click(function() {
                var currentValue = parseInt($('#amount').val());
                $('#amount').val(currentValue + 1);
            });
            $('#decreaseBtn').click(function() {
                var currentValue = parseInt($('#amount').val());
                if (currentValue > 0) {
                    $('#amount').val(currentValue - 1);
                }
            });
        });

        function openModal(type, id, name) {
            // url สำหรับอัพเดทข้อมูลตาม id
            let urlcreate = "{{ route('book_copy.update', ['id' => ':id', 'math' => ':math']) }}";
            urlcreate = urlcreate.replace(':id', id).replace(':math', type);
            //ตัวแปรของ form
            let formSubmit = $('#FormSubmit');
            //เปลี่ยนคำบนหัว modal
            if (type === 'minus') {
                $('#modal-title').text('ลบสำเนา');
            } else {
                $('#modal-title').text('เพิ่มสำเนา');
            }
            // ลบค่าที่เคยกรอกไว้ทั้งหมด
            formSubmit[0].reset();
            //เอาชื่อหนังสือมาใส่ลงใน input
            $('#Book_name').val(name);
            //แก้ไข id ใน url modal
            formSubmit.attr('action', urlcreate);
            // เปิด Modal ขึ้นมา
            $('#copy_BookCopy_insert').modal('show');
        }
    </script>
@endsection()
