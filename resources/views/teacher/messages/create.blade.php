
@extends('layouts.user-master')

@section('title')

<title>Dashboard | Messages</title>

@endsection

@section('content')

    <div class="container">
        <div class="top">
            <h2>Compose Message</h2>

        </div>

        <div class="action_bar section3">
            <a href="{{route('mes.index')}}" class="text-btn-green">Access Messages</a>
            <a href="{{ route('mes.index') }}" class="text_btn_outlined"><span class="material-icons-outlined">arrow_back</span>Go back</a>

        </div>
        
        <div class="content_inner">
            <form action="{{ route('mes.store') }}" method="POST">
                @csrf
                    <div class="form ">
                        <div class="details personal">
                            <div class="fields">
                                <div class="input-field">
                                    <label for="subject">Subject</label>
                                    <input type="text" name="subject" id="subject" required>
                                </div>

                                <br>
                                <div class="input-field">
                                    <label for="body">Message</label>
                                    <textarea name="body" id="body" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div style="display: flex; justify-content: center;">
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
