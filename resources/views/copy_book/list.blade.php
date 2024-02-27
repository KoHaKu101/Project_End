@extends('main_template/body')
@section('css')

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>สำเนาหนังสือ</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row ">
                            <div class="col-lg-12">
                                <form action="{{route('book_copy.list')}}">
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="fas fa-search"></i></span>
                                        <input type="text" class="form-control form-control-sm" id="search_data" name="search_data" value="{{$search_data}}" placeholder="ค้นหาสำเนาหนังสือ" >
                                        <button type="submit" class="btn btn-sm btn-primary">ค้นหา</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered border-black" >
                                <thead class="bg-grayCustom">
                                    <tr>
                                        <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
                                        <th scope="col" >ชื่อหนังสือ</th>
                                        <th scope="col" style="width: 10%" class="text-center ">จำนวนคงเหลือ</th>
                                        <th scope="col" style="width: 7%"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datalist)
                                        <tr>
                                            <td class="text-center">{{ $data->firstItem() + $loop->index }}</td>
                                            <td>{{ $datalist->Book->name }}</td>
                                            <td class="text-center ">
                                                @php
                                                    $num = $datalist->amount;
                                                    if ($num == 0) {
                                                        $color = 'bg-danger';
                                                    } elseif ($num <= 5) {
                                                        $color = 'bg-warning';
                                                    } else {
                                                        $color = 'bg-primary';
                                                    }
                                                @endphp
                                                    <span class="badge {{$color}} " style="font-size:16px">{{$num}}</span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success"
                                                    onclick="openModal('plus','{{ $datalist->copy_id }}','{{ $datalist->Book->name }}')">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="openModal('minus','{{ $datalist->copy_id }}','{{ $datalist->Book->name }}')">
                                                    <i class="fas fa-minus"></i>
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
    @include('copy_book.insert')
    <script>
        $(document).ready(function() {
            $('#increaseBtn').click(function() {
                var currentValue = parseInt($('#amount').val());
                $('#amount').val(currentValue + 1);
            });
            $('#decreaseBtn').click(function() {
                var currentValue = parseInt($('#amount').val());
                if (currentValue > 1) {
                    $('#amount').val(currentValue - 1);
                }
            });
        });
        //ปุ่มแสดง modal สำหรับเพิ่มรายการ
        function openModal(type, id, name) {
            // url สำหรับอัพเดทข้อมูลตาม id
            let urlcreate = "{{ route('book_copy.update', ['id' => ':id','math' => ':math']) }}";
            urlcreate = urlcreate.replace(':id', id).replace(':math',type);
            //ตัวแปรของ form
            let formSubmit = $('#FormSubmit');
            //เปลี่ยนคำบนหัว modal
            if (type === 'minus') {
                $('#modal-title').text('ลบสำเนา');
            } else {
                $('#modal-title').text('เพิ่มสำเนา');
            }
            // ลบค่าที่เคยกรอกไว้ทั้งหมด
            formSubmit[0].reset();
            //เอาชื่อหนังสือมาใส่ลงใน input
            $('#Book_name').val(name);
            //แก้ไข id ใน url modal
            formSubmit.attr('action', urlcreate);
            // เปิด Modal ขึ้นมา
            $('#copy_BookCopy_insert').modal('show');
        }
    </script>
@endsection()
