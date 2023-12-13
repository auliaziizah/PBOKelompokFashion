<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'dashboard/admin', 'middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile', 'middleware' => 'admin'], function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::post('update', [HomeController::class, 'updateprofile'])->name('profile.update');
    });

    Route::middleware(['admin'])->group(function () {
        Route::controller(AkunController::class)
            ->prefix('akun')
            ->as('akun.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('showdata', 'dataTable')->name('dataTable');
                Route::match(['get','post'],'tambah', 'tambahAkun')->name('add');
                Route::match(['get','post'],'{id}/ubah', 'ubahAkun')->name('edit');
                Route::delete('{id}/hapus', 'hapusAkun')->name('delete');
        });

        Route::controller(BarangController::class)
            ->prefix('barang')
            ->as('barang.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/lihatbarang', [BarangController::class, 'index'])->name('lihatbarang');
                Route::post('/insertdata', [BarangController::class, 'insertdata'])->name('insertdata');
                Route::get('/tambahdatabarang', [BarangController::class, 'tambahdatabarang'])->name('tambahdatabarang');
                Route::get('/updatedata/{id}', [BarangController::class, 'updatedata'])->name('updatedata');
                Route::post('/editdata/{id}', [BarangController::class, 'editdata'])->name('editdata');
                Route::get('/hapusdata/{id}', [BarangController::class, 'hapusdata'])->name('hapusdata');
                Route::get('/export', [BarangController::class, 'export'])->name('export');
        });
    });

    Route::controller(TransaksiController::class)
        ->prefix('transaksi')
        ->as('transaksi.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/read', [TransaksiController::class, 'index'])->name('lihatbarang');
            Route::post('/store', [TransaksiController::class, 'store'])->name('store');
            Route::get('/create', [TransaksiController::class, 'create'])->name('create');
            Route::delete('/delete/{id}', [TransaksiController::class, 'delete'])->name('delete');
            Route::get('/list', [TransaksiController::class,'list'])->name('list');
            Route::get('/download', [TransaksiController::class,'download'])->name('download');
    });
});