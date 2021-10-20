<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubCategoryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $subcategories = DB::table('subcategories')
                ->join('categories', 'categories.id', 'subcategories.category_id')
                ->select([
                    'subcategories.id as sub_id', 'subcategories.name', 'categories.name as category_name', 'categories.id',
                    DB::raw("DATE_FORMAT(subcategories.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($subcategories)
                ->addColumn('actions', function ($subcategories) {
                    return '<a href="#" class="btn btn-success btn-sm editSub"   id="editOption" data-id="' . $subcategories->sub_id . '">تعديل</a>
                    <button type="button" data-id="' . $subcategories->sub_id . '" data-name="' . $subcategories->name . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })
                ->rawColumns(['actions'])->make(true);
        }
        $categories = Category::all();
        return view('admin.sub_cat.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $subcategories = subcategory::create([

            'name' => $request->name,
            'category_id' => $request->category_id,

        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = subcategory::findOrFail($id);
            $categories = Category::all();
            $category_id = Category::where('id', $data->category_id)->first();
           
            return response()->json(['result' => $data, 'categories' => $categories, 'category_id' => $category_id]);
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

        $subcate = subcategory::find($request->subcategory_id);

        if ($request->name != $subcate->name) {
            $array['name'] = $request->name;
        }
        if ($request->category_id != $subcate->category_id) {
            $array['category_id'] = $request->category_id;
        }

        if (!empty($array)) {
            $subcate->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }

    public function delete(Request $request, $id)
    {
        $subcategory = subcategory::findOrFail($id);
        $category = Category::where('subcategory_id', '=', $subcategory->id);
        if ($category != null) {
            return response()->json(['status' => 504, 'error' => 'لا يمكن الحذف ,هذا التصنيف الفرعي مرتبط بتصينف رئيسي']);
        } else {

            $result = $subcategory->delete($id);
        }
    }

    protected function Rules()
    {
        return ['name' => 'required', 'category_id' => 'required'];
    }

    protected function Messages()
    {
        return ['name.required' => 'حقل التصنيف الثاني مطلوب', 'category_id.required' => 'حقل التصنيف الأب مطلوب'];
    }
}
