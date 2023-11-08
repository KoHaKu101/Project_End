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
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหาเจ้าหน้าที่" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">
                                <a href="{{ route('emp_insert') }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-plus"></i>
                                    เพิ่มข้อมูล
                                </a>
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
                                        <th scope="col" >ชื่อ-นามสกุล</th>
                                        <th scope="col" style="width: 15%">ตำแหน่ง</th>
                                        <th scope="col" style="width: 15%">เบอร์โทร</th>
                                        <th scope="col" style="width: 8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i=0; $i <=10;$i++)
                                    <tr>
                                        <td class="text-center">{{ $i+1 }}</td>
                                        <td>@php
                                            $isbn = "";
                                            for ($num = 0; $num < 12; $num++) {
                                                $isbn .= rand(0, 9);
                                            };
                                            echo $isbn;
                                        @endphp</td>
                                        <td>xxxxxxx</td>
                                        <td>เจ้าหน้าที่ฝ่ายบริการ</td>
                                        <td>0883004952</td>
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
@endsection()
