<div class="modal fade" id="modal_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">รับหนังสือ</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form action="#">
            <div class="row">
                <div class="col-lg-12">
                    <label>ชื่อหนังสือ</label>
                    <input type="text" class="form-control" placeholder="กรอกชื่อประเภทสื่อ">
                </div>
                <div class="col-lg-6">
                    <label>วันที่รับหนังสือ</label>
                    <input type="date" class="form-control" placeholder="กรอกชื่อประเภทสื่อ">
                </div>
                <div class="col-lg-6">
                    <label>ประเเภทการรับหนังสือ</label>
                      <select  class="form-select " >
                            <option selected>Select one</option>
                            <option value="">New Delhi</option>
                            <option value="">Istanbul</option>
                            <option value="">Jakarta</option>
                        </select>
                </div>
                <div class="col-lg-12">
                    <label>รายละเอียดเพิ่มเติม</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="col-lg-12">
                    <label>เจ้าหน้าที่ </label>
                    <input type="text" class="form-control" >
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
