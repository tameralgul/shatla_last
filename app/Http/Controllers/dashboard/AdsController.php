<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ads;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;



class AdsController extends Controller
{

    use ImageTrait;

    public function index()
    {
        if (request()->ajax()) {
            $ads = DB::table('ads')
                ->select([
                'ads.id', 'ads.title', 'ads.image', 'ads.active', 'ads.expired_date', 'ads.description',
                    DB::raw("DATE_FORMAT(ads.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('id', 'DESC')->get();

            return  DataTables::of($ads)
                ->addColumn('actions', function ($ads) {
                    return '<button type="button" class="btn btn-success btn-sm editAds" data-toggle="modal"  id="editAds" data-id="' . $ads->id . '">تعديل</button>
                    <button type="button" data-id="' . $ads->id . '" data-name="' . $ads->title . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
             })->editColumn('active', function ($ads) {
                    return view('admin.ads.activity', compact('ads'));
                })->addColumn('image', function ($ads) {
                    $url = asset('images/ads/' . $ads->image);
                    return '<img src="' . $url . '" border="0" style="border-radius: 10px;" width="80" class="img-rounded" align="center" />';
                })
                ->rawColumns(['actions', 'image' ,'active'])->make(true);
        }
        return view('admin.ads.index');
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = ads::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'expired_date' => 'required',
            'active' => 'required',
            'description' => 'required|min:5|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ في ادخال البيانات']);
        }

    //   dd($request->image);

        $ads = ads::find($request->ad_id);
        $array = [];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('/images/ads/') . $ads->image)) {
                File::delete(public_path('/images/ads/') . $ads->image);
            }
            $file->move(public_path('/images/ads/'), $fileName);
            $array = ['image' => $fileName];
        }
        if ($request->title != $ads->title) {
            $array['title'] = $request->title;
        }

        if ($request->active != $ads->active) {
            $array['active'] = $request->active;
        }
        if ($request->description != $ads->description) {
            $array['description'] = $request->description;
        }

        if ($request->expired_date != $ads->expired_date) {
            $array['expired_date'] = $request->expired_date;
        }

        if (!empty($array)) {
            $ads->update($array);
        }

        return response()->json(['status' => 200, 'success' => 'تمت العملية بنجاح']);
    }

    public function store(Request $request)
    {
        $request->validate($this->Rules(), $this->Messages());
        $file_name =  $this->saveImages($request->image, 'images/ads');

        $ads =  ads::create([
            'image' => $file_name,
            'title' => $request->title,
            'active' => $request->active,
            'expired_date' => $request->expired_date,
            'description' => $request->description,
        ]);
        return response()->json(['status' => 200, 'success' => 'تم الإضافة بنجاح']);

    }

    public function delete($id)
    {
        $ads = ads::findOrFail($id);
        $result = $ads->delete($id);
        if ($result) {
            return response()->json(['status' => 200, 'success' => 'تم الحذف بنجاح']);
        } else {
            return response()->json(['status' => 504, 'error' => 'حدث خطأ ما ']);
        }
    }


    protected function Rules()
    {
        return [
            'title' => 'required',
            'active' => 'required',
            'expired_date' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];
    }

    protected function Messages()
    {
        return [
            'title.required' => 'حقل العنوان مطلوب',
            'active.required' => 'حقل الحالة مطلوب',
            'expired_date.required' => 'حقل المدة مطلوب',
            'description.required' => 'حقل الوصف مطلوب',
            'image.required' => 'حقل الصورة مطلوب',
        ];
    }
}
