<div class="modal fade" id="modal_Book_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" id="FormSubmitBook">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-titleBook" id="modal-title">เพิ่มหนังสือ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อหนังสือ</label>
                                <input type="text" class="form-control form-control-sm" id="name"
                                    name="name">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">หมวดหมู่หนังสือ</label>
                                <select class="form-select form-select-sm" id="type_book_id" name="type_book_id">
                                    @foreach ($type_book as $type_book_select)
                                        <option value="{{ $type_book_select->type_book_id }}">
                                            {{ $type_book_select->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อผู้แต่ง</label>
                                <input type="text" class="form-control form-control-sm" id="author"
                                    name="author">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">สำนักพิมพ์</label>
                                <input type="text" class="form-control form-control-sm" id="publisher"
                                    name="publisher">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">พิมพ์ครั้งที่</label>
                                <div class="input-group input-group-sm ">
                                    <span class="input-group-text">ครั้งที่</span>
                                    <input type="text" class="form-control form-control-sm" id="edition" name="edition" oninput="InputOnlyNumber(this)">
                                  </div>

                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ปีที่พิมพ์</label>
                                <div class="input-group input-group-sm ">
                                    <span class="input-group-text">พ.ศ.</span>
                                    <input type="text" class="form-control form-control-sm" id="year" name="year"oninput="InputOnlyNumber(this)">
                                  </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">จำนวนหน้าทั้งหมด</label>
                                <div class="input-group input-group-sm ">
                                    <input type="number" class="form-control form-control-sm" id="original_page" name="original_page" oninput="InputOnlyNumber(this)">
                                    <span class="input-group-text">หน้า</span>
                                  </div>

                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เลข ISBN</label>
                                <input type="text" class="form-control form-control-sm" id="isbn" name="isbn"
                                    maxlength="13" oninput="InputOnlyNumber(this)">
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">ลำดับชั้นปี</label>
                                <input type="text" class="form-control form-control-sm" id="level"
                                    name="level">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('FormSubmitBook')"><i class="fas fa-save me-1"></i>บันทึก</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
