@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายการ ให้บริการสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <form action="{{route('mediaOut.list')}}">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" id="search_data" name="search_data" value="{{ $search_data }}"
                                            placeholder="ค้นหารายการให้บริการสื่อ">
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'0') }}" data-bs-toggle="tab"
                                    data-bs-target="#RequestProcess" type="button" role="tab"
                                    aria-controls="RequestProcess" aria-selected="true">ให้บริการสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'1') }}" data-bs-toggle="tab"
                                    data-bs-target="#requestMediaSuccess" type="button" role="tab"
                                    aria-controls="requestMediaSuccess" aria-selected="false">ให้บริการสื่อเรีบยร้อย</button>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content">
                                <div class="tab-pane fade {{ isActiveShow($active, '0') }} "
                                    id="RequestProcess"role="tabpanel" aria-labelledby="ex1-tab-1">
                                    <div class="col-lg-12" id="book-table">
                                        @include('media_out.tableRequestProcess')
                                    </div>
                                    {{ $requestMediaProcess->links('pagination::bootstrap-4', ['requestMediaProcess']) }}
                                </div>
                                <div class="tab-pane fade  {{ isActiveShow($active, '1') }}" id="requestMediaSuccess"
                                    role="tabpanel" aria-labelledby="ex1-tab-1">
                                    <div class="col-lg-12" id="bookNew-table">
                                        @include('media_out.tableRequestSuccess')
                                    </div>
                                    {{ $requestMediaSuccess->links('pagination::bootstrap-4', ['requestMediaSuccess']) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('media_out.modalConfirm')
    <script>
        const modalConfirm = $('#modalConfirm');
        const modalTitle = $('#modal_title');

        function showModalConfirm(id) {
            modalTitle.html('ให้บริการสื่อ');
            let urlAction = `{{ route('mediaOut.create', ['id' => ':id']) }}`.replace(':id', id);
            fetchData(id,urlAction,false);
        }

        function showModalDetail(id) {
            modalTitle.html('ข้อมูลการให้บริการสื่อ');
            fetchData(id,'',true);
        }
        function fetchData(id,urlAction,status){
            let url = `{{ route('mediaOut.fetchData') }}`;
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status == true) {
                        $('#submitBTN').attr('hidden', status);
                        $('#md_out_date').attr('disabled',status);
                        $('#form_modalConfirm').attr('action', urlAction);
                        let requestUser = data.requestUser;
                        $('#request_user_tel').val(requestUser.tel);
                        $('#request_user_name').val(requestUser.f_name + " " + requestUser.l_name);
                        $('#desc').val(data.requestMedia.desc);
                        $('#book_name').val(data.book_name);
                        $('#type_media').val(data.type_media);
                        $('#emp').val(data.emp);
                        modalConfirm.modal('show')
                    }
                }
            })
        }
        function showModalCancelRequset(id){
            let url = `{{route('mediaOut.cancelRequest',['id' => ':id'])}}`.replace(':id', id) ;
            fetchCancel(url)
        }
        function confirmCancel(id) {
            let url = `{{route('mediaOut.cancel',['id' => ':id'])}}`.replace(':id', id) ;
            fetchCancel(url)
        }
        function fetchCancel(url){
            Swal.fire({
                icon: 'warning',
                title: 'ต้องการยกเลิกรายการไหม ?',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#157347',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'ระบุเหตุผลในการยกเลิก',
                        input: "textarea",
                        showCancelButton: true,
                        confirmButtonText: 'ยืนยัน',
                        cancelButtonText: 'ยกเลิก',
                        confirmButtonColor: '#157347',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: "GET",
                                url: url,
                                dataType: "JSON",
                                data: {
                                    desc: result.value
                                },
                                success: function (response) {
                                    if(response.status){
                                        Swal.fire({
                                            icon: "Success",
                                            title: "ยกเลิกรายการสำเร็จ",
                                            }).then((result) => { location.reload() });
                                    }else{
                                        Swal.fire({
                                            icon: "Error",
                                            title: "เกิดข้อผิดพลาดกรุณาลองใหม่",
                                            }).then((result) => { location.reload() });
                                    }
                                },
                            });
                        }
                    });

                }
            })
        }
    </script>
@endsection()
