<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function privacy_policy()
    {
        return view('legal.privacy_policy');
    }
}
