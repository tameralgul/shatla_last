<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $cities = DB::table('cities')
                ->select([
                    'cities.id', 'cities.name',
                    DB::raw("DATE_FORMAT(cities.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($cities)
                ->addColumn('actions', function ($cities) {
                    return '<button type="button" class="btn btn-success btn-sm editCity" data-toggle="modal"  id="editCity" data-id="' . $cities->id . '">تعديل</button>
                    <button type="button" data-id="' . $cities->id . '" data-name="' . $cities->name . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })
                ->rawColumns(['actions'])->make(true);
        }
        return view('admin.cities.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $city = City::create([

            'name' => $request->name,
        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {

        if (request()->ajax()) {
            $data = City::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ في ادخال البيانات']);
        }

        $city = City::find($request->city_id);
        $array = [];

        if ($request->name != $city->name) {
            $array['name'] = $request->name;
        }

        if (!empty($array)) {
            $city->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }
    public function delete($id)
    {
        $city = City::findOrFail($id);
        $result = $city->delete($id);
        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
    }

    protected function Rules()
    {
        return ['name' => 'required'];
    }

    protected function Messages()
    {
        return ['name.required' => 'حقل المدينة مطلوب'];
    }
}
