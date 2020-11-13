<?php
use App\Http\Controllers\PageController;

use Illuminate\Support\Facades\Route;

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
});

Route::get('/index', [PageController::class, 'getIndex']);

Route::get('/loai-san-pham/{id_type}', [PageController::class, 'getLoaiSanPham']);

Route::get('/chi-tiet-san-pham/{id}', [PageController::class, 'getChiTietSanPham']);

Route::get('/lien_he', [PageController::class, 'getLienHe']);

Route::get('/gioi_thieu', [PageController::class, 'getGioiThieu']);

Route::get('/them-SP-vao-gio-hang/{id}', [PageController::class, 'ThemSanPhamVaoGioHang']);

Route::get('/xoa-SP-trong-gio-hang/{id}', [PageController::class, 'XoaSanPhamVaoGioHang']);

Route::get('/xoa-nhieu_SP-trong-gio-hang/{id}', [PageController::class, 'XoaNhieuSanPhamVaoGioHang']);

Route::get('/dat_hang', [PageController::class, 'DatHang']);

Route::post('/thanh_toan_dat_hang', [PageController::class, 'thanh_toan_dat_hang']);

Route::get('/dang_nhap', [PageController::class, 'dangnhap']);

Route::get('/dang_ki', [PageController::class, 'dangki']);

Route::post('/submitdangki', [PageController::class, 'Submitdangki']);

Route::post('/submitdangnhap', [PageController::class, 'Submitdangnhap']);

Route::get('/dang_xuat', [PageController::class, 'dangxuat']);

Route::get('/seach', [PageController::class, 'seach']);

// Route::get('index',[
//     'as'=>'trang chu',
//     'uses'=> 'PageController@getIndex'
// ]);
