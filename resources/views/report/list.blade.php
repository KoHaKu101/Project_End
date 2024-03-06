@extends('main_template/body')
@section('body')
    <style>
        .card-body .row>div {
            padding-bottom: calc(var(--bs-gutter-x) * .5);
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>รายงานทั่วไป</h3>
                </div>
                <div class="card-body">
                    <div class="row ms-3">
                        <form action="{{ route('report.pdf') }}" id="form_report" target="_blank" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-lg-12">
                                <h4>กรุณาเลือกรายงาน</h4>
                                <select class="form-select col-lg-6" id="type_report" name="type_report">
                                    <option value="media">รายงาน การผลิตสื่อ</option>
                                    <option value="mediaout">รายงาน การให้บริการสื่อ</option>
                                    <option value="request_user">รายงาน ผู้มาขอรับสื่อ</option>
                                    <option value="media_summary">กราฟรายงาน ผลสรุปการผลิตสื่อ</option>
                                    <option value="mediaout_summary">กราฟรายงาน ผลสรุปการให้บริการสื่อ</option>
                                </select>
                            </div>
                            <div class="col-lg-12" id="div_type_mediaOut">
                                <h4>กรุณาระบุประเภทสื่อที่ต้องการออกรายงาน</h4>
                                <select class="form-select col-lg-6" id="type_mediaOut" name="type_mediaOut">
                                    <option value="all">ทั้งหมด</option>
                                    @foreach ($dataTypeMedia as $datalistTypeMedia)
                                        <option value="{{ $datalistTypeMedia->type_media_id }}">
                                            {{ $datalistTypeMedia->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12" id="div_type_status">
                                <h4>กรุณาระบุสถานะ</h4>
                                <select class="form-select col-lg-6" id="type_status" name="type_status">
                                    <option value="all">ทั้งหมด</option>
                                    <option value="1">กำลังผลิต</option>
                                    <option value="2">ผลิตเสร็จ</option>
                                </select>
                            </div>
                            <div class="col-lg-12" id="div_status" hidden>
                                <h4>กรุณาระบุสถานะ</h4>
                                <select class="form-select col-lg-6" id="status" name="status">
                                    <option value="all">ทั้งหมด</option>
                                    <option value="1">ให้บริการสำเร็จ</option>
                                    <option value="2">ยกเลิกรายการ</option>
                                </select>
                            </div>
                            <div class="col-lg-12" id="div_request_status" hidden>
                                <h4>กรุณาระบุสถานะคำขอ</h4>
                                <select class="form-select col-lg-6" id="request_status" name="request_status">
                                    <option value="all">ทั้งหมด</option>
                                    <option value="1">คำขอที่สำเร็จ</option>
                                    <option value="2">คำขอที่ยกเลิก</option>
                                    <option value="3">คำขอที่ตกค้าง</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="mt-2">ระบุวัน เดือน ปี ที่เริ่ม</h4>
                                        <input type="date" class="form-control" id="dateStart" name="dateStart"
                                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 class="mt-2">ถึง ระบุวัน เดือน ปี ที่สิ้นสุด</h4>
                                        <input type="date" class="form-control" id="dateEnd" name="dateEnd"
                                            value="{{ Carbon\Carbon::now()->addDay(1)->format('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="chartData" name="chartData">
                            <div class="col-lg-12" id="chartImg">
                                <canvas id="chartImgData" height="10vh" width="20vw" hidden></canvas>
                            </div>

                        </form>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="button" id="submit_report" onclick="SubmitForm('submit_report','form_report')"
                                class="btn btn-primary">
                                <i class="fas fa-file me-2"></i>ออกรายงาน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/chart.js-4.4.0/package/dist/chart.umd.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        Chart.defaults.font.size = 27;
        Chart.register(ChartDataLabels);

        const type_report = $('#type_report');
        const div_type_mediaOut = $('#div_type_mediaOut');
        const div_type_status = $('#div_type_status');
        const div_status = $('#div_status');
        const div_request_status = $('#div_request_status');
        const type_status = $('#type_status');
        const status = $('#status');
        const type_mediaOut = $('#type_mediaOut');
        const dateStart = $('#dateStart');
        const dateEnd = $('#dateEnd');
        const arrayChart = ['media_summary', 'mediaout_summary'];

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        type_report.on('change', function() {
            let get_value = type_report.val();
            div_type_mediaOut.attr('hidden', get_value == 'request_user' || arrayChart.includes(get_value));
            div_type_status.attr('hidden', !(get_value == 'media' || get_value == 'media_summary'));
            div_status.attr('hidden', !(get_value == 'mediaout' || get_value == 'mediaout_summary'));
            div_request_status.attr('hidden', get_value != 'request_user');
            if (arrayChart.includes(get_value)) {
                createChartJs();
            }
        })
        dateStart.add(dateEnd).add(type_status).add(status).on('change', function() {
            if (arrayChart.indexOf(type_report.val()) !== -1) {
                createChartJs();
            }
        })

        $('#submit_report').on('click', function(e) {
            setTimeout(function() {
                $(document).trigger('formEnd');
            }, 500)

        })
        $(document).on({
            formEnd: function() {
                $('#submit_report').attr('disabled', false);
                $('#submit_report').html('<i class="fas fa-file me-2"></i>ออกรายงาน');
                $('#loading-overlay').hide();
            },
        });

        function createChartJs() {
            let dataChart = [];
            let chart_labels = [];
            let url = "{{ route('report.chart') }}";
            let data = {
                type_report: type_report.val(),
                type_status: type_status.val(),
                status: status.val(),
                startDate: dateStart.val(),
                endDate: dateEnd.val(),

            }
            let chart = document.getElementById('chartImgData').getContext('2d');
            let button = $('#submit_report');
            button.attr('disabled', true);
            button.html('<i class="fas fa-arrows-rotate fa-spin me-2"></i>กำลังโหลด');

            $.ajax({
                type: "GET",
                url: url,
                data: data,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    for (var key in response.data) {
                        var value = response.data[key];
                        chart_labels.push(key);
                        dataChart.push(value);
                    }
                    let chart_data = {
                        labels: chart_labels,
                        datasets: [{
                            label: 'ข้อมูลจำนวนสื่อทั้งหมด',
                            data: dataChart,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                            ],
                        }]
                    };
                    let myChart = new Chart(chart, {
                        type: 'bar',
                        data: chart_data,
                        options: {
                            plugins: {

                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    formatter: Math.round,
                                    font: {
                                        size: 27
                                    },
                                    padding: {
                                        bottom: -1
                                    }
                                },
                                legend: {
                                    display: false,
                                },
                            },
                            layout: {
                                padding: {
                                    top: 80
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
                                    let chartData = myChart.toBase64Image();
                                    $('#chartData').val(chartData);
                                    myChart.destroy();
                                    button.attr('disabled', false);
                                    button.html('<i class="fas fa-file me-2"></i>ออกรายงาน');
                                }
                            }
                        },
                    });
                }
            });
        };
    </script>
@endsection()
