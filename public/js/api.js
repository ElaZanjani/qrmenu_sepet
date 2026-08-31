// api.js - Frontend ile Backend arasındaki köprü

// 1. Veritabanından Ürünleri Getirme (GET) İşlemi
async function dbdenUrunleriGetir() {
    try {
        const response = await fetch('/api/menu');
        const sonuc = await response.json();
        
        if (sonuc.urunler) {
            return sonuc.urunler; 
        } else if (Array.isArray(sonuc)) {
            return sonuc;
        } else {
            return [];
        }
    } catch (hata) {
        console.error('API Bağlantı Hatası:', hata);
        return [];
    }
}

// 2. Veritabanına Yeni Ürün Ekleme (POST) İşlemi (CSRF ve Sanctum Token Destekli)
async function dbyeUrunEkle(formDataVerisi) {
    try {
        // Laravel'in sayfadan CSRF token'ını alıyoruz
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        let authToken = localStorage.getItem('center_admin_token') || '';

        // Token formatının 'Bearer ' ile başladığından emin oluyoruz (eksikse ekliyoruz)
        if (authToken && !authToken.startsWith('Bearer ')) {
            authToken = 'Bearer ' + authToken;
        }

        const response = await fetch('/api/urun-ekle', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken, // Laravel'in 419 hatasını engelleyen güvenlik anahtarı
                'Authorization': authToken // Sanctum yetkilendirme anahtarı
            },
            body: formDataVerisi 
        });
        
        const sonuc = await response.json();
        return sonuc; 
        
    } catch (hata) {
        console.error('Ürün ekleme isteği başarısız:', hata);
        return { status: 'error', message: 'Sunucuya ulaşılamadı. Lütfen bağlantınızı kontrol edin.' };
    }
}