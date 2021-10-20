<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\product_discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DiscountsController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $discounts = DB::table('product_discounts')
                ->select([
                    'product_discounts.id', 'product_discounts.value', 'product_discounts.expired_date',
                    'product_discounts.type',
                    DB::raw("DATE_FORMAT(product_discounts.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($discounts)
                ->addColumn('actions', function ($discounts) {
                    return '<button type="button" class="btn btn-success btn-sm editDiscount" data-toggle="modal"  id="editDiscount" data-id="' . $discounts->id . '">تعديل</button>
                    <button type="button" data-id="' . $discounts->id . '"  data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })->editColumn('type', function ($discounts) {
                    return view('admin.product_discounts.discount-type', compact('discounts'));
                })
                ->rawColumns(['actions'])->make(true);
        }
        return view('admin.product_discounts.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $discount = product_discounts::create([

            'value' => $request->value,
            'expired_date' => $request->expired_date,
            'type' => $request->type,
        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'value' => 'required',
            'expired_date' => 'required',
            'type' => 'required',
        ] );

        if ($validation->fails()) {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ في ادخال البيانات']);
        }

        $discount = product_discounts::find($request->discount_id);
        $array = [];

        if ($request->value != $discount->value) {
            $array['value'] = $request->value;
        }

        if ($request->expired_date != $discount->expired_date) {
            $array['expired_date'] = $request->expired_date;
        }

        if ($request->type != $discount->type) {
            $array['type'] = $request->type;
        }

        if (!empty($array)) {
            $discount->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = product_discounts::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function delete($id)
    {
        $discount = product_discounts::findOrFail($id);
        $result = $discount->delete($id);
        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
    }


    protected function Rules()
    {
        return [
            'value' => 'required',
            'expired_date' => 'required',
            'type' => 'required',
        ];
    }

    protected function Messages()
    {
        return [
            'value.required' => 'حقل القيمة مطلوب',
            'type.required' => 'حقل النوع مطلوب',
            'expired_date.required' => 'حقل التاريخ مطلوب',
        ];
    }
}
