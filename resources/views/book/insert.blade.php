@extends('main_template/body')
@section('body')
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header text-center">
                    <h3>เพิ่ม ข้อมูลหนังสือ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row" >
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อหนังสือ</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">หมวดหมู่หนังสือ</label>
                                <select class="form-select form-select-sm">
                                    <option>อักษรเบลล์</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อผู้แต่ง</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">สำนักพิมพ์</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">พิมพ์ครั้งที่</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ปีที่พิมพ์</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">จำนวนหน้าทั้งหมด</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เลข ISBN</label>
                                <input type="text" class="form-control form-control-sm" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ลำดับชั้นปี</label>
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
                    <a href="{{ route('book_list') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                        ยกเลิก
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection()
