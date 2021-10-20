<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FrontLoginController extends Controller
{
    // use AuthenticatesUsers;

    protected $redirectTo = '/';

   

    public function register()
    {
        return view('user.auth.register');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'البريد الإلكتروني مطلوب',
                'password.required' => 'الباسورد مطلوب',
            ]
        );

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'message' => 'حدث خطأ في البيانات'
            ]);
        }
        return redirect('/');
    }

    public function showLogin()
    {
        return view('front_layout.sign_in_modal');
    }

    protected function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        auth()->login($user);

        return redirect()->route('home.index');
    }



    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You have been logged out');
    }

    public function Rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ];
    }

    public function Messages()
    {
        return [
            'name.required' => 'الإسم مطلوب',
            'email.required' => 'الإيميل مطلوب',
            'email.unique' => 'الإيميل مسجل بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ];
    }
}
