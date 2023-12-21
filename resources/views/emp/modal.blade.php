<div class="modal fade" id="modal_Emp_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('emp.create') }}" method="POST" id="FormSubmit">
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">เพิ่มประเภทสื่อ</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อ</label>
                                <input type="text" class="form-control form-control-sm" id="f_name" name="f_name" required>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">นามสกุล</label>
                                <input type="text" class="form-control form-control-sm" id="l_name" name="l_name" required>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">รหัสประจำตัวประชาชน</label>
                                <input type="text" class="form-control form-control-sm" id="id_card" name="id_card" maxlength="13" required
                                oninput="InputOnlyNumber(this)">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">วันเดือนปีเกิด</label>
                                <input type="date" class="form-control form-control-sm" id="birthday"
                                    name="birthday"required>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">อายุ</label>
                                <div class="input-group input-group-sm ">
                                    <input type="text" class="form-control form-control-sm" id="age" name="age"
                                    maxlength="3"required oninput="InputOnlyNumber(this)">
                                    <span class="input-group-text">ปี</span>
                                  </div>

                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เพศ</label>
                                <select class="form-select form-select-sm" id="gender" name="gender" required>
                                    <option value="M">ชาย</option>
                                    <option value="F">หญิง</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" >ตำแหน่ง</label>
                                <select class="form-select form-select-sm" id="status" name="status" required>
                                    <option selected>กรุณาเลือกตำแหน่ง</option>
                                    <option value="1">ฝ่ายผลิต</option>
                                    <option value="2">ฝ่ายบริการ</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">เบอร์โทร</label>
                                <input type="text" class="form-control form-control-sm" id="tel" name="tel"
                                    maxlength="10"required oninput="InputOnlyNumber(this)">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control form-control-sm" id="username"
                                    name="username"required autocomplete="new-username">
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control form-control-sm" id="password"
                                    name="password"required autocomplete="new-password">
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label">ที่อยู่</label>
                                <textarea class="form-control form-control-sm" rows="5" id="address" name="address"required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="submitBTN" onclick="SubmitForm('FormSubmit')"><i
                            class="fas fa-save me-1" id="icon"></i>บันทึก</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


