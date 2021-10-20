<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\icon;
use App\Models\options;
use App\Models\product_options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOption\Option;
use Yajra\DataTables\DataTables;

class optioncontroller extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $options = DB::table('options')
            ->join('icons', 'icons.id', 'options.icon_id')
            ->select([
                'options.id as option_id', 'options.name', 'icons.id as id' ,'icons.name as icon_name',
                DB::raw("DATE_FORMAT(options.created_at, '%Y-%m-%d') as Date"),
            ])->orderBy('option_id', 'DESC')->get();

            return  DataTables::of($options)
                ->addColumn('actions', function ($options) {
                   return '<a href="#" class="btn btn-success btn-sm editOption"   id="editOption" data-id="' . $options->option_id . '">تعديل</a>
                    <button type="button" data-id="' . $options->option_id . '" data-name="' . $options->name . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })
                ->rawColumns(['actions'])->make(true);
        }

        $icons = icon::all();
        
        return view('admin.options.index', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $options = options::create([

            'name' => $request->name,
            'icon_id' => $request->icon_id,

        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = options::findOrFail($id);
            $icons = icon::all();
            $icon_id = icon::where('id',$data->icon_id)->first();
   
            return response()->json(['result' => $data,'icons'=>$icons,'icon_id'=>$icon_id]);
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

        $option = options::find($request->option_id);

        if ($request->name != $option->name) {
            $array['name'] = $request->name;
        }
        if ($request->icon_id != $option->icon_id) {
            $array['icon_id'] = $request->icon_id;
        }

        if (!empty($array)) {
            $option->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }


    protected function Rules()
    {
        return ['name' => 'required', 'icon_id' => 'required'];
    }

    protected function Messages()
    {
        return ['name.required' => 'حقل الخاصية مطلوب', 'icon_id.required' => 'حقل التصنيف الأب مطلوب'];
    }

    public function delete(Request $request, $id)
    {
        $option = options::findOrFail($id);
        $product_options = product_options::where('option_id',$id);
        if ($product_options != null)
        $product_options->delete($id);
        $option->delete($id);
        if ($option) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        }
        
    }
}
