<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require_once ('../../koneksi.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_user'])){

    $id_user        = $data['id_user'];

    if ($id_user == ''){
        $message="Semua input harus diisi";
        $status=0;
    } else {
        $sql = "SELECT keranjang_reservasi.id_produk, produk.nama, SUM(keranjang_reservasi.qty) as qty, keranjang_reservasi.harga, SUM(keranjang_reservasi.qty * keranjang_reservasi.harga) as total, produk.gambar FROM keranjang_reservasi INNER JOIN produk ON keranjang_reservasi.id_produk = produk.id WHERE keranjang_reservasi.id_user = :id_user GROUP by keranjang_reservasi.id_produk, produk.nama, keranjang_reservasi.harga, produk.gambar";
        $stmt = $db->prepare($sql);
        $param = array(
            ":id_user" => $id_user
        );
        $stmt->execute($param);
        $posisi = array();

        while ($keranjang = $stmt->fetch(PDO::FETCH_ASSOC)){
            $posisi[] = $keranjang;
        }
        $message=$posisi;
        $status=1;
    }
    $arr=array("status"=>$status,"message"=>$message);
    echo json_encode($arr);
}
?>
