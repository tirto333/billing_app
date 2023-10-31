<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="/Dashboard-Anggota" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/img/logo-icon.png') }}" alt="" height="45">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" height="45">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>@lang('translation.menu')</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/Dashboard-Anggota">
                        <i class="ri-dashboard-2-line"></i> <span>@lang('translation.dashboard')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/Projek-Anggota">
                        <i class="ri-slideshow-line"></i> <span>@lang('translation.projects')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/Tugas-Anggota">
                        <i class="ri-task-line"></i> <span>@lang('translation.list-view')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>