@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>หมวดหมู่หนังสือ</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                                <form action="#"class="col-lg-11">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="ค้นหาหมวดหมู่หนังสือ" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-sm btn-success col-lg-1" onclick="createmodal()">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มข้อมูล
                                </button>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered border-black" >
                                <thead class="bg-grayCustom">
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col">ชื่อหมวดหมู่หนังสือ</th>
                                        <th scope="col" style="width: 8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $datalist->name }}</td>
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
    @include('type_book.modal')
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
            let urlcreate = "{{route('book_type.create')}}";
            $('#FormSubmit').attr('action',urlcreate);
            $('#modal-title').text('เพิ่มหมวดหมู่หนังสือ');
            $('#name').val('');
            $('#modal_TypeBook_insert').modal('show');
        }
        //ปุ่มแสดง modal สำหรับเพิ่มแก้ไข
        function editmodal(id) {
            let urlUpdate = "{{route('book_type.update',['id'=>':id'])}}";
            let urlFetch = "{{route('book_type.fetchData')}}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data:{'id':id},
                dataType: 'json',
                success: function(data) {
                    $('#name').val(data.name);
                    $('#modal_TypeBook_insert').modal('show');
                    urlUpdate = urlUpdate.replace(':id', id);
                    $('#modal-title').text('แก้ไขหมวดหมู่หนังสือ');
                    var button = $('#submitBTN');
                    button.html('<i class="fas fa-save me-2"></i>บันทึก');
                    $('#FormSubmit').attr('action',urlUpdate);
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }
        function confirm_delete(id){
            let url = `{{route('book_type.delete',['id'=>':id'])}}`.replace(':id',id); ;
            alertConfirmDelete(url,'{{ csrf_token() }}');
        }
    </script>
@endsection()
