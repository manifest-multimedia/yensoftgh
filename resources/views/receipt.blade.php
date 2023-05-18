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
			font-size: 28px;
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

		<h3 class="" style="text-align: center;">{{ $schoolSettings->school_name }}</h3>
        <p style="text-align: center;">{{ $payment->schoolSettings()->school_address }}, {{ $payment->schoolSettings()->school_phone }}, {{ $payment->schoolSettings()->school_city }}</>


		<div class="heading">
            Fee Payment Receipt
            <br> # {{ $payment->serial_number }}
        </div>
		<div class="row">
			<div class="col">
				<div class="label">Student ID:</div>
				<div class="value">{{ $payment->student->serial_id }}</div>
			</div>
			<div class="col">
				<div class="label">Date:</div>
				<div class="value">{{ $payment->payment_date }}</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="label">Student Name:</div>
				<div class="value">{{ $payment->student->surname }} {{ $payment->student->othername }}</div>
			</div>
			<div class="col">
                <div class="label">Amount:</div>
                <div class="value">{{ $payment->amount }}</div>
            </div>
		</div>
		<div class="row">
            <div class="col">
				<div class="label">Class:</div>
				<div class="value">{{ $payment->student->level->name }} ({{ $payment->student->level->abbre }})</div>
			</div>

			<div class="col">
				<div class="label">Description:</div>
				<div class="value"> Being pay for {{ $payment->term == 1 ? 'First Term' : ($payment->term == 2 ? 'Second Term' : 'Third Term') }} {{ $payment->description }}</div>
            </div>
		</div>
		<div class="total">Amount Paid: {{ $payment->amount }} <br> Balance: {{  $totalDue }}</div>
        <p><strong>Received By:</strong> {{ $payment->user->name }} ({{ $payment->user->role == 1 ? 'Admin' : ($payment->user->role == 2 ? 'Teacher' : ($payment->user->role == 3 ? 'Parent' : 'User')) }})</p>

		<div class="footer">Thank you for your payment. Keep this receipt safe.</div>
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
