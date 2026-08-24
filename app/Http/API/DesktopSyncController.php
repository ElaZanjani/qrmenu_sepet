<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DesktopSyncController extends Controller
{
    // POST /api/v1/desktop/sync/tables  (Kasa -> Web)
    public function syncTables(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'masalar' => 'required|array',
            'masalar.*.isim' => 'required|string',
            'masalar.*.durum' => 'required|integer',
            'masalar.*.guncel_tutar' => 'required|numeric',
            'masalar.*.siparisler' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        foreach ($request->input('masalar') as $masaData) {
            $ariyorIsim = $masaData['eski_isim'] ?? $masaData['isim'];

            DB::table('t_masalar')->updateOrInsert(
                ['isim' => $ariyorIsim],
                [
                    'isim' => $masaData['isim'],
                    'durum' => $masaData['durum'],
                    'guncel_tutar' => $masaData['guncel_tutar'],
                    'siparisler' => json_encode($masaData['siparisler'] ?? []),
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        return response()->json(['success' => true, 'message' => 'Masalar güncellendi.']);
    }

    // POST /api/v1/desktop/sync/menu  (Kasa -> Web: ürün ekleme/güncelleme)
    public function syncMenuPush(Request $request)
    {
        $urunler = $request->input('urunler', []);

        foreach ($urunler as $u) {
            if (!isset($u['id'], $u['UrunAd'], $u['FixFiyat'], $u['UrunGrubu_id'])) {
                continue; // eksik zorunlu alan varsa o kaydı atla
            }

            DB::table('t_urunkart')->updateOrInsert(
                ['id' => $u['id']],
                [
                    'UrunAd' => $u['UrunAd'],
                    'aciklama' => $u['UrunAciklama'] ?? null,
                    'alerjen' => $u['alerjenler'] ?? null,
                    'FixFiyat' => $u['FixFiyat'],
                    'UrunGrubu' => $u['UrunGrubu'] ?? DB::raw('UrunGrubu'),
                    'kalori' => $u['kalori'] ?? null,
                    'sure' => $u['sure'] ?? null,
                    'is_gluten_free' => $u['has_lactose'] ?? 0,
                    'Sira' => $u['SiraNo'] ?? DB::raw('Sira'),
                ]
            );
        }

        return response()->json(['success' => true, 'message' => 'Menü senkronize edildi.']);
    }

    // GET /api/v1/desktop/sync/menu  (Web -> Kasa: güncel menüyü çekme)
    public function syncMenuPull()
    {
        return response()->json([
            'success' => true,
            'urunler' => DB::table('t_urunkart')->orderBy('Sira')->get(),
        ]);
    }

    // POST /api/v1/desktop/sync/kasa  (Kasa -> Web: Z-Raporu / gün sonu cirosu)
    public function syncKasa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tarih' => 'required|date_format:Y-m-d',
            'nakit_toplam' => 'required|numeric',
            'kredi_karti_toplam' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        DB::table('kasa_z_raporlari')->insert([
            'tarih' => $request->input('tarih'),
            'nakit_toplam' => $request->input('nakit_toplam'),
            'kredi_karti_toplam' => $request->input('kredi_karti_toplam'),
            'yemek_karti_toplam' => $request->input('yemek_karti_toplam', 0),
            'veresiye_toplam' => $request->input('veresiye_toplam', 0),
            'islemler' => json_encode($request->input('islemler', [])),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Z-Raporu kaydedildi.']);
    }

    // GET /api/v1/desktop/sync/web-orders  (Web -> Kasa)
    public function pullWebOrders(Request $request)
    {
        $limit = (int) $request->query('limit', 50);

        $query = DB::table('web_orders')->where('pulled', false)->limit($limit);
        $orders = $query->get();

        if ($request->query('mark_as_pulled') == 1 && $orders->isNotEmpty()) {
            DB::table('web_orders')->whereIn('id', $orders->pluck('id'))->update(['pulled' => true]);
        }

        return response()->json(['success' => true, 'count' => $orders->count(), 'orders' => $orders]);
    }

    // GET /api/v1/desktop/sync/waiter-calls  (Web -> Kasa)
    public function pullWaiterCalls(Request $request)
    {
        $calls = DB::table('waiter_calls')->where('pulled', false)->get();

        if ($request->query('mark_as_pulled') == 1 && $calls->isNotEmpty()) {
            DB::table('waiter_calls')->whereIn('id', $calls->pluck('id'))->update(['pulled' => true]);
        }

        return response()->json(['success' => true, 'cagrilar' => $calls]);
    }

    // GET /api/v1/desktop/sync/product/{id}
    public function pullSingleProduct($id)
    {
        $urun = DB::table('t_urunkart')->where('id', $id)->first();

        if (!$urun) {
            return response()->json(['success' => false, 'message' => 'Ürün bulunamadı.'], 404);
        }

        return response()->json(['success' => true, 'product' => $urun]);
    }

    // GET /api/v1/desktop/status
    public function status()
    {
        $masalar = DB::table('t_masalar')->get();
        $acikMasalar = $masalar->where('durum', 1);

        $bugunkuRapor = DB::table('kasa_z_raporlari')->where('tarih', now()->toDateString())->latest()->first();

        return response()->json([
            'success' => true,
            'menu_guncellenme_tarihi' => optional(DB::table('t_urunkart')->latest('Upd_Tarih')->first())->Upd_Tarih,
            'acik_masa_sayisi' => $acikMasalar->count(),
            'masalar' => $acikMasalar->map(fn ($m) => [
                'id' => $m->id,
                'isim' => $m->isim,
                'durum' => 'dolu',
                'guncel_tutar' => $m->guncel_tutar,
            ])->values(),
            'gun_sonu' => [
                'tarih' => now()->toDateString(),
                'nakit_toplam' => $bugunkuRapor->nakit_toplam ?? 0,
                'kredi_karti_toplam' => $bugunkuRapor->kredi_karti_toplam ?? 0,
                'yemek_ceki_toplam' => $bugunkuRapor->yemek_karti_toplam ?? 0,
                'genel_toplam' => ($bugunkuRapor->nakit_toplam ?? 0) + ($bugunkuRapor->kredi_karti_toplam ?? 0),
            ],
        ]);
    }
}