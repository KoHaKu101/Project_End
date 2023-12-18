    <!-- sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="{{ route('dashboard_pd') }}">
                    <img src="{{asset('assets/images/logo/LogoImg.png')}}" class="img-logo" alt="" >
                </a>
            </div>
            @if (session()->get('status') === 1)
            <!-- ของฝ่ายผลิต  -->
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('dashboard_pd') }}" class="sidebar-link">
                        <i class="fa-solid fa-home pe-2"></i>
                        <span class="text-sideBar">หน้าหลัก</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('media_list') }}" class="sidebar-link ">
                        <i class="fa-solid fa-photo-film pe-1"></i>
                        <span class="text-sideBar">สื่อผู้พิการทางสายตา</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('book_list') }}" class="sidebar-link ">
                        <i class="fa-solid fa-book pe-2"></i>
                        <span class="text-sideBar">ข้อมูลหนังสือทั่วไป</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#manage_data"
                        aria-expanded="false" aria-controls="manage_data">
                        <i class="fa-solid fa-sliders pe-2"></i>
                        <span class="text-sideBar">จัดการข้อมูลพื้นฐาน</span>
                    </a>
                    <ul id="manage_data" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('emp_list') }}" class="sidebar-link"><i class="fa-solid fa-caret-right me-2"></i>ข้อมูลเจ้าหน้าที่</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('book_type_list') }}" class="sidebar-link"><i class="fa-solid fa-caret-right me-2"></i>หมวดหมู่หนังสือ</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('media_type_list') }}" class="sidebar-link"><i class="fa-solid fa-caret-right me-2"></i>ประเภทสื่อ</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('setting.list') }}" class="sidebar-link"><i class="fa-solid fa-caret-right me-2"></i>ตั้งค่าทั่วไป</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#copy_media"
                        aria-expanded="false" aria-controls="copy_media">
                        <i class="fa-solid fa-copy pe-2"></i>
                        <span class="text-sideBar">สำเนา</span>
                    </a>
                    <ul id="copy_media" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="{{ route('book_copy_list') }}" class="sidebar-link"><i class="fa-solid fa-caret-right me-2"></i>ข้อมูลสำเนา</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('book_copy_out.list') }}" class="sidebar-link"><i class="fa-solid fa-caret-right me-2"></i>จ่ายสำเนา</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('report_pd') }}" class="sidebar-link ">
                        <i class="fa-regular fa-file-lines pe-2"></i>
                        <span class="text-sideBar">รายงาน</span>
                    </a>
                </li>
            </ul>
            @elseif (session()->get('status') === 2)
            <!-- ของฝ่ายบริการ  -->
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('dashboard_ser') }}" class="sidebar-link">
                        <i class="fa-solid fa-home pe-2"></i>
                        หน้าหลัก
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('receive.list') }}" class="sidebar-link ">
                        <i class="fa-solid fa-book pe-2"></i>
                        รับหนังสือ
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('requestMedia.list') }}" class="sidebar-link ">
                        <i class="fa-solid fa-clipboard-list pe-2"></i>
                        รับคำขอสื่อ
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('mediaOut_list') }}" class="sidebar-link ">
                        <i class="fa-solid fa-file-export pe-2"></i>
                        จ่ายสื่อ
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('order.list') }}" class="sidebar-link " >
                        <i class="fa-solid fa-industry pe-2"></i>
                        สั่งผลิตสื่อ
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('requestUser.list') }}" class="sidebar-link " >
                        <i class="fa-solid fa-users pe-2"></i>
                        ข้อมูลผู้ขอรับสื่อ
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('report_ser') }}" class="sidebar-link ">
                        <i class="fa-regular fa-file-lines pe-2"></i>
                        รายงาน
                    </a>
                </li>
            </ul>
            @endif
        </div>
    </aside>


