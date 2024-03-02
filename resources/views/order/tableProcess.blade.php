<table class="table table-bordered border-black" >
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col" >ชื่อหนังสือ</th>
            <th scope="col" style="width: 20%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">วันที่สั่งผลิต</th>
            <th scope="col" style="width: 15%">เจ้าหน้าที่</th>
            <th scope="col" style="width: 10%"></th>
        </tr>
    </thead>
    <tbody >
        @foreach ($dataOrderProcess as $datalist)
        <tr>
            <td class="text-center">{{$dataOrderProcess->firstItem() + $loop->index}}</td>
            <td>{{$datalist->RequestMedia->Book->name}}</td>
            <td>{{$datalist->RequestMedia->TypeMedia->name}}</td>
            <td>{{date("d/m/Y", strtotime($datalist->order_date))}}</td>
            <td>{{$datalist->Emp->f_name.' '.$datalist->Emp->l_name}}</td>
            <td>
                <button type="button" class="btn btn-info btn-sm" onclick="modalDetail('{{$datalist->request_id}}')">
                    <i class="fas fa-eye me-1"></i>ตรวจสอบ
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
