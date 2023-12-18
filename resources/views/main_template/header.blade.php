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
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="btn btn-sidebar-toggle" type="button" id="btnSideBarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="d-flex">
            <button class="btn " type="button">
                <i class="fas fa-bell"></i>
            </button>
            <div class="dropdown">
                <button class="btn btn-block dropdown-toggle" type="button" id="dropdownUser" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user me-2"></i>{{ $emp_data->f_name }}<i class="fa-solid fa-chevron-down mx-2"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownUser">
                    <a class="dropdown-item" href="{{route('logout')}}">ออกจากระบบ</a>
                </div>
            </div>

        </div>
    </div>
</nav>
