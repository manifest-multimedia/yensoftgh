@extends('layouts.user-master')

@section('content')

	<div class="dashboard">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
		<div class="search-box">
       Hello {{ Auth::user()->name}},
            {{ __(' welcome!') }}
		</div>
		<div class="icon-container">
			<a href="{{route('dashboard.index')}}"><img src="{{(asset('assets/img/dashboarda.png'))}}" alt="attendance"><span>Go to Dashboard</span></a>

            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <img src="{{(asset('assets/img/logout.png'))}}" alt="enter marks"><span>Logout now</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
		</div>
	</div>






</div>
@endsection
