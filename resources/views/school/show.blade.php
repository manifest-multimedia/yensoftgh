@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Students</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>School Profile</h2>
    </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

<div class="socialmedia">

    <!--=============== Student Profile ==============-->
    <div class="big-card">

        <!--student name and image-->
        @foreach ($settings as $setting)

        @endforeach
            <div class="school-logo">
                <form method="POST" action="{{ route('upload.logo', $setting->id) }}" id="upload-form" enctype="multipart/form-data">
                    @method ('PUT')
                    @csrf
                <img id="profile-image" src="{{ $setting->photo }}" alt="School Logo" >

                <input type="file" id="image-upload" name="photo" accept="image/*">
                <label for="image-upload"><span class="material-icons-outlined">edit</span></label>
                <form>


            </div>
            <br>
        <!--end student name and image-->
            <table>
                <thead>
                    <th colspan="2">{{ $setting->school_name }} ({{ $setting->abbre }})</th>
                </thead>
                <tbody>

                    <tr>
                        <td >Address:</td>
                        <td > {{ $setting->school_address }}</td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td> {{ $setting->school_city }}</td>
                    </tr>

                    <tr>
                        <td>Region:</td>
                        <td> {{ $setting->school_region }}</td>
                    </tr>

                    <tr>
                        <td>Country:</td>
                        <td> {{ $setting->school_country }} </td>
                    </tr>

                    <tr>
                        <td>Phone:</td>
                        <td>{{ $setting->school_phone }}</td>
                    </tr>

                    <tr>
                        <td >Email:</td>
                        <td> {{$setting->school_email }} </td>
                    </tr>
                </tbody>
            </table>
            <br>
                <div style="display: flex; justify-content: center;">

                    <a href="{{route('school.settings.form')}}" class="" style="text-decoration: none; color: blue; align-items: center;">
                    <span class="material-icons-outlined">edit</span>  Update Profile</a>

                </div>


    </div>


</div>
</main>

@endsection

@section('scripts')

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

    <script>
        document.getElementById("image-upload").addEventListener("change", function (e) {
        var reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById("profile-image").src = event.target.result;
            uploadImage(event.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
        });
        // Add an event listener to the file input field
        document.getElementById('image-upload').addEventListener('change', function() {
            document.getElementById('upload-form').submit();
        });
    </script>
@endsection

