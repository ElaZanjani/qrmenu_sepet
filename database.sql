-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                8.4.3 - MySQL Community Server - GPL
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- tablo yapısı dökülüyor qrmenu_sepet_db.ayarlar
CREATE TABLE IF NOT EXISTS `ayarlar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sirket_adi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wifi_sifresi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adres` text COLLATE utf8mb4_unicode_ci,
  `yorum_linki` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.ayarlar: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `ayarlar` (`id`, `sirket_adi`, `wifi_sifresi`, `telefon`, `adres`, `yorum_linki`, `created_at`, `updated_at`) VALUES
	(1, 'Center Cafe & Bistro', 'center2026', '+90 555 123 45 67', 'Merkez Mah. No:123', 'https://search.google.com/local/writereview?placeid=ChIJN1t_tDeuEmsRUsoyG83frY4', NULL, NULL);

-- tablo yapısı dökülüyor qrmenu_sepet_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.failed_jobs: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor qrmenu_sepet_db.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.forms: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor qrmenu_sepet_db.kasa_z_raporlari
CREATE TABLE IF NOT EXISTS `kasa_z_raporlari` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tarih` date NOT NULL,
  `nakit_toplam` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kredi_karti_toplam` decimal(10,2) NOT NULL DEFAULT '0.00',
  `yemek_karti_toplam` decimal(10,2) NOT NULL DEFAULT '0.00',
  `veresiye_toplam` decimal(10,2) NOT NULL DEFAULT '0.00',
  `islemler` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.kasa_z_raporlari: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `kasa_z_raporlari` (`id`, `tarih`, `nakit_toplam`, `kredi_karti_toplam`, `yemek_karti_toplam`, `veresiye_toplam`, `islemler`, `created_at`, `updated_at`) VALUES
	(1, '2026-08-23', 500.00, 750.00, 0.00, 0.00, '[]', '2026-08-23 14:03:18', '2026-08-23 14:03:18');

-- tablo yapısı dökülüyor qrmenu_sepet_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.migrations: ~10 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2021_07_06_095005_create_urun_karts_table', 1),
	(2, '2021_07_07_072755_create_urun_grubus_table', 1),
	(15, '2014_10_12_000000_create_users_table', 2),
	(16, '2014_10_12_100000_create_password_resets_table', 2),
	(17, '2019_08_19_000000_create_failed_jobs_table', 2),
	(18, '2021_07_26_135652_create_ayars_table', 2),
	(19, '2021_07_28_120402_create_qr_code_karts_table', 3),
	(21, '2021_07_28_133230_create_qr_code_cagris_table', 4),
	(22, '2023_12_14_175833_create_forms_table', 5),
	(23, '2026_08_14_000001_create_desktop_sync_tables', 6);

