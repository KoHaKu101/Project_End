<div class="modal fade" id="modal_TypeBook_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('book_type.create') }}" method="POST" id="FormSubmit">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">เพิ่มหมวดหมู่หนังสือ</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 py-2">
                            <label>ชื่อหมวดหมู่หนังสือ</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="กรอกชื่อหมวดหมู่หนังสือ">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="submitBTN" onclick="loadingSubmit()"><i class="fas fa-plus me-1" id="icon"></i>เพิ่มรายการ</button>
                    <button type="button" class="btn btn-danger"  data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
        </form>
    </div>
</div>
