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
                    <h3>ข้อมูลหนังสือทั่วไป</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <form action="{{ route('book.list') }}" class="col-md-11">
                            <div class="input-group ">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control form-control-sm" id="search_data"
                                    name="search_data" value="{{ $search_data }}" placeholder="ค้นหาหนังสือ">
                                <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                            </div>
                        </form>
                        <button class="btn btn-sm btn-success col-md-1" onclick="OpenModal()">
                            <i class="fas fa-plus"></i>
                            เพิ่มข้อมูล
                        </button>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active, '0') }}" data-bs-toggle="tab"
                                    data-bs-target="#tab_book" type="button" role="tab" aria-controls="tab_book"
                                    aria-selected="false">หนังสือทั่วไป</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isActive($active, '1') }}" data-bs-toggle="tab"
                                    data-bs-target="#tab_newBook" type="button" role="tab" aria-controls="tab_newBook"
                                    aria-selected="true">หนังสือใหม่</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade {{ isActiveShow($active, '0') }} " id="tab_book"role="tabpanel"
                                aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12" id="book-table">
                                    @include('book.tableBook')
                                </div>
                                {{ $book->links('pagination::bootstrap-4', ['booksPage']) }}
                            </div>
                            <div class="tab-pane fade  {{ isActiveShow($active, '1') }}" id="tab_newBook" role="tabpanel"
                                aria-labelledby="ex1-tab-1">
                                <div class="col-lg-12" id="bookNew-table">
                                    @include('book.tableNewBook')
                                </div>
                                {{ $receiveBookDesc->links('pagination::bootstrap-4', ['bookNewPage']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('copy_book.insert')
    @include('book.modal')
    @include('book.modalBookNew')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script>
        const type_book_id = $('#type_book_id');
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function OpenModal() {
            var url = "{{ route('book.create') }}";
            var formSubmit = $('#FormSubmitBook');
            $('#modal-titleBook').text('เพิ่มหนังสือ');
            $('#img_display').attr('src', "{{ asset('assets/images/book_not_found.jpg') }}");
            formSubmit.attr('action', url);
            formSubmit[0].reset();
            type_book_id.select2({
                theme: 'bootstrap-5',
                dropdownParent: '#modal_Book_insert',
            });
            $('#modal_Book_insert').modal('show');
        }

        function OpenModalBookNew(id, name) {
            let urlcreate = "{{ route('bookNew.create', ['id' => ':id']) }}".replace(':id', id);
            var formSubmit = $('#FormSubmitBook');
            $('#modal-titleBook').text('เพิ่มหนังสือ');
            $('#img_display').attr('src', "{{ asset('assets/images/book_not_found.jpg') }}");
            formSubmit.attr('action', urlcreate);
            formSubmit[0].reset();
            type_book_id.select2({
                theme: 'bootstrap-5',
                dropdownParent: '#modal_Book_insert',
            });
            $('#name').val(name);
            $('#modal_Book_insert').modal('show');

        }

        function editmodal(id) {
            let urlUpdate = "{{ route('book.update', ['id' => ':id']) }}";
            let urlFetch = "{{ route('book.fetchData') }}";
            $.ajax({
                url: urlFetch,
                method: 'GET',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(data) {
                    var fields = ['name', 'author', 'publisher', 'edition', 'year',
                        'original_page', 'isbn', 'level', 'language', 'abstract', 'synopsis'
                    ];
                    fields.forEach(function(field) {
                        if (data[field]) {
                            $('#' + field).val(data[field]);
                        }
                    });
                    urlUpdate = urlUpdate.replace(':id', id);
                    if (data['img_book'] != null) {
                        $('#img_display').attr('src', "{{ asset('assets/images/book') }}" + '/' + data[
                            'img_book']);
                    } else {
                        $('#img_display').attr('src', "{{ asset('assets/images/book_not_found.jpg') }}");
                    }
                    $('#FormSubmitBook').attr('action', urlUpdate);
                    $('#modal_Book_insert').modal('show');
                    type_book_id.select2({
                        theme: 'bootstrap-5',
                        dropdownParent: '#modal_Book_insert',
                    });
                    type_book_id.val(data.type_book_id);
                    type_book_id.trigger('change');

                    $('#modal-titleBook').text('แก้ไขข้อมูลหนังสือ');
                },
                error: function() {
                    console.error('Error fetching data');
                }
            });
        }

        $('#increaseBtn').click(function() {
            let currentValue = parseInt($('#amount').val());
            console.log(currentValue);
            $('#amount').val(currentValue + 1);
        });
        $('#decreaseBtn').click(function() {
            let currentValue = parseInt($('#amount').val());
            console.log(currentValue);
            if (currentValue > 1) {
                $('#amount').val(currentValue - 1);
            }
        });

        function openModalCopy(type, id, name) {
            let urlcreate = "{{ route('book_copy.update', ['id' => ':id', 'math' => ':math']) }}";
            urlcreate = urlcreate.replace(':id', id).replace(':math', type);
            let formSubmit = $('#FormSubmit');
            $('#modal-title').text('เพิ่มสำเนา');
            formSubmit[0].reset();
            $('#Book_name').val(name);
            formSubmit.attr('action', urlcreate);
            $('#copy_BookCopy_insert').modal('show');
        }

        function SubmitForm(form) {
            var form = $('#' + form);
            var btn = form.find('button#submitBTN');
            loadingButton(btn);
            form.submit();

        }

        function confirm_delete(id) {
            let url = `{{ route('book.delete', ['id' => ':id']) }}`.replace(':id', id);;
            alertConfirmDelete(url, '{{ csrf_token() }}');
        }
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
