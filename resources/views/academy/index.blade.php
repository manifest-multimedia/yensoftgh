@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Academy</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Academy General</h2>
            </div>
            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{ route('departments.index') }}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">bungalow</span>  Departments</a>
                    <a href="{{route('levels.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">home</span>  Classes</a>
                    <a href="{{route('subjects.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">menu_book</span>  Subjects</a>
                    <a href="{{route('terms.index')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">date_range</span>  Terms</a>
                    <a href="{{ route('academic_years.index') }}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">calendar_month</span> Academic Years</a>

                </div>
                </form>
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

