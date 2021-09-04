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

        $sql = "delete from keranjang_reservasi where id_user =:id_user";
        $stmt = $db->prepare($sql);

        $param = array(
            ":id_user" => $id_user
        );
        $saved = $stmt->execute($param);

        $message="Keranjang telah dikosongkan";
        $status=1;

        $arr=array("status"=>$status,"message"=>$message);
        echo json_encode($arr);
    }
}
?>
