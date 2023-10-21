@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>สำเนาหนังสือ</h3>
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
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modal_insert">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มสำเนา
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
                                        <th scope="col" style="width: 50%">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 8%" class="text-center ">จำนวนคงเหลือ</th>
                                        <th scope="col" style="width: 8%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>นิยาย</td>
                                            <td class="text-center ">10</td>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>

                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endfor
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('copy_book.insert')
    {{-- <script>
        $(document).ready(function() {
            $('#modal_insert').modal("show");
        } );
    </script> --}}
@endsection()
