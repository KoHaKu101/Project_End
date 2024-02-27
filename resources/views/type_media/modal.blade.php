<div class="modal fade" id="modal_TypeMedia_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('media_type.create') }}" method="POST" id="FormSubmit">
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">เพิ่มประเภทสื่อ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>คำนำหน้า ทะเบียนสื่อ</label>
                            <input type="text" class="form-control" id="head_number_media" name="head_number_media" placeholder="กรอกคำนำหน้า ทะเบียนสื่อ" required>
                            <p id="error_head_number_media" class="text-danger" hidden>กรุณาใส่คำนำหน้า ทะเบียนสื่อ</p>
                        </div>
                        <div class="col-lg-12">
                            <label>ชื่อประเภทสื่อ</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="กรอกชื่อประเภทสื่อ"required>
                            <p id="error_name" class="text-danger" hidden>กรุณาใส่ชื่อประเภทสื่อ</p>
                        </div>
                        <div class="col-lg-12">
                            <label>คำอธิบาย</label>
                            <textarea class="form-control" rows="2" id="desc" name="desc"required></textarea>
                            <p id="error_desc" class="text-danger" hidden>กรุณาใส่คำอธิบายประเภทสื่อ</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('submitBTN','FormSubmit')"><i
                            class="fas fa-plus me-1" id="icon"></i>เพิ่มรายการ</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
