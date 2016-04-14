<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Calendar</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Clients</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Technicians</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-wallet"></i>
                    <span class="title">Diary</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Reports</span>
                    <span class="arrow"></span>
                </a>
            </li>
            @if (Auth::check())
                @if (Auth::user()->has_role('Administrator'))
                    <li class="nav-item {{ (Request::is('tools/*') ? 'active' : '') }}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-wrench"></i>
                            <span class="title">Tools</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item {{ (Request::is('tools/users') ? 'active' : '') }}">
                                <a href="/tools/users" class="nav-link nav-toggle">
                                    <span class="title">Users</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('tools/change-password') ? 'active' : '') }}">
                                <a href="/tools/change-password" class="nav-link nav-toggle">
                                    <span class="title">Change User Password</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <span class="title">Application Settings</span>
                                </a>
                            </li>
                            <li class="nav-item  {{ (Request::is('tools/franchisee-settings') ? 'active' : '') }}">
                                <a href="/tools/franchisee-settings" class="nav-link nav-toggle">
                                    <span class="title">Default Franchisee Settings</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  {{ (Request::is('edit-lookups/*') ? 'active' : '') }}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">Edit Lookups</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  {{ (Request::is('edit-lookups/suburbs') ? 'active' : '') }}">
                                <a href="/edit-lookups/suburbs" class="nav-link ">
                                    <span class="title">Suburbs</span>
                                </a>
                            </li>
                            <li class="nav-item  {{ (Request::is('edit-lookups/technician-types') ? 'active' : '') }}">
                                <a href="/edit-lookups/technician-types" class="nav-link ">
                                    <span class="title">Technician Types</span>
                                </a>
                            </li>
                            <li class="nav-item  {{ (Request::is('edit-lookups/licence-description') ? 'active' : '') }}">
                                <a href="/edit-lookups/licence-description" class="nav-link ">
                                    <span class="title">Licence Description</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('edit-lookups/standard-jobs') ? 'active' : '') }}">
                                <a href="/edit-lookups/standard-jobs" class="nav-link ">
                                    <span class="title">Standard Jobs</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('edit-lookups/standard-tasks') ? 'active' : '') }}">
                                <a href="/edit-lookups/standard-tasks" class="nav-link ">
                                    <span class="title">Standard Tasks</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link ">
                                    <span class="title">Standard Job Tasks</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('edit-lookups/chemicals') ? 'active' : '') }}">
                                <a href="/edit-lookups/chemicals" class="nav-link ">
                                    <span class="title">Chemicals</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('edit-lookups/titles') ? 'active' : '') }}">
                                <a href="/edit-lookups/titles" class="nav-link ">
                                    <span class="title">Titles</span>
                                </a>
                            </li>
                            <li class="nav-item {{ (Request::is('edit-lookups/job-sources') ? 'active' : '') }}">
                                <a href="/edit-lookups/job-sources" class="nav-link ">
                                    <span class="title">Job Sources</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link ">
                                    <span class="title">Sections</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>