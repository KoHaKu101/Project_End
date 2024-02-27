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
        <h2 style="text-align: right ;margin-top:-0.1cm">รายงานวันที่ : {{ $dateStart }} ถึง วันที่
            {{ $dateEnd }}</h2>
    </header>
    <main>
        @if ($dataRequest_user->count() > 0)
            @foreach ($dataRequest_user->groupBy('created_at') as $dateGroup => $datalistHeader)
                @php
                    $i += 2;
                    if ($i > 20) {
                        $i = 0;
                        echo "<div class='page_break'></div>";
                    }
                @endphp
                @php
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
                                <th style="width: 20%;text-align:left;padding-left: 0.3cm">ชื่อ</th>
                                <th style="width: 20%;text-align:left;padding-left: 0.3cm">นามสกุล</th>
                                <th style="width: 12%">เบอร์โทรศัพท์</th>
                                <th style="width: 12%">จำนวนที่คำขอ</th>
                                <th style="width: 12%">คำขอที่สำเร็จ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRequest_user->where('created_at', $dateGroup) as $datalistLoopBody)
                                    @php
                                        $i += 1;
                                        $orderNumber = $dataRequestMedia->where('requesters_id',$datalistLoopBody->requesters_id)->count();
                                        $successNumber = $dataRequestMedia->where('requesters_id',$datalistLoopBody->requesters_id)->where('status',4)->count();
                                    @endphp
                                    <tr>
                                        <td style="padding-left: 0.3cm">{{ $datalistLoopBody->f_name }}</td>
                                        <td style="padding-left: 0.3cm">{{ $datalistLoopBody->l_name }}</td>
                                        <td style="text-align: center">{{ $datalistLoopBody->tel }}</td>
                                        <td style="text-align: center">{{$orderNumber}}</td>
                                        <td style="text-align: center">{{$successNumber}}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
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
