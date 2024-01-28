<div class="modal fade" id="modal_Book_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="POST" id="FormSubmitBook" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-titleBook" id="modal-title">เพิ่มหนังสือ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="text-center">
                                <img src="{{asset('assets/images/book_not_found.jpg')}}" class="img-fluid" width="66%" id="img_display">
                            </div>
                            <div class="row">
                                <div class="col-md-12 py-2">
                                    <label>ภาพหน้าปก</label>
                                    <input type="file" class="form-control" id="img_book" name="img_book"  accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="control-label">ชื่อหนังสือ</label>
                                    <input type="text" class="form-control form-control-sm" id="name"
                                        name="name">
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">หมวดหมู่หนังสือ</label>
                                    <select class="form-select form-select-sm" id="type_book_id" name="type_book_id">
                                        @foreach ($type_book as $type_book_select)
                                            <option value="{{ $type_book_select->type_book_id }}">
                                                {{ $type_book_select->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">ระดับชั้น</label>
                                    <input type="text" class="form-control form-control-sm " id="level"
                                        name="level">
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">ชื่อผู้แต่ง</label>
                                    <input type="text" class="form-control form-control-sm" id="author"
                                        name="author">
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">สำนักพิมพ์</label>
                                    <input type="text" class="form-control form-control-sm" id="publisher"
                                        name="publisher">
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">พิมพ์ครั้งที่</label>
                                    <div class="input-group input-group-sm ">
                                        <span class="input-group-text">ครั้งที่</span>
                                        <input type="text" class="form-control form-control-sm" id="edition" name="edition" oninput="InputOnlyNumber(this)">
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">ปีที่พิมพ์</label>
                                    <div class="input-group input-group-sm ">
                                        <span class="input-group-text">พ.ศ.</span>
                                        <input type="text" class="form-control form-control-sm" id="year" name="year"oninput="InputOnlyNumber(this)">
                                      </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">จำนวนหน้าตัวพิมพ์</label>
                                    <div class="input-group input-group-sm ">
                                        <input type="number" class="form-control form-control-sm" id="original_page" name="original_page" oninput="InputOnlyNumber(this)">
                                        <span class="input-group-text">หน้า</span>
                                      </div>
                                </div>

                                <div class="col-lg-4">
                                    <label class="control-label">ภาษา</label>
                                    <input type="text" class="form-control form-control-sm " id="language" name="language">
                                </div>
                                <div class="col-lg-12">
                                    <label class="control-label">เลข ISBN</label>
                                    <input type="text" class="form-control form-control-sm" id="isbn" name="isbn"
                                        maxlength="13" oninput="InputOnlyNumber(this)">
                                </div>

                                <div class="col-lg-6">
                                    <label class="control-label">เรื่องย่อ</label>
                                    <textarea class="form-control" rows="4" id="abstract" name="abstract"></textarea>

                                </div>
                                <div class="col-lg-6">
                                    <label class="control-label">บทคัดย่อ</label>
                                    <textarea class="form-control" rows="4" id="synopsis" name="synopsis"></textarea>

                                </div>
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
