<div id="sidebar" class="app-sidebar" data-bs-theme="dark">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>

                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">{{ Auth::user()->name }}</div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        <small>Senior Fullstack developer</small>
                        <small>{{ Auth::user()->position }}</small>

                    </div>
                </a>
            </div>
            <div id="appSidebarProfileMenu" class="collapse">
                <div class="menu-item pt-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-cog"></i></div>
                        <div class="menu-text">Settings</div>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
                        <div class="menu-text">Send Feedback</div>
                    </a>
                </div>
                <div class="menu-item pb-5px">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>

                    <a href="#" class="menu-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="menu-icon"><i class="fa fa-sign-out-alt"></i></div>
                        <div class="menu-text">Logout</div>
                    </a>
                </div>
                <div class="menu-divider m-0"></div>
            </div>

            <!-- Dashboard -->
            <div class="menu-item">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="grid-outline" class="bg-green md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>

            <!-- Attendance -->
            <div class="menu-item">
                <a href="{{ route('student-attendance') }}" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="calendar-outline" class="bg-red md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Attendance</div>
                </a>
            </div>

            <!-- Assessments -->
            <div class="menu-item">
                <a href="{{ route('assessments.index') }}" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="document-text-outline" class="bg-yellow md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Assessments</div>
                </a>
            </div>
            <!-- Students Management -->
            <div class="menu-item">
                <a href="{{ route('students-manage') }}" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="people-outline" class="bg-blue md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Students Management</div>
                </a>
            </div>

            {{-- <!-- Courses -->
            <div class="menu-item">
                <a href="{{ route('students-handle') }}" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="library-outline" class="bg-purple md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Student Handle</div>
                </a>
            </div> --}}



            {{--
            <!-- Grades -->
            <div class="menu-item">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="school-outline" class="bg-green md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Grades</div>
                </a>
            </div> --}}

            <!-- Reports -->
            <div class="menu-item">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="bar-chart-outline" class="bg-indigo md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Reports</div>
                </a>
            </div>

            <!-- Settings -->
            <div class="menu-item">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="settings-outline" class="bg-gray md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Settings</div>
                </a>
            </div>

            <!-- User Accounts -->
            <div class="menu-item">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <ion-icon name="person-circle-outline" class="bg-pink md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">User Accounts</div>
                </a>
            </div>
            <div class="menu-item">
                <a id="load-students" data-bs-toggle="offcanvas" href="#offcanvasEndExample" class="menu-link">
                    <div class="menu-icon">

                        <ion-icon name="sparkles-outline" class="bg-gradient-cyan-indigo md hydrated"></ion-icon>
                    </div>
                    <div class="menu-text">Generate Student</div>
                </a>

            </div>

            <div class="menu-item d-flex">
                <a href="javascript:;"
                    class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none"
                    data-toggle="app-sidebar-minify">
                    <ion-icon name="arrow-back" class="me-1"></ion-icon>
                    <div class="menu-text">Collapse</div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile"
        class="stretched-link"></a></div>
