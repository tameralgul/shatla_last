<?php

namespace App\Http\Controllers\front;

use App\Models\subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
  
    public function category($id)
    {
      $category = Category::findOrFail($id);
      $products = Product::where('category_id',$id)->get();
        $last_product = Product::with(['discount'])->orderBy('id', 'desc')->latest()->get();

      return view('category',compact('products','category', 'last_product'));

    }
    public function sub_category($id)
    {
        $category = subcategory::findOrFail($id);
        $products = Product::where('sub_category',$id)->get();
        $last_product = Product::with(['discount'])->orderBy('id', 'desc')->latest()->get();

        return view('category',compact('products','category', 'last_product'));

    }
}
