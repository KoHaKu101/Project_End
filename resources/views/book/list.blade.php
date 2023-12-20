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
                                <button class="btn btn-sm btn-success" onclick="OpenModal()">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มข้อมูล
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#tab_book" type="button" role="tab" aria-controls="tab_book" onclick="showTableBook()"
                                    aria-selected="true">หนังสือทั่วไป</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tab_newBook"
                                    type="button" role="tab" aria-controls="tab_newBook"  onclick="showTableBookNew()"
                                    aria-selected="false">หนังสือใหม่</button>
                            </li>
                        </ul>
                        <div class="tab-content" >
                            <div class="tab-pane fade show active" id="tab_book"role="tabpanel"aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    <table class="table table-bordered border-black" >
                                        <thead class="bg-grayCustom">
                                            <tr>
                                                <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                                <th scope="col">ชื่อหนังสือ</th>
                                                <th scope="col" style="width: 15%">หมวดหมู่หนังสือ</th>
                                                <th scope="col" style="width: 15%">เลข ISBN</th>
                                                <th scope="col" style="width: 15%">สถานะสำเนา</th>
                                                <th scope="col" style="width: 15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="TableBook">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="tab_newBook" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <table class="table table-bordered border-black" >
                                    <thead class="bg-grayCustom">
                                        <tr>
                                            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                            <th scope="col">ชื่อหนังสือ</th>
                                            <th scope="col" style="width: 15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="TableBookNew">
                                        {{-- @foreach ($ReceiveBookDesc as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $datalist->ReceiveBook->book_name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" onclick="OpenModalBookNew('{{$datalist->recd_id}}','{{$datalist->ReceiveBook->book_name}}')"><i class="fas fa-plus"></i>เพิ่มข้อมูล</button>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('copy_book.insert')
    @include('book.modal')
    @include('book.modalBookNew')

    <script>
        $(document).ready(function () {
            showTableBook();
        });
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function OpenModal() {
            var url = "{{ route('book.create') }}";
            var formSubmit = $('#FormSubmitBook');
            $('#modal-titleBook').text('เพิ่มหนังสือ');
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            $('#modal_Book_insert').modal('show');
        }
        function OpenModalBookNew(id,name){
            let urlcreate = "{{ route('bookNew.create', ['id' => ':id']) }}";
            urlcreate = urlcreate.replace(':id', id);
            let formSubmit = $('#FormNewBook');
            formSubmit.attr('action', urlcreate);
            $('#FormNewBook').find('input#name').val(name);
            $('#modal_BookNew_insert').modal('show');
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
                    $('#FormSubmitBook').attr('action', urlUpdate);
                    $('#modal_Book_insert').modal('show');
                    $('#modal-titleBook').text('แก้ไขข้อมูลหนังสือ');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });
        }

        function plusMinusBTN() {
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
        }

        function openModalCopy(type, id, name) {
            plusMinusBTN();
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
        function SubmitForm(form) {
            var form = $('#'+form);
            var btn = form.find('button#submitBTN');
            loadingButton(btn);
            form.submit();

        }
        function confirm_delete(id){
            let url = `{{route('book.delete',['id'=>':id'])}}`.replace(':id',id); ;
            alertConfirmDelete(url,'{{ csrf_token() }}');
        }
        function showTableBook(){
            const url = `{{route('book.fetchDataTableBook')}}`;
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function (response) {
                    $('#TableBook').html(response);
                }
            });
        }
        function showTableBookNew(){
            const url = `{{route('book.fetchDataTableBookNew')}}`;
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function (response) {
                    $('#TableBookNew').html(response);
                }
            });
        }
    </script>
@endsection()
