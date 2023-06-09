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
        padding: 15mm;
        box-sizing: border-box;
        border: 1px solid #ccc;
    }

    .report-card h3 {
        margin-top: 0;
    }

    .report-card table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5mm;
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
			margin-bottom: 10px;
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
            height: 240px;
        }

        .report-card {
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        page-break-after: always; /* this will create a new page for each report card */
        }

	</style>
</head>
<body>
    @foreach ($reportCards as $reportCard)
        <div class="report-card">
            <h3 style="text-align: left; text-decoration: upper; text-transform: uppercase;">
                    {{ $schoolDetails->school_name }}</h3>
            <p>{{ $schoolDetails->school_address }}, {{ $schoolDetails->school_city }}, {{ $schoolDetails->school_region }} <br>
            <strong>Mobile:</strong> {{ $schoolDetails->school_phone }} <strong> Email:</strong> {{ $schoolDetails->school_email }}</p>

            <h4 style = "text-align: right;">Student Terminal Report</h4>
            <h3 style="text-align: center; text-decoration: upper; text-transform: uppercase;">End of Term Examination</h3>
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
                        <td style="text-align: left;">Term end</td>
                        <td style="text-align: left;">{{ $reportCard['term_end'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Class</td>
                        <td style="text-align: left;">{{ $reportCard['level_name'] }}</td>
                        <td style="text-align: left;">Next term begins</td>
                        <td style="text-align: left;">{{ $reportCard['academic_year'] }}</td>
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
                        <th>Remork</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportCard['subjects'] as $subject)
                        <tr>
                            <td class="subject">{{ $subject['name'] }} ({{ $subject['short_name'] }})</td>
                            <td>{{ $subject['class_score'] }}</td>
                            <td>{{ $subject['exam_score'] }}</td>
                            <td>{{ $subject['total_score'] }}</td>
                            <td>{{ $subject['grade_and_remark']['grade'] }}</td>
                            <td>{{ $subject['grade_and_remark']['remark'] }}</td>
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
                        <td style="text-align: left;">{{ $reportCard['serial_id'] }}</td>
                        <td style="text-align: left;">Average Score</td>
                        <td style="text-align: left;">{{ $reportCard['academic_year'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Best subject</td>
                        <td style="text-align: left;">{{ $reportCard['age'] }} years</td>
                        <td style="text-align: left;">Attendance</td>
                        <td style="text-align: left;">{{ $reportCard['term_end'] }}</td>
                    </tr>

                    <tr>
                        <td style="text-align: left;">Class Size</td>
                        <td style="text-align: left;">{{ $reportCard['student_name'] }} </td>
                        <td style="text-align: left;">Position</td>
                        <td style="text-align: left;">{{ $reportCard['term'] }}  </td>
                    </tr>

                </tbody>
            </table>
            <div class="graph-area">
                <canvas id="chart"></canvas>
            </div>



            <p>Comments
        </div>
    @endforeach

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

<script>
  var ctx = document.getElementById('chart').getContext('2d');

  var data = {
    labels: [
      @foreach ($reportCards[0]['subjects'] as $subject)
        "{{ $subject['short_name'] }}",
      @endforeach
    ],
    datasets: [{
      label: 'Total Score',
      data: [
        @foreach ($reportCards[0]['subjects'] as $subject)
          {{ $subject['total_score'] }},
        @endforeach
      ],
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
</script>

</body>
</html>
