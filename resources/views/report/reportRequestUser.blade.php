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
        $status = ['1' => 'ให้บริการสำเร็จ', '2' => 'ยกเลิก'];
        $hasData = false;
        $colspanNumber = $div_request_status != 'all' ? 5 : 7;
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
                    $hasData = true;
                    $number = 1;
                @endphp
                <table>
                    <thead>
                        <tr style="background-color:rgba(94, 94, 94, 0.267)">
                            <th colspan="{{ $colspanNumber }}" style="text-align:left">วันที่
                                {{ date('d/m/', strtotime($dateGroup)) . (date('Y', strtotime($dateGroup)) + 543) }}
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 7%">ลำดับ</th>
                            <th style="text-align:left;padding-left: 0.3cm">ชื่อ</th>
                            <th style="text-align:left;padding-left: 0.3cm">นามสกุล</th>
                            <th style="width: 13%">จำนวนที่คำขอ</th>
                            @if ($div_request_status == '1')
                                <th style="width: 13%">คำขอที่สำเร็จ</th>
                            @elseif($div_request_status == '2')
                                <th style="width: 13%">คำขอที่ยกเลิก</th>
                            @elseif($div_request_status == '3')
                                <th style="width: 13%">คำขอที่ตกค้าง</th>
                            @else
                                <th style="width: 13%">คำขอที่สำเร็จ</th>
                                <th style="width: 13%">คำขอที่ยกเลิก</th>
                                <th style="width: 13%">คำขอที่ตกค้าง</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $summaryOrderNumber = 0;
                            $summarySuccessNumber = 0;
                            $summaryWaitNumber = 0;
                            $summaryFailNumber = 0;
                        @endphp
                        @foreach ($dataRequest_user->where('created_at', $dateGroup) as $datalistLoopBody)
                            @php
                                $i += 1;
                                $dataLoop = $dataRequestMedia->where('requesters_id', $datalistLoopBody->requesters_id);
                                $orderNumber = $dataLoop->count();
                                $successNumber = $dataLoop->where('status', 4)->count();
                                $waitNumber = $dataLoop
                                    ->where('status', '!=', 4)
                                    ->where('status', '!=', 5)
                                    ->count();
                                $failNumber = $dataLoop->where('status', 5)->count();

                                $summaryOrderNumber += $orderNumber;
                                $summarySuccessNumber += $successNumber;
                                $summaryWaitNumber += $waitNumber;
                                $summaryFailNumber += $failNumber;
                            @endphp
                            <tr>
                                <td style="text-align: center">{{ $number++ }}</td>
                                <td style="padding-left: 0.3cm">{{ $datalistLoopBody->f_name }}</td>
                                <td style="padding-left: 0.3cm">{{ $datalistLoopBody->l_name }}</td>
                                <td style="text-align: center">{{ $orderNumber == 0 ? '-' : $orderNumber }}</td>
                                @if ($div_request_status == '1')
                                    <td style="text-align: center">{{ $successNumber == 0 ? '-' : $successNumber }}
                                    </td>
                                @elseif($div_request_status == '2')
                                    <td style="text-align: center">{{ $waitNumber == 0 ? '-' : $waitNumber }}</td>
                                @elseif($div_request_status == '3')
                                    <td style="text-align: center">{{ $failNumber == 0 ? '-' : $failNumber }}</td>
                                @else
                                    <td style="text-align: center">{{ $successNumber == 0 ? '-' : $successNumber }}
                                    </td>
                                    <td style="text-align: center">{{ $waitNumber == 0 ? '-' : $waitNumber }}</td>
                                    <td style="text-align: center">{{ $failNumber == 0 ? '-' : $failNumber }}</td>
                                @endif
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="3" style="text-align:center">รวม</td>
                            <td style="text-align: center">{{ $summaryOrderNumber == 0 ? '-' : $summaryOrderNumber }}
                            </td>
                            @if ($div_request_status == '1')
                                <td style="text-align: center">
                                    {{ $summarySuccessNumber == 0 ? '-' : $summarySuccessNumber }}</td>
                            @elseif($div_request_status == '2')
                                <td style="text-align: center">{{ $summaryWaitNumber == 0 ? '-' : $summaryWaitNumber }}
                                </td>
                            @elseif($div_request_status == '3')
                                <td style="text-align: center">{{ $summaryFailNumber == 0 ? '-' : $summaryFailNumber }}
                                </td>
                            @else
                                <td style="text-align: center">
                                    {{ $summarySuccessNumber == 0 ? '-' : $summarySuccessNumber }}</td>
                                <td style="text-align: center">{{ $summaryWaitNumber == 0 ? '-' : $summaryWaitNumber }}
                                </td>
                                <td style="text-align: center">{{ $summaryFailNumber == 0 ? '-' : $summaryFailNumber }}
                                </td>
                            @endif

                        </tr>
                    </tbody>
                </table>
            @endforeach
            @if ($i > 17)
                <div class='page_break'></div>
            @else
                <div class="page-final">
            @endif
            <table>
                @if ($div_request_status == 'all')
                    <thead>
                        <tr style="background-color:rgba(94, 94, 94, 0.267)">
                            <th>คำขอที่สำเร็จ</th>
                            <th>คำขอที่ยกเลิก</th>
                            <th>คำขอที่ตกค้าง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $summarySuccessNumber =
                                $dataRequestMedia->where('status', 4)->count() == 0
                                    ? '-'
                                    : $dataRequestMedia->where('status', 4)->count();
                            $summaryWaitNumber =
                                $dataRequestMedia->where('status', '!=', 4)->where('status', '!=', 5)->count() == 0
                                    ? '-'
                                    : $dataRequestMedia->where('status', '!=', 4)->where('status', '!=', 5)->count();
                            $summaryFailNumber =
                                $dataRequestMedia->where('status', 5)->count() == 0
                                    ? '-'
                                    : $dataRequestMedia->where('status', 5)->count();
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{ $summarySuccessNumber }}</td>
                            <td style="text-align:center;">{{ $summaryWaitNumber }}</td>
                            <td style="text-align:center;">{{ $summaryFailNumber }}</td>
                        </tr>
                    </tbody>
                @endif

                <thead>
                    <tr style="background-color:rgba(94, 94, 94, 0.267)">
                        <th colspan="3" style="text-align:center">สรุปผลรวมทั้งหมด</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" style="width: 12%;text-align:center">{{ $dataRequestMedia->count() }} </td>
                    </tr>
                </tbody>
            </table>
        @endif
        @if ($hasData == false)
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
