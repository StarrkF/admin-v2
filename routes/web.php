<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login',[UserController::class,'indexLogin'])->name('get.login');
Route::post('login',[UserController::class,'login'])->name('post.login');
Route::get('logout',[UserController::class,'logout'])->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

    Route::get('',[HomeController::class,'index'])->name('get.admin.dashboard');

    Route::get('user',[UserController::class,'index'])->name('get.users')->middleware('can:show-user');
    Route::post('user',[UserController::class,'register'])->name('post.register');

    Route::get('roles_permissions',[RolePermissionController::class,'index'])->name('get.roles-permissions')->middleware('can:show-user');
    Route::post('roles_permissions',[RolePermissionController::class,'store'])->name('post.role.create')->middleware('can:create-user');
    Route::post('permission/update',[RolePermissionController::class,'updatePermissions'])->name('post.role-permission-update');

});
