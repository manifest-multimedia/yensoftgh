@extends('layouts.admin-master')

@section('title')

<title>Dashboard | Taxes</title>

@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>Taxes</h2>
                <a href="#" class="button-green" style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px" onclick="printContent();"><span class="material-icons-outlined">print</span> Print</a>
            </div>


            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Curret staff PAYE rates</h3>
                    <a href="{{route('staff_taxes.index')}}" class="button-green" 
                    style="text-decoration: none; padding-left: 10px; padding-right: 12px; padding-top: 5px; 
                    padding-bottom: 6px;" ><span 
                    class="material-icons-outlined">arrow_back</span> Go back</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table">
                    <thead>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Minimum</th>
                        <th>Maximum</th>
                        <th>Rate</th>
                    </thead>

                    <tbody>
                        @php    $i = 1;     @endphp @foreach($taxes as $tax)
                            <tr>
                                <td scope="row">{{$i++}}</td>
                                <td>{{ $tax->tax_name }}</td>
                                <td>{{ $tax->taxable_income_from }}</td>
                                <td>{{ $tax->taxable_income_to }}</td>
                                <td>{{ $tax->tax_rate }}</td>
                                
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="10">

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

@endsection

