@extends('layouts.admin-master')

@section('title')
<title>Dashboard | School Settings</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Settings</h2>
    </div>

<div class="section2">
<div class="social-media">
<!--=============== Exiting departments==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">School information</h3>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

            <form method="POST" action="{{ route('school.settings.update') }}">
                @csrf 
                @method('PUT')

                @foreach ($settings as $setting)

                @endforeach
                <div class="fields">
                    <div class="card-input">
                        <label for="school_name">School Name</label>
                        <input id="school_name" value="{{ $setting->school_name ?? null}}" type="text" name="school_name" required>
                    </div>
                    <div class="card-input">
                        <label for="abbre">Abbreviation</label>
                        <input id="abbre" value="{{ $setting->abbre ?? null}}" type="text" name="abbre" placeholder="ABC" required>
                    </div>
                </div>

                <div class="fields">
                    <div class="input-field">
                        <label for="school_address">Address</label>
                        <input type="text" value="{{ $setting->school_address ?? null}}" name="school_address" id="school_address" placeholder="P. O. Box ...">
                    </div>

                    <div class="input-field">
                        <label for="school_city">City</label>
                        <input type="text" value="{{ $setting->school_city ?? null}}" name="school_city" id="school_city" placeholder="Accra">
                    </div>

                    <div class="input-field">
                        <label for="school_region">Region</label>
                        <input type="text" value="{{ $setting->school_region ?? null}}" name="school_region" id="school_region" placeholder="Greater Accra">
                    </div>

                    <div class="input-field">
                        <label for="school_country">Country</label>
                        <input type="text" value="{{ $setting->school_country ?? null}}" name="school_country" id="school_country" placeholder="Ghana">
                    </div>

                    <div class="input-field">
                        <label for="school_phone">Phone</label>
                        <input type="text" value="{{ $setting->school_phone ?? null}}" name="school_phone" id="school_phone" placeholder="000-000-0000">
                    </div>

                    <div class="input-field">
                        <label for="school_email">Email</label>
                        <input type="text" value="{{ $setting->school_email ?? null}}" name="school_email" id="school_email" placeholder="school@school.com">
                    </div>


                </div>

                <br>
                <div style="display: flex; justify-content: center;">
                    <button type="submit" class="text-btn">Update School Detials</button>
                </div>

            </form>
        </div>
</div>


<!--=============== left side ==============-->

    <div class="social-media">

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
@endsection

