<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $contact_us = DB::table('contact_us')
                ->select([
                    'contact_us.id', 'contact_us.email', 'contact_us.message',
                    DB::raw("DATE_FORMAT(contact_us.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($contact_us)
                ->addColumn('actions', function ($contact_us) {
                    return '<button type="button" data-id="' . $contact_us->id . '"  data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })->editColumn('message',function ($contact_us) {
                        return view('admin.contacts.message', compact('contact_us'));
                })->rawColumns(['actions'])->make(true);
        }
        return view('admin.contacts.index');
    }

    public function delete($id)
    {
        $contact_us = ContactUs::findOrFail($id);
        $result = $contact_us->delete($id);
        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
    }
}
