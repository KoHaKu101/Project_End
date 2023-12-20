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
                    <h3>รายการ รับหนังสือ</h3>
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
                                            placeholder="ค้นหารายการรับหนังสือ" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">

                                <button type="button" class="btn btn-sm btn-success"onclick='openModal()'>
                                    <i class="fas fa-plus"></i>
                                    รับหนังสือ
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered border-black" >
                                <thead class="bg-grayCustom">
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 15%">ประเภทการรับ</th>
                                        <th scope="col" style="width: 15%">วันที่รับ</th>
                                        <th scope="col" style="width: 15%">เจ้าหน้าที่ที่รับ</th>
                                        <th scope="col" style="width: 22%">รายละเอียดเพิ่มเติม</th>
                                        <th scope="col" style="width: 8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $datalist->ReceiveBook->book_name }}</td>
                                            @php
                                                $add_type = [1 => 'บริจาค', 2 => 'ซื้อ', 3 => 'กระทรวงศึกษา'];
                                                $carbonDate = Carbon\Carbon::parse($datalist->ReceiveBook->add_date);
                                                $thaiYear = $carbonDate->addYears(543)->format('d/m/Y');
                                                $emp = $datalist->ReceiveBook->Emp;
                                                $fullname = $emp->f_name . ' ' . $emp->l_name;
                                            @endphp
                                            <td>{{ $add_type[$datalist->ReceiveBook->add_type] }}</td>
                                            <td>{{ $thaiYear }}</td>
                                            <td>{{ $fullname }}</td>
                                            <td>{{ $datalist->desc }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-info"
                                                    onclick="editmodal('{{ $datalist->recv_id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirm_delete('{{ $datalist->recv_id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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
    @include('receive_book.modal')

    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

    <script>
        function openModal() {
            var fields = ['book_name', 'add_type', 'desc'];
            fields.forEach(function(field) {
                $('#' + field).prop('disabled', false);
            });
            $('#submitBTN').attr('hidden', false);
            var form = $('#form_modal_receive');
            var url = `{{ route('receive.create') }}`;
            let input_book_name = $(`<select id="book_name" name="book_name" ></select>`);
            form[0].reset();
            form.attr('action', url);
            $('#book_name').replaceWith(input_book_name);
            createSelect2();
            $('#modal_receive').modal('show');

        }
        function editmodal(id) {
            var url = `{{ route('receive.fetchData') }}`;
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    createSelect2();
                    $('#book_name').select2('destroy');
                    let input_book_name = $(`<input type="text" class="form-control form-control-sm" id="book_name" name="book_name" disabled>`);
                    $('#book_name').replaceWith(input_book_name);

                    var fields = ['book_name','add_date', 'add_type'];

                    fields.forEach(function(field) {
                        if (data.receive[field]) {
                            $('#' + field).prop('disabled', true);
                            $('#' + field).val(data.receive[field]);
                        }
                    });
                    $('#desc').prop('disabled', true);
                    $('#desc').val(data.desc);
                    $('#submitBTN').attr('hidden', true);
                    $('#emp').val(data.emp.f_name + ' ' + data.emp.l_name);
                    $('#modal_receive').modal('show');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });
        }

        function confirm_delete(id){
            let url = `{{route('receive.delete',['id'=>':id'])}}`.replace(':id',id); ;
            alertConfirmDelete(url,'{{ csrf_token() }}');
        }
        function createSelect2() {
            let url = `{{ route('media.fetchData.book') }}`;
            $('#book_name').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
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
                // cache: true,
                tags: true,
                // maximumSelectionLength:1,
                placeholder: 'ชื่อหนังสือ',
                // minimumInputLength: 1,
                dropdownParent: '#modal_receive',
            });
        }
    </script>
@endsection()
