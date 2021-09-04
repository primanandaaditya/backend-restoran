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
        $sql = "SELECT keranjang.id_produk, produk.nama, SUM(keranjang.qty) as qty, keranjang.harga, SUM(keranjang.qty * keranjang.harga) as total, produk.gambar FROM keranjang INNER JOIN produk ON keranjang.id_produk = produk.id WHERE keranjang.id_user = :id_user GROUP by keranjang.id_produk, produk.nama, keranjang.harga, produk.gambar";
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
