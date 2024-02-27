<style>
    hr{
        opacity: 1;
    }
</style>
<div class="modal fade" id="medai_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >อัพเดทสถานะ</h5>
        </div>
        <div class="modal-body" >
            <div id="body_status"></div>
            <hr/>
          <form id="form_modal_status" method="POST">
            @csrf
            <div class="row justify-content-end">
                <div class="col-lg-5">
                    <label>วันที่ตรวจเช็ค</label>
                    <input type="date" class="form-control" name="check_date" id="check_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="submit_status" onclick="SubmitForm('submit_status','form_modal_status')"><i class="fas fa-check me-1"></i>ตรวจเช็คเรียบร้อย</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
