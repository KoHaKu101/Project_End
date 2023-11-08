
<div class="modal fade" id="requestUser_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">จ่ายสื่อ</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form action="#">
            <div class="row">
                <div class="col-lg-12">
                    <label>รหัสบัตรประจำตัวประชาชน </label>
                    <input type="text" class="form-control" >
                </div>
                <div class="col-lg-6">
                    <label>ชื่อ</label>
                    <input type="text" class="form-control" placeholder="คำขอรับสื่อ">
                </div>
                <div class="col-lg-6">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" placeholder="กรอกสถานะ" >
                </div>
                <div class="col-lg-6">
                    <label>วัน/เดือน/ปีเกิด</label>
                    <input type="date" class="form-control" placeholder="กรอกสถานะ" >
                </div>
                <div class="col-lg-6">
                    <label>อายุ</label>
                    <input type="text" class="form-control" placeholder="กรอกสถานะ" >
                </div>
                <div class="col-lg-6">
                    <label>สัญชาติ</label>
                    <input type="text" class="form-control" placeholder="กรอกสถานะ" >
                </div>
                <div class="col-lg-6">
                    <label>เพศ</label>
                    <input type="text" class="form-control" placeholder="กรอกสถานะ" >
                </div>
                <div class="col-lg-6">
                    <label>เบอร์โทร</label>
                    <input type="text" class="form-control" placeholder="กรอกสถานะ" >
                </div>


            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success"><i class="fas fa-check me-1"></i>ยืนยัน</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
