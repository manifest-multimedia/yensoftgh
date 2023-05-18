
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
                    <h2>634</h2>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <h3>Payments</h3>
                        <span class="material-icons-outlined">payments</span>
                    </div>
                    <h2>22,323</h2>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <h3>Expenditure</h3>
                        <span class="material-icons-outlined">shopping_cart_checkout</span>
                    </div>
                    <h2>7,323</h2>
                </div>
                <div class="card">
                    <div class="card-inner">
                        <h3>Messages</h3>
                        <span class="material-icons-outlined">forum</span>
                    </div>
                    <h2>123</h2>
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
                            @foreach($levels as $level)
                            <tr>
                                <td>{{ $level->name }}</td>
                                <td>{{ $maleCounts->get($level->id, 0) }}</td>
                                <td>{{ $femaleCounts->get($level->id, 0) }}</td>
                                <td>{{ $totalCounts->get($level->id, 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="social-media1">
                    <div class="section">
                        <div>
                            <div class="product-icon background-red">
                                <i class="bi bi-twitter"></i>
                            </div>
                            <h2 class="text-red">+274</h2>
                            <p class="text-secondary">Twiter information is here</p>
                        </div>
<!--
                    <button type="button" class="product-button">
                        <span class="material-icons-outlined">add</span>
                    </button> -->

                        <div>
                            <div class="product-icon background-green">
                                <i class="bi bi-instagram"></i>
                            </div>
                            <h2 class="text-green">+174</h2>
                            <p class="text-secondary">Instagram information is here</p>
                        </div>

                        <div>
                            <div class="product-icon background-orange">
                                <i class="bi bi-facebook"></i>
                            </div>
                            <h2 class="text-orange">+274</h2>
                            <p class="text-secondary">Facebook information is here</p>
                        </div>

                        <div>
                            <div class="product-icon background-blue">
                                <i class="bi bi-linkedin"></i>
                            </div>
                            <h2 class="text-blue">+274</h2>
                            <p class="text-secondary">Linkedin information is here</p>
                        </div>

                    </div>
                </div>
            </div>

            <!--CHARTS-->
            <div class="charts">
                <div class="charts-card">
                     <h3 class="card-title">Revenue and Expenditure</h3>
                     <div id="bar-chart"></div>
                </div>

                <div class="charts-card">
                    <h3 class="card-title">Admissions</h3>
                    <div id="column-chart"></div>
               </div>
            </div>
        </main>

@endsection


@section('scripts')

    <script src="{{(asset('assets/js/apexcharts.min.js'))}}"></script>
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
