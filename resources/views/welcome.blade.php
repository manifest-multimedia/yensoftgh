@extends('layouts.auth-master')

@section('title')

    <title>Login</title>

@endsection


@section('content')

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <a href="{{ url('/') }}"><img src="{{asset('assets/img/yensoftlogo.png')}}" alt="logo" style="width: 20%;" ></a>
        <br><br>
        <h3>Welcome to <br>Yensoft SchoolDB!</h3>

        <div class="home-message">

        <p class="home-message">We are thrilled to have you use our platform.<br><br>

        Yensoft SchoolDB offers a range of features and functionalities to make your experience seamless and efficient. You can do much more all in one place.<br><br>
        Thank you for choosing Yensoft SchoolDB. We look forward to helping you achieve your educational goals!
        </p>

        </div>

        <p class="message"><a href="{{ route('login') }}">Login</a> if you have an account.</p>
        <p class="message">Don't have an account? <a href="{{ route('register') }}">Register.</a></p>

    </form>
 @include('layouts.partials.copy')

@endsection
