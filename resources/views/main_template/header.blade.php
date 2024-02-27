<style>
    .dropdown-toggle::after {
        display: none !important;
    }

    .dropdown {
        display: inline-block;
    }

    .dropdown-menu {
        min-width: 100%;
        width: 100%;
    }

    .dropdown-item {
        width: 100%;
        white-space: nowrap;
        /* ป้องกันข้อความล้นบรรทัด */
        overflow: hidden;
        /* ซ่อนข้อความที่ล้นออกนอกขอบเขต */
        text-overflow: ellipsis;
    }
    .dropdown-bell{
        left: auto !important;
        right: 0.2cm ;
        min-width: 30%!important;
        width: 30% !important;
    }
    #bell{
        position: relative !important;
    }
    .badge-bell{
        position: absolute !important;
        right: -2px;
        top: -3px !important;
        border-radius: 20px !important;
        font-size: 13px !important
    }

</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="btn btn-sidebar-toggle" type="button" id="btnSideBarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex">
            <button class="btn" type="button" id="bell" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-lg"></i>
                <span class="badge badge-bell bg-danger" id="number_bell"></span>
            </button>
            <div class="dropdown-menu dropdown-bell" aria-labelledby="bell">
                <div class="col-md-12">
                    <p style="padding-left: 0.3cm;margin-bottom: -0.5rem!important;">แจ้งเตือน คำขอสื่อ</p>
                    <hr>
                </div>
                <div class="col-md-12" id="bell_detail">
                </div>
            </div>
            <div class="dropdown" >
                <button class="btn btn-block dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" style="width: 4cm;">
                    <i class="fas fa-user me-2"></i>{{ $emp_data->f_name }}<i class="fa-solid fa-chevron-down mx-2"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownUser">
                    <a class="dropdown-item" href="{{route('logout')}}">ออกจากระบบ</a>
                </div>
            </div>

        </div>
    </div>
</nav>
