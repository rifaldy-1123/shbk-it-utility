<?php

use App\Models\ElementDetail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElementDetailController;
use App\Http\Controllers\UpdateSEPController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\ReceiveOrderController;
use App\Http\Controllers\PurchasingOrderController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

// Update ElementDetail GetDokter
Route::get('/elementdetail', [ElementDetailController::class, 'index']);
Route::post('/elementdetail/update/{id}', [ElementDetailController::class, 'update'])->name('elementdetail.update');

// Update SEP
Route::get('/updatesep', [UpdateSEPController::class, 'index'])->name('updatesep');
Route::put('/updatesep-data', [UpdateSEPController::class, 'update'])->name('updatesep.update');

//Mutasi
Route::get('/mutasilogistik', [MutasiController::class, 'index'])->name('mutasilogistik');
Route::patch('/mutasi-show', [MutasiController::class, 'mutasiShow'])->name('mutasi.show');
Route::patch('/mutasiD-show', [MutasiController::class, 'mutasiDShow'])->name('mutasiD.show');

//Receive Order
Route::get('/rologistik', [ReceiveOrderController::class, 'index'])->name('rologistik');
Route::patch('/ro-show', [ReceiveOrderController::class, 'roShow'])->name('ro.show');

//Purchasing Order
Route::get('/purchasinglogistik', [PurchasingOrderController::class, 'index'])->name('purchasinglogistik');
Route::get('/purchasingdetail', [PurchasingOrderController::class, 'indexDetail'])->name('purchasingdetail');
Route::put('/purchasinglogistik-updateHeader', [PurchasingOrderController::class, 'updateHeader'])->name('purchasinglogistik.updateHeader');
Route::put('/purchasinglogistik-updateDetail', [PurchasingOrderController::class, 'updateDetail'])->name('purchasinglogistik.updateDetail');

