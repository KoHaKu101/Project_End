@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายการประเภทสื่อ</h3>
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
                                        <th scope="col" style="width: 20%">ชื่อประเภทสื่อ</th>
                                        <th scope="col" style="width: 50%">คำอธิบาย</th>
                                        <th scope="col" style="width: 8%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist )
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{$datalist->name}}</td>
                                            <td>{{$datalist->desc}}</td>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editmodal('{{$datalist->getKey()}}')">
                                                    <i class="fas fa-edit"></i>

                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirm_delete('{{$datalist->getKey()}}')">
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
    @include('type_media.modal')
    <script>
        //ปุ่มโหลด
        function loadingSubmit() {
            var button = $('#submitBTN');
            var icon = $('#icon');
            button.attr('disabled', 'disabled');
            button.html('<i class="fas fa-arrows-rotate fa-spin me-2"></i>กำลังเพิ่มรายการ');
            $('#FormSubmit').submit();
        }
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function createmodal(){
            let urlcreate = "{{route('media_type.create')}}";
            $('#modal-title').text('เพิ่มประเภทสื่อ');
            $('#name').val('');
            $('#desc').val('');
            $('#FormSubmit').attr('action',urlcreate);
            $('#modal_TypeMedia_insert').modal('show');
        }
        //ปุ่มแสดง modal สำหรับเพิ่มแก้ไข
        function editmodal(id) {
            let urlUpdate = "{{route('media_type.update',['id'=>':id'])}}";
            let urlFetch = "{{route('media_type.fetchData')}}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data:{'id':id},
                dataType: 'json',
                success: function(data) {
                    $('#name').val(data.name);
                    $('#desc').val(data.desc);
                    urlUpdate = urlUpdate.replace(':id', id);
                    $('#FormSubmit').attr('action',urlUpdate);
                    $('#modal-title').text('แก้ไขประเภทสื่อ');
                    var button = $('#submitBTN');
                    button.html('<i class="fas fa-save me-2"></i>บันทึก');
                    $('#modal_TypeMedia_insert').modal('show');

                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }
        function confirm_delete(id){
            let url = `{{route('media_type.delete',['id'=>':id'])}}`.replace(':id',id); ;
            alertConfirmDelete(url,'{{ csrf_token() }}');
        }
    </script>

@endsection()
