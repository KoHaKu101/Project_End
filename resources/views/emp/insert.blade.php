@extends('main_template/body')
@section('body')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header text-center">
                    <h3>เพิ่ม ข้อมูลเจ้าหน้าที่</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row" >
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อ</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">นามสกุล</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">รหัสประจำตัวประชาชน</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">วันเดือนปีเกิด</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">อายุ</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">สัญชาติ</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เพศ</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ตำแหน่ง</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ที่อยู่</label>
                                <textarea class="form-control form-control-sm" rows="5" ></textarea>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เบอร์โทร</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">Password</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary mx-2">
                        <i class="fas fa-save"></i>
                        บันทึก
                    </button>
                    <a href="{{ route('emp_list') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection()
