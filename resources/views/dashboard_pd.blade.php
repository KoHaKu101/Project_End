@extends('main_template/body')
@section('body')
    <style>

    </style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
        <h1 class="h3 mb-0 text-gray-800">หน้าหลัก</h1>
    </div>
    <div class="row ">
        <div class="col-lg-8">
            <div class="card" id="card_main_height">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <canvas id="chart-order-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" id="card_sub_height">
                <div class="card-header bg-primary text-white">ตาราง จำนวนสื่อที่ผลิตเสร็จ
                    ประจำเดือน{{ Carbon\Carbon::now()->monthName }} </div>
                <div class="card-body " id="card_sub2_height" style="overflow-y: auto;">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            <table class="table table-bordered border-black">
                                <thead>
                                    <tr>
                                        <th>ประเภทสื่อ</th>
                                        <th class="text-center">จำนวนที่ผลิตเสร็จ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataTypeMedia as $datalist)
                                        <tr>
                                            <td>{{ $datalist->name }}</td>
                                            <td class="text-center">
                                                {{ $dataMedia->where('type_media_id', $datalist->type_media_id)->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card" id="card_main_height2">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <canvas id="barChartRequestMedia"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" id="card_sub_height2">
                <div class="card-header bg-primary text-white">ตาราง จำนวนคำขอสื่อ
                    ประจำเดือน{{ Carbon\Carbon::now()->monthName }} </div>
                <div class="card-body " id="card_sub2_height2" style="overflow-y: auto;">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            <table class="table table-bordered border-black">
                                <thead>
                                    <tr>
                                        <th>ประเภทสื่อ</th>
                                        <th class="text-center">จำนวนคำขอ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRequestMedia->groupBy('type_media_id') as $type_media_id => $datalist)
                                    @php
                                        $data = $dataRequestMedia->where('type_media_id',$type_media_id)->first();
                                    @endphp
                                        <tr>
                                            <td>{{ $data->TypeMedia->name }}</td>
                                            <td class="text-center">
                                                {{ $dataRequestMedia->where('type_media_id',$type_media_id)->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/chart.js-4.4.0/package/dist/chart.umd.js') }}"></script>
    <script>
        Chart.defaults.font.size = 12;
        const currentYear = "{{ Carbon\Carbon::now()->addYear(543)->year }}";

        function line_chart_create() {
            const line_chart = document.getElementById('chart-order-line').getContext('2d');
            let line_chart_labels = [];
            let data = [];
            @foreach ($monthNumberMedia as $key => $value)
                line_chart_labels.push("{{ $key }}");
                data.push({{ $value }});
            @endforeach
            const line_chart_data = {
                labels: line_chart_labels,
                datasets: [{
                    label: 'สื่อสำหรับผู้พิการทางสายตา',
                    data: data,
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
                            text: 'อัตราผลิตสื่อผู้พิการทางสายตา ประจำปี ' + currentYear
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                // Use a callback function to format y-axis labels
                                callback: function(value, index, values) {
                                    // Convert the value to an integer without decimals
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            }
                        }
                    },

                    animation: {
                        onComplete: function() {
                            let height = $('#card_main_height').height();
                            $('#card_sub_height').css('min-height', height);
                            $('#card_sub_height').css('max-height', height);
                            $('#card_sub2_height').css('max-height', height);
                            $('#loading-overlay').hide();
                        }
                    }
                },
            });
            myLineChart.resize(800, 800);
        }

        function barChartRequestMedai() {
            const barChartRequestMedia = document.getElementById('barChartRequestMedia').getContext('2d');
            let barChartRequestMediaLabels = [];
            let data = [];
            @foreach ($monthNumberRequestMedia as $key => $value)
                barChartRequestMediaLabels.push("{{ $key }}");
                data.push({{ $value }});
            @endforeach
            const barChartRequestMediaData = {
                labels: barChartRequestMediaLabels,
                datasets: [{
                    label: 'คำขอสื่อ',
                    data: data,
                    backgroundColor: [
                        'rgba(205, 50, 200, 0.2)',
                    ],
                    borderColor: [
                        'rgb(205, 50, 200)',
                    ],
                    borderWidth: 1
                }]
            };
            const myBarChart2 = new Chart(barChartRequestMedia, {
                type: 'bar',
                data: barChartRequestMediaData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'คำขอสื่อ ประจำปี ' + currentYear
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                beginAtZero: true,
                                // Use a callback function to format y-axis labels
                                callback: function(value, index, values) {
                                    // Convert the value to an integer without decimals
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            }
                        }
                    },

                    animation: {
                        onComplete: function() {
                            let height = $('#card_main_height').height();
                            $('#card_sub_height2').css('min-height', height);
                            $('#card_sub_height2').css('max-height', height);
                            $('#card_sub2_height2').css('max-height', height);
                            $('#loading-overlay').hide();
                        }
                    }
                },
            });
            myBarChart2.resize(800, 800);
        }
        $(document).ready(function() {
            $('#loading-overlay').show();
            line_chart_create();
            barChartRequestMedai();
        });
    </script>
@endsection()
