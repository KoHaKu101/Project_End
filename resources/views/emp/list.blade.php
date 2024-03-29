@extends('main_template/body')
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>ข้อมูลเจ้าหน้าที่</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{route('emp.list')}}" method="GET" class="col-lg-11">
                            @csrf
                            <div class="input-group ">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control form-control-sm" id="search_data" name="search_data" value="{{$search_data}}" placeholder="ค้นหาเจ้าหน้าที่">
                                <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-sm btn-success col-lg-1" onclick="createmodal()">
                            <i class="fas fa-plus"></i>
                            เพิ่มข้อมูล
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered border-black">
                                <thead class="bg-grayCustom">
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col" style="width: 10%">รหัสเจ้าหน้าที่</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col" style="width: 12%">ตำแหน่ง</th>
                                        <th scope="col" style="width: 12%">เบอร์โทร</th>
                                        <th scope="col" style="width: 8%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $data->firstItem() + $loop->index }}</td>
                                            <td>{{ $datalist->getKey() }}</td>
                                            <td>{{ $datalist->f_name . ' ' . $datalist->l_name }}</td>
                                            <td>{{ $statusArray[$datalist->status] }}</td>
                                            <td>{{ $datalist->tel }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="editmodal('{{ $datalist->getKey() }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirm_delete('{{ $datalist->getKey() }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>

                                        </tr>
                                    @endforeach
                            </table>
                            {{ $data->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('emp.modal')
    <script>
        const modal_emp = $('#modal_Emp_insert');
        const modal_title = $('#modal-title');
        const username = $('#username');
        const password = $('#password');
        const formSubmit = $('#FormSubmit');
        //funtion open modal
        function createmodal() {
            const url = "{{ route('emp.create') }}";
            formSubmit[0].reset();
            disableInput(false);
            set_modal('เพิ่มข้อมูลเจ้าหน้าที่', url);
        }

        function editmodal(id) {
            const urlFetch = "{{ route('emp.fetchData') }}";
            let urlUpdate = "{{ route('emp.update', ['id' => ':id']) }}".replace(':id', id);
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    var fields = ['f_name', 'l_name', 'id_card', 'birthday', 'age', 'gender', 'status', 'tel',
                        'username', 'address'
                    ];
                    fields.forEach(function(field) {
                        if (data[field]) {
                            $('#' + field).val(data[field]);
                        }
                    });
                    disableInput(true);
                    set_modal('แก้ไขข้อมูลเจ้าหน้าที่', urlUpdate);
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }

        function confirm_delete(id) {
            let url = `{{ route('emp.delete', ['id' => ':id']) }}`.replace(':id', id);
            alertConfirmDelete(url, '{{ csrf_token() }}');
        }
        //function setting
        function set_modal(title, url) {
            modal_title.text(title);
            formSubmit.attr('action', url);

            modal_emp.modal('show');
        }

        function disableInput(status) {
            username.prop('disabled', status);
            password.prop('disabled', status);

        }
    </script>
@endsection()
