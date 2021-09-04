<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
require_once ('../../koneksi.php');

$sql = "select * from wilayah order by nama";
$stmt = $db->prepare($sql);
$param = array(
);
$stmt->execute($param);
$posisi = array();

while ($wilayah = $stmt->fetch(PDO::FETCH_ASSOC)){
    $posisi[] = $wilayah;
}
$status=true;
$arr=array("status"=>$status,"list"=>$posisi);

echo json_encode($arr);
?>