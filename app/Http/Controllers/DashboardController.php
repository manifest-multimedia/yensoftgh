<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Levels;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the number of male students by level
        $maleCounts = Students::where('gender', '1')
                            ->groupBy('level_id')
                            ->selectRaw('count(*) as count, level_id')
                            ->pluck('count', 'level_id');

        // Get the number of female students by level
        $femaleCounts = Students::where('gender', '2')
                            ->groupBy('level_id')
                            ->selectRaw('count(*) as count, level_id')
                            ->pluck('count', 'level_id');

        // Get the total number of students by level
        $totalCounts = Students::groupBy('level_id')
                            ->selectRaw('count(*) as count, level_id')
                            ->pluck('count', 'level_id');

        // Get all levels
        $levels = Levels::all();

        // Pass the data to the view
        return view('dashboard', compact('maleCounts', 'femaleCounts', 'totalCounts', 'levels'));
    }
}
