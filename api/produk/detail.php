<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require_once ('../../koneksi.php');

if (isset($_GET['id'])){

    $id = $_GET['id'];


    $sql = "select * from produk where id = :id";
    $stmt = $db->prepare($sql);
    $param = array(
        ":id" => $id
    );
    $stmt->execute($param);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data){
        $status=true;
        $arr=array("status"=>$status,"list"=>$data);
    }else{
        $status=false;
        $arr=array("status"=>$status,"list"=>'Data tidak ditemukan');
    }
}else{
    $status=false;
    $arr=array("status"=>$status,"list"=>'Request ID tidak ditemukan');
}


echo json_encode($arr);


?>