<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductGroups\ProductGroupRepositoryInterface;
use App\Http\Repositories\Products\ProductRepositoryInterface;
use App\Http\Repositories\QrCode\QrCodeKartRepositoryInterface;
use App\Http\Repositories\Settings\SettingsRepositoryInterface;
use App\Models\UrunKart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Form;

class MainController extends Controller
{

    private $productRepo;
    private $productGroupRepo;
    private $settingsRepo;
    private $qrCodeRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        ProductGroupRepositoryInterface $productGroupRepo,
        SettingsRepositoryInterface $settingsRepo,
        QrCodeKartRepositoryInterface $qrCodeRepo
    ) {
        $this->productRepo = $productRepo;
        $this->productGroupRepo = $productGroupRepo;
        $this->settingsRepo = $settingsRepo;
        $this->qrCodeRepo = $qrCodeRepo;
    }

    public function index(Request $request, $qrcode = null)
    {

        if (!Session::has('locale')) {
            $availablelanguages = ['en', 'ru', 'ua', 'tr', 'de', 'fr'];
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($lang, $availablelanguages)) {
                /*      switch($lang)
                {
                    case 'en': @$localeId=2;
                    case 'ru': @$localeId=3;
                    case 'ua': @$localeId=4;
                    case 'tr': @$localeId=1;
                    case 'de': @$localeId=5;
                    case 'fr': @$localeId=6;
                    default  : $localeId=1;

                }*/
                $localeId = match ($lang) {
                    'en' => 2,
                    'ru' => 3,
                    'au' => 4,
                    'tr' => 1,
                    'de' => 5,
                    'fr' => 6,
                    default => 2,
                };

                App::setLocale($lang);
                session()->put('locale', $lang);
                session()->put('locale_id', $localeId);
            } else {
                App::setLocale("en");
                session()->put('locale', "en");
                session()->put('locale_id', 2);
            }
        } else {
            App::setLocale(session('locale'));
            session()->put('locale', session('locale'));
            session()->put('locale_id', session('locale_id'));
        }

        $allProductGroups = $this->productGroupRepo->GetAllProductGroups();
        $allProductMainGroups = $this->productGroupRepo->GetAllMainGroup();
        $ayar = $this->settingsRepo->GetSetting();

        if ($qrcode != null) {

            $qr = $this->qrCodeRepo->GetQrCodeKart($qrcode);

            if ($qr) {
                if (count($allProductMainGroups) === 0) {
                    return view('pages.direct', [
                        'ugrup' => $allProductGroups,
                        'ayar' => $ayar,
                        'qrCodeCart' => $qr
                    ]);
                }

                return view('pages.home', [
                    'ugrup' => $allProductMainGroups,
                    'ayar' => $ayar,
                    'qrCodeCart' => $qr
                ]);
            } else {
                return "Aradığınız QR Code Bulunamadı!";
            }
        } else {
            $qrcode = $request->get('QRCode');


            if ($qrcode) {
                $qr = $this->qrCodeRepo->GetQrCodeKart($qrcode);

                if ($qr) {
                    if (count($allProductMainGroups) === 0) {
                        return view('pages.direct', [
                            'ugrup' => $allProductGroups,
                            'ayar' => $ayar,
                            'qrCodeCart' => $qr
                        ]);
                    }

                    return view('pages.home', [
                        'ugrup' => $allProductMainGroups,
                        'ayar' => $ayar,
                        'qrCodeCart' => $qr
                    ]);
                } else {
                    return "Aradığınız QR Code Bulunamadı!";
                }
            }
        }
        if (count($allProductMainGroups) === 0) {
            return view('pages.direct', [
                'ugrup' => $allProductGroups,
                'ayar' => $ayar
            ]);
        }

        return view('pages.home', [
            'ugrup' => $allProductMainGroups,
            'ayar' => $ayar
        ]);
    }

    public function showproduct($id)
    {
        if (!Session::has('locale')) {
            $availablelanguages = ['en', 'ru', 'ua', 'tr', 'de'];
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($lang, $availablelanguages)) {
                App::setLocale($lang);
                session()->put('locale', $lang);
            } else {
                App::setLocale("en");
                session()->put('locale', "en");
            }
        } else {
            App::setLocale(session('locale'));
            session()->put('locale', session('locale'));
        }


        $urun = $this->productRepo->GetProduct($id);
        $ayar = $this->settingsRepo->GetSetting();

        //print_r($urun);

        if ($urun)
            return view('masterdetail', [
                'urun' => $urun,
                'ayar' => $ayar
            ]);
        else
            abort(404, "Product couldn't found");
    }

    public function istek()
    {
        if (!Session::has('locale')) {
            $availablelanguages = ['en', 'ru', 'ua', 'tr', 'de'];
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($lang, $availablelanguages)) {
                App::setLocale($lang);
                session()->put('locale', $lang);
            } else {
                App::setLocale("en");
                session()->put('locale', "en");
            }
        } else {
            App::setLocale(session('locale'));
            session()->put('locale', session('locale'));
        }


        $ayar = $this->settingsRepo->GetSetting();

        //print_r($urun);
        return view('pages.istek', [
            "ayar" => $ayar
        ]);
    }
    public function GetAllForms(Request $request)
    {
        $status = $request->input('status');
        if ($status != null) {
            return Form::query()->where("status", $status)->get();
        } else {
            return Form::query()->get();
        }
    }

    public function UserForm(Request $request)
    {

        // Form validation
        $this->validate($request, [
            'email' => 'required|email',
            'message' => 'required',
            'telefon' => 'required',
        ]);

        //  Store data in database
        Form::create($request->all());
        return back()->with('success', 'Görüş ve önerileriniz Kaliteci Unlu Mamüllerine iletildi..');
    }

    public function menuGetir()
    {
        $urunler = DB::table('t_urunkart')
            ->leftJoin('t_urungrubu', 't_urunkart.UrunGrubu_id', '=', 't_urungrubu.UrunGrubu_id')
            ->select('t_urunkart.*', DB::raw('COALESCE(t_urungrubu.Urungrubu, t_urunkart.UrunGrubu) as UrunGrubu'))
            ->orderBy('t_urunkart.Sira')
            ->get();

        return response()->json([
            'kategoriler' => DB::table('t_urungrubu')->orderBy('Sirano')->get(),
            'urunler' => $urunler
        ]);
    }

    public function ayarlarGetir()
    {
        $ayar = DB::table('t_ayar')->first();
        if (!$ayar) {
            return response()->json(['sirket_adi' => 'Center Cafe', 'wifi_sifresi' => 'center2026']);
        }
        return response()->json($ayar);
    }

    public function kategorilerGetir()
    {
        return response()->json(DB::table('t_urungrubu')->orderBy('Sirano')->get());
    }
}