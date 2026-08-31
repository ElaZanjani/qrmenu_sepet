<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel | Yönetim Merkezi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brandGreen: '#047857', brandGold: '#D4AF37', brandDark: '#022C22', brandBg: '#F8FAFC', brandBlue: '#3B82F6' },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Cinzel', 'serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-brandBg font-sans text-brandDark min-h-screen flex relative overflow-x-hidden">

    <div id="admin-toast-container" class="fixed top-5 right-5 z-[300] flex flex-col gap-3 pointer-events-none"></div>

    <!-- LOGIN EKRANI -->
    <div id="login-screen" class="fixed inset-0 z-[200] bg-brandBg flex items-center justify-center">
        <div class="bg-white p-10 md:p-14 rounded-2xl shadow-2xl border-t-4 border-brandGreen w-full max-w-md flex flex-col items-center relative">
            <h1 class="text-4xl font-serif font-bold text-brandDark tracking-widest uppercase mb-1">CENTER</h1>
            <p class="text-xs font-bold text-gray-400 tracking-[0.2em] uppercase mb-10">SİSTEM YÖNETİMİ</p>

            <form class="w-full flex flex-col gap-6" onsubmit="event.preventDefault(); sistemeGirisYap();">
                <div>
                    <label class="block text-[0.65rem] font-bold text-gray-500 uppercase tracking-widest mb-2">E-Posta Adresi</label>
                    <input type="email" id="login-email" name="email" class="w-full bg-transparent border-b-2 border-gray-200 px-2 py-2 text-sm focus:border-brandGreen focus:outline-none transition-colors" placeholder="admin@centercafe.com" required>
                </div>

                <div>
                    <label class="block text-[0.65rem] font-bold text-gray-500 uppercase tracking-widest mb-2">Şifre</label>
                    <input type="password" id="login-pass" name="password" class="w-full bg-transparent border-b-2 border-gray-200 px-2 py-2 text-sm focus:border-brandGreen focus:outline-none transition-colors" placeholder="••••••••" required>
                </div>

                <button type="submit" class="w-full bg-brandGreen text-white py-3.5 rounded-lg font-bold uppercase tracking-widest text-sm hover:bg-brandDark transition-colors shadow-md mt-4 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Giriş Yap
                </button>
            </form>
            <p id="login-error" class="text-xs text-red-500 font-bold text-center mt-4 hidden">Giriş bilgileri hatalı!</p>
        </div>
    </div>

    <!-- ANA YÖNETİM PANELİ -->
    <div id="app-content" class="w-full flex hidden">
        <aside id="admin-sidebar" class="w-64 bg-brandDark text-white flex-col hidden md:flex fixed h-full z-50">
            <div class="p-6 border-b border-white/10 flex items-center gap-3">
                <i class="fa-solid fa-shield-halved text-brandGold text-2xl"></i>
                <div>
                    <h2 class="font-bold tracking-widest uppercase text-sm">Yönetim</h2>
                    <p class="text-[0.65rem] text-gray-400">Center Cafe v2.0</p>
                </div>
            </div>
            <nav class="flex-1 p-4 flex flex-col gap-2 mt-2">
                <button onclick="switchAdmin('dashboard')" id="btn-dashboard" class="admin-tab w-full flex items-center gap-3 px-4 py-3 bg-brandGreen rounded-xl text-sm font-bold transition-all"><i class="fa-solid fa-chart-pie w-5"></i> Özet</button>
                <button onclick="switchAdmin('kategoriler')" id="btn-kategoriler" class="admin-tab w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-sm font-medium transition-all text-gray-300"><i class="fa-solid fa-layer-group w-5"></i> Kategoriler</button>
                <button onclick="switchAdmin('urunler')" id="btn-urunler" class="admin-tab w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-sm font-medium transition-all text-gray-300"><i class="fa-solid fa-burger w-5"></i> Ürün Yönetimi</button>
                <button onclick="switchAdmin('kasa')" id="btn-kasa" class="admin-tab w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-sm font-medium transition-all text-gray-300"><i class="fa-solid fa-cash-register w-5"></i> Kasa & Masalar</button>
                <button onclick="switchAdmin('qrs')" id="btn-qrs" class="admin-tab w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-sm font-medium transition-all text-gray-300"><i class="fa-solid fa-qrcode w-5"></i> QR Kodlar</button>
                <button onclick="switchAdmin('raporlar')" id="btn-raporlar" class="admin-tab w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-sm font-medium transition-all text-gray-300"><i class="fa-solid fa-chart-line w-5"></i> Satış Analizi</button>
                <button onclick="switchAdmin('ayarlar')" id="btn-ayarlar" class="admin-tab w-full flex items-center gap-3 px-4 py-3 hover:bg-white/5 rounded-xl text-sm font-medium transition-all text-gray-300"><i class="fa-solid fa-sliders w-5"></i> Site Ayarları</button>
            </nav>
            <div class="p-4 border-t border-white/10 flex flex-col gap-2">
                <button onclick="sistemdenCikisYap()" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-all"><i class="fa-solid fa-power-off"></i> Çıkış Yap</button>
                <a href="/" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-white/10 hover:bg-brandGold rounded-lg text-xs font-bold transition-all"><i class="fa-solid fa-arrow-right-from-bracket"></i> Siteye Dön</a>
            </div>
        </aside>

        <main class="flex-1 md:ml-64 p-6 md:p-10">
            <header class="flex justify-between items-center mb-8 pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <button onclick="toggleMobileSidebar()" class="md:hidden bg-brandDark text-white w-10 h-10 rounded-xl flex items-center justify-center mr-3">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div>
                        <h1 id="page-title" class="text-3xl font-bold text-brandDark">Hoş Geldiniz</h1>
                        <p class="text-sm text-gray-500 mt-1">Sistem verilerini buradan yönetebilirsiniz.</p>
                    </div>
                </div>
                <button onclick="toggleAdminPanel()" class="bg-brandDark text-white px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-brandGreen transition-all flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-bell"></i> Canlı Bildirimler (<span id="admin-bildirim-sayisi">0</span>)
                </button>
            </header>

            <!-- Canlı Mutfak & Garson Paneli Çekmecesi -->
            <div id="admin-live-panel" class="fixed top-6 right-6 bg-white rounded-3xl p-5 shadow-2xl border-2 border-brandGreen/30 z-[400] w-80 md:w-96 max-h-[80vh] flex flex-col hidden">
                <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-3">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded-full animate-ping"></span>
                        <h3 class="font-serif font-bold text-brandDark uppercase tracking-wide text-sm">Canlı Mutfak & Garson</h3>
                    </div>
                    <button onclick="toggleAdminPanel()" class="text-gray-400 hover:text-red-500 w-7 h-7 flex items-center justify-center rounded-full bg-gray-50"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="overflow-y-auto flex-1 flex flex-col gap-3" id="admin-notifications-container"></div>
            </div>

            <!-- DASHBOARD -->
            <section id="sec-dashboard" class="hidden flex-col gap-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 rounded-full bg-brandGold/10 text-brandGold flex items-center justify-center text-2xl mb-4"><i class="fa-solid fa-stopwatch"></i></div>
                        <h3 class="font-bold text-brandDark text-lg mb-1">Ortalama Yanıt Süresi</h3>
                        <p class="text-xs text-gray-500 mb-3">Garson çağrılarına verilen yanıt hızı</p>
                        <span id="stat-yanit-suresi" class="text-3xl font-black text-brandGreen">Hesaplanıyor...</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-brandDark text-lg mb-4 border-b pb-2">Son Garson Logları</h3>
                        <div id="log-listesi" class="flex flex-col gap-3 max-h-48 overflow-y-auto hide-scroll">
                            <span class="text-sm text-gray-400 italic">Henüz kaydedilen çağrı yok.</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- KATEGORİ YÖNETİMİ -->
            <section id="sec-kategoriler" class="hidden flex-col gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg mb-4"><i class="fa-solid fa-layer-group text-brandGold mr-2"></i> Kategori Yönetimi</h3>
                    <p class="text-sm text-gray-500 mb-6">Sistemdeki menü gruplarını ve ana kategorileri buradan yönetebilirsiniz.</p>
                    
                    <form onsubmit="event.preventDefault(); kategoriEkle();" class="flex flex-col md:flex-row gap-4 mb-6">
                        <input type="text" id="input-yeni-kategori" placeholder="Kategori Adı (Örn: ATISTIRMALIKLAR)" class="flex-1 bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-brandGreen focus:outline-none uppercase font-bold">
                        <select id="input-ust-kategori" class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-brandGreen focus:outline-none font-medium">
                            <option value="">Ana Kategori (Üst Grup Yok)</option>
                            <option value="KAHVALTILAR">KAHVALTILAR</option>
                            <option value="TATLILAR">TATLILAR</option>
                            <option value="SICAK İÇECEKLER">SICAK İÇECEKLER</option>
                            <option value="SOĞUK İÇECEKLER">SOĞUK İÇECEKLER</option>
                            <option value="DONDURMALAR">DONDURMALAR</option>
                            <option value="GÖZLEME & TOST">GÖZLEME & TOST</option>
                        </select>
                        <button type="submit" class="bg-brandGreen text-white px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-brandDark transition-colors shadow-md flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i> Kategori Ekle
                        </button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                                    <th class="p-3">#ID</th>
                                    <th class="p-3">Kategori Adı</th>
                                    <th class="p-3 text-center">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody id="admin-kategori-listesi" class="divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- ÜRÜN YÖNETİMİ -->
            <section id="sec-urunler" class="hidden flex-col gap-6">
                <div class="flex justify-between items-center bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg"><i class="fa-solid fa-burger text-brandGold mr-2"></i> Ürün Listesi ve Ekleme</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 id="form-baslik" class="font-bold mb-4 border-b pb-2">Yeni Yemek / İçecek Ekle</h4>
                    <form class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" onsubmit="event.preventDefault();">
                        <input type="hidden" id="input-urun-id">
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ürün Adı</label>
                            <input type="text" id="input-urun-ad" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none">
                        </div>
                        <div class="relative">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ana Kategori</label>
                            <select id="input-urun-kat" onchange="anaKategoriDegisti()" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none font-medium">
                                <option value="">Seçiniz...</option>
                            </select>
                        </div>
                        <div class="relative">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alt Kategori</label>
                            <select id="input-urun-alt-kat" onchange="altKategoriDegisti()" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none font-medium">
                                <option value="">Önce kategori seçin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Fiyat (₺)</label>
                            <input type="number" id="input-urun-fiyat" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kalori (Kcal)</label>
                            <input type="number" id="input-urun-kalori" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Hazırlanma Süresi (Dk)</label>
                            <input type="number" id="input-urun-sure" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sıralama (Sıra No)</label>
                            <input type="number" id="input-urun-sira" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none" placeholder="Otomatik">
                        </div>
                        <div class="lg:col-span-4">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ürün İçeriği / Açıklaması</label>
                            <textarea id="input-urun-aciklama" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:border-brandGreen focus:outline-none resize-none"></textarea>
                        </div>
                        <div class="lg:col-span-4">
                            <label class="block text-xs font-bold text-red-600 uppercase mb-1"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Alerjen Bilgisi / Uyarı Metni</label>
                            <input type="text" id="input-urun-alerjen" placeholder="Örn: Bu ürün süt ve fındık içerir." class="w-full bg-red-50/50 border border-red-200 rounded-lg px-3 py-2 text-sm focus:border-red-500 focus:outline-none text-red-700">
                        </div>
                        <div class="lg:col-span-3">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ürün Görseli Seç</label>
                            <input type="file" id="input-urun-resim" accept="image/*" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-1.5 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brandGreen file:text-white hover:file:bg-brandDark cursor-pointer">
                        </div>
                        <div class="flex flex-col justify-center items-center bg-gray-50 border border-gray-200 rounded-lg p-2">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Glütensiz Seçeneği</label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="input-urun-gluten" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brandGreen"></div>
                                <span class="ml-3 text-sm font-bold text-brandDark">Glütensiz</span>
                            </label>
                        </div>
                        <div class="lg:col-span-4 flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                            <button type="button" id="btn-iptal" onclick="formuSifirla()" class="hidden bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold text-sm hover:bg-gray-400 transition-colors">İptal</button>
                            <button type="button" onclick="urunKaydetVEYAGuncelle()" class="bg-brandGreen text-white px-10 py-3 rounded-lg font-bold hover:bg-brandDark transition-colors shadow-md flex items-center gap-2 ml-auto">
                                <i class="fa-solid fa-check"></i> <span id="btn-metin">Ürünü Sisteme Ekle</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4 border-b pb-4 gap-4">
                        <h4 class="font-bold text-lg">Kayıtlı Ürünler Listesi</h4>
                        <div class="w-full md:w-72 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 flex items-center">
                            <i class="fa-solid fa-search text-gray-400 mr-2 text-sm"></i>
                            <input type="text" id="admin-urun-arama" placeholder="Ürün adı veya sıra no..." oninput="adminUrunleriFiltrele()" class="w-full bg-transparent outline-none text-sm font-medium">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                                    <th class="p-3">Sıra</th>
                                    <th class="p-3">Görsel</th>
                                    <th class="p-3">Ürün Adı</th>
                                    <th class="p-3">Kategori</th>
                                    <th class="p-3">Fiyat</th>
                                    <th class="p-3 text-center">Stok Durumu</th>
                                    <th class="p-3 text-center">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody id="admin-urun-listesi" class="divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- KASA & MASALAR -->
            <section id="sec-kasa" class="hidden flex-col gap-6">
                <div class="flex justify-between items-center bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg"><i class="fa-solid fa-chair text-brandGold mr-2"></i> Kasa & Masa Yönetimi</h3>
                    <div class="flex gap-2">
                        <button onclick="gunSonuAl()" class="bg-red-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-600 transition-colors shadow-sm flex items-center gap-2"><i class="fa-solid fa-power-off"></i> Gün Sonu Al</button>
                        <button onclick="masaEkleModalAc()" class="bg-brandGreen text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-brandDark transition-colors shadow-sm flex items-center gap-2"><i class="fa-solid fa-plus"></i> Yeni Masa Ekle</button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brandGreen/10 text-brandGreen flex items-center justify-center text-xl font-bold"><i class="fa-solid fa-chair"></i></div>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Toplam Masa</p><h4 id="stat-toplam-masa" class="text-2xl font-black text-brandDark mt-1">0</h4></div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl font-bold"><i class="fa-solid fa-utensils"></i></div>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Dolu / Aktif Masa</p><h4 id="stat-dolu-masa" class="text-2xl font-black text-brandDark mt-1">0</h4></div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brandGold/10 text-brandGold flex items-center justify-center text-xl font-bold"><i class="fa-solid fa-cash-register"></i></div>
                        <div><p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Günlük Kasa Ciro</p><h4 id="stat-ciro" class="text-2xl font-black text-brandDark mt-1">₺0.00</h4></div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-bold mb-4 border-b pb-2 text-sm text-gray-600 uppercase tracking-wide">Masa Durum Takibi</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4" id="masa-grid"></div>
                </div>
            </section>

            <!-- QR KODLAR -->
            <section id="sec-qrs" class="hidden flex-col gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg mb-2"><i class="fa-solid fa-qrcode text-brandGold mr-2"></i> Masa QR Kod Bağlantıları</h3>
                    <p class="text-sm text-gray-500 mb-6">Masaların akıllı menüye bağlanması için gereken dinamik URL ve QR kod listesidir.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="qr-liste-grid"></div>
                </div>
            </section>

            <!-- SATIŞ ANALİZİ -->
            <section id="sec-raporlar" class="hidden flex-col gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg"><i class="fa-solid fa-chart-line text-brandGold mr-2"></i> Gün Sonu Ürün ve Masa Satış Raporu</h3>
                        <button onclick="raporuGuncelle()" class="bg-brandGreen text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-brandDark transition-colors"><i class="fa-solid fa-rotate"></i> Yenile</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                                    <th class="p-3">Masa / İşlem</th>
                                    <th class="p-3">Ödeme Türü</th>
                                    <th class="p-3 text-center">İşlem Adedi</th>
                                    <th class="p-3">Toplam Tutar</th>
                                    <th class="p-3">Zaman</th>
                                    <th class="p-3 text-center">Adisyon</th>
                                </tr>
                            </thead>
                            <tbody id="rapor-tablosu" class="divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- AYARLAR -->
            <section id="sec-ayarlar" class="hidden flex-col gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 max-w-2xl">
                    <h3 class="font-bold text-lg mb-6"><i class="fa-solid fa-sliders text-brandGold mr-2"></i> Vitrin & Kurumsal Ayarlar (White-Label)</h3>
                    <form id="ayarForm" onsubmit="event.preventDefault(); kurumsalAyarKaydet();" class="flex flex-col gap-4" enctype="multipart/form-data">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">İşletme (Şirket) Adı</label>
                            <input type="text" id="input-sirket-adi" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Vitrin Büyük Slogan</label>
                            <input type="text" id="input-slogan" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Vitrin Alt Açıklama Metni</label>
                            <textarea id="input-alt-aciklama" rows="2" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Wi-Fi Şifresi</label>
                            <input type="text" id="input-wifi" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Telefon Numarası</label>
                            <input type="text" id="input-telefon" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Adres</label>
                            <input type="text" id="input-adres" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Google Yorum Linki</label>
                            <input type="text" id="input-yorum-link" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Logo Görseli</label>
                            <input type="file" id="input-logo" accept="image/*" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-1.5 text-sm">
                            <div class="flex items-center gap-2 mt-2">
                                <input type="checkbox" id="input-logo-sil" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded cursor-pointer">
                                <label for="input-logo-sil" class="text-xs font-bold text-red-500 cursor-pointer">Mevcut logoyu kaldır</label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Panel Alt İmza Metni</label>
                            <input type="text" id="input-imza" placeholder="Örn: Mikale Yazılım" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Vitrin Sağ Büyük Görsel Değiştir</label>
                            <input type="file" id="input-vitrin-gorsel" accept="image/*" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-1.5 text-sm">
                            <div class="flex items-center gap-2 mt-2">
                                <input type="checkbox" id="input-gorsel-sil" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded cursor-pointer">
                                <label for="input-gorsel-sil" class="text-xs font-bold text-red-500 cursor-pointer">Mevcut vitrin görselini varsayılana sıfırla / kaldır</label>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mt-2">
                            <h4 class="font-bold text-sm text-brandDark uppercase tracking-wide mb-4"><i class="fa-solid fa-shield-halved text-brandGold mr-2"></i> Güvenlik Ayarları</h4>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Oturum Süresi (Dakika)</label>
                            <input type="number" id="input-guvenlik-suresi" min="1" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm" placeholder="30">
                            <p class="text-[0.65rem] text-gray-400 mt-1">Müşteri QR okuttuktan sonra bu süre dolunca sipariş veremez, tekrar QR okutması istenir.</p>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-lg p-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="input-gps-aktif" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brandGreen"></div>
                                <span class="ml-3 text-sm font-bold text-brandDark">Konum (GPS) Doğrulaması Aktif</span>
                            </label>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Restoran Enlem</label>
                                <input type="text" id="input-gps-enlem" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm" placeholder="Örn: 41.0082">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Restoran Boylam</label>
                                <input type="text" id="input-gps-boylam" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm" placeholder="Örn: 28.9784">
                            </div>
                        </div>
                        <button type="button" onclick="mevcutKonumuAl()" class="bg-brandBlue text-white px-4 py-2 rounded-lg text-xs font-bold self-start hover:opacity-90 transition-opacity flex items-center gap-2 w-fit"><i class="fa-solid fa-location-crosshairs"></i> Şu Anki Konumu Kullan (Restorandayken basın)</button>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Maksimum Mesafe (Metre)</label>
                            <input type="number" id="input-gps-max-mesafe" min="10" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm" placeholder="200">
                        </div>

                        <button type="submit" class="bg-brandGold text-white px-6 py-3 rounded-lg font-bold mt-2 self-start hover:bg-brandGreen transition-colors shadow-md">Değişiklikleri Kaydet</button>
                    </form>
                </div>

                <!-- Şifre Güncelleme Kutusu -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 max-w-2xl mt-6">
                    <h3 class="font-bold text-lg mb-6"><i class="fa-solid fa-key text-brandGold mr-2"></i> Şifre Güncelleme</h3>
                    <form onsubmit="event.preventDefault(); sifreGuncelle();" class="flex flex-col gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Mevcut Şifre</label>
                            <input type="password" id="input-eski-sifre" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Yeni Şifre</label>
                            <input type="password" id="input-yeni-sifre" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Yeni Şifre (Tekrar)</label>
                            <input type="password" id="input-yeni-sifre-tekrar" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <button type="submit" class="bg-brandGreen text-white px-6 py-3 rounded-lg font-bold mt-2 self-start hover:bg-brandDark transition-colors shadow-md">Şifreyi Güncelle</button>
                    </form>
                </div>

                <!-- Yeni Kullanıcı Ekleme Kutusu -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 max-w-2xl mt-6">
                    <h3 class="font-bold text-lg mb-6"><i class="fa-solid fa-user-plus text-brandGold mr-2"></i> Yeni Kullanıcı Ekle</h3>
                    <form onsubmit="event.preventDefault(); yeniKullaniciEkle();" class="flex flex-col gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">İsim</label>
                            <input type="text" id="input-yeni-kullanici-isim" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">E-Posta</label>
                            <input type="email" id="input-yeni-kullanici-email" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Şifre</label>
                            <input type="password" id="input-yeni-kullanici-sifre" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2 text-sm">
                        </div>
                        <button type="submit" class="bg-brandGreen text-white px-6 py-3 rounded-lg font-bold mt-2 self-start hover:bg-brandDark transition-colors shadow-md">Kullanıcı Ekle</button>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <!-- GENEL ONAY / PROMPT MODALI -->
    <div id="app-confirm-modal" class="fixed inset-0 z-[600] bg-brandDark/70 hidden items-center justify-center p-4 backdrop-blur-sm">
      <div class="bg-white rounded-3xl p-6 md:p-8 w-full max-w-sm relative shadow-2xl border-t-4 border-brandGold">
        <h3 id="app-confirm-title" class="text-lg font-bold text-brandDark mb-3">Emin misiniz?</h3>
        <p id="app-confirm-message" class="text-sm text-gray-600 mb-4 whitespace-pre-line"></p>
        <div id="app-confirm-input-wrapper" class="mb-4 hidden">
          <input type="text" id="app-confirm-input" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 font-bold text-brandDark focus:outline-none focus:border-brandGreen">
        </div>
        <div class="flex gap-3">
          <button id="app-confirm-cancel" class="flex-1 bg-gray-100 text-gray-500 py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-gray-200 transition-colors">Vazgeç</button>
          <button id="app-confirm-ok" class="flex-[2] bg-brandGreen text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-brandDark transition-colors shadow-lg">Onayla</button>
        </div>
      </div>
    </div>

    <!-- ADİSYON FİŞİ MODALI -->
    <div id="receipt-modal" class="fixed inset-0 z-[500] bg-brandDark/80 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-gray-100 rounded-lg p-6 w-full max-w-sm relative shadow-2xl slide-up flex flex-col items-center">
            <button onclick="closeReceiptModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full"><i class="fa-solid fa-xmark text-lg"></i></button>
            <div class="bg-white w-full p-6 shadow-md border-t-4 border-b-4 border-dashed border-gray-300 font-mono text-sm text-gray-700 mt-4 relative">
                <div class="text-center mb-4">
                    <h2 class="text-xl font-bold text-black uppercase" id="receipt-title">CENTER CAFE</h2>
                    <p class="text-xs">Lezzetin Merkezi</p>
                    <p class="text-xs mt-1" id="receipt-date">Tarih: --</p>
                    <p class="text-xs" id="receipt-time">Saat: --</p>
                </div>
                <div class="border-b border-dashed border-gray-400 mb-4"></div>
                <div class="flex justify-between font-bold text-black mb-2 uppercase text-lg"><span>Masa:</span><span id="receipt-masa">--</span></div>
                <div class="border-b border-dashed border-gray-400 mb-4"></div>
                <div class="flex justify-between items-center text-lg font-bold text-black mb-1"><span>TOPLAM:</span><span id="receipt-total">₺0.00</span></div>
                <div class="flex justify-between items-center text-xs mb-4 font-bold text-gray-500 uppercase tracking-widest"><span>Ödeme Tür:</span><span id="receipt-type">Nakit</span></div>
                <div class="border-b border-dashed border-gray-400 mb-4"></div>
                <div class="text-center text-xs"><p>Bizi tercih ettiğiniz için</p><p>teşekkür ederiz.</p><p class="mt-2 font-bold text-black">*** MALİ DEĞERİ YOKTUR ***</p></div>
            </div>
            <button onclick="printReceipt()" class="w-full bg-brandDark text-white py-3 rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-brandGreen transition-colors shadow-lg mt-6 flex items-center justify-center gap-2"><i class="fa-solid fa-print"></i> Yazdır & Kapat</button>
        </div>
    </div>

    <script src="js/api.js"></script>
    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F9') {
                e.preventDefault();
                window.location.href = '/mikale-giris-x7k92';
            }
        });

        function appDialog({ title = "Emin misiniz?", message = "", withInput = false, defaultValue = "" }) {
            return new Promise((resolve) => {
                const modal = document.getElementById('app-confirm-modal');
                document.getElementById('app-confirm-title').textContent = title;
                document.getElementById('app-confirm-message').textContent = message;
                const inputWrapper = document.getElementById('app-confirm-input-wrapper');
                const input = document.getElementById('app-confirm-input');

                if (withInput) { inputWrapper.classList.remove('hidden'); input.value = defaultValue; setTimeout(() => input.focus(), 50); }
                else { inputWrapper.classList.add('hidden'); }

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                const okBtn = document.getElementById('app-confirm-ok');
                const cancelBtn = document.getElementById('app-confirm-cancel');

                const cleanup = () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    okBtn.removeEventListener('click', onOk);
                    cancelBtn.removeEventListener('click', onCancel);
                };
                const onOk = () => { cleanup(); resolve(withInput ? (input.value.trim() || null) : true); };
                const onCancel = () => { cleanup(); resolve(withInput ? null : false); };

                okBtn.addEventListener('click', onOk);
                cancelBtn.addEventListener('click', onCancel);
            });
        }

        const appConfirm = (message, title = "Emin misiniz?") => appDialog({ title, message, withInput: false });
        const appPrompt = (message, defaultValue = "", title = "Bilgi Girin") => appDialog({ title, message, withInput: true, defaultValue });

        function showAdminToast(message, color = 'bg-brandGreen') {
            const container = document.getElementById('admin-toast-container');
            if (!container) { console.log(message); return; }
            const toast = document.createElement('div');
            toast.className = `${color} text-white px-6 py-4 rounded-xl shadow-2xl font-bold text-sm flex items-center gap-3 transform transition-all duration-500 translate-x-full pointer-events-auto`;
            toast.innerHTML = `<i class="fa-solid fa-circle-check"></i> ${message}`;
            container.appendChild(toast);
            setTimeout(() => toast.classList.remove('translate-x-full'), 50);
            setTimeout(() => { toast.classList.add('translate-x-full'); setTimeout(() => toast.remove(), 500); }, 3000);
        }

        function checkLoginState() {
            const token = localStorage.getItem('center_admin_token');
            if (token) {
                document.getElementById('login-screen').classList.add('hidden');
                document.getElementById('app-content').classList.remove('hidden');
                baslangicVerileriniYukle();
            } else {
                document.getElementById('login-screen').classList.remove('hidden');
                document.getElementById('app-content').classList.add('hidden');
            }
        }

        function sistemeGirisYap() {
            const email = document.getElementById('login-email').value.trim();
            const pass = document.getElementById('login-pass').value.trim();
            const errorMsg = document.getElementById('login-error');
            if (errorMsg) errorMsg.classList.add('hidden');

            fetch('/api/admin-login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                body: JSON.stringify({ email, password: pass })
            })
            .then(res => res.json())
            .then(data => {
                if (data.durum === 'basarili') {
                    localStorage.setItem('center_admin_token', "Bearer " + data.token);
                    checkLoginState();
                } else {
                    if (errorMsg) {
                        errorMsg.textContent = data.mesaj || "E-posta adresi veya şifre hatalı!";
                        errorMsg.classList.remove('hidden');
                    }
                }
            })
            .catch(() => {
                if (errorMsg) {
                    errorMsg.textContent = "Sunucuya bağlanılamadı!";
                    errorMsg.classList.remove('hidden');
                }
            });
        }

        function sistemdenCikisYap() {
            localStorage.removeItem('center_admin_token');
            checkLoginState();
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkLoginState();
            garsonCagrilariniDinle();
        });

        let adminUrunlerDizisi = [];
        
        function getAuthHeaders() {
            return {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Authorization': localStorage.getItem('center_admin_token') || ''
            };
        }

        function baslangicVerileriniYukle() {
            switchAdmin('urunler');
            urunleriListele();
            renderMasalar();
            raporuGuncelle();
            qrKodlariListele();
            renderAdminNotifications();
            performansLoglariniGuncelle();
            kategoriYapisiniYukleVeDoldur();
            
            fetch('/api/ayarlar', { headers: getAuthHeaders() }).then(res => res.json()).then(data => {
                if(data) {
                    if(document.getElementById('input-sirket-adi')) document.getElementById('input-sirket-adi').value = data.sirket_adi || '';
                    if(document.getElementById('input-slogan')) document.getElementById('input-slogan').value = data.slogan || '';
                    if(document.getElementById('input-alt-aciklama')) document.getElementById('input-alt-aciklama').value = data.alt_aciklama || '';
                    if(document.getElementById('input-wifi')) document.getElementById('input-wifi').value = data.wifi_sifresi || '';
                    if(document.getElementById('input-telefon')) document.getElementById('input-telefon').value = data.telefon || '';
                    if(document.getElementById('input-adres')) document.getElementById('input-adres').value = data.adres || '';
                    if(document.getElementById('input-yorum-link')) document.getElementById('input-yorum-link').value = data.yorum_linki || '';
                    if(document.getElementById('input-imza')) document.getElementById('input-imza').value = data.imza_metni || '';
                    if(document.getElementById('input-guvenlik-suresi')) document.getElementById('input-guvenlik-suresi').value = data.guvenlik_suresi_dk || 30;
                    if(document.getElementById('input-gps-aktif')) document.getElementById('input-gps-aktif').checked = (data.gps_dogrulama_aktif == 1);
                    if(document.getElementById('input-gps-enlem')) document.getElementById('input-gps-enlem').value = data.gps_enlem || '';
                    if(document.getElementById('input-gps-boylam')) document.getElementById('input-gps-boylam').value = data.gps_boylam || '';
                    if(document.getElementById('input-gps-max-mesafe')) document.getElementById('input-gps-max-mesafe').value = data.gps_max_mesafe || 200;
                }
            });
        }

        // Şifre Güncelleme Fonksiyonu
        function sifreGuncelle() {
            const eski = document.getElementById('input-eski-sifre').value;
            const yeni = document.getElementById('input-yeni-sifre').value;
            const tekrar = document.getElementById('input-yeni-sifre-tekrar').value;

            if (!eski || !yeni) { showAdminToast("Lütfen tüm alanları doldurun!", "bg-red-500"); return; }
            if (yeni !== tekrar) { showAdminToast("Yeni şifreler eşleşmiyor!", "bg-red-500"); return; }
            if (yeni.length < 6) { showAdminToast("Yeni şifre en az 6 karakter olmalı!", "bg-red-500"); return; }

            fetch('/api/admin-sifre-guncelle', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Authorization': localStorage.getItem('center_admin_token') || ''
                },
                body: JSON.stringify({ email: 'admin@centercafe.com', eski_sifre: eski, yeni_sifre: yeni })
            })
            .then(res => res.json())
            .then(data => {
                showAdminToast(data.mesaj, data.durum === 'basarili' ? 'bg-brandGreen' : 'bg-red-500');
                if (data.durum === 'basarili') {
                    document.getElementById('input-eski-sifre').value = '';
                    document.getElementById('input-yeni-sifre').value = '';
                    document.getElementById('input-yeni-sifre-tekrar').value = '';
                }
            })
            .catch(() => showAdminToast("Sunucuya bağlanılamadı!", "bg-red-500"));
        }

        function yeniKullaniciEkle() {
            const isim = document.getElementById('input-yeni-kullanici-isim').value.trim();
            const email = document.getElementById('input-yeni-kullanici-email').value.trim();
            const sifre = document.getElementById('input-yeni-kullanici-sifre').value;
            if (!isim || !email || !sifre) { showAdminToast("Lütfen tüm alanları doldurun!", "bg-red-500"); return; }
            if (sifre.length < 6) { showAdminToast("Şifre en az 6 karakter olmalı!", "bg-red-500"); return; }
            fetch('/api/admin-yeni-kullanici', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Authorization': localStorage.getItem('center_admin_token') || ''
                },
                body: JSON.stringify({ name: isim, email: email, password: sifre })
            })
            .then(res => res.json())
            .then(data => {
                showAdminToast(data.mesaj, data.durum === 'basarili' ? 'bg-brandGreen' : 'bg-red-500');
                if (data.durum === 'basarili') {
                    document.getElementById('input-yeni-kullanici-isim').value = '';
                    document.getElementById('input-yeni-kullanici-email').value = '';
                    document.getElementById('input-yeni-kullanici-sifre').value = '';
                }
            })
            .catch(() => showAdminToast("Sunucuya bağlanılamadı!", "bg-red-500"));
        }

        // KATEGORİ YÖNETİMİ
        async function kategorileriListele() {
            try {
                const res = await fetch('/api/kategoriler', { headers: getAuthHeaders() });
                const kategoriler = await res.json();
                const tbody = document.getElementById('admin-kategori-listesi');
                if (!tbody) return;
                
                window.__kategoriListesiCache = kategoriler;

                tbody.innerHTML = '';
                if (!kategoriler || kategoriler.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="3" class="p-4 text-center text-gray-400">Kayıtlı kategori bulunamadı.</td></tr>`;
                    return;
                }

                kategoriler.forEach((kat, index) => {
                    let katAdi = kat.Urungrubu || kat.UrunGrubu || kat.kategori || kat.grup_adi || kat.ad || kat.isim || ('Kategori ' + (index + 1));
                    const katId = kat.id || kat.UrunGrubu_id || (index + 1);

                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-bold text-brandGold">${katId}</td>
                            <td class="p-3 font-bold text-brandDark uppercase">${katAdi}</td>
                            <td class="p-3 text-center flex items-center justify-center gap-2">
                                <button onclick="kategoriSiraDegistir(${index}, -1)" ${index === 0 ? 'disabled class="opacity-30 cursor-not-allowed bg-gray-300 text-white w-8 h-8 rounded-lg text-xs"' : 'class="bg-gray-200 text-brandDark hover:bg-brandGold hover:text-white w-8 h-8 rounded-lg text-xs transition-colors"'}><i class="fa-solid fa-arrow-up"></i></button>
                                <button onclick="kategoriSiraDegistir(${index}, 1)" ${index === kategoriler.length - 1 ? 'disabled class="opacity-30 cursor-not-allowed bg-gray-300 text-white w-8 h-8 rounded-lg text-xs"' : 'class="bg-gray-200 text-brandDark hover:bg-brandGold hover:text-white w-8 h-8 rounded-lg text-xs transition-colors"'}><i class="fa-solid fa-arrow-down"></i></button>
                                <button onclick="kategoriSil(${kat.id || kat.UrunGrubu_id})" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-trash"></i> Sil
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } catch (err) {
                console.error("Kategoriler yüklenemedi:", err);
            }
        }

        async function kategoriSiraDegistir(index, yon) {
            const liste = window.__kategoriListesiCache;
            const hedefIndex = index + yon;
            if (!liste || hedefIndex < 0 || hedefIndex >= liste.length) return;

            [liste[index], liste[hedefIndex]] = [liste[hedefIndex], liste[index]];
            const siraliIdler = liste.map(k => k.id || k.UrunGrubu_id);

            try {
                const res = await fetch('/api/kategori-sirala', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', ...getAuthHeaders() },
                    body: JSON.stringify({ sirali_idler: siraliIdler })
                });
                const data = await res.json();
                showAdminToast(data.mesaj, data.durum === 'basarili' ? 'bg-brandGreen' : 'bg-red-500');
                kategorileriListele();
                kategoriYapisiniYukleVeDoldur();
            } catch (err) {
                showAdminToast("Sıralama güncellenirken hata oluştu!", "bg-red-500");
            }
        }

        async function kategoriEkle() {
            const input = document.getElementById('input-yeni-kategori');
            const ustKatSelect = document.getElementById('input-ust-kategori');
            const grupAdi = input.value.trim();
            const ustKat = ustKatSelect ? ustKatSelect.value : '';

            if (!grupAdi) {
                showAdminToast("Lütfen bir kategori adı girin!", "bg-red-500");
                return;
            }

            try {
                const res = await fetch('/api/kategori-ekle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': localStorage.getItem('center_admin_token') || '',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ grup_adi: grupAdi, ana_grup: ustKat || grupAdi })
                });
                const data = await res.json();
                showAdminToast(data.mesaj, data.durum === 'basarili' ? 'bg-brandGreen' : 'bg-red-500');
                if (data.durum === 'basarili') {
                    input.value = '';
                    if(ustKatSelect) ustKatSelect.value = '';
                    kategorileriListele();
                    kategoriYapisiniYukleVeDoldur();
                }
            } catch (err) {
                showAdminToast("Kategori eklenirken hata oluştu!", "bg-red-500");
            }
        }

        async function kategoriSil(id) {
            const onay = await appConfirm("Bu kategoriyi silmek istediğinize emin misiniz?", "Kategori Sil");
            if (!onay) return;
            try {
                const res = await fetch('/api/kategori-sil/' + id, { method: 'POST', headers: getAuthHeaders() });
                const data = await res.json();
                showAdminToast(data.mesaj);
                kategorileriListele(); kategoriYapisiniYukleVeDoldur();
            } catch (err) { showAdminToast("Silme işlemi başarısız!", "bg-red-500"); }
        }

        let kategoriHiyerarsi = { ana: [], alt: {} };

        async function kategoriYapisiniYukleVeDoldur() {
            try {
                const res = await fetch('/api/kategoriler', { headers: getAuthHeaders() });
                const liste = await res.json();

                kategoriHiyerarsi = { ana: [], alt: {} };
                liste.forEach(k => {
                    const isim = k.Urungrubu || k.UrunGrubu;
                    const anaGrup = k.AnaGrup || isim;
                    if (!isim) return;

                    if (anaGrup === isim) {
                        if (!kategoriHiyerarsi.ana.includes(isim)) kategoriHiyerarsi.ana.push(isim);
                    } else {
                        if (!kategoriHiyerarsi.alt[anaGrup]) kategoriHiyerarsi.alt[anaGrup] = [];
                        if (!kategoriHiyerarsi.alt[anaGrup].includes(isim)) kategoriHiyerarsi.alt[anaGrup].push(isim);
                        if (!kategoriHiyerarsi.ana.includes(anaGrup)) kategoriHiyerarsi.ana.push(anaGrup);
                    }
                });

                const anaSelect = document.getElementById('input-urun-kat');
                if (!anaSelect) return;
                const secili = anaSelect.value;
                anaSelect.innerHTML = '<option value="">Seçiniz...</option>';
                kategoriHiyerarsi.ana.forEach(ad => {
                    anaSelect.innerHTML += `<option value="${ad}">${ad}</option>`;
                });
                anaSelect.innerHTML += `<option value="__yeni_ana__" class="text-brandGreen font-bold">+ YENİ KATEGORİ EKLE</option>`;
                if (secili && kategoriHiyerarsi.ana.includes(secili)) anaSelect.value = secili;
            } catch (err) {
                console.error("Kategori yapısı yüklenemedi:", err);
            }
        }

        async function anaKategoriDegisti() {
            const anaSelect = document.getElementById('input-urun-kat');
            const altSelect = document.getElementById('input-urun-alt-kat');
            const secilen = anaSelect.value;

            if (secilen === '__yeni_ana__') {
                const yeniAd = await appPrompt("Yeni ana kategori adını girin:", "", "Yeni Kategori");
                if (yeniAd && yeniAd.trim()) {
                    const temizAd = yeniAd.trim().toUpperCase();
                    await kategoriEkleOtomatik(temizAd, temizAd);
                    await kategoriYapisiniYukleVeDoldur();
                    anaSelect.value = temizAd;
                } else {
                    anaSelect.value = '';
                }
            }

            const anaKat = anaSelect.value;
            altSelect.innerHTML = '<option value="">Önce kategori seçin</option>';
            if (!anaKat || anaKat === '__yeni_ana__') return;

            altSelect.innerHTML = `<option value="${anaKat}">${anaKat} (Genel)</option>`;
            (kategoriHiyerarsi.alt[anaKat] || []).forEach(alt => {
                altSelect.innerHTML += `<option value="${alt}">${alt}</option>`;
            });
            altSelect.innerHTML += `<option value="__yeni_alt__" class="text-brandGreen font-bold">+ YENİ ALT KATEGORİ EKLE</option>`;
        }

        async function altKategoriDegisti() {
            const altSelect = document.getElementById('input-urun-alt-kat');
            const anaKat = document.getElementById('input-urun-kat').value;
            if (altSelect.value === '__yeni_alt__') {
                const yeniAlt = await appPrompt("Yeni alt kategori adını girin:", "", "Yeni Alt Kategori");
                if (yeniAlt && yeniAlt.trim()) {
                    const temizAlt = yeniAlt.trim().toUpperCase();
                    await kategoriEkleOtomatik(temizAlt, anaKat);
                    await kategoriYapisiniYukleVeDoldur();
                    
                    altSelect.innerHTML = `<option value="${anaKat}">${anaKat} (Genel)</option>`;
                    (kategoriHiyerarsi.alt[anaKat] || []).forEach(alt => {
                        altSelect.innerHTML += `<option value="${alt}">${alt}</option>`;
                    });
                    altSelect.innerHTML += `<option value="__yeni_alt__" class="text-brandGreen font-bold">+ YENİ ALT KATEGORİ EKLE</option>`;
                    altSelect.value = temizAlt;
                } else {
                    altSelect.value = anaKat;
                }
            }
        }

        async function kategoriEkleOtomatik(grupAdi, anaGrup) {
            await fetch('/api/kategori-ekle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': localStorage.getItem('center_admin_token') || '',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ grup_adi: grupAdi, ana_grup: anaGrup })
            });
        }

        async function urunleriListele() {
            const urunler = await dbdenUrunleriGetir();
            adminUrunlerDizisi = urunler;
            tabloyuDoldur(adminUrunlerDizisi);
        }

        function tabloyuDoldur(liste) {
            const tbody = document.getElementById('admin-urun-listesi');
            tbody.innerHTML = '';
            if(liste.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="p-4 text-center text-gray-400">Kayıtlı ürün bulunamadı.</td></tr>`;
                return;
            }
            let tukenenler = JSON.parse(localStorage.getItem('center_tukenen_urunler')) || [];
            liste.forEach((u, i) => {
                const gorsel = u.resim_url ? u.resim_url : 'https://images.unsplash.com/photo-1544025162-d76694265947?w=100&h=100&fit=crop';
                const isTukendi = tukenenler.includes(u.UrunAd);
                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 font-bold text-brandGold">${i + 1}</td>
                        <td class="p-3"><img src="${gorsel}" class="w-12 h-12 object-cover rounded-lg shadow-sm"></td>
                        <td class="p-3 font-bold text-brandDark">${u.UrunAd}</td>
                        <td class="p-3 text-gray-500 text-xs uppercase font-semibold">${u.UrunGrubu || '-'}</td>
                        <td class="p-3 font-black text-brandGreen">₺${u.FixFiyat || '0.00'}</td>
                        <td class="p-3 text-center">
                            <button onclick="stokDurumunuDegistir('${u.UrunAd}')" class="${isTukendi ? 'bg-red-500 text-white' : 'bg-emerald-100 text-emerald-700'} px-3 py-1 rounded-full text-xs font-bold transition-colors">
                                ${isTukendi ? '❌ Tükendi' : '✔ Stokta'}
                            </button>
                        </td>
                        <td class="p-3 text-center flex items-center justify-center gap-2">
                            <button onclick="urunDuzenleBaslat(${u.id})" class="bg-amber-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-amber-600 transition-colors shadow-sm"><i class="fa-solid fa-pen"></i> Düzenle</button>
                            <button onclick="urunSil(${u.id})" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600 transition-colors shadow-sm"><i class="fa-solid fa-trash"></i> Sil</button>
                        </td>
                    </tr>
                `;
            });
        }

        function stokDurumunuDegistir(urunAd) {
            let tukenenler = JSON.parse(localStorage.getItem('center_tukenen_urunler')) || [];
            const index = tukenenler.indexOf(urunAd);
            if (index > -1) { tukenenler.splice(index, 1); } else { tukenenler.push(urunAd); }
            localStorage.setItem('center_tukenen_urunler', JSON.stringify(tukenenler));
            tabloyuDoldur(adminUrunlerDizisi);
        }

        function adminUrunleriFiltrele() {
            const aramaVal = document.getElementById('admin-urun-arama').value.trim().toLocaleUpperCase('tr-TR');
            if(!aramaVal) { tabloyuDoldur(adminUrunlerDizisi); return; }
            const filtrelenmis = adminUrunlerDizisi.filter(u => {
                const ad = (u.UrunAd || "").toLocaleUpperCase('tr-TR');
                const indexStr = String(adminUrunlerDizisi.indexOf(u) + 1);
                const orjSira = String(u.Sira || u.sira || '');
                return ad.includes(aramaVal) || indexStr === aramaVal || orjSira === aramaVal;
            });
            tabloyuDoldur(filtrelenmis);
        }

        function urunKaydetVEYAGuncelle() {
            const id = document.getElementById('input-urun-id').value;
            if(id) { urunGuncelleIsteği(id); } else { urunKaydet(); }
        }

        async function urunKaydet() {
            const ad = document.getElementById('input-urun-ad').value;
            const fiyat = document.getElementById('input-urun-fiyat').value;
            let sira = document.getElementById('input-urun-sira').value;
            if(!sira || sira.trim() === '') sira = adminUrunlerDizisi.length + 1;
            const aciklama = document.getElementById('input-urun-aciklama').value;
            const alerjen = document.getElementById('input-urun-alerjen').value;
            const kalori = document.getElementById('input-urun-kalori').value;
            const sure = document.getElementById('input-urun-sure').value;
            const glutensiz = document.getElementById('input-urun-gluten').checked ? 1 : 0;
            const resimDosyasi = document.getElementById('input-urun-resim').files[0];
            
            const anaKategori = document.getElementById('input-urun-kat').value;
            const altKategori = document.getElementById('input-urun-alt-kat').value;
            const kaydedilecekKategori = altKategori && altKategori !== anaKategori && altKategori !== '' ? altKategori : anaKategori;
            
            if(!ad || !fiyat || !anaKategori) { showAdminToast("Lütfen ürün adı, kategori ve fiyat bilgilerini eksiksiz doldurun!", "bg-red-500"); return; }

            const formData = new FormData();
            formData.append('ad', ad);
            formData.append('kategori', kaydedilecekKategori);
            formData.append('fiyat', fiyat);
            formData.append('sira', sira);
            formData.append('aciklama', aciklama);
            formData.append('alerjen', alerjen);
            formData.append('kalori', kalori);
            formData.append('sure', sure);
            formData.append('is_gluten_free', glutensiz);
            if (resimDosyasi) { formData.append('resim', resimDosyasi); }

            const sonuc = await dbyeUrunEkle(formData);
            if(sonuc.status === 'success' || sonuc.durum === 'basarili') {
                showAdminToast(sonuc.message || sonuc.mesaj || "Ürün başarıyla eklendi!");
                formuSifirla();
                urunleriListele(); 
            } else {
                showAdminToast("Hata: " + (sonuc.message || sonuc.mesaj || "İşlem başarısız"), "bg-red-500");
            }
        }

        function urunDuzenleBaslat(id) {
            const u = adminUrunlerDizisi.find(item => item.id == id);
            if(!u) return;
            document.getElementById('input-urun-id').value = u.id;
            document.getElementById('input-urun-ad').value = u.UrunAd || '';
            document.getElementById('input-urun-fiyat').value = u.FixFiyat || '';
            document.getElementById('input-urun-sira').value = u.Sira || u.sira || 1;
            document.getElementById('input-urun-aciklama').value = u.aciklama || '';
            document.getElementById('input-urun-alerjen').value = u.alerjen || '';
            document.getElementById('input-urun-kalori').value = u.kalori || '';
            document.getElementById('input-urun-sure').value = u.sure || '';
            document.getElementById('input-urun-gluten').checked = (u.is_gluten_free == 1);
            
            const grup = u.UrunGrubu || '';
            let foundAna = '';
            for (let ana in kategoriHiyerarsi.alt) {
                if (kategoriHiyerarsi.alt[ana].includes(grup)) {
                    foundAna = ana;
                    break;
                }
            }
            if (!foundAna && kategoriHiyerarsi.ana.includes(grup)) {
                foundAna = grup;
            }

            if (foundAna) {
                document.getElementById('input-urun-kat').value = foundAna;
                anaKategoriDegisti();
                document.getElementById('input-urun-alt-kat').value = grup;
            } else {
                document.getElementById('input-urun-kat').value = grup;
            }

            document.getElementById('form-baslik').textContent = "Ürün Bilgilerini Güncelle (ID: " + u.id + ")";
            document.getElementById('btn-metin').textContent = "Değişiklikleri Kaydet";
            document.getElementById('btn-iptal').classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function urunGuncelleIsteği(id) {
            const ad = document.getElementById('input-urun-ad').value;
            const fiyat = document.getElementById('input-urun-fiyat').value;
            const sira = document.getElementById('input-urun-sira').value || 1;
            const aciklama = document.getElementById('input-urun-aciklama').value;
            const alerjen = document.getElementById('input-urun-alerjen').value;
            const kalori = document.getElementById('input-urun-kalori').value;
            const sure = document.getElementById('input-urun-sure').value;
            const glutensiz = document.getElementById('input-urun-gluten').checked ? 1 : 0;
            const resimDosyasi = document.getElementById('input-urun-resim').files[0];
            
            const anaKategori = document.getElementById('input-urun-kat').value;
            const altKategori = document.getElementById('input-urun-alt-kat').value;
            const kaydedilecekKategori = altKategori && altKategori !== anaKategori && altKategori !== '' ? altKategori : anaKategori;
            
            const formData = new FormData();
            formData.append('ad', ad); 
            formData.append('kategori', kaydedilecekKategori); 
            formData.append('fiyat', fiyat); 
            formData.append('sira', sira); 
            formData.append('aciklama', aciklama); 
            formData.append('alerjen', alerjen); 
            formData.append('kalori', kalori); 
            formData.append('sure', sure); 
            formData.append('is_gluten_free', glutensiz);
            if (resimDosyasi) formData.append('resim', resimDosyasi);
            
            fetch('/api/urun-guncelle/' + id, { method: 'POST', headers: getAuthHeaders(), body: formData })
            .then(res => res.json()).then(data => { showAdminToast(data.mesaj); formuSifirla(); urunleriListele(); }).catch(err => showAdminToast("Güncelleme hatası!", "bg-red-500"));
        }

        async function urunSil(id) {
            const onay = await appConfirm("Bu ürünü silmek istediğinize emin misiniz?", "Ürünü Sil");
            if (!onay) return;
            fetch('/api/urun-sil/' + id, { method: 'POST', headers: getAuthHeaders() })
              .then(res => res.json()).then(data => { showAdminToast(data.mesaj); urunleriListele(); })
              .catch(() => showAdminToast("Silme hatası!", "bg-red-500"));
        }

        function formuSifirla() {
            document.getElementById('input-urun-id').value = ''; 
            document.getElementById('input-urun-ad').value = ''; 
            document.getElementById('input-urun-fiyat').value = ''; 
            document.getElementById('input-urun-sira').value = ''; 
            document.getElementById('input-urun-aciklama').value = ''; 
            document.getElementById('input-urun-alerjen').value = ''; 
            document.getElementById('input-urun-kalori').value = ''; 
            document.getElementById('input-urun-sure').value = ''; 
            document.getElementById('input-urun-resim').value = ''; 
            document.getElementById('input-urun-gluten').checked = false; 
            document.getElementById('input-urun-kat').value = '';
            document.getElementById('input-urun-alt-kat').innerHTML = '<option value="">Önce kategori seçin</option>';
            document.getElementById('form-baslik').textContent = "Yeni Yemek / İçecek Ekle"; 
            document.getElementById('btn-metin').textContent = "Ürünü Sisteme Ekle"; 
            document.getElementById('btn-iptal').classList.add('hidden');
        }

        function mevcutKonumuAl() {
            if (!navigator.geolocation) { showAdminToast("Tarayıcınız konum özelliğini desteklemiyor!", "bg-red-500"); return; }
            navigator.geolocation.getCurrentPosition(
                (pos) => {
                    document.getElementById('input-gps-enlem').value = pos.coords.latitude;
                    document.getElementById('input-gps-boylam').value = pos.coords.longitude;
                    showAdminToast("Konum alındı, kaydetmeyi unutmayın!");
                },
                () => showAdminToast("Konum alınamadı, tarayıcı izni kontrol edin!", "bg-red-500")
            );
        }

        function kurumsalAyarKaydet() {
            const formData = new FormData();
            formData.append('sirket_adi', document.getElementById('input-sirket-adi').value);
            formData.append('slogan', document.getElementById('input-slogan').value);
            formData.append('alt_aciklama', document.getElementById('input-alt-aciklama').value);
            formData.append('wifi_sifresi', document.getElementById('input-wifi').value);
            formData.append('telefon', document.getElementById('input-telefon').value);
            formData.append('adres', document.getElementById('input-adres').value);
            formData.append('yorum_linki', document.getElementById('input-yorum-link').value);
            formData.append('imza_metni', document.getElementById('input-imza').value);
            formData.append('guvenlik_suresi_dk', document.getElementById('input-guvenlik-suresi').value || 30);
            formData.append('gps_dogrulama_aktif', document.getElementById('input-gps-aktif').checked ? '1' : '0');
            formData.append('gps_enlem', document.getElementById('input-gps-enlem').value);
            formData.append('gps_boylam', document.getElementById('input-gps-boylam').value);
            formData.append('gps_max_mesafe', document.getElementById('input-gps-max-mesafe').value || 200);

            const gorselSil = document.getElementById('input-gorsel-sil').checked;
            formData.append('gorsel_sil', gorselSil ? '1' : '0');
            const gorselFile = document.getElementById('input-vitrin-gorsel').files[0];
            if (gorselFile) formData.append('vitrin_gorsel', gorselFile);

            const logoSil = document.getElementById('input-logo-sil').checked;
            formData.append('logo_sil', logoSil ? '1' : '0');
            const logoFile = document.getElementById('input-logo').files[0];
            if (logoFile) formData.append('logo', logoFile);

            fetch('/api/ayarlar-guncelle', {
                method: 'POST',
                headers: {
                    'Authorization': localStorage.getItem('center_admin_token') || '',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                showAdminToast(data.mesaj);
            })
            .catch(err => showAdminToast("Ayarlar güncellenirken hata oluştu!", "bg-red-500"));
        }

        function switchAdmin(tab) {
            document.querySelectorAll('main > section').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('main > section').forEach(el => el.classList.remove('flex'));
            document.querySelectorAll('.admin-tab').forEach(el => { el.classList.remove('bg-brandGreen', 'text-white'); el.classList.add('hover:bg-white/5', 'text-gray-300'); });
            const activeSection = document.getElementById('sec-' + tab);
            if(activeSection) { activeSection.classList.remove('hidden'); activeSection.classList.add('flex'); }
            const activeBtn = document.getElementById('btn-' + tab);
            if(activeBtn) { activeBtn.classList.add('bg-brandGreen', 'text-white'); activeBtn.classList.remove('hover:bg-white/5', 'text-gray-300'); }

            const titles = { 'dashboard': 'Hoş Geldiniz', 'kategoriler': 'Kategori Yönetimi', 'urunler': 'Ürün ve Menü Yönetimi', 'kasa': 'Kasa & Masalar', 'qrs': 'QR Kodlar', 'raporlar': 'Satış Analizi', 'ayarlar': 'Site Ayarları' };
            document.getElementById('page-title').innerText = titles[tab] || 'Yönetim';

            if(tab === 'raporlar') { raporuGuncelle(); }
            if(tab === 'qrs') { qrKodlariListele(); }
            if(tab === 'urunler') { renderAdminNotifications(); }
            if(tab === 'kategoriler') { kategorileriListele(); }
            if(tab === 'kasa') { renderMasalar(); }

            if (window.innerWidth < 768) {
                document.getElementById('admin-sidebar').classList.add('hidden');
                document.getElementById('admin-sidebar').classList.remove('flex');
            }
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('flex');
        }

        function toggleAdminPanel() {
            const panel = document.getElementById('admin-live-panel');
            panel.classList.toggle('hidden');
            panel.classList.toggle('flex');
            renderAdminNotifications();
        }

        function renderAdminNotifications() {
            const container = document.getElementById('admin-notifications-container');
            const badgeCount = document.getElementById('admin-bildirim-sayisi');
            if (!container || !badgeCount) return;
            container.innerHTML = '';
            
            fetch('/api/admin/garson-cagrilari', { headers: getAuthHeaders() })
                .then(res => res.json())
                .then(data => {
                    let garsonCagrilari = (data && data.success && data.cagrilar) ? data.cagrilar : [];
                    let gelenSiparisler = JSON.parse(localStorage.getItem('center_gelen_siparisler')) || [];

                    const toplamBildirim = garsonCagrilari.length + gelenSiparisler.length;
                    badgeCount.textContent = toplamBildirim;

                    if(toplamBildirim === 0) {
                        container.innerHTML = `<div class="py-8 text-center text-gray-400 text-xs font-bold uppercase tracking-wider">Aktif bildirim bulunmuyor.</div>`;
                        return;
                    }

                    garsonCagrilari.forEach((cagri) => {
                        container.innerHTML += `
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-3 rounded-r-xl flex justify-between items-center shadow-sm">
                                <div>
                                    <span class="text-[10px] font-bold text-amber-600 uppercase tracking-widest block">🔔 Garson Çağrısı</span>
                                    <h5 class="font-bold text-brandDark text-sm">${cagri.masa_ismi || ('Masa ' + cagri.masa_id)}</h5>
                                    <span class="text-[10px] text-gray-500">${cagri.cagri_tipi === 'hesap_iste' ? 'Hesap İstiyor' : 'Garson İstiyor'}</span>
                                </div>
                                <span class="bg-amber-500 text-white px-2.5 py-1 rounded-lg text-xs font-bold">Yeni</span>
                            </div>
                        `;
                    });

                    gelenSiparisler.forEach((siparis, index) => {
                        let urunListesiHtml = siparis.urunler.map(u => `<li>${u.adet}x ${u.UrunAd}</li>`).join('');
                        let durum = siparis.durum || '1';
                        container.innerHTML += `
                            <div class="bg-emerald-50 border-l-4 border-brandGreen p-3 rounded-r-xl flex flex-col gap-2 shadow-sm">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="text-[10px] font-bold text-brandGreen uppercase tracking-widest block">🛒 Yeni Sipariş</span>
                                        <h5 class="font-bold text-brandDark text-sm">Masa ${siparis.masa_no}</h5>
                                    </div>
                                    <span class="font-black text-brandGreen text-sm">₺${parseFloat(siparis.toplam_tutar).toFixed(2)}</span>
                                </div>
                                <ul class="text-xs text-gray-700 list-disc list-inside bg-white p-2 rounded-lg border border-gray-100">${urunListesiHtml}</ul>
                                <div class="flex gap-2 mt-2">
                                    <button onclick="siparisHazirlaniyor(${index})" class="flex-1 ${durum === '2' ? 'bg-brandGold' : 'bg-brandGold/50 hover:bg-brandGold'} text-white py-2 rounded text-xs font-bold transition-colors shadow-sm">Hazırlanıyor</button>
                                    <button onclick="siparisServisEdildi(${index})" class="flex-1 bg-brandGreen hover:bg-brandDark text-white py-2 rounded text-xs font-bold transition-colors shadow-sm">Servis Edildi</button>
                                </div>
                            </div>
                        `;
                    });
                }).catch(() => {});
        }

        function siparisHazirlaniyor(index) {
            let list = JSON.parse(localStorage.getItem('center_gelen_siparisler')) || [];
            if(list[index]) {
                list[index].durum = '2';
                localStorage.setItem('center_gelen_siparisler', JSON.stringify(list));
                localStorage.setItem('center_siparis_durumu', '2');
                renderAdminNotifications();
            }
        }

        function siparisServisEdildi(index) {
            let list = JSON.parse(localStorage.getItem('center_gelen_siparisler')) || [];
            localStorage.setItem('center_siparis_durumu', '3');
            list.splice(index, 1);
            localStorage.setItem('center_gelen_siparisler', JSON.stringify(list));
            renderAdminNotifications();
        }

        async function qrKodlariListele() {
            const grid = document.getElementById('qr-liste-grid');
            if(!grid) return;
            grid.innerHTML = '';
            try {
                const res = await fetch('/api/admin/masalar', { headers: getAuthHeaders() });
                const data = await res.json();
                const masalarListesi = (data && data.success && data.masalar) ? data.masalar : [];
                
                if(masalarListesi.length === 0) {
                    grid.innerHTML = `<div class="col-span-full py-8 text-center text-gray-400 text-xs font-bold uppercase">Kayıtlı masa bulunamadı.</div>`;
                    return;
                }

                masalarListesi.forEach(masa => {
                    const url = `${window.location.origin}/?masa=${masa.isim}`;
                    grid.innerHTML += `
                        <div class="bg-brandBg border border-gray-200 rounded-2xl p-4 flex flex-col items-center gap-3 shadow-sm">
                            <div class="flex justify-between items-center w-full">
                                <span class="font-bold text-brandDark text-base"><i class="fa-solid fa-chair text-brandGreen mr-2"></i>${masa.isim}</span>
                                <span class="text-xs bg-brandGold/20 text-brandGold font-bold px-2.5 py-1 rounded-full">Aktif QR</span>
                            </div>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(url)}" alt="QR - ${masa.isim}" class="w-32 h-32 md:w-36 md:h-36 rounded-lg border border-gray-200 bg-white p-1">
                            <div class="bg-white w-full p-3 rounded-xl border border-gray-200 flex items-center justify-between">
                                <input type="text" readonly value="${url}" class="text-xs text-gray-600 bg-transparent outline-none w-full select-all font-mono">
                            </div>
                            <a href="/?masa=${masa.isim}" target="_blank" class="w-full bg-brandGreen text-white text-center py-2 rounded-xl text-xs font-bold hover:bg-brandDark transition-colors">
                                <i class="fa-solid fa-external-link-alt mr-1"></i> Masaya Git (Test Et)
                            </a>
                        </div>
                    `;
                });
            } catch (err) {
                console.error("QR listesi alınamadı:", err);
            }
        }

        function openReceiptModal(masa, tutar, tur, zaman) {
            document.getElementById('receipt-masa').textContent = masa;
            document.getElementById('receipt-total').textContent = `₺${parseFloat(tutar).toFixed(2)}`;
            document.getElementById('receipt-type').textContent = tur;
            let d = new Date();
            document.getElementById('receipt-date').textContent = `Tarih: ${d.toLocaleDateString('tr-TR')}`;
            document.getElementById('receipt-time').textContent = `Saat: ${zaman}`;
            const sirket = document.getElementById('input-sirket-adi') ? document.getElementById('input-sirket-adi').value : 'CENTER CAFE';
            document.getElementById('receipt-title').textContent = sirket || 'CENTER CAFE';
            document.getElementById('receipt-modal').classList.remove('hidden');
            document.getElementById('receipt-modal').classList.add('flex');
        }

        function closeReceiptModal() {
            document.getElementById('receipt-modal').classList.add('hidden');
            document.getElementById('receipt-modal').classList.remove('flex');
        }

        function printReceipt() {
            const btn = document.querySelector('#receipt-modal button.bg-brandDark');
            const orj = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Yazdırılıyor...';
            setTimeout(() => { btn.innerHTML = orj; closeReceiptModal(); }, 1000);
        }

        function raporuGuncelle() {
            let islemler = JSON.parse(localStorage.getItem('center_gunluk_islemler')) || [];
            const tbody = document.getElementById('rapor-tablosu');
            if(!tbody) return;
            tbody.innerHTML = '';
            if(islemler.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="p-4 text-center text-gray-400">Bugüne ait kapatılan masa veya satış kaydı bulunamadı.</td></tr>`;
                return;
            }
            islemler.forEach(item => {
                const badgeColor = item.tur === 'Nakit' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800';
                tbody.innerHTML += `
                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                        <td class="p-3 font-bold text-brandDark">${item.masa}</td>
                        <td class="p-3"><span class="${badgeColor} text-xs font-bold px-2.5 py-1 rounded-full uppercase">${item.tur}</span></td>
                        <td class="p-3 text-center font-medium">1 Adet</td>
                        <td class="p-3 font-black text-brandGreen">₺${item.tutar.toFixed(2)}</td>
                        <td class="p-3 text-gray-500 text-xs">${item.zaman}</td>
                        <td class="p-3 text-center">
                            <button onclick="openReceiptModal('${item.masa}', ${item.tutar}, '${item.tur}', '${item.zaman}')" class="bg-gray-200 text-gray-700 hover:bg-brandGold hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors shadow-sm"><i class="fa-solid fa-receipt"></i> Fiş Görüntüle</button>
                        </td>
                    </tr>
                `;
            });
        }
        
        async function renderMasalar() {
            const grid = document.getElementById('masa-grid');
            if(!grid) return;
            try {
                const res = await fetch('/api/admin/masalar', { headers: getAuthHeaders() });
                const data = await res.json();
                const masalarListesi = (data && data.success && data.masalar) ? data.masalar : [];

                grid.innerHTML = '';
                let doluSayisi = 0; 
                let ciro = 0;

                if (masalarListesi.length === 0) {
                    grid.innerHTML = `<div class="col-span-full py-8 text-center text-gray-400 text-xs font-bold uppercase">Kayıtlı masa bulunamadı.</div>`;
                }

                masalarListesi.forEach((masa) => {
                    const isDolu = (masa.durum == 1);
                    const tutar = parseFloat(masa.guncel_tutar || 0);
                    if (isDolu) { doluSayisi++; ciro += tutar; }

                    const bgClass = !isDolu ? 'bg-brandBg border-brandGreen/30 hover:border-brandGreen' : 'bg-amber-50 border-amber-400/50 hover:border-amber-500';
                    const iconColor = !isDolu ? 'text-brandGreen' : 'text-amber-500';
                    const badgeClass = !isDolu ? 'bg-brandGreen' : 'bg-amber-500';
                    const badgeText = !isDolu ? 'Boş' : `Dolu (₺${tutar})`;

                    grid.innerHTML += `
                        <div class="${bgClass} border-2 rounded-2xl p-4 flex flex-col items-center justify-center gap-2 relative transition-all shadow-sm group">
                            <button onclick="masaSil(${masa.id})" class="absolute top-2 right-2 text-gray-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity"><i class="fa-solid fa-trash text-xs"></i></button>
                            <div class="cursor-pointer flex flex-col items-center gap-2 w-full" onclick="masaDurumDegistir(${masa.id}, ${isDolu ? 1 : 0}, ${tutar}, '${masa.isim}')">
                                <i class="fa-solid fa-chair text-2xl ${iconColor}"></i>
                                <span class="font-bold text-brandDark text-sm text-center line-clamp-1">${masa.isim}</span>
                                <span class="${badgeClass} text-white text-[0.6rem] px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider">${badgeText}</span>
                            </div>
                        </div>
                    `;
                });

                const statToplam = document.getElementById('stat-toplam-masa'); 
                const statDolu = document.getElementById('stat-dolu-masa'); 
                const statCiro = document.getElementById('stat-ciro');
                if(statToplam) statToplam.textContent = masalarListesi.length; 
                if(statDolu) statDolu.textContent = doluSayisi; 
                if(statCiro) statCiro.textContent = `₺${ciro.toLocaleString('tr-TR')}`;
            } catch (err) {
                console.error("Masalar yüklenemedi:", err);
            }
        }

        async function masaDurumDegistir(id, durum, mevcutTutar, isim) {
            if (durum === 0) {
                const tutar = await appPrompt(`${isim} müşterilere açılacak. Başlangıç tutarını girin (₺):`, "0", "Masa Aç");
                if (tutar !== null) {
                    try {
                        const res = await fetch(`/api/admin/masalar/${id}/durum`, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', ...getAuthHeaders() },
                            body: JSON.stringify({ tutar: parseFloat(tutar) || 0 })
                        });
                        const data = await res.json();
                        if(data.success) { renderMasalar(); showAdminToast("Masa açıldı."); }
                        else { showAdminToast("İşlem başarısız!", "bg-red-500"); }
                    } catch(e) { showAdminToast("Bağlantı hatası!", "bg-red-500"); }
                }
            } else {
                const odemeTuru = await appPrompt(`${isim} hesabı kapatılıyor.\n1 -> Nakit\n2 -> Kredi Kartı`, "1", "Ödeme Türü");
                if (odemeTuru !== null) {
                    const turMetni = (odemeTuru === '2') ? 'Kredi Kartı' : 'Nakit';
                    const onay = await appConfirm(`${isim} için ₺${mevcutTutar} tutar ${turMetni} olarak kapatılıp masa boşaltılsın mı?`, "Hesabı Kapat");
                    if (onay) {
                        try {
                            const res = await fetch(`/api/admin/masalar/${id}/durum`, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', ...getAuthHeaders() },
                                body: JSON.stringify({ odeme_turu: turMetni })
                            });
                            const data = await res.json();
                            if(data.success) {
                                let gunlukIslemler = JSON.parse(localStorage.getItem('center_gunluk_islemler')) || [];
                                gunlukIslemler.push({ masa: isim, tutar: mevcutTutar, tur: turMetni, zaman: new Date().toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' }) });
                                localStorage.setItem('center_gunluk_islemler', JSON.stringify(gunlukIslemler));
                                renderMasalar(); 
                                raporuGuncelle();
                                showAdminToast("Hesap kapatıldı ve Z-raporuna işlendi.");
                            } else { showAdminToast("İşlem başarısız!", "bg-red-500"); }
                        } catch(e) { showAdminToast("Bağlantı hatası!", "bg-red-500"); }
                    }
                }
            }
        }

        async function masaEkleModalAc() { 
            const ad = await appPrompt("Yeni masanın adını veya numarasını girin (Örn: Bahçe 1):", "", "Yeni Masa Ekle"); 
            if (ad && ad.trim() !== '') {
                try {
                    const res = await fetch('/api/admin/masalar', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', ...getAuthHeaders() },
                        body: JSON.stringify({ isim: ad.trim() })
                    });
                    const data = await res.json();
                    if(data.success) { renderMasalar(); qrKodlariListele(); showAdminToast("Masa başarıyla eklendi."); }
                    else { showAdminToast(data.message || "Masa eklenemedi!", "bg-red-500"); }
                } catch(e) { showAdminToast("Bağlantı hatası!", "bg-red-500"); }
            } 
        }

        async function masaSil(id) { 
            const onay = await appConfirm("Bu masayı sistemden silmek istediğinize emin misiniz?", "Masayı Sil");
            if (onay) {
                try {
                    const res = await fetch(`/api/admin/masalar/${id}`, { method: 'DELETE', headers: getAuthHeaders() });
                    const data = await res.json();
                    if(data.success) { renderMasalar(); qrKodlariListele(); showAdminToast("Masa silindi."); }
                    else { showAdminToast("Masa silinemedi!", "bg-red-500"); }
                } catch(e) { showAdminToast("Bağlantı hatası!", "bg-red-500"); }
            } 
        }

        async function gunSonuAl() {
            const onay = await appConfirm("DİKKAT: Tüm masalar boşaltılacak ve sistem gün sonu işlemi gerçekleştirilecek. Emin misiniz?", "Gün Sonu Al");
            if (onay) {
                try {
                    const res = await fetch('/api/admin/gun-sonu', { method: 'POST', headers: getAuthHeaders() });
                    const data = await res.json();
                    if(data.success) {
                        localStorage.setItem('center_garson_cagrilari', JSON.stringify([]));
                        localStorage.setItem('center_gunluk_islemler', JSON.stringify([]));
                        localStorage.setItem('center_garson_loglari', JSON.stringify([]));
                        renderMasalar(); performansLoglariniGuncelle(); raporuGuncelle();
                        showAdminToast("Gün sonu başarıyla alındı.");
                    } else { showAdminToast("Gün sonu alınamadı!", "bg-red-500"); }
                } catch(e) { showAdminToast("Bağlantı hatası!", "bg-red-500"); }
            }
        }

        let garsonDinlemeAktif = false;
        function garsonCagrilariniDinle() {
            if (garsonDinlemeAktif) return;
            garsonDinlemeAktif = true;
            setInterval(() => {
                renderAdminNotifications();
                fetch('/api/admin/garson-cagrilari', { headers: getAuthHeaders() })
                    .then(res => res.json())
                    .then(data => {
                        let cagrilar = (data && data.success && data.cagrilar) ? data.cagrilar : [];
                        if (cagrilar.length > 0) {
                            const container = document.getElementById('admin-toast-container');
                            if(container) {
                                cagrilar.forEach(cagri => {
                                    const toast = document.createElement('div');
                                    toast.className = 'bg-amber-500 text-white px-6 py-4 rounded-xl shadow-2xl font-bold text-sm flex items-center gap-3 transform transition-all duration-500 translate-x-full';
                                    toast.innerHTML = `<i class="fa-solid fa-bell-concierge text-xl animate-bounce"></i> ${cagri.masa_ismi || ('Masa ' + cagri.masa_id)} Çağrısı Var!`;
                                    container.appendChild(toast);
                                    setTimeout(() => toast.classList.remove('translate-x-full'), 50);
                                    setTimeout(() => { toast.classList.add('translate-x-full'); setTimeout(() => toast.remove(), 500); }, 5000);
                                });
                            }
                        }
                    }).catch(() => {});
            }, 3000);
        }

        function performansLoglariniGuncelle() {
            const listContainer = document.getElementById('log-listesi');
            const avgContainer = document.getElementById('stat-yanit-suresi');
            if(!listContainer || !avgContainer) return;
            let loglar = JSON.parse(localStorage.getItem('center_garson_loglari')) || [];
            if(loglar.length === 0) {
                listContainer.innerHTML = '<span class="text-sm text-gray-400 italic">Henüz kaydedilen çağrı yok.</span>';
                avgContainer.textContent = "Veri Yok";
                return;
            }
            listContainer.innerHTML = '';
            let toplamSure = 0;
            loglar.forEach(log => {
                toplamSure += log.sure;
                let sureMetni = log.sure < 60 ? `${log.sure} Saniye` : `${Math.floor(log.sure/60)} Dk`;
                listContainer.innerHTML += `<div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-150"><span class="font-bold text-brandDark text-sm">Masa ${log.masa}</span><span class="font-black text-brandGreen text-sm">${sureMetni}</span></div>`;
            });
            let ortalama = Math.floor(toplamSure / loglar.length);
            avgContainer.textContent = ortalama < 60 ? `${ortalama} Saniye` : `${Math.floor(ortalama/60)} Dk`;
        }
    </script>
    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F9') {
                e.preventDefault();
                window.location.href = '/mikale-giris-x7k92';
            }
        });
    </script>
</body>
</html>