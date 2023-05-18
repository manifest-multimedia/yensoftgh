@extends('layouts.auth-master')

@section('title')

    <title>Login</title>

@endsection


@section('content')

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf
        <a href="{{ url('/') }}"><img src="{{asset('assets/img/yensoftlogo.png')}}" alt="logo" style="width: 20%;" ></a>
        <br><br>
        <h3>Yensoft SchoolDB</h3>

        <p class="message">Sign into your account</p><br>


        <div class="form-group">
            <input type="email" class="@error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email">
                @error('email')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
        </div>

        <div class="form-group">
        <input type="password" class="@error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password">
                @error('password')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror

            <p class="reset">@if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </p>
        </div>



        <button type="submit" name="submit">{{ __('Login') }}</button>
        <p class="message">Don't have an account? <a href="{{ route('register') }}">Register</a></p>


    </form>
 @include('layouts.partials.copy')

@endsection
