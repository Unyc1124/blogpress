<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Login Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Logic
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'email' => 'required|email',

            'password' => 'required|min:6'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Attempt Authentication
        |--------------------------------------------------------------------------
        */

        $credentials = [

            'email' => $request->email,

            'password' => $request->password,

            'role' => 'admin'
        ];

        /*
        |--------------------------------------------------------------------------
        | Login Success
        |--------------------------------------------------------------------------
        */

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/admin');
        }

        /*
        |--------------------------------------------------------------------------
        | Login Failed
        |--------------------------------------------------------------------------
        */

        return back()->with('error',
            'Invalid email or password');
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}