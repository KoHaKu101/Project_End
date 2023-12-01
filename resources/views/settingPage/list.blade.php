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
                    <h3>ตั้งค่าทัวไป</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('setting.uploadImg')}}" id="formUpolad" enctype="multipart/form-data">
                        @csrf
                        <div class="row ms-3">
                            <div class="col-lg-12">
                                <h4>อัพโหลดรูปภาพ Logo</h4>
                                <input type="file" class="form-control" id="ImgLogo" name="ImgLogo">
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button form="formUpolad" type="submit" class="btn btn-primary"><i class="fas fa-upload me-2"></i>อัพโหลด</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
@endsection()
