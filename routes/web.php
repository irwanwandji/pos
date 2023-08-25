<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\App;

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

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/test', function(){
    return view('test', [
        'pesan' => 'Selamat datang di Kemenkes',
        'greeting' => 'Ini dibuat dengan Laravel',
    ]);
});

Route::get('/baru', function () {
    return view('baru', [
        'nama' => 'Bayu',
        'alamat' => 'Depok',
    ]);
});

Route::redirect('/', 'admin');

Route::middleware('auth')->group(function () {
    route::get('/admin', [DashboardController::class, 'index']);

    Route::post('admin/product/addStock',[ProductController::class, 'addStock'])->name('addStock');
    Route::get('admin/product/modalStock/{id}',[ProductController::class, 'modalStock'])->name('modalStock');
    route::resource('admin/product', ProductController::class);

    route::get('admin/trx/create', [TransactionController::class, 'create']);
    route::post('admin/trx/import', [TransactionController::class, 'import']);
    route::get('admin/trx/export', [TransactionController::class, 'export']);
    route::get('admin/trx', [TransactionController::class, 'index']);

    route::resource('admin/promotion', PromotionController::class);

    route::middleware('can:isAdmin')->group(function () {
        route::get('/admin/category/create', [CategoryController::class, 'create']);
        route::post('/admin/category/store', [CategoryController::class, 'store']);
        route::get('admin/category', [CategoryController::class, 'index']);
        route::get('/admin/category/{id}', [CategoryController::class, 'show']);
        route::get('admin/category/{id}/edit', [CategoryController::class, 'edit']);
        route::put('admin/category/{id}', [CategoryController::class,'update']);
        route::delete('admin/category/{id}', [CategoryController::class,'destroy']);

    });

    route::get('/lang/{locale}', function ($locale)
    {
        session()->put('lang', $locale);
        return redirect()->back();
    })->name('change-language');

});






Auth::routes(['verify' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
