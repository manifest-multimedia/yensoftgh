@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Parents</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Manage Parents</h2>
            </div>
            <div class="fields">
                <form>
                <div class="query">

                    <a href="{{route('parents.create')}}" class="text-btn" style="text-decoration: none;"><span class="material-icons-outlined">add</span>  Add New</a>
 
                </div>
                </form>
            </div>


            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">List of Parents</h3>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </thead>

                    <tbody id="staffTableBody">
                        @php    $i = 1;     @endphp     @foreach ($parents as $parent)

                        <tr>
                            <td scope="row">{{$i++}}</td>
                            <td>{{ $parent->first_name}} {{ $parent->last_name}}</td>
                            <td>{{ $parent->email }}</td>
                            <td>{{ $parent->phone}}</td>
                            <td>
                                <div class="table-action">
                                    <a href="{{ route('parents.show', $parent) }}" lable="view"><span class="material-icons-outlined">account_box</span></a>&nbsp;&nbsp;
                                    <a href="{{ route('parents.edit', $parent) }}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                            <a href="{{route('parents.destroy', $parent)}}" class="formSubmit" id="formSubmit" type="submit"
                                onclick="event.preventDefault(); confirmDelete({{ $parent }}, '{{ $parent->first_name }} {{ $parent->last_name }}');">
                                <span class="material-icons-outlined">delete</span>
                            </a>
                            <form id="deleteLevelForm{{ $parent }}" action="{{route('staff.destroy', $parent)}}" method="POST">
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
        function printContent() {
            var printContents = document.querySelector('.big-card').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

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

    <script>
    document.getElementById('class_id').addEventListener('change', function() {
        var classId = this.value;
        var url = "{{ route('staff.index') }}" + "?class_id=" + classId;
        window.location.href = url;
    });
    </script>


@endsection

