<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;


class ForgotPasswordController extends Controller
{
    
    public function getEmail()
    {

        return view('auth.password.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ],
        [
            'email.exists' => 'البريد الإلكتروني غير موجود لدينا',
                'email.required' => 'البريد الاكتروني مطلوب',
                'email.email' => 'يجب كتابة ايميل صحيح'
        ]
        );

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.password.verify', ['token' => $token], function ($message) use ($request) {
            $message->from('email@example.com');
            $message->to($request->email);
            $message->subject('شتلة | تعيين كلمة مرور جديدة');
        });

        return back()->with('message', 'تم ارسال رابط تغير كلمة المرور, تحقق من ايميلك');
    }
}
