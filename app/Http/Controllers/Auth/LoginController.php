<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt($credentials))
        {
            $user_role=\Illuminate\Support\Facades\Auth::user()->role;

            switch($user_role){
                case 1:
                    return redirect('/home')->with('success', 'Welcome to the admin area.')->with('display_time', 3);
                    break;

                case 2:
                    return redirect('/teacher')->with('success', 'You are logged in as a teacher.')->with('display_time', 3);
                    break;

                case 3:
                    return redirect('/guardian')->with('success', 'You are logged in as a parent.')->with('display_time', 3);
                    break;

                case 4:
                    return redirect('/user')->with('success', 'You are logged in as a new user.')->with('display_time', 3);
                    break;

                default:
                    Auth::logout();
                    return redirect('/login')->with('error', 'role not specified');
            }

        }else
        {
            return redirect('/login');
        }
    }
}
