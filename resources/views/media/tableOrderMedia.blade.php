<table class="table table-bordered border-black">
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col" style="width: 8%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">วันที่สั่งสื่อ</th>
            <th scope="col" style="width: 20%">เจ้าหน้าที่</th>
            <th scope="col" style="width: 16%"></th>
        </tr>
    </thead>
    <tbody id="tableDataRequestMedia">
        @foreach ($dataOrderMedia as $key => $orderMedia)
            @php
                $emp = $orderMedia->emp->f_name." ".$orderMedia->emp->l_name;
            @endphp
            <tr>
                <td class='text-center'> {{$dataOrderMedia->firstItem() + $loop->index}}</td>
                <td>{{$orderMedia->RequestMedia->Book->name}}</td>
                <td>{{$orderMedia->RequestMedia->TypeMedia->name}}</td>
                <td>{{$orderMedia->order_date}}</td>
                <td>{{$emp}}</td>
                <td>
                    <button type='button' class='btn btn-sm btn-primary' onclick='show_ConfirmDataOrder(`{{$orderMedia->order_id}}`)'><i class='fas fa-eye me-1'></i>ตรวจสอบรายการสั่งผลิต</button>
                    </td>
            </tr>
        @endforeach

    </tbody>
</table>
