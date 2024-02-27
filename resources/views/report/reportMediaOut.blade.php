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
    </style>
</head>

<body>

    @php
        $i = 0;
        $status = ['1' => 'ให้บริการสำเร็จ', '2' => 'ยกเลิก'];
        $hasData = false;
    @endphp
    <header>
        <h1 style="text-align: center;">{{ $header }}</h1>
        <h2 style="text-align: right ;margin-top:-0.5cm">ประเภทสื่อ : {{ $typeMedia }}</h2>
        <h2 style="text-align: right ;margin-top:-0.8cm">รายงานวันที่ : {{ $dateStart }} ถึง วันที่
            {{ $dateEnd }}</h2>
    </header>
    <main>
        @if ($dataMedia->count() > 0)
            @foreach ($dataMediaOut->groupBy('created_at') as $dateGroup => $datalistHeader)
                @php
                    $i += 2;
                    if ($i > 20) {
                        $i = 0;
                        echo "<div class='page_break'></div>";
                    }
                @endphp
                @foreach ($dataMediaOut->where('created_at', $dateGroup) as $datalistLoopBodyCheck)
                    @if ($dataMedia->where('book_id', $datalistLoopBodyCheck->RequestMedia->Book->book_id)->isNotEmpty())
                        @php
                            $hasData = true;
                            break;
                        @endphp
                    @endif
                @endforeach
                @if ($hasData)
                    <table>
                        <thead>
                            <tr style="background-color:rgba(94, 94, 94, 0.267)">
                                <th colspan="5" style="text-align:left">วันที่
                                    {{ date('d/m/', strtotime($dateGroup)) . (date('Y', strtotime($dateGroup)) + 543) }}
                                </th>
                            </tr>
                            <tr>
                                <th style="width: 20%">เลขทะเบียนสื่อ</th>
                                <th>ชื่อหนังสือ</th>
                                <th style="width: 23%">ประเภทสื่อ</th>
                                <th style="width: 15%">การให้บริการสื่อ</th>
                                <th style="width: 15%">เหตุผลที่ยกเลิก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataMediaOut->where('created_at', $dateGroup) as $datalistLoopBody)
                                @foreach ($dataRequestMedia->where('request_id', $datalistLoopBody->request_id) as $datalistBody)
                                    @php
                                        $i += 1;
                                        $number = $dataMedia->where('book_id',$datalistBody->book_id)->where('type_media_id',$datalistBody->type_media_id)->first()->number;
                                    @endphp
                                    <tr>
                                        <td style="text-align: center">{{ $number  }}</td>
                                        <td style="padding-left: 0.3cm">{{ $datalistBody->Book->name }}</td>
                                        <td style="text-align: center">{{ $datalistBody->TypeMedia->name }}</td>
                                        <td style="text-align: center">{{ $status[$datalistLoopBody->status] }}</td>
                                        <td style="text-align: center">
                                            {{ is_null($datalistLoopBody->desc) ? '-' : $datalistLoopBody->desc }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                @endif

            @endforeach

        @endif
        @if($hasData == false)
        <h1 style="text-align: center">ไม่พบข้อมูล</h1>

        @endif

    </main>
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
