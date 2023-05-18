<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function events()
    {
        $events = Event::all();
        $data = array();
        foreach ($events as $event) {
            $data[] = array(
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_time,
                'end' => $event->end_time
            );
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->save();

        return response()->json(['success' => 'Event has been added']);
    }

    public function update(Request $request)
    {
        $event = Event::find($request->id);
        $event->title = $request->title;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->save();

        return response()->json(['success' => 'Event has been updated']);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return response()->json(['success' => 'Event has been deleted']);
    }
}
