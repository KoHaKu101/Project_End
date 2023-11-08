@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายชื่อผู้มาขอรับสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-11">
                                <form action="#">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหารายชื่อผู้มาขอรับสื่อ" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">

                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#requestUser_insert">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มรายการ
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col" style="width: 45%">ชื่อ - นามสกุล</th>
                                        <th scope="col" style="width: 5%"   class="text-center">เพศ</th>
                                        <th scope="col" style="width: 5%"   class="text-center">อายุ</th>
                                        <th scope="col" style="width: 10%"  class="text-center">เบอร์โทรศัพท์</th>
                                        <th scope="col" style="width: 12%"  class="text-center">รายการยังไม่สำเร็จ</th>
                                        <th scope="col" style="width: 12%"  class="text-center">จำนวนที่ขอสื่อ</th>
                                        <th scope="col" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i=0; $i <=10;$i++)
                                    <tr>
                                        <td class="text-center">{{ $i+1 }}</td>
                                        <td>นายพิชิตชัย ธรรมชัย</td>
                                        <td class="text-center">ชาย</td>
                                        <td class="text-center">21</td>
                                        <td class="text-center">0883004952</td>
                                        <td class="text-center">{{ rand(1,100) }} รายการ</td>
                                        <td class="text-center">{{ rand(1,100) }} รายการ</td>
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
    @include('request_user.insert')

@endsection()
