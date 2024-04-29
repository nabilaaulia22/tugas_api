<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownController;
use App\Http\Controllers\Ip_unitController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PRTGController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UpController;

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
    return view('monitoringlog.login');
});


Route::get('/login', [LoginController::class, 'view_login'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/unitdata', [UnitController::class, 'view_unitdata'])->name('unitdata');

    Route::get('/add', [UnitController::class, 'add'])->name('add'); // nampilin form

    Route::post('/insertdata', [UnitController::class, 'insertdata'])->name('insertdata');

    Route::get('/delete/{id}', [UnitController::class, 'delete'])->name('delete'); // masukin data ke dlm database

    Route::get('/tampilkandata/{id}', [UnitController::class, 'tampilkandata'])->name('tampilkandata');

    Route::post('/updatedata/{id}', [UnitController::class, 'updatedata'])->name('updatedata');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan');

    Route::get('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');

    Route::get('/ip_unit', [Ip_unitController::class, 'ip_unit'])->name(('ip_unit'));

    Route::get('/down', [DownController::class, 'index'])->name('down');
    Route::get('/up-data/{id}', [DownController::class, 'index'])->name('upData');

    Route::get('/up', [UpController::class, 'index'])->name('up');

    Route::get('laporan/export/excel', [LaporanController::class, 'export_excel'])->name('laporan.export.excel');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    Route::post('/update_profile', [ProfileController::class, 'update_profile'])->name('update_profile');

    Route::post('/update_password', [ProfileController::class, 'update_password'])->name('update_password');

    Route::get('/down/current', [DashboardController::class, 'down_current'])->name('down_current');

    Route::get('/down/update-data', [DownController::class, 'updateData'])->name('down.updateData');

});


Route::post('/prtg/update-status', [PRTGController::class, 'updateStatus']);
Route::post('/prtg_proccess', [PRTGController::class, 'index'])->name('prtg.proccess');


