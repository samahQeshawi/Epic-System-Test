<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }
    public function redirectTo(): string
    {
        return route('users.index');
    }

    public function showLoginForm(){

        return view('dashboard.auth.login');
    }

    public function login(Request $request){


        if ( Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            Auth::guard('admin')->user();
            return redirect('admin/users');

        }

        return redirect('admin/login')->withErrors([

            'error' => 'The email or password is wrong.',

        ])->withInput($request->only('email','remember'));

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }

}
