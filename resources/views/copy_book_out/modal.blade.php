@php
    $username = session()->get('username');
    $emp_data = App\Models\Emp::where('username', $username)->first();
    $fullname = $emp_data->f_name . ' ' . $emp_data->l_name;
@endphp
<div class="modal fade" id="modal_CopyBookOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" id="FormSubmit" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-CopyBookOut">จ่ายสำเนา</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <label>ชื่อหนังสือ</label>
                            <select id="book_id" name="book_id"></select>
                        </div>
                        <div class="col-lg-4">
                            <label>จำนวนสำเนา</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="col-lg-12">
                            <label>เจ้าหน้าที่</label>
                            <input type="text" class="form-control" id="emp_name" value="{{$fullname}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitBTN" onclick="SubmitForm('FormSubmit')"></button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
