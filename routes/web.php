<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use \App\Http\Controllers\Admin\Users\RegisterController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\BillController;
use \App\Http\Controllers\Admin\ReceiptController;
use \App\Http\Controllers\Admin\SpecialityController;

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

Route::get('/admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('/admin/users/login/store',[LoginController::class,'store']);
Route::get('admin/users/register/store',[RegisterController::class,'store']);
Route::get('admin/users/logout',[LoginController::class,'logout']);
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

        #Upload
        Route::post('upload',[UploadController::class,'store']);
    });

});
