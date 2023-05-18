@extends('layouts.admin-master')

@section('title')
<title>Dashboard | Student Bills</title>
@endsection

@section('content')
<main class="main-container">
    <div class="main-title text-secondary">
        <h2>Bill Details</h2>
    </div>

<div class="section1">

    <!--=============== Exiting LEVLS==============-->
    <div class="big-card">
        <div class="card-title">
            <h3 class="-">{{ $billing->serial_number }}</h3>

            <a href="{{route('billings.index')}}" class="button""><span class="material-icons-outlined">arrow_back</span></a>
        </div>
        <!--student name and image-->
            <div class="" style="display: flex; justify-content: center; align-items: center;">
                <img src="{{(asset('assets/img/profile.png'))}}" alt="logo" style="height: 100px; background: #ddd; border-radius: 50%;">
            </div>
            <br>
            <h3 style="text-align: center">{{ $billing->student->surname }} {{ $billing->student->othername }}</h3>
            <br>
        <!--end student name and image-->
        <table>
            <thead>
                <th colspan="6">Personal Details</th>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">Date:</td>
                    <td colspan="4"> {{ $billing->billing_date }}</td>
                </tr>
                <tr>
                    <td colspan="2">Term:</td>
                    <td colspan="4"> {{ $billing->term == 1 ? 'First Term' : ($billing->term == 2 ? 'Second Term' : 'Third Term') }}</td>
                </tr>

                <tr>
                    <td colspan="2">Decription:</td>
                    <td colspan="4"> {{ $billing->description }}</td>
                </tr>

                <tr>
                    <td colspan="2">Amount:</td>
                    <td colspan="4"> {{ $billing->amount }}</td>
                </tr>
            </tbody>
            <tfoot>
                <th colspan="6">
                    <div class="table-action" style="display:flex; justify-content: space-between; margin-left: 30px; margin-right: 30px;">
                        <a href="{{ route('payments.create', $billing->id) }}" lable="view"><span class="material-icons-outlined">payments</span></a>&nbsp;&nbsp;

                        <a href="{{route('billings.edit', $billing->id)}}"><span class="material-icons-outlined">edit</span></a>&nbsp;&nbsp;

                        <div class="">
                        <form action="{{route('billings.destroy', $billing)}}" method="POST" id="deleteBillForm">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                            <a href="#delete" class="formSubmit" id="formSubmit" onclick="confirmDelete({{ $billing->id }})">
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
        function confirmDelete(billingId) {
            if (confirm("Are you sure you want to delete bill no: {{ $billing->serial_number }}?")) {
                var form = document.getElementById('deleteBillForm');
                form.action = '/billings/' + billingId;
                form.submit();
            }
        }
    </script>

@endsection

