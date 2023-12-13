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
                            <label>ชื่อประเภทสื่อ</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="กรอกชื่อประเภทสื่อ">
                        </div>
                        <div class="col-lg-12">
                            <label>คำอธิบาย</label>
                            <textarea class="form-control" rows="2" id="desc" name="desc"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="submitBTN" onclick="loadingSubmit()"><i
                            class="fas fa-plus me-1" id="icon"></i>เพิ่มรายการ</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
