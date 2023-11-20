@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>ข้อมูลเจ้าหน้าที่</h3>
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
                                            placeholder="ค้นหาเจ้าหน้าที่" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-sm btn-success" onclick="createmodal()">
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
                                        <th scope="col" style="width: 15%">รหัสเจ้าหน้าที่</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col" style="width: 15%">ตำแหน่ง</th>
                                        <th scope="col" style="width: 15%">เบอร์โทร</th>
                                        <th scope="col" style="width: 8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $datalist->getKey() }}</td>
                                            <td>{{ $datalist->f_name . ' ' . $datalist->l_name }}</td>
                                            <td>{{ $statusArray[$datalist->status] }}</td>
                                            <td>{{ $datalist->tel }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editmodal('{{$datalist->getKey()}}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger">
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
    @include('emp.insert')
    <script>
        //ปุ่มโหลด
        function loadingSubmit() {
            var button = $('#submitBTN');
            var icon = $('#icon');
            button.attr('disabled', 'disabled');
            button.html('<i class="fas fa-arrows-rotate fa-spin me-2"></i>กำลังบันทึก');
            $('#FormSubmit').submit();
        }
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function createmodal() {
            let urlcreate = "{{ route('emp.create') }}";
            let formSubmit = $('#FormSubmit');
            $('#modal-title').text('เพิ่มข้อเจ้าหน้าที่');
            formSubmit.attr('action', urlcreate);
            $('#modal_Emp_insert').modal('show');
            formSubmit[0].reset();
        }
        function editmodal(id) {
            let urlUpdate = "{{route('emp.update',['id'=>':id'])}}";
            let urlFetch = "{{route('emp.fetchData')}}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data:{'id':id},
                dataType: 'json',
                success: function(data) {
                    var fields = ['f_name', 'l_name', 'id_card', 'birthday', 'age', 'gender', 'status', 'tel', 'username', 'address'];
                    fields.forEach(function(field) {
                        if (data[field]) {
                        $('#' + field).val(data[field]);
                        }
                    });
                    urlUpdate = urlUpdate.replace(':id', id);
                    $('#FormSubmit').attr('action',urlUpdate);
                    $('#modal-title').text('แก้ไขข้อมูลเจ้าหน้าที่');
                    $('#modal_Emp_insert').modal('show');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });
            
        }
    </script>
@endsection()
