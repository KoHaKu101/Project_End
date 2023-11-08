@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>จ่ายสำเนาหนังสือ</h3>
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
                                    จ่ายสำเนา
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%" class="text-center">ลำดับ</th>
                                        <th scope="col" style="width: 10%">ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 30%" >เจ้าหน้าที่ ที่จ่ายสำเนา</th>
                                        <th scope="col" style="width: 3%" >คงเหลือ</th>
                                        <th scope="col" style="width: 5%" >สถานะ</th>
                                        <th scope="col" style="width: 5%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <tr>
                                            <td class="text-center">{{ $i+1 }}</td>
                                            <td>นิยาย</td>
                                            <td >นายพิชิตชัย ธรรมชัย</td>
                                            <td >
                                                @php
                                                    $num = rand(0,10);
                                                    if($num == 0){
                                                        $color = "bg-danger";
                                                    }elseif ($num <= 5) {
                                                        $color = "bg-warning";
                                                    }else{
                                                        $color = "bg-primary";
                                                    }
                                                    echo '<span class="badge '.$color.' " style="font-size:16px">'.$num.'</span>';
                                                @endphp
                                            </td>

                                            <td >
                                                @php
                                                    $arrayText = array("a"=>"รอรับคืน","b"=>"รับคืนรียบร้อย","C"=>"ไม่มีการรับคืน");
                                                    shuffle($arrayText);
                                                    $arrayColor = array("รอรับคืน"=>"bg-danger","รับคืนรียบร้อย"=>"bg-success","ไม่มีการรับคืน"=>"bg-secondary");
                                                    echo '<span class="badge '.$arrayColor[$arrayText[0]].'"style="font-size:14px">'.$arrayText[0].'</span>';
                                                @endphp
                                            </td>
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
    @include('copy_book_out.insert')
    {{-- <script>
        $(document).ready(function() {
            $('#modal_insert').modal("show");
        } );
    </script> --}}
@endsection()
