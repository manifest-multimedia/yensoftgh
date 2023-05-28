
@extends('layouts.admin-master')


@section('title')

    <title>Admin Dashboard</title>

@endsection


@section('content')

        <main class="main-container">
            <div class="main-title text-secondary">
                <h2>Dashboard</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="main-cards">
                <div class="card">
                    <div class="card-inner">
                        <h3>Students</h3>
                        <span class="material-icons-outlined">account_box</span>
                    </div>
                    <h2>{{ $students_count ?? ''}}</h2>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <h3>Budgeted</h3>
                        <span class="material-icons-outlined">sell</span>
                    </div>
                    <h2>{{ $total_billings_amount ?? ''}}</h2>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <h3>Actual Collection</h3>
                        <span class="material-icons-outlined">history_edu</span>
                    </div>
                    <h2>{{ $total_payments_amount ?? ''}}</h2>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <h3>Expenditure</h3>
                        <span class="material-icons-outlined">inventory</span>
                    </div>
                    <h2>{{ $total_expenses_amount ?? ''}}</h2>
                </div>
            </div>
            <div class="section">
                <div class="medium-card">
                    <div class="card-title">
                        <h3 class="">Current Class Enrollment</h3>
                    </div>
                    <table class="blueTable">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Males</th>
                                <th>Females</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->level }}</td>
                                <td>{{ $student->males}}</td>
                                <td>{{ $student->females}}</td>
                                <td>{{ $student->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="stats_main stats">

                    <div class="row">
                        <div class="column">
                            <div class="cardxx">
                                <div class="cardxxs">
                                    <div class="grid-item">
                                        <h2 class="text-orange"><span class="material-icons-outlined">man</span> </h2>
                                    </div>

                                    <div class="grid-item">
                                        <h2 class="text-orange">{{ $male_students_count }}</h2>
                                        <p class="text-secondary">Males</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <div class="cardxx">
                                <div class="cardxxs">
                                    <div class="grid-item">
                                        <h2 class="text-orange"><span class="material-icons-outlined">woman</span> </h2>
                                    </div>

                                    <div class="grid-item">
                                        <h2 class="text-orange">{{ $female_students_count}}</h2>
                                        <p class="text-secondary">Females</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <div class="cardxx">
                                <div class="cardxxs">
                                    <div class="grid-item">
                                        <h2 class="text-green"><span class="material-icons-outlined">people</span> </h2>
                                    </div>

                                    <div class="grid-item">
                                        <h2 class="text-green">{{ $active_students_count }}</h2>
                                        <p class="text-secondary">Active students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="cardxx">
                                <div class="cardxxs">
                                    <div class="grid-item">
                                        <h2 class="text-green"><span class="material-icons-outlined">no_accounts</span> </h2>
                                    </div>

                                    <div class="grid-item">
                                        <h2 class="text-green">{{ $inactive_students_count  }}</h2>
                                        <p class="text-secondary">Inactive students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="column">
                            <div class="cardxx">
                                <div class="cardxxs">
                                    <div class="grid-item">
                                        <h2 class="text-red"><span class="material-icons-outlined">school</span> </h2>
                                    </div>

                                    <div class="grid-item">
                                        <h2 class="text-red">{{ $graduated  }}</h2>
                                        <p class="text-secondary">Graduated</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="cardxx">
                                <div class="cardxxs">
                                    <div class="grid-item">
                                        <h2 class="text-red"><span class="material-icons-outlined">dangerous</span> </h2>
                                    </div>

                                    <div class="grid-item">
                                        <h2 class="text-red">{{ $withdrawn  }}</h2>
                                        <p class="text-secondary">Withdrawn</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </main>

@endsection


@section('scripts')

    <script src="{{(asset('assets/js/apexcharts.min.js'))}}"></script>
    <script src="{{(asset('assets/js/script.js'))}}"></script>
    <script src="{{(asset('assets/js/charts.js'))}}"></script>

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
