@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Student Bills</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Exercises</h2>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of exercises</h3>

                    <a href="{{ route('exercises.create') }}" class="button""><span class="material-icons-outlined">add</span></a>

                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student ID</th>
                            <th>Subject ID</th>
                            <th>Level ID</th>
                            <th>Term ID</th>
                            <th>Year</th>
                            <th>Exercise Date</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                         @php    $i = 1;     @endphp @foreach ($exercises as $exercise)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $exercise->student->serial_id }}</td>
                                <td>{{ $exercise->subject->name }}</td>
                                <td>{{ $exercise->level->name }}</td>
                                <td>{{ $exercise->term_id }}</td>
                                <td>{{ $exercise->academic_year_id }}</td>
                                <td>{{ $exercise->exercise_date }}</td>
                                <td>{{ $exercise->score }}</td>
                                <td>
                                    <div class="table-action"> &nbsp;&nbsp;
                                        <a href="{{ route('exercises.edit', $exercise->id) }}" class="btn btn-primary"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;
                                    <a href="{{route('exercises.destroy', $exercise->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                        onclick="event.preventDefault(); confirmDelete({{ $exercise->id }}, '{{ $exercise->student->serial_id }}');">
                                        <span class="material-icons-outlined">delete</span>
                                    </a>
                                    <form id="deleteLevelForm{{ $exercise->id }}" action="{{route('exercises.destroy', $exercise->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="10">
                            {{ $exercises->links('pagination.custom') }}
                        </td>
                        </tr>
                    </tfoot>
                </table>


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

