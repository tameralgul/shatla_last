<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact_us()
    {
        return view('contact_us');
    }

    public function create_contact_us(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'message' => 'required'
            ],
            [
                'email.required' => 'البريد الإلكتروني مطلوب',
                'message.required' => 'الرسالة مطلوبة',
                'email.email' => 'الرجاء إدخال بريد صحيح',
            ]
        );

        $contact = ContactUs::create(
            [
                'email' => $request->email,
                'message' => $request->message,
            ]);

        return response()->json(['status' => 200, 'success' => 'تمت ارسال الرسالة بنجاح']);
    }
}
