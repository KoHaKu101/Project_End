<div class="modal fade" id="modal_media" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">เพิ่มสื่อ</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_media" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 ">
                            <div class="text-center">
                                <img src="{{ asset('assets/images/book_not_found.jpg') }}" width="85%"
                                    id="img_show">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="control-label">ทะเบียนสื่อ</label>
                                    <input type="text" class="form-control form-control-sm" id="number"
                                        name="number" disabled value="-----">
                                </div>
                                <div class="col-lg-6" id="input_book">
                                    <label class="control-label">หนังสือ</label>
                                    <select id="book_id" name="book_id" required></select>
                                    <p id="error_book_id" class="text-danger" hidden>กรุณาเลือกหนังสือ</p>
                                </div>
                                <div class="col-lg-2" id="div_add_book">
                                    <label class="control-label invisible">หนังสือ</label>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="OpenModalBook()"
                                        id="add_book"><i class="fas fa-plus me-1"></i>เพิ่มหนังสือ</button>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">หมวดหมู่</label>
                                    <input type="text" class="form-control form-control-sm" id="book_type"
                                        name="book_type" disabled value="-----">
                                </div>
                                <div class="col-lg-8">
                                    <label class="control-label">ประเภทสื่อ</label>
                                    <select class="form-select form-select-sm" id="type_media_id" name="type_media_id">
                                        @foreach ($dataMediaType as $MediaType)
                                            <option value="{{ $MediaType->type_media_id }}">{{ $MediaType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">ระบบเสียง</label>
                                    <input type="text" class="form-control form-control-sm" id="sound_sys"
                                        name="sound_sys" placeholder="กรอกข้อมูลระบบเสียง">
                                </div>
                                <div class="col-lg-8" style="padding-bottom: calc(var(--bs-gutter-x) * .1) !important;">
                                    <label class="control-label"> เวลา ของไฟล์สื่อ</label>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm ">
                                                <input type="text" class="form-control form-control-sm"
                                                    id="time_hour" name="time_hour" placeholder="กรอกชั่วโมง"
                                                    oninput="InputOnlyNumber(this)">
                                                <span class="input-group-text">ชั่วโมง</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm col-md-6">
                                                <input type="nubmer" class="form-control form-control-sm"
                                                    id="time_minute" name="time_minute" placeholder="กรอกนาที"
                                                    max="60">
                                                <span class="input-group-text">นาที</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">จำนวนหน้าอักษรเบลล์</label>
                                    <div class="input-group input-group-sm col-md-4">
                                        <input type="number" class="form-control form-control-sm" id="braille_page"
                                            name="braille_page" placeholder="จำนวนหน้าอักษรเบลล์(ตัวเลข)">
                                        <span class="input-group-text">หน้า</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">จำนวนเล่มจบ</label>
                                    <div class="input-group input-group-sm col-md-4">
                                    <input type="number" class="form-control form-control-sm" id="amount_end"
                                        name="amount_end" placeholder="จำนวนเล่มจบ(ตัวเลข)">
                                        <span class="input-group-text">เล่ม</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label">แหล่งที่มา</label>
                                    <input type="text" class="form-control form-control-sm" id="source"
                                        name="source" placeholder="กรอกข้อมูลแหล่งที่มา">
                                </div>
                                <div class="col-lg-12">
                                    <label class="control-label">ผู้ที่แปลสื่อหรือพากย์เสียง</label>
                                    <input type="text" class="form-control form-control-sm" id="translator"
                                        name="translator">

                                </div>
                                <div class="col-lg-12">
                                    <label class="control-label">เลือกวิธีจัดเก็บไฟล์</label>
                                    <select class="form-select form-control-sm" id="select_type_file"
                                        name="select_type_file">
                                        <option value="textarea">ข้อความ</option>
                                        <option value="text">google drive</option>
                                        <option value="file">อัปโหลด</option>
                                    </select>
                                    <label class="control-label">ตำแหน่งไฟล์</label>
                                    <textarea class="form-control form-control-sm" id="input_textarea" name="input_textarea"
                                        placeholder="ใส่คำอธิบาย เก็บไว้ที่ไหน" rows="3"></textarea>
                                    <input type="text" class="form-control form-control-sm" id="input_text"
                                        name="input_text" placeholder="ลิงค์ google drive" hidden>
                                    <input type="file" class="form-control form-control-sm" id="input_file"
                                        name="input_file" placeholder="อัปโหลดไฟล์" hidden>
                                </div>
                                <div class="col-lg-12" id="download_file" hidden>
                                    <input type="text" class="form-control" disabled id="file_location">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submit_modal"
                    onclick="SubmitForm('submit_modal','form_media')"><i class="fas fa-save me-1"></i>บันทึก</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="fas fa-xmark me-2"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
