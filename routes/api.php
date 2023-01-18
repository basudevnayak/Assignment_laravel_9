<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\imageUploadController;
use App\Http\Controllers\API\productsController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function () {
    Route::get('/', function () {return view('welcome');});
    Route::post("/login",[AuthController::class,'login']);
    Route::post("/register",[AuthController::class,'register']);
    
});

Route::post("/imageUpload",[imageUploadController::class,'imageUpload']);
Route::get("/showProduct",[productsController::class,'index']);
Route::post("/productAdd",[productsController::class,'productAdd']);
Route::post("/productUpdate",[productsController::class,'productUpdate']);


