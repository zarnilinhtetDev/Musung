<div class="wrapper d-flex align-items-stretch">

    @admin
    <nav id="sidebar" class="d-flex flex-column flex-shrink-0 justify-content-between active">
        <div class="p-4">
            <div class="sidebar-header">
                <a href="#"><img src="https://www.nawpic.com/media/2020/mountain-nawpic-5.jpg"
                        class="img-fluid rounded-3" alt="Company Logo" width="200" height="auto" />
                </a>
            </div>
            <ul class="nav nav-pills flex-column list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ url('/home') }}" class="sidebar-link"><span class="fa fa-home mr-3"></span>Dashboard</a>
                </li>
                <li>
                    <a class="sidebar-link" href="#account_management" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <i class="fas fa-user"></i>
                        Account Management
                    </a>
                    <ul class="collapse" id="account_management" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/member') }}">Member</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="#target" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <i class="fas fa-user"></i>
                        Target Lines
                    </a>
                    <ul class="collapse" id="target" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/live_dash') }}">Today Lines</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_history') }}">Line History</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="#line" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <i class="fas fa-user"></i>
                        Line Managment
                    </a>
                    <ul class="collapse" id="line" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_entry') }}">Line Entry</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_detail') }}">Line Detail</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_setting') }}">Line Setting</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="{{ url('/report') }}"> <i class="fas fa-user"></i>
                        Report
                    </a>
                </li>
            </ul>
        </div>
        <div class="">
            <div class="">
                <button onclick="toggle_div_fun('sectiontohide');"
                    class="d-flex align-items-center justify-content-evenly w-100 text-start border-0">
                    <i class="fas fa-user-circle fa-3x"></i><span style="word-break: break-word;">{{ Auth::user()->name
                        }}</span>
                    <i class="fas fa-arrow-up"></i>
                </button>
            </div>
            <div id="sectiontohide" class="section-to-hide" style="display: none;">
                <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    <!-- Page Content  -->
    <div class="container-fluid" id="content">
        <button class="btn btn-mode" type="button" id="btn_navbar_close" href="#collapse_div">
            <span class="text-white">Hide Navigation Bar</span>
        </button>
        <nav class="navbar navbar-expand-lg m-0 p-3" id="collapse_div">
            <div class="container-fluid p-0 justify-content-start">
                <div>
                    <button type="button" id="sidebarCollapse" class="btn">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    {{-- <img src="https://www.nawpic.com/media/2020/mountain-nawpic-5.jpg" class="img-fluid rounded-3"
                        alt="Company Logo" width="60" height="auto" /> --}}
                    {{-- <span class="fw-bolder fs-5 my-auto" style="color:#6495ed;">
                        MUSUNG Garment Line Target and Production Data
                    </span> --}}
                </div>
                <div class="mx-3 not-mobile">
                    <a class="fw-bolder fs-5 my-auto" href="{{ url('/home') }}" style="color:#6495ed;">
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>
                <div class="mx-2 mobile">
                    <img src="https://www.nawpic.com/media/2020/mountain-nawpic-5.jpg" class="img-fluid rounded-3"
                        alt="Company Logo" width="60" height="auto" />
                </div>
            </div>
        </nav>
        @yield('content_2')
    </div>
    @endadmin

    @line_manager
    <!-- Page Content  -->
    <div id="content" class="container-fluid" style="padding:0;">
        <nav class="navbar navbar-expand-lg my-2">
            <div class="container-fluid">
                <div class="nav-heading nav-heading-2 text-center m-auto w-75">
                    <a class="fw-bolder fs-5 my-auto" href="{{ url('/home') }}" style="color:#6495ed;">
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>

                <div class="bg-danger">
                    <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>

        @yield('content_2')
    </div>
    @endline_manager

</div>
