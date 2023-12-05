<div class="modal fade" id="copy_BookCopy_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  method="POST" id="FormSubmit">
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">เพิ่มสำเนา</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <label>ชื่อหนังสือ</label>
                            <input type="text" class="form-control"  disabled value="นิยาย" id="Book_name">
                        </div>
                        <div class="col-lg-4">
                            <label>จำนวนสำเนา</label>
                            <div class="input-group ">
                                <button type="button" class="input-group-text " id="decreaseBtn"><i class="fas fa-minus"></i></button>
                                <input type="number" class="form-control text-center" value="1" id="amount" name="amount" inputmode="numeric">
                                <button type="button" class="input-group-text " id="increaseBtn"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('FormSubmit')"><i class="fas fa-save me-1"></i>บันทึก</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
        </div>
        </form>
    </div>
</div>
