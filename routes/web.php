<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LightHouseController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShipController;

Route::get('/', function () {
    if (app_config('app_home') == 'Landing Page') {
        return view('welcome');
    } else {
        return redirect()->route('home');
    }
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    //dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //users
    Route::get('/get-profile', [UserController::class, 'get_profile'])->name('profile.index');
    Route::post('/update-profile', [UserController::class, 'update_profile'])->name('profile.update');
    Route::post('/deactivate-profile', [UserController::class, 'deactivate_profile'])->name('profile.deactivate');
    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::post('/users/{user}/update-status', [UserController::class, 'update_status'])->name('users.update-status');
    Route::resource('users', UserController::class);

    //config
    Route::get('/get-config', [ConfigController::class, 'index'])->name('config.index');
    Route::post('/config/store', [ConfigController::class, 'store'])->name('config.store');
    Route::post('/config/reset', [ConfigController::class, 'reset'])->name('config.reset');

    //roles
    Route::get('/roles/cards', [RoleController::class, 'card'])->name('roles.card');
    Route::post('/roles/{role}/update-status', [RoleController::class, 'update_status'])->name('roles.update-status');
    Route::resource('roles', RoleController::class);


    // dummy masters
    //ships
    Route::get('/ships/list', [ShipController::class, 'list'])->name('ships.list');
    Route::post('/ships/{ship}/update-status', [ShipController::class, 'update_status'])->name('ships.update-status');
    Route::resource('ships', ShipController::class);

    //branches
    Route::get('/branches/list', [BranchController::class, 'list'])->name('branches.list');
    Route::post('/branches/{ship}/update-status', [BranchController::class, 'update_status'])->name('branches.update-status');
    Route::resource('branches', BranchController::class);

    //light houses
    Route::get('/light-houses/list', [LightHouseController::class, 'list'])->name('light-houses.list');
    Route::post('/light-houses/{light_house}/update-status', [LightHouseController::class, 'update_status'])->name('light-houses.update-status');
    Route::resource('light-houses', LightHouseController::class);

    // perusahaan
    Route::get('/perusahaan/list', [PerusahaanController::class, 'list'])->name('perusahaan.list');
    Route::post('/perusahaan/{perusahaan}/update-status', [PerusahaanController::class, 'update_status'])->name('perusahaan.update-status');
    Route::get('/perusahaan/detail-perusahaan', [PerusahaanController::class, 'detail_perusahaan']);
    Route::get('/perusahaan/detail-departemen', [PerusahaanController::class, 'detail_departemen']);
    Route::resource('perusahaan', PerusahaanController::class)->except(['show']);
});
