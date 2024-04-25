<?php

use App\Http\Controllers\{PermissionController,RoleController,UserController};

use App\Http\Controllers\FeatureController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['middleware'=>['role:super-admin|admin']],function()
Route::group(['middleware'=>['isAdmin']],function(){
    //Permissions
    Route::resource('permissions',PermissionController::class);
    Route::get('permissions/{id}/delete',[PermissionController::class,'destroy']);

    //Roles
    Route::resource('roles',RoleController::class);
    Route::get('roles/{id}/delete',[RoleController::class,'destroy']);

    //Add or Edit Role Permission
    Route::get('roles/{roleId}/give-permissions',[RoleController::class,'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions',[RoleController::class,'givePermissionToRole']);

    //Features
    Route::resource('features',FeatureController::class);
    Route::get('features/{featureId}/delete',[FeatureController::class,'destroy']);
});

Route::group(['middleware'=>'auth'],function(){
    //Users
    Route::resource('users',UserController::class);
    Route::get('users/{userId}/delete',[UserController::class,'destroy']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
