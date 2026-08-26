<?php

use App\Http\API\APIController;
use App\Http\API\DesktopSyncController;
use App\Http\Controllers\Auth\DesktopAuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RestaurantOpsController;
use App\Http\Controllers\SiparisController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// --- Müşteri (QR Menü) tarafı - herkese açık ---
Route::post('/garson-cagir', [RestaurantOpsController::class, 'garsonCagir']);

// --- 3) Gerçek Sanctum Token Üreten Admin Login Route'u ---
Route::post('/admin-login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email veya şifre hatalı'], 401);
    }

    // İsteğe bağlı olarak eski token'ları temizleyebilirsin:
    // $user->tokens()->delete();

    $token = $user->createToken('admin-panel', ['*'], now()->addDays(7))->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
});

// --- 4) Korunacak (Auth:Sanctum ile Sarpılmış) Admin Rotaları ---
Route::middleware('auth:sanctum')->group(function () {
    // --- 6) Gerçek Token Silen Logout Route'u ---
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Çıkış yapıldı']);
    });

    // --- Admin Panel - Masa / Kasa / Garson yönetimi ---
    Route::prefix('admin')->group(function () {
        Route::get('/masalar', [RestaurantOpsController::class, 'masalariListele']);
        Route::post('/masalar', [RestaurantOpsController::class, 'masaEkle']);
        Route::post('/masalar/{id}/durum', [RestaurantOpsController::class, 'masaDurumDegistir']);
        Route::delete('/masalar/{id}', [RestaurantOpsController::class, 'masaSil']);
        Route::get('/garson-cagrilari', [RestaurantOpsController::class, 'garsonCagrilariGetir']);
        Route::post('/gun-sonu', [RestaurantOpsController::class, 'gunSonuAl']);
    });
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