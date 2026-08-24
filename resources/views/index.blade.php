<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Center Cafe | Dijital Menü</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#047857">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brandGreen: '#047857', brandGold: '#D4AF37', brandBlue: '#8B9BB4', brandDark: '#022C22', brandBg: '#F8FAFC' },
                    fontFamily: { sans: ['Outfit', 'sans-serif'], serif: ['Cinzel', 'serif'] }
                }
            }
        }
    </script>
    <style>
        .visible-scroll::-webkit-scrollbar { height: 8px; }
        .visible-scroll::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 9999px; }
        .visible-scroll::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 9999px; }
        .visible-scroll::-webkit-scrollbar-thumb:hover { background: #047857; }
        .visible-scroll { 
            overflow-x: auto; 
            -webkit-overflow-scrolling: touch; 
            touch-action: pan-x; 
            scrollbar-width: thin;
            scrollbar-color: #D4AF37 #e2e8f0;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeOut { to { opacity: 0; visibility: hidden; } }
        .splash-screen { animation: fadeOut 0.5s ease-in-out 1.5s forwards; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(100%); } to { opacity: 1; transform: translateY(0); } }
        .slide-up { animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes spinY { from { transform: rotateY(0deg); } to { transform: rotateY(360deg); } }
        .globe-spin { animation: spinY 3s linear infinite; transform-style: preserve-3d; }
    </style>
</head>
<body class="bg-brandBg text-brandDark font-sans antialiased min-h-screen flex flex-col overflow-x-hidden">

    <!-- Splash Açılış -->
    <div class="splash-screen fixed inset-0 z-[100] bg-brandGreen flex flex-col items-center justify-center">
        <svg class="globe-spin w-20 h-20 text-brandGold mb-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M2 12h20 M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>
        <h1 class="text-4xl font-serif text-white tracking-widest uppercase text-center drop-shadow-md">Center Cafe</h1>
        <p class="text-brandGold mt-3 tracking-[0.2em] font-light text-sm text-center uppercase">Lezzetin Merkezine<br>Hoş Geldiniz</p>
    </div>

    <!-- Ortak Bildirim (Toast) Sistemi -->
    <div id="toast" class="fixed top-8 left-1/2 -translate-x-1/2 bg-brandGreen text-white px-6 py-3 rounded-full shadow-2xl transition-all duration-300 opacity-0 translate-y-[-20px] pointer-events-none z-[350] font-bold text-sm flex items-center gap-2">
        <span id="toast-message"></span>
    </div>

    <div class="w-full max-w-7xl mx-auto px-4 md:px-8 flex flex-col flex-1 relative pb-24">

        <header class="sticky top-0 z-[60] bg-brandBg/95 backdrop-blur-md flex flex-col md:flex-row justify-between items-center py-4 md:py-6 border-b border-brandBlue/20 shadow-sm transition-all gap-4">
            <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-start">
                <div class="flex items-center gap-3">
                    <svg class="globe-spin w-10 h-10 text-brandGold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M2 12h20 M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    <div class="flex flex-col">
                        <span id="site-title" class="font-serif font-bold text-2xl tracking-[0.1em] uppercase text-brandGreen leading-none drop-shadow-sm">Center</span>
                        <span id="site-subtitle" class="text-[0.65rem] font-bold text-brandBlue tracking-widest uppercase mt-1">Cafe & Bistro</span>
                    </div>
                </div>
            </div>

            <nav class="flex flex-wrap justify-center gap-3 md:gap-6 text-brandBlue font-semibold text-xs md:text-sm items-center">
                <button onclick="switchTab('home')" id="nav-home" class="text-brandGreen border-b-2 border-brandGreen pb-1 transition-all">Vitrin</button>
                <button onclick="switchTab('menu')" id="nav-menu" class="hover:text-brandGreen border-b-2 border-transparent hover:border-brandGreen pb-1 transition-all">Menü</button>
                <a href="/admin" class="flex items-center gap-1 text-brandBlue hover:text-brandGreen transition-all bg-brandBlue/10 px-3 py-1.5 rounded-full"><i class="fa-solid fa-lock text-xs"></i> Admin</a>
                <a href="https://search.google.com/local/writereview?placeid=ChIJN1t_tDeuEmsRUsoyG83frY4" target="_blank" id="btn-yorum-yap" class="flex items-center gap-1 text-brandGold hover:text-brandGreen transition-all bg-brandGold/10 px-3 py-1.5 rounded-full"><i class="fa-solid fa-star text-xs"></i> Yorum Yap</a>
            </nav>
        </header>

        <!-- Vitrin (Home) Section -->
        <div id="home-section" class="flex-1 py-6 md:py-12 flex flex-col md:flex-row gap-8 md:gap-10 fade-in items-center">
            <div class="flex-1 flex flex-col justify-center text-center md:text-left w-full">
                <h1 id="vitrin-slogan" class="text-4xl md:text-7xl font-serif font-bold uppercase tracking-wide mb-4 md:mb-6 text-brandGreen drop-shadow-sm">Lezzetin<br>Merkezi</h1>
                <p id="vitrin-aciklama" class="text-brandBlue text-base md:text-xl font-light mb-6 md:mb-8 max-w-lg mx-auto md:mx-0">Dünya mutfağından seçkin lezzetler, taptaze kahveler ve unutulmaz anlar için doğru yerdesiniz.</p>
                <div class="flex justify-center md:justify-start gap-4 mb-8 md:mb-10">
                    <button onclick="switchTab('menu')" class="bg-brandGold text-white px-8 py-3 rounded-full text-sm font-bold tracking-widest uppercase hover:bg-brandGreen hover:shadow-lg transition-all transform hover:-translate-y-1">Menüyü Keşfet</button>
                </div>

                <div class="bg-white p-5 md:p-8 rounded-3xl shadow-lg border border-brandBlue/10 flex flex-col gap-4 text-left">
                    <h3 class="font-bold text-brandGreen uppercase tracking-wider mb-1 border-b border-brandBlue/10 pb-3">İşletme Bilgileri</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-3">
                            <p id="info-adres" class="text-xs md:text-sm font-medium flex items-center gap-3"><i class="fa-solid fa-location-dot text-brandGold text-lg w-5"></i> Merkez Mah. No:123</p>
                            <p id="info-telefon" class="text-xs md:text-sm font-medium flex items-center gap-3"><i class="fa-solid fa-phone text-brandGold text-lg w-5"></i> +90 555 123 45 67</p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <p class="text-xs md:text-sm font-medium flex items-center gap-3"><i class="fa-regular fa-clock text-brandGold text-lg w-5"></i> Her Gün: 08:30 - 23:30</p>
                            <p id="info-wifi" class="text-xs md:text-sm font-medium flex items-center gap-3"><i class="fa-solid fa-wifi text-brandGold text-lg w-5"></i> Şifre: <span class="font-bold tracking-wider">center2026</span></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex-1 w-full flex justify-center md:justify-end">
                <div class="w-full max-w-md md:max-w-none md:w-4/5 h-64 md:h-[500px] rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-2xl relative">
                    <img id="vitrin-ana-resim" src="/images/OIP.jpg.webp" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&fit=crop'">
                    <div class="absolute inset-0 bg-gradient-to-t from-brandGreen/60 to-transparent"></div>
                </div>
            </div>
        </div>

        <!-- Menü Section -->
        <div id="menu-section" class="flex-1 hidden flex-col py-8 fade-in">
            <div class="flex gap-2 mb-10 w-full max-w-3xl mx-auto">
                <div class="flex-1 bg-white rounded-full shadow-sm px-6 h-14 flex items-center border border-black/5">
                    <i class="fa-solid fa-search text-brandBlue mr-3"></i>
                    <input type="text" id="menu-arama" placeholder="Menüde lezzet arayın..." oninput="tetikleAramaVeFiltre()" class="w-full bg-transparent outline-none text-base font-medium text-brandDark">
                </div>
                <button id="btn-fav-filter" onclick="gosterFavoriler()" class="bg-white text-brandBlue border border-black/5 px-5 rounded-full shadow-sm h-14 flex items-center justify-center font-bold hover:bg-red-50 hover:text-red-500 transition-colors">
                    <i class="fa-solid fa-heart text-xl"></i>
                </button>
                <button onclick="openFilterModal()" class="bg-brandGold text-white px-6 rounded-full shadow-sm h-14 flex items-center gap-2 font-bold hover:bg-brandGreen transition-colors">
                    <i class="fa-solid fa-sliders"></i> <span class="hidden md:inline">Filtrele</span>
                </button>
            </div>

            <div class="relative mb-6">
                <div id="ana-kategoriler" class="flex gap-4 overflow-x-auto visible-scroll pb-4 pt-1 px-1"></div>
            </div>
            <div id="alt-kategoriler" class="flex gap-2 overflow-x-auto visible-scroll pb-6 pt-1 px-1 mb-2"></div>

            <div class="flex justify-between items-end mb-8 border-b-2 border-brandGold/30 pb-3">
                <h2 id="kategori-baslik" class="text-3xl font-serif font-bold text-brandGreen uppercase tracking-wide">Kategori</h2>
                <span id="aktif-filtre-uyarisi" class="text-xs font-bold text-amber-500 bg-amber-50 px-3 py-1 rounded-full hidden">Filtreler Aktif <i class="fa-solid fa-filter"></i></span>
            </div>

            <div id="urun-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-7"></div>
            <div id="tavsiye-alani" class="mt-4"></div>
        </div>
    </div>

    <!-- Garson Çağır Butonu -->
    <button onclick="openWaiterModal()" class="fixed bottom-24 right-6 md:bottom-[7.5rem] md:right-10 bg-brandBlue text-white w-12 h-12 md:w-14 md:h-14 rounded-full shadow-xl flex items-center justify-center hover:bg-brandDark transition-all z-40">
        <i class="fa-solid fa-bell text-xl"></i>
    </button>

    <!-- Yüzen Sepet İkonu -->
    <button onclick="openCartModal()" id="cart-floating-btn" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 bg-brandGold text-white w-14 h-14 md:w-16 md:h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-brandGreen transition-all z-50 hidden">
        <i class="fa-solid fa-basket-shopping text-2xl"></i>
        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center border-2 border-white shadow-sm">0</span>
    </button>

    <!-- CANLI SİPARİŞ DURUM TAKİP ÇUBUĞU -->
    <div id="order-tracker" class="fixed bottom-24 left-1/2 -translate-x-1/2 w-[90%] max-w-sm bg-white rounded-3xl p-5 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.3)] border-t-4 border-brandGreen z-[150] hidden slide-up">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 bg-brandGreen rounded-full animate-ping"></span>
                <h4 class="font-bold text-sm text-brandDark uppercase tracking-wide">Aktif Sipariş Durumu</h4>
            </div>
            <span id="tracker-table" class="text-xs font-black text-brandGreen bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full">Masa -</span>
        </div>
        <div class="relative flex items-center justify-between mt-2 px-2">
            <div class="absolute left-6 right-6 top-1/2 -translate-y-1/2 h-1.5 bg-gray-100 rounded-full z-0"></div>
            <div id="tracker-progress" class="absolute left-6 top-1/2 -translate-y-1/2 h-1.5 bg-brandGreen rounded-full z-0 transition-all duration-700 ease-out" style="width: 0%;"></div>

            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="step-1-icon" class="w-8 h-8 rounded-full bg-brandGreen text-white flex items-center justify-center text-sm shadow-md transition-all duration-300 transform scale-110"><i class="fa-solid fa-check"></i></div>
                <span class="text-[10px] font-extrabold text-brandGreen uppercase tracking-wider">İletildi</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="step-2-icon" class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm transition-all duration-700 shadow-sm"><i class="fa-solid fa-fire"></i></div>
                <span id="step-2-text" class="text-[10px] font-bold text-gray-400 uppercase tracking-wider transition-colors duration-700">Hazırlanıyor</span>
            </div>
            <div class="relative z-10 flex flex-col items-center gap-2">
                <div id="step-3-icon" class="w-8 h-8 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center text-sm transition-all duration-700 shadow-sm"><i class="fa-solid fa-bell-concierge"></i></div>
                <span id="step-3-text" class="text-[10px] font-bold text-gray-400 uppercase tracking-wider transition-colors duration-700">Serviste</span>
            </div>
        </div>
    </div>

    <!-- Filtre Modal -->
    <div id="filter-modal" class="fixed inset-0 z-[250] bg-brandDark/70 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl p-6 md:p-8 w-full max-w-sm relative shadow-2xl slide-up border-t-4 border-brandGold">
            <button onclick="closeFilterModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full bg-gray-50"><i class="fa-solid fa-xmark text-lg"></i></button>
            <h3 class="text-xl font-bold text-brandDark mb-6 uppercase tracking-wide border-b border-gray-100 pb-3"><i class="fa-solid fa-sliders text-brandGold mr-2"></i> Akıllı Filtreleme</h3>

            <div class="flex flex-col gap-6 mb-8">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Maksimum Bütçe (₺)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-gray-400 font-bold">₺</span>
                        <input type="number" id="filter-price" placeholder="Limit Yok" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl pl-8 pr-4 py-2.5 font-bold text-brandDark focus:outline-none focus:border-brandGreen transition-colors">
                    </div>
                </div>

                <div class="bg-brandBg border border-brandBlue/20 rounded-xl p-4 flex flex-col gap-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="filter-gluten" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brandGreen"></div>
                        <span class="ml-3 text-sm font-bold text-brandDark flex items-center gap-2">Sadece Glütensiz (GF)</span>
                    </label>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="filter-allergen" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brandGreen"></div>
                        <span class="ml-3 text-sm font-bold text-brandDark flex items-center gap-2">Alerjensiz Ürünler <i class="fa-solid fa-leaf text-brandGreen"></i></span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="clearFilters()" class="flex-1 bg-gray-100 text-gray-500 py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-gray-200 transition-colors">Temizle</button>
                <button onclick="applyFilters()" class="flex-[2] bg-brandGold text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-brandGreen transition-colors shadow-lg"><i class="fa-solid fa-check mr-1"></i> Sonuçları Gör</button>
            </div>
        </div>
    </div>

    <!-- Garson Modal -->
    <div id="waiter-modal" class="fixed inset-0 z-[250] bg-brandDark/70 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl p-6 md:p-8 w-full max-w-sm relative shadow-2xl slide-up border-t-4 border-brandGold">
            <button onclick="closeWaiterModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full bg-gray-50"><i class="fa-solid fa-xmark text-lg"></i></button>
            <div class="w-16 h-16 bg-brandGold/10 text-brandGold rounded-full flex items-center justify-center text-3xl mx-auto mb-4"><i class="fa-solid fa-bell-concierge"></i></div>
            <h3 class="text-xl font-bold text-brandDark mb-2 text-center uppercase tracking-wide">Masanızı Seçin</h3>
            <p class="text-sm text-gray-500 mb-6 text-center font-medium">Garsonu çağırmadan önce lütfen bulunduğunuz masa numarasını girin.</p>
            <input type="text" id="waiter-table-no" placeholder="Örn: 5" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-3 mb-6 focus:outline-none focus:border-brandGreen font-black text-center text-xl text-brandDark transition-colors">
            <button onclick="confirmCallWaiter()" class="w-full bg-brandGold text-white py-3.5 rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-brandGreen transition-colors shadow-lg flex items-center justify-center gap-2"><i class="fa-solid fa-check"></i> Garson Çağır</button>
        </div>
    </div>

    <!-- Sepet Özeti & Masa Seçim Modal -->
    <div id="cart-modal" class="fixed inset-0 z-[300] bg-brandDark/70 hidden items-end md:items-center justify-center p-0 md:p-4 backdrop-blur-sm">
        <div class="slide-up bg-white w-full md:max-w-xl overflow-hidden shadow-2xl relative flex flex-col rounded-t-[2rem] md:rounded-[2rem] max-h-[90vh]">
            <div class="p-6 border-b border-brandBlue/10 flex justify-between items-center bg-brandBg">
                <h3 class="text-xl font-bold text-brandDark uppercase tracking-wide"><i class="fa-solid fa-basket-shopping text-brandGold mr-2"></i> Sepetim</h3>
                <button onclick="closeCartModal()" class="text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-sm"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            
            <div class="px-6 pt-4 pb-2 bg-brandBg/50 border-b border-brandBlue/10 flex items-center justify-between">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest"><i class="fa-solid fa-chair text-brandGold mr-1"></i> Bulunduğunuz Masa:</span>
                <input type="text" id="cart-table-input" placeholder="Masa No (Örn: 1)" class="w-32 bg-white border border-gray-300 rounded-lg px-3 py-1.5 font-black text-center text-brandDark text-sm focus:outline-none focus:border-brandGreen">
            </div>

            <div id="cart-items-container" class="p-6 overflow-y-auto visible-scroll flex-1 flex flex-col gap-4 bg-white min-h-[220px]"></div>
            <div class="p-6 bg-brandBg border-t border-brandBlue/10 shadow-[0_-10px_15px_-3px_rgba(0,0,0,0.05)]">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-bold text-gray-500 uppercase tracking-widest text-sm">Genel Toplam:</span>
                    <span id="cart-total-price" class="font-black text-brandGreen text-2xl">₺0.00</span>
                </div>
                <button id="btn-siparis-ver" onclick="siparisVer()" class="w-full bg-brandGold text-white py-4 rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-brandGreen transition-colors shadow-lg flex items-center justify-center gap-2">
                    Siparişi Onayla <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Ürün Detay Modal -->
    <div id="product-modal" class="fixed inset-0 z-[200] bg-brandDark/70 hidden items-end md:items-center justify-center p-0 md:p-4 backdrop-blur-sm">
        <div class="slide-up bg-white w-full md:max-w-xl overflow-hidden shadow-2xl relative flex flex-col rounded-t-[2rem] md:rounded-[2rem] max-h-[90vh]">
            <button onclick="closeModal()" class="absolute top-4 right-4 bg-brandBg/90 text-brandGreen w-10 h-10 rounded-full flex items-center justify-center shadow-md z-10 hover:bg-brandGold hover:text-white transition-all"><i class="fa-solid fa-xmark text-lg"></i></button>
            <div class="w-full h-56 md:h-72 bg-brandBg relative">
                <img id="modal-img" src="" class="w-full h-full object-cover">
                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h2 id="modal-title" class="absolute bottom-4 left-6 text-2xl font-serif font-bold text-white uppercase drop-shadow-md">Ürün Adı</h2>
            </div>
            <div class="p-6 md:p-8 overflow-y-auto visible-scroll">
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <span id="modal-price" class="text-brandGreen font-black text-2xl">₺0.00</span>
                    <span id="modal-cal" class="text-xs font-bold text-white bg-brandGold px-3 py-1.5 rounded-full flex items-center gap-1.5"><i class="fa-solid fa-fire"></i> 0 kcal</span>
                    <span id="modal-time" class="text-xs font-bold text-brandBlue bg-brandBg px-3 py-1.5 rounded-full border border-brandBlue/20 flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> 0 min</span>
                </div>
                <div id="modal-alerjen-wrapper" class="hidden mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-lg mt-0.5"></i>
                    <div><h5 class="text-xs font-bold text-red-700 uppercase tracking-wider">Alerjen Uyarısı</h5><p id="modal-alerjen-text" class="text-xs md:text-sm text-red-600 font-medium mt-0.5"></p></div>
                </div>
                <h4 class="text-xs font-bold text-brandBlue uppercase tracking-widest mb-2 border-b border-brandBlue/20 pb-2">Ürün İçeriği & Detaylar</h4>
                <p id="modal-desc" class="text-brandDark/80 text-sm md:text-base leading-relaxed font-medium">Açıklama...</p>
            </div>
        </div>
    </div>

    <script>
        function showToast(message, icon = 'fa-check-circle', color = 'text-brandGold') {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').innerHTML = `<i class="fa-solid ${icon} ${color} mr-1"></i> ${message}`;
            toast.classList.remove('opacity-0', 'translate-y-[-20px]');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-[-20px]');
            }, 3000);
        }

        function haversineMesafeMetre(lat1, lon1, lat2, lon2) {
            const R = 6371000;
            const toRad = (deg) => deg * Math.PI / 180;
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);
            const a = Math.sin(dLat/2) ** 2 + Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * Math.sin(dLon/2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            return R * c;
        }

        function konumAl() {
            return new Promise((resolve) => {
                if (!navigator.geolocation) { resolve(null); return; }
                navigator.geolocation.getCurrentPosition(
                    (pos) => resolve({ lat: pos.coords.latitude, lon: pos.coords.longitude }),
                    () => resolve(null),
                    { timeout: 8000 }
                );
            });
        }

        async function siparisIzinKontrolEt() {
            const ayar = window.guvenlikAyarlari || {};

            const suresiDk = parseInt(ayar.guvenlik_suresi_dk) || 30;
            const zamanStr = localStorage.getItem('aktif_masa_zaman');
            if (zamanStr) {
                const gecenDk = (Date.now() - parseInt(zamanStr)) / 60000;
                if (gecenDk > suresiDk) {
                    localStorage.removeItem('aktif_masa');
                    localStorage.removeItem('aktif_masa_zaman');
                    return { ok: false, mesaj: "Oturum süreniz doldu. Lütfen masadaki QR Kodu tekrar okutun!" };
                }
            }

            if (ayar.gps_dogrulama_aktif == 1 && ayar.gps_enlem && ayar.gps_boylam) {
                const konum = await konumAl();
                if (!konum) {
                    return { ok: false, mesaj: "Sipariş verebilmek için konum izni vermeniz gerekiyor." };
                }
                const mesafe = haversineMesafeMetre(konum.lat, konum.lon, parseFloat(ayar.gps_enlem), parseFloat(ayar.gps_boylam));
                const maxMesafe = parseInt(ayar.gps_max_mesafe) || 200;
                if (mesafe > maxMesafe) {
                    return { ok: false, mesaj: "Restorana çok uzaksınız, sipariş veremezsiniz." };
                }
            }

            return { ok: true };
        }

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const masa = urlParams.get('masa');
            if (masa) {
                localStorage.setItem('aktif_masa', masa);
                localStorage.setItem('aktif_masa_zaman', Date.now().toString());
                const subtitle = document.getElementById('site-subtitle');
                if(subtitle) subtitle.textContent = `Center Cafe | Masa ${masa}`;
            }

            const aktifMasa = localStorage.getItem('aktif_masa');
            if(aktifMasa) {
                const waiterInput = document.getElementById('waiter-table-no');
                if(waiterInput) waiterInput.value = aktifMasa;
            }

            fetch('/api/ayarlar').then(res => res.json()).then(data => {
                if(data) {
                    window.guvenlikAyarlari = data;
                    if(data.sirket_adi) {
                        const titleEl = document.getElementById('site-title');
                        if(titleEl) titleEl.textContent = data.sirket_adi.split(' ')[0];
                        document.title = data.sirket_adi + " | Dijital Menü";
                    }
                    if(data.slogan) {
                        const sloganEl = document.getElementById('vitrin-slogan');
                        if(sloganEl) sloganEl.innerHTML = data.slogan.replace(/\n/g, '<br>');
                    }
                    if(data.alt_aciklama) {
                        const aciklamaEl = document.getElementById('vitrin-aciklama');
                        if(aciklamaEl) aciklamaEl.textContent = data.alt_aciklama;
                    }
                    if(data.vitrin_gorsel_url) {
                        const imgEl = document.getElementById('vitrin-ana-resim');
                        if(imgEl) imgEl.src = data.vitrin_gorsel_url;
                    }
                    if(data.wifi_sifresi) {
                        const wifiEl = document.getElementById('info-wifi');
                        if(wifiEl) wifiEl.innerHTML = `<i class="fa-solid fa-wifi text-brandGold text-lg w-5"></i> Şifre: <span class="font-bold tracking-wider">${data.wifi_sifresi}</span>`;
                    }
                    if(data.telefon) {
                        const telEl = document.getElementById('info-telefon');
                        if(telEl) telEl.innerHTML = `<i class="fa-solid fa-phone text-brandGold text-lg w-5"></i> ${data.telefon}`;
                    }
                    if(data.adres) {
                        const adresEl = document.getElementById('info-adres');
                        if(adresEl) adresEl.innerHTML = `<i class="fa-solid fa-location-dot text-brandGold text-lg w-5"></i> ${data.adres}`;
                    }
                    if(data.yorum_linki) {
                        const yorumBtn = document.getElementById('btn-yorum-yap');
                        if(yorumBtn) yorumBtn.href = data.yorum_linki;
                    }
                }
            }).catch(err => console.log("Ayarlar yüklenemedi."));

            window.addEventListener('load', function() {
                setTimeout(function() {
                    var splash = document.querySelector('.splash-screen');
                    if (splash) {
                        splash.style.transition = 'opacity 0.4s ease';
                        splash.style.opacity = '0';
                        setTimeout(function() { splash.style.display = 'none'; }, 400);
                    }
                }, 1800);
            });
            
            updateCartIcon();
            checkOrderStatus();
            setInterval(checkOrderStatus, 2000);
        });

        function switchTab(tabId) {
            document.getElementById('home-section').classList.toggle('hidden', tabId !== 'home');
            document.getElementById('menu-section').classList.toggle('hidden', tabId === 'home');
            document.getElementById('menu-section').classList.toggle('flex', tabId !== 'home');
            document.getElementById('nav-home').className = tabId === 'home' ? 'text-brandGreen border-b-2 border-brandGreen pb-1 transition-all' : 'text-brandBlue hover:text-brandGreen border-b-2 border-transparent hover:border-brandGreen pb-1 transition-all';
            document.getElementById('nav-menu').className = tabId === 'menu' ? 'text-brandGreen border-b-2 border-brandGreen pb-1 transition-all' : 'text-brandBlue hover:text-brandGreen border-b-2 border-transparent hover:border-brandGreen pb-1 transition-all';
        }

        function openWaiterModal() {
            document.getElementById('waiter-modal').classList.remove('hidden');
            document.getElementById('waiter-modal').classList.add('flex');
            const aktifMasa = localStorage.getItem('aktif_masa') || '';
            document.getElementById('waiter-table-no').value = aktifMasa;
            document.getElementById('waiter-table-no').focus();
        }

        function closeWaiterModal() {
            document.getElementById('waiter-modal').classList.add('hidden');
            document.getElementById('waiter-modal').classList.remove('flex');
        }

        function confirmCallWaiter() {
            let zamanlar = JSON.parse(localStorage.getItem('center_garson_cagri_zamanlari')) || [];
            const simdi = Date.now();
            zamanlar = zamanlar.filter(t => simdi - t < 60000);
            if (zamanlar.length >= 20) {
                showToast("Çok fazla istek gönderdiniz, lütfen 1 dakika bekleyin.", "fa-triangle-exclamation", "text-red-500");
                return;
            }
            zamanlar.push(simdi);
            localStorage.setItem('center_garson_cagri_zamanlari', JSON.stringify(zamanlar));

            const tableNo = document.getElementById('waiter-table-no').value.trim() || localStorage.getItem('aktif_masa') || 'Bilinmiyor';
            localStorage.setItem('aktif_masa', tableNo);
            closeWaiterModal();

            let cagriListesi = JSON.parse(localStorage.getItem('center_garson_cagrilari')) || [];
            cagriListesi.push({
                masa: tableNo,
                zaman: new Date().toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' }),
                timestamp: Date.now()
            });
            localStorage.setItem('center_garson_cagrilari', JSON.stringify(cagriListesi));
            showToast(`Masa ${tableNo} için garson çağırıldı!`);
        }

        let currentAnaKat = '';
        let currentAltKat = '';
        let activeFilters = { maxFiyat: 0, glutensiz: false, alerjensiz: false };
        let sadeceFavoriler = false;

        window.gosterFavoriler = function() {
            sadeceFavoriler = !sadeceFavoriler;
            const btn = document.getElementById('btn-fav-filter');
            if(sadeceFavoriler) {
                btn.classList.add('bg-red-500', 'text-white', 'border-red-500');
                btn.classList.remove('bg-white', 'text-brandBlue', 'border-black/5');
                showToast("Sadece favori ürünleriniz listeleniyor.", "fa-heart", "text-red-500");
            } else {
                btn.classList.remove('bg-red-500', 'text-white', 'border-red-500');
                btn.classList.add('bg-white', 'text-brandBlue', 'border-black/5');
            }
            tetikleAramaVeFiltre();
        }

        window.toggleFavori = function(e, index) {
            e.stopPropagation();
            const urun = globalUrunler[index];
            let favs = JSON.parse(localStorage.getItem('center_favoriler')) || [];
            const idx = favs.indexOf(urun.UrunAd);
            if(idx > -1) {
                favs.splice(idx, 1);
                showToast(urun.UrunAd + " favorilerden çıkarıldı.", "fa-heart-crack", "text-gray-400");
            } else {
                favs.push(urun.UrunAd);
                showToast(urun.UrunAd + " favorilere eklendi! ❤️", "fa-heart", "text-red-500");
            }
            localStorage.setItem('center_favoriler', JSON.stringify(favs));
            tetikleAramaVeFiltre();
        }

        function openFilterModal() {
            document.getElementById('filter-modal').classList.remove('hidden');
            document.getElementById('filter-modal').classList.add('flex');
        }

        function closeFilterModal() {
            document.getElementById('filter-modal').classList.add('hidden');
            document.getElementById('filter-modal').classList.remove('flex');
        }

        function applyFilters() {
            const priceVal = document.getElementById('filter-price').value;
            activeFilters.maxFiyat = priceVal ? parseFloat(priceVal) : 0;
            activeFilters.glutensiz = document.getElementById('filter-gluten').checked;
            activeFilters.alerjensiz = document.getElementById('filter-allergen').checked;

            closeFilterModal();

            if(activeFilters.maxFiyat > 0 || activeFilters.glutensiz || activeFilters.alerjensiz) {
                document.getElementById('aktif-filtre-uyarisi').classList.remove('hidden');
            } else {
                document.getElementById('aktif-filtre-uyarisi').classList.add('hidden');
            }
            tetikleAramaVeFiltre();
        }

        function clearFilters() {
            document.getElementById('filter-price').value = '';
            document.getElementById('filter-gluten').checked = false;
            document.getElementById('filter-allergen').checked = false;

            activeFilters = { maxFiyat: 0, glutensiz: false, alerjensiz: false };
            document.getElementById('aktif-filtre-uyarisi').classList.add('hidden');

            closeFilterModal();
            tetikleAramaVeFiltre();
        }

        function tetikleAramaVeFiltre() {
            if(currentAnaKat && currentAltKat) {
                renderUrunler(currentAnaKat, currentAltKat);
            }
        }

        function getUrunGorseli(urun) { return (urun.resim_url && urun.resim_url.trim() !== "") ? urun.resim_url : "https://images.unsplash.com/photo-1544025162-d76694265947?w=500&h=300&fit=crop"; }

        function openModal(index) {
            const urun = globalUrunler[index];
            if(!urun) return;
            const kalori = urun.kalori || urun.Kalori || '0';
            const sure = urun.sure || urun.HazirlanmaSuresi || '0';
            const aciklama = urun.aciklama || urun.Aciklama || "İçerik detayı bulunmamaktadır.";
            const alerjen = urun.alerjen || urun.Alerjen;

            document.getElementById('modal-img').src = getUrunGorseli(urun);
            document.getElementById('modal-title').textContent = urun.UrunAd;
            document.getElementById('modal-price').textContent = "₺" + (urun.FixFiyat || "0.00");
            document.getElementById('modal-cal').innerHTML = `<i class="fa-solid fa-fire"></i> ${kalori} kcal`;
            document.getElementById('modal-time').innerHTML = `<i class="fa-regular fa-clock"></i> ${sure} min`;
            document.getElementById('modal-desc').innerHTML = aciklama;

            const alerjenWrapper = document.getElementById('modal-alerjen-wrapper');
            const alerjenText = document.getElementById('modal-alerjen-text');
            if (alerjen && alerjen.trim() !== "") {
                alerjenText.textContent = alerjen;
                alerjenWrapper.classList.remove('hidden');
                alerjenWrapper.classList.add('flex');
            } else {
                alerjenWrapper.classList.add('hidden');
                alerjenWrapper.classList.remove('flex');
            }

            document.getElementById('product-modal').classList.remove('hidden');
            document.getElementById('product-modal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('product-modal').classList.add('hidden');
            document.getElementById('product-modal').classList.remove('flex');
        }

        let globalUrunler = [];

        document.addEventListener('DOMContentLoaded', function() {
            let sabitKategoriler = [];
            let altHiyerarsi = {};

            function getKategoriGorseli(ad) {
                const key = (ad || '').toLocaleUpperCase('tr-TR');
                if (key.includes('KAHVALTI')) return "https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?w=500&h=300&fit=crop";
                if (key.includes('TATLI') || key.includes('PASTA') || key.includes('KEK')) return "https://images.unsplash.com/photo-1579306194872-64d3b7bac4c2?w=500&h=300&fit=crop";
                if (key.includes('SICAK') || key.includes('KAHVE') || key.includes('ÇAY')) return "https://images.unsplash.com/photo-1541167760496-1628856ab772?w=500&h=300&fit=crop";
                if (key.includes('SOĞUK') || key.includes('İÇECEK') || key.includes('FRAPPE') || key.includes('SHAKE') || key.includes('SMOOTHIE')) return "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=500&h=300&fit=crop";
                if (key.includes('DONDURMA')) return "https://images.unsplash.com/photo-1551024601-bec78aea704b?w=500&h=300&fit=crop";
                if (key.includes('GÖZLEME') || key.includes('TOST')) return "https://images.unsplash.com/photo-1528736235302-52922df5c122?w=500&h=300&fit=crop";
                return "https://images.unsplash.com/photo-1544025162-d76694265947?w=500&h=300&fit=crop";
            }

            const anaKatAlani = document.getElementById('ana-kategoriler');
            const altKatAlani = document.getElementById('alt-kategoriler');
            const urunGrid = document.getElementById('urun-grid');
            const tavsiyeAlani = document.getElementById('tavsiye-alani');
            const baslik = document.getElementById('kategori-baslik');

            fetch('/api/menu').then(res => res.json()).then(data => {
                if(data && data.urunler) {
                    globalUrunler = data.urunler.sort((a, b) => (a.Sira || 99) - (b.Sira || 99));
                }

                const kategoriler = (data && data.kategoriler) ? data.kategoriler : [];
                const anaGrupMap = new Map();
                const altGrupMap = {};

                kategoriler.forEach(k => {
                    const isim = (k.Urungrubu || k.UrunGrubu || '').trim();
                    if (!isim) return;
                    const anaGrup = (k.AnaGrup || isim).trim();
                    const sirano = Number(k.Sirano ?? k.sirano ?? 99);

                    if (!anaGrupMap.has(anaGrup) || sirano < anaGrupMap.get(anaGrup)) {
                        anaGrupMap.set(anaGrup, sirano);
                    }
                    if (!altGrupMap[anaGrup]) altGrupMap[anaGrup] = [];
                    if (isim !== anaGrup) {
                        altGrupMap[anaGrup].push({ ad: isim, sirano: sirano });
                    }
                });

                sabitKategoriler = Array.from(anaGrupMap.entries())
                    .sort((a, b) => a[1] - b[1])
                    .map(([ad]) => ({ ad, resim: getKategoriGorseli(ad), fallback: getKategoriGorseli(ad) }));

                sabitKategoriler.forEach(kat => {
                    const altlar = (altGrupMap[kat.ad] || []).sort((a, b) => a.sirano - b.sirano).map(x => x.ad);
                    altHiyerarsi[kat.ad] = [kat.ad, ...altlar];
                });

                anaKatAlani.innerHTML = '';

                if (sabitKategoriler.length === 0) {
                    anaKatAlani.innerHTML = `<div class="text-brandBlue/60 text-sm font-medium py-6 px-2">Henüz tanımlı kategori bulunmuyor. Lütfen admin panelden kategori ekleyin.</div>`;
                    baslik.textContent = "Kategori";
                    urunGrid.innerHTML = '';
                    return;
                }

                sabitKategoriler.forEach(kat => {
                    const div = document.createElement('div');
                    div.className = "flex-shrink-0 w-40 md:w-52 h-24 md:h-28 rounded-[1.5rem] relative overflow-hidden cursor-pointer shadow-sm hover:shadow-lg transition-all duration-300 border border-black/5 group ana-kat-btn";
                    div.innerHTML = `
                        <img src="${kat.resim}" onerror="this.onerror=null; this.src='${kat.fallback}';" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-brandDark/85 via-brandDark/25 to-transparent"></div>
                        <div class="absolute inset-0 flex items-end justify-center pb-3 px-2 text-center">
                            <span class="text-white font-serif font-semibold text-[0.7rem] md:text-sm uppercase tracking-[0.15em] drop-shadow-md z-10">${kat.ad}</span>
                        </div>
                        <div class="kat-overlay absolute bottom-0 left-0 right-0 h-[3px] bg-brandGold scale-x-0 origin-center transition-transform duration-300"></div>`;
                    anaKatAlani.appendChild(div);
                });

                const btnler = anaKatAlani.querySelectorAll('.ana-kat-btn');
                btnler.forEach((btn, idx) => {
                    btn.onclick = () => selectCategory(sabitKategoriler[idx].ad, btn);
                });

                if(btnler.length > 0) selectCategory(sabitKategoriler[0].ad, btnler[0]);
            });

            function selectCategory(isim, btn) {
                currentAnaKat = isim;
                document.querySelectorAll('.kat-overlay').forEach(e => e.classList.remove('scale-x-100'));
                if(btn) btn.querySelector('.kat-overlay').classList.add('scale-x-100');
                baslik.textContent = isim;
                altKatAlani.innerHTML = '';
                const altlar = altHiyerarsi[isim] || [isim];

                altlar.forEach((alt, i) => {
                    const count = globalUrunler.filter(u => {
                        if(!u.UrunGrubu) return false;
                        const g = u.UrunGrubu.toLocaleUpperCase('tr-TR');
                        const altUpper = alt.toLocaleUpperCase('tr-TR');
                        const anaUpper = isim.toLocaleUpperCase('tr-TR');

                        if (altUpper === anaUpper) {
                            return g === anaUpper;
                        } else {
                            return g === altUpper;
                        }
                    }).length;

                    const b = document.createElement('button');
                    b.className = `flex-shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold uppercase tracking-wider transition-all ${i === 0 ? 'bg-brandDark text-brandGold' : 'bg-transparent border border-black/10 text-brandDark/50 hover:border-brandGold/50 hover:text-brandGreen'}`;
                    b.textContent = `${alt} (${count})`;
                    b.onclick = (e) => {
                        Array.from(altKatAlani.children).forEach(x => { x.className = "flex-shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-transparent border border-black/10 text-brandDark/50 hover:border-brandGold/50 hover:text-brandGreen transition-all"; });
                        e.target.className = "flex-shrink-0 px-5 py-2.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-brandDark text-brandGold transition-all";
                        currentAltKat = alt;
                        renderUrunler(isim, alt);
                    };
                    altKatAlani.appendChild(b);
                });

                currentAltKat = altlar[0];
                renderUrunler(isim, altlar[0]);
            }

            window.renderUrunler = function(ana, alt) {
                const searchVal = document.getElementById('menu-arama').value.trim().toLocaleUpperCase('tr-TR');
                let favs = JSON.parse(localStorage.getItem('center_favoriler')) || [];

                const filtrelenenler = globalUrunler.filter(u => {
                    if(sadeceFavoriler && !favs.includes(u.UrunAd)) return false;
                    if(!u.UrunGrubu) return false;
                    
                    const g = u.UrunGrubu.toLocaleUpperCase('tr-TR');
                    const altUpper = alt.toLocaleUpperCase('tr-TR');
                    const anaUpper = ana.toLocaleUpperCase('tr-TR');

                    let katMatch = false;
                    if (altUpper === anaUpper) {
                        katMatch = (g === anaUpper);
                    } else {
                        katMatch = (g === altUpper);
                    }

                    if(!katMatch) return false;

                    if(searchVal !== "") {
                        const ad = (u.UrunAd || "").toLocaleUpperCase('tr-TR');
                        const aciklama = (u.aciklama || "").toLocaleUpperCase('tr-TR');
                        if(!ad.includes(searchVal) && !aciklama.includes(searchVal)) return false;
                    }

                    if (activeFilters.maxFiyat > 0 && parseFloat(u.FixFiyat || 0) > activeFilters.maxFiyat) return false;
                    if (activeFilters.glutensiz && u.is_gluten_free != 1) return false;
                    if (activeFilters.alerjensiz && u.alerjen && u.alerjen.trim() !== '') return false;

                    return true;
                });

                filtrelenenler.sort((a, b) => (a.Sira || 99) - (b.Sira || 99));

                urunGrid.innerHTML = '';
                tavsiyeAlani.innerHTML = '';

                if(filtrelenenler.length === 0) {
                    urunGrid.innerHTML = `<div class="col-span-full py-12 text-center text-brandBlue text-base font-medium flex flex-col items-center gap-3"><i class="fa-solid fa-plate-wheat text-4xl text-brandBlue/40"></i> Aradığınız kriterlere uygun ürün bulunamadı.</div>`;
                    return;
                }

                let tukenenler = JSON.parse(localStorage.getItem('center_tukenen_urunler')) || [];

                filtrelenenler.forEach(u => {
                    const globalIndex = globalUrunler.indexOf(u);
                    const gorsel = getUrunGorseli(u);
                    const isTukendi = tukenenler.includes(u.UrunAd);
                    const isFav = favs.includes(u.UrunAd);

                    const badge = (u.is_gluten_free == 1) ? `<span class="absolute top-3 left-3 bg-brandGreen text-white text-[0.6rem] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md z-10 border border-brandGreen/50">GF</span>` : '';
                    const tukendiBadge = isTukendi ? `<div class="absolute inset-0 bg-black/60 flex items-center justify-center z-20"><span class="bg-red-600 text-white font-bold text-xs px-3 py-1.5 rounded-full uppercase tracking-wider shadow-lg">Tükendi</span></div>` : '';
                    const favBtn = `<button onclick="toggleFavori(event, ${globalIndex})" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 backdrop-blur shadow-sm flex items-center justify-center text-lg z-20 transition-all hover:scale-110 ${isFav ? 'text-red-500' : 'text-gray-300 hover:text-red-400'}"><i class="fa-${isFav ? 'solid' : 'regular'} fa-heart"></i></button>`;

                    urunGrid.innerHTML += `
                        <div class="bg-white rounded-[1.75rem] border border-black/5 flex flex-col relative cursor-pointer hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 group overflow-hidden ${isTukendi ? 'opacity-60' : ''}">
                            ${tukendiBadge}
                            <div onclick="openModal(${globalIndex})" class="w-full aspect-[4/3] relative overflow-hidden bg-brandBg">
                                ${badge}
                                ${favBtn}
                                <img src="${gorsel}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <div class="p-4 md:p-5 flex flex-col flex-1">
                                <h3 onclick="openModal(${globalIndex})" class="font-serif font-semibold text-sm md:text-base text-brandDark tracking-wide line-clamp-2 mb-3">${u.UrunAd}</h3>
                                <div class="mt-auto flex items-center justify-between pt-3 border-t border-brandGold/20">
                                    <span class="font-bold text-brandGreen text-base md:text-lg">₺${u.FixFiyat || "0.00"}</span>
                                    ${isTukendi ? 
                                        `<span class="text-[0.65rem] font-bold text-red-500 uppercase tracking-wider">Tükendi</span>` : 
                                        `<button onclick="sepeteEkle(event, ${globalIndex})" class="w-9 h-9 rounded-full bg-brandDark text-brandGold flex items-center justify-center hover:bg-brandGreen hover:text-white transition-colors"><i class="fa-solid fa-plus text-xs"></i></button>`
                                    }
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            window.sepet = JSON.parse(localStorage.getItem('center_sepet')) || [];
            window.sepet.forEach(item => { if (!item.adet || isNaN(item.adet)) item.adet = 1; });
            localStorage.setItem('center_sepet', JSON.stringify(window.sepet));
            
            window.sepeteEkle = function(e, index) {
                if(e) e.stopPropagation();
                const urun = globalUrunler[index];
                let tukenenler = JSON.parse(localStorage.getItem('center_tukenen_urunler')) || [];
                if(tukenenler.includes(urun.UrunAd)) return;

                const existingItem = sepet.find(item => item.UrunAd === urun.UrunAd);
                if(existingItem) { existingItem.adet += 1; } else { sepet.push({ ...urun, adet: 1 }); }
                
                localStorage.setItem('center_sepet', JSON.stringify(sepet));
                updateCartIcon();
                showToast(`${urun.UrunAd} sepete eklendi!`);
            }

            window.updateCartIcon = function() {
                const cartBtn = document.getElementById('cart-floating-btn');
                const cartCount = document.getElementById('cart-count');
                const totalItems = sepet.reduce((sum, item) => sum + (item.adet || 1), 0);
                if(totalItems > 0) {
                    cartBtn.classList.remove('hidden');
                    cartCount.textContent = totalItems;
                } else {
                    cartBtn.classList.add('hidden');
                }
            }

            window.openCartModal = function() {
                renderCart();
                const aktifMasa = localStorage.getItem('aktif_masa') || '';
                document.getElementById('cart-table-input').value = aktifMasa;
                document.getElementById('cart-modal').classList.remove('hidden');
                document.getElementById('cart-modal').classList.add('flex');
            }

            window.closeCartModal = function() {
                document.getElementById('cart-modal').classList.add('hidden');
                document.getElementById('cart-modal').classList.remove('flex');
            }

            window.updateCartItem = function(index, change) {
                sepet[index].adet += change;
                if(sepet[index].adet <= 0) { sepet.splice(index, 1); }
                localStorage.setItem('center_sepet', JSON.stringify(sepet));
                updateCartIcon();
                renderCart();
            }

            window.renderCart = function() {
                const container = document.getElementById('cart-items-container');
                const totalEl = document.getElementById('cart-total-price');
                container.innerHTML = '';
                let total = 0;

                if(sepet.length === 0) {
                    container.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-10 text-brandBlue/50 h-full">
                            <i class="fa-solid fa-basket-shopping text-6xl mb-4"></i>
                            <p class="font-bold tracking-wide uppercase text-sm">Sepetiniz şu an boş.</p>
                        </div>`;
                    totalEl.textContent = '₺0.00';
                    return;
                }

                sepet.forEach((item, index) => {
                    const price = parseFloat(item.FixFiyat || 0);
                    const itemTotal = price * item.adet;
                    total += itemTotal;
                    
                    container.innerHTML += `
                        <div class="flex items-center justify-between bg-white p-4 rounded-2xl border border-brandBlue/10 shadow-sm">
                            <div class="flex flex-col max-w-[55%]">
                                <span class="font-bold text-sm text-brandDark truncate">${item.UrunAd}</span>
                                <span class="text-brandGreen font-black text-sm">₺${price.toFixed(2)}</span>
                            </div>
                            <div class="flex items-center gap-3 bg-gray-50 rounded-full px-2 py-1.5 border border-gray-200">
                                <button onclick="updateCartItem(${index}, -1)" class="w-7 h-7 flex items-center justify-center text-red-500 hover:bg-red-100 rounded-full transition-colors"><i class="fa-solid ${item.adet === 1 ? 'fa-trash' : 'fa-minus'} text-xs"></i></button>
                                <span class="font-bold text-brandDark text-sm w-4 text-center">${item.adet}</span>
                                <button onclick="updateCartItem(${index}, 1)" class="w-7 h-7 flex items-center justify-center text-brandGreen hover:bg-brandGreen/20 rounded-full transition-colors"><i class="fa-solid fa-plus text-xs"></i></button>
                            </div>
                        </div>
                    `;
                });
                totalEl.textContent = '₺' + total.toFixed(2);
            }

            updateCartIcon();
        });

        window.siparisVer = async function() {
            if(sepet.length === 0) return;

            const izin = await siparisIzinKontrolEt();
            if (!izin.ok) {
                showToast(izin.mesaj, "fa-triangle-exclamation", "text-red-500");
                return;
            }

            const inputMasa = document.getElementById('cart-table-input').value.trim();
            const masaNo = inputMasa || localStorage.getItem('aktif_masa') || '1';
            localStorage.setItem('aktif_masa', masaNo);

            const toplamTutar = sepet.reduce((sum, item) => sum + (parseFloat(item.FixFiyat || 0) * item.adet), 0);
            const btn = document.getElementById('btn-siparis-ver');
            const orjinalIcerik = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> İletiliyor...';
            btn.disabled = true;

            fetch('/api/siparis-ver', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ masa_no: masaNo, urunler: sepet, toplam_tutar: toplamTutar })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    let gelenSiparisler = JSON.parse(localStorage.getItem('center_gelen_siparisler')) || [];
                    gelenSiparisler.push({ masa_no: masaNo, urunler: [...sepet], toplam_tutar: toplamTutar, zaman: new Date().toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' }) });
                    localStorage.setItem('center_gelen_siparisler', JSON.stringify(gelenSiparisler));
                    
                    let istatistik = JSON.parse(localStorage.getItem('center_siparis_istatistikleri')) || {};
                    sepet.forEach(item => {
                        if(!istatistik[item.UrunAd]) istatistik[item.UrunAd] = 0;
                        istatistik[item.UrunAd] += item.adet;
                    });
                    localStorage.setItem('center_siparis_istatistikleri', JSON.stringify(istatistik));

                    localStorage.setItem('center_siparis_durumu', '1');
                    checkOrderStatus();

                    sepet = [];
                    localStorage.setItem('center_sepet', JSON.stringify(sepet));
                    updateCartIcon();
                    closeCartModal();
                    showToast("Siparişiniz mutfağa iletildi!");
                } else {
                    alert('Sipariş iletilemedi: ' + (data.message || 'Bilinmeyen Hata'));
                }
            })
            .catch(err => {
                console.error("Sipariş Hatası:", err);
                alert('Sistemde bir bağlantı hatası oluştu.');
            })
            .finally(() => {
                btn.innerHTML = orjinalIcerik;
                btn.disabled = false;
            });
        }

        function checkOrderStatus() {
            const durum = localStorage.getItem('center_siparis_durumu');
            const tracker = document.getElementById('order-tracker');
            
            if(!durum) { tracker.classList.add('hidden'); return; }
            
            tracker.classList.remove('hidden');
            const masaNo = localStorage.getItem('aktif_masa') || '-';
            document.getElementById('tracker-table').textContent = 'Masa ' + masaNo;

            const progress = document.getElementById('tracker-progress');
            const s2i = document.getElementById('step-2-icon'); const s2t = document.getElementById('step-2-text');
            const s3i = document.getElementById('step-3-icon'); const s3t = document.getElementById('step-3-text');

            progress.style.width = '0%';
            s2i.className = "w-8 h-8 rounded-full flex items-center justify-center text-sm shadow-sm transition-all duration-700 bg-gray-200 text-gray-400";
            s2t.className = "text-[10px] font-bold uppercase tracking-wider transition-colors duration-700 text-gray-400";
            s3i.className = "w-8 h-8 rounded-full flex items-center justify-center text-sm shadow-sm transition-all duration-700 bg-gray-200 text-gray-400";
            s3t.className = "text-[10px] font-bold uppercase tracking-wider transition-colors duration-700 text-gray-400";

            if (durum === '2') {
                progress.style.width = '50%';
                s2i.className = "w-8 h-8 rounded-full flex items-center justify-center text-sm shadow-md transition-all duration-300 transform scale-110 bg-brandGold text-white";
                s2t.className = "text-[10px] font-extrabold uppercase tracking-wider transition-colors duration-700 text-brandGold";
            } else if (durum === '3') {
                progress.style.width = '100%';
                s2i.className = "w-8 h-8 rounded-full flex items-center justify-center text-sm shadow-sm transition-all duration-700 bg-gray-200 text-gray-400";
                s2t.className = "text-[10px] font-bold uppercase tracking-wider transition-colors duration-700 text-gray-400";
                s3i.className = "w-8 h-8 rounded-full flex items-center justify-center text-sm shadow-md transition-all duration-300 transform scale-110 bg-brandGreen text-white";
                s3t.className = "text-[10px] font-extrabold uppercase tracking-wider transition-colors duration-700 text-brandGreen";
                
                setTimeout(() => {
                    if(localStorage.getItem('center_siparis_durumu') === '3') {
                        tracker.classList.add('hidden');
                        localStorage.removeItem('center_siparis_durumu');
                    }
                }, 5000);
            }
        }
    </script>
</body>
</html>