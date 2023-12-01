@extends('main_template/body')
@section('body')
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
    <h1 class="h3 mb-0 text-gray-800">หน้าหลัก</h1>
</div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                            <canvas id="chart-order-line" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body ">
                    <div class="row d-flex justify-content-center">
                            <canvas id="chart-order-pie" height="40vh" width="80vw"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>รายการสั่งผลิตสื่อ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card rounded-3">
                                <div class="card-body p-4">
                                    <table class="table mb-4">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">รายการ</th>
                                                <th scope="col">สถานะ</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <td><p>หนังสือนิยาย</p><i>ผู้หมอบหมาย พิชิตชัย ธรรมชัย</i></td>
                                                <td>รอรับงาน</td>
                                                <td><a href="{{ route('media_list') }}" class="btn btn-success ms-1">รับงาน</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <td><p>หนังสือนิยาย</p><i>ผู้หมอบหมาย พิชิตชัย ธรรมชัย</i></td>
                                                <td>รอรับงาน</td>
                                                <td><a href="{{ route('media_list') }}" class="btn btn-success ms-1">รับงาน</a></td>

                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>หนังสือที่มีคนสั่งมากที่สุด 10 รายการ</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card rounded-3">
                                <div class="card-body p-4">
                                    <table class="table mb-4">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">รายการ</th>
                                                <th scope="col" class="text-center">จำนวนคนสั่ง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0 ; $i <=9 ; $i++)
                                            <tr>
                                                <td >{{ $i+1 }}</td>
                                                <td>
                                                    <p>หนังสือนิยาย</p>
                                                </td>
                                                <td class="text-center">{{ rand(10,100) }}</td>

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
    <script src="{{ asset('assets/chart.js-4.4.0/package/dist/chart.umd.js') }}"></script>
    <script type="module">
        function pie_chart_create() {
            const pie_chart = document.getElementById('chart-order-pie').getContext('2d');
            const pie_chart_labels = ['รายการสั่งผลิต', 'ผลิตเสร็จตามรายการสั่ง'];
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
                        title: {
                            display: true,
                            text: 'ประจำปี'
                        }
                    }
                },
            });
            myPieChart.resize(400, 400);
        };

        function line_chart_create() {
            const line_chart = document.getElementById('chart-order-line').getContext('2d');
            const line_chart_labels = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
            const line_chart_data = {
                labels: line_chart_labels,
                datasets: [{
                    label: 'สื่อสำหรับผู้พิการทางสายตา',
                    data: [65, 59, 100, 70, 20, 40, 50, 80, 10, 30,40,0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                    ],
                    borderWidth: 1
                }]
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
                            text: 'อัตราผลิตสื่อผู้พิการทางสายตา ประจำปี'
                        }
                    }
                },
            });
        myLineChart.resize(800, 800);
        }
        $(document).ready(function () {
            pie_chart_create();
            line_chart_create();
        });
    </script>
@endsection()
