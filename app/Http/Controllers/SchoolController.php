<?php

namespace App\Http\Controllers;

use App\Models\SchoolSettings;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function showSettingsForm()
    {

        $settings = SchoolSettings::all();
        return view('school.settings', compact('settings','settings'));
    }

    public function saveSettings(Request $request)
    {
        // validate the form data
        $validatedData = $request->validate([
            'school_name' => 'required',
            'abbre'=>'required',
            'school_address'=>'required',
            'school_city'=>'required',
            'school_region' => 'required',
            'school_country' => 'required',
            'school_phone' =>'required',
            'school_email'=>'required',
            'other_info' => 'nullable|string',
        ],);

        // save the settings to the database
        // replace with your own code to save the settings
        $settings = new SchoolSettings();
        $settings->school_name = $validatedData['school_name'];
        $settings->abbre = $validatedData['abbre'];
        $settings->school_address = $validatedData['school_address'];
        $settings->school_city = $validatedData['school_city'];
        $settings->school_region = $validatedData['school_region'];
        $settings->school_country = $validatedData['school_country'];
        $settings->school_phone = $validatedData['school_phone'];
        $settings->school_email = $validatedData['school_email'];

        $settings->save();

        return redirect()->route('school.settings.form')->with('success', 'Settings saved successfully!')->with('display_time', 3);
    }

}
