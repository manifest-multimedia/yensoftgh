@extends('layouts.user-master')

@section('title')

    <title>Teacher Dashboard</title>

@endsection

@section('content')

	<div class="dashboard">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
		<div class="search-box">
			<input type="search" name="search-box" placeholder="What you want to find" >
		</div>
		<div class="icon-container">
			<a href="page1.html"><img src="{{(asset('assets/img/attendance.png'))}}" alt="attendance"><span>Attendance</span></a>
			<a href="page2.html"><img src="{{(asset('assets/img/report.png'))}}" alt="enter marks"><span>Record Marks</span></a>
			<a href="page3.html"><img src="{{(asset('assets/img/message.png'))}}" alt="msg"><span>Messages</span></a>
			<a href="{{ route('profile.show', ['profile' => Auth::id()]) }}"><img src="{{(asset('assets/img/profileset.png'))}}" alt="update password"><span>Profile</span></a>

		</div>
	</div>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/modal.js'))}}"></script>
    <script src="{{(asset('assets/js/script.js'))}}"></script>
    <script>
        // Find the success alert and set a timeout to hide it
        var successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            var displayTime = {{ session('display_time') ?? 0 }};
            if (displayTime > 0) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, displayTime * 1000);
            }
        }
    </script>

@endsection
