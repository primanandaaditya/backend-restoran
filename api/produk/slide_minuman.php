<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require_once ('../../koneksi.php');

$sql = "select * from produk WHERE jenis = 2 order by nama LIMIT 4";
$stmt = $db->prepare($sql);
$param = array(
);
$stmt->execute($param);
$posisi = array();

while ($produk = $stmt->fetch(PDO::FETCH_ASSOC)){
    $posisi[] = $produk;
}
$status=true;
$arr=array("status"=>$status,"list"=>$posisi);

echo json_encode($arr);
?>