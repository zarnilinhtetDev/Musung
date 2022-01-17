<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active">
        <div class="p-4">
            <div class="sidebar-header">
                <a href="#"><img src="https://www.nawpic.com/media/2020/mountain-nawpic-5.jpg"
                        class="img-fluid rounded-3" alt="Company Logo" width="200" height="auto" />
                </a>
            </div>
            <ul class="list-unstyled components mb-5">
                <li class="active">
                    <a href="#" class="sidebar-link"><span class="fa fa-home mr-3"></span>Dashboard</a>
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
                        <li class="custom-li">
                            <a class="sidebar-link" href="#">Operator</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="#">Line Manager</a>
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
                            <a class="sidebar-link" href="#">Today Lines</a>
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
                            <a class="sidebar-link" href="#">Line Detail</a>
                        </li>
                        <li class="custom-li">
                            <a class="sidebar-link" href="#">Line Setting</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Page Content  -->
    <div id="content" class="container-fluid" style="padding:0;">
        <nav class="navbar navbar-light bg-transparent" style="margin-bottom:10px;">
            <button type="button" id="sidebarCollapse" class="btn">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <div class="nav-heading">
                <a class="navbar-brand text-white" href="{{ url('/home') }}">
                    MUSAN Garment All Line Target and Actual Production Data
                </a>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                {{-- @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif --}}
                @else
                <li class="nav-item dropdown">
                    <button onclick="myFunction()" class="dropbtn">{{ Auth::user()->name }}</button>
                    <div id="myDropdown" class="dropdown-content dropdown-content-2">
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </nav>
        <div class="container-fluid mobile-heading">
            <h3 style="background-color:#6495ed; color: #fff; padding: 0.5rem; border-radius: 8px;">MUSAN Garment All
                Line Target and Actual Production Data</h3>
        </div>
        @yield('content_2')
    </div>
</div>
