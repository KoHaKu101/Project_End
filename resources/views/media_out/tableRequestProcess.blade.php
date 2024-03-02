<table class="table table-bordered border-black" >
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col" >ชื่อหนังสือ</th>
            <th scope="col" style="width: 20%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">วันที่ส่งคำขอ</th>
            <th scope="col" style="width: 12%">ผู้ขอรับสื่อ</th>
            <th scope="col" style="width: 12%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requestMediaProcess as $datalist)
        <tr>
            <td class="text-center">{{ $requestMediaProcess->firstItem() + $loop->index }}</td>
            <td>{{$datalist->Book->name}}</td>
            <td>{{$datalist->TypeMedia->name}}</td>
            <td>{{ date("d/m/Y", strtotime($datalist->request_date)) }}</td>
            <td>{{$datalist->RequestUser->f_name .' '. $datalist->RequestUser->l_name}}</td>
            <td>
                <button type="button" class="btn btn-sm btn-info" onclick="showModalConfirm('{{$datalist->request_id}}')">
                    ให้บริการสื่อ
                </button>
                <button type="button" class="btn btn-sm btn-danger" onclick="showModalCancelRequset('{{$datalist->request_id}}')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
