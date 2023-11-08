@extends('main_template/body')
@section('body')
    <link rel="stylesheet" href="{{ asset('assets/css/style_dashboard.css') }}">
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
        <h1 class="h3 mb-0 text-gray-800">หน้าหลัก</h1>
    </div>
    <div class="row ">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">จำนวนการขอสื่อ
                                        เดือนพฤศจิกายน</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">10 รายการ</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-left-purple shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">จำนวนการจ่ายสื่อ
                                        เดือนพฤศจิกายน</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">10 รายการ</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row  ">
                                <canvas id="chart-order-line"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>ผู้ขอรับสื่อที่มาขอรับสื่อ 10 อันดับ ประจำปี</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"width="5%">ลำดับ</th>
                                                <th scope="col">ชื่อ - นามกสุล</th>
                                                <th scope="col" class="text-center">จำนวน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i <= 9; $i++)
                                                <tr>
                                                    <td class="text-center">{{ $i + 1 }}</td>
                                                    <td>นายพิชิตชัย ธรรมชัย</td>
                                                    <td class="text-center">{{ 10 - $i }} ครั้ง</td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row my-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>รายการคำขอสื่อที่พร้อมจ่าย</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%" class="text-center" >ลำดับ</th>
                                        <th scope="col" width="36%">รายการ</th>
                                        <th scope="col" width="36%">ผู้ขอรับสื่อ</th>
                                        <th scope="col">เบอร์โทรศัพท์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>หนังสือนิยาย</td>
                                        <td>นายพิชิตชัย ธรรมชัย</td>
                                        <td>0883004952</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">2</th>
                                        <td>หนังสือนิยาย</td>
                                        <td>นายพิชิตชัย ธรรมชัย</td>
                                        <td>0883004952</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>รายการคำขอสื่อที่กำลังผลิต</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%" class="text-center" >ลำดับ</th>
                                        <th scope="col" width="36%">รายการ</th>
                                        <th scope="col" width="36%">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-center">1</th>
                                        <td>หนังสือนิยาย</td>
                                        <td><span class="badge bg-danger"style="font-size:1rem">กำลังผลิต</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-center">2</th>
                                        <td>หนังสือนิยาย</td>
                                        <td><span class="badge bg-warning"style="font-size:1rem">กำลังตรวจเช็ค</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/chart.js-4.4.0/package/dist/chart.umd.js') }}"></script>
    <script type="module">
        function pie_chart_create() {
            const pie_chart = document.getElementById('chart-order-pie').getContext('2d');
            const pie_chart_labels = ['จำนวนการขอสื่อ', 'จำนวนการจ่าย'];
            const pie_chart_data = {
                labels: pie_chart_labels,
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(39, 245, 63, 0.8)',

                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(39, 245, 63)',

                    ],
                    borderWidth: 1
                }]
            };
            const myPieChart = new Chart(pie_chart, {
                type: 'pie',
                data: pie_chart_data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                },
            });
            myPieChart.resize(350, 350);
        };

        function line_chart_create() {
            const line_chart = document.getElementById('chart-order-line').getContext('2d');
            const line_chart_labels = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม',
                'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
            ];
            const line_chart_data = {
                labels: line_chart_labels,
                datasets: [{
                        label: 'จำนวนการขอสื่อ',
                        data: [65, 59, 100, 70, 20, 40, 50, 80, 10, 30, 10, 0],
                        backgroundColor: [
                            'rgba(78, 115, 223, 1)',
                        ],
                        borderColor: [
                            'rgb(78, 115, 223)',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'จำนวนการจ่ายสื่อ',
                        data: [50, 69, 80, 40, 120, 30, 60, 60, 30, 30, 10, 0],
                        backgroundColor: [
                            'rgba(171, 35, 224, 1)',
                        ],
                        borderColor: [
                            'rgb(171, 35, 224)',
                        ],
                        borderWidth: 1
                    }
                ]
            };
            const myLineChart = new Chart(line_chart, {
                type: 'bar',
                data: line_chart_data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'ประจำปี'
                        }
                    }
                },
            });
            myLineChart.resize(1600, 1600);
        }
        $(document).ready(function() {
            // pie_chart_create();
            line_chart_create();
        });
    </script>
@endsection()
