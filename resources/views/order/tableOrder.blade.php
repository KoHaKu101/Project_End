<table class="table table-bordered border-black" >
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col" >ชื่อหนังสือ</th>
            <th scope="col" style="width: 15%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">วันที่ส่งคำขอ</th>
            <th scope="col" style="width: 15%"></th>
        </tr>
    </thead>
    <tbody >
        @foreach ($dataRequestMedia as $datalist)
        <tr>
            <td class="text-center">{{$dataRequestMedia->firstItem() + $loop->index}}</td>
            <td>{{$datalist->Book->name}}</td>
            <td>{{$datalist->TypeMedia->name}}</td>
            <td>{{date("d/m/Y", strtotime($datalist->request_date))}}</td>
            <td>
                <button type="button" class="btn btn-primary" onclick="modalOrder('{{$datalist->request_id}}')">สั่งผลิตสื่อ</button>
                <button type="button" class="btn btn-danger" onclick="showModalCancelRequset('{{$datalist->request_id}}')"><i class="fas fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
