<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeKhaiController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ExcelController;

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
    return redirect('/kekhai');
});

Route::resource('kekhai', KeKhaiController::class);
Route::delete('/reset', [KeKhaiController::class, 'reset'])->name('reset');

Route::get('/mst-request', [ProxyController::class, 'proxyRequest'])->name('proxy.request');
Route::get('/export', [ExcelController::class, 'export'])->name('export');
Route::post('/upload', [ExcelController::class, 'upload'])->name('upload');