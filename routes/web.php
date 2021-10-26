<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\LoginController;
use App\Http\Controllers\dashboard\AdsController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\CityController;
use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\dashboard\DiscountsController;
use App\Http\Controllers\dashboard\IconController;
use App\Http\Controllers\dashboard\optioncontroller;
use App\Http\Controllers\dashboard\OrderController;
use App\Http\Controllers\dashboard\PageController;
use App\Http\Controllers\dashboard\PostController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\SubCategoryController;
use App\Http\Controllers\dashboard\TagsController;
use App\Http\Controllers\dashboard\vendorcontroller;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\FrontLoginController;
use App\Http\Controllers\front\indexController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\CategoryController as FrontCategory;
use App\Http\Controllers\front\CommentController;
use App\Http\Controllers\front\ContactController;
use App\Http\Controllers\front\PaymentController;
use App\Http\Controllers\front\PaidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

// use ;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('layouts.app');
});
// Route::get('/',function (){
//     return view('index');
// });




Route::get('/register', function () {
    return view('register');
});
Route::get('/product', function () {
    return view('product');
});
Route::group(['prefix' => 'dashboard', 'namespace' => 'dashboard'], function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', [dashboardController::class, 'index'])->name('dashboard.index');
        //posts route
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
        });

        //categories route
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('/update', [CategoryController::class, 'update'])->name('categories.update');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        });
        //subcategories route
        Route::group(['prefix' => 'subcategories'], function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('subcategories.index');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
            Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
            Route::post('/update', [SubCategoryController::class, 'update'])->name('subcategories.update');
            Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategories.delete');
        });

          //options route
        Route::group(['prefix' => 'options'], function () {
            Route::get('/', [optioncontroller::class, 'index'])->name('options.index');
            Route::post('/store', [optioncontroller::class, 'store'])->name('options.store');
            Route::get('/edit/{id}', [optioncontroller::class, 'edit'])->name('options.edit');
            Route::post('/update', [optioncontroller::class, 'update'])->name('options.update');
            Route::get('/delete/{id}', [optioncontroller::class, 'delete'])->name('options.delete');
        });

        //icons route
        Route::group(['prefix' => 'icons'], function () {
            Route::get('/', [IconController::class, 'index'])->name('icons.index');
            Route::post('/store', [IconController::class, 'store'])->name('icons.store');
            Route::get('/edit/{id}', [IconController::class, 'edit'])->name('icons.edit');
            Route::post('/update', [IconController::class, 'update'])->name('icons.update');
            Route::get('/delete/{id}', [IconController::class, 'delete'])->name('icons.delete');
        });

        //tags route
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', [TagsController::class, 'index'])->name('tags.index');
            Route::post('/store', [TagsController::class, 'store'])->name('tags.store');
            Route::get('/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit');
            Route::post('/update', [TagsController::class, 'update'])->name('tags.update');
            Route::get('/delete/{id}', [TagsController::class, 'delete'])->name('tags.delete');
        });

        //product route
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create-product', [ProductController::class, 'create'])->name('products.create');
            Route::get('/sub_category/{id}',[ProductController::class,'sub_category']);
            Route::post('/store',     [ProductController::class, 'store'])->name('products.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit']);
            Route::post('/update-product',  [ProductController::class, 'update'])->name('products.update');
            Route::post('/product/removeImage/{media_id}', [ProductController::class, 'removeImage'])->name('products.media.destroy');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
            Route::get('/product_option/{id}', [ProductController::class, 'add_option_to_product']);
            Route::post('/update-product-option',  [ProductController::class, 'product_option_update'])->name('products.update-option');
        });

        //discounts route
        Route::group(['prefix' => 'discounts'], function () {
            Route::get('/', [DiscountsController::class, 'index'])->name('discounts.index');
            Route::post('/store', [DiscountsController::class, 'store'])->name('discounts.store');
            Route::get('/edit/{id}', [DiscountsController::class, 'edit'])->name('discounts.edit');
            Route::post('/update', [DiscountsController::class, 'update'])->name('discounts.update');
            Route::get('/delete/{id}', [DiscountsController::class, 'delete'])->name('discounts.delete');
        });

        //ads route
        Route::group(['prefix' => 'ads'], function () {
            Route::get('/', [AdsController::class, 'index'])->name('ads.index');
            Route::post('/store', [AdsController::class, 'store'])->name('ads.store');
            Route::get('/edit/{id}', [AdsController::class, 'edit'])->name('ads.edit');
            Route::post('/update', [AdsController::class, 'update'])->name('ads.update');
            Route::get('/delete/{id}', [AdsController::class, 'delete'])->name('ads.delete');
        });

        //vendors route
        Route::group(['prefix' => 'vendors'], function () {
            Route::get('/', [vendorcontroller::class, 'index'])->name('vendors.index');
            Route::post('/store', [vendorcontroller::class, 'store'])->name('vendors.store');
            Route::get('/edit/{id}', [vendorcontroller::class, 'edit'])->name('vendors.edit');
            Route::post('/update', [vendorcontroller::class, 'update'])->name('vendors.update');
            Route::get('/delete/{id}', [vendorcontroller::class, 'delete'])->name('vendors.delete');
        });

        //cities route
        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', [CityController::class, 'index'])->name('cities.index');
            Route::post('/store', [CityController::class, 'store'])->name('cities.store');
            Route::get('/edit/{id}', [CityController::class, 'edit'])->name('cities.edit');
            Route::post('/update', [CityController::class, 'update'])->name('cities.update');
            Route::get('/delete/{id}', [CityController::class, 'delete'])->name('cities.delete');
        });

        Route::group(['prefix' => 'admin'], function () {
            Route::get('/show-profile/{id}', [AdminController::class, 'profile'])->name('profile.show');
            Route::post('/update-profile',   [AdminController::class, 'updateProfile'])->name('profile.update');
        });

        //setting route
        Route::group(['prefix' => 'settings'], function () {
            // Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('settings.edit');
            Route::post('/update', [SettingController::class, 'update']);
        });

        //contacts route
        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', [App\Http\Controllers\dashboard\ContactController::class, 'index'])->name('contact.index');
            Route::get('/delete/{id}', [App\Http\Controllers\dashboard\ContactController::class, 'delete'])->name('contact.delete');

        });

        //orders route
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('orders.delete');
        });

        //page route
        Route::group(['prefix' => 'pages'], function () {
            Route::get('/', [PageController::class, 'index'])->name('pages.index');
            Route::post('/store', [PageController::class, 'store'])->name('pages.store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
            Route::post('/update', [PageController::class, 'update'])->name('pages.update');
            Route::get('/delete/{id}', [PageController::class, 'delete'])->name('pages.delete');
        });

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

    //login routes
    Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login-store', [LoginController::class, 'store'])->name('login.store');
});

