<?php

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;

if(!function_exists('generateStaffCredentials'))
{
     function generateStaffCredentials($staff_email, $staff_firstname, $staff_lastname){
        $password=generatePassword(8);
        $encrypt=hash::make($password);
        $name = $staff_firstname . ' ' . $staff_lastname;
        $email = $staff_email;
        $role=4;
        $account=new User;
        $account->name=$name;
        $account->password=$encrypt;
        $account->email=$email;
        $account->role=$role;
        $account->save();

        $message="Password for your account is $password.";

        $data = [
            'email'=> $email,
            'name' => $name,
            'subject' =>'Account Credentials',
            'message' => $message,
        ];

        Mail::to($data['email'])->send(new NotificationEmail($data));

    }

}

if(!function_exists('generateGuardianCredentials'))
{
     function generateGuardianCredentials($guardian_email, $guardian_firstname, $guardian_lastname){
        $password=generatePassword(8);
        $encrypt=hash::make($password);
        $name = $guardian_firstname . ' ' . $guardian_lastname;
        $email = $guardian_email;
        $role=3;
        $account=new User;
        $account->name=$name;
        $account->password=$encrypt;
        $account->email=$email;
        $account->role=$role;
        $account->save();

        $message="Password for your account is $password.";

        $data = [
            'email'=> $email,
            'name' => $name,
            'subject' =>'Account Credentials',
            'message' => $message,
        ];

        Mail::to($data['email'])->send(new NotificationEmail($data));

    }

}


if(!function_exists('generateStudentGuardianCredentials'))
{
     function generateStudentGuardianCredentials($guardian_email, $guardian_firstname, $guardian_lastname){
        $password=generatePassword(8);
        $encrypt=hash::make($password);
        $name = $guardian_firstname . ' ' . $guardian_lastname;
        $email = $guardian_email;
        $role=3;
        $account=new User;
        $account->name=$name;
        $account->password=$encrypt;
        $account->email=$email;
        $account->role=$role;
        $account->save();

        $message="Password for your account is $password.";

        $data = [
            'email'=> $email,
            'name' => $name,
            'subject' =>'Account Credentials',
            'message' => $message,
        ];

        Mail::to($data['email'])->send(new NotificationEmail($data));

    }

}



if(!function_exists('generatePassword')){

    function generatePassword($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}
