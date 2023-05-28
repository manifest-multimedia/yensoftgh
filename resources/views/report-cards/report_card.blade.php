<!DOCTYPE html>
<html>
<head>
	<title>Report Card</title>

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
        width: 210mm;
        height: 297mm;
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
        width: 21cm;
        height: 29.7cm;
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
        display: flow-root;
        color: #fff;
        margin-bottom: -22px;
        }

        .grid-item p{
            margin-top: 0;
        }
	</style>
</head>
<body>
    @foreach ($reportCards as $reportCard)
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

            <hr>

            <h4 style = "text-align: right;">Student Report</h4>

            <h3 style="text-align: center; text-decoration: upper; text-transform: uppercase;">End of Term Examination</h3>

            @if ($contributions->isEmpty())
                <p>No social security contributions found for the selected month and year.</p>
            @else

            <table>
                <tbody >
                <thead >
                    <tr>
                        <th colspan="4" style="text-align: center;">Student Particulars</th>
                    </tr>
                </thead>
                    <tr>
                        <td style="text-align: left;">Student ID</td>
                        <td style="text-align: left;">{{ $reportCard['serial_id'] }}</td>
                        <td style="text-align: left;">Academic Year</td>
                        <td style="text-align: left;">{{ $reportCard['academic_year'] }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Name</td>
                        <td style="text-align: left;">{{ $reportCard['student_name'] }} </td>
                        <td style="text-align: left;">Term</td>
                        <td style="text-align: left;">{{ $reportCard['term'] }}  </td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Age</td>
                        <td style="text-align: left;">{{ $reportCard['age'] }} years</td>
                        <td style="text-align: left;">Term begun</td>
                        <td style="text-align: left;">{{ $reportCard['term_start'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Class</td>
                        <td style="text-align: left;">{{ $reportCard['level_name'] }}</td>
                        <td style="text-align: left;">Term closed</td>
                        <td style="text-align: left;">{{ $reportCard['term_end'] }}</td>
                    </tr>

                </tbody>
            </table>


            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Class Score</th>
                        <th>Exam Score</th>
                        <th>Total Score</th>
                        <th>Grade</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportCard['subjects'] as $subject)
                        <tr>
                            <td class="subject">{{ $subject['name'] }} </td>
                            <td>{{ $subject['class_score'] }}</td>
                            <td>{{ $subject['exam_score'] }}</td>
                            <td>{{ $subject['total_score'] }}</td>
                            <td>{{ $subject['grade_and_remark']['grade'] }}</td>
                            <td style="text-align: left;">{{ $subject['grade_and_remark']['remark'] }}</td>
                         </tr>
                    @endforeach
                </tbody>
            </table>

            <table>
                <thead >
                    <tr>
                        <th colspan="4" style="text-align: center;">Performance Analysis</th>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td style="text-align: left;">Total Score</td>
                        <td style="text-align: left;">{{ $reportCard['overall_total'] }}</td>
                        <td style="text-align: left;">Average Score</td>
                        <td style="text-align: left;">{{ $reportCard['average_score'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Best subject</td>
                        <td style="text-align: left;">{{ $reportCard['highest_subject'] }}</td>
                        <td style="text-align: left;">Attendance</td>
                        <td style="text-align: left;">{{ $reportCard['days_present'] }} out of {{ $reportCard['total_days'] }} days</td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Position</td>
                        <td style="text-align: left;">{{ $reportCard['rank'] }}  </td>
                        <td style="text-align: left;">Class Size</td>
                        <td style="text-align: left;">{{ $reportCard['class_size'] }} </td>
                    </tr>

                </tbody>
            </table>
            <div class="graph-area">
                <canvas id="chart-{{$reportCard['student_id']}}"></canvas>
            </div>

            <script>
                    document.addEventListener("DOMContentLoaded", function(){

                    var chart_id ='chart-'+{{ $reportCard['student_id'] }};

                    var ctx = document.getElementById(chart_id).getContext('2d');

                            var data = {
                            labels: [
                                @foreach ($reportCard['subjects'] as $subject)
                                "{{ $subject['short_name'] }}",
                                @endforeach
                            ],
                            datasets: [{
                                label: 'Total Score',
                                data: [
                                @foreach ($reportCard['subjects'] as $subject)
                                    {{ $subject['total_score'] }},
                                @endforeach
                                100],
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                            };

                            var options = {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                                }]
                            }
                            };

                            var chart = new Chart(ctx, {
                            type: 'bar',
                            data: data,
                            options: options
                            });

                })


            </script>


            <p >Class Teacher's Comment:
                @foreach ($reportCard['comments'] as $comment)
                   <strong><i> {{ $comment }}</i></strong></p>
                @endforeach

                <img class="signature" src="{{ asset('assets/img/signature.png') }}" alt="School Logo" style="text-align: center">
                <br>
                <p style="text-align: right;">School Head</p>

        </div>

    @endforeach
<<<<<<< HEAD
=======
    @endif
>>>>>>> parent of 4484634 (Fix errors on the repor card)

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>



</body>
</html>
