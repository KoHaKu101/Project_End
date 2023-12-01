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
                    <h3>จ่ายสำเนาหนังสือ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row ">
                            <div class="col-lg-11">
                                <form action="#">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหาเจ้าหน้าที่" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">
                                    <button type="button" class="btn btn-sm btn-success" onclick="OpenModal()">
                                    <i class="fas fa-plus"></i>
                                    จ่ายสำเนา
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%" class="text-center">ลำดับ</th>
                                        <th scope="col" style="width: 10%">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 30%" >เจ้าหน้าที่ ที่จ่ายสำเนา</th>
                                        <th scope="col" style="width: 3%" class="text-center">จำนวน</th>
                                        <th scope="col" style="width: 5%" >สถานะ</th>
                                        <th scope="col" style="width: 5%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist )
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td>{{ $datalist->CopyBook->Book->name }}</td>
                                        <td>{{ $datalist->Emp->f_name.' '.$datalist->Emp->l_name }}</td>
                                        <td class="text-center">{{ $datalist->amount }}</td>
                                        <td>
                                            <span class="badge bg-{{ $datalist->status === 1 ? 'danger' : ($datalist->status === 2 ? 'success' : 'secondary') }}" style="font-size:14px">
                                                {{ $datalist->status === 1 ? 'รอรับคืน' : ($datalist->status === 2 ? 'รับคืนรียบร้อย' : 'ไม่มีการรับคืน') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($datalist->status === 1)
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editmodal('{{$datalist->copyout_id}}')">รับคืน</button>
                                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
    @include('copy_book_out.modal')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function OpenModal() {
            // สร้างช่องใส่ bookid 
            let input_book_id = $(`<select id="book_id" name="book_id" ></select>`);
            $('#book_id').replaceWith(input_book_id);
            createSelect2();
            btnAdd();
            //modal
            $('#modal-title-CopyBookOut').text('จ่ายสำเนา');
            var formSubmit = $('#FormSubmit');
            var url = "{{ route('book_copy_out.create') }}";
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            $('#modal_CopyBookOut').modal('show');
        }
        function editmodal(id) {
            let urlUpdate = "{{ route('book_copy_out.update', ['id' => ':id']) }}";
            let urlFetch = "{{ route('book_copy_out.fetchData') }}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    var fields = ['amount', 'emp_name'];
                    fields.forEach(function(field) {
                        if (data.CopyBookOut[field]) {
                            $('#' + field).val(data.CopyBookOut[field]);
                        }
                    });
                    urlUpdate = urlUpdate.replace(':id', id);
                    $('#FormSubmit').attr('action', urlUpdate);
                    createSelect2();
                    btnRecive();
                    $('#book_id').select2('destroy');
                    let input_book_id = $(`<input type="text" class="form-control " id="book_id" name="book_id" disabled>`);
                    $('#book_id').replaceWith(input_book_id);
                    $('#book_id').val(data.Book.name);
                    $('#modal_CopyBookOut').modal('show');
                    $('#modal-title-CopyBookOut').text('แก้ไขข้อมูลจ่ายสำเนา');

                },
                error: function() {
                    console.error('Error fetching data');
                }
            });
        }
        function btnRecive(){
            let btn = $('#submitBTN');
            btn.addClass('btn-warning').text('รับคืน');
        }
        function btnAdd(){
            let btn = $('#submitBTN');
            btn.removeClass('btn-warning');
            btn.html('<i class="fas fa-plus me-2"></i>เพิ่มรายการ');
            
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
                minimumInputLength: 1,
                dropdownParent: '#modal_CopyBookOut',
            });
        }
    </script>
@endsection()
