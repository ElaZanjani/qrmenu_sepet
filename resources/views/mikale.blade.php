<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mikale Yazılım | Sistem Kontrol Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brandDark: '#0a0a0a', brandGreen: '#00ff88', brandGold: '#D4AF37', brandBg: '#111827' },
                    fontFamily: { sans: ['Outfit', 'sans-serif'], mono: ['Fira Code', 'monospace'] }
                }
            }
        }
    </script>
</head>
<body class="bg-brandBg font-sans text-gray-200 min-h-screen">

    <div id="mikale-toast-container" class="fixed top-5 right-5 z-[300] flex flex-col gap-3 pointer-events-none"></div>

    <!-- LOGIN EKRANI -->
    <div id="login-screen" class="fixed inset-0 z-[200] bg-brandBg flex items-center justify-center">
        <div class="bg-gray-900 p-10 md:p-14 rounded-2xl shadow-2xl border border-brandGreen/30 w-full max-w-md flex flex-col items-center">
            <i class="fa-solid fa-terminal text-brandGreen text-4xl mb-4"></i>
            <h1 class="text-2xl font-bold text-white tracking-widest uppercase mb-1">MIKALE YAZILIM</h1>
            <p class="text-xs font-bold text-gray-500 tracking-[0.2em] uppercase mb-10">Özel Sistem Erişimi</p>

            <form class="w-full flex flex-col gap-6" onsubmit="event.preventDefault(); girisYap();">
                <div>
                    <label class="block text-[0.65rem] font-bold text-gray-500 uppercase tracking-widest mb-2">E-Posta</label>
                    <input type="email" id="login-email" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2.5 text-sm text-white focus:border-brandGreen focus:outline-none" placeholder="mikale@centercafe.com" required>
                </div>
                <div>
                    <label class="block text-[0.65rem] font-bold text-gray-500 uppercase tracking-widest mb-2">Şifre</label>
                    <input type="password" id="login-pass" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2.5 text-sm text-white focus:border-brandGreen focus:outline-none" placeholder="••••••••" required>
                </div>
                <button type="submit" class="w-full bg-brandGreen text-brandDark py-3 rounded-lg font-bold uppercase tracking-widest text-sm hover:opacity-90 transition-all">
                    <i class="fa-solid fa-lock-open mr-1"></i> Erişim Sağla
                </button>
            </form>
            <p id="login-error" class="text-xs text-red-400 font-bold text-center mt-4 hidden">Erişim reddedildi!</p>
        </div>
    </div>

    <!-- ANA PANEL -->
    <div id="app-content" class="w-full hidden">
        <header class="border-b border-gray-800 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-shield-halved text-brandGreen text-xl"></i>
                <div>
                    <h1 class="font-bold text-white text-sm tracking-widest uppercase">Mikale Kontrol Paneli</h1>
                    <p class="text-[0.65rem] text-gray-500">Center Cafe QR Menü Sistemi</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="/admin" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg text-xs font-bold transition-all"><i class="fa-solid fa-arrow-left mr-1"></i> Normal Admin Panele Git</a>
                <button onclick="cikisYap()" class="bg-red-900/50 hover:bg-red-900 text-red-300 px-4 py-2 rounded-lg text-xs font-bold transition-all"><i class="fa-solid fa-power-off mr-1"></i> Çıkış</button>
            </div>
        </header>

        <main class="p-6 max-w-6xl mx-auto flex flex-col gap-6">

            <!-- SİSTEM DURUMU -->
            <section>
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4"><i class="fa-solid fa-gauge-high text-brandGreen mr-2"></i>Sistem Durumu</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="durum-grid">
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Laravel</p>
                        <p class="text-lg font-bold text-white mt-1" id="durum-laravel">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">PHP</p>
                        <p class="text-lg font-bold text-white mt-1" id="durum-php">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Debug Modu</p>
                        <p class="text-lg font-bold mt-1" id="durum-debug">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Boş Disk Alanı</p>
                        <p class="text-lg font-bold text-white mt-1" id="durum-disk">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Toplam Ürün</p>
                        <p class="text-lg font-bold text-brandGreen mt-1" id="durum-urun">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Toplam Kategori</p>
                        <p class="text-lg font-bold text-brandGreen mt-1" id="durum-kategori">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Bugünkü Sipariş</p>
                        <p class="text-lg font-bold text-brandGold mt-1" id="durum-siparis">-</p>
                    </div>
                    <div class="bg-gray-900 border border-gray-800 rounded-xl p-4">
                        <p class="text-[0.65rem] text-gray-500 uppercase font-bold">Bekleyen Garson Çağrısı</p>
                        <p class="text-lg font-bold text-amber-400 mt-1" id="durum-garson">-</p>
                    </div>
                </div>
            </section>

            <!-- CANLI LOGLAR -->
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest"><i class="fa-solid fa-scroll text-brandGreen mr-2"></i>Canlı Sistem Logları (Son 200 Satır)</h2>
                    <button onclick="loglariYenile()" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg text-xs font-bold transition-all"><i class="fa-solid fa-rotate mr-1"></i> Yenile</button>
                </div>
                <div class="bg-black border border-gray-800 rounded-xl p-4 max-h-[500px] overflow-y-auto">
                    <pre id="log-icerik" class="font-mono text-xs text-gray-400 whitespace-pre-wrap break-words">Loglar yükleniyor...</pre>
                </div>
            </section>

            <!-- HIZLI ERİŞİM: ADMİN PANEL İÇERİĞİ -->
            <section>
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4"><i class="fa-solid fa-toolbox text-brandGreen mr-2"></i>Hızlı İşlemler</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="/admin" class="bg-gray-900 border border-gray-800 hover:border-brandGreen rounded-xl p-5 flex flex-col items-center gap-2 transition-all">
                        <i class="fa-solid fa-burger text-brandGreen text-xl"></i>
                        <span class="text-xs font-bold text-gray-300">Ürün Yönetimi</span>
                    </a>
                    <a href="/admin" class="bg-gray-900 border border-gray-800 hover:border-brandGreen rounded-xl p-5 flex flex-col items-center gap-2 transition-all">
                        <i class="fa-solid fa-cash-register text-brandGreen text-xl"></i>
                        <span class="text-xs font-bold text-gray-300">Kasa & Masalar</span>
                    </a>
                    <a href="/admin" class="bg-gray-900 border border-gray-800 hover:border-brandGreen rounded-xl p-5 flex flex-col items-center gap-2 transition-all">
                        <i class="fa-solid fa-sliders text-brandGreen text-xl"></i>
                        <span class="text-xs font-bold text-gray-300">Site Ayarları</span>
                    </a>
                    <a href="/mutfak" class="bg-gray-900 border border-gray-800 hover:border-brandGreen rounded-xl p-5 flex flex-col items-center gap-2 transition-all">
                        <i class="fa-solid fa-kitchen-set text-brandGreen text-xl"></i>
                        <span class="text-xs font-bold text-gray-300">Mutfak Ekranı</span>
                    </a>
                </div>
                <p class="text-[0.65rem] text-gray-600 mt-4">Not: Ürün/kategori/kasa gibi detaylı işlemler için normal Admin Panel'i kullanın — bu ekran sadece sistem sağlığını izlemek ve teknik sorun gidermek içindir.</p>
            </section>

        </main>
    </div>

    <script>
        function showToast(msg, color = 'bg-brandGreen') {
            const container = document.getElementById('mikale-toast-container');
            const toast = document.createElement('div');
            toast.className = `${color} text-brandDark px-5 py-3 rounded-lg shadow-2xl font-bold text-sm pointer-events-auto`;
            toast.textContent = msg;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        function getAuthHeaders() {
            return {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Authorization': localStorage.getItem('mikale_token') || ''
            };
        }

        function checkLoginState() {
            const token = localStorage.getItem('mikale_token');
            if (token) {
                document.getElementById('login-screen').classList.add('hidden');
                document.getElementById('app-content').classList.remove('hidden');
                verileriYukle();
            } else {
                document.getElementById('login-screen').classList.remove('hidden');
                document.getElementById('app-content').classList.add('hidden');
            }
        }

        function girisYap() {
            const email = document.getElementById('login-email').value.trim();
            const pass = document.getElementById('login-pass').value.trim();
            const errorMsg = document.getElementById('login-error');
            errorMsg.classList.add('hidden');

            fetch('/api/admin-login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                body: JSON.stringify({ email, password: pass })
            })
            .then(res => res.json())
            .then(data => {
                if (data.durum === 'basarili') {
                    localStorage.setItem('mikale_token', "Bearer " + data.token);
                    checkLoginState();
                } else {
                    errorMsg.textContent = data.mesaj || "E-posta veya şifre hatalı!";
                    errorMsg.classList.remove('hidden');
                }
            })
            .catch(() => {
                errorMsg.textContent = "Sunucuya bağlanılamadı!";
                errorMsg.classList.remove('hidden');
            });
        }

        function cikisYap() {
            localStorage.removeItem('mikale_token');
            checkLoginState();
        }

        function verileriYukle() {
            fetch('/api/mikale-durum', { headers: getAuthHeaders() })
                .then(res => res.json())
                .then(data => {
                    if (!data.basarili) return;
                    document.getElementById('durum-laravel').textContent = data.laravel_versiyon;
                    document.getElementById('durum-php').textContent = data.php_versiyon;
                    const debugEl = document.getElementById('durum-debug');
                    debugEl.textContent = data.debug_modu;
                    debugEl.className = data.debug_modu.includes('RİSKLİ') ? 'text-lg font-bold text-red-400 mt-1' : 'text-lg font-bold text-brandGreen mt-1';
                    document.getElementById('durum-disk').textContent = data.disk_bos_alan_gb + ' GB';
                    document.getElementById('durum-urun').textContent = data.toplam_urun;
                    document.getElementById('durum-kategori').textContent = data.toplam_kategori;
                    document.getElementById('durum-siparis').textContent = data.bugunku_siparis;
                    document.getElementById('durum-garson').textContent = data.bekleyen_garson_cagrisi;
                })
                .catch(() => showToast('Sistem durumu alınamadı!', 'bg-red-500'));

            loglariYenile();
        }

        function loglariYenile() {
            fetch('/api/mikale-loglar', { headers: getAuthHeaders() })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('log-icerik').textContent = data.log || 'Log bulunamadı.';
                })
                .catch(() => {
                    document.getElementById('log-icerik').textContent = 'Loglar yüklenirken hata oluştu.';
                });
        }

        document.addEventListener('DOMContentLoaded', checkLoginState);
    </script>
</body>
</html>