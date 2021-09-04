<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require_once ('../../koneksi.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_user']) && isset($data['id_produk'])){

    $id_user        = $data['id_user'];
    $id_produk      = $data['id_produk'];


    if ($id_user == '' || $id_produk == ''){
        $message="Semua input harus diisi";
        $status=0;
    } else {

        $sql = "delete from keranjang where id_user =:id_user and id_produk =:id_produk";
        $stmt = $db->prepare($sql);

        $param = array(
            ":id_user" => $id_user,
            ":id_produk" => $id_produk
        );
        $saved = $stmt->execute($param);

        $message="Item telah dihapus dari keranjang";
        $status=1;

        $arr=array("status"=>$status,"message"=>$message);
        echo json_encode($arr);
    }
}
?>
