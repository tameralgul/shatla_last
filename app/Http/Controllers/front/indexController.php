<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ads;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Product_images;
use App\Models\product_options;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class indexController extends Controller
{



    public function index()
    {
        if (session()->has('city')) {
            $city = session()->get('city');
            $rand1 = Product::where('city_id', $city)->inRandomOrder()->limit(1)->get()->first();
            if ($rand1 == null) {
                $rand2 = $rand1;
            } else {

                $rand2 = Product::where('city_id', $city)->where('id', '!=', $rand1->id)->inRandomOrder()->limit(1)->get()->first();
            }
            if ($rand2 == null) {
                $rand3 = $rand2;
            } else {
                $rand3 = Product::where('city_id', $city)->whereNotIn('id', [$rand2->id, $rand1->id])->inRandomOrder()->limit(1)->get()->first();
            }
            if ($rand3 == null) {
                $rand4 = $rand3;
            } else {
                $rand4 = Product::where('city_id', $city)->whereNotIn('id', [$rand2->id, $rand1->id, $rand3->id])->inRandomOrder()->limit(1)->get()->first();
            }

            $new_product = Product::with(['discount'])->where('city_id', $city)->orderBy('id', 'asc')->get();

            $last_product = Product::with(['discount'])->where('city_id', $city)->orderBy('id', 'desc')->latest()->get();
        } else {
            $rand1 = Product::inRandomOrder()->limit(1)->get()->first();

            if ($rand1 == null) {
                $rand2 = $rand1;
            } else {

                $rand2 = Product::where('id', '!=', $rand1->id)->inRandomOrder()->limit(1)->get()->first();
            }
            if ($rand2 == null) {
                $rand3 = $rand2;
            } else {
                $rand3 = Product::whereNotIn('id', [$rand2->id, $rand1->id])->inRandomOrder()->limit(1)->get()->first();
            }
            if ($rand3 == null) {
                $rand4 = $rand3;
            } else {
                $rand4 = Product::whereNotIn('id', [$rand2->id, $rand1->id, $rand3->id])->inRandomOrder()->limit(1)->get()->first();
            }
            $new_product = Product::with(['discount'])->orderBy('id', 'asc')->get();

            $last_product = Product::with(['discount'])->orderBy('id', 'desc')->latest()->get();
        }


        $ads = ads::orderBy('id', 'desc')->get();

        $categories = Category::with('subCategory')->orderBy('id', 'desc')->get();

        $products = Product::orderBy('id', 'desc');
        if (request()->has('search') && request()->get('search')  != '') {
            $products = $products->where('title', 'like', "%" . request()->get('search') . "%");
        }
        $products = $products->paginate(30);
        // $pages_data = Page::all();

        return view('index', compact('rand1', 'rand2', 'rand3', 'rand4', 'new_product', 'ads', 'last_product', 'categories'));
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        // dd(Auth::id());
        if (Auth::id()  != $user->id) {
            abort(404);
        } else {
            return view('front_layout.edit-profile', compact('user'));
        }
    }

    public function Updateprofile(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id);
        $array = [];

        if ($request->email != $user->email) {
            $email = User::where('email', $request->email)->first();
            if ($email == null) {
                $array['email'] = $request->email;
            }
        }

        if (
            $request->name != $user->name
        ) {
            $array['name'] = $request->name;
        }

        if (
            $request->password != ''
        ) {
            $array['password'] = Hash::make($request->password);
        }

        if (!empty($array)) {
            $user->update($array);
        }
        return response()->json(['status' => 200, 'success' => 'تم تعديل الحساب بنجاح']);
    }


    public function category()
    {
        $categories = Category::with(['subCategory'])->orderBy('id', 'desc');
        return view('front_layout.layout', compact('categories'));
    }

    public function search()
    {
        $products = Product::where([]);
        if (request()->has('title') && request()->get('title')  != '') {
            $products = $products->where('title', 'like', "%" . request()->get('title') . "%")->get();
        }
        return view('search-result', compact('products'));
    }


    public function showProduct($id)
    {
        $ads = ads::orderBy('id', 'desc')->get();
        $product = Product::where('products.id', $id);
        if (session()->has('city')) {
            $city = session()->get('city');
            $product->where('city_id', $city);
        } else {
        }
        if ($product == null) {
            return  abort(404);
        }
        $product = $product->with('tags', 'media')->get()->first();
        $categories = Category::with(['subCategory'])->orderBy('id', 'desc')->get();
        $images = Product_images::where('product_id', $product->id)->get();
        $options = product_options::where('product_options.product_id', $product->id)
            ->leftjoin('options', 'options.id', 'product_options.option_id')
            ->leftjoin('icons', 'options.icon_id', 'icons.id')
            ->select('options.name', 'icons.icon')
            ->get();


        return view('product', compact('product', 'ads', 'categories', 'images', 'options'));
    }
    public function showModalProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['data' => $product]);
    }

    public function tag($id)
    {
        $tags = Tag::findOrFail($id);

        $product_tags = $tags->products;

        return view('product-tag', compact('product_tags', 'tags'));
    }
    public function change_city(Request $request)
    {
        session()->put('city', $request->input('city'));
        return response()->json(['status' => true]);
    }

    public function pages($id)
    {
        $page = Page::findOrFail($id);
        return view('pages_show', compact('page'));
    }
}
