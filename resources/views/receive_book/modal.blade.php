@php
    $username = session()->get('username');
    $emp_data = App\Models\Emp::where('username', $username)->first();
    $fullname = $emp_data->f_name . ' ' . $emp_data->l_name;
@endphp
<div class="modal fade" id="modal_receive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title-modal_receive" id="title-modal_receive">รับหนังสือ</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form method="POST" id="form_modal_receive">
                  @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label>ชื่อหนังสือ</label>
                            <select class="form-control"  placeholder="กรอกชื่อประเภทสื่อ" id="book_name" name="book_name"></select>
                        </div>
                        <div class="col-lg-6">
                            <label>วันที่รับหนังสือ</label>
                            <input type="date" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" disabled id="add_date" name="add_date">
                        </div>
                        <div class="col-lg-6">
                            <label>ประเภทการรับหนังสือ</label>
                            <select class="form-select " id="add_type" name="add_type">
                                <option selected disabled hidden>โปรดเลือกประเภท</option>
                                <option value="1">บริจาค</option>
                                <option value="2">ซื้อ</option>
                                <option value="3">กระทรวงศึกษา</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label>รายละเอียดเพิ่มเติม</label>
                            <textarea class="form-control" rows="3" id="desc" name="desc"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label>เจ้าหน้าที่ </label>
                            <input type="text" class="form-control" value="{{ $fullname }}" id="emp" disabled>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('submitBTN','form_modal_receive')"><i class="fas fa-check me-1"></i>ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="fas fa-xmark me-2"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
