<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header" style="justify-content: center;">
        <div class="d-flex justify-center">
            <img src="{{ asset('uploads/admin-logo.png') }}" class="logo-icon" alt="logo icon" style="width: 120px;" >
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('company.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Job</div>
            </a>
            <ul>
                <li> <a href="{{ route('jobs.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Job</a>
                </li>
                <li> <a href="{{ route('jobs.index') }}"><i class="bx bx-right-arrow-alt"></i>All Jobs</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('applications.index') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Job Applications</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Blogs</div>
            </a>
            <ul>
                <li> <a href="{{ route('blogs.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New Blog</a>
                </li>
                <li> <a href="{{ route('blogs.index') }}"><i class="bx bx-right-arrow-alt"></i>All Blogs</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Employee</div>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Plugins</div>
            </a>
        </li>
        <li>
            <a href="{{ route('company.profile') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Account</div>
            </a>
        </li>
        <li>
            <a href="{{ route('company.logout') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
