@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายชื่อผู้มาขอรับสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                                <form action="{{route('requestUser.list')}}" method="GET" class="col-lg-12">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหารายชื่อผู้มาขอรับสื่อ" id="search_data" name="search_data" value="{{ $search_data }}">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                                {{-- <button type="button" class="btn btn-sm btn-success col-lg-1" onclick="createModal()" >
                                    <i class="fas fa-plus"></i>
                                    เพิ่มรายการ
                                </button> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered border-black" >
                                <thead class="bg-grayCustom">
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col" >ชื่อ - นามสกุล</th>
                                        {{-- <th scope="col" style="width: 5%"   class="text-center">เพศ</th> --}}
                                        {{-- <th scope="col" style="width: 5%"   class="text-center">อายุ</th> --}}
                                        <th scope="col" style="width: 10%"  class="text-center">เบอร์โทรศัพท์</th>
                                        <th scope="col" style="width: 14%"  class="text-center">รายการยังไม่สำเร็จ</th>
                                        <th scope="col" style="width: 10%"  class="text-center">จำนวนที่ขอสื่อ</th>
                                        <th scope="col" style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $datalist)
                                    @php
                                        $successNumber = $dataRequestMedia->where('requesters_id',$datalist->requesters_id)->count();
                                        $orderNumber = $dataRequestMedia->where('requesters_id',$datalist->requesters_id)->where('status','!=',4)->where('status','!=',5)->count();
                                        $gender = $datalist->gender == "M" ? 'ชาย' : ($datalist->gender == "F" ? 'หญิง' : '');

                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $data->firstItem() + $loop->index }}</td>
                                        <td>{{$datalist->f_name .' '. $datalist->l_name}} </td>
                                        {{-- <td class="text-center">{{$gender}}</td> --}}
                                        {{-- <td class="text-center">{{$datalist->age}}</td> --}}
                                        <td class="text-center">{{$datalist->tel}}</td>
                                        <td class="text-center">{{$orderNumber}} รายการ</td>
                                        <td class="text-center">{{$successNumber}} รายการ</td>
                                        <td>
                                            {{-- <button type="button" class="btn btn-sm btn-warning" onclick="editModal('{{$datalist->requesters_id}}')">
                                                <i class="fas fa-edit"></i>
                                            </button> --}}
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirm_delete('{{$datalist->requesters_id}}')">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    @endforeach

                            </table>
                            {{ $data->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('request_user.modal')
    <script>
        const modal_user = $('#requestUser_insert');
        const form_user = $('#form_requestUser');
        function createModal(){
            const urlCreate = `{{route('requestUser.create')}}`;
            $('#modal_requestUser').html('เพิ่มข้อมูลผู้มาขอรับสื่อ');
            form_user.attr('action',urlCreate);
            modal_user.modal('show');
        }
        function editModal(id){
            const url = `{{route('requestUser.fetchData',['id'=>':id'])}}`.replace(':id',id);
            const urlUpdate = `{{route('requestUser.update',['id'=>':id'])}}`.replace(':id',id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function (response) {
                    var fields = ['id_card', 'f_name', 'l_name', 'birthday', 'age', 'gender', 'tel'];
                    fields.forEach(function(field) {
                        if (response[field]) {
                        $('#' + field).val(response[field]);
                        }
                    });
                    $('#modal_requestUser').html('แก้ไขข้อมูลผู้มาขอรับสื่อ');
                    form_user.attr('action',urlUpdate);
                    modal_user.modal('show');
                }
            });
        }
        function confirm_delete(id){
            let url = `{{route('requestUser.delete',['id'=>':id'])}}`.replace(':id',id);
            alertConfirmDelete(url,'{{ csrf_token() }}');
        }
        modal_user.on('hidden.bs.modal', function() {
            form_user[0].reset();
        });
    </script>
@endsection()
