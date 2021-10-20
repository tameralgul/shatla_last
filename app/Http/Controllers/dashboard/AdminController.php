<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminController extends Controller
{

    public function profile($id)
    {
        $id = Auth::guard()->id();
        $adminProfile = Admin::findOrFail($id);
        return view('admin.auth.show-profile', compact('adminProfile'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        $array = [];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('/images/admin/') . $admin->image)) {
                File::delete(public_path('/images/admin/') . $admin->image);
            }
            $file->move(public_path('/images/admin/'), $fileName);
            $array = ['image' => $fileName] + $array;
        }

        if ($request->name != $admin->name) {
            $array['name'] = $request->name;
        }

        if ($request->email != $admin->email) {
            $array['email'] = $request->email;
        }

        if ($request->password != '') {
            $array['password'] = Hash::make($request->password);
        }

        if (!empty($array)) {
            $admin->update($array);
        }
        return response()->json(['status' => 200, 'success' => 'تم التحديث بنجاح', 'data' => $array]);
    }
}
