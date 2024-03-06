<html>

<head>
    <meta http-equiv="Content-Language" content="th" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        body {
            font-family: "THSarabunNew";
        }

        table,
        td,
        th {
            table-layout: fixed;
            font-size: 20px;
            border: 1px solid;

        }

        tbody td {
            vertical-align: top;
            white-space: normal;
            word-wrap: break-word;
        }

        th {
            padding-left: 1%
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: none;
        }

        header {
            position: fixed;
            top: -1cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            /** Extra personal styles **/
            color: black;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            /** Extra personal styles **/
            color: black;
            line-height: 1.5cm;
        }

        .page_break {
            margin-bottom: 3.4cm;
            page-break-before: always;
        }

        main {
            margin-top: 3.4cm;
        }

        .page-final {
            position: fixed;
            flex-direction: column;
            position: fixed;
            bottom: 10;
            width: 100%;
        }

        .page-final table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .page-final th,
        .page-final td {
            border: 1px solid #000;
            text-align: left;
        }

        .page-final th {
            text-align: center;
        }
    </style>
</head>

<body>
    @php
        $i = 0;
        $number = 1;
        $status = ['1' => 'กำลังผลิต', '2' => 'ผลิตเสร็จสิ้น', '3' => 'ปิดการมองเห็น'];
        $hasData = false;
    @endphp
    <header>
        <h1 style="text-align: center;">{{ $header }}</h1>
        <h2 style="text-align: right ;margin-top:-0.5cm">ประเภทสื่อ : {{ $typeMedia }}</h2>
        <h2 style="text-align: right ;margin-top:-0.8cm">รายงานวันที่ : {{ $dateStart }} ถึง วันที่
            {{ $dateEnd }}</h2>
    </header>

    @if ($dataMedia->count() > 0)
        <main>
            @foreach ($dataMedia->groupBy('created_at') as $dateGroup => $datalistHeader)
                @php
                    $i += 2;
                    if ($i > 20) {
                        $i = 0;
                        echo "<div class='page_break'></div>";
                    }
                    $hasData = true;
                @endphp
                <table>
                    <thead>
                        <tr style="background-color:rgba(94, 94, 94, 0.267)">
                            <th colspan="5" style="text-align:left">วันที่
                                {{ date('d/m/', strtotime($dateGroup)) . (date('Y', strtotime($dateGroup)) + 543) }}
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 8%">ลำดับ</th>
                            <th style="width: 15%">ทะเบียนสื่อ</th>
                            <th>ชื่อหนังสือ</th>
                            <th style="width: 23%">ประเภทสื่อ</th>
                            <th style="width: 12%">สถานะสื่อ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataMedia->where('created_at', $dateGroup) as $index => $datalistBody)
                            @php
                                $i += 1;
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td style="text-align: center">{{ $datalistBody->number }}</td>
                                <td style="padding-left: 0.3cm">{{ $datalistBody->Book->name }}</td>
                                <td style="text-align: center;">{{ $datalistBody->TypeMedia->name }}</td>
                                <td style="text-align: center">{{ $status[$datalistBody->status] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="text-align:center">รวม</td>
                            <td style="width: 12%;text-align:center">{{ $dataMedia->where('created_at', $dateGroup)->count() }} </td>
                            <td style="width: 12%;text-align:center"> รายการ</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach

            @if ($i > 17 && $dataMedia->groupBy('type_media_id')->count() >= 3)
                <div class='page_break'></div>
            @else
                <div class="page-final">
            @endif
            <table>
                <thead>
                    <tr style="background-color:rgba(94, 94, 94, 0.267)">
                        <th colspan="4" style="text-align:left">สรุปยอดทั้งหมด</th>
                    </tr>
                    <tr>
                        <th style="width: 8%">ลำดับ</th>
                        <th>ประเภทสื่อ</th>
                        <th style="width: 12%">ผลิตเสร็จสิ้น</th>
                        <th style="width: 12%">กำลังผลิต</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataMedia->groupBy('type_media_id') as $key => $datalist)
                        @php
                            $nameType = $dataMedia->where('type_media_id', $key)->first()->TypeMedia->name;
                            $numberSuccess = $dataMedia->where('type_media_id', $key)->where('status', 2)->count() == 0 ? '-' : $dataMedia->where('type_media_id', $key)->where('status', 2)->count();
                            $numberProcess = $dataMedia->where('type_media_id', $key)->where('status', 1)->count() == 0 ? '-' : $dataMedia->where('type_media_id', $key)->where('status', 1)->count();
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{ $number++ }}</td>
                            <td style="padding-left: 0.3cm">{{ $nameType }}</td>
                            <td style="text-align:center;">{{ $numberSuccess }}</td>
                            <td style="text-align:center;">{{ $numberProcess }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" style="text-align:center">รวม</td>
                        <td style="width: 12%;text-align:center">{{ $dataMedia->where('status', 2)->count() }} </td>
                        <td style="width: 12%;text-align:center">{{ $dataMedia->where('status', 1)->count() }} </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </main>
    @endif
    @if ($hasData == false)
        <h1 style="text-align: center;margin-top:3.5cm">ไม่พบข้อมูล</h1>
    @endif
    <footer>
        <h4 style='text-align: left'>วันที่ออกรายงาน : วันที่ {{ $dateReport }}</h4>
    </footer>

    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->get_font("THSarabunNew", "bold");
            $y = 525;
            $x = 801;
            $pdf->page_text($y, $x, "หน้า: {PAGE_NUM} / {PAGE_COUNT}", $font, 12, array(0,0,0));
        }
    </script>
</body>

</html>
