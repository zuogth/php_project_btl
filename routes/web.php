<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Login\RegisterController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\BillController;
use \App\Http\Controllers\Admin\ReceiptController;
use \App\Http\Controllers\Admin\SpecialityController;
use \App\Http\Controllers\GoogleController;
use \App\Http\Controllers\Users\ProductListController;
use \App\Http\Controllers\Users\HomePageController;
use \App\Http\Controllers\Users\ProductDetailController;
use \App\Http\Controllers\Users\SearchController;
use  \App\Http\Controllers\Users\CartController;
use \App\Http\Controllers\Users\BillClientController;
use \App\Http\Controllers\Users\UserClientController;

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

Route::get('/admin/user/login',[LoginController::class,'index'])->name('login');
Route::post('/user/login',[LoginController::class,'store']);
Route::get('/user/login',[LoginController::class,'login']);
Route::get('/user/logout',[LoginController::class,'logout']);
Route::get('/user/register',[RegisterController::class,'register']);
Route::post('/user/register',[RegisterController::class,'store']);
// Google URL
Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
Route::middleware(['auth','role'])->group(function () {
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);

        #Users
        Route::prefix('user')->group(function(){
            Route::get('list',[UserController::class,'index']);
            Route::get('edit/{user}',[UserController::class,'show']);
            Route::post('edit/{user}',[UserController::class,'edit']);
        });
        #Category
        Route::prefix('category')->group(function(){
            Route::get('add',[CategoryController::class,'create']);
            Route::post('add',[CategoryController::class,'store']);
            Route::get('list',[CategoryController::class,'list']);
            Route::get('edit/{category}',[CategoryController::class,'show']);
            Route::post('edit/{category}',[CategoryController::class,'edit']);
            Route::delete('delete',[CategoryController::class,'delete']);
        });

        #Product
        Route::prefix('product')->group(function(){
            Route::get('add/{code}', [ProductController::class,'create']);
            Route::post('add/{code}', [ProductController::class,'store']);
            Route::get('list/{code}', [ProductController::class,'index']);
            Route::get('edit/{code}/{product}', [ProductController::class,'show']);
            Route::post('edit/{code}/{product}', [ProductController::class,'edit']);
            Route::delete('delete', [ProductController::class,'destroy']);
            Route::get('order', [ProductController::class,'order']);
        });

        #Bill
        Route::prefix('bill')->group(function(){
            Route::get('list',[BillController::class,'index']);
            Route::get('edit/{bill}',[BillController::class,'show']);
            Route::post('edit/{bill}',[BillController::class,'edit']);
        });

        #Receipt
        Route::prefix('receipt')->group(function(){
            Route::get('list',[ReceiptController::class,'index']);
            Route::get('edit/{receipt}',[ReceiptController::class,'show']);
            Route::post('edit/{receipt}',[ReceiptController::class,'edit']);
            Route::get('add',[ReceiptController::class,'create']);
            Route::post('add',[ReceiptController::class,'store']);
            Route::get('product/list',[ReceiptController::class,'list']);
            Route::get('product/selected',[ReceiptController::class,'productSelected']);
        });

        #Speciality
        Route::prefix('speciality')->group(function(){
            Route::get('list',[SpecialityController::class,'index']);
            Route::get('edit/{speciality}',[SpecialityController::class,'show']);
            Route::post('edit/{speciality}',[SpecialityController::class,'edit']);
            Route::get('add',[SpecialityController::class,'create']);
            Route::post('add',[SpecialityController::class,'store']);
            Route::delete('delete',[SpecialityController::class,'destroy']);
        });

        #Comment
        Route::prefix('comment')->group(function(){
            Route::get('list',[\App\Http\Controllers\Admin\CommentController::class,'index']);
        });

        #Upload
        Route::post('upload',[UploadController::class,'store']);
    });

});

//route client
Route::prefix('/')->group(function(){
//    Home product
    Route::get('',[HomePageController::class,'index'])->name("home");
    Route::get('/new',[HomePageController::class,'new']);
    Route::get('/product-search',[HomePageController::class,'searchDetail']);


//    search page

    Route::get('/search/',[SearchController::class,'index']);

    Route::get('/search-all-page',[SearchController::class,'show']);

    Route::get('/search-total-page',[SearchController::class,'total']);

    Route::get('/search-all-page-two',[SearchController::class,'showTwo']);

//    list product
    Route::get('/product/{cate}/{type?}',[ProductListController::class,'index']);

//    phân trang
    Route::get('/page',[ProductListController::class,'pagination']);


    Route::get('/product/brand/{cates}/{brand?}',[ProductListController::class,'brand']);

//    filter
    Route::get('/product',[ProductListController::class,'search']);
    Route::get('/total',[ProductListController::class,'total']);

    # sắp xếp
    Route::get('/sort',[ProductListController::class,'sort']);


    #product detal
    Route::get('/product-detail/{slug}/',[ProductDetailController::class,'index']);
    Route::get('/product-comment',[ProductDetailController::class,'comment']);


    #cart
    Route::get('/cart',[CartController::class,'index']);
    Route::put('/cart',[CartController::class,'update']);
    Route::get('/cart/{product}',[CartController::class,'addCart']);
    Route::DELETE('/cart/delete/{product}',[CartController::class,'delete']);
    Route::DELETE('/cart/delete',[CartController::class,'deleteBill']);

    #Bill
    Route::get('/bill/{bill}',[BillClientController::class,'index']);
    Route::post('/bill/{bill}',[BillClientController::class,'store']);

    #User
    Route::get('/user/detail/{active}',[UserClientController::class,'index']);
    Route::post('/user/detail/check',[UserClientController::class,'check']);
    Route::get('/user/detail',[UserClientController::class,'detail']);
    Route::PUT('/user/detail',[UserClientController::class,'update']);
    Route::post('/user/detail',[UserClientController::class,'password']);
    Route::post('/user/comment',[UserClientController::class,'comment']);
});
