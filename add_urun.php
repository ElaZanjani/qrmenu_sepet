<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

// FormData ile geldiği için $_POST doğru şekilde dolacak (admin.blade.php güncellendi)
$ad = $_POST['ad'] ?? '';
$kategori = $_POST['kategori'] ?? '';
$fiyat = $_POST['fiyat'] ?? 0;
$sira = $_POST['sira'] ?? 99;
$aciklama = $_POST['aciklama'] ?? null;
$alerjen = $_POST['alerjen'] ?? null;
$kalori = $_POST['kalori'] ?? null;
$sure = $_POST['sure'] ?? null;
$gluten = $_POST['is_gluten_free'] ?? 0;

if (!empty($ad) && !empty($kategori)) {
    $resimYolu = null;

    if (isset($_FILES['resim']) && $_FILES['resim']['error'] === UPLOAD_ERR_OK) {
        $dosyaAdi = time() . '_' . preg_replace("/[^a-zA-Z0-9\._-]/", "", $_FILES['resim']['name']);
        $hedefKlasor = __DIR__ . '/images/';
        if (!is_dir($hedefKlasor)) {
            mkdir($hedefKlasor, 0755, true);
        }
        if (move_uploaded_file($_FILES['resim']['tmp_name'], $hedefKlasor . $dosyaAdi)) {
            $resimYolu = 'images/' . $dosyaAdi;
        }
    }

    try {
        // ARTIK DOĞRU TABLOYA (t_urunkart) VE DOĞRU SÜTUN ADLARIYLA (SiraNo, UrunAciklama) YAZIYORUZ
        $sorgu = $db->prepare("INSERT INTO t_urunkart (UrunAd, UrunGrubu, FixFiyat, UrunAciklama, alerjen, kalori, is_gluten_free, resim_url, SiraNo)
                              VALUES (:ad, :kategori, :fiyat, :aciklama, :alerjen, :kalori, :gluten, :resim, :sira)");

        $sorgu->execute([
            ':ad' => $ad,
            ':kategori' => $kategori,
            ':fiyat' => $fiyat,
            ':aciklama' => $aciklama,
            ':alerjen' => $alerjen,
            ':kalori' => $kalori,
            ':gluten' => $gluten,
            ':resim' => $resimYolu,
            ':sira' => $sira
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Ürün başarıyla veritabanına eklendi!']);
    } catch(PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Veritabanı Hatası: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Lütfen Ürün Adı ve Kategoriyi boş bırakmayın.']);
}
?>