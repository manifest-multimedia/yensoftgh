<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\SchoolSettings;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SchoolController extends Controller
{
    public function showSettingsForm()
    {

        $settings = SchoolSettings::all();
        $academic_years = AcademicYear::orderBy('created_at', 'desc')->get();
        $terms = Term::all();

        return view('school.settings', compact('settings','terms', 'academic_years'));
    }


    public function showProfile()
    {
        $settings = SchoolSettings::all();
        return view('school.show', compact('settings'));

    }

    public function updateLogo(Request $request,)
    {
        // Retrieve the student record
        $setting = SchoolSettings::first();

        // Delete the old image file
        if ($setting->photo) {
            $oldImagePath = public_path($setting->photo);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        // Move the new image file to the 'public/assets/photo' directory
        $newFileName = $setting->abbre . '_' . time() . '.png';
        $newImagePath = $request->file('photo')->move(public_path('assets/img'), $newFileName);

        // Update the student record
        $setting->photo = '/assets/img/' . $newFileName;
        $setting->save();

        return redirect()->back()->with('success', 'School logo updated successfully.')->with('display_time', 3);
    }


    public function saveSettings(Request $request)
    {
        // validate the form data
        $validatedData = $request->validate([
            'school_name' => 'required',
            'abbre' => 'required',
            'school_address' => 'required',
            'school_city' => 'required',
            'school_region' => 'required',
            'school_country' => 'required',
            'school_phone' => 'required',
            'school_email' => 'required',
            'other_info' => 'nullable|string',
            'current_year' => 'required',
            'current_term' => 'required',
        ]);

        // retrieve the existing settings record from the database
        $settings = SchoolSettings::first();

        // update the settings with the new values
        $settings->school_name = $validatedData['school_name'];
        $settings->abbre = $validatedData['abbre'];
        $settings->school_address = $validatedData['school_address'];
        $settings->school_city = $validatedData['school_city'];
        $settings->school_region = $validatedData['school_region'];
        $settings->school_country = $validatedData['school_country'];
        $settings->school_phone = $validatedData['school_phone'];
        $settings->school_email = $validatedData['school_email'];
        $settings->current_term = $validatedData['current_term'];
        $settings->current_year = $validatedData['current_year'];

        $settings->save();

        return redirect()->route('school.settings.form')->with('success', 'Settings saved successfully!')->with('display_time', 3);
    }

}