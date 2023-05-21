<?php
    use App\Models\SchoolSettings;

    $school_settings = SchoolSettings::first();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 50px;
		}

		.heading {
			font-size: 20px;
			font-weight: bold;
			margin-bottom: 50px;
			text-align: center;
		}

		.row {
			display: flex;
			flex-wrap: wrap;
			margin: 0 -10px;
		}

		.col {
			flex-basis: 0;
			flex-grow: 1;
			max-width: 100%;
			padding: 0 10px;
		}

		.col-6 {
			flex-basis: 50%;
			max-width: 50%;
		}

		.label {
			font-size: 16px;
			font-weight: bold;
			margin-bottom: 10px;
		}

		.value {
			font-size: 16px;
			margin-bottom: 10px;
		}

		.total {
			font-size: 24px;
			font-weight: bold;
			margin-top: 50px;
			text-align: right;
		}

		.footer {
			margin-top: 50px;
			text-align: center;
		}

        br{
            border-top: solid 1px;
        }

        /* hide print button on printed receipt */
        @media print {
            .print-btn {
                display: none;
            }
        }
	</style>
</head>

<body>
	<div class="container">

		<h3 class="" style="text-align: center;">{{ $schoolSettings->school_name }}<br>
        {{ $payment->schoolSettings()->school_address }},
        {{ $payment->schoolSettings()->school_phone }}, {{ $payment->schoolSettings()->school_city }}
        <br>
        Payment Receipt
        </h3>
        <hr>
        <div>
            Receipt No.: <strong>{{ $payment->serial_number }}</strong><br>
            Date: <strong>{{ $payment->payment_date }}</strong> <br>
            Received By: <strong>{{ $payment->user->name }} ({{ $payment->user->role == 1 ? 'Admin' : ($payment->user->role == 2 ? 'Teacher' : ($payment->user->role == 3 ? 'Parent' : 'User')) }})</strong>
        </div>
        <hr>
        <div>
            Student ID: <strong>{{ $payment->student->serial_id }}</strong><br>
            Student Name: <strong>{{ $payment->student->surname }} {{ $payment->student->othername }}</strong><br>
            Class: <strong>{{ $payment->student->level->name }} ({{ $payment->student->level->abbre }})</strong> <br>
        </div>
        <hr>
        <div>
            Term: <strong>{{ $payment->term == 1 ? 'First Term' : ($payment->term == 2 ? 'Second Term' : 'Third Term') }}</strong><br>
            Description: <strong>{{ $payment->description }}</strong><br>
            Balance Bf: <strong>GH₵ {{ $Balance }}.00</strong><br>
            Received Amount: <strong>GH₵ {{ $payment->amount }}.00</strong><br>
            Balance Cf: <strong>GH₵ {{  $Balance - $payment->amount}}.00</strong><br>
        </div>
        <hr>
        <br>
        <div style="font-size: 12px; text-align: center;">Thank you for your payment. <br> Keep this receipt safe.<br>www.yensoftgh.com</div>
	</div>

    <!-- print button -->
    <div style="text-align: center; margin-top: 20px;">
        <button class="print-btn" onclick="printReceipt()">Print Receipt</button>
    </div>

    <!-- JavaScript function to handle the print command -->
    <script>
        function printReceipt() {
            window.print();
			window.location.href = '{{ route('billings.index') }}';

        }
    </script>

</body>
</html>
