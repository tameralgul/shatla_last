<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\icon;
use App\Models\options;
use App\Models\Product;
use App\Models\product_discounts;
use App\Models\Product_images;
use App\Models\product_options;
use App\Models\product_tags;
use App\Models\subcategory;
use App\Models\Tag;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $Draw = $request->input("Draw");

        if (request()->ajax()) {
            $products = DB::table('products')
                ->leftJoin("categories", "categories.id", "=", "products.category_id")
                ->leftJoin("vendors", "vendors.id", "=", "products.vendor_id")
                ->select([
                    'products.id as product_id',
                    'products.title',  'categories.name as category', 'products.vendor_id', 'vendors.name as vendor_name',
                    'products.category_id', 'products.product_code',
                    'products.cover_image',
                    DB::raw("DATE_FORMAT(products.created_at, '%Y-%m-%d') as Date"),
                ])->orderBy('products.id', 'DESC')->get();


            return DataTables::of($products)
                ->addColumn('actions', function ($products) {
                    return '<button type="button" class="btn btn-primary btn-sm addOption" data-toggle="modal"  id="addOption" data-id="' . $products->product_id . '"><i class="fa fa-plus ml-2">خصائص</i></button>
                    <a href="/dashboard/products/edit/' . $products->product_id . '" class="btn btn-success btn-sm editProduct"  id="editProduct" data-id="' . $products->product_id . '">تعديل</a>
                    <button type="button" data-id="' . $products->product_id . '" data-name="' . $products->title . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm " id="getDeleteId">حذف</button>';
                })
                ->addColumn('cover_image', function ($products) {
                    $url = asset('images/products/cover_images/' . $products->cover_image);
                    return '<img src="' . $url . '" border="0" style="border-radius: 10px;" width="80" class="img-rounded" align="center" />';
                })->editColumn('category', function ($products) {
                    return view('admin.products.category', compact('products'));
                })->rawColumns(['cover_image', 'actions', 'category'])->make(true);
            return response()->json(["data" => $products, 'draw' => $Draw]);
        }
        $options = options::all();
        $icons = icon::all();
        return view('admin.products.index', compact('options', 'icons'));
    }

    public function create()
    {
        $categories = Category::select(['name', 'id'])->get();
        $tags = Tag::select(['name', 'id'])->get();
        $discounts = product_discounts::all();
        $vendors = Vendor::select(['id', 'name'])->get();
        $cities = City::select(['id', 'name'])->get();
        return view('admin.products.create', compact('categories', 'cities', 'tags', 'vendors', 'discounts'));
    }

    public function store(Request $request)
    {

        $request->validate($this->rules(), $this->messages());

        $file  = $request->file('cover_image');
        $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products/cover_images'), $fileName);
        $data = ['cover_image' => $fileName];

        $data['title']           = $request->title;
        $data['product_code']     = $request->product_code;
        $data['vendor_id']          = $request->vendor_id;
        $data['price']    = $request->price;
        $data['available_in_stock']    = $request->available_in_stock;
        $data['city_id']    = $request->city_id;
        $data['description']    = $request->description;
        $data['category_id']    = $request->category_id;
        $data['product_discount_id']     = $request->product_discount_id;
        $data['sub_category'] = $request->sub_category;
        $product = Product::create($data);
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $filename = $product->title . '-' . time() . '-' . $i . '.' . $file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('images/products/' . $filename);
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $product->media()->create([
                    'image_name' => $filename,
                    'image_size' => $file_size,
                    'image_type' => $file_type,
                ]);
                $i++;
            }
        }

        if (($request->tags) && !empty($request->tags)) {
            $product->tags()->sync($request->tags);
        }
        return response()->json(['status' => 200, 'success' => 'تم اضافة المنتج بنجاح']);
    }


    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product_id);


        $data['title']           = $request->title;
        $data['product_code']     = $request->product_code;
        $data['vendor_id']       = $request->vendor_id;
        $data['price']    = $request->price;
        $data['available_in_stock']    = $request->available_in_stock;
        $data['city_id']    = $request->city_id;
        $data['description']    = $request->description;
        $data['category_id']    = $request->category_id;
        $data['product_discount_id']     = $request->product_discount_id;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = time() . Str::random(12) . '.' . $file->getClientOriginalExtension();
            if (File::exists(public_path('/images/products/cover_images/') . $product->cover_image)) {
                File::delete(public_path('/images/products/cover_images/') . $product->cover_image);
            }
            $file->move(public_path('/images/products/cover_images/'), $fileName);
            $data = ['cover_image' => $fileName] + $data;
        }

        $product->update($data);
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {

                $filename = $product->title . '-' . time() . '-' . $i . '.' . $file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('images/products/' . $filename);
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'image_name' => $filename,
                    'image_size' => $file_size,
                    'image_type' => $file_type,
                ]);
                $i++;
            }
        }

        if (($request->tags) && !empty($request->tags)) {
            $product->tags()->sync($request->tags);
        }
        return response()->json(['status' => 200, 'success' => 'تم تعديل المنتج بنجاح']);
    }

    public function edit($id)
    {
        $categories = Category::orderBy('id', 'desc')->select('id', 'name')->get();
        $tags = Tag::orderBy('id', 'desc')->select('id', 'name')->get();
        $vendors = Vendor::orderBy('id', 'desc')->select('id', 'name')->get();
        $discounts = product_discounts::all();
        $products = Product::with(['media'])->whereId($id)->first();
        $cities = City::select(['id', 'name'])->get();
        return view('admin.products.edit', compact('categories', 'cities', 'discounts', 'vendors', 'tags', 'products'));
    }

    public function add_option_to_product($id)
    {
        if (request()->ajax()) {
            $data = Product::findOrFail($id);
            $options = options::all();
            return response()->json(['result' => $data, 'options' => $options]);
        }
    }

    public function product_option_update(Request $request)
    {
        $request->validate(
            [
                "option_id" => "required",
                "option" => "required",
            ],
            [
                'option.required' => 'النص مطلوب',
                'option_id.required' => 'الخاصية مطلوبة',
            ]
        );

        DB::table('product_options')->insert([
            'option_id' => $request->option_id,
            'product_id' => $request->product_id,
            'option' => $request->option,
        ]);

        return response()->json(['status' => 200, 'success' => 'تم اضافة المنتج بنجاح']);
    }

    public function removeImage($media_id)
    {
        $media = Product_images::whereId($media_id)->first();
        if ($media) {
            if (File::exists('images/products/' . $media->image_name)) {
                unlink('images/products/' . $media->image_name);
            }
            $media->delete();
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $product = Product::whereId($id)->first();

        if ($product) {

            if ($product->media->count() > 0) {
                foreach ($product->media as $media) {
                    if (File::exists('images/products/' . $media->image_name)) {
                        unlink('images/products/' . $media->image_name);
                    }

                    if (File::exists(public_path('/images/products/cover_images/') . $product->cover_image)) {
                        File::delete(public_path('/images/products/cover_images/') . $product->cover_image);
                    }
                }
            }
            $productTag = product_tags::where('product_id', "=", $product->id);
            $productImages = Product_images::where('product_id', "=", $product->id);
            if ($productTag != null)
                $productTag->delete();

            if ($productImages != null)
                $productImages->delete();

            $product->delete();
            return response()->json(['status' => 200, 'success' => 'تم تعديل المنتج بنجاح']);
        }
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'product_code' => 'required|unique:products',

            'price' => 'required',
            'available_in_stock' => 'required|numeric',
            'description' => 'required|max:255|min:5',
            'cover_image' => 'required|mimes:png,jpg,gif,JPEG,JFIF',
            // 'product_discount_id' => 'required',
            // 'category_id' => 'required',
            // 'tags' => 'required',
            // 'images' => 'required|mimes:png,jpg,gif,JPEG,JFIF',
        ];
    }

    public function messages()
    {
        return [
            'title.required' =>  'حقل العنوان مطلوب',
            'product_code.required' => 'حقل رمز المنتج مطلوب',
            'product_code.unique' => 'هذا الحقل موجود مسبقآ',

            'price.required' => 'حقل السعر مطلوب',
            'available_in_stock.required' => 'حقل المتبقي في المخزن مطلوب',
            'description.required' => 'حقل الوصف مطلوب',
            'cover_image.required' => 'حقل صورة الغلاف مطلوب',
            'cover_image.mimes' => 'تأكد من أمتدام الصورة المرفقة',
            // 'category_id.required' => 'حقل الصنف مطلوب',
            // 'product_discount_id.required' => 'حقل الخصم مطلوب',
            // 'tags.required' => 'حقل الوسم مطلوب',
            // 'images.required' => 'حقل صور المنتج مطلوبة',
        ];
    }
    public function sub_category($id)
    {
        $sub_category = subcategory::where('category_id', $id)->get();
        if ($sub_category->isEmpty()) {
            return response()->json(['status' => false]);
        } else {
            return response()->json(['status' => true, 'data' => $sub_category]);
        }
    }
}
