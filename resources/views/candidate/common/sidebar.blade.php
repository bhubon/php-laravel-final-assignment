<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header" style="justify-content: center;">
        <div class="d-flex justify-center">
            <img src="{{ asset('uploads/admin-logo.png') }}" class="logo-icon" alt="logo icon" style="width: 120px;">
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('user.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('user.applications') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Applied Jobs</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Job Experiences</div>
            </a>
            <ul>
                <li> <a href="{{ route('user.job.experiences.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                        New</a>
                </li>
                <li> <a href="{{ route('user.job.experiences') }}"><i class="bx bx-right-arrow-alt"></i>All
                        Experiences</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Trainigs</div>
            </a>
            <ul>
                <li> <a href="{{ route('trainings.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New</a>
                </li>
                <li> <a href="{{ route('trainings.index') }}"><i class="bx bx-right-arrow-alt"></i>All Trainigs</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Education</div>
            </a>
            <ul>
                <li> <a href="{{ route('education.create') }}"><i class="bx bx-right-arrow-alt"></i>Add New</a>
                </li>
                <li> <a href="{{ route('education.index') }}"><i class="bx bx-right-arrow-alt"></i>All Education</a>
                </li>
            </ul>
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
