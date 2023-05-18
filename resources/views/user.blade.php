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

            <div class="new">

            Welcome to Yensoft SchoolDB!

            Thank you for creating an account with us. We are thrilled to have your school
            on board and look forward to helping you manage your educational institution.

            Please note that the functionalities of your account may be limited until it
            is approved by your school administrator and your status is updated.
            We will notify you as soon as your account has been approved and fully activated,
            giving you access to all the features and functionalities of our platform.

            In the meantime, we encourage you to explore our system and get familiar with
             our tools and resources. If you have any questions or concerns, please do not
             hesitate to reach out to our customer support team, and we will be more than
             happy to assist you.

            Thank you for choosing Yensoft SchoolDB. We are committed to providing your
            school with the best possible user experience and helping you achieve your
            educational goals.
            </div>
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
