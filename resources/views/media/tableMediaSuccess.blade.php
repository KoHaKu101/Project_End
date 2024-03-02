
<table class="table table-bordered border-black">
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col" style="width: 11%">หมวดหมู่หนังสือ</th>
            <th scope="col" style="width: 20%">ประเภทสื่อ</th>
            <th scope="col" style="width: 10%">สถานะการผลิต</th>
            <th scope="col" style="width: 5%"></th>

            {{-- <th scope="col" style="width: 15%"></th> --}}
        </tr>
    </thead>
    <tbody >

        @foreach ($dataMediaSuccess as $keyMedai => $datalistMedia)
        @php
            $media_id = $datalistMedia->media_id;
        @endphp
        <tr>
            <td class='text-center'>{{$dataMediaSuccess->firstItem() + $loop->index}}</td>
            <td>{{$datalistMedia->Book->name}}</td>
            <td>{{$datalistMedia->Book->TypeBook->name}}</td>
            <td>{{$datalistMedia->TypeMedia->name}}</td>
            <td class='text-center'><span class='badge bg-success text-white '>ตรวจเช็คเรียบร้อย</span></td>
            <td>
                <button type='button' class='btn btn-sm btn-warning'  onclick='editmodal_media(`{{$media_id}}`)'><i class='fas fa-edit' ></i></button>
                {{-- @if ($datalistMedia->status == 2)
                    <button type='button' class='btn btn-sm btn-danger' onclick='close_MedaiModal(`{{$media_id}}`)'>หยุดเผยแพร่</button>
                @elseif ($datalistMedia->status == 3)
                    <button type='button' class='btn btn-sm btn-primary' onclick='close_MedaiModal(`{{$media_id}}`)'>เผยแพร่</button>
                @endif --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
