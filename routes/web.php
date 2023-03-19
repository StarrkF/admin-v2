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
    Route::get('change-lang',[HomeController::class,'changeLang'])->name('get.change-lang');

    Route::get('user',[UserController::class,'index'])->name('get.users')->middleware('can:show-user');
    Route::post('user',[UserController::class,'register'])->name('post.register')->middleware('can:create-user');
    Route::post('user/update',[UserController::class,'update'])->name('update.user')->middleware('can:update-user');
    Route::get('user/delete/{id}',[UserController::class,'delete'])->name('delete.user')->middleware('can:delete-user');

    Route::get('roles_permissions',[RolePermissionController::class,'index'])->name('get.roles-permissions')->middleware('can:show-role');
    Route::post('roles_permissions',[RolePermissionController::class,'store'])->name('post.role.create')->middleware('can:create-role');
    Route::post('permission/update',[RolePermissionController::class,'updatePermissions'])->name('post.role-permission-update');
    Route::get('permission/delete/{id}',[RolePermissionController::class,'destroy'])->name('delete.role')->middleware('can:delete-role');

});
