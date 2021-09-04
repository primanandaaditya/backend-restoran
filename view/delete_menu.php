<?php


include '../koneksi.php';
$id = $_GET['id'];
$sql = "delete from produk where id = :id";
$stmt = $db->prepare($sql);
$param = array(
    ":id" => $id
);
$stmt->execute($param);
header('Location: menu.php');
?>