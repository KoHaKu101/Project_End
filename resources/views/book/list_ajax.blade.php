<table class="table table-bordered border-black">
    <thead class="bg-grayCustom">
        <tr>
            <th scope="col" style="width: 5%" class="text-center">ลำดับ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col" style="width: 11%">หมวดหมู่หนังสือ</th>
            <th scope="col" style="width: 11%">เลข ISBN</th>
            <th scope="col" style="width: 10%">สถานะสำเนา</th>
            <th scope="col" style="width: 15%"></th>
        </tr>
    </thead>
    <tbody >
        @foreach ($book as $key => $datalist)
    @php
        $type_book_name = optional($datalist->TypeBook)->name ?? '';
        $amount = optional($datalist->CopyBook)->amount ?? 0;
        $copy_id = optional($datalist->CopyBook)->copy_id ?? '';
        $badge = is_null($datalist->updated_at) ? 'bg-danger' : ($amount > 0 ? 'bg-success' : 'bg-warning text-dark');
        $textBadge = is_null($datalist->updated_at) ? 'ไม่มีข้อมูล' : ($amount > 0 ? 'มีสำเนา' : 'ยังไม่มีสำเนา');
    @endphp
    <tr>
        <td class='text-center'>{{ $book->firstItem() + $loop->index }}</td>
        <td>{{ $datalist->name }}</td>
        <td>{{ $type_book_name }}</td>
        <td>{{ $datalist->isbn }}</td>
        <td><span class='badge {{ $badge }}'> {{ $textBadge }} </span></td>
        <td>
            <button type='button' class='btn btn-sm btn-warning' onclick='editmodal(`{{ $datalist->book_id }}`)'>
                <i class='fas fa-edit'></i>
            </button>
            <button type='button' class='btn btn-sm btn-danger me-1' onclick='confirm_delete(`{{ $datalist->book_id }}`)'>
                <i class='fas fa-trash'></i>
            </button>
            @if ($amount == 0)
                <button type='button' class='btn btn-sm btn-primary'
                    onclick='openModalCopy(`plus`, `{{ $copy_id }}`, `{{ $datalist->name }}`)'>
                    <i class='fas fa-copy'></i>
                    เพิ่มสำเนา
                </button>
            @endif

        </td>
    </tr>
@endforeach
    </tbody>
</table>

