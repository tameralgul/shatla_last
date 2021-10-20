<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\City;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\subcategory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
   /*     view()->share('setting', Setting::orderBy('created_at', 'desc')->limit(1)->get()->first());
        view()->share('categories', Category::with(['subCategory'])->orderBy('id', 'desc')->get());
        view()->share('pages_data', Page::all());
        view()->share('pages_data_2', Page::orderBy('id','desc')->limit(3)->get());
        view()->share('cities',City::all());*/
    }
        // view()->share('subcategory', subcategory::select('name', 'id'))->get();
}
