<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'db.php';

try {
    // ARTIK DOĞRU TABLODAN OKUYORUZ: t_urunkart (eski/gerçek 200+ ürününüzün olduğu tablo)
    $stmt = $db->prepare("SELECT * FROM t_urunkart ORDER BY SiraNo ASC");
    $stmt->execute();

    $urunler = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $urunler
    ]);

} catch(PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>