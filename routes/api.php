<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolePermissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('role_permissions/{id}', [RolePermissionController::class,'show']);
Route::get('change_lang/{lang}',[HomeController::class,'changeLang'])->name('get.change-lang');
