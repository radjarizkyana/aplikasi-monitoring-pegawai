<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BobotKerjaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\AdminController;



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
        return redirect('/login');
    });

    // Auth routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes Auth User
    Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [PekerjaanController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/pdf', [DashboardController::class, 'pdf'])->name('dashboard.pdf');
    Route::get('/dashboard/print', [DashboardController::class, 'print'])->name('dashboard.print');
    
    Route::resource('users', UserController::class);
    Route::resource('pekerjaans', PekerjaanController::class);
    Route::get('pekerjaan/create', [PekerjaanController::class, 'create'])->name('pekerjaan.create');
    Route::post('pekerjaan', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('pekerjaans/{id}/complete', [PekerjaanController::class, 'complete'])->name('pekerjaans.complete');
    Route::post('pekerjaans/{id}/complete', [PekerjaanController::class, 'completeStore'])->name('pekerjaans.completeStore');   
    Route::resource('kategoris', KategoriController::class);
    Route::resource('bobotkerjas', BobotKerjaController::class);
    Route::resource('jabatans', JabatanController::class);
    
});

    // Routes Auth Admin 
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
        Route::resource('jabatans', JabatanController::class)->only(['index', 'create', 'store']);
        Route::resource('kategoris', KategoriController::class)->only(['index', 'create', 'store']);
        Route::resource('bobotkerjas', BobotKerjaController::class)->only(['index', 'create', 'store']);
    });
    
