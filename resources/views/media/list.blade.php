@extends('main_template/body')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.css') }}">
@endsection
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>สื่อสำหรับผู้พิการทางสายตา</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{route('media.list')}}" class="col-md-11">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="ค้นหาสื่อสำหรับผู้พิการทางสายตา" id="search_data" name="search_data" value="{{$search_data}}">
                                <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                            </div>
                        </form>
                        <button class="btn btn-sm btn-success col-md-1" onclick="createmodal_media()">
                            <i class="fas fa-plus"></i> เพิ่มข้อมูล
                        </button>
                    </div>

                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item " role="presentation">
                                <button class="nav-link {{ isActive($active,'0') }}" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#new_order" type="button" role="tab" aria-controls="new_order"
                                    aria-selected="true">รายการสั่งผลิตสื่อ</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'1') }}" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#media_process" type="button" role="tab" aria-controls="media_process"
                                    aria-selected="false">รายการสื่อกำลังผลิต</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active,'2') }}" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#media_success" type="button" role="tab"
                                    aria-controls="media_success" aria-selected="false">รายการสื่อผลิตเสร็จ</button>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade {{isActiveShow($active,'0')}}" id="new_order" role="tabpanel"
                                aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('media.tableOrderMedia')
                                </div>
                                {{ $dataOrderMedia->links('pagination::bootstrap-4', ['orderMedia']) }}
                            </div>
                            <div class="tab-pane fade {{isActiveShow($active,'1')}}" id="media_process" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('media.tableMediaProcess')
                                </div>
                                {{ $dataMediaProcess->links('pagination::bootstrap-4', ['mediaProcess']) }}
                            </div>
                            <div class="tab-pane fade {{isActiveShow($active,'2')}}" id="media_success" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12">
                                    @include('media.tableMediaSuccess')
                                </div>
                                {{ $dataMediaSuccess->links('pagination::bootstrap-4', ['mediaSuccess']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('media.modalStatus')
    @include('media.modalCreateAndEdit')
    @include('book.modal')
    @include('order.modal')


    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        const formSubmit = $('#form_media');
        const modal_title = $('#modal-title');
        const modal_media = $('#modal_media');
        const modal_status = $('#medai_status');
        const input_type_media_id = $('#type_media_id');
        const order_modal = $('#order_modal');

        function openmodal_status(id) {
            let url = "{{ route('media.fetchDataStatusMedia') }}";
            let urlform = "{{ route('media.updateStatus', ['id' => ':id']) }}".replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    $('#body_status').html(response);
                    $('#form_modal_status').attr('action', urlform)
                    modal_status.modal('show');
                }
            });
        }
        //Start function modal
        function createmodal_media() {
            const url = "{{ route('media.create') }}";
            const input_change = '<select id="book_id" name="book_id" ></select>';
            changeInput(input_change, false);
            setModal_Media('เพิ่มข้อมูลสื่อ', url);
            $('#input_book').removeClass("col-lg-8").addClass("col-lg-6");
            $('#add_book,#div_add_book').css('display', '');
            Select2_book();
            $('#img_show').attr('src', "{{ asset('assets/images/book_not_found.jpg') }}");
            modal_media.modal('show');
            showInput('textarea');

        }
        async function editmodal_media(id) {
            const urlFetch = "{{ route('media.fetchData') }}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    let urlUpdate = "{{ route('media.update', ['id' => ':id']) }}".replace(':id', id);
                    //ตั้งค่าต่างๆ
                    $('#download_file').attr('hidden', true);
                    $('#input_book').removeClass("col-lg-6").addClass("col-lg-8");
                    $('#add_book,#div_add_book').css('display', 'none');
                    setModal_Media('แก้ไขข้อมูลสื่อ', urlUpdate);
                    Select2_book();
                    $('#book_id').select2('destroy');
                    const input_change = $(
                        `<input type="text" class="form-control form-control-sm" id="book_id" name="book_id" disabled>`
                    );
                    changeInput(input_change, true);
                    //เริ่มกรอกข้อมูล
                    var fields = ['number', 'type_media_id', 'sound_sys', 'braille_page', 'amount_end',
                        'source', 'translator', 'time_hour', 'time_minute'
                    ];
                    fields.forEach(function(field) {
                        if (data.media_data[field]) {
                            $('#' + field).val(data.media_data[field]);
                        }
                    });
                    const file_type_select = data.media_data.file_type_select;
                    const file_desc = data.media_data.file_desc;
                    $('#select_type_file').val(file_type_select).trigger('change');
                    if (file_type_select == 'textarea') {
                        $('#input_textarea').val(file_desc);
                    } else if (file_type_select == 'text') {
                        $('#input_text').val(file_desc);
                    } else if(file_type_select == 'file') {
                        $('#download_file').attr('hidden',false);
                        $('#file_location').val(file_desc);
                    }
                    $('#book_type').val(data.book_type);
                    $('#book_id').val(data.book_name);
                    modal_media.modal('show');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });

        }
        function show_ConfirmDataOrder(id) {
            let url = `{{route('order.fetchRequestMedia')}}`;
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    id:id
                },
                dataType: "JSON",
                success: function (data) {
                    let urlAction = `{{route('media.confirmOrder',['id' => ':id'])}}`.replace(':id',id);
                    $('#ISBN').val(data.book.isbn);
                    $('#book_name').val(data.book.name);
                    $('#type_book').val(data.typeBook.name);
                    $('#type_media').val(data.TypeMedia.name);
                    $('#form_order').attr('action',urlAction);
                    $('#btn_close').hide();
                    $('#submit_order').html('รับรายการสั่งผลิต');
                    $('#modal_title_order').html('รายละเอียดการสั่งผลิตสื่อ');
                    order_modal.modal('show');
                }
            });
        }
        function OpenModalBook() {
            var url = "{{ route('book.create') }}";
            var formSubmit = $('#FormSubmitBook');
            const type_book_id = $('#type_book_id');
            $('#img_display').attr('src', "{{ asset('assets/images/book_not_found.jpg') }}");
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            type_book_id.select2({
                theme: 'bootstrap-5',
                dropdownParent: '#modal_Book_insert',
            });
            $('#modal_Book_insert').modal('show');
            $('#modal_media').modal('hide');
        }

        function close_MedaiModal(id){
            edit_statusMedia('ต้องการหยุดเผยแพร่สื่อหรือไม่',id);
        }
        function open_MediaModal(id){
            edit_statusMedia('ต้องการเผยแพร่สื่อนี้หรือไม่',id);
        }
        function edit_statusMedia(title,id){
            Swal.fire({
                icon:'warning',
                title: title,
                showCancelButton: true,
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่',
                confirmButtonColor: '#198754',
                cancelButtonColor: '#bb2d3b',
                showLoaderOnConfirm: true,
            }).then((result) => {
              if (result.isConfirmed) {
                let url = `{{route('media.editStatus',['id'=>':id'])}}`.replace(':id',id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "JSON",
                    success: function (response) {
                        if(response){
                            Swal.fire({
                                icon:'success',
                                title: 'อัพเดทรายการสำเร็จ',
                                confirmButtonText: 'ตกลง',
                                confirmButtonColor: '#198754',
                            }).then((result) => {
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                                icon:'error',
                                title: 'อัพเดทรายการไม่สำเร็จ',
                                text: 'เนื่องจากไม่พบรายการ',
                                confirmButtonText: 'ตกลง',
                                confirmButtonColor: '#198754',
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    }
                });
              }
            })
        }
        // function
        //End
        function setModal_Media(title, url) {
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            modal_title.text(title);
        }
        function changeInput(html, status) {
            const input_book = $('#book_id');
            input_book.replaceWith(html);
            input_type_media_id.attr('disabled', status);
        }
        function showInput(type_file) {
            if (type_file == 'text') {
                $('#input_textarea').attr('hidden', true);
                $('#input_text').attr('hidden', false);
                $('#input_file').attr('hidden', true);
            } else if (type_file == 'file') {
                $('#input_textarea').attr('hidden', true);
                $('#input_text').attr('hidden', true);
                $('#input_file').attr('hidden', false);
            } else {
                $('#input_textarea').attr('hidden', false);
                $('#input_text').attr('hidden', true);
                $('#input_file').attr('hidden', true);
            }
        }
        function fetchDataInput() {
            const [book_id, type_media_id] = [$('#book_id').val(), $('#type_media_id').val()];
            if (book_id != null && type_media_id != null) {
                const url = `{{ route('media.fetchDataInput') }}`;
                $.ajax({
                    type: "GET",
                    url: url,
                    data: {
                        book_id,
                        type_media_id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#book_type').val(data.typeBook)
                        $('#number').val(data.number)
                        if (data.img != null) {
                            $('#img_show').attr('src', "{{ asset('assets/images/book') }}" + '/' + data.img);
                        } else {
                            $('#img_show').attr('src', "{{ asset('assets/images/book_not_found.jpg') }}");
                        }
                    }
                });
            }
        }
        //start function select2
        function Select2_book() {
            let url = `{{ route('media.fetchData.book') }}`;
            $('#book_id').select2({
                theme: 'bootstrap-5',
                containerCssClass: "select2--small",
                dropdownCssClass: "select2--small",
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.book_id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'ค้นหาหนังสือ',
                minimumInputLength: 1,
                dropdownParent: '#modal_media',
            });
        }
        //End
        function confirm_delete(id) {
            let url = `{{ route('media.delete', ['id' => ':id']) }}`.replace(':id', id);;
            alertConfirmDelete(url, '{{ csrf_token() }}');
        }
        $(document).on('change', '#book_id, #type_media_id', fetchDataInput);
        $('#modal_Book_insert').on('hidden.bs.modal', function() {
            modal_media.modal('show');
        })
        $('#select_type_file').on('change', function() {
            const type_file = $('#select_type_file').val();
            showInput(type_file);
        });
        $('#img_book').on('change', function(e) {
            var input = e.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result);

                    img.on('load', function() {
                        $('#img_display').css({
                            width: '66%',
                            height: 'auto'
                        });

                        $('#img_display').attr('src', e.target.result);
                    });
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection()
