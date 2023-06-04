<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Levels;
use App\Models\Students;
use App\Models\Term;
use App\Models\AcademicYear;
use App\Models\Exercise;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\ClassScore;
use App\Models\ExamScore;
use App\Models\Message;
use App\Models\ReportComment;


use Illuminate\Http\Request;

class TeacherController extends Controller
{

    /* ========= FUNCTION FOR TEACHER ENTER SCORES FOR EXAM SCORE ========== */

    public function escoreCreate(Request $request)
    {
        $terms = Term::all();
        $levels = Levels::all();
        $academic_years = AcademicYear::all();
        $subjects = Subject::all();
        $exams = Exam::all();

        $user = $request->user(); // Assuming you have authentication in place
        $teacherLevelId = $user->level_id;
    
        $students = Students::where('level_id', $teacherLevelId)
        ->orderBy('surname', 'asc')
        ->get();

        return view('teacher.exams.exam_score', compact('students','levels','subjects','terms','academic_years','exams'));
    }

    public function escoreStore(Request $request)
    {
        $this->validate($request, [
            'level_id' => 'required|exists:levels,id',
            'student_id.*' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_id' => 'required|exists:exams,id',
            'score.*' => 'required|numeric|min:0|max:100', // Validate the score field
        ]);

        $level_id = $request->input('level_id');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $scores = $request->input('score');

        // Check if scores is not null
        if ($scores !== null) {
            // Loop through the scores and get the corresponding student ID
            $student_ids = [];
            foreach ($scores as $i => $score) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the scores into the database
            foreach ($student_ids as $i => $student_id) {
                ExamScore::create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                    'level_id' => $level_id,
                    'exam_id' => $exam_id,
                    'score' => $scores[$i],
                ]);
            }

            return redirect()->route('exam_scores.create')->with('success', 'Exam scores saved successfully.')->with('display_time', 3);
        }

        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter at least one exam score.'])->with('display_time', 3);
    }



    /* ========= FUNCTION FOR TEACHER ENTER SCORES FOR CLASS SCORE ========== */

    public function cscoreCreate(Request $request)
    {
        
        $terms = Term::all();
        $levels = Levels::all();
        $academic_years = AcademicYear::all();
        $subjects = Subject::all();
        $exams = Exam::all();

        $user = $request->user(); // Assuming you have authentication in place
        $teacherLevelId = $user->level_id;
    
        $students = Students::where('level_id', $teacherLevelId)
        ->orderBy('surname', 'asc')
        ->get();
    
        return view('teacher.exams.class_score', compact('students','levels','subjects','terms','academic_years','exams'));
    }

    public function cscoreStore(Request $request)
    {
        $this->validate($request, [
            'level_id' => 'required|exists:levels,id',
            'student_id.*' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'exam_id' => 'required|exists:exams,id',
            'score.*' => 'required|numeric|min:0|max:100', // Validate the score field
        ]);

        $level_id = $request->input('level_id');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $scores = $request->input('score');

        // Check if scores is not null
        if ($scores !== null) {
            // Loop through the scores and get the corresponding student ID
            $student_ids = [];
            foreach ($scores as $i => $score) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the scores into the database
            foreach ($student_ids as $i => $student_id) {
                ClassScore::create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                    'level_id' => $level_id,
                    'exam_id' => $exam_id,
                    'score' => $scores[$i],
                ]);
            }
         // dd('success', $scores, $student_ids);
            return redirect()->route('class_scores.create')->with('success', 'Class scores saved successfully.')->with('display_time', 3);
        }        

        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter at least one class score.'])->with('display_time', 3);
    }

