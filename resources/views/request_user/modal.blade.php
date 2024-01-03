
<div class="modal fade" id="requestUser_insert" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_requestUser"></h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <form action="#" method="POST" id="form_requestUser">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <label>รหัสบัตรประจำตัวประชาชน </label>
                    <input type="text" class="form-control " id="id_card" name="id_card" maxlength="13"required oninput="InputOnlyNumber(this)">
                </div>
                <div class="col-lg-6">
                    <label>ชื่อ</label>
                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="กรอกชื่อ">
                </div>
                <div class="col-lg-6">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="กรอกนามสกุล" >
                </div>
                <div class="col-lg-6">
                    <label>วัน/เดือน/ปีเกิด</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" >
                </div>
                <div class="col-lg-6">
                    <label>อายุ</label>
                    <div class="input-group input-group-sm ">
                        <input type="text" class="form-control " id="age" name="age"maxlength="3"required oninput="InputOnlyNumber(this)">
                        <span class="input-group-text">ปี</span>
                      </div>
                </div>
                <div class="col-lg-6">
                    <label>เพศ</label>
                    <select class="form-select " id="gender" name="gender" required>
                        <option value="M">ชาย</option>
                        <option value="F">หญิง</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>เบอร์โทร</label>
                    <input type="text" class="form-control form-control-sm" id="tel" name="tel" maxlength="10" required oninput="InputOnlyNumber(this)">
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('form_requestUser')"><i class="fas fa-save me-1"></i>ยืนยัน</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
