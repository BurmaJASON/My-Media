<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
;

//user login
Route::post('user/login',[AuthController::class,'login']);
//user register
Route::post('user/register',[AuthController::class,'register']);


// Route::get('category',function() {
//     return response()->json('This is category');
// })->middleware('auth:sanctum');
Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

Route::get('post',[PostController::class,'getAllPost']);

