<table class="table table-bordered border-black" >
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col" >ชื่อหนังสือ</th>
            <th scope="col" style="width: 8%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">วันที่รับคำขอสื่อ</th>
            <th scope="col" style="width: 12%">เจ้าหน้าที่</th>
            <th scope="col" style="width: 12%">ผู้ขอรับสื่อ</th>
            <th scope="col" style="width: 8%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requestMediaSuccess as $datalist)
        <tr>
            <td class="text-center">{{ $requestMediaSuccess->firstItem() + $loop->index }}</td>
            <td>{{$datalist->RequestMedia->Book->name}}</td>
            <td>{{$datalist->RequestMedia->TypeMedia->name}}</td>
            <td>{{ date("d/m/Y", strtotime($datalist->RequestMedia->request_date)) }}</td>
            <td>{{$datalist->RequestMedia->Emp->f_name .' '. $datalist->RequestMedia->Emp->l_name}}</td>
            <td>{{$datalist->RequestMedia->RequestUser->f_name .' '. $datalist->RequestMedia->RequestUser->l_name}}</td>
            <td>
                <button type="button" class="btn btn-sm btn-info" onclick="showModalDetail('{{$datalist->request_id}}')">
                    <i class="fas fa-eye"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger" onclick="confirmCancel('{{$datalist->md_out_id}}')">
                    <i class="fas fa-trash"></i>
                </button>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