/* ========= FUNCTION FOR TEACHER ENTER SCORES FOR EXERCISE  ========== */

    public function index(Request $request)
    {
        return view('teacher.marks.index');
    }

    public function exeCreate(Request $request)
    {

        $terms = Term::all();
        $levels = Levels::all();
        $academic_years = AcademicYear::all();
        $subjects = Subject::all();

        $user = $request->user(); // Assuming you have authentication in place
        $teacherLevelId = $user->level_id;
    
        $students = Students::where('level_id', $teacherLevelId)
        ->orderBy('surname', 'asc')
        ->get();
    
        return view('teacher.marks.exercise', compact('levels', 'subjects', 'students', 'terms', 'academic_years',));
    }

    public function exeStore(Request $request)
    {
        $this->validate($request, [
            'level_id' => 'required',
            'subject_id' => 'required',
            'term_id' => 'required',
            'academic_year_id' => 'required',
            'exercise_date' => 'required',
            'score.*' => 'required|numeric|min:0|max:100', // Validate the score field
        ]);

        $level_id = $request->input('level_id');
        $subject_id = $request->input('subject_id');
        $term_id = $request->input('term_id');
        $academic_year_id = $request->input('academic_year_id');
        $exercise_date = $request->input('exercise_date');
        $max_score = $request->input('max_score');
        $scores = $request->input('score');
        

        // Check if scores is not null
        if ($scores !== null) {
            // Loop through the scores and get the corresponding student ID
            $student_ids = [];
            foreach ($scores as $i => $score) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the scores into the database
            foreach ($student_ids as $i => $student_id) {
                Exercise::create([
                    'student_id' => $student_id,
                    'subject_id' => $subject_id,
                    'level_id' => $level_id,
                    'term_id' => $term_id,
                    'academic_year_id' => $academic_year_id,
                    'max_score'=> $max_score,
                    'score' => $scores[$i],
                    'exercise_date' => $exercise_date,
                ]);
            }

            return redirect()->route('exe.create')->with('success', 'Scores saved successfully.')->with('display_time', 3);
        }

        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter at least one score.'])->with('display_time', 3);
    }
//

/* ========= FUNCTION FOR TEACHER TAKING ATTENDANCE ========== */

    public function teacherIndex(Request $request)
    {
        $terms = Term::all();
        $levels = Levels::all();
        $academic_years = AcademicYear::all();

        $user = $request->user(); // Assuming you have authentication in place
        $teacherLevelId = $user->level_id;
    
        $students = Students::where('level_id', $teacherLevelId)
        ->orderBy('surname', 'asc')
        ->get();
        
        return view('teacher.attendance.index', compact('terms', 'levels','academic_years', 'students'));
    }
        
    public function reportIndex(Request $request)
    {
        $levels = Levels::all();
        $terms = Term::all();
        $academic_years = AcademicYear::all();
        
        return view('teacher.attendance.attendance', compact('levels', 'terms', 'academic_years'));
    }


    public function getAttendance(Request $request)
    {
        $levelId = $request->input('level_id');
        $termId = $request->input('term');
        $academicYearId = $request->input('academic_year');
    
        $students = Students::where('level_id', $levelId)->get();

        $academicYear = AcademicYear::find($academicYearId);
    
        if (!$academicYear) {
            // Handle invalid academic year ID case
        }
    
        $attendance = Attendance::where('term_id', $termId)
            ->whereHas('student', function ($query) use ($levelId) {
                $query->where('level_id', $levelId);
            })
            ->where('academic_year_id', $academicYear->id)
            ->get();
    
        // Add debug information

        $attendanceData = [];
        foreach ($students as $student) {
            $presentDays = $attendance->where('student_id', $student->id)->where('status', 1)->count();
            $absentDays = $attendance->where('student_id', $student->id)->where('status', 2)->count();
            $totalDays = $attendance->where('student_id', $student->id)->count();
    
            $attendanceData[] = [
                'student' => $student,
                'present_days' => $presentDays,
                'absent_days' => $absentDays,
                'total_days' => $totalDays,
            ];
        }        
    
        return view('teacher.attendance.report', compact('attendanceData'));
    }


    public function my_list(Request $request)
    {
        $user = $request->user(); // Assuming you have authentication in place
        $teacherLevelId = $user->level_id;
    
        $students = Students::where('level_id', $teacherLevelId)
        ->orderBy('surname', 'asc')
        ->get();
        $studentCount = $students->count();

        //get the list of students in the level
    
        return view('teacher.attendance.list', compact('students', 'studentCount'));
    }

    public function teacherStore(Request $request)
    {
        $this->validate($request, [
            'student_id.*' => 'required|exists:students,id',
            'term_id' => 'required|exists:terms,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'date' => 'required|date',
            'status.*' => 'required', // Validate the status field
        ]);

        $student_id = $request->input('student_id');
        $term_id = $request->input('term_id');
        $academic_year_id = $request->input('academic_year_id');
        $level = $request->input('level_id');
        $date = $request->input('date');
        $user = $request->input('user_id');
        $statuss = $request->input('status');

        // Check if status is not null
        if ($statuss !== null) {
            // Loop through the status and get the corresponding student ID
            $student_ids = [];
            foreach ($statuss as $i => $status) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the attendance into the database
            foreach ($student_ids as $i => $student_id) {
                Attendance::create([
                    'student_id' => $student_id,
                    'term_id' => $term_id,
                    'academic_year_id' => $academic_year_id,
                    'date' => $date,
                    'level_id'=> $level,
                    'user_id'=> $user,
                    'status' => $statuss[$i],
                ]);
            }
            return redirect()->route('get_attendance.index')->with('success', 'Attendance recorded successfully.')->with('display_time', 3);
        }


        // Handle the case where scores is null
        return redirect()->back()->withInput()->withErrors(['score' => 'Please enter an attendance.'])->with('display_time', 3);
    }
