<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Guardian;
use App\Models\ReportComment;

class ParentController extends Controller
{
    public function attendanceIndex(Request $request)
    {
        $terms = Term::all();
        $academic_years = AcademicYear::all();

        $user = $request->user(); // Assuming you have authentication in place
        $parentId = $user->id;
        $parent = Guardian::where('user_id', $parentId)->pluck('id');

        $students = Students::where('parent_id', $parent)
        ->orderBy('surname', 'asc')
        ->get();
       // dd($user, $parentId, $parent, $students);
        return view('parent.attendance.index', compact('terms','academic_years', 'students'));
    }

    public function getAttendanceEvents(Student $student)
    {
        $attendanceEvents = $student->attendanceEvents()->select('date', 'status')->get();

        $events = [];

        foreach ($attendanceEvents as $attendanceEvent) {
            $events[] = [
                'title' => $attendanceEvent->status == 1 ? 'Present' : 'Absent',
                'start' => $attendanceEvent->date,
            ];
        }

        return response()->json($events);
    }
}
