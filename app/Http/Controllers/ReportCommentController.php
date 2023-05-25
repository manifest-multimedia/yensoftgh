<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Levels;
use App\Models\ReportComment;
use Illuminate\Http\Request;

class ReportCommentController extends Controller
{

    public function index()
    {
        $comments = ReportComment::all();
        return view('report_comment.index', compact('comments' ));
    }

    public function create()
    {
        $exams = Exam::all();
        $levels= Levels::all();
        $comments = ReportComment::all();
        return view('report_comment.create', compact('comments','exams','levels' ));
    }
    public function store(Request $request)
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
        // Check if scores is not null
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

    public function update(Request $request, $id)
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

    public function delete($id)
    {
        // Find the report comment
        $reportComment = ReportComment::findOrFail($id);

        // Delete the report comment
        $reportComment->delete();

        // Return a response
        return response()->json(['message' => 'Report comment deleted successfully']);
    }
}
