@php
    $username = session()->get('username');
    $emp_data = App\Models\Emp::where('username', $username)->first();
    $fullname = $emp_data->f_name . ' ' . $emp_data->l_name;
@endphp
<div class="modal fade" id="request_media_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="FormRequestMedia" action="{{ route('requestMedia.create') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รับคำขอสื่อ</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label>ชื่อหนังสือ</label>
                            <select id="book_id" name="book_id"></select>
                        </div>
                        <div class="col-lg-8">
                            <label>ประเภทสื่อ</label>
                            <select class="form-select " id="type_media_id" name="type_media_id">
                                @foreach ($dataSelect as $option)
                                    <option value="{{ $option->type_media_id }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label>สถานะ</label>
                            <input type="text" class="form-control" id="status"disabled>
                        </div>
                        <div class="col-lg-6">
                            <label>ชื่อ</label>
                            <select id="f_name" name="f_name"></select>
                        </div>
                        <div class="col-lg-6">
                            <label>นามสกุล</label>
                            <input type="text" class="form-control" id="l_name" name="l_name"
                                placeholder="กรอกนามสกุล">
                        </div>
                        <div class="col-lg-12">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" id="tel" name="tel"
                                placeholder="กรอกเบอร์โทรศัพท์">
                        </div>


                        <div class="col-lg-12">
                            <label>เจ้าหน้าที่ </label>
                            <input type="text" class="form-control" value="{{ $fullname }}" disabled>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="submitBTN"
                        onclick="SubmitForm('FormRequestMedia')"><i class="fas fa-plus me-1"></i>เพิ่มรายการ</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="fas fa-xmark me-2"></i>ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
