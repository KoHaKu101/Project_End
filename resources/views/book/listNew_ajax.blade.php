<table class="table table-bordered border-black">
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col" style="width: 10%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receiveBookDesc as $key => $datalist)
        <tr>
            <td class='text-center'>{{ $receiveBookDesc->firstItem() + $loop->index }}</td>
            <td>{{$datalist->ReceiveBook->book_name}}</td>
            <td>
                <button type='button' class='btn btn-success btn-sm' onclick='OpenModalBookNew(`{{$datalist->recd_id}}`,`{{$datalist->ReceiveBook->book_name}}`)'>
                <i class='fas fa-plus me-1'></i>เพิ่มข้อมูล</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
