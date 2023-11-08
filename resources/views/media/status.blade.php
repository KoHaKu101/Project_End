<div class="modal fade" id="status_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">อัพเดทสถานะ</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form action="#">
            <div class="row">
                <div class="col-lg-12">
                    <label>ชื่อหนังสือ</label>
                    <input type="text" class="form-control" disabled>
                </div>
                <div class="col-lg-12">
                    <label>สถานะ</label>
                    <select class="form-select">
                        <option selected>ตรวจเช็คเรียบร้อย</option>
                    </select>
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
