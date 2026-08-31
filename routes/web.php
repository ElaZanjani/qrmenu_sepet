<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function (Request $request) {
    $masa = $request->query('masa');
    if ($masa) {
        cookie()->queue(cookie('masa_qr_' . md5($masa), now()->timestamp, 60 * 24));
    }
    return view('index');
});

Route::get('/admin', function () {
    return view('admin');
});

<<<<<<< HEAD
=======
Route::get('/mikale-giris-x7k92', function () {
    return view('mikale');
});

Route::get('/api/admin-olustur-bir-kere', function() {
    DB::table('users')->updateOrInsert(
        ['email' => 'admin@centercafe.com'],
        [
            'id_kullanici' => 999,
            'name' => 'Admin',
            'password' => Hash::make('Center2026'),
            'yetki' => 'tumu',
            'kullanicitipi' => '1',
            'subeyetki' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
    return "Admin kullanicisi olusturuldu.";
});

// Özel Mikale Admin Hesabı Oluşturma Route'u
Route::get('/api/mikale-admin-olustur-bir-kere', function() {
    DB::table('users')->updateOrInsert(
        ['email' => 'mikale@centercafe.com'],
        [
            'id_kullanici' => 998,
            'name' => 'Mikale Yazılım',
            'password' => Hash::make('MikaleSecure2026!'),
            'yetki' => 'tumu',
            'kullanicitipi' => '1',
            'subeyetki' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
    return "Mikale admin hesabı oluşturuldu.";
});

Route::post('/api/admin-login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    $user = DB::table('users')->where('email', $email)->first();
    if ($user && Hash::check($password, $user->password)) {
        return response()->json([
            'durum' => 'basarili',
            'token' => base64_encode($user->email . ':' . now()->timestamp),
        ]);
    }

    return response()->json(['durum' => 'hata', 'mesaj' => 'E-posta veya şifre hatalı!'], 401);
});

// Admin Şifre Güncelleme Route'u
Route::post('/api/admin-sifre-guncelle', function (Request $request) {
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

Route::get('/sistemi-sifirla', function() {
    try { DB::statement('ALTER TABLE t_urunkart ADD COLUMN aciklama TEXT NULL'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_urunkart ADD COLUMN kalori INT NULL'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_urunkart ADD COLUMN sure INT NULL'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_urunkart ADD COLUMN is_gluten_free BOOLEAN DEFAULT 0'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_urunkart ADD COLUMN alerjen TEXT NULL'); } catch(\Exception $e) {}

    return "Veritabani basariyla guncellendi!";
});

// Yeni Kolonlar İçin Bir Kerelik Route
Route::get('/sistemi-guncelle-v2', function() {
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN logo_url VARCHAR(255) NULL'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN imza_metni VARCHAR(255) NULL'); } catch(\Exception $e) {}
    return "Veritabani basariyla guncellendi (logo_url, imza_metni eklendi)!";
});

// Güvenlik ve GPS Ayarları İçin Bir Kerelik Route (v3)
Route::get('/sistemi-guncelle-v3', function() {
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN guvenlik_suresi_dk INT DEFAULT 30'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN gps_dogrulama_aktif TINYINT(1) DEFAULT 0'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN gps_enlem DOUBLE NULL'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN gps_boylam DOUBLE NULL'); } catch(\Exception $e) {}
    try { DB::statement('ALTER TABLE t_ayarlar ADD COLUMN gps_max_mesafe INT DEFAULT 200'); } catch(\Exception $e) {}
    return "Veritabani basariyla guncellendi (guvenlik ayarlari eklendi)!";
});

// Kapsamlı Güvenli Veritabanı Güncelleme Route'u (v4)
Route::get('/sistemi-guncelle-v4', function() {
    if (!Schema::hasTable('t_ayarlar')) {
        Schema::create('t_ayarlar', function ($table) {
            $table->id();
            $table->timestamps();
        });
    }

    $kolonlar = [
        'sirket_adi' => "VARCHAR(255) NULL",
        'slogan' => "VARCHAR(255) NULL",
        'alt_aciklama' => "TEXT NULL",
        'wifi_sifresi' => "VARCHAR(255) NULL",
        'telefon' => "VARCHAR(255) NULL",
        'adres' => "TEXT NULL",
        'yorum_linki' => "VARCHAR(500) NULL",
        'vitrin_gorsel_url' => "VARCHAR(255) NULL",
        'logo_url' => "VARCHAR(255) NULL",
        'imza_metni' => "VARCHAR(255) NULL",
        'guvenlik_suresi_dk' => "INT DEFAULT 30",
        'gps_dogrulama_aktif' => "TINYINT(1) DEFAULT 0",
        'gps_enlem' => "DOUBLE NULL",
        'gps_boylam' => "DOUBLE NULL",
        'gps_max_mesafe' => "INT DEFAULT 200",
    ];

    foreach ($kolonlar as $isim => $tip) {
        try { DB::statement("ALTER TABLE t_ayarlar ADD COLUMN {$isim} {$tip}"); } catch (\Exception $e) {}
    }

    if (DB::table('t_ayarlar')->count() === 0) {
        DB::table('t_ayarlar')->insert([
            'sirket_adi' => 'Center Cafe & Bistro',
            'wifi_sifresi' => 'center2026',
            'guvenlik_suresi_dk' => 30,
            'gps_max_mesafe' => 200,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return "t_ayarlar tablosu kontrol edildi, eksik kolonlar eklendi ve hazır hale getirildi!";
});

// Masaüstü Token Tablosu İçin Bir Kerelik Route (v5)
Route::get('/sistemi-guncelle-v5', function() {
    if (!Schema::hasTable('desktop_tokens')) {
        Schema::create('desktop_tokens', function ($table) {
            $table->id();
            $table->string('token', 100)->unique();
            $table->string('email');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });
    }
    return "desktop_tokens tablosu hazır!";
});

Route::get('/api/menu', function () {
    $urunler = DB::table('t_urunkart')->orderBy('Sira')->get();

    foreach ($urunler as $urun) {
        $grup = mb_strtoupper(trim($urun->UrunGrubu ?? ''), 'UTF-8');

        if (str_contains($grup, 'SAHANDA')) {
            $urun->UrunGrubu = 'SAHANDA';
        } elseif (str_contains($grup, 'OMLET')) {
            $urun->UrunGrubu = 'OMLET';
        } elseif (str_contains($grup, 'KENDİ KAHVALTINI YARAT')) {
            $urun->UrunGrubu = 'KENDİ KAHVALTINI YARAT';
        } elseif ($grup === 'KAHVALTILAR' || str_contains($grup, 'KAHVALTI')) {
            $urun->UrunGrubu = 'KAHVALTILAR';
        }

        elseif (str_contains($grup, 'SÜTLÜ TATLI') || str_contains($grup, 'SUTLU TATLI')) { $urun->UrunGrubu = 'SÜTLÜ TATLI'; }
        elseif (str_contains($grup, 'PASTALAR') || str_contains($grup, 'PASTA')) { $urun->UrunGrubu = 'PASTALAR'; }
        elseif (str_contains($grup, 'ŞERBETLİ TATLI') || str_contains($grup, 'SERBETLI')) { $urun->UrunGrubu = 'ŞERBETLİ TATLI'; }
        elseif (str_contains($grup, 'KİLOLUK ÜRÜNLER') || str_contains($grup, 'KILOLUK')) { $urun->UrunGrubu = 'KİLOLUK ÜRÜNLER'; }
        elseif (str_contains($grup, 'KEKLER')) { $urun->UrunGrubu = 'KEKLER'; }
        elseif (str_contains($grup, 'İLAVELER') || str_contains($grup, 'ILAVELER')) { $urun->UrunGrubu = 'İLAVELER'; }
        elseif ($grup === 'TATLILAR') { $urun->UrunGrubu = 'TATLILAR'; }

        elseif (str_contains($grup, 'DÜNYA KAHVELERİ') || str_contains($grup, 'DUNYA KAHVELERI')) { $urun->UrunGrubu = 'DÜNYA KAHVELERİ'; }
        elseif (str_contains($grup, 'BİTKİ ÇAYI') || str_contains($grup, 'BITKI CAYI')) { $urun->UrunGrubu = 'BİTKİ ÇAYI'; }
        elseif ($grup === 'SICAK İÇECEKLER') { $urun->UrunGrubu = 'SICAK İÇECEKLER'; }

        elseif (str_contains($grup, 'SOĞUK KAHVELER') || str_contains($grup, 'SOGUK KAHVELER')) { $urun->UrunGrubu = 'SOĞUK KAHVELER'; }
        elseif (str_contains($grup, 'MEŞRUBATLAR') || str_contains($grup, 'MESRUBATLAR')) { $urun->UrunGrubu = 'MEŞRUBATLAR'; }
        elseif (str_contains($grup, 'FROZEN')) { $urun->UrunGrubu = 'FROZEN'; }
        elseif (str_contains($grup, 'SMOOTHIE') || str_contains($grup, 'SMOOTHİE')) { $urun->UrunGrubu = 'SMOOTHIE'; }
        elseif (str_contains($grup, 'MILKSHAKE')) { $urun->UrunGrubu = 'MILKSHAKE'; }
        elseif (str_contains($grup, 'FRAPPE')) { $urun->UrunGrubu = 'FRAPPE'; }
        elseif (str_contains($grup, 'KOKTEYL & DETOX')) { $urun->UrunGrubu = 'KOKTEYL & DETOX'; }
        elseif ($grup === 'SOĞUK İÇECEKLER') { $urun->UrunGrubu = 'SOĞUK İÇECEKLER'; }

        elseif ($grup === 'DONDURMALAR') { $urun->UrunGrubu = 'DONDURMALAR'; }

        elseif (str_contains($grup, 'GÖZLEMELER') || str_contains($grup, 'GOZLEMELER')) { $urun->UrunGrubu = 'GÖZLEMELER'; }
        elseif (str_contains($grup, 'TOSTLAR')) { $urun->UrunGrubu = 'TOSTLAR'; }
        elseif (str_contains($grup, 'KÖYLÜM') || str_contains($grup, 'BAZLAMA')) { $urun->UrunGrubu = 'KÖYLÜM (BAZLAMA) TOSTLAR'; }
        elseif (str_contains($grup, 'KÖY EKMEĞİ')) { $urun->UrunGrubu = 'KÖY EKMEĞİ TOSTLAR'; }
        elseif (str_contains($grup, 'APERATİFLER') || str_contains($grup, 'APERATIFLER')) { $urun->UrunGrubu = 'APERATİFLER'; }
        elseif ($grup === 'GÖZLEME & TOST') { $urun->UrunGrubu = 'GÖZLEME & TOST'; }
    }

    return response()->json([
        'kategoriler' => DB::table('t_urungrubu')->orderBy('Sirano')->get(),
        'urunler' => $urunler
    ]);
});

// KATEGORİ YÖNETİMİ API ROTALARI
Route::get('/api/kategoriler', function () {
    try {
        $kategoriler = DB::table('t_urungrubu')->orderBy('Sirano')->get();
        return response()->json($kategoriler);
    } catch (\Exception $e) {
        return response()->json([]);
    }
});

Route::post('/api/kategori-ekle', function (Request $request) {
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

Route::post('/api/kategori-sil/{id}', function ($id) {
    try {
        DB::table('t_urungrubu')->where('id', $id)->delete();
        return response()->json(['durum' => 'basarili', 'mesaj' => 'Kategori silindi!']);
    } catch (\Exception $e) {
        return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
    }
});

// Kategori Sıralama Route'u
Route::post('/api/kategori-sirala', function (Request $request) {
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

Route::post('/api/urun-ekle', function (Request $request) {
    try {
        $resimYolu = null;

        if ($request->hasFile('resim')) {
            $dosya = $request->file('resim');
            $isim = time() . '_' . $dosya->getClientOriginalName();
            $dosya->move(public_path('images/urunler/images'), $isim);
            $resimYolu = '/images/urunler/images/' . $isim;
        }

        DB::table('t_urunkart')->insert([
            'UrunAd' => $request->input('ad'),
            'UrunGrubu' => $request->input('kategori'),
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

Route::post('/api/urun-sil/{id}', function ($id) {
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

Route::post('/api/urun-guncelle/{id}', function (Request $request, $id) {
    try {
        $guncellemeVerileri = [
            'UrunAd' => $request->input('ad'),
            'UrunGrubu' => $request->input('kategori'),
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
            $isim = time() . '_' . $dosya->getClientOriginalName();
            $dosya->move(public_path('images/urunler/images'), $isim);
            $guncellemeVerileri['resim_url'] = '/images/urunler/images/' . $isim;
        }

        DB::table('t_urunkart')->where('id', $id)->update($guncellemeVerileri);

        return response()->json(['durum' => 'basarili', 'mesaj' => 'Urun basariyla guncellendi!']);
    } catch (\Exception $e) {
        return response()->json(['durum' => 'hata', 'mesaj' => $e->getMessage()]);
    }
});

// Sipariş Verme Route'u (web_orders tablosuna kayıt) ve Rate Limit
Route::post('/api/siparis-ver', function (Request $request) {
    try {
        $masaNo = $request->input('masa_no');
        $urunler = $request->input('urunler', []);

        if (empty($urunler)) {
            return response()->json(['status' => 'error', 'message' => 'Sepet boş, sipariş oluşturulamadı.'], 400);
        }

        $simdi = now();

        foreach ($urunler as $urun) {
            DB::table('web_orders')->insert([
                'masa_isim'     => 'Masa ' . $masaNo,
                'urun_adi'      => $urun['UrunAd'] ?? 'Bilinmeyen Ürün',
                'adet'          => $urun['adet'] ?? 1,
                'fiyat'         => $urun['FixFiyat'] ?? 0,
                'ozellikler'    => null,
                'siparis_notu'  => null,
                'siparis_saati' => $simdi,
                'pulled'        => 0,
                'created_at'    => $simdi,
                'updated_at'    => $simdi,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Siparişiniz alındı!']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
})->middleware('throttle:20,1');

Route::get('/api/ayarlar', function () {
    try {
        $ayar = DB::table('t_ayarlar')->first();
        if (!$ayar) {
            return response()->json([
                'sirket_adi' => 'Center Cafe',
                'wifi_sifresi' => 'center2026'
            ]);
        }
        return response()->json($ayar);
    } catch (\Exception $e) {
        return response()->json(['sirket_adi' => 'Center Cafe']);
    }
});

Route::post('/api/ayarlar-guncelle', function (Request $request) {
    try {
        $ayar = DB::table('t_ayarlar')->first();
        $vitrinGorselYolu = $ayar->vitrin_gorsel_url ?? '/images/OIP.jpg.webp';
        $logoYolu = $ayar->logo_url ?? null;

        if ($request->input('gorsel_sil') == '1') {
            $vitrinGorselYolu = '/images/OIP.jpg.webp';
        } elseif ($request->hasFile('vitrin_gorsel')) {
            $dosya = $request->file('vitrin_gorsel');
            $isim = time() . '_' . $dosya->getClientOriginalName();
            $dosya->move(public_path('images'), $isim);
            $vitrinGorselYolu = '/images/' . $isim;
        }

        if ($request->input('logo_sil') == '1') {
            $logoYolu = null;
        } elseif ($request->hasFile('logo')) {
            $dosya = $request->file('logo');
            $isim = 'logo_' . time() . '_' . $dosya->getClientOriginalName();
            $dosya->move(public_path('images'), $isim);
            $logoYolu = '/images/' . $isim;
        }

        DB::table('t_ayarlar')->updateOrInsert(
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

>>>>>>> fd9dde20b3144d302ac6c6058b121887747e1d3b
Route::get('/mutfak', function () {
    return view('mutfak');
});

Route::get('/mikale-giris-x7k92', function () {
    return view('mikale');
});