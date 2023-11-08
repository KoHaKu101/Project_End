@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>สื่อสำหรับผู้พิการทางสายตา</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-11">
                                <form action="#">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" placeholder="ค้นหาหนังสือ" aria-label="Username" aria-describedby="basic-addon1" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-1">
                                <a href="{{ route('media_insert') }}" class="btn btn-sm btn-success">
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
                                        <th scope="col">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 15%">หมวดหมู่หนังสือ</th>
                                        <th scope="col" style="width: 15%">ประเภทสื่อ</th>
                                        <th scope="col" style="width: 15%">สถานะการผลิต</th>
                                        <th scope="col" style="width: 15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i=0; $i <=10;$i++)
                                    <tr>
                                        <td class="text-center">{{ $i+1 }}</td>
                                        <td>เพรชสังหาร</td>
                                        <td>นิยาย</td>
                                        <td>อักษรเบลล์</td>
                                        @php
                                            $arr = array( "a"=>"กำลังผลิต", "b"=>"ตรวจเช็คเรียบร้อย");
                                            shuffle($arr);
                                            $color_status = array("กำลังผลิต"=>"bg-warning", "ตรวจเช็คเรียบร้อย"=>"bg-success");
                                            echo '<td><span class="badge '.$color_status[$arr[0]].'">'.$arr[0].'</span></td>';
                                        @endphp

                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @if (Str::is("กำลังผลิต",$arr[0]))
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#status_insert">
                                                อัพเดพสถานะ
                                            </button>
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
    @include('media.status')
@endsection()
