@php
    $statusArray = [1 => 'กำลังผลิต', 2 => 'ตรวจเช็คเรียบร้อย'];
    $color_status = [1 => 'bg-warning', 2 => 'bg-success'];
@endphp
<table class="table table-bordered border-black">
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col" style="width: 11%">หมวดหมู่หนังสือ</th>
            <th scope="col" style="width: 15%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">สถานะการผลิต</th>
            <th scope="col" style="width: 15%"></th>
        </tr>
    </thead>
    <tbody >

        @foreach ($dataMediaProcess as $keyMedai => $datalistMedia)
        @php
            $statusNumber = $datalistMedia->status;
            $media_id = $datalistMedia->media_id;
        @endphp
        <tr>
            <td class='text-center'>{{$dataMediaProcess->firstItem() + $loop->index}}</td>
            <td>{{$datalistMedia->Book->name}}</td>
            <td>{{$datalistMedia->Book->TypeBook->name}}</td>
            <td>{{$datalistMedia->TypeMedia->name}}</td>
            <td class='text-center'><span class='badge {{$color_status[$statusNumber]}} text-dark '>{{$statusArray[$statusNumber]}}</span></td>
            <td>
                <button type='button' class='btn btn-sm btn-warning'onclick='editmodal_media(`{{$media_id}}`)'><i class='fas fa-edit' ></i></button>
                <button type='button' class='btn btn-sm btn-danger' onclick='confirm_delete(`{{$media_id}}`)'><i class='fas fa-trash'></i></button>
                <button type='button' class='btn btn-sm btn-primary'onclick='openmodal_status(`{{$media_id}}`)'>อัพเดพสถานะ</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
