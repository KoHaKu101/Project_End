<div class="modal fade" id="modal_Book_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" id="FormSubmit">
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">เพิ่มประเภทสื่อ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group row" >
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อหนังสือ</label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">หมวดหมู่หนังสือ</label>
                                <select class="form-select form-select-sm" id="type_book_id" name="type_book_id">
                                    @foreach ($type_book as $type_book_option)
                                        <option value="{{$type_book_option->getKey()}}">{{$type_book_option->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อผู้แต่ง</label>
                                <input type="text" class="form-control form-control-sm" id="author" name="author" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">สำนักพิมพ์</label>
                                <input type="text" class="form-control form-control-sm" id="publisher" name="publisher" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">พิมพ์ครั้งที่</label>
                                <input type="text" class="form-control form-control-sm" id="edition" name="edition" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ปีที่พิมพ์</label>
                                <input type="text" class="form-control form-control-sm" id="year" name="year" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">จำนวนหน้าทั้งหมด</label>
                                <input type="number" class="form-control form-control-sm" id="original_page" name="original_page" >
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เลข ISBN</label>
                                <input type="text" class="form-control form-control-sm" id="isbn" name="isbn" maxlength="13">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ลำดับชั้นปี</label>
                                <input type="text" class="form-control form-control-sm" id="level" name="level" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="submitBTN" onclick="loadingSubmit()"><i
                            class="fas fa-save me-1" id="icon"></i>บันทึก</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>