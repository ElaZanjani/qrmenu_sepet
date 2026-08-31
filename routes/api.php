<?php

use App\Http\API\APIController;
use App\Http\API\DesktopSyncController;
use App\Http\Controllers\Auth\DesktopAuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RestaurantOpsController;
<<<<<<< HEAD
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
=======
use App\Http\Controllers\SiparisController;
use App\Models\User;
use Illuminate\Http\Request;
>>>>>>> fd9dde20b3144d302ac6c6058b121887747e1d3b
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
// Müşteri tarafı - Herkese açık rotalar
Route::post('/garson-cagir', [RestaurantOpsController::class, 'garsonCagir']);
Route::get('/menu', [MainController::class, 'menuGetir']);
Route::get('/ayarlar', [MainController::class, 'ayarlarGetir']);
Route::get('/kategoriler', [MainController::class, 'kategorilerGetir']);

// Fiyat manipülasyonu engellenmiş güvenli sipariş rotası
Route::post('/siparis-ver', function (Request $request) {
    $masaNo = $request->input('masa_no');
    $izin = app(\App\Http\Controllers\RestaurantOpsController::class)->siparisIzniKontrolEtPublic($request, $masaNo);
    if (!$izin['ok']) {
        return response()->json(['status' => 'error', 'message' => $izin['mesaj']], 403);
    }

    $sepet = $request->input('urunler', []);

    if (empty($sepet)) {
        return response()->json(['status' => 'error', 'message' => 'Sepet boş, sipariş oluşturulamadı.'], 400);
    }

    $toplam = 0;
    $simdi = now();

    foreach ($sepet as $urun) {
        // İstemciden gelen fiyata GÜVENMİYORUZ, gerçeğini veritabanından çekiyoruz
        $gercekUrun = DB::table('t_urunkart')->where('UrunAd', $urun['UrunAd'] ?? null)->first();
        if (!$gercekUrun) continue;

        $adet = max(1, (int)($urun['adet'] ?? 1));
        $fiyat = (float) $gercekUrun->FixFiyat;
        $toplam += $fiyat * $adet;

        DB::table('web_orders')->insert([
            'masa_isim'     => 'Masa ' . $masaNo,
            'urun_adi'      => $gercekUrun->UrunAd,
            'adet'          => $adet,
            'fiyat'         => $fiyat, // Veritabanından alınan güvenli fiyat
            'ozellikler'    => null,
            'siparis_notu'  => null,
            'siparis_saati' => $simdi,
            'pulled'        => 0,
            'created_at'    => $simdi,
            'updated_at'    => $simdi,
        ]);
    }

    return response()->json(['status' => 'success', 'message' => 'Siparişiniz alındı!', 'toplam' => $toplam]);
})->middleware('throttle:20,1');

// TEK admin login noktası (Sanctum Token Üreten)
Route::post('/admin-login', function (Request $request) {
    $request->validate([
        'email' => 'required|email', 
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['durum' => 'hata', 'mesaj' => 'E-posta veya şifre hatalı!'], 401);
    }

    $token = $user->createToken('admin-panel', ['*'], now()->addDays(7))->plainTextToken;

    return response()->json([
        'durum' => 'basarili',
        'token' => $token,
        'user' => $user,
    ]);
=======
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
>>>>>>> fd9dde20b3144d302ac6c6058b121887747e1d3b
});

// --- KORUNAN (Auth:Sanctum ile Sıkılaştırılmış) Admin ve Yazma İşlemleri Rotaları ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Çıkış yapma
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Çıkış yapıldı']);
    });

    // Mikale özel paneli - Sistem durumu
    Route::get('/mikale-durum', function () {
        return response()->json([
            'basarili' => true,
            'laravel_versiyon' => app()->version(),
            'php_versiyon' => phpversion(),
            'ortam' => app()->environment(),
            'debug_modu' => config('app.debug') ? 'AÇIK (RİSKLİ!)' : 'Kapalı',
            'toplam_urun' => DB::table('t_urunkart')->count(),
            'toplam_kategori' => DB::table('t_urungrubu')->count(),
            'toplam_masa' => DB::table('t_masalar')->count(),
            'bugunku_siparis' => DB::table('web_orders')->whereDate('created_at', now())->count(),
            'bekleyen_garson_cagrisi' => DB::table('waiter_calls')->where('pulled', false)->count(),
            'disk_bos_alan_gb' => round(@disk_free_space(base_path()) / 1073741824, 2),
        ]);
    });

    // Mikale özel paneli - Canlı log görüntüleyici (artık token korumalı)
    Route::get('/mikale-loglar', function () {
        $path = storage_path('logs/laravel.log');
        if (!file_exists($path)) {
            return response()->json(['basarili' => true, 'log' => 'Henüz log dosyası oluşmamış.']);
        }
        $icerik = file_get_contents($path);
        $satirlar = explode("\n", $icerik);
        $sonSatirlar = array_slice($satirlar, -200);
        return response()->json(['basarili' => true, 'log' => implode("\n", $sonSatirlar)]);
    });

    // Admin şifre güncelleme
    Route::post('/admin-sifre-guncelle', function (Request $request) {
        $email = $request->input('email');
        $eskiSifre = $request->input('eski_sifre');
        $yeniSifre = $request->input('yeni_sifre');

        $user = DB::table('users')->where('email', $email)->first();
        if (!$user || !Hash::check($eskiSifre, $user->password)) {
            return response()->json(['durum' => 'hata', 'mesaj' => 'Mevcut şifre hatalı!'], 401);
        }

        DB::table('users')->where('email', $email)->update([
            'password' => Hash::make($yeniSifre)
        ]);

        return response()->json(['durum' => 'basarili', 'mesaj' => 'Şifre başarıyla güncellendi!']);
    });

    // Yeni admin/kullanıcı hesabı oluşturma
    Route::post('/admin-yeni-kullanici', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (DB::table('users')->where('email', $request->email)->exists()) {
            return response()->json(['durum' => 'hata', 'mesaj' => 'Bu e-posta zaten kayıtlı!'], 422);
        }
        $maxIdKullanici = DB::table('users')->max('id_kullanici') ?? 0;
        DB::table('users')->insert([
            'id_kullanici' => $maxIdKullanici + 1,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'yetki' => 'tumu',
            'kullanicitipi' => 1,
            'subeyetki' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(['durum' => 'basarili', 'mesaj' => 'Yeni kullanıcı başarıyla eklendi!']);
    });

    // Kategori yönetimi
    Route::post('/kategori-ekle', function (Request $request) {
        try {
            $grupAdi = $request->input('grup_adi');
            $anaGrup = $request->input('ana_grup', $grupAdi);

            if (!$grupAdi) {
                return response()->json(['durum' => 'hata', 'mesaj' => 'Kategori adı boş olamaz!']);
            }

            $maxId   = DB::table('t_urungrubu')->max('UrunGrubu_id') ?? 0;
            $maxSira = DB::table('t_urungrubu')->max('Sirano') ?? 0;

            DB::table('t_urungrubu')->insert([
                'UrunGrubu_id' => $maxId + 1,
                'Sirano'       => $maxSira + 1,
                'Urungrubu'    => mb_strtoupper($grupAdi, 'UTF-8'),
                'AnaGrup'      => mb_strtoupper($anaGrup, 'UTF-8'),
            ]);

            return response()->json(['durum' => 'basarili', 'mesaj' => 'Kategori başarıyla eklendi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    Route::post('/kategori-sil/{id}', function ($id) {
        try {
            DB::table('t_urungrubu')->where('id', $id)->delete();
            return response()->json(['durum' => 'basarili', 'mesaj' => 'Kategori silindi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    Route::post('/kategori-sirala', function (Request $request) {
        try {
            $siraliIdler = $request->input('sirali_idler', []);
            foreach ($siraliIdler as $index => $id) {
                DB::table('t_urungrubu')->where('id', $id)->update(['Sirano' => $index + 1]);
            }
            return response()->json(['durum' => 'basarili', 'mesaj' => 'Kategori sıralaması güncellendi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    // Güvenli Ürün Ekleme (Validasyonlu ve uniqid isimli resim yükleme)
    Route::post('/urun-ekle', function (Request $request) {
        try {
            $request->validate([
                'resim' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            ]);

            $resimYolu = null;
            if ($request->hasFile('resim')) {
                $dosya = $request->file('resim');
                $isim = uniqid('urun_') . '.' . $dosya->getClientOriginalExtension();
                $dosya->move(public_path('images/urunler/images'), $isim);
                $resimYolu = '/images/urunler/images/' . $isim;
            }

            $kategoriKaydi = DB::table('t_urungrubu')->whereRaw('UPPER(Urungrubu) = ?', [mb_strtoupper($request->input('kategori'), 'UTF-8')])->first();

            DB::table('t_urunkart')->insert([
                'UrunAd' => $request->input('ad'),
                'UrunGrubu' => $request->input('kategori'),
                'UrunGrubu_id' => $kategoriKaydi->UrunGrubu_id ?? null,
                'FixFiyat' => $request->input('fiyat'),
                'Sira' => $request->input('sira') ?? 1,
                'resim_url' => $resimYolu,
                'aciklama' => $request->input('aciklama'),
                'alerjen' => $request->input('alerjen'),
                'kalori' => $request->input('kalori'),
                'sure' => $request->input('sure'),
                'is_gluten_free' => $request->input('is_gluten_free') ?? 0,
            ]);

            return response()->json(['durum' => 'basarili', 'mesaj' => 'Urun basariyla eklendi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    Route::post('/urun-sil/{id}', function ($id) {
        try {
            $urun = DB::table('t_urunkart')->where('id', $id)->first();
            if ($urun) {
                DB::table('t_urunkart')->where('id', $id)->delete();
                return response()->json(['durum' => 'basarili', 'mesaj' => 'Urun silindi!']);
            }
            return response()->json(['durum' => 'hata', 'mesaj' => 'Urun bulunamadi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    // Güvenli Ürün Güncelleme
    Route::post('/urun-guncelle/{id}', function (Request $request, $id) {
        try {
            $request->validate([
                'resim' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            ]);

            $kategoriKaydi = DB::table('t_urungrubu')->whereRaw('UPPER(Urungrubu) = ?', [mb_strtoupper($request->input('kategori'), 'UTF-8')])->first();

            $guncellemeVerileri = [
                'UrunAd' => $request->input('ad'),
                'UrunGrubu' => $request->input('kategori'),
                'UrunGrubu_id' => $kategoriKaydi->UrunGrubu_id ?? null,
                'FixFiyat' => $request->input('fiyat'),
                'Sira' => $request->input('sira') ?? 1,
                'aciklama' => $request->input('aciklama'),
                'alerjen' => $request->input('alerjen'),
                'kalori' => $request->input('kalori'),
                'sure' => $request->input('sure'),
                'is_gluten_free' => $request->input('is_gluten_free') ?? 0,
            ];

            if ($request->hasFile('resim')) {
                $dosya = $request->file('resim');
                $isim = uniqid('urun_') . '.' . $dosya->getClientOriginalExtension();
                $dosya->move(public_path('images/urunler/images'), $isim);
                $guncellemeVerileri['resim_url'] = '/images/urunler/images/' . $isim;
            }

            DB::table('t_urunkart')->where('id', $id)->update($guncellemeVerileri);

            return response()->json(['durum' => 'basarili', 'mesaj' => 'Urun basariyla guncellendi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    // Güvenli Ayarlar / Logo / Vitrin Güncelleme
    Route::post('/ayarlar-guncelle', function (Request $request) {
        try {
            $request->validate([
                'vitrin_gorsel' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
                'logo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            ]);

            $ayar = DB::table('t_ayar')->first();
            $vitrinGorselYolu = $ayar->vitrin_gorsel_url ?? '/images/OIP.jpg.webp';
            $logoYolu = $ayar->logo_url ?? null;

            if ($request->input('gorsel_sil') == '1') {
                $vitrinGorselYolu = '/images/OIP.jpg.webp';
            } elseif ($request->hasFile('vitrin_gorsel')) {
                $dosya = $request->file('vitrin_gorsel');
                $isim = uniqid('vitrin_') . '.' . $dosya->getClientOriginalExtension();
                $dosya->move(public_path('images'), $isim);
                $vitrinGorselYolu = '/images/' . $isim;
            }

            if ($request->input('logo_sil') == '1') {
                $logoYolu = null;
            } elseif ($request->hasFile('logo')) {
                $dosya = $request->file('logo');
                $isim = uniqid('logo_') . '.' . $dosya->getClientOriginalExtension();
                $dosya->move(public_path('images'), $isim);
                $logoYolu = '/images/' . $isim;
            }

            DB::table('t_ayar')->updateOrInsert(
                ['id' => 1],
                [
                    'sirket_adi' => $request->input('sirket_adi', 'Center Cafe'),
                    'slogan' => $request->input('slogan', 'LEZZETİN MERKEZİ'),
                    'alt_aciklama' => $request->input('alt_aciklama', 'Dünya mutfağından seçkin lezzetler, taptaze kahveler ve unutulmaz anlar için doğru yerdesiniz.'),
                    'wifi_sifresi' => $request->input('wifi_sifresi', 'center2026'),
                    'telefon' => $request->input('telefon'),
                    'adres' => $request->input('adres'),
                    'yorum_linki' => $request->input('yorum_linki'),
                    'vitrin_gorsel_url' => $vitrinGorselYolu,
                    'logo_url' => $logoYolu,
                    'imza_metni' => $request->input('imza_metni', 'Mikale Yazılım'),
                    'guvenlik_suresi_dk' => $request->input('guvenlik_suresi_dk', 30),
                    'gps_dogrulama_aktif' => $request->input('gps_dogrulama_aktif', 0),
                    'gps_enlem' => $request->input('gps_enlem') !== null && $request->input('gps_enlem') !== '' ? $request->input('gps_enlem') : null,
                    'gps_boylam' => $request->input('gps_boylam') !== null && $request->input('gps_boylam') !== '' ? $request->input('gps_boylam') : null,
                    'gps_max_mesafe' => $request->input('gps_max_mesafe', 200),
                ]
            );
            return response()->json(['durum' => 'basarili', 'mesaj' => 'Vitrin ve kurumsal ayarlar başarıyla güncellendi!']);
        } catch (\Exception $e) {
            return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
        }
    });

    // Admin Panel - Masa / Kasa / Garson yönetimi
    Route::prefix('admin')->group(function () {
        Route::get('/masalar', [RestaurantOpsController::class, 'masalariListele']);
        Route::post('/masalar', [RestaurantOpsController::class, 'masaEkle']);
        Route::post('/masalar/{id}/durum', [RestaurantOpsController::class, 'masaDurumDegistir']);
        Route::delete('/masalar/{id}', [RestaurantOpsController::class, 'masaSil']);
        Route::get('/garson-cagrilari', [RestaurantOpsController::class, 'garsonCagrilariGetir']);
        Route::post('/gun-sonu', [RestaurantOpsController::class, 'gunSonuAl']);
    });
});

// --- Eski v1 rotaları ve Desktop Bridge (Dokunulmadı) ---
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

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [DesktopAuthController::class, 'logout']);
            Route::post('/sync/tables', [DesktopSyncController::class, 'syncTables']);
            Route::post('/sync/menu', [DesktopSyncController::class, 'syncMenuPush']);
            Route::get('/sync/menu', [DesktopSyncController::class, 'syncMenuPull']);
            // EKLENDİ: Kategori senkronizasyon rotaları
            Route::post('/sync/categories', [DesktopSyncController::class, 'syncCategoriesPush']);
            Route::get('/sync/categories', [DesktopSyncController::class, 'syncCategoriesPull']);
            Route::post('/sync/kasa', [DesktopSyncController::class, 'syncKasa']);
            Route::get('/sync/web-orders', [DesktopSyncController::class, 'pullWebOrders']);
            Route::get('/sync/waiter-calls', [DesktopSyncController::class, 'pullWaiterCalls']);
            Route::get('/sync/product/{id}', [DesktopSyncController::class, 'pullSingleProduct']);
            Route::get('/status', [DesktopSyncController::class, 'status']);
        });
    });
});