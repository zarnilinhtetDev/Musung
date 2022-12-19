<div class="wrapper d-flex align-items-stretch">

    @viewer
    <nav id="sidebar" class="d-flex flex-column flex-shrink-0 justify-content-between active">
        <div class="p-4">
            <div class="sidebar-header">
                <a href="#"><img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="200"
                        height="auto" />
                </a>
            </div>
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
                </div>
                <div class="mx-3 not-mobile">
                    <a class="fw-bolder fs-5 my-auto navbar-heading-text" href="{{ url('/home') }}">
                        <img src="{{asset('img/logo_2.png')}}" class="img-fluid rounded-3" alt="Company Logo" width="60"
                            height="auto" />
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>
                <div class="mx-2 mobile">
                    <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60" height="auto" />
                </div>
            </div>
        </nav>
        @yield('content_2')
    </div>
    @endviewer
    @superadmin
    <nav id="sidebar" class="d-flex flex-column flex-shrink-0 justify-content-between active">
        <div class="p-4">
            <div class="sidebar-header">
                <a href="#"><img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="200"
                        height="auto" />
                </a>
            </div>
            <ul class="nav nav-pills flex-column list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ url('/home') }}" class="sidebar-link"><img src="img/icon/dashboard.png"
                            class="img-fluid rounded-3" alt="Dashboard" width="25" height="auto" />
                        &nbsp;Dashboard</a>
                </li>
                <li class="">
                    <a href="{{ url('/menu') }}" class="sidebar-link"><img src="img/icon/home.png"
                            class="img-fluid rounded-3" alt="Home" width="25" height="auto" /> &nbsp;Main
                        Menu</a>
                </li>
                <li>
                    <a class="sidebar-link" href="#account_management" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="img/icon/team_icon.png" class="img-fluid rounded-3" alt="Team" width="25"
                            height="auto" />
                        &nbsp;Account Management
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
                        <img src="img/icon/target_line.png" class="img-fluid rounded-3" alt="Target Line" width="25"
                            height="auto" />
                        &nbsp;Production Status
                    </a>
                    <ul class="collapse" id="target" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/live_dash') }}">Today</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_history') }}">History</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="#line" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="img/icon/line_manage.png" class="img-fluid rounded-3" alt="Line Management" width="25"
                            height="auto" />
                        &nbsp;Line Managment
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
                    <a class="sidebar-link" href="{{ url('/report') }}"> <img src="img/icon/report.png"
                            class="img-fluid rounded-3" alt="Report" width="25" height="auto" />
                        &nbsp;Report
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" href="{{ url('/theme_setting') }}"><img
                            src="{{asset('img/icon/theme.png')}}" class="img-fluid rounded-3" alt="Theme" width="25"
                            height="auto" />
                        &nbsp;Change Theme
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
                </div>
                <div class="mx-3 not-mobile">
                    <a class="fw-bolder fs-5 my-auto navbar-heading-text" href="{{ url('/home') }}">
                        <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60"
                            height="auto" />
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>
                <div class="mx-2 mobile">
                    <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60" height="auto" />
                </div>
            </div>
        </nav>
        @yield('content_2')
    </div>
    @endsuperadmin

    @owner
    <nav id="sidebar" class="d-flex flex-column flex-shrink-0 justify-content-between active">
        <div class="p-4">
            <div class="sidebar-header">
                <a href="#"><img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="200"
                        height="auto" />
                </a>
            </div>
            <ul class="nav nav-pills flex-column list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ url('/home') }}" class="sidebar-link"><img src="img/icon/dashboard.png"
                            class="img-fluid rounded-3" alt="Dashboard" width="25" height="auto" />
                        &nbsp;Dashboard</a>
                </li>
                <li class="">
                    <a href="{{ url('/menu') }}" class="sidebar-link"><img src="img/icon/home.png"
                            class="img-fluid rounded-3" alt="Home" width="25" height="auto" /> &nbsp;Main
                        Menu</a>
                </li>
                <li>
                    <a class="sidebar-link" href="#account_management" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="img/icon/team_icon.png" class="img-fluid rounded-3" alt="Team" width="25"
                            height="auto" />
                        &nbsp;Account Management
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
                        <img src="img/icon/target_line.png" class="img-fluid rounded-3" alt="Target Line" width="25"
                            height="auto" />
                        &nbsp;Production Status
                    </a>
                    <ul class="collapse" id="target" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/live_dash') }}">Today</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_history') }}">History</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="#line" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="img/icon/line_manage.png" class="img-fluid rounded-3" alt="Line Management" width="25"
                            height="auto" />
                        &nbsp;Line Managment
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
                    <a class="sidebar-link" href="{{ url('/report') }}"> <img src="img/icon/report.png"
                            class="img-fluid rounded-3" alt="Report" width="25" height="auto" />
                        &nbsp;Report
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" href="{{ url('/theme_setting') }}"><img src="img/icon/theme.png"
                            class="img-fluid rounded-3" alt="Theme" width="25" height="auto" />
                        &nbsp;Change Theme
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
                </div>
                <div class="mx-3 not-mobile">
                    <a class="fw-bolder fs-5 my-auto navbar-heading-text" href="{{ url('/home') }}">
                        <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60"
                            height="auto" />
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>
                <div class="mx-2 mobile">
                    <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60" height="auto" />
                </div>
            </div>
        </nav>
        @yield('content_2')
    </div>
    @endowner

    @admin
    <nav id="sidebar" class="d-flex flex-column flex-shrink-0 justify-content-between active">
        <div class="p-4">
            <div class="sidebar-header">
                <img src="{{asset('img/logo_2.png')}}" class="img-fluid rounded-3" alt="Company Logo" width="200"
                    height="auto" />
                </a>
            </div>
            <ul class="nav nav-pills flex-column list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ url('/home') }}" class="sidebar-link"><img src="{{asset('img/icon/dashboard.png')}}"
                            class="img-fluid rounded-3" alt="Dashboard" width="25" height="auto" />
                        &nbsp;Dashboard</a>
                </li>
                <li class="">
                    <a href="{{ url('/menu') }}" class="sidebar-link"><img src="{{asset('img/icon/home.png')}}"
                            class="img-fluid rounded-3" alt="Home" width="25" height="auto" /> &nbsp;Main
                        Menu</a>
                </li>
                <li>
                    <a class="sidebar-link" href="#account_management" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="{{asset('img/icon/team_icon.png')}}" class="img-fluid rounded-3" alt="Team" width="25"
                            height="auto" />
                        &nbsp;Account Management
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
                        <img src="{{asset('img/icon/target_line.png')}}" class="img-fluid rounded-3" alt="Target Line"
                            width="25" height="auto" />
                        &nbsp;Production Status
                    </a>
                    <ul class="collapse" id="target" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/live_dash') }}">Today</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_history') }}">History</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="#line" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="{{asset('img/icon/line_manage.png')}}" class="img-fluid rounded-3"
                            alt="Line Management" width="25" height="auto" />
                        &nbsp;Line Managment
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
                    <a class="sidebar-link" href="{{ url('/report') }}"> <img src="{{asset('img/icon/report.png')}}"
                            class="img-fluid rounded-3" alt="Report" width="25" height="auto" />
                        &nbsp;Report
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" href="{{ url('/theme_setting') }}"><img
                            src="{{asset('img/icon/theme.png')}}" class="img-fluid rounded-3" alt="Theme" width="25"
                            height="auto" />
                        &nbsp;Change Theme
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
                </div>
                <div class="mx-3 not-mobile">
                    <a class="fw-bolder fs-5 my-auto navbar-heading-text" href="{{ url('/home') }}">
                        <img src="{{asset('img/logo_2.png')}}" class="img-fluid rounded-3" alt="Company Logo" width="60"
                            height="auto" />
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>
                <div class="mx-2 mobile">
                    <img src="{{asset('img/logo_2.png')}}" class="img-fluid rounded-3" alt="Company Logo" width="60"
                        height="auto" />
                </div>
            </div>
        </nav>
        @yield('content_2')
    </div>
    @endadmin

    @operator
    <nav id="sidebar" class="d-flex flex-column flex-shrink-0 justify-content-between active">
        <div class="p-4">
            <div class="sidebar-header">
                <a href="#"><img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="200"
                        height="auto" />
                </a>
            </div>
            <ul class="nav nav-pills flex-column list-unstyled components mb-5">
                <li class="active">
                    <a href="{{ url('/home') }}" class="sidebar-link"><img src="img/icon/dashboard.png"
                            class="img-fluid rounded-3" alt="Dashboard" width="25" height="auto" />
                        &nbsp;Dashboard</a>
                </li>
                <li class="">
                    <a href="{{ url('/menu') }}" class="sidebar-link"><img src="img/icon/home.png"
                            class="img-fluid rounded-3" alt="Home" width="25" height="auto" /> &nbsp;Main
                        Menu</a>
                </li>
                <li>
                    <a class="sidebar-link" href="#account_management" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="img/icon/team_icon.png" class="img-fluid rounded-3" alt="Team" width="25"
                            height="auto" />
                        &nbsp;Account Management
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
                        <img src="img/icon/target_line.png" class="img-fluid rounded-3" alt="Target Line" width="25"
                            height="auto" />
                        &nbsp;Production Status
                    </a>
                    <ul class="collapse" id="target" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/live_dash') }}">Today</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_history') }}">History</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="#line" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">
                        <img src="img/icon/line_manage.png" class="img-fluid rounded-3" alt="Line Management" width="25"
                            height="auto" />
                        &nbsp;Line Managment
                    </a>
                    <ul class="collapse" id="line" role="list">
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_detail') }}">Line Detail</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="{{ url('/line_setting') }}">Line Setting</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-link" href="{{ url('/report') }}"> <img src="img/icon/report.png"
                            class="img-fluid rounded-3" alt="Report" width="25" height="auto" />
                        &nbsp;Report
                    </a>
                </li>
                <li>
                    <a class="sidebar-link" href="{{ url('/theme_setting') }}"><img src="img/icon/theme.png"
                            class="img-fluid rounded-3" alt="Theme" width="25" height="auto" />
                        &nbsp;Change Theme
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
                </div>
                <div class="mx-3 not-mobile">
                    <a class="fw-bolder fs-5 my-auto navbar-heading-text" href="{{ url('/home') }}">
                        <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60"
                            height="auto" />
                        MUSUNG Garment Line Target and Production Data
                    </a>
                </div>
                <div class="mx-2 mobile">
                    <img src="img/logo_2.png" class="img-fluid rounded-3" alt="Company Logo" width="60" height="auto" />
                </div>
            </div>
        </nav>
        @yield('content_2')
    </div>
    @endoperator

    @line_manager
    <!-- Page Content  -->
    <div id="content" class="container-fluid">
        <nav class="navbar navbar-expand-lg my-2">
            <div class="container-fluid p-0">
                <div class="nav-heading nav-heading-2 text-center m-auto w-80" style="padding-left:5rem;">
                    <h1 class="fw-bolder fs-4 my-auto text-secondary">
                        MUSUNG Garment Line Entry
                    </h1>
                </div>

                <div class="">
                    <a class="fw-bolder dropdown-item text-danger fs-5" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        Log Out
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
