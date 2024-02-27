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
            text-align: center;
            margin-top: 2cm;
        }

        img {
            width: 80%;
        }
    </style>
</head>

<body>
    <header>
        <h1 style="text-align: center;">กราฟ{{ $header }}</h1>
    </header>
    <main>
        <h2 style="text-align: left ;">{{$dataHeader}}</h2>
        <img src="{{ public_path($chartData) }}">
        <h2 style="text-align: center ;">รายงานวันที่ : {{ $dateStart }} ถึง วันที่
            {{ $dateEnd }}</h2>
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