//

 /* ========= FUNCTION FOR TEACHER MESSAGES ========== */

    public function meSindex()
    {
        $messages = Message::latest()->get();
        return view('teacher.messages.index', compact('messages'));
    }

    public function meScreate()
    {
        return view('teacher.messages.create');
    }

    public function meShow(string $id)
    {
        $message = Message::findOrFail($id);
        return view('teacher.messages.show', compact('message'));

    }

    public function meSstore(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);

        $message = new Message();
        $message->subject = $request->input('subject');
        $message->body = $request->input('body');
        $message->user_id = auth()->user()->id;
        $message->save();

        return redirect()->route('mes.index')->with('success', 'Message sent successfully!')->with('display_time', 3);
    }
//

/* ============================ ROUTES FOR TEACHER COMMENTS ON REPORT CARD =========================================== */
    public function commnetIndex()
    {
        $comments = ReportComment::all();

        return view('teacher.report_comment.index', compact('comments' ));
    }

    public function commentCreate(Request $request)
    {
        $terms = Term::all();
        $levels = Levels::all();
        $academic_years = AcademicYear::all();
        $exams = Exam::all();

        $user = $request->user(); // Assuming you have authentication in place
        $teacherLevelId = $user->level_id;
    
        $students = Students::where('level_id', $teacherLevelId)
        ->orderBy('surname', 'asc')
        ->get();

        return view('teacher.report_comment.create', compact('students','exams','levels', 'academic_years'));
    }

    public function commentStore(Request $request)
    {
        $this->validate($request, [

            'student_id.*' => 'required|exists:students,id',
            'level_id' => 'required|exists:levels,id',
            'exam_id' => 'required|exists:exams,id',
            'comment.*' => 'required', // Validate the score field

        ]);

        $level_id = $request->input('level_id');
        $student_id = $request->input('student_id');
        $exam_id = $request->input('exam_id');
        $comments = $request->input('comment');
        // Check if comments is not null
        if ($comments !== null) {
            // Loop through the scores and get the corresponding student ID
            $student_ids = [];
            foreach ($comments as $i => $comment) {
                $student_ids[$i] = $request->input('student_id.'.$i);
            }

            // Insert the scores into the database
            foreach ($student_ids as $i => $student_id) {
                ReportComment::create([
                    'student_id' => $student_id,
                    'level_id' => $level_id,
                    'exam_id' => $exam_id,
                    'comment' => $comments[$i],
                ]);
            }

            return redirect()->route('comment.index')->with('success', 'Comment saved successfully.')->with('display_time', 3);
        }
    }

    public function commentUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'comment' => 'required',
            'student_id' => 'required|exists:students,id',
            'level_id' => 'nullable|exists:levels,id',
            'exam_id' => 'required|exists:exams,id',
        ]);

        // Find the report comment
        $reportComment = ReportComment::findOrFail($id);

        // Update the report comment
        $reportComment->comment = $request->input('comment');
        $reportComment->student_id = $request->input('student_id');
        $reportComment->level_id = $request->input('level_id');
        $reportComment->exam_id = $request->input('exam_id');
        $reportComment->save();

        // Return a response
        return response()->json(['message' => 'Report comment updated successfully', 'data' => $reportComment]);
    }

}
