@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Subjects</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Subjects</h2>
    </div>

<div class="section2">
<div class="social-media">
<!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">Existing Student subjects</h3>

            <div class="input-field">
                <input type="text" id="searchInput" placeholder="Search subject ...">
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <th>SN</th>
                <th>Abbreviation</th>
                <th>Subject Name</th>
                <th>Actions</th>
            </thead>
            <tbody id="studentsTableBody">
                @php    $i = 1;     @endphp   @foreach($subjects as $subject)
                <tr>
                    <td scope="row">{{$i++}}</td>
                    <td>{{$subject->short_name}}</td>
                    <td>{{$subject->name}}</td>
                    <td>
                        <div class="table-action">
                        &nbsp;&nbsp;
                            <a href="{{route('subjects.edit', $subject->id)}}" class=""><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('subjects.destroy', $subject->id)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $subject->id }}, '{{ $subject->name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $subject->id }}" action="{{route('subjects.destroy', $subject->id)}}" method="POST">
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
                <td colspan="7">
                    {{ $subjects->links('pagination.custom') }}
                </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!--=============== CREATE NEW subjects==============-->

    <div class="social-media">
        <div class="big-card">
            <div class="card-title">
                <h3 class="-">Create New Subject</h3>
            </div>

            <form class="" action="{{route('subjects.store')}}" method="POST">
                @csrf
                <div class="fields">
                    <div class="card-input">
                        <label for="name">Long Name</label>
                        <input type="text" class="@error('name') is-invalid @enderror"name="name" placeholder="e.g English Language">
                        @error('name')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror
                    <br>
                        <label for="short_name">Abbreviation</label>
                        <input type="text" class="@error('short_name') is-invalid @enderror"name="short_name" placeholder="e.g ENG">
                        @error('short_name')
                        <div class="error-message">
                            <span class="text-danger text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                        @enderror

                    </div>
                </div>
                <br>
                <div style="display: flex; justify-content: center;">
                    <button class="text-btn">Save New Subject</button>
                </div>
            </form>

        </div>
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

