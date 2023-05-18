
@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Messages</title>

@endsection

@section('content')

<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Messages</h2>
    </div>

    <div class="section">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Composer Message</h3>
                <a href="{{route('messages.index')}}" class="button product-button"><span class="material-icons-outlined">arrow_back</span></a>
            </div>
               
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">
                                <div class="card-input">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" required>
                                </div>

                                <div class="card-input">
                                    <label for="body">Message</label>
                                    <textarea name="body" id="body" rows="5" required></textarea>
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
