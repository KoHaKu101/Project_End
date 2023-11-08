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
                        <div class="col-lg-12">
                            <h4>กรุณาเลือกรายงานที่จะแสดงผล</h4>
                            <select class="form-select col-lg-6" aria-label="Default select example">
                                <option value="1">รายงานการรับหนังสือ</option>
                                <option value="2">รายงานการรับหนังสือ</option>
                                <option value="3">รายงานการรับหนังสือ</option>
                                <option value="3">รายงานการรับหนังสือ</option>
                                <option value="3">รายงานการรับหนังสือ</option>
                            </select>
                            <h4 class="mt-2">เลือกชนิดรายงาน</h4>
                            <select class="form-select col-lg-6" aria-label="Default select example">
                                <option value="1">รายงานรายวัน</option>
                                <option value="2">รายงานรายเดือน</option>
                                <option value="3">รายงานรายปี</option>
                            </select>
                            <h4 class="mt-2">ระบุวัน เดือน ปี</h4>
                            <div class="row">
                                <div class="col-lg-2 text-center ">
                                    <select class="form-select col-lg-6" aria-label="Default select example">
                                        <?php
                                        for ($day = 1; $day <= 31; $day++) {
                                            $dayValue = str_pad($day, 2, '0', STR_PAD_LEFT);
                                            echo "<option value='$dayValue'>$day</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 text-center ">
                                    <select class="form-select col-lg-6" aria-label="Default select example">
                                        <?php
                                        $months = [
                                            '01' => 'มกราคม',
                                            '02' => 'กุมภาพันธ์',
                                            '03' => 'มีนาคม',
                                            '04' => 'เมษายน',
                                            '05' => 'พฤษภาคม',
                                            '06' => 'มิถุนายน',
                                            '07' => 'กรกฎาคม',
                                            '08' => 'สิงหาคม',
                                            '09' => 'กันยายน',
                                            '10' => 'ตุลาคม',
                                            '11' => 'พฤศจิกายน',
                                            '12' => 'ธันวาคม',

                                            // Add the remaining months
                                        ];
                                        foreach ($months as $monthValue => $monthName) {
                                            echo "<option value='$monthValue'>$monthName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 text-center ">
                                    <select class="form-select col-lg-6" aria-label="Default select example">
                                        <?php
                                        $currentYear = date('Y');
                                        $startYear = $currentYear - 100; // Change this to set your desired range of years

                                        for ($year = $currentYear; $year >= $startYear; $year--) {
                                            echo "<option value='$year'>$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file me-2"></i>ออกรายงาน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

        });

        // function getDate(){
        //     var today = new Date();
        //     console.log(today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2));
        //     // $.("#date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
        // }
    </script>
@endsection()
