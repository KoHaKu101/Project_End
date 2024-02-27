<div class="modal fade" id="modal_Emp_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('emp.create') }}" method="POST" id="FormSubmit">
              @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="control-label">ชื่อ</label>
                                <input type="text" class="form-control form-control-sm" id="f_name" name="f_name" required>
                                <p id="error_f_name" class="text-danger" hidden>กรุณาใส่ชื่อเจ้าหน้าที่</p>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">นามสกุล</label>
                                <input type="text" class="form-control form-control-sm" id="l_name" name="l_name" required>
                                <p id="error_l_name" class="text-danger" hidden>กรุณาใส่นามสกุลเจ้าหน้าที่</p>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">รหัสประจำตัวประชาชน</label>
                                <input type="text" class="form-control form-control-sm" id="id_card" name="id_card" maxlength="13" required
                                oninput="InputOnlyNumber(this)">
                                <p id="error_id_card" class="text-danger" hidden>กรุณาใส่รหัสประจำตัวประชาชน</p>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">วันเดือนปีเกิด</label>
                                <input type="date" class="form-control form-control-sm" id="birthday" name="birthday" required >
                                <p id="error_birthday" class="text-danger" hidden>กรุณาใส่วันเดือนปีเกิด</p>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">อายุ</label>
                                <div class="input-group input-group-sm ">
                                    <input type="text" class="form-control form-control-sm" id="age" name="age"
                                    maxlength="3"required oninput="InputOnlyNumber(this)">
                                    <span class="input-group-text">ปี</span>
                                  </div>
                                  <p id="error_age" class="text-danger" hidden>กรุณาใส่อายุ</p>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label">เพศ</label>
                                <select class="form-select form-select-sm" id="gender" name="gender" required>
                                    <option disabled selected>กรุณาเลือกเพศ</option>
                                    <option value="M">ชาย</option>
                                    <option value="F">หญิง</option>
                                </select>
                                <p id="error_gender" class="text-danger" hidden>กรุณาเลือกเพศ</p>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" >ตำแหน่ง</label>
                                <select class="form-select form-select-sm" id="status" name="status"  required>
                                    <option disabled selected>กรุณาเลือกตำแหน่ง</option>
                                    <option value="1">ฝ่ายผลิต</option>
                                    <option value="2">ฝ่ายบริการ</option>
                                </select>
                                <p id="error_status" class="text-danger" hidden>กรุณาเลือกตำแหน่ง</p>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">เบอร์โทร</label>
                                <input type="text" class="form-control form-control-sm" id="tel" name="tel"
                                    maxlength="10"required oninput="InputOnlyNumber(this)">
                                <p id="error_tel" class="text-danger" hidden>กรุณาใส่เบอร์โทร</p>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control form-control-sm" id="username"
                                    name="username"required autocomplete="new-username">
                                <p id="error_username" class="text-danger" hidden>กรุณาใส่ Username</p>

                            </div>
                            <div class="col-lg-2">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control form-control-sm" id="password"
                                    name="password"required autocomplete="new-password">
                                <p id="error_password" class="text-danger" hidden>กรุณาใส่ Password</p>

                            </div>
                            <div class="col-lg-6">
                                <label class="control-label">ที่อยู่</label>
                                <textarea class="form-control form-control-sm" rows="5" id="address" name="address"required></textarea>
                                <p id="error_address" class="text-danger" hidden>กรุณาใส่ที่อยู่</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="submitBTN" onclick="SubmitForm('submitBTN','FormSubmit')"><i
                            class="fas fa-save me-1" id="icon"></i>บันทึก</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


