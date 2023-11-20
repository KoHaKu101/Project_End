<div class="modal fade" id="modal_Book_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg   ">
        <div class="modal-content">
            <form method="POST" id="FormSubmit">
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">เพิ่มประเภทสื่อ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group row" >
                            <div class="col-lg-4">
                                <label class="control-label">ทะเบียนสื่อ</label>
                                <input type="text" class="form-control form-control-sm"disabled value="123456">
                            </div>
                            <div class="col-lg-8">
                                <label class="control-label">หนังสือ</label>
                                <select id="book_id" name="book_id" ></select>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">หมวดหมู่</label>
                                <input type="text" class="form-control form-control-sm" id="book_type" name="book_type" disabled value="-----">
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">ประเภทสื่อ</label>
                                <select class="form-select form-select-sm">
                                    @foreach ($dataMediaType as $MediaType)
                                        <option value="{{$MediaType->type_media_id}}">{{$MediaType->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">ระบบเสียง</label>
                                <input type="text" class="form-control form-control-sm" placeholder="กรอกข้อมูลระบบเสียง">
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">จำนวนหน้าอักษรเบลล์</label>
                                <input type="number" class="form-control form-control-sm" placeholder="จำนวนหน้าอักษรเบลล์(ตัวเลข)">
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">จำนวนเล่มจบ</label>
                                <input type="number" class="form-control form-control-sm"  placeholder="จำนวนเล่มจบ(ตัวเลข)">
                            </div>
                            <div class="col-lg-4">
                                <label class="control-label">แหล่งที่มา</label>
                                <input type="text" class="form-control form-control-sm"  placeholder="กรอกข้อมูลแหล่งที่มา">

                            </div>

                            <div class="col-lg-12">
                                <label class="control-label">ผู้ที่แปลสื่อหรือพากย์เสียง</label>
                                <input type="text" class="form-control form-control-sm" >

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