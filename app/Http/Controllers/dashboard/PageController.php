<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $pages = DB::table('pages')
                ->select([
                    'pages.*',
                    DB::raw("DATE_FORMAT(pages.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($pages)

                ->addColumn('actions', function ($pages) {
                    return '<button type="button" class="btn btn-success btn-sm editPage" data-toggle="modal"  id="editPage" data-id="' . $pages->id . '">تعديل</button>
                    ';
                })->editColumn(
                    'description',
                    function ($pages) {
                        return Str::limit($pages->description, 50);
                    }
                )->rawColumns(['actions'])->make(true);
        }
        return view('admin.pages.index');
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());

        $page = Page::create([

            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);
    }

    public function edit($id)
    {

        if (request()->ajax()) {
            $data = Page::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ في ادخال البيانات']);
        }

        $page = Page::find($request->page_id);
        $array = [];

        if ($request->title != $page->title) {
            $array['title'] = $request->title;
        }

        if ($request->description != $page->description) {
            $array['description'] = $request->description;
        }

        if (!empty($array)) {
            $page->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }
    public function delete($id)
    {
        $page = Page::findOrFail($id);
        $result = $page->delete($id);
        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
    }


    protected function Rules()
    {
        return ['title' => 'required', 'description' => 'required'];
    }

    protected function Messages()
    {
        return ['title.required' => 'حقل الوسم مطلوب', 'description.required' => 'النص مطلوب'];
    }
}
