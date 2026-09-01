<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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

Route::get('/mikale-giris-x7k92', function () {
    return view('mikale');
});

Route::get('/mutfak', function () {
    return view('mutfak');
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
        elseif (str_contains($grup, 'KÖY EKMEĞİ')) { $urun->UrunGrubu = 'KÖY EKMEĞİ TOSTLAR';