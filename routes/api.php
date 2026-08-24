<?php

use App\Http\API\APIController;
use App\Http\API\DesktopSyncController;
use App\Http\Controllers\Auth\DesktopAuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RestaurantOpsController;
use App\Http\Controllers\SiparisController;
use Illuminate\Support\Facades\Route;

// --- Müşteri (QR Menü) tarafı - herkese açık ---
Route::post('/garson-cagir', [RestaurantOpsController::class, 'garsonCagir']);

// --- Admin Panel - Masa / Kasa / Garson yönetimi ---
Route::prefix('admin')->group(function () {
    Route::get('/masalar', [RestaurantOpsController::class, 'masalariListele']);
    Route::post('/masalar', [RestaurantOpsController::class, 'masaEkle']);
    Route::post('/masalar/{id}/durum', [RestaurantOpsController::class, 'masaDurumDegistir']);
    Route::delete('/masalar/{id}', [RestaurantOpsController::class, 'masaSil']);
    Route::get('/garson-cagrilari', [RestaurantOpsController::class, 'garsonCagrilariGetir']);
    Route::post('/gun-sonu', [RestaurantOpsController::class, 'gunSonuAl']);
});

// --- Eski v1 rotaları (Desktop Bridge dışı, dokunulmadı) ---
Route::prefix('v1')->group(function () {
    Route::post('upsert/{tablename}/{sifre}', [APIController::class, 'Insert']);
    Route::post('product/all', [APIController::class, 'GetAllProducts']);
    Route::post('getlocalelang', [APIController::class, 'GetLocaleLang']);
    Route::post('product/subcategory/{id}', [APIController::class, 'GetSubCategories']);
    Route::post('product/category/{id}', [APIController::class, 'GetProductCategories']);
    Route::post('save/image/{sifre}', [APIController::class, 'SaveImageFileToServer']);
    Route::post('translate/add/{sifre}', [APIController::class, 'AddTranslateToLanguageFile']);
    Route::post('getforms', [MainController::class, 'GetAllForms']);
    Route::post('call/waiter/{qrcode}', [APIController::class, 'AddWaiterCallToTable']);

    Route::prefix('desktop')->group(function () {
        Route::post('/login', [DesktopAuthController::class, 'login']);

        Route::middleware('desktop.auth')->group(function () {
            Route::post('/logout', [DesktopAuthController::class, 'logout']);
            Route::post('/sync/tables', [DesktopSyncController::class, 'syncTables']);
            Route::post('/sync/menu', [DesktopSyncController::class, 'syncMenuPush']);
            Route::get('/sync/menu', [DesktopSyncController::class, 'syncMenuPull']);
            Route::post('/sync/kasa', [DesktopSyncController::class, 'syncKasa']);
            Route::get('/sync/web-orders', [DesktopSyncController::class, 'pullWebOrders']);
            Route::get('/sync/waiter-calls', [DesktopSyncController::class, 'pullWaiterCalls']);
            Route::get('/sync/product/{id}', [DesktopSyncController::class, 'pullSingleProduct']);
            Route::get('/status', [DesktopSyncController::class, 'status']);
        });
    });
});