<!DOCTYPE html>
<html>
<head>

<title>Social Security Contribution Report</title>

	<style type="text/css">

        @page {
        size: A4;
        margin: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }

    body {
        font-family: Arial, sans-serif;
    }

    .report-card {
        width: 297mm;
        height: 210mm;
        margin: 0 auto;
        page-break-after: always;
        padding-top: 9mm;
        padding-bottom: 10mm;
        padding-right: 15mm;
        padding-left: 15mm;
        box-sizing: border-box;
        border: 1px solid #ccc;
    }

    .report-card h3 {
        margin-top: 0;
        margin-bottom: 0;
    }

    .report-card table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 3.5mm;
    }

    .report-card th,
    .report-card td {
        border: 1px solid #ccc;
        padding: 5px;
        text-align: center;
    }

    .report-card th {
        font-weight: bold;
    }

    .report-card td.subject {
        text-align: left;
    }


		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: center;
			font-size: 14px;
		}

		th {
			background-color: #f2f2f2;
			font-weight: bold;
		}

		.subject-name {
			text-align: left;
			font-weight: bold;
		}

		.total-score {
			font-weight: bold;
		}

		.student-name {
			font-weight: bold;
			font-size: 18px;
			margin-bottom: 10px;
		}

        .graph-area{
            height: 220px;
        }

        .grid-item img{
            width: 85px;
            height: 95px;
            object-fit: cover;
        }

        img{
            width: 65px;
            height: 30px;
            float: right;
            margin-right: 15px;
        }

        .report-card {
        width: 29.7cm;
        height: 21cm;
        margin: 0 auto;
        page-break-after: always; /* this will create a new page for each report card */
        }

        .grid-container {
        display: grid;
        grid-template-columns: 100px auto;
        }

        .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 10px;
        text-align: left;
        }

        h4{
            margin-top: 0;
        }

        hr{
        color: #fff;
        }

        .grid-item p{
            margin-top: 0;
        }
	</style>
</head>
<body>
        <div class="report-card">

            <div class="grid-container">
                <div class="grid-item">
                    <img id="profile-image" src="{{ $schoolDetails->photo }}" alt="School Logo" style="text-align: center">
                </div>

                <div class="grid-item">
                    <strong><p style="text-align: left;font-size: 18px; text-decoration: upper; text-transform: uppercase;margin-bottom: 0;margin-top: 10px;">
                    {{ $schoolDetails->school_name }}</p></strong>
                    <p>{{ $schoolDetails->school_address }}, {{ $schoolDetails->school_city }}, {{ $schoolDetails->school_region }}, {{ $schoolDetails->school_country }} <br>
                    Email: {{ $schoolDetails->school_email }} <br> Mobile: {{ $schoolDetails->school_phone }}</p>
                </div>
            </div>
            <h3 style="text-align: center; text-decoration: upper; text-transform: uppercase;">Social Security Contribution Report {{ $month }}</h3>
            <hr>
    @if ($contributions->isEmpty())
        <p>No social security contributions found for the selected month and year.</p>
    @else

        <table>
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Staff ID</th>
                    <th>SSNIT Number</th>
                    <th>Name</th>
                    <th>Basic Salary</th>
                    <th>Employer</th>
                    <th>Employee</th>
                    <th>SSNIT Amt</th>
                    <th>Fund Man</th>

                    <!-- Add more columns here as per your requirements -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $totalBasicSalary = 0;
                    $totalEmployerContribution = 0;
                    $totalEmployeeContribution = 0;
                    $totalSsnitAmount = 0;
                    $totalFundManagerAmount = 0;
                @endphp

                @foreach ($contributions as $contribution)
                    <tr>
                        <td scope="row">{{ $i++ }}</td>
                        <td style="text-align: left;">{{ $contribution->staff_no }}</td>
                        <td style="text-align: left;">{{ $contribution->staff_ssnit_number }}</td>
                        <td style="text-align: left;">{{ $contribution->firstname }} {{ $contribution->last_name }}</td>
                        <td style="text-align: right;">{{ number_format($contribution->basic_salary, 2) }}</td>
                        <td style="text-align: right;">{{ number_format($contribution->employer_contribution, 2) }}</td>
                        <td style="text-align: right;">{{ number_format($contribution->employee_contribution, 2) }}</td>
                        <td style="text-align: right;">{{ number_format($contribution->ssnit_amount, 2) }}</td>
                        <td style="text-align: right;">{{ number_format($contribution->fund_manager_amount, 2) }}</td>
                    </tr>

                    @php
                        $totalBasicSalary += $contribution->basic_salary;
                        $totalEmployerContribution += $contribution->employer_contribution;
                        $totalEmployeeContribution += $contribution->employee_contribution;
                        $totalSsnitAmount += $contribution->ssnit_amount;
                        $totalFundManagerAmount += $contribution->fund_manager_amount;
                    @endphp
                @endforeach

                <tr>
                    <th style="text-align: right;"></th>
                    <th colspan="3" style="text-align: right;"><strong>Total:</strong></th>
                    <th style="text-align: right;">{{ number_format($totalBasicSalary, 2) }}</th>
                    <th style="text-align: right;">{{ number_format($totalEmployerContribution, 2) }}</th>
                    <th style="text-align: right;">{{ number_format($totalEmployeeContribution, 2) }}</th>
                    <th style="text-align: right;">{{ number_format($totalSsnitAmount, 2) }}</th>
                    <th style="text-align: right;">{{ number_format($totalFundManagerAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>

                <p>* Amounts stated are in GH₵. </p>

    @endif

</body>
</html>
