    <!-- sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <a href="{{ route('dashboard_pd') }}">
                <img src="{{ asset('assets/images/logo/LogoImg.png') }}" class="img-logo">
            </a>
        </div>
        <div class="sidebar-menu">
            @if (session()->get('status') === 1)
                @php
                    $manage_data_route_list = ['emp.list' => 'emp.list', 'book_type.list' => 'book_type.list', 'media_type.list' => 'media_type.list', 'setting.list' => 'setting.list'];
                    $copy_media_route_list = ['book_copy.list' => 'book_copy.list', 'book_copy_out.list' => 'book_copy_out.list'];
                    $currentRoute = request()
                        ->route()
                        ->getName();
                    $manage_data_list = '';
                    $copy_media = '';
                    if (in_array($currentRoute, $manage_data_route_list)) {
                        $manage_data_list = 'active';
                    }
                    if (in_array($currentRoute, $copy_media_route_list)) {
                        $copy_media = 'active';
                    }
                @endphp
                <!-- ของฝ่ายผลิต  -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item ">
                        <a href="{{ route('dashboard_pd') }}" class="sidebar-link @active('dashboard_pd')">
                            <i class="fa-solid fa-home pe-2"></i>
                            <span class="text-sideBar">หน้าหลัก</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('media.list') }}" class="sidebar-link @active('media.list')  ">
                            <i class="fa-solid fa-photo-film pe-1"></i>
                            <span class="text-sideBar">สื่อผู้พิการทางสายตา</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('book.list') }}" class="sidebar-link @active('book.list')  ">
                            <i class="fa-solid fa-book pe-2"></i>
                            <span class="text-sideBar">ข้อมูลหนังสือทั่วไป</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" id="manage_data_list"
                            class="sidebar-link dropdown-list collapsed {{ $manage_data_list }} "
                            data-bs-toggle="collapse" data-bs-target="#manage_data" aria-expanded="false"
                            aria-controls="manage_data">
                            <i class="fa-solid fa-sliders pe-2"></i>
                            <span class="text-sideBar">จัดการข้อมูลพื้นฐาน</span>
                        </a>
                        <ul id="manage_data" class="sidebar-dropdown list-unstyled collapse "
                            data-bs-parent="#manage_data">
                            <li class="sidebar-item">
                                <a href="{{ route('emp.list') }}" class="sidebar-link @active('emp.list')"><i
                                        class="fa-solid fa-caret-right me-2"></i>ข้อมูลเจ้าหน้าที่</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('book_type.list') }}" class="sidebar-link @active('book_type.list')"><i
                                        class="fa-solid fa-caret-right me-2"></i>หมวดหมู่หนังสือ</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('media_type.list') }}" class="sidebar-link @active('media_type.list')"><i
                                        class="fa-solid fa-caret-right me-2"></i>ประเภทสื่อ</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('setting.list') }}" class="sidebar-link @active('setting.list')"><i
                                        class="fa-solid fa-caret-right me-2"></i>ตั้งค่าทั่วไป</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" id="copy_media_list"
                            class="sidebar-link dropdown-list collapsed {{ $copy_media }}" data-bs-toggle="collapse"
                            data-bs-target="#copy_media" aria-expanded="false" aria-controls="copy_media">
                            <i class="fa-solid fa-copy pe-2"></i>
                            <span class="text-sideBar">สำเนา</span>
                        </a>
                        <ul id="copy_media" class="sidebar-dropdown list-unstyled collapse "
                            data-bs-parent="#copy_media">
                            <li class="sidebar-item">
                                <a href="{{ route('book_copy.list') }}" class="sidebar-link @active('book_copy.list')"><i
                                        class="fa-solid fa-caret-right me-2"></i>ข้อมูลสำเนา</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('book_copy_out.list') }}" class="sidebar-link @active('book_copy_out.list')"><i
                                        class="fa-solid fa-caret-right me-2"></i>จ่ายสำเนา</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('report_pd') }}" class="sidebar-link @active('report_pd')">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            <span class="text-sideBar">รายงาน</span>
                        </a>
                    </li>
                </ul>
            @elseif (session()->get('status') === 2)
                <!-- ของฝ่ายบริการ  -->
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="{{ route('dashboard_ser') }}" class="sidebar-link @active('dashboard_ser')">
                            <i class="fa-solid fa-home pe-2"></i>
                            <span class="text-sideBar">หน้าหลัก</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('receive.list') }}" class="sidebar-link @active('receive.list') ">
                            <i class="fa-solid fa-book pe-2"></i>
                            <span class="text-sideBar">รับหนังสือ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('requestMedia.list') }}" class="sidebar-link @active('requestMedia.list') ">
                            <i class="fa-solid fa-clipboard-list pe-2"></i>
                            <span class="text-sideBar">รับคำขอสื่อ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('mediaOut.list') }}" class="sidebar-link @active('mediaOut.list') ">
                            <i class="fa-solid fa-file-export pe-2"></i>
                            <span class="text-sideBar">จ่ายสื่อ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('order.list') }}" class="sidebar-link @active('order.list') ">
                            <i class="fa-solid fa-industry pe-2"></i>
                            <span class="text-sideBar">สั่งผลิตสื่อ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('requestUser.list') }}" class="sidebar-link  @active('requestUser.list')">
                            <i class="fa-solid fa-users pe-2"></i>
                            <span class="text-sideBar">ข้อมูลผู้ขอรับสื่อ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('report_ser') }}" class="sidebar-link  @active('report_ser')">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            <span class="text-sideBar">รายงาน</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>

    </aside>
