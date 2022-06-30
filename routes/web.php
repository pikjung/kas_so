<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\toko\tokoOrderController;
use App\Http\Controllers\toko\tokoTroliController;
use App\Http\Controllers\admin\adminAreaController;
use App\Http\Controllers\admin\adminTokoController;

use App\Http\Controllers\admin\adminBrandController;
use App\Http\Controllers\admin\adminPaketController;
use App\Http\Controllers\admin\adminSkemaController;
use App\Http\Controllers\admin\adminRegionController;
use App\Http\Controllers\admin\adminProductController;
use App\Http\Controllers\admin\adminProjectController;
use App\Http\Controllers\toko\tokoDashboardController;
use App\Http\Controllers\admin\adminFastMoveController;
use App\Http\Controllers\admin\adminDashboardController;
use App\Http\Controllers\toko\tokoRiwayatOrderController;
use App\Http\Controllers\admin\adminFastMoveDetailController;
use App\Http\Controllers\admin_ss\adminOrderController;
use App\Http\Controllers\admin_ss\adminRiwayatOrderController;

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




Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login/action', [LoginController::class, 'actionlogin']);
Route::get('/logout', [LoginController::class, 'actionlogout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [tokoDashboardController::class, 'index']);
    Route::get('/dashboard', [tokoDashboardController::class, 'index']);
    Route::get('/dashboard/detailOrder/{id}', [tokoDashboardController::class, 'detailOrder']);

    //order toko
    Route::get('/order', [tokoOrderController::class, 'index']);
    Route::get('/order/{id}/{param}', [tokoOrderController::class, 'brand']);
    Route::get('/order/favorit/detail/{id}', [tokoOrderController::class, 'favoritDetail']);
    Route::get('/order/favorit/pilihFastMove/{id}', [tokoOrderController::class, 'pilihFastMove']);
    Route::post('/order/troli/lainnya', [tokoOrderController::class, 'troliLainnya']);
    Route::post('/order/troli/favorit', [tokoOrderController::class, 'troliFavorit']);
    Route::post('/order/troli/paket', [tokoOrderController::class, 'troliPaket']);

    Route::get('/troli', [tokoTroliController::class, 'index']);
    Route::get('/troli/checkout/{id}', [tokoTroliController::class, 'checkout']);
    Route::get('/troli/hapus/{id}', [tokoTroliController::class, 'hapus']);

    //riwayat order
    Route::get('/riwayat_order', [tokoRiwayatOrderController::class, 'index']);

    //Profile
    Route::get('/profile', [tokoOrderController::class, 'profile']);
    Route::get('/setting', [tokoOrderController::class, 'setting']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin_kas', [adminDashboardController::class, 'index']);

    //product
    Route::get('/admin_kas/product', [adminProductController::class, 'index']);
    Route::get('/admin_kas/product/{id}', [adminProductController::class, 'show']);
    Route::post('/admin_kas/product/tambah', [adminProductController::class, 'tambah']);
    Route::post('/admin_kas/product/edit/{id}', [adminProductController::class, 'update']);
    Route::get('/admin_kas/product/status/{id}', [adminProductController::class, 'status']);
    Route::get('/admin_kas/product/hapus/{id}', [adminProductController::class, 'hapus']);
    Route::get('/admin_kas/product/import', [adminProductController::class, 'import']);

    //product name familiar
    // Route::get('/admin_kas')

    //brand
    Route::get('/admin_kas/brand', [adminBrandController::class, 'index']);
    Route::post('/admin_kas/brand/tambah', [adminBrandController::class, 'create']);
    Route::get('/admin_kas/brand/{id}', [adminBrandController::class, 'show']);
    Route::post('/admin_kas/brand/edit/{id}', [adminBrandController::class, 'update']);
    Route::get('/admin_kas/brand/hapus/{id}', [adminBrandController::class, 'hapus']);

    //area
    Route::get('/admin_kas/area', [adminAreaController::class, 'index']);
    Route::get('/admin_kas/area/{id}', [adminAreaController::class, 'show']);
    Route::post('/admin_kas/area/tambah', [adminAreaController::class, 'tambah']);
    Route::post('/admin_kas/area/edit/{id}', [adminAreaController::class, 'update']);
    Route::get('/admin_kas/area/hapus/{id}', [adminAreaController::class, 'hapus']);

    //project
    Route::get('/admin_kas/project', [adminProjectController::class, 'index']);
    Route::get('/admin_kas/project/{id}', [adminProjectController::class, 'show']);
    Route::post('/admin_kas/project/tambah', [adminProjectController::class, 'tambah']);
    Route::post('/admin_kas/project/edit/{id}', [adminProjectController::class, 'update']);
    Route::get('/admin_kas/project/hapus/{id}', [adminProjectController::class, 'hapus']);

    //toko
    Route::get('/admin_kas/toko', [adminTokoController::class, 'index']);
    Route::get('/admin_kas/toko/{id}', [adminTokoController::class, 'show']);
    Route::post('/admin_kas/toko/tambah', [adminTokoController::class, 'tambah']);
    Route::post('/admin_kas/toko/edit/{id}', [adminTokoController::class, 'update']);
    Route::get('/admin_kas/toko/hapus/{id}',[adminTokoController::class, 'hapus']);
    Route::get('/admin_kas/toko/detail/{id}',[adminTokoController::class, 'detail']);
    
    //toko_detail
    Route::get('/admin_kas/toko_detail/{id}', [adminTokoController::class, 'detailIndex']);
    Route::get('/admin_kas/toko_detail/show/{id}', [adminTokoController::class, 'detailShow']);
    Route::post('/admin_kas/toko_detail/tambah', [adminTokoController::class, 'detailTambah']);
    Route::post('/admin_kas/toko_detail/edit/{id}', [adminTokoController::class, 'detailUpdate']);
    Route::get('/admin_kas/toko_detail/hapus/{id}',[adminTokoController::class, 'detailHapus']);

    //region
    Route::get('/admin_kas/region', [adminRegionController::class, 'index']);
    Route::get('/admin_kas/region/{id}', [adminRegionController::class, 'show']);
    Route::post('/admin_kas/region/tambah', [adminRegionController::class, 'tambah']);
    Route::post('/admin_kas/region/edit/{id}', [adminRegionController::class, 'update']);
    Route::get('/admin_kas/region/hapus/{id}', [adminRegionController::class, 'hapus']);
    
    //Fast Move
    Route::get('/admin_kas/fast_move', [adminFastMoveController::class, 'index']);
    Route::get('/admin_kas/fast_move/{id}', [adminFastMoveController::class, 'show']);
    // Route::get('/admin_kas/fast_move/preview/{id}', [adminFastMoveController::class, 'preview']);
    Route::post('/admin_kas/fast_move/tambah', [adminFastMoveController::class, 'tambah']);
    Route::post('/admin_kas/fast_move/edit/{id}', [adminFastMoveController::class, 'update']);
    Route::get('/admin_kas/fast_move/hapus/{id}', [adminFastMoveController::class, 'hapus']);
    Route::get('/admin_kas/fast_move/status/{id}', [adminFastMoveController::class, 'changeStatus']);
    Route::get('/admin_kas/fast_move/detail/{id}', [adminFastMoveController::class, 'detail']);

    //Fast Move Detail
    Route::get('/admin_kas/fast_move_detail/{id}', [adminFastMoveDetailController::class, 'index']);
    Route::get('/admin_kas/fast_move_detail/show/{id}', [adminFastMoveDetailController::class, 'show']);
    Route::post('/admin_kas/fast_move_detail/tambah', [adminFastMoveDetailController::class, 'tambah']);
    Route::post('/admin_kas/fast_move_detail/edit/{id}', [adminFastMoveDetailController::class, 'update']);
    Route::get('/admin_kas/fast_move_detail/hapus/{id}', [adminFastMoveDetailController::class, 'hapus']);
    Route::get('/admin_kas/fast_move_detail/skema/{id}', [adminFastMoveDetailController::class, 'skema']);

    //Skema
    Route::get('/admin_kas/skema/{id}', [adminSkemaController::class, 'index']);
    Route::get('/admin_kas/skema/show/{id}', [adminSkemaController::class, 'show']);
    Route::post('/admin_kas/skema/tambah', [adminSkemaController::class, 'tambah']);
    Route::post('/admin_kas/skema/edit/{id}', [adminSkemaController::class, 'update']);
    Route::get('/admin_kas/skema/hapus/{id}', [adminSkemaController::class, 'hapus']);
    Route::get('/admin_kas/skema_detail/hapus/{id}', [adminSkemaController::class, 'hapusDetail']);
    Route::post('/admin_kas/skema_detail/tambah/{id}', [adminSkemaController::class, 'tambahDetail']);

    //Paket
    Route::get('/admin_kas/paket', [adminPaketController::class, 'index']);
    Route::get('/admin_kas/paket/{id}', [adminPaketController::class, 'show']);
    Route::post('/admin_kas/paket/tambah', [adminPaketController::class, 'tambah']);
    Route::post('/admin_kas/paket/edit/{id}', [adminPaketController::class, 'update']);
    Route::get('/admin_kas/paket/hapus/{id}', [adminPaketController::class, 'hapus']);
    Route::get('/admin_kas/paket/status/{id}', [adminPaketController::class, 'changeStatus']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('/admin_ss', [adminOrderController::class, 'index']);

    //Order
    Route::get('/admin_ss/order', [adminOrderController::class, 'index']);
    Route::get('/admin_ss/order/{id}', [adminOrderController::class, 'show']);
    Route::get('/admin_ss/order/check/{id}', [adminOrderController::class, 'check']);
    Route::get('/admin_ss/order/confirm/{id}', [adminOrderController::class, 'confirm']);
    Route::post('/admin_ss/order/remark', [adminOrderController::class, 'remark']);

    //Riwayat Order
    Route::get('/admin_ss/riwayat_order', [adminRiwayatOrderController::class, 'index']);
    Route::get('/admin_ss/riwayat_order/{id}', [adminRiwayatOrderController::class, 'show']);

});