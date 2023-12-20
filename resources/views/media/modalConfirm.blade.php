<div class="modal fade" id="confirm_oder_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">รายการสั่งผลิตสื่อ</h5>
          <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"id="confirm_oder_modal_body">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="SubmitForm('form_confirmOrder')" ><i class="fas fa-check me-1"></i>รับคำสั่งผลิต</button>
            <button type="button" class="btn btn-danger" onclick="CancelForm('form_confirmOrder')"><i class="fas fa-xmark me-2"></i>ยกเลิกรายการ</button>
        </div>
      </div>
    </div>
  </div>
