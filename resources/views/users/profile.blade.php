@extends('layouts.user-master')

@section('title')

    <title>Profile</title>

@endsection


@section('content')


<div class="card-body">

<form method="POST" action="{{ route('profile.update', ['id' => $user->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="input-field">
            <label for="">Gender</label>
            <select name="gender" id="gender">
                <option value="{{ $student->gender }}"> {{ $student->gender == 1 ? 'Male' : 'Female' }}</option>
                <option value='1'>Male</option>
                <option value='2'>Female</option>
            </select>
        </div>

        <div class="input-field">
            <label for="">Date of birth</label>
            <input type="date" class="@error('dob') is-invalid @enderror"
                value="{{ $student->dob }}"name="dob" id="dob" placeholder="">
            @error('dob')
            <div class="error-message">
                <span class="text-danger text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
            @enderror
        </div>

        <div class="input-field">
            <label for="">Postal Address</label>
            <input type="text" class="@error('address') is-invalid @enderror"
                value="{{ $student->address }}" name="address" id="address" placeholder="Enter postal address">
            @error('address')
            <div class="error-message">
                <span class="text-danger text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
            @enderror
        </div>

        <div class="input-field">
            <label for="">Phone</label>
            <input type="number" class="@error('phone') is-invalid @enderror"
                value="{{ $student->phone }}" name="phone" id="phone" placeholder="Enter phone number">
            @error('phone')
            <div class="error-message">
                <span class="text-danger text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
            @enderror
        </div>

        <div class="input-field">
            <label for="">Residence</label>
            <input type="text" class="@error('residence') is-invalid @enderror"
                value="{{ $student->residence }}" name="residence" id="residence" placeholder="Enter postal residence">
            @error('residence')
            <div class="error-message">
                <span class="text-danger text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
            @enderror
        </div>


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update Profile') }}
                </button>
            </div>
        </div>
    </form>
</div>


@endsection

@section('scripts')


@endsection
