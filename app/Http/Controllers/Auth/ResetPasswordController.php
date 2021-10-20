<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function getPassword($token)
    {

        $email = DB::table('password_resets')->where('token','=',$token)->select('email')->get()->first();
        if ($email == null){
            abort(404);
        }
        return view('auth.password.reset', ['token' => $token,'email'=>$email->email]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',

            ],
            [
                'email.exists' => 'البريد الإلكتروني غير موجود لدينا',
                'email.required' => 'البريد الاكتروني مطلوب',
                'email.email' => 'يجب كتابة ايميل صحيح',
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'كلمة المرور يجب ان تتكون من 6 حروف على الأقل',
                'password.confirmed' => 'كلمة المرور غير متطابقة',
            ]
        );

        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$updatePassword)
            return back()->withInput()->with('error', 'هذه العملية غير مسموحة , يرجي تحديث عملية استعادة كلمة المرور');

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/')->with('message', 'تم تغير كلمة المرور!');
    }
}