Route::group(['namespace' => 'front'], function () {
    Route::get('/', [indexController::class, 'index'])->name('home.index');
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
        Route::get('paid', [PaidController::class, 'index'])->name('paid');
        Route::post('paid', [PaidController::class, 'index'])->name('paid');
    Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    Route::post('logout', [FrontLoginController::class, 'logout'])->name('user.logout');
    Route::get('update_cart',[CartController::class,'updateCart']);
    // Route::get('search', [indexController::class, 'search'])->name('search');
    Route::get('/category/{id}', [FrontCategory::class, 'category'])->name('product.category');
    Route::get('/sub_category/{id}', [FrontCategory::class, 'sub_category'])->name('product.sub_category');
    Route::get('/search', [indexController::class, 'search'])->name('product.search');
    Route::get('/tag/{id}', [indexController::class, 'tag'])->name('product.tag');

    Route::get('/user-profile/{id}', [indexController::class, 'profile'])->name('front-profile');
    Route::post('/user-profile/update/', [indexController::class, 'Updateprofile'])->name('user-update-profile');
    Route::get('/show-product/{id}', [indexController::class, 'showProduct'])->name('show-product');
    Route::get('/contact_us', [ContactController::class, 'contact_us']);
    /**this is to show form vendor**/
    Route::get('/work_with_us', [vendorcontroller::class, 'show_vendor']);
    Route::post('/contact-store', [ContactController::class, 'create_contact_us'])->name('contact.store');
    /** this is to show seller page **/
    Route::get('/seller_products/{id}',[vendorcontroller::class,'seller_products']);
    Route::get('/seller/{id}', [vendorcontroller::class, 'show_vendor_page']);
    
    Route::get('/seller/info/{id}',[vendorcontroller::class,'show_info_seller']);
    Route::get('/change_city',[indexController::class,'change_city']);
    Route::get('/pages/{id}',[indexController::class, 'pages'])->name('show.pages');
});

Route::middleware('auth')->group(function () {
    Route::post('/comments/{id}/create', [CommentController::class, 'commentStore'])->name('commentStore');
    Route::post('/comments/{id}', [CommentController::class, 'commentUpdate'])->name('comment.update');
});


Route::get('/show-modal-product/{id}',[indexController::class, 'showModalProduct']);

//login routes
Route::get('/user-register', [FrontLoginController::class, 'register'])->name('user.register');
Route::post('/front-register-store', [FrontLoginController::class, 'store'])->name('user.store');
Route::get('/user-login', [FrontLoginController::class, 'showLogin'])->name('show.login');
Route::post('/front-login', [FrontLoginController::class, 'login'])->name('user.login');
Route::post('login-store', [FrontLoginController::class, 'store'])->name('user-login.store');

//payment routes

Route::get('payment',[PaymentController::class, 'index']);
Route::post('payment/requet', [PaymentController::class, 'payment'])->name('payment-request');

Route::get('forget-password', [ForgotPasswordController::class, 'getEmail']);
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail']);

Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword']);

