<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header" style="justify-content: center;">
        <div>
            <img src="{{ asset('uploads/admin-logo.png') }}" class="logo-icon" alt="logo icon" style="width: 120px;">
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @can('view companies')
            <li>
                <a href="{{ route('companies.index') }}">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Companies</div>
                </a>
            </li>
        @endcan
        @can('view jobs')
            <li class="menu-label">Job Management</li>
            @can('view jobs')
                <li>
                    <a href="{{ route('admin.jobs.index') }}">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Jobs</div>
                    </a>
                </li>
            @endcan
        @endcan
        @can('view job categories')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Jobs Category</div>
                </a>
                <ul>
                    @can('create job categories')
                        <li> <a href="{{ route('job-category.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                        </li>
                    @endcan
                    @can('view job categories')
                        <li> <a href="{{ route('job-category.index') }}"><i class="bx bx-right-arrow-alt"></i>All Categories</a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('view employee')
            <li class="menu-label">Employee Management</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Employees</div>
                </a>
                <ul>
                    @can('create employee')
                        <li> <a href="{{ route('employee.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Employee</a>
                        </li>
                    @endcan
                    <li> <a href="{{ route('employee.index') }}"><i class="bx bx-right-arrow-alt"></i>All Employees</a>
                    </li>
                </ul>
            </li>
        @endcan

        @php
            $canView = auth()->user()->can('view companies');
            $canEdit = auth()->user()->can('edit companies');
        @endphp



        @if ($canView || $canEdit)
            <li class="menu-label">Blog Management</li>
        @endif

        @can('view blogs')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Blogs</div>
                </a>
                <ul>
                    @can('create blogs')
                        <li> <a href="{{ route('admin-blogs.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Blog</a>
                        </li>
                    @endcan

                    <li> <a href="{{ route('admin-blogs.index') }}"><i class="bx bx-right-arrow-alt"></i>All Blog</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('view blog categories')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Blog Categories</div>
                </a>
                <ul>
                    @can('create blog categories')
                        <li> <a href="{{ route('blog-category.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                Category</a>
                        </li>
                    @endcan

                    <li> <a href="{{ route('blog-category.index') }}"><i class="bx bx-right-arrow-alt"></i>All
                            Categories</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('view pages')
            <li class="menu-label">Page Management</li>
            <li>
                <a href="{{ route('pages.index') }}">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Pages</div>
                </a>
            </li>
        @endcan
        <li class="menu-label">Others</li>
        @can('view users')
            <li>
                <a href="{{ route('admin.users') }}">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">All Users</div>
                </a>
            </li>
        @endcan
        <li>
            <a href="{{ route('admin.account') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">My Account</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
