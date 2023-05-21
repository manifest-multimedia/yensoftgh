
@extends('layouts.admin-master')

@section('title')

<title>Dashboard | SMS</title>

@endsection

@section('content')

<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Send SMS</h2>
    </div>

    <div class="section">
        <div class="big-card">
            <div class="card-title">
                <h3 class="">Compose Message</h3>
                <a href="{{route('messages.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>

            <form action="{{ route('sms.send') }}" method="POST">
                @csrf
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">
                                <div class="card-input">
                                <label for="phone_number">Phone Number</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number" required>
                                </div>

                                <div class="card-input">
                                <label for="message">Message</label>
                                <textarea id="message" class="form-control" name="message" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div style="display: flex; justify-content: right;">
                        <button type="submit" class="text-btn">Send</button>
                    </div>

                </div>
            </form>
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
