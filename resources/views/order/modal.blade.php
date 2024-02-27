
<div class="modal fade" id="order_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title_order">สั่งผลิตสื่อ</h5>
        </div>
        <div class="modal-body">
            <form method="POST" id="form_order">
                @csrf
            <div class="row">
                <div class="col-md-12">
                    <label>เลข ISBN</label>
                    <input type="text" class="form-control" id="ISBN" disabled>
                </div>
                <div class="col-md-12">
                    <label>ชื่อหนังสือ</label>
                    <input type="text" class="form-control" id="book_name" disabled>
                </div>
                <div class="col-md-6">
                    <label>ประเภทหนังสือ</label>
                    <input type="text" class="form-control" id="type_book" disabled>
                </div>
                <div class="col-md-6">
                    <label>ประเภทสื่อที่ต้องการ</label>
                    <input type="text" class="form-control" id="type_media" disabled>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="SubmitForm('submit_order','form_order')" id="submit_order"><i class="fas fa-plus me-1"></i>สั่งผลิตสื่อ</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_cancel"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_close" ><i class="fas fa-xmark me-2"></i>ออก</button>
        </div>
      </div>
    </div>
  </div>
