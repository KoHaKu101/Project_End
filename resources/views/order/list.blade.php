@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายการ สั่งผลิตสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-11">
                                <form action="#">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหารายการจ่ายสื่อ" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">

                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#order_insert">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มรายการ
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
                                        <th scope="col" style="width: 35%">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 8%">ประเภทสื่อ</th>
                                        <th scope="col" style="width: 10%">วันที่สั่งผลิต</th>
                                        <th scope="col" style="width: 10%">วันที่ผลิตเสร็จ</th>
                                        <th scope="col" style="width: 12%">เจ้าหน้าที่</th>
                                        <th scope="col" style="width: 12%">สถานะ</th>
                                        <th scope="col" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i=0; $i <=10;$i++)
                                    <tr>
                                        <td class="text-center">{{ $i+1 }}</td>
                                        <td>เพรชสังหาร</td>
                                        <td>อักษรเบล</td>
                                        <td>14/02/2545</td>
                                        <td>14/02/2545</td>
                                        <td>นายพิชิตชัย ธรรมชัย</td>
                                        @php
                                            $arr = array( "a"=>"รอดำเนินการ", "b"=>"กำลังผลิต", "c"=>"เสร็จสิ้นการผลิต" );
                                            shuffle($arr);
                                            $color_status = array("รอดำเนินการ"=>"bg-danger", "กำลังผลิต"=>"bg-warning", "เสร็จสิ้นการผลิต"=>"bg-success");
                                            echo '<td><span class="badge '.$color_status[$arr[0]].'">'.$arr[0].'</span></td>';
                                        @endphp
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
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
    @include('order.insert')

@endsection()
