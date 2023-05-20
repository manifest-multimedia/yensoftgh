<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Levels;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller

{
    public function index()
    {
        $currentLevelId = 2; // Assuming the current level ID is 2
        $students = Students::where('level_id', $currentLevelId)->get();
        $levels = Levels::all();

        return view('promotion.index', compact('students', 'levels'));
    }

    // app/Http/Controllers/PromotionController.php
    public function promote(Request $request)
    {
        $studentIds = $request->input('students');
        $targetLevelId = $request->input('target_level');

        // Update the students' last class and level ID
        Students::whereIn('id', $studentIds)->update([
            'lastclass' => DB::raw('lastclass + 1'),
            'level_id' => $targetLevelId,
        ]);

        return redirect()->back()->with('success', 'Students promoted successfully.')->with('display_time', 3);
    }

}
