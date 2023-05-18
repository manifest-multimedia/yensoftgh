@extends('layouts.user-master')

@section('title')

<title>Dashboard | Messages</title>

@endsection
    
@section('content')


    <div class="container">

        <div class="content">
            <div class="top">
                <h1>Messages</h1>
            </div>

            <div class="action_bar section3">
                <a href="{{route('mes.create')}}" class="text-btn-green">Compose Message</a>
                <a href="{{ route('teacher') }}" class="text_btn_outlined"><span class="material-icons-outlined">arrow_back</span>Go back</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content_inner">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Subject</th>
                            <th>Sender</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php    $i = 1;     @endphp     @foreach ($messages as $message)
                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>
                                <div class="table-action">
                                    <a href="{{route('mes.show', $message->id)}}" style="text-decoration: none;font-weight: bold;" lable="view">{{ $message->subject }}</a>
                                </div>
                            </td>
                            <td>{{ $message->user ? $message->user->name : 'N/A' }}</td>
                            <td>{{ $message->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach

                        </tbody>
                </table>
            </div>
        </div>
    </div>

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

