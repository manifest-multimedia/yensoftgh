

@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Messages</title>

@endsection

@section('content')


<main class="main-container">
    <div class="main-title text secondary">
        <h2>Messages</h2>
    </div>

    <div class="fields">
        <form action="{{ route('payments.index') }}" method="GET">
        <div class="query">

           <a href="{{route('messages.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">mail</span>  Compose Message</a>

        </div>
        </form>
    </div>

    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Messages</h3>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
            @php    $i = 1;     @endphp      @foreach ($messages as $message)
                <tr>

                    <td scope="row">{{$i++}}</td>
                    <td>
                        <div class="table-action">
                            <a href="{{route('messages.show', $message->id)}}" style="text-decoration: none;font-weight: bold;" lable="view">{{ $message->subject }}</a>
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

</main>

@endsection