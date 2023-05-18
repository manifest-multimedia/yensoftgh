<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
    
        $profile = $user->profile;
    
        if (!$profile) {
            $profile = new Profile;
            $profile->user_id = $user->id;
        }
    
        $profile->gender = $request->input('gender');
        $profile->dob = $request->input('dob');
        $profile->address = $request->input('address');
        $profile->phone = $request->input('phone');
        $profile->residence = $request->input('residence');
    
        $profile->save();
    
        return redirect()->route('profile.show', $user->id);
    }
    
}
