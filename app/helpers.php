<?php 

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

if(!function_exists('generateStaffCredentials'))
{
     function generateStaffCredentials($staff_email, $staff_firstname, $staff_lastname){
        $password=generatePassword(8);
        $encrypt=hash::make($password);
        $name = $staff_firstname . ' ' . $staff_lastname;
        $email = $staff_email;
        $role=2;
        $account=new User;
        $account->name=$name;
        $account->password=$encrypt;
        $account->email=$email;
        $account->role=$role;
        $account->save();

        $message="Password for your account is $password, you can reset your account password <a href=''>here</a> to keep your account secure.";
        $data = array('name'=> $name);
        Mail::send(['text'=>'mail'], $data, function($message, $email) {
            $message->to($email, 'Login Credentials')->subject
               ('Login Credentails');
            $message->from('notify@yensoftgh.com','Yensoft School DB');
         });

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
 