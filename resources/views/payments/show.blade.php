@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Payment Details</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Student Payment</h2>
    </div>

<div class="section1">

    <!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">{{ $payment->serial_number }}</h3>

            <a href="{{route('payments.index')}}" class="button""><span class="material-icons-outlined">arrow_back</span></a>
        </div>
        <!--student name and image-->
            <div class="" style="display: flex; justify-content: center; align-items: center;">
                <img src="{{(asset('assets/img/profile.png'))}}" alt="logo" style="height: 100px; background: #ddd; border-radius: 50%;">
            </div>
            <br>
            <h3 style="text-align: center">{{ $payment->student->surname }} {{ $payment->student->othername }}</h3>
            <br>
        <!--end student name and image-->
        <table>
            <thead>
                <th colspan="6">Payment Details</th>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">Date:</td>
                    <td colspan="4"> {{ $payment->payment_date }}</td>
                </tr>
                <tr>
                    <td colspan="2">Term:</td>
                    <td colspan="4"> {{ $payment->term == 1 ? 'First Term' : ($payment->term == 2 ? 'Second Term' : 'Third Term') }}</td>
                </tr>

                <tr>
                    <td colspan="2">Decription:</td>
                    <td colspan="4"> {{ $payment->description }}</td>
                </tr>

                <tr>
                    <td colspan="2">Amount:</td>
                    <td colspan="4"> {{ $payment->amount }}</td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan="6">
                    <div class="table-action" style="display:flex; justify-content: right; margin-left: 30px; margin-right: 30px;">

                        <div class="">
                        <form action="{{route('payments.destroy', $payment->payment_id)}}" method="POST" id="deleteBillForm">
                        @csrf
                        @method('DELETE')
                        </form>
                            <a href="#delete" class="formSubmit" id="formSubmit" onclick="confirmDelete({{ $payment->payment_id }})">
                            <span class="material-icons-outlined">delete</span>
                            </a>
                        </div>

                    </div>
                </th>

            </tfoot>

        </table>
        <br>

    </div>

    <div class="social-media">

    </div>
</div>
</main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>

    <script>
        function confirmDelete(pmtId) {
            if (confirm("Are you sure you want to delete bill no: {{ $payment->serial_number }}?")) {
                var form = document.getElementById('deleteBillForm');
                form.action = '/payments/' + pmtId;
                form.submit();
            }
        }
    </script>

@endsection