-- tablo yapısı dökülüyor qrmenu_sepet_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.password_resets: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_anagrup
CREATE TABLE IF NOT EXISTS `t_anagrup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `anaGrup` varchar(100) NOT NULL,
  `siraNo` int NOT NULL,
  `anaGrupResimPath` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- qrmenu_sepet_db.t_anagrup: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_ayar
CREATE TABLE IF NOT EXISTS `t_ayar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `baslik` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.t_ayar: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `t_ayar` (`id`, `logo`, `url`, `baslik`) VALUES
	(1, 'logo.png', 'https://centercafe.mikaleyazilim.com', 'Center Cafe QR Menü');

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_masalar
CREATE TABLE IF NOT EXISTS `t_masalar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `isim` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `durum` tinyint NOT NULL DEFAULT '0',
  `guncel_tutar` decimal(10,2) NOT NULL DEFAULT '0.00',
  `siparisler` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_masalar_isim_unique` (`isim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.t_masalar: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `t_masalar` (`id`, `isim`, `durum`, `guncel_tutar`, `siparisler`, `created_at`, `updated_at`) VALUES
	(1, 'Test Masası', 1, 150.00, '[]', '2026-08-23 14:03:00', '2026-08-23 14:03:00');

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_qrcodecagri
CREATE TABLE IF NOT EXISTS `t_qrcodecagri` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Masa_id` int NOT NULL,
  `QRCode` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Masaismi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Personel_id` int NOT NULL,
  `Cagri_zamani` datetime NOT NULL,
  `Status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.t_qrcodecagri: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `t_qrcodecagri` (`id`, `Masa_id`, `QRCode`, `Masaismi`, `Personel_id`, `Cagri_zamani`, `Status`) VALUES
	(1, 1, '3213248946', 'MASA 33', 0, '2021-07-28 17:08:24', 0),
	(3, 1, '3213248946', 'MASA 33', 0, '2021-07-28 17:09:31', 0),
	(4, 1, '3213248946', 'MASA 33', 0, '2021-07-28 17:17:44', 0);

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_qrcodekart
CREATE TABLE IF NOT EXISTS `t_qrcodekart` (
  `id_QRCode` bigint unsigned NOT NULL AUTO_INCREMENT,
  `QRCode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cari_id` int NOT NULL,
  `QRTur` int NOT NULL,
  `KullaniciParola` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Masa_id` int NOT NULL,
  `Masaismi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MusteriAd` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `KullaniciAd` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Personel_id` int NOT NULL,
  `Status` int NOT NULL,
  PRIMARY KEY (`id_QRCode`),
  KEY `t_qrcodekart_cari_id_index` (`Cari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.t_qrcodekart: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `t_qrcodekart` (`id_QRCode`, `QRCode`, `Cari_id`, `QRTur`, `KullaniciParola`, `Masa_id`, `Masaismi`, `MusteriAd`, `KullaniciAd`, `Personel_id`, `Status`) VALUES
	(1, '3213248946', 1, 1, '', 1, 'MASA 33', '', '', 0, 1);

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_urungrubu
CREATE TABLE IF NOT EXISTS `t_urungrubu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `UrunGrubu_id` int NOT NULL,
  `Sirano` int NOT NULL,
  `Urungrubu` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Dil_id` int DEFAULT NULL,
  `UrunGrubuResimPath` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnaGrup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_urungrubu_urungrubu_id_unique` (`UrunGrubu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.t_urungrubu: ~30 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `t_urungrubu` (`id`, `UrunGrubu_id`, `Sirano`, `Urungrubu`, `Dil_id`, `UrunGrubuResimPath`, `AnaGrup`) VALUES
	(1, 1, 1, 'KAHVALTILAR', NULL, NULL, 'KAHVALTILAR'),
	(2, 2, 2, 'SAHANDA', NULL, NULL, 'KAHVALTILAR'),
	(3, 3, 3, 'OMLET', NULL, NULL, 'KAHVALTILAR'),
	(4, 4, 4, 'KENDİ KAHVALTINI YARAT', NULL, NULL, 'KAHVALTILAR'),
	(5, 5, 5, 'TATLILAR', NULL, NULL, 'TATLILAR'),
	(6, 6, 6, 'SÜTLÜ TATLI', NULL, NULL, 'TATLILAR'),
	(7, 7, 7, 'PASTALAR', NULL, NULL, 'TATLILAR'),
	(8, 8, 8, 'ŞERBETLİ TATLI', NULL, NULL, 'TATLILAR'),
	(9, 9, 9, 'KİLOLUK ÜRÜNLER', NULL, NULL, 'TATLILAR'),
	(10, 10, 10, 'KEKLER', NULL, NULL, 'TATLILAR'),
	(11, 11, 11, 'İLAVELER', NULL, NULL, 'TATLILAR'),
	(12, 12, 12, 'SICAK İÇECEKLER', NULL, NULL, 'SICAK İÇECEKLER'),
	(13, 13, 13, 'DÜNYA KAHVELERİ', NULL, NULL, 'SICAK İÇECEKLER'),
	(14, 14, 14, 'BİTKİ ÇAYI', NULL, NULL, 'SICAK İÇECEKLER'),
	(15, 15, 15, 'SOĞUK İÇECEKLER', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(16, 16, 16, 'SOĞUK KAHVELER', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(17, 17, 17, 'MEŞRUBATLAR', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(18, 18, 18, 'FROZEN', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(19, 19, 19, 'SMOOTHIE', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(20, 20, 20, 'MILKSHAKE', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(21, 21, 21, 'FRAPPE', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(22, 22, 22, 'KOKTEYL & DETOX', NULL, NULL, 'SOĞUK İÇECEKLER'),
	(23, 23, 23, 'DONDURMALAR', NULL, NULL, 'DONDURMALAR'),
	(24, 24, 24, 'GÖZLEME & TOST', NULL, NULL, 'GÖZLEME & TOST'),
	(25, 25, 25, 'GÖZLEMELER', NULL, NULL, 'GÖZLEME & TOST'),
	(26, 26, 26, 'TOSTLAR', NULL, NULL, 'GÖZLEME & TOST'),
	(27, 27, 27, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, NULL, 'GÖZLEME & TOST'),
	(28, 28, 28, 'KÖY EKMEĞİ TOSTLAR', NULL, NULL, 'GÖZLEME & TOST'),
	(29, 29, 29, 'APERATİFLER', NULL, NULL, 'GÖZLEME & TOST'),
	(30, 30, 30, 'ANA YEMEKLER', NULL, NULL, 'ANA YEMEKLER');

-- tablo yapısı dökülüyor qrmenu_sepet_db.t_urunkart
CREATE TABLE IF NOT EXISTS `t_urunkart` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Urun_id` int DEFAULT NULL,
  `UrunTip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunKod` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunAd` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunAdKisa` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunAciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `UrunGrubu` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunGrubu_id` int DEFAULT NULL,
  `FixFiyat` double DEFAULT NULL,
  `SiraNo` int NOT NULL DEFAULT '0',
  `P_Yarim` double DEFAULT NULL,
  `P_Birbucuk` double DEFAULT NULL,
  `P_Duble` double DEFAULT NULL,
  `Porsiyon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ExtraOzellik` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Barkod` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunBirim` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FixFiyat2` double DEFAULT NULL,
  `FixFiyat3` double DEFAULT NULL,
  `Departman` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UrunResimPath` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `AltGrup` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ch_Gram` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Upd_Tarih` datetime NOT NULL DEFAULT '2021-01-01 00:00:00',
  `CokSatan` int DEFAULT NULL,
  `textraozellik` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `P_Tanim` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `resim_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_gluten_free` tinyint(1) DEFAULT '0',
  `Aciklama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `Sira` int DEFAULT '1',
  `kalori` int DEFAULT NULL,
  `sure` int DEFAULT NULL,
  `alerjen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_urunkart_urun_id_unique` (`Urun_id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.t_urunkart: ~225 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `t_urunkart` (`id`, `Urun_id`, `UrunTip`, `UrunKod`, `UrunAd`, `UrunAdKisa`, `UrunAciklama`, `UrunGrubu`, `UrunGrubu_id`, `FixFiyat`, `SiraNo`, `P_Yarim`, `P_Birbucuk`, `P_Duble`, `Porsiyon`, `ExtraOzellik`, `Barkod`, `UrunBirim`, `FixFiyat2`, `FixFiyat3`, `Departman`, `UrunResimPath`, `AltGrup`, `Ch_Gram`, `Upd_Tarih`, `CokSatan`, `textraozellik`, `P_Tanim`, `resim_url`, `is_gluten_free`, `Aciklama`, `Sira`, `kalori`, `sure`, `alerjen`) VALUES
	(2, NULL, NULL, NULL, 'SİNİ KAHVALTI', NULL, NULL, 'KAHVALTILAR', NULL, 650, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786346020_1678709243640f11fb59cf4.jpeg', 0, 'Acuka, Reçel, Süt reçeli, Çikolata, Tereyağ, Baharatlı zeytinyağ, karışık zeytin, Söğüş tabağı, Beyaz peynir, Kelle peyniri, Çeçil peyniri, Misket peyniri, Salam, Bal kaymak, Göz yumurta, Sucuk, Simit, Sinirsız Çay. (2 kişiliktir.)', 1, 150, 15, NULL),
	(3, NULL, NULL, NULL, 'AVOKADO EKMEK', NULL, NULL, 'KAHVALTILAR', NULL, 380, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786346329_1733062794674c708a6d3e5.jpeg', 0, 'Kızarmış Köy Ekmeği Üzeri Avokado(Avokado tuz limon zeytinyağı ile eziliyor.), 2 Adet Pose Yumurta, Salata(Roka, Marul, Havuç, Çeri Domates Üzerine Zeytinyağı.), Lor(Üzerine Çörek otu ve ceviz.)', 1, 100, 15, NULL),
	(4, NULL, NULL, NULL, 'HAŞLANMIŞ YUMURTALI SPORCU KAHVALTI', NULL, NULL, 'KAHVALTILAR', NULL, 320, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786346489_1733062086674c6dc67914b.jpeg', 0, '3 Haşlanmış Yumurta, Salata(roka, marul, havuç, çeri domates), Lor Peyniri Üzerine Az Zeytinyağı Çörek Otu, Ceviz, 2 Adet Siyah 3 Adet Yeşil Zeytin, 1 Büyük Dilim Kızarmış Köy Ekmeği, Bal', 1, 100, 15, NULL),
	(5, NULL, NULL, NULL, 'ÇIRPILMIŞ YUMURTALI SPORCU KAHVALTI', NULL, NULL, 'KAHVALTILAR', NULL, 320, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786346665_1733061994674c6d6a5ed89.jpeg', 0, '3 Yumurtadan Çırpılmış, Salata(roka, marul, havuç, çeri domates), Lor Peyniri Üzerine Az Zeytinyağı Çörek Otu, Ceviz, 2 Adet Siyah 3 Adet Yeşil Zeytin, 1 Büyük Dilim Kızarmış Köy Ekmeği, Bal', 1, 100, 15, NULL),
	(6, NULL, NULL, NULL, 'KAHVALTI TABAĞI', NULL, NULL, 'KAHVALTILAR', NULL, 400, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786346835_1678708903640f10a78391e.jpeg', 0, '1 adet haşlanmış yumurta, Acuka, Reçel, Tereyağ, Baharatlı Zeytinyağ, Karışık zeytin, Söğüş Tabağı, Beyaz Peynir, Kelle Peyniri, Çikolata, 2 adet çay', 1, 150, 20, NULL),
	(7, NULL, NULL, NULL, 'PİŞİ TABAĞI', NULL, NULL, 'KAHVALTILAR', NULL, 300, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786346939_1678709082640f115ab222c.jpeg', 0, '2 adet pişi, Acuka, Karışık zeytin, Otlu peynir, Çikolata, 1 adet haşlanmış yumurta, söğüş tabağı, 1 Adet Çay', 1, 150, 15, NULL),
	(8, NULL, NULL, NULL, 'EKMEK ÜSTÜ MENEMEN', NULL, NULL, 'KAHVALTILAR', NULL, 310, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786347052_1733234708674f1014cc8aa.jpeg', 0, 'Kızarmış köy ekmeği üzerine menemen, Roka, Marul, Havuç, Çeri Domates, Kelle, Beyaz Peynir, 5 Adet Zeytin', 1, 170, 20, NULL),
	(9, NULL, NULL, NULL, 'SİMİT TABAĞI', NULL, NULL, 'KAHVALTILAR', NULL, 300, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786347190_1678708490640f0f0a3ebf2.jpeg', 0, '1 adet simit, Bal, Acuka, Karışık zeytin, Beyaz peynir, Kelle peyniri, Söğüş tabağı, 1 adet çay', 1, 135, 10, NULL),
	(10, NULL, NULL, NULL, 'PANKEK KAHVALTI', NULL, NULL, 'KAHVALTILAR', NULL, 320, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786347360_1733075458674ca2022395a.jpeg', 0, '5 Adet Pankek, Reçel, Çikolata, Bal, Mevsim Meyvesi, Kayısı, Ceviz', 1, 150, 15, NULL),
	(11, NULL, NULL, NULL, 'ÇOCUK KAHVALTISI', NULL, NULL, 'KAHVALTILAR', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786347432_1733062216674c6e4891719.jpeg', 0, '2 Adet Yumurta(Göz Tavada Pişmiş), Patates Kızartması, 1 Sigara Böreği, 2 Adet Sosis, Salatalık, Domates, Peynir, Çikolata', 1, 155, 15, NULL),
	(12, NULL, NULL, NULL, 'KAVURMALI MENEMEN', NULL, NULL, 'SAHANDA', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384243_169277616464e5b6e48c65164e5b6e8168df.jpg', 0, NULL, 1, 100, 15, NULL),
	(13, NULL, NULL, NULL, 'KIYMALI MENEMEN', NULL, NULL, 'SAHANDA', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384398_169277616464e5b6e48c65164e5b6e8168df.jpg', 0, NULL, 1, 100, 15, NULL),
	(14, NULL, NULL, NULL, 'SUCUKLU MENEMEN', NULL, NULL, 'SAHANDA', NULL, 235, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384547_169277621364e5b71516f3664e5b718a2066.jpg', 0, NULL, 1, 100, 15, NULL),
	(15, NULL, NULL, NULL, 'KAŞARLI MENEMEN', NULL, NULL, 'SAHANDA', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384645_169277697364e5ba0d1db1364e5ba10e50c0.jpg', 0, NULL, 1, 100, 6, NULL),
	(16, NULL, NULL, NULL, 'MENEMEN', NULL, NULL, 'SAHANDA', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384724_169277708064e5ba78968b064e5ba7c3467f.jpg', 0, NULL, 1, 100, 15, NULL),
	(17, NULL, NULL, NULL, 'SUCUKLU YUMURTA', NULL, NULL, 'SAHANDA', NULL, 225, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384804_169277537064e5b3caad91064e5b3ce6374e.jpg', 0, NULL, 1, 100, 15, NULL),
	(18, NULL, NULL, NULL, 'OTLU BEYAZ PEYNİRLİ YUMURTA', NULL, NULL, 'SAHANDA', NULL, 210, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384871_169277554064e5b4741d1ea64e5b477993b0.jpg', 0, NULL, 1, 100, 15, NULL),
	(19, NULL, NULL, NULL, 'BEYAZ PEYNİRLİ YUMURTA', NULL, NULL, 'SAHANDA', NULL, 200, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384926_169277551264e5b458ebab064e5b45ca950f.jpg', 0, NULL, 1, 100, 15, NULL),
	(20, NULL, NULL, NULL, 'GÖZ YUMURTA (2 Adet)', NULL, NULL, 'SAHANDA', NULL, 180, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786384988_169277533864e5b3aa4eaee64e5b3ae6da0e.jpg', 0, NULL, 1, NULL, NULL, NULL),
	(21, NULL, NULL, NULL, 'SUCUK KAŞAR OMLET', NULL, NULL, 'OMLET', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786385117_169277783664e5bd6c9d3cd64e5bd700bc1a.jpg', 0, 'Zeytin ve Söğüş ile servis edilir. ( 3 yumurta)', 1, NULL, NULL, NULL),
	(22, NULL, NULL, NULL, 'OTLU OMLET', NULL, NULL, 'OMLET', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786385229_169277783664e5bd6c9d3cd64e5bd700bc1a.jpg', 0, 'Ispanak, dereotu ve maydanoz bulunmaktadır. Zeytin ve Söğüş ile servis edilir. ( 3 yumurta)', 1, 150, 15, NULL),
	(23, NULL, NULL, NULL, 'DOMATES BEYAZ PEYNİRLİ OMLET', NULL, NULL, 'OMLET', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786385309_169277785964e5bd839f34b64e5bd8767789.jpg', 0, 'Zeytin ve Söğüş ile servis edilir. ( 3 yumurta)', 1, 150, 15, NULL),
	(24, NULL, NULL, NULL, 'KAŞARLI OMLET', NULL, NULL, 'OMLET', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786385373_169277788664e5bd9e3b05164e5bda1a9698.jpg', 0, 'Zeytin ve Söğüş ile servis edilir. ( 3 yumurta)', 1, 150, 15, NULL),
	(25, NULL, NULL, NULL, 'SADE OMLET', NULL, NULL, 'OMLET', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786385434_169277746764e5bbfb3d45664e5bbfed4f37.jpg', 0, 'Zeytin ve söğüş ile servis edilir. (3 Yumurta)', 1, 150, 15, NULL),
	(26, NULL, NULL, NULL, 'SİMİT', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 30, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 50, 5, NULL),
	(27, NULL, NULL, NULL, 'Lor', NULL, NULL, NULL, NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 30, 5, NULL),
	(28, NULL, NULL, NULL, 'Reçel', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 60, 5, NULL),
	(29, NULL, NULL, NULL, 'BAL', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 50, 5, NULL),
	(30, NULL, NULL, NULL, 'BAL KAYMAK', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 180, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 80, 5, NULL),
	(31, NULL, NULL, NULL, 'ÇİKOLATA', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 60, 5, NULL),
	(32, NULL, NULL, NULL, 'TAHİN PEKMEZ', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 70, 5, NULL),
	(33, NULL, NULL, NULL, 'TEREYAĞ', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 50, 5, NULL),
	(34, NULL, NULL, NULL, 'BAHARATLI ZEYTİNYAĞ', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 50, 5, NULL),
	(35, NULL, NULL, NULL, 'ZEYTİN', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, 'Siyah, Yeşilç', 1, 50, 5, NULL),
	(36, NULL, NULL, NULL, 'ACUKA', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 69, 5, NULL),
	(37, NULL, NULL, NULL, 'PEYNİR TABAĞI (KÜÇÜK)', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 120, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 150, 10, NULL),
	(38, NULL, NULL, NULL, 'YUMURTALI EKMEK', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 100, 10, NULL),
	(39, NULL, NULL, NULL, 'PİŞİ', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, '2 Adet', 1, 100, 15, NULL),
	(40, NULL, NULL, NULL, 'SİGARA BÖREĞİ', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, '2 Adet', 1, 100, 15, NULL),
	(41, NULL, NULL, NULL, 'HAŞLANMIŞ YUMURTA', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 35, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 100, 10, NULL),
	(42, NULL, NULL, NULL, 'KAYMAK', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 120, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 60, 5, NULL),
	(43, NULL, NULL, NULL, 'PEYNİR TABAĞI', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786386447_169278390064e5d51ca52ec64e5d5214b9c0.jpg', 0, 'Beyaz peynir, Kelle peyniri, Çeçil peynir, Misket peynir, Salam', 1, 100, 10, NULL),
	(44, NULL, NULL, NULL, 'SÖĞÜŞ TABAĞI', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 170, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786386565_169277800164e5be118330f64e5be158d33c.jpg', 0, NULL, 1, 50, 10, NULL),
	(45, NULL, NULL, NULL, 'PATATES KIZARTMASI', NULL, NULL, 'KENDİ KAHVALTINI YARAT', NULL, 180, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786386639_169277792464e5bdc4b566b64e5bdc87ae1b.jpg', 0, NULL, 1, 150, 15, NULL),
	(46, NULL, NULL, NULL, 'MAGNOLİA OREO', NULL, NULL, 'TATLILAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786431654_1703918888658fbd2868df3658fbd2cee113.jpg', 0, NULL, 1, 200, 20, NULL),
	(47, NULL, NULL, NULL, 'MAGNOLİA ÇİLEK', NULL, NULL, 'TATLILAR', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786431760_1687888262649b2186088f5.jpeg', 0, 'Çilek, Muz ve Oreo(+10TL) seçenekleri ile.', 1, 200, 20, NULL),
	(48, NULL, NULL, NULL, 'MAGNOLİA MUZ', NULL, NULL, 'TATLILAR', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 2000, 20, NULL),
	(49, NULL, NULL, NULL, 'HÖŞMERİM', NULL, NULL, 'TATLILAR', NULL, 190, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432049_1687888241649b21713f3df.jpeg', 0, NULL, 1, 200, 20, NULL),
	(50, NULL, NULL, NULL, 'TRİLEÇE', NULL, NULL, 'TATLILAR', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432175_1687888220649b215ca87a3.jpeg', 0, 'Frambuaz ve Karamel seçenekleri ile', 1, 200, 20, NULL),
	(51, NULL, NULL, NULL, 'FISTIK BOMBA', NULL, NULL, 'TATLILAR', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432279_1687888354649b21e26b5d3.jpeg', 0, NULL, 1, 200, 20, 'Fıstık'),
	(52, NULL, NULL, NULL, 'PROFİTEROL', NULL, NULL, 'TATLILAR', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432353_1687888016649b2090a60e9.jpeg', 0, NULL, 1, 250, 3, NULL),
	(53, NULL, NULL, NULL, 'SUPANGLE', NULL, NULL, 'TATLILAR', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432425_1687888047649b20afd64ee.jpeg', 0, NULL, 1, 250, 3, NULL),
	(54, NULL, NULL, NULL, 'KEŞKÜL', NULL, NULL, 'TATLILAR', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432508_1687887788649b1fac3f5b3.jpeg', 0, NULL, 1, 250, 3, NULL),
	(55, NULL, NULL, NULL, 'KAZANDİBİ', NULL, NULL, 'TATLILAR', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432588_1687888063649b20bfcdc03.jpeg', 0, NULL, 1, 250, 3, NULL),
	(56, NULL, NULL, NULL, 'SÜTLAÇ', NULL, NULL, 'TATLILAR', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432712_1687887777649b1fa15144c.jpeg', 0, NULL, 1, 250, 3, NULL),
	(57, NULL, NULL, NULL, 'DUBAİ', NULL, NULL, 'TATLILAR', NULL, 270, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786432804_1765464433693ad9717450f.jpeg', 0, NULL, 1, 250, 3, 'Fıstık'),
	(58, NULL, NULL, NULL, 'YAŞ PASTA', NULL, NULL, 'PASTALAR', NULL, 1000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786512840_17703034316984afc7a099c6984afcb60a31.jpg', 0, 'meyveli - çikolatalı seçeneği ile', 1, 250, 3, NULL),
	(59, NULL, NULL, NULL, 'MOZAİK PASTA', NULL, NULL, 'PASTALAR', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 3, NULL),
	(60, NULL, NULL, NULL, 'SNICKERS PASTA', NULL, NULL, 'PASTALAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786635526_1687888572649b22bc2a6eb.jpeg', 0, NULL, 1, 250, 3, NULL),
	(61, NULL, NULL, NULL, 'BUDAPEŞTE PASTA', NULL, NULL, 'PASTALAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786635582_1687888511649b227f00492.jpeg', 0, NULL, 1, 250, 3, NULL),
	(62, NULL, NULL, NULL, 'RED VELVET PASTA', NULL, NULL, 'PASTALAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786635760_1687888487649b226720040.jpeg', 0, NULL, 1, 250, 3, NULL),
	(63, NULL, NULL, NULL, 'MUZLU RULO PASTA', NULL, NULL, 'PASTALAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786635821_1687888460649b224c67fb9.jpeg', 0, NULL, 1, 250, 3, NULL),
	(64, NULL, NULL, NULL, 'SAN SEBASTIAN CHEESECAKE', NULL, NULL, 'PASTALAR', NULL, 260, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786635888_1687888400649b2210457a4.jpeg', 0, 'Süt reçeli ve Çikolata sosu seçeneği ile.', 1, 250, 3, 'Süt'),
	(65, NULL, NULL, NULL, 'WAFFLE', NULL, NULL, 'PASTALAR', NULL, 350, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786635978_1687888373649b21f55c6b9.jpeg', 0, 'Belçika çikolatası, Muz, Çilek, Şeftali, 1 Top dondurma,(Mevsim geçişlerine göre meyveler değişiklik gösterebilir:)', 1, 250, 10, NULL),
	(66, NULL, NULL, NULL, 'ÇİKOLATALI KÖSTEBEK PASTA', NULL, NULL, 'PASTALAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636060_174065987667c05ca46ce40.jpeg', 0, NULL, 1, 250, 3, NULL),
	(67, NULL, NULL, NULL, 'PINATA CAKE', NULL, NULL, 'PASTALAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636140_174610788268137deaaa7a368137dece13c3.jpg', 0, NULL, 1, 250, 3, NULL),
	(68, NULL, NULL, NULL, 'EKLER', NULL, NULL, 'PASTALAR', NULL, 50, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636254_169323332164ecb0a9a58ca64ecb0adad976.jpg', 0, '1 ADET 50, 5 ADET 250', 1, 250, 3, NULL),
	(69, NULL, NULL, NULL, 'ANTEP FISTIĞI', NULL, NULL, 'PASTALAR', NULL, 350, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636400_17472388356824bfb3421a76824bfb5173ba.jpg', 0, NULL, 1, 25, 3, NULL),
	(70, NULL, NULL, NULL, 'FRANSIZ EKLER', NULL, NULL, 'PASTALAR', NULL, 260, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636462_1765464433693ad9717450f.jpeg', 0, NULL, 1, 250, 3, NULL),
	(71, NULL, NULL, NULL, 'SOĞUK BAKLAVA', NULL, NULL, 'PASTALAR', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, 'Sütlü Şerbetli', 1, 250, 3, 'Süt'),
	(72, NULL, NULL, NULL, 'ŞEKERPARE', NULL, NULL, 'ŞERBETLİ TATLI', NULL, 180, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636697_169278159264e5cc18d350264e5cc1cce9a2.jpg', 0, '3 adet', 1, 250, 3, NULL),
	(73, NULL, NULL, NULL, 'FISTIKLI KÜNEFE', NULL, NULL, 'ŞERBETLİ TATLI', NULL, 300, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636760_169401376564f899452b0ea64f8994935d28.jpg', 0, NULL, 1, 250, 3, NULL),
	(74, NULL, NULL, NULL, 'KÜNEFE', NULL, NULL, 'ŞERBETLİ TATLI', NULL, 270, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636843_169401380664f8996e3822664f89971bd5f5.jpg', 0, NULL, 1, 250, 3, NULL),
	(75, NULL, NULL, NULL, 'EKMEK KADAYIFI (KAYMAKSIZ)', NULL, NULL, 'ŞERBETLİ TATLI', NULL, 200, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786636928_1687888646649b23066954e.jpeg', 0, 'İLAVE KAYMAK +80TL', 1, 250, 3, NULL),
	(76, NULL, NULL, NULL, 'İLAVE KAYMAk', NULL, NULL, 'ŞERBETLİ TATLI', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 3, NULL),
	(77, NULL, NULL, NULL, 'İLAVE DONDURMA', NULL, NULL, 'ŞERBETLİ TATLI', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 3, NULL),
	(78, NULL, NULL, NULL, 'YAŞ PASTA', NULL, NULL, 'KİLOLUK ÜRÜNLER', NULL, 1000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786637127_1703853931658ebf6b23f90.jpeg', 0, '4-6 Kişilik (Çikolatalı veya meyveli)', 1, 250, 3, NULL),
	(79, NULL, NULL, NULL, 'DONDURMA', NULL, NULL, 'KİLOLUK ÜRÜNLER', NULL, 900, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786637191_16875420426495d91a8448a.jpeg', 0, '1 KG', 1, 250, 3, NULL),
	(80, NULL, NULL, NULL, 'KURU PASTA', NULL, NULL, 'KİLOLUK ÜRÜNLER', NULL, 400, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, '1 KİLO (Tatlı veya Tuzlu)', 1, 250, 3, NULL),
	(81, NULL, NULL, NULL, 'BATON KEK', NULL, NULL, 'KEKLER', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786637354_1703919470658fbf6eb487f.jpg', 0, 'Havuç Tarçınlı', 1, 250, 3, NULL),
	(82, NULL, NULL, NULL, 'LOLİPOP', NULL, NULL, 'KEKLER', NULL, 35, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 10, NULL),
	(83, NULL, NULL, NULL, 'KURU PASTA', NULL, NULL, 'KEKLER', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, 'Tatlı ve tuzlu 1 porsiyon, 6 adet', 1, 250, 3, NULL),
	(84, NULL, NULL, NULL, 'HAVUÇLU TARÇINLI KEK', NULL, NULL, 'KEKLER', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786637543_1680599134642be85e81b44.jpg', 0, '1 dilim', 1, 250, 3, NULL),
	(85, NULL, NULL, NULL, 'ACIBADEM', NULL, NULL, 'KEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786637615_1703871093658f0275a9173.jpeg', 0, NULL, 1, 250, 3, NULL),
	(86, NULL, NULL, NULL, 'ÇİKOLATA SOSU', NULL, NULL, 'İLAVELER', NULL, 60, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 3, NULL),
	(87, NULL, NULL, NULL, 'DONDURMA', NULL, NULL, 'İLAVELER', NULL, 70, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 3, NULL),
	(88, NULL, NULL, NULL, 'KAYMAK', NULL, NULL, 'KEKLER', NULL, 120, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 1, 250, 3, NULL),
	(89, NULL, NULL, NULL, 'ÇAY', NULL, NULL, 'SICAK İÇECEKLER', NULL, 60, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786722289_16874470836494662bad8db.jpeg', 0, NULL, 89, 250, 3, NULL),
	(90, NULL, NULL, NULL, 'FİNCAN ÇAY', NULL, NULL, 'SICAK İÇECEKLER', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786722378_16874471186494664e83007.jpeg', 0, NULL, 90, 250, 3, NULL),
	(91, NULL, NULL, NULL, 'SALEP', NULL, NULL, 'SICAK İÇECEKLER', NULL, 160, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786722442_1703853739658ebeab8238f.jpeg', 0, NULL, 91, 250, 3, NULL),
	(92, NULL, NULL, NULL, 'SÜTLÜ ÇAY', NULL, NULL, 'SICAK İÇECEKLER', NULL, 110, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 92, 250, 3, NULL),
	(93, NULL, NULL, NULL, 'SICAK SÜT', NULL, NULL, 'SICAK İÇECEKLER', NULL, 100, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786723892_168744733464946726bcb58.jpeg', 0, NULL, 93, 250, 3, 'Süt'),
	(94, NULL, NULL, NULL, 'DUBLE SÜTLÜ TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 170, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786723943_17824063486a3d5cccc625a.jpg', 0, NULL, 94, 250, 3, NULL),
	(95, NULL, NULL, NULL, 'DUBLE AROMALI KAHVE', NULL, NULL, 'SICAK İÇECEKLER', NULL, 170, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786724027_17823973616a3d39b123bae.jpg', 0, 'Menengiç, Dibek, Damla Sakız', 95, 250, 3, NULL),
	(96, NULL, NULL, NULL, 'DUBLE TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786724158_17823973616a3d39b123bae.jpg', 0, NULL, 96, 250, 3, NULL),
	(97, NULL, NULL, NULL, 'NANELİ ÇİKOLATALI TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786724361_174369946367eebe0758c95.jpeg', 0, NULL, 97, 250, 3, NULL),
	(98, NULL, NULL, NULL, 'DAĞ ÇİLEKLİ TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786724617_174369946367eebe0758c95.jpeg', 0, NULL, 98, 250, 3, NULL),
	(99, NULL, NULL, NULL, 'DAĞ ÇİLEKLİ TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726258_174369946367eebe0758c95.jpeg', 0, NULL, 99, 250, 3, NULL),
	(100, NULL, NULL, NULL, 'MENENGİÇ KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726362_174369946367eebe0758c95.jpeg', 0, NULL, 100, 250, 3, NULL),
	(101, NULL, NULL, NULL, 'DİBEK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726421_174369946367eebe0758c95.jpeg', 0, NULL, 101, 250, 3, NULL),
	(102, NULL, NULL, NULL, 'SÜTLÜ TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726475_174369946367eebe0758c95.jpeg', 0, NULL, 102, 250, 3, NULL),
	(103, NULL, NULL, NULL, 'DAMLA SAKIZLI TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726530_174369946367eebe0758c95.jpeg', 0, NULL, 103, 250, 3, NULL),
	(104, NULL, NULL, NULL, 'TÜRK KAHVESİ', NULL, NULL, 'SICAK İÇECEKLER', NULL, 110, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726582_174369946367eebe0758c95.jpeg', 0, NULL, 104, 250, 3, NULL),
	(105, NULL, NULL, NULL, 'MATCHA LATTE', NULL, NULL, 'SICAK İÇECEKLER', NULL, 160, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786726664_172710271166f17ef74d937.jpeg', 0, NULL, 105, 250, 3, NULL),
	(106, NULL, NULL, NULL, 'SICAK ÇİKOLATA-BEYAZ ÇİKOLATA', NULL, NULL, 'SICAK İÇECEKLER', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 106, 250, 3, NULL),
	(107, NULL, NULL, NULL, 'V60 2 CUPS', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 300, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786728907_1703753186658d35e22ebf6.jpeg', 0, 'Klasik kahve severlere oldukça hitap eden, fincanda çikolata ve karamel tat hissiyatı ile temiz ve yumuşak içimli, hem espresso bazlı kahvelerde hem de filtre kahve olarak demlendiğinde güzel sonuçlar veren bu çekirdekleri keyifle tüketiniz, Afiyet Olsun!', 107, 250, 8, NULL),
	(108, NULL, NULL, NULL, 'V60', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 160, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729002_1703753186658d35e22ebf6.jpeg', 0, 'Klasik kahve severlere oldukça hitap eden, fincanda çikolata ve karamel tat hissiyatı ile temiz ve yumuşak içimli, hem espresso bazlı kahvelerde hem de filtre kahve olarak demlendiğinde güzel sonuçlar veren bu çekirdekleri keyifle tüketiniz, Afiyet Olsun!', 108, 250, 8, NULL),
	(109, NULL, NULL, NULL, 'NESCAFE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 170, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729068_1703753186658d35e22ebf6.jpeg', 0, NULL, 109, 250, 3, NULL),
	(110, NULL, NULL, NULL, 'ERİMİŞ DONDURMALI LATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 180, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729160_1680599623642bea477f613.jpg', 0, 'İsteğinize göre dondurma tercihi.', 110, 250, 3, NULL),
	(111, NULL, NULL, NULL, 'PISTACHIO lATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 185, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729252_174317585967e6c0b31b299.jpeg', 0, 'Antep Fıstık Aromalı', 111, 250, 3, NULL),
	(112, NULL, NULL, NULL, 'PINK LATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 185, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729343_174203645067d55de2595b6.jpeg', 0, 'Çilek Aromalı', 112, 250, 3, NULL),
	(113, NULL, NULL, NULL, 'İSPANYOL LATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729417_1785535653.jpg', 0, NULL, 113, 250, 3, NULL),
	(114, NULL, NULL, NULL, 'CHAİ TEA LATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729479_1680599623642bea477f613.jpg', 0, NULL, 114, 250, 3, NULL),
	(115, NULL, NULL, NULL, 'WHİTE MOCHA', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729568_174179398367d1aabf2f9a5.jpg', 0, NULL, 115, 250, 3, NULL),
	(116, NULL, NULL, NULL, 'MOCHA', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729621_174179398367d1aabf2f9a5.jpg', 0, NULL, 116, 250, 3, NULL),
	(117, NULL, NULL, NULL, 'LATTE KARAMEL', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729669_174179398367d1aabf2f9a5.jpg', 0, NULL, 117, 250, 3, NULL),
	(118, NULL, NULL, NULL, 'CAPPUCİNO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 165, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 118, 250, 3, NULL),
	(119, NULL, NULL, NULL, 'CORTADO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 160, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 119, 250, 3, NULL),
	(120, NULL, NULL, NULL, 'FLAT WHITE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 165, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 120, 250, 15, NULL),
	(121, NULL, NULL, NULL, 'COOKIE LATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786729921_1687447210649466aa4611a.jpeg', 0, NULL, 121, 250, 15, NULL),
	(122, NULL, NULL, NULL, 'DONDURMALI AMERİCANO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 175, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 122, 250, 15, NULL),
	(123, NULL, NULL, NULL, 'CAFFE LATTE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 160, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730043_174179398367d1aabf2f9a5.jpg', 0, '+40 Tl ile aroma seçeneklerimiz mevcuttur.Seçenekler için ilaveler kısmına bakınız.', 123, 250, 3, NULL),
	(124, NULL, NULL, NULL, 'AMERİCANO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730122_1703853739658ebeab8238f.jpeg', 0, NULL, 124, 250, 3, NULL),
	(125, NULL, NULL, NULL, 'MACCHIATO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 125, 250, 15, NULL),
	(126, NULL, NULL, NULL, 'FİLTRE KAHVE', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 140, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730347_1687447716649468a40dbe0.jpeg', 0, 'Makine demleme.', 126, 250, 4, NULL),
	(127, NULL, NULL, NULL, 'ESPRESSO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 120, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730491_1687447776649468e0c7628.jpeg', 0, NULL, 127, 250, 3, NULL),
	(128, NULL, NULL, NULL, 'DOPPİO', NULL, NULL, 'DÜNYA KAHVELERİ', NULL, 130, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730573_1687447776649468e0c7628.jpeg', 0, 'Double espresso', 128, 250, 15, NULL),
	(129, NULL, NULL, NULL, 'YEŞİL ÇAY', NULL, NULL, 'BİTKİ ÇAYI', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730817_1688059009649dbc81b75cd.jpeg', 0, NULL, 129, 250, 15, NULL),
	(130, NULL, NULL, NULL, 'ADAÇAYI', NULL, NULL, 'BİTKİ ÇAYI', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730893_1702655050657c744ae702e.jpeg', 0, NULL, 130, 250, 15, NULL),
	(131, NULL, NULL, NULL, 'NANE LİMON', NULL, NULL, 'BİTKİ ÇAYI', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786730941_1688059059649dbcb30853c.jpeg', 0, NULL, 131, 250, 15, NULL),
	(132, NULL, NULL, NULL, 'IHLAMUR', NULL, NULL, 'BİTKİ ÇAYI', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786731016_1688059059649dbcb30853c.jpeg', 0, NULL, 132, 250, 15, NULL),
	(133, NULL, NULL, NULL, 'KIŞ ÇAYI', NULL, NULL, 'BİTKİ ÇAYI', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786731075_1688059048649dbca86ffef.jpeg', 0, NULL, 133, 250, 15, NULL),
	(134, NULL, NULL, NULL, 'LİMON ÇAYI', NULL, NULL, 'BİTKİ ÇAYI', NULL, 150, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786731120_1688059048649dbca86ffef.jpeg', 0, NULL, 134, 250, 15, NULL),
	(135, NULL, NULL, NULL, 'BAL', NULL, NULL, 'İLAVELER', NULL, 15, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786731209_1702655301657c7545080c0.jpeg', 0, NULL, 135, 250, 15, NULL),
	(136, NULL, NULL, NULL, 'İLAVE ESPRESSO', NULL, NULL, 'İLAVELER', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 136, 250, 15, NULL),
	(137, NULL, NULL, NULL, 'LAKTOZSUZ SÜT', NULL, NULL, 'İLAVELER', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786731285_170651935565b76b3b6d42d.jpg', 0, NULL, 137, 250, 15, NULL),
	(138, NULL, NULL, NULL, 'SALEP KAVANOZ', NULL, NULL, 'İLAVELER', NULL, 300, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, '1 L süte göre ayarlanmıştır.', 138, 250, 15, NULL),
	(139, NULL, NULL, NULL, 'AROMA', NULL, NULL, 'İLAVELER', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786731440_169401388864f899c0df8ac64f899c4a88a3.jpg', 0, 'Cookie, Karamel, Vanilya, Fındık, Çilek, Hindistan Cevizi, Toffee Nut, Bal Kabağı, Portakal Kabuğu, Bubble Gum, Pur Sucre de Canne, Blackberry, Mango', 139, 250, 15, NULL),
	(140, NULL, NULL, NULL, 'KAYMAK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786734683_1712240678660eb826e95aa.jpeg', 0, 'sade', 140, 250, 15, NULL),
	(141, NULL, NULL, NULL, 'KEÇİ', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786734754_1712240678660eb826e95aa.jpeg', 0, 'Keçi sütü ile yapılır.', 141, 250, 15, 'süt'),
	(142, NULL, NULL, NULL, 'MANDA', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786734832_1712240678660eb826e95aa.jpeg', 0, 'Manda sütü ile yapılır', 142, 250, 15, NULL),
	(143, NULL, NULL, NULL, 'ÇİKOLATA', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786734911_16875429426495dc9e456b0.jpeg', 0, NULL, 143, 250, 15, NULL),
	(144, NULL, NULL, NULL, 'KARAMEL', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786734961_16875488276495f39bbcf50.jpeg', 0, NULL, 144, 250, 15, NULL),
	(145, NULL, NULL, NULL, 'CEVİZ', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735046_16875492006495f510be9bd.jpeg', 0, NULL, 145, 250, 15, NULL),
	(146, NULL, NULL, NULL, 'ANTEP FISTĞI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735099_16875431056495dd41a6cf8.jpeg', 0, NULL, 146, 250, 15, NULL),
	(147, NULL, NULL, NULL, 'EJDER MEYVESİ', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735208_168857483464a59b725459d.jpeg', 0, 'Hindistan cevizi', 147, 250, 15, NULL),
	(148, NULL, NULL, NULL, 'BAL BADEM', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735261_1712240678660eb826e95aa.jpeg', 0, NULL, 148, 250, 15, NULL),
	(149, NULL, NULL, NULL, 'LİMON', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735322_16875488276495f39bbcf50.jpeg', 0, NULL, 149, 250, 15, NULL),
	(150, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735422_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(151, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735429_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(152, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735435_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(153, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735441_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(154, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735448_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(155, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735456_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(156, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735466_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(157, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735509_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(158, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735510_16875490636495f48702a69.jpeg', 0, NULL, 150, 250, 15, NULL),
	(159, NULL, NULL, NULL, 'KAVUN', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735549_16875431056495dd41a6cf8.jpeg', 0, NULL, 159, 259, 15, NULL),
	(160, NULL, NULL, NULL, 'BİTTER ÇİKOLATA', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735612_16875492226495f52679f15.jpeg', 0, NULL, 160, 250, 15, NULL),
	(161, NULL, NULL, NULL, 'KARADUT', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735673_1712239981660eb56d99d8f.jpeg', 0, NULL, 161, 250, 15, NULL),
	(162, NULL, NULL, NULL, 'MENEKŞE', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735722_1712239928660eb5381e0e3.jpeg', 0, NULL, 162, 250, 15, NULL),
	(163, NULL, NULL, NULL, 'YABAN MERSİNİ', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735771_1712239928660eb5381e0e3.jpeg', 0, NULL, 163, 250, 15, NULL),
	(164, NULL, NULL, NULL, 'SÜT REÇELİ', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735834_17448802566800c280d2b0c.jpeg', 0, NULL, 164, 250, 15, NULL),
	(165, NULL, NULL, NULL, 'SÜT YANIĞI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735886_17448802566800c280d2b0c.jpeg', 0, NULL, 165, 250, 15, NULL),
	(166, NULL, NULL, NULL, 'VİŞNE', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735935_1712239968660eb5609914e.jpeg', 0, NULL, 166, 250, 15, NULL),
	(167, NULL, NULL, NULL, 'ANANAS', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786735986_1712240678660eb826e95aa.jpeg', 0, NULL, 167, 250, 15, NULL),
	(168, NULL, NULL, NULL, 'BÖĞÜRTLEN', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786736038_1712239968660eb5609914e.jpeg', 0, NULL, 168, 250, 15, NULL),
	(169, NULL, NULL, NULL, 'TUTTI FRUTTI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786736091_1751980274686d18f2a14f5686d18f673308.jpg', 0, NULL, 169, 250, 15, NULL),
	(170, NULL, NULL, NULL, 'OREO', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786736137_1751980335686d192f718ac686d19332cecf.jpg', 0, NULL, 170, 250, 15, NULL),
	(171, NULL, NULL, NULL, 'ŞİRİNE', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786736197_1751980355686d19432a9f4686d1946487fb.jpg', 0, NULL, 171, 250, 15, NULL),
	(172, NULL, NULL, NULL, 'ŞİRİNE', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786736216_1751980355686d19432a9f4686d1946487fb.jpg', 0, NULL, 171, 250, 15, NULL),
	(173, NULL, NULL, NULL, 'SÜT MISIRI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 173, 250, 15, NULL),
	(174, NULL, NULL, NULL, 'SÜT MISIRI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 173, 250, 15, NULL),
	(175, NULL, NULL, NULL, 'SÜT MISIRI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 173, 250, 15, NULL),
	(176, NULL, NULL, NULL, 'SÜT MISIRI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 173, 250, 15, NULL),
	(177, NULL, NULL, NULL, 'SÜT MISIRI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 173, 250, 15, NULL),
	(178, NULL, NULL, NULL, 'SÜT MISIRI', NULL, NULL, 'DONDURMALAR', NULL, 80, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 173, 250, 15, NULL),
	(179, NULL, NULL, NULL, 'PATATES KIZARTMASI', NULL, NULL, 'APERATİFLER', NULL, 180, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786736688_169277792464e5bdc4b566b64e5bdc87ae1b.jpg', 0, NULL, 179, 250, 15, NULL),
	(180, NULL, NULL, NULL, 'DOMATES BEYAZ PEYNİRLİ KÖY EKMEĞİ TOST', NULL, NULL, 'KÖY EKMEĞİ TOSTLAR', NULL, 270, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739143_17182175366669eb40f228f.jpeg', 0, NULL, 180, 250, 15, NULL),
	(181, NULL, NULL, NULL, 'KARIŞIK KÖY EKMEĞİ TOST', NULL, NULL, 'KÖY EKMEĞİ TOSTLAR', NULL, 270, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739202_17182175636669eb5b17231.jpeg', 0, NULL, 181, 250, 15, NULL),
	(182, NULL, NULL, NULL, 'KAŞARLI KÖY EKMEĞİ TOST', NULL, NULL, 'KÖY EKMEĞİ TOSTLAR', NULL, 260, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739268_17182175636669eb5b17231.jpeg', 0, NULL, 182, 250, 15, NULL),
	(183, NULL, NULL, NULL, 'KAVURMA KAŞARLI KÖY EKMEĞİ TOST', NULL, NULL, 'KÖY EKMEĞİ TOSTLAR', NULL, 320, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739318_17182175636669eb5b17231.jpeg', 0, NULL, 183, 250, 15, NULL),
	(184, NULL, NULL, NULL, 'SUCUKLU KÖY EKMEĞİ TOST', NULL, NULL, 'KÖY EKMEĞİ TOSTLAR', NULL, 260, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739372_17182175636669eb5b17231.jpeg', 0, NULL, 184, 250, 15, NULL),
	(185, NULL, NULL, NULL, '3 PEYNİRLİ KÖY EKMEĞİ TOST', NULL, NULL, 'KÖY EKMEĞİ TOSTLAR', NULL, 290, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739438_17182174296669ead5adffa.jpeg', 0, 'KAŞAR PEYNİRİ. BEYAZ PEYNİRİ. KELLE PEYNİRİ.', 185, 250, 15, NULL),
	(186, NULL, NULL, NULL, 'KAŞARLI KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739544_1730961303672c5f973acc5.jpeg', 0, '160 gr bazlama ekmeği, söğüş, salça, zeytin ile servis edilir.', 186, 250, 15, NULL),
	(187, NULL, NULL, NULL, 'SUCUKLU KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739629_1730961303672c5f973acc5.jpeg', 0, '160 gr bazlama ekmeği, söğüş, salça, zeytin ile servis edilir.', 187, 250, 15, NULL),
	(188, NULL, NULL, NULL, 'DOMATES BEYAZ PEYNİRLİ KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739716_1730961303672c5f973acc5.jpeg', 0, '160 gr bazlama ekmeği, söğüş, salça, zeytin ile servis edilir.', 188, 250, 15, NULL),
	(189, NULL, NULL, NULL, 'KARIŞIK KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 290, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739798_1730961303672c5f973acc5.jpeg', 0, '160 gr bazlama ekmeği, söğüş, salça, zeytin ile servis edilir.', 189, 250, 15, NULL),
	(190, NULL, NULL, NULL, '3 PEYNİRLİ KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 290, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739840_1730961303672c5f973acc5.jpeg', 0, NULL, 190, 250, 15, NULL),
	(191, NULL, NULL, NULL, 'KAVURMA KAŞAR KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 310, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786739894_1730961303672c5f973acc5.jpeg', 0, '160 gr bazlama ekmeği, söğüş, salça, zeytin ile servis edilir.', 191, 250, 15, NULL),
	(192, NULL, NULL, NULL, 'KAŞARLI TOST', NULL, NULL, 'TOSTLAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740019_1730888464672b43101ef40.jpeg', 0, 'Zeytin, Salça ve Yeşillik ile servis edilir.', 192, 250, 15, NULL),
	(193, NULL, NULL, NULL, 'SUCUKLU TOST', NULL, NULL, 'TOSTLAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740072_1730888464672b43101ef40.jpeg', 0, 'Zeytin, Salça ve Yeşillik ile servis edilir.', 193, 250, 15, NULL),
	(194, NULL, NULL, NULL, 'DOMATES BEYAZ PEYNİRLİ TOST', NULL, NULL, 'TOSTLAR', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740138_1730888464672b43101ef40.jpeg', 0, 'Zeytin, Salça ve Yeşillik ile servis edilir.', 194, 250, 15, NULL),
	(195, NULL, NULL, NULL, 'SUCUK KAŞAR KARIŞIK TOST', NULL, NULL, 'TOSTLAR', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740215_1730888464672b43101ef40.jpeg', 0, 'Zeytin, Salça ve Yeşillik ile servis edilir.', 195, 250, 15, NULL),
	(196, NULL, NULL, NULL, 'KAVURMA KAŞAR TOST', NULL, NULL, 'TOSTLAR', NULL, 290, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740285_1730888464672b43101ef40.jpeg', 0, 'Zeytin, Salça ve Yeşillik ile servis edilir.', 196, 250, 15, NULL),
	(197, NULL, NULL, NULL, '3 PEYNİRLİ TOST', NULL, NULL, 'TOSTLAR', NULL, 270, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740343_1730888464672b43101ef40.jpeg', 0, 'KAŞAR PEYNİRİ, BEYAZ PEYNİR. KELLE PEYNİRİ.', 197, 250, 15, NULL),
	(198, NULL, NULL, NULL, 'İLAVE KAŞAR', NULL, NULL, 'TOSTLAR', NULL, 40, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/kahvalti.jpg', 0, NULL, 198, 250, 15, NULL),
	(199, NULL, NULL, NULL, 'KAŞARLI GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740471_16875421006495d9540263b.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 199, 250, 15, NULL),
	(200, NULL, NULL, NULL, 'SUCUKLU GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740533_16875422406495d9e0675e9.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 200, 250, 15, NULL),
	(201, NULL, NULL, NULL, 'DOMATES BEYAZ PEYNİRLİ GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740594_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 201, 250, 15, NULL),
	(202, NULL, NULL, NULL, 'PATATES KAŞAR GÖZLME', NULL, NULL, 'GÖZLEMELER', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740652_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 202, 250, 15, NULL),
	(203, NULL, NULL, NULL, 'SUCUK KAŞAR GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740705_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 203, 250, 15, NULL),
	(204, NULL, NULL, NULL, 'KIYMA KAŞAR GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740906_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 204, 250, 15, NULL),
	(205, NULL, NULL, NULL, 'KIYMA KAŞAR GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740914_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 204, 250, 15, NULL),
	(206, NULL, NULL, NULL, 'KIYMA KAŞAR GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740920_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 204, 250, 15, NULL),
	(207, NULL, NULL, NULL, 'KIYMA KAŞAR GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740926_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 204, 250, 15, NULL),
	(208, NULL, NULL, NULL, 'KAVURMA KAŞAR GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 290, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786740973_16875421216495d969dd494.jpeg', 0, 'Zeytin ve Yeşillik ile servis edilir.', 208, 250, NULL, NULL),
	(209, NULL, NULL, NULL, '3 PEYNİRLİ GÖZLEME', NULL, NULL, 'GÖZLEMELER', NULL, 280, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786741045_16875421216495d969dd494.jpeg', 0, 'Beyaz, kelle, kaşar', 209, 250, 15, NULL),
	(210, NULL, NULL, NULL, 'KAŞARLI KÖYLÜM TOST', NULL, NULL, 'KÖYLÜM (BAZLAMA) TOSTLAR', NULL, 275, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1786741215_1730961303672c5f973acc5.jpeg', 0, NULL, 210, 250, 15, NULL),
	(211, NULL, NULL, NULL, 'TOFFEE NUT BREW', NULL, NULL, 'SOĞUK KAHVELER', NULL, 270, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787039349_17806016026a21d302485856a21d302ac056.jpg', 0, 'Toffee Nut & Cold Brew Esintisi, kahve zincirlerinin kış klasiklerinden olan Toffee Nut (karamelize fındık) şurubunun zengin aromasını, 22 saat soğuk demlenmiş pürüzsüz Cold Brew ile buluşturan soğuk bir kahve spesiyalidir.', 211, 250, 15, NULL),
	(212, NULL, NULL, NULL, 'BANANA HONEY LATTE', NULL, NULL, 'SOĞUK KAHVELER', NULL, 290, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787039433_17806018476a21d3f773c306a21d3f7ce028.jpg', 0, 'olgun muzların doğal tatlılığını ve saf balın şifasını, espresso ve soğuk sütün pürüzsüz dokusuyla birleştiren besleyici bir soğuk kahve spesiyalidir.', 212, 250, 15, NULL),
	(213, NULL, NULL, NULL, 'COLD BREW COFFEE', NULL, NULL, 'SOĞUK KAHVELER', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787039716_1680598718642be6bec0548.jpg', 0, NULL, 213, 250, 15, NULL),
	(214, NULL, NULL, NULL, 'ICE AMERİCANO', NULL, NULL, 'SOĞUK KAHVELER', NULL, 185, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787039908_168744831464946afa75c59.jpeg', 0, NULL, 214, 250, 15, NULL),
	(215, NULL, NULL, NULL, 'ICE CHOCOLATE', NULL, NULL, 'SOĞUK KAHVELER', NULL, 185, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040057_168744840564946b55d0bdb.jpeg', 0, 'Siyah veya Beyaz olarak tercih edilir.', 215, 250, 15, NULL),
	(216, NULL, NULL, NULL, 'AFFOGATO', NULL, NULL, 'SOĞUK KAHVELER', NULL, 220, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040127_1680598922642be78ac95f8.jpg', 0, '1 top sade dondurma üzerine, double shot espresso dökülerek hazırlanır.', 216, 250, 15, NULL),
	(217, NULL, NULL, NULL, 'BUBBLE TEA ICE LATTE', NULL, NULL, 'SOĞUK KAHVELER', NULL, 230, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040416_168744839164946b47ab281.jpeg', 0, 'Mango ,Nane ,Misket Limonu', 217, 250, 15, NULL),
	(218, NULL, NULL, NULL, 'OREO FRAPPE', NULL, NULL, 'FRAPPE', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040518_169038674164c14135dcb1f.jpeg', 0, NULL, 218, 250, 15, NULL),
	(219, NULL, NULL, NULL, 'KARAMEL FRAPPE', NULL, NULL, 'FRAPPE', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040624_169038658964c1409dcf45e.jpeg', 0, NULL, 219, 250, 15, NULL),
	(220, NULL, NULL, NULL, 'MOCHA FRAPPE', NULL, NULL, 'FRAPPE', NULL, 250, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040767_169038703264c1425879d92.jpeg', 0, NULL, 220, 250, 15, NULL),
	(221, NULL, NULL, NULL, 'ÇİLEK', NULL, NULL, 'FROZEN', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787040926_169038690364c141d7d1747.jpeg', 0, NULL, 221, 250, 15, NULL),
	(222, NULL, NULL, NULL, 'ŞEFTALİ', NULL, NULL, 'FROZEN', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787041055_175456844968949701f3dea.jpeg', 0, NULL, 222, 250, 15, NULL),
	(223, NULL, NULL, NULL, 'KARADUT', NULL, NULL, 'FROZEN', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787041159_1754568403689496d3c8411.jpeg', 0, NULL, 223, 250, 15, NULL),
	(224, NULL, NULL, NULL, 'MANGO', NULL, NULL, 'FROZEN', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787041301_17543802866891b7fe127f2.jpeg', 0, NULL, 224, 250, 15, NULL),
	(225, NULL, NULL, NULL, 'ANANAS', NULL, NULL, 'FROZEN', NULL, 240, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787041382_17543802866891b7fe127f2.jpeg', 0, NULL, 225, 250, 15, NULL),
	(226, NULL, NULL, NULL, 'SMOOTHİE', NULL, NULL, 'SMOOTHİE', NULL, 260, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-01 00:00:00', NULL, NULL, NULL, '/images/urunler/images/1787100286_17806015796a21d2ebbfcf16a21d2ec2df75.jpg', 0, NULL, 225, 250, 15, NULL);

-- tablo yapısı dökülüyor qrmenu_sepet_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_kullanici` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `yetki` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kullanicitipi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subeyetki` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_kullanici_unique` (`id_kullanici`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.users: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `users` (`id`, `id_kullanici`, `name`, `email`, `yetki`, `kullanicitipi`, `subeyetki`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Oğuzhan Karacabay', 'oguzhankrcb@gmail.com', 'tahsilat|odeme|satisrapor', '0', '1|2|3', '2021-07-26 11:45:18', '$2y$10$Se2TwX5YQkO2Torfy1miG.Aamu1fTTojULoIi6uFiJuwUe95RX2BK', 'e4gBfHbXFd', NULL, NULL),
	(2, 2, 'Ender Eravcı', 'eeravci@gmail.com', 'tahsilat|odeme|satisrapor', '1', '1|2|3', '2021-07-26 11:45:18', '$2y$10$01QABqZMPx.RJSqub3bB1OGXKX99aj6IBSVkg8pfvdfUUh8RbQHDa', 'AOgKNyAMJq', NULL, NULL),
	(3, 3, 'Fuat', 'Bilkay-47@hotmail.com', '123', '123', '1', NULL, '$2y$10$01QABqZMPx.RJSqub3bB1OGXKX99aj6IBSVkg8pfvdfUUh8RbQHDa', NULL, NULL, NULL),
	(4, 998, 'Mikale Yazılım', 'mikale@centercafe.com', 'tumu', '1', '1', NULL, '$2y$10$1ghL8nNpXQPx8/YFDCgzgOwBCl/CsxGhcS9TSmQulc6eAx6.jYDS6', NULL, '2026-08-22 13:12:47', '2026-08-22 13:12:47');

-- tablo yapısı dökülüyor qrmenu_sepet_db.waiter_calls
CREATE TABLE IF NOT EXISTS `waiter_calls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `masa_ismi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_id` bigint unsigned DEFAULT NULL,
  `cagri_tipi` enum('garson_cagir','hesap_iste') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'garson_cagir',
  `cagri_zamani` timestamp NOT NULL,
  `pulled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.waiter_calls: ~0 rows (yaklaşık) tablosu için veriler indiriliyor

-- tablo yapısı dökülüyor qrmenu_sepet_db.web_orders
CREATE TABLE IF NOT EXISTS `web_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `masa_isim` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `urun_adi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adet` int NOT NULL DEFAULT '1',
  `fiyat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ozellikler` json DEFAULT NULL,
  `siparis_notu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `siparis_saati` timestamp NOT NULL,
  `pulled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- qrmenu_sepet_db.web_orders: ~13 rows (yaklaşık) tablosu için veriler indiriliyor
INSERT INTO `web_orders` (`id`, `masa_isim`, `urun_adi`, `adet`, `fiyat`, `ozellikler`, `siparis_notu`, `siparis_saati`, `pulled`, `created_at`, `updated_at`) VALUES
	(1, 'Masa Bilinmiyor', 'SİNİ KAHVALTI', 1, 650.00, NULL, NULL, '2026-08-16 20:32:05', 0, '2026-08-16 20:32:05', '2026-08-16 20:32:05'),
	(2, 'Masa Bilinmiyor', 'SİNİ KAHVALTI', 1, 650.00, NULL, NULL, '2026-08-16 21:19:22', 0, '2026-08-16 21:19:22', '2026-08-16 21:19:22'),
	(3, 'Masa Bilinmiyor', 'AVOKADO EKMEK', 1, 380.00, NULL, NULL, '2026-08-16 21:26:44', 0, '2026-08-16 21:26:44', '2026-08-16 21:26:44'),
	(4, 'Masa Bilinmiyor', 'AVOKADO EKMEK', 1, 380.00, NULL, NULL, '2026-08-16 21:31:30', 0, '2026-08-16 21:31:30', '2026-08-16 21:31:30'),
	(5, 'Masa 2', 'PANKEK KAHVALTI', 1, 320.00, NULL, NULL, '2026-08-16 21:38:41', 0, '2026-08-16 21:38:41', '2026-08-16 21:38:41'),
	(6, 'Masa 2', 'AVOKADO EKMEK', 1, 380.00, NULL, NULL, '2026-08-17 13:43:06', 0, '2026-08-17 13:43:06', '2026-08-17 13:43:06'),
	(7, 'Masa 2', 'HAŞLANMIŞ YUMURTALI SPORCU KAHVALTI', 1, 320.00, NULL, NULL, '2026-08-17 14:36:29', 0, '2026-08-17 14:36:29', '2026-08-17 14:36:29'),
	(8, 'Masa 2', 'AVOKADO EKMEK', 1, 380.00, NULL, NULL, '2026-08-17 14:57:22', 0, '2026-08-17 14:57:22', '2026-08-17 14:57:22'),
	(9, 'Masa 2', 'AVOKADO EKMEK', 1, 380.00, NULL, NULL, '2026-08-17 16:13:16', 0, '2026-08-17 16:13:16', '2026-08-17 16:13:16'),
	(10, 'Masa 2', 'HAŞLANMIŞ YUMURTALI SPORCU KAHVALTI', 1, 320.00, NULL, NULL, '2026-08-17 16:14:28', 0, '2026-08-17 16:14:28', '2026-08-17 16:14:28'),
	(11, 'Masa 2', 'ÇIRPILMIŞ YUMURTALI SPORCU KAHVALTI', 1, 320.00, NULL, NULL, '2026-08-19 09:56:16', 0, '2026-08-19 09:56:16', '2026-08-19 09:56:16'),
	(12, 'Masa 2', 'HAŞLANMIŞ YUMURTALI SPORCU KAHVALTI', 1, 320.00, NULL, NULL, '2026-08-19 09:59:13', 0, '2026-08-19 09:59:13', '2026-08-19 09:59:13'),
	(13, 'Masa 2', 'PİŞİ TABAĞI', 1, 300.00, NULL, NULL, '2026-08-22 15:17:06', 0, '2026-08-22 15:17:06', '2026-08-22 15:17:06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
