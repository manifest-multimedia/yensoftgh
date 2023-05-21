<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function create()
    {
        return view('sms.create');
    }

    public function send(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $message = $request->input('message');

        $response = Mnotify::sendMessage($phoneNumber, $message);

        // Handle the response and any additional logic
        // Redirect back with a success message or error message
    }
}
