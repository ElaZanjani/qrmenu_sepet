<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RestaurantOpsController extends Controller
{
    // POST /api/garson-cagir  (Müşteri tarafı - herkese açık, auth gerekmez)
    public function garsonCagir(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'masa' => 'required|string',
            'tip' => 'nullable|in:garson_cagir,hesap_iste',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $masaIsim = $request->input('masa');
        $masa = DB::table('t_masalar')->where('isim', $masaIsim)->first();

        DB::table('waiter_calls')->insert([
            'masa_ismi' => $masaIsim,
            'masa_id' => $masa->id ?? null,
            'cagri_tipi' => $request->input('tip', 'garson_cagir'),
            'cagri_zamani' => now(),
            'pulled' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Garson çağrıldı.']);
    }

    // GET /api/admin/masalar  (Admin panel listeleme)
    public function masalariListele()
    {
        return response()->json(['success' => true, 'masalar' => DB::table('t_masalar')->orderBy('isim')->get()]);
    }

    // POST /api/admin/masalar  (Yeni masa ekle)
    public function masaEkle(Request $request)
    {
        $isim = trim((string) $request->input('isim'));
        if ($isim === '') {
            return response()->json(['success' => false, 'message' => 'Masa adı zorunlu.'], 422);
        }

        $id = DB::table('t_masalar')->insertGetId([
            'isim' => $isim,
            'durum' => 0,
            'guncel_tutar' => 0,
            'siparisler' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'id' => $id]);
    }

    // POST /api/admin/masalar/{id}/durum  (Masayı aç / kapat)
    public function masaDurumDegistir(Request $request, $id)
    {
        $masa = DB::table('t_masalar')->where('id', $id)->first();
        if (!$masa) {
            return response()->json(['success' => false, 'message' => 'Masa bulunamadı.'], 404);
        }

        if ($masa->durum == 0) {
            // Boş masayı açma
            $tutar = (float) $request->input('tutar', 0);
            DB::table('t_masalar')->where('id', $id)->update(['durum' => 1, 'guncel_tutar' => $tutar, 'updated_at' => now()]);
        } else {
            // Dolu masayı kapatma (ödeme alma)
            $odemeTuru = $request->input('odeme_turu', 'Nakit'); // 'Nakit' | 'Kredi Kartı'
            $tutar = $masa->guncel_tutar;

            // Günlük Z-raporuna bu ödemeyi işle
            $bugun = now()->toDateString();
            $rapor = DB::table('kasa_z_raporlari')->where('tarih', $bugun)->first();
            $islemler = $rapor ? json_decode($rapor->islemler, true) : [];
            $islemler[] = [
                'islem_saati' => now()->toDateTimeString(),
                'turu' => $odemeTuru,
                'tutar' => $tutar,
                'aciklama' => $masa->isim . ' Odemesi',
            ];

            if ($rapor) {
                DB::table('kasa_z_raporlari')->where('id', $rapor->id)->update([
                    'nakit_toplam' => $rapor->nakit_toplam + ($odemeTuru === 'Nakit' ? $tutar : 0),
                    'kredi_karti_toplam' => $rapor->kredi_karti_toplam + ($odemeTuru === 'Kredi Kartı' ? $tutar : 0),
                    'islemler' => json_encode($islemler),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('kasa_z_raporlari')->insert([
                    'tarih' => $bugun,
                    'nakit_toplam' => $odemeTuru === 'Nakit' ? $tutar : 0,
                    'kredi_karti_toplam' => $odemeTuru === 'Kredi Kartı' ? $tutar : 0,
                    'yemek_karti_toplam' => 0,
                    'veresiye_toplam' => 0,
                    'islemler' => json_encode($islemler),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('t_masalar')->where('id', $id)->update(['durum' => 0, 'guncel_tutar' => 0, 'updated_at' => now()]);
        }

        return response()->json(['success' => true]);
    }

    // DELETE /api/admin/masalar/{id}
    public function masaSil($id)
    {
        DB::table('t_masalar')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    // GET /api/admin/garson-cagrilari  (Admin panel polling ile bunu çeker)
    public function garsonCagrilariGetir()
    {
        $cagrilar = DB::table('waiter_calls')->where('pulled', false)->get();
        DB::table('waiter_calls')->whereIn('id', $cagrilar->pluck('id'))->update(['pulled' => true]);

        return response()->json(['success' => true, 'cagrilar' => $cagrilar]);
    }

    // POST /api/admin/gun-sonu  (Tüm masaları boşalt, günlük rapor sıfırlanmaz - geçmiş kalır)
    public function gunSonuAl()
    {
        DB::table('t_masalar')->update(['durum' => 0, 'guncel_tutar' => 0, 'updated_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Gün sonu alındı.']);
    }
}