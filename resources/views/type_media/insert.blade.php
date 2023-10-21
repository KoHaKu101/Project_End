<div class="modal fade" id="modal_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มประเภทสื่อ</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form action="#">
            <div class="row">
                <div class="col-lg-12">
                    <label>ชื่อประเภทสื่อ</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อประเภทสื่อ">
                </div>
                <div class="col-lg-12">
                    <label>คำอธิบาย</label>
                    <textarea class="form-control"  rows="2"></textarea>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
          <button type="button" class="btn btn-success"><i class="fas fa-plus me-1"></i>เพิ่มรายการ</button>
        </div>
      </div>
    </div>
  </div>
