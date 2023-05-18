@extends('layouts.user-master')

@section('title')

<title>Dashboard | Messages</title>

@endsection

@section('content')


<div class="container">
    <div class="content">
        <h2>Message</h2>
    </div>

    <div class="action_bar section3">
        <a href="{{route('mes.index')}}" class="text-btn-green" style="text-decoration: none;">Messages</a>
        <a href="{{ route('mes.index') }}" class="text_btn_outlined"><span class="material-icons-outlined">arrow_back</span>Go back</a>
 </div></form>

    <div class="section1">

        <div class="message_box">

            <h1>{{ $message->subject }}</h1><br>

            <p>From: {{ $message->user->name }}</p> <br>

            <p>Date: {{ \Carbon\Carbon::parse($message->created_at)->format('F j, Y') }}</p><br>


            <div class="message_body">
                {{ $message->body }}
            </div>

        </div>
    </div>

</div>

@endsection