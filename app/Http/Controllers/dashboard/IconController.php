<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\icon;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class IconController extends Controller
{
    use ImageTrait;

    public function index()
    {
        if (request()->ajax()) {
            $icon = DB::table('icons')
                ->select([
                    'icons.id', 'icons.name', 'icons.icon',
                    DB::raw("DATE_FORMAT(icons.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($icon)
                ->addColumn('actions', function ($icon) {
                    return '<a href="#" class="btn btn-success btn-sm editIcon"   id="editIcon" data-id="' . $icon->id . '">تعديل</a>
                    <button type="button" data-id="' . $icon->id . '" data-name="' . $icon->name . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })->addColumn('icon', function ($icon) {
                    $url = asset('images/icons/' . $icon->icon);
                    return '<img src="' . $url . '" border="0" style="border-radius: 10px;" width="80" class="img-rounded" align="center" />';
                })
                ->rawColumns(['actions','icon'])->make(true);
        }

        return view('admin.icons.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate($this->Rules(), $this->Messages());
        $file_name =  $this->saveImages($request->icon, 'images/icons');

        $options = icon::create([
            'name' => $request->name,
            'icon' => $file_name,

        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = icon::findOrFail($id);
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

        $icon = icon::find($request->icon_id);

        $array = [];
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('/images/icons/') . $icon->icon)) {
                File::delete(public_path('/images/icons/') . $icon->icon);
            }
            $file->move(public_path('/images/icons/'), $fileName);
            $array = ['icon' => $fileName];
        }

        if ($request->name != $request->name) {
            $array['name'] = $request->name;
        }

        if (!empty($array)) {
            $icon->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }


    protected function Rules()
    {
        return ['name' => 'required', 'icon' => 'required'];
    }

    protected function Messages()
    {
        return ['name.required' => 'حقل الاسم مطلوب', 'icon.required' => 'حقل الصورة مطلوب'];
    }

    public function delete(Request $request, $id)
    {
        $icon = icon::findOrFail($id);
        $icon->delete($id);

        if ($icon) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        }
    }
}
