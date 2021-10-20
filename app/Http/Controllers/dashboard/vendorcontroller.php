<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class vendorcontroller extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $vendors = DB::table('vendors')
                ->select([
                    'id', 'name', 'email', 'phone',
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($vendors)
                ->addColumn('actions', function ($vendors) {
                    return '<button type="button" class="btn btn-success btn-sm editVendor" data-toggle="modal"  id="editVendor" data-id="' . $vendors->id . '">تعديل</button>
                    <button type="button" data-id="' . $vendors->id . '" data-name="' . $vendors->name . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })
                ->rawColumns(['actions'])->make(true);
        }
        return view('admin.vendors.index');
    }


    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $vendors = Vendor::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {

        if (request()->ajax()) {
            $data = Vendor::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ في ادخال البيانات']);
        }

        $vendors = Vendor::find($request->vendor_id);
        $array = [];

        if ($request->name != $vendors->name) {
            $array['name'] = $request->name;
        }

        if ($request->phone != $vendors->phone) {
            $array['phone'] = $request->phone;
        }

        if ($request->email != $vendors->email) {
            $email = Vendor::where('email', $request->email)->first();
            if ($email == null) {
                $array['email'] = $request->email;
            }
        }

        if (!empty($array)) {
            $vendors->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }
    public function delete($id)
    {
        $vendors = Vendor::findOrFail($id);
        $result = $vendors->delete($id);
        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
    }


    protected function Rules()
    {
        return ['name' => 'required','email'=>'required'];
    }

    protected function Messages()
    {
        return ['name.required' => 'حقل الوسم مطلوب','email.required' => 'البريد مطلوب'];
    }
    public function show_vendor(){
        return view('come_with_us');
    }
    public function show_vendor_page($id){
        $vendor = Vendor::findOrFail($id);
        return view('seller_page',compact('id','vendor'));
    }
    public function seller_products($id){
        $products = Product::where('vendor_id',$id)->get();
        return view('seller.products',compact('products'));
    }
    public function show_info_seller($id){
        $vendor = Vendor::findOrFail($id);
        return view('seller.info',compact('vendor'));

    }
}
