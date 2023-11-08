
<div class="modal fade" id="request_media_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">รับคำขอสื่อ</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form action="#">
            <div class="row">
                <div class="col-lg-8">
                    <label>ชื่อหนังสือ</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อหนังสือ">
                </div>
                <div class="col-lg-4">
                    <label>สถานะ</label>
                    <input type="text" class="form-control" placeholder="กรอกสถานะ" disabled>
                </div>
                <div class="col-lg-6">
                    <label>ชื่อ</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อ">
                </div>
                <div class="col-lg-6">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" placeholder="กรอกนามสกุล">
                </div>
                <div class="col-lg-12">
                    <label>เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" placeholder="กรอกเบอร์โทรศัพท์">
                </div>
                <div class="col-lg-12">
                    <label>ประเภทสื่อ</label>
                      <select  class="form-select " >
                            <option selected>Select one</option>
                            <option value="">New Delhi</option>
                            <option value="">Istanbul</option>
                            <option value="">Jakarta</option>
                        </select>
                </div>

                <div class="col-lg-12">
                    <label>เจ้าหน้าที่ </label>
                    <input type="text" class="form-control"     >
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success"><i class="fas fa-plus me-1"></i>เพิ่มรายการ</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
