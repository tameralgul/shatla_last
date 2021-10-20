<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\subcategory;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class CategoryController extends Controller
{

    use ImageTrait;
    
    public function index()
    {
        if (request()->ajax()) {
            $categories = DB::table('categories')
                ->select([
                    'categories.id', 'categories.name', 'categories.image',
                    DB::raw("DATE_FORMAT(categories.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($categories)
                ->addColumn('actions', function ($categories) {
                    return '<button type="button" class="btn btn-success btn-sm editCategory" data-toggle="modal"  id="editCategory" data-id="' . $categories->id . '">تعديل</button>
                    <button type="button" data-id="' . $categories->id . '" data-name="' . $categories->name . '"  data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })->addColumn('image', function ($categories) {
                    $url = asset('images/category/' . $categories->image);
                    return '<img src="' . $url . '" border="0" style="border-radius: 10px;" width="80" class="img-rounded" align="center" />';
                })
                ->rawColumns(['image','actions'])->make(true);
        }
        return view('admin.categories.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(),$this->Messages());
        $arr =[
            'name' => $request->name,
        ];
        if ($request->has('image')){
        $file_name =  $this->saveImages($request->image, 'images/category');
          $arr+=  ['image' => $file_name];
        }
        $category = Category::create($arr);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
        
    }

    public function edit($id)
    {

        if (request()->ajax()) {
            $data = Category::findOrFail($id);
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

        $cate = Category::find($request->category_id);
        $array = [];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('/images/category/') . $cate->image)) {
                File::delete(public_path('/images/category/') . $cate->image);
            }
            $file->move(public_path('/images/category/'), $fileName);
            $array = ['image' => $fileName];
        }
        
        if ($request->name != $cate->name) {
            $array['name'] = $request->name;
        }


        if (!empty($array)) {
            $cate->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }

    public function delete(Request $request ,$id)
    {
        $category = Category::findOrFail($id);
        $result = $category->delete($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('/images/category/') . $category->image)) {
                File::delete(public_path('/images/category/') . $category->image);
            }

        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
        }
    }

    protected function Rules()
    {
        return ['name' => 'required'];
    }

    protected function Messages()
    {
        return ['name.required' => 'حقل التصنيف مطلوب'];
    }
}
