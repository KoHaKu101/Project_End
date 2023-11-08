@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายการ รับคำขอสื่อ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-11">
                                <form action="#">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหารายการรับคำขอสื่อ" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">

                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#request_media_insert">
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
                                        <th scope="col" style="width: 30%">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 8%">ประเภทสื่อ</th>
                                        <th scope="col" style="width: 10%">วันที่รับคำขอ</th>
                                        <th scope="col" style="width: 12%">เจ้าหน้าที่</th>
                                        <th scope="col" style="width: 12%">ผู้ขอรับสื่อ</th>
                                        <th scope="col" >สถานะ</th>
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
                                        <td>นายพิชิตชัย ธรรมชัย</td>
                                        <td>นายพิชิตชัย ธรรมชัย</td>
                                        @php
                                            $arr = array( "a"=>"สั่งผลิต","b"=>"รอผลิต", "c"=>"พร้อมจ่ายสื่อ", "d"=>"จ่ายสื่อเรียบร้อย" );
                                            shuffle($arr);
                                            echo "<td>".$arr[0]."</td>";
                                        @endphp
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @if($arr[0] == "สั่งผลิต")
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#order_insert">
                                                สั่งผลิต
                                            </button>
                                            @elseif ($arr[0] == "รอผลิต")
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                กำลังดำเนินการ
                                            </button>

                                            @elseif ($arr[0] == "พร้อมจ่ายสื่อ")
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#media_out_insert">
                                                จ่ายสื่อ
                                            </button>
                                            @else

                                            @endif


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
    @include('request_media.insert')
    @include('media_out.insert')
    @include('order.insert')



@endsection()
