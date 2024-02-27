
@php
    $username = session()->get('username');
    $emp_data = App\Models\Emp::where('username', $username)->first();
    $fullname = $emp_data->f_name . ' ' . $emp_data->l_name;
@endphp
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">ให้บริการสื่อ</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <form id="form_modalConfirm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label>ชื่อหนังสือ</label>
                            <input type="text" class="form-control" id="book_name" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>ประเภทสื่อ</label>
                            <input type="text" class="form-control" id="type_media" disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>ชื่อผู้ขอรับสื่อ</label>
                            <input type="text" class="form-control" id="request_user_name" disabled>
                        </div><div class="col-lg-6">
                            <label>เบอร์ติดต่อ</label>
                            <input type="text" class="form-control" id="request_user_tel" disabled>
                        </div>
                        <div class="co-lg-12">
                            <label>ช่องทางการจ่ายสื่อ</label>
                            <textarea class="form-control" id="desc" disabled></textarea>
                        </div>
                        <div class="col-lg-6">
                            <label>วันที่จ่าย</label>
                            <input type="date" class="form-control" id="md_out_date" name="md_out_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                        </div>
                        <div class="col-lg-6">
                            <label>เจ้าหน้าที่ </label>
                            <input type="text" class="form-control" id="emp" value="{{$fullname}}" disabled>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('submitBTN','form_modalConfirm')" ><i class="fas fa-check me-1"></i>ยืนยันการให้บริการสื่อ</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                        class="fas fa-xmark me-2"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
