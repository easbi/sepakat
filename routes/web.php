<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksirapatController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TransaksirapatController::class, 'index']);
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::get('rapat/arsip', [TransaksirapatController::class, 'arsip'])->name('rapat.arsip');
Route::get('rapat/dashboard', [TransaksirapatController::class, 'dashboard'])->name('rapat.dashboard');
Route::get('rapat/chart',[TransaksirapatController::class, 'chart'])->name('rapat.chart');
Route::resource('rapat', TransaksirapatController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
