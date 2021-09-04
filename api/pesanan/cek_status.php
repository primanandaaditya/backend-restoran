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
        $sql = "SELECT jenis_order.nama, pesanan_master.nomor,pesanan_master.tanggal,pesanan_master.ongkir,pesanan_master.total,status_pesanan.keterangan
                FROM pesanan_master
                INNER JOIN jenis_order ON pesanan_master.jenis_pesanan = jenis_order.kode
                INNER JOIN status_pesanan ON pesanan_master.status_pesanan = status_pesanan.kode
                WHERE pesanan_master.id_user =:id_user";
        $stmt = $db->prepare($sql);
        $param = array(
            ":id_user" => $id_user
        );
        $stmt->execute($param);
        $posisi = array();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $posisi[] = $data;
        }
        $message=$posisi;
        $status=1;
    }
    $arr=array("status"=>$status,"message"=>$message);
    echo json_encode($arr);
}
?>
