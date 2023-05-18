@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Users</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Update User</h2>
    </div>

<!--=============== EDIT User ==============-->

<div class="big-card">
    <div class="card-title">
        <h3>Edit User Details</h3>
        <a href="{{route('users.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="form flex">
        <form class="" action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form">
                <div class="fields ">
                    <div class="input-field">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" placeholder="Enter your name" autofocus>
                                @error('name')
                                <div class="error-message">
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror
                    </div>

                    <div class="input-field">
                        <label for="name">Email</label>
                        <input type="email" name="email" class="@error('email') is-invalid @enderror" id="email" value="{{ $user->email }}" placeholder="Enter your email">
                            @error('email')
                            <div class="error-message">
                                <span class="text-danger text-left" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror
                    </div>

                    <div class="input-field">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role">
                        <option value="{{ $user->role }}">
                            {{ $user->role == 1 ? 'Admin' : ($user->role == 2 ? 'Teacher' : ($user->role == 3 ? 'Parent' : 'User')) }}
                        </option>
                        <option value="1">Admin</option>
                        <option value="2">Teacher</option>
                        <option value="3">Parent</option>
                        <option value="4">User</option>
                    </select>
                    </div>

                    <div class="input-field">
                            <label for="level_id">Assign Class</label>
                            <select class="form-control" name="level_id" id="level_id">
                                <option value="{{ $user->level_id}}">{{ $user->level_id }}</option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger text-left" role="alert"></span>
                        </div>

                    <div class="input-field">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="{{ $user->status }}">
                            {{ $user->status == 1 ? 'Active' :  'Disabled' }}
                            </option>
                            <option value="1">Active</option>
                            <option value="2">Disabled</option>
                        </select>
                        <span class="text-danger text-left" role="alert"></span>
                    </div>

                    <div class="input-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="@error('password') is-invalid @enderror" id="password" placeholder="">
                            @error('password')
                            <div class="error-message">
                                <span class="text-danger text-left" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror
                    </div>

                    <div class="input-field">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="@error('confirm-password') is-invalid @enderror" id="password-confirm" name="password-confirm" placeholder="Confirm your password">
                            @error('confirm-password')
                            <div class="error-message">
                                <span class="text-danger text-left" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="text-btn">Update User</button>
        </form>
    </div>

</div>


</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/modal.js'))}}"></script>
    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
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
