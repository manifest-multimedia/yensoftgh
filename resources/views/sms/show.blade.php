

@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Messages</title>

@endsection

@section('content')


<main class="main-container">
    <div class="main-title text secondary">
        <h2>Message</h2>
    </div>
    <form>
    <div class="query">
        <a href="{{route('messages.index')}}" class="text-btn" style="text-decoration: none;">Messages</a>
    </div></form>
    <div class="section1">

        <div class="big-card">

            <h1>{{ $message->subject }}</h1><br>

            <p>From: {{ $message->user->name }}</p> <br>

            <p>Date: {{ \Carbon\Carbon::parse($message->created_at)->format('F j, Y') }}</p><br>


            <div class="message_body">
                {{ $message->body }}
            </div>

        </div>
    </div>

</main>

@endsection