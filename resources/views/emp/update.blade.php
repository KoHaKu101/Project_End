@extends('main_template/body')
@section('body')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header text-center">
                    <h3>แก้ไข ข้อมูลเจ้าหน้าที่</h3>
                </div>
                <form method="POST" action="{{route('emp_update.post',['id'=>$id])}}" >
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label class="control-label">ชื่อ</label>
                                    <input type="text" class="form-control form-control-sm" id="f_name" name="f_name" required value="{{$data->f_name}}">
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">นามสกุล</label>
                                    <input type="text" class="form-control form-control-sm" id="l_name" name="l_name" required value="{{$data->l_name}}">
                                </div>
                                <div class="col-lg-2">
                                    <label class="control-label">รหัสประจำตัวประชาชน</label>
                                    <input type="text" class="form-control form-control-sm" id="id_card" name="id_card"
                                        maxlength="13"required value="{{$data->id_card}}">
                                </div>
                                <div class="col-lg-2">
                                    <label class="control-label">วันเดือนปีเกิด</label>
                                    <input type="date" class="form-control form-control-sm" id="birthday"
                                        name="birthday"required value="{{$data->birthday}}">
                                </div>
                                <div class="col-lg-2">
                                    <label class="control-label">อายุ</label>
                                    <input type="text" class="form-control form-control-sm" id="age" name="age"
                                        maxlength="3"required value="{{$data->age}}">
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label">เพศ</label>
                                    <select class="form-select form-select-sm" id="gender" name="gender" required>
                                        <option value="M"{{ $data->gender == "M" ? 'selected' : ''}}>ชาย</option>
                                        <option value="F"{{ $data->gender == "F" ? 'selected' : ''}}>หญิง</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label class="control-label" >ตำแหน่ง</label>
                                    <select class="form-select form-select-sm" id="status" name="status" required>
                                        <option selected>กรุณาเลือกตำแหน่ง</option>
                                        <option value="1"{{ $data->status == "1" ? 'selected' : ''}}>ฝ่ายผลิต</option>
                                        <option value="2"{{ $data->status == "2" ? 'selected' : ''}}>ฝ่ายบริการ</option>
                                    </select>
                                </div>
                                
                                <div class="col-lg-2">
                                    <label class="control-label">เบอร์โทร</label>
                                    <input type="text" class="form-control form-control-sm" id="tel" name="tel"
                                        maxlength="10"required value="{{$data->tel}}">
                                </div>
                                <div class="col-lg-2">
                                    <label class="control-label">Username</label>
                                    <input type="text" class="form-control form-control-sm" id="username" name="username"required value="{{$data->username}}">
                                </div>
                                <div class="col-lg-2">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control form-control-sm" id="password" name="password"  autocomplete="new-password">
                                </div>
                                <div class="col-lg-6">
                                    <label class="control-label">ที่อยู่</label>
                                    <textarea class="form-control form-control-sm" rows="5" id="address" name="address"required >{{$data->address}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary mx-2">
                            <i class="fas fa-save"></i>
                            บันทึก
                        </button>
                        <a href="{{ route('emp_list') }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                            ยกเลิก
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection()
