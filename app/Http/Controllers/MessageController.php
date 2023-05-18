<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
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

        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }

    public function show(string $id)
    {

        $message = Message::findOrFail($id);
        return view('messages.show', compact('message'));
    }

}
