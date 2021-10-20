<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;


class TagsController extends Controller
{
        public function index()
    {
        if (request()->ajax()) {
            $tags = DB::table('tags')
                ->select([
                    'tags.id', 'tags.name',
                    DB::raw("DATE_FORMAT(tags.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($tags)
                ->addColumn('actions', function ($tags) {
                    return '<button type="button" class="btn btn-success btn-sm editTag" data-toggle="modal"  id="editTag" data-id="' . $tags->id . '">تعديل</button>
                    <button type="button" data-id="' . $tags->id . '" data-name="' . $tags->name . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })
                ->rawColumns(['actions'])->make(true);
        }
        return view('admin.tags.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $category = Tag::create([

            'name' => $request->name,
        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {

        if (request()->ajax()) {
            $data = Tag::findOrFail($id);
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

        $tag = Tag::find($request->tag_id);
        $array = [];

        if ($request->name != $tag->name) {
            $array['name'] = $request->name;
        }

        if (!empty($array)) {
            $tag->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }
  public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $result = $tag->delete($id);
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
        return ['name.required' => 'حقل الوسم مطلوب'];
    }
}
