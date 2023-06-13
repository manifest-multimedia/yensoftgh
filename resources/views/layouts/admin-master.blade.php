<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @yield('head')
    <!--Font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700&family=Tilt+Neon&display=swap"
        rel="stylesheet">

    <!--Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/png">
    
    <!--Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</head>

<body>
    <div class="grid-container">
        <!--Header-->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>

            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>

            <div class="header-right">

                <div class="user-details-container">
                    <div class="profile-outline">
                        <img src="{{ asset('assets/img/profile.png') }}" alt="user image"
                            style="width: 30px;">&nbsp;{{ Auth::user()->name }}
                    </div>

                    <div class="time table-action">
                        <a href="{{ route('admin_profile.show', ['profile' => Auth::id()]) }}"><span
                                class="material-icons-outlined">settings</span></a>
                    </div>

                    <div class="table-action">
                        <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <span class="material-icons-outlined">logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <div>

                        </div>
        </header>
        <!--End Header-->

        <!--Sidebar-->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <div class="section1">
                        <img src="{{ asset('assets/img/yensoftlogo.png') }}" alt="logo" style="height: 60px;">
                        <div class="company-name"> Yensoft <br>SchoolDB</div>
                    </div>
                </div>
                <div class="close-icon">
                    <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
                </div>
            </div>
            <ul class="sidebar-list">

                <li class="sidebar-list-item"><a href="{{ route('dashboard.index') }}"><span
                            class="material-icons-outlined">dashboard</span> Dashboard</a></li>
                <li class="sidebar-list-item"><a href="{{ route('students.index') }}"><span
                            class="material-icons-outlined">account_box</span> Students</a></li>
                <li class="sidebar-list-item"><a href="{{ route('academy') }}"><span
                            class="material-icons-outlined">bungalow</span> Academy</a></li>
                <li class="sidebar-list-item"><a href="{{ route('exercises.index') }}"><span
                            class="material-icons-outlined">try</span> Exercises</a></li>
                <li class="sidebar-list-item"><a href="{{ route('exams.index') }}"><span
                            class="material-icons-outlined">history_edu</span> Examination</a></li>
                <li class="sidebar-list-item"><a href="{{ route('billings.index') }}"><span
                            class="material-icons-outlined">receipt_long</span> Bills & Payments</a></li>
                <li class="sidebar-list-item"><a href="{{ route('staff.index') }}"><span
                            class="material-icons-outlined">badge</span> Manage Staff</a></li>
                <li class="sidebar-list-item"><a href="{{ route('parents.index') }}"><span
                            class="material-icons-outlined">escalator_warning</span> Manage Parents</a></li>
                <li class="sidebar-list-item"><a href="{{ route('users.index') }}"><span
                            class="material-icons-outlined">group</span> Manage Users</a></li>
                <li class="sidebar-list-item"><a href="{{ route('messages.index') }}"><span
                    class="material-icons-outlined">message</span> Messages</a></li>
                <li class="sidebar-list-item"><a href="{{ route('school.profile') }}"><span
                        class="material-icons-outlined">settings</span> School Profile</a></li>
            </ul>
            <ul class="sidebar-list logout">
                <li class="sidebar-list-item">
                    <!-- LOG OUT BUTTON -->
                    <a class="" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="material-icons-outlined">logout</span> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        <!--End sidebar-->

        <!--Main-->

        @yield('content')
        <!--End main-->
    </div>
    <!--Custom Script-->
    @yield('scripts')

    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const timeString = `${hours}:${minutes}`;

            const clock = document.getElementById('clock')
            if (clock) {
                clock.textContent = timeString;
            }
        }


        // Update the clock every minute
        updateClock();
        setInterval(updateClock, 60000);
    </script>

</body>

</html>
