<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['prefix' => 'api/v1', 'middleware' => 'api'], function () {
// //    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
//   //  Route::post('authenticate', 'AuthenticateController@authenticate');
//     Route::resource('users', 'App\Http\Controllers\Api\UserController');
// });

// index  : get nhiều data mà không có gì cả mà có số trang(page=2) , sấp xếp(column=id và sort=desc) , số lượng (limit=3)
// update : update có id và data : sữa data khi có id đó , nếu id k đúng thì thêm vào cơ sơ dữ liệu
// show   : get có id : chi tiết của nó có id đó
// store  : put có data : thêm data
// destroy: delete có id : xóa theo id
// except
Route::prefix('v1')->group(function () {
    Route::resource('slide', 'App\Http\Controllers\Api\SlideController')->only(['index']);
    Route::resource('product', 'App\Http\Controllers\Api\ProductsController')->only(['index','update', 'show', 'store', 'destroy']);
    Route::resource('type_products', 'App\Http\Controllers\Api\Type_ProductsController')->only(['index', 'store', 'update','destroy','show']);
    
});

// Route::group([
//     'namespace' => 'App\Http\Controllers', 'prefix' => 'v1',
//     'as' => 'Api.', 'middleware' => ['auth:sanctum', 'verified']
// ], function () {
//     Route::resource('/typeproducts', 'Type_ProductsController')->only([
//         'index'
//     ]);
// });