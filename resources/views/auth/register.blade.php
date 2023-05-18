@extends('layouts.auth-master')

@section('title')

    <title>Register</title>

@endsection


@section('content')

    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf

        <a href="{{ url('/') }}"><img src="{{asset('assets/img/yensoftlogo.png')}}" alt="logo" style="width: 20%;" ></a>
        <br><br>
                <h3>Yensoft SchoolDB</h3>

        <p class="message">Create your account</p><br>

        <div class="form-group">
        <input type="text" class="@error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Enter your name" autofocus>
                @error('name')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
        </div>

        <div class="form-group">
        <input type="email" class="@error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Enter your email">
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
        </div>

        <div class="form-group">
            <input type="password" class="@error('confirm-password') is-invalid @enderror" id="password-confirm" name="password-confirm" placeholder="Confirm your password">
                @error('confirm-password')
                <div class="error-message">
                    <span class="text-danger text-left" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
        </div>

        <button type="submit" name="submit">{{ __('Register') }}</button>
        <p class="message">Already have an account? <a href="{{ route('login') }}">Login</a></p>

    </form>
 @include('layouts.partials.copy')


@endsection
