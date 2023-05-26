<?php

namespace App\Http\Controllers;

use App\Models\SchoolSettings;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Levels;
use App\Models\Students;
use App\Models\Subject;
use App\Models\ExamScore;
use App\Models\ClassScore;
use App\Models\Exercise;
use App\Models\Exam;
use App\Models\Term;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;
use Monolog\Level;

class ReportCardController extends Controller
{

    public function showSelectExamView()
    {
        // Load all exams from the database
        $exams = Exam::all();
        $levels= Levels::all();
        // Return the select_exam view and pass the exams data to it
        return view('report-cards.index', compact('exams', 'levels'));
    }

private function getGradeAndRemark($score)
{
    $gradeRemark = [
        ['min' => 90, 'max' => 100, 'grade' => '1', 'remark' => 'Distinction'],
        ['min' => 80, 'max' => 89, 'grade' => '2', 'remark' => 'Excellent'],
        ['min' => 70, 'max' => 79, 'grade' => '3', 'remark' => 'Very Good'],
        ['min' => 60, 'max' => 69, 'grade' => '4', 'remark' => 'Good'],
        ['min' => 55, 'max' => 59, 'grade' => '5', 'remark' => 'Credit'],
        ['min' => 50, 'max' => 54, 'grade' => '6', 'remark' => 'Pass'],
        ['min' => 40, 'max' => 49, 'grade' => '7', 'remark' => 'Weak'],
        ['min' => 0, 'max' => 39, 'grade' => '8', 'remark' => 'Fail'],
    ];

    foreach ($gradeRemark as $gr) {
        if ($score >= $gr['min'] && $score <= $gr['max']) {
            return ['grade' => $gr['grade'], 'remark' => $gr['remark']];
        }
    }

    return ['grade' => null, 'remark' => null];
}


public function generate(Request $request)
{
    // Get the selected level and exam
    $selectedLevel = $request->input('level');
    $selectedExam = $request->input('exam');

    $school = SchoolSettings::all();
    // Get all students for the selected level
    $students = DB::table('students')->where('level_id', $selectedLevel)->get();

    // Fetch school details from school_setting table
    $schoolDetails = DB::table('school_settings')->first();

    // Get the level name
    $levelName = DB::table('levels')->where('id', $selectedLevel)->value('name');

    // Get attendance of student
    $term = DB::table('exams')->where('term_id', $selectedExam)->value('term_id');
    $academicYear = DB::table('exams')->where('academic_year_id', $selectedExam)->value('academic_year_id');
    $termAttendance = DB::table('attendances')->where('level_id', $selectedLevel)->where('term_id', $term)->where('academic_year_id', $academicYear)->get();

    //dd($termAttendance);

    // Create an array to hold all report cards
    $reportCards = [];

    // Loop through each student to get their report card
    foreach ($students as $student) {
        $reportCard = [];
        $reportCard['student_name'] = $student->surname . ' ' . $student->othername;
        $reportCard['student_id'] = $student->id;
        $reportCard['serial_id'] = $student->serial_id;
        $reportCard['dob'] = $student->dob;
        $reportCard['gender'] = $student->gender;
        $reportCard['level_name'] = $levelName;

        // Get the term and academic year for the selected exam
        $exam = Exam::findOrFail($selectedExam);
        $reportCard['term'] = $exam->term->name;
        $reportCard['term_start'] = $exam->term->start_date;
        $reportCard['term_end'] = $exam->term->end_date;
        $reportCard['academic_year'] = $exam->academic_year->name;

        // Calculate age
        $dob = new DateTime($student->dob);
        $today = new DateTime();
        $age = $dob->diff($today)->y;
        $reportCard['age'] = $age;

        $reportCard['subjects'] = [];

        // Get the subjects for the selected exam
        $subjects = DB::table('subjects')
            ->join('exam_scores', 'subjects.id', '=', 'exam_scores.subject_id')
            ->where('exam_scores.exam_id', $selectedExam)
            ->select('subjects.*')
            ->distinct()
            ->orderBy('name', 'asc') // Sort subjects alphabetically by name
            ->get();

        // Initialize variables
        $highestSubjectScore = 0;
        $highestSubjectName = '';
        $overallTotal = 0;
        $classSize = count($students);
        $totalSubjects = count($subjects->filter(function ($subject) use ($selectedExam, $selectedLevel) {
            $examScore = DB::table('exam_scores')
                ->where('subject_id', $subject->id)
                ->where('level_id', $selectedLevel)
                ->where('exam_id', $selectedExam)
                ->first();

            return $examScore && $examScore->score > 0;
        }));
        // Loop through each subject to get the student's score and total score for the subject
        foreach ($subjects as $subject) {
            // Get the exam score for the subject
            $examScore = DB::table('exam_scores')
                ->where('student_id', $student->id)
                ->where('subject_id', $subject->id)
                ->where('level_id', $selectedLevel)
                ->where('exam_id', $selectedExam)
                ->first();

            // Skip subjects with score <= 0
            if (!$examScore || $examScore->score <= 0) {
                continue;
            }

            $subjectScore = [];
            $subjectScore['name'] = $subject->name;
            $subjectScore['short_name'] = $subject->short_name;

            // Get the class score for the subject
            $classScore = DB::table('class_scores')
                ->where('student_id', $student->id)
                ->where('subject_id', $subject->id)
                ->where('level_id', $selectedLevel)
                ->first();

            $subjectScore['class_score'] = ($classScore) ? $classScore->score : 0;
            $subjectScore['exam_score'] = $examScore->score;
            $subjectScore['total_score'] = $subjectScore['class_score'] + $subjectScore['exam_score'];
            $subjectScore['grade_and_remark'] = $this->getGradeAndRemark($subjectScore['total_score']);

            // Update highest subject score and name if applicable
            if ($subjectScore['total_score'] > $highestSubjectScore) {
                $highestSubjectScore = $subjectScore['total_score'];
                $highestSubjectName = $subjectScore['name'];
            }

            // Add the total score for the subject to the array of total scores
            $overallTotal += $subjectScore['total_score'];

            $reportCard['subjects'][] = $subjectScore;

            // Get the term and academic year for the selected exam
            $exam = Exam::findOrFail($selectedExam);
            $termId = $exam->term_id;
            $academicYearId = $exam->academic_year_id;

            // Get the total days for the term and academic year
            $totalDays = DB::table('attendances')
                ->where('student_id', $student->id)
                ->where('term_id', $termId)
                ->where('academic_year_id', $academicYearId)
                ->count();

            // Get the days present for the student
            $daysPresent = DB::table('attendances')
                ->where('student_id', $student->id)
                ->where('term_id', $termId)
                ->where('academic_year_id', $academicYearId)
                ->where('status', 1)
                ->count();

        // Get the comments for the student and selected exam
        $comments = DB::table('report_comments')
            ->where('student_id', $student->id)
            ->where('exam_id', $selectedExam)
            ->pluck('comment')
            ->toArray();


        }

        // Calculate average score
        $averageScore = ($totalSubjects > 0) ? number_format($overallTotal / $totalSubjects, 2) : 0;
        // Calculate average score


        // Create a bar graph of the total scores for each subject
        $totalScoresChartData = [
            'labels' => array_map(function ($subject) {
                return $subject['short_name'];
            }, $reportCard['subjects']),
            'datasets' => [
                [
                    'label' => 'Total Score',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                    'hoverBackgroundColor' => 'rgba(54, 162, 235, 0.4)',
                    'hoverBorderColor' => 'rgba(54, 162, 235, 1)',
                    'data' => array_column($reportCard['subjects'], 'total_score')
                ]
            ]
        ];

        // Add the chart data to the report card array
        $reportCard['total_scores_chart_data'] = json_encode($totalScoresChartData);
        $reportCard['highest_subject'] = $highestSubjectName;
        $reportCard['overall_total'] = $overallTotal;
        $reportCard['average_score'] = $averageScore;
        $reportCard['class_size'] = $classSize;
        $reportCard['class_size'] = $classSize;
        $reportCard['total_days'] = $totalDays;
        $reportCard['days_present'] = $daysPresent;
        $reportCard['comments'] = $comments;

        // Add the report card to the array of report cards
        $reportCards[] = $reportCard;
    }

        // Sort the report cards array by overall_total in descending order
        usort($reportCards, function ($a, $b) {
            return $b['overall_total'] - $a['overall_total'];
        });

        // Assign ranks to the students
        $rank = 1;
        $previousScore = null;
        $previousRank = null;
        foreach ($reportCards as &$reportCard) {
            if ($reportCard['overall_total'] !== $previousScore) {
                // If the score is different from the previous one, assign a new rank
                $reportCard['rank'] = $rank;
            } else {
                // If the score is the same as the previous one, assign the same rank
                $reportCard['rank'] = $previousRank;
            }

            $previousScore = $reportCard['overall_total'];
            $previousRank = $reportCard['rank'];
            $rank++;
        }
    // Pass the modified array of report cards to the view
    return view('report-cards.report_card', compact('reportCards', 'schoolDetails'));
}


}
