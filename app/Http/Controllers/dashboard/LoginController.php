<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }


    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->back();
        }
        return view('admin.auth.login');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {

            return back()->withErrors([
                'message' => 'Wrong Email or Password , Please try again'
            ]);
        }
        return redirect('/dashboard');
    }


    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('dashboard/login')->with('success', 'You have been logged out');
    }
}
