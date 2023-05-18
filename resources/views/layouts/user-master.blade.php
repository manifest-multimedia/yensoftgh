<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

        <!--Icons-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

        <!--Custom CSS-->
        <link rel="stylesheet" href="{{(asset('assets/css/user.css'))}}">
</head>
<body>

	<div class="navbar">
		<div class="logo">
			<img src="{{(asset('assets/img/yensoftlogo.png'))}}" alt="logo">
			<span class="company-name">Yensoft SchoolDB</span>
		</div>


        <div class="header-right">
            <div class="profile-outline">
            <img src="{{(asset('assets/img/profile.png'))}}" alt="user image" style="width: 30px;">&nbsp;{{ Auth::user()->name}}</div>
            <div class="time">
                <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <span class="material-icons-outlined">logout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
        </div>
	</div>

    @yield('content')


	<footer>
	<div class="footer-container">
		<div class="left">
		<a href="https://www.yensoftghana.com">Privacy Policy</a>
		</div>
		<div class="right">
		&copy; {{date('Y')}} Yensoft
		</div>
	</div>
	</footer>


    @yield('scripts')

</body>
</html>
