<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


require_once ('../../koneksi.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_wilayah']) ){

    $id_wilayah = $data['id_wilayah'];

    if ($id_wilayah == ''){
        $hasil = '';
        $pesan = 'Input tidak lengkap';
        $eror = true;

    } else {
        $sql = "select * from wilayah where id =:id_wilayah";
        $stmt = $db->prepare($sql);
        $param = array(
            ":id_wilayah" => $id_wilayah
        );
        $stmt->execute($param);
        $wilayah = $stmt->fetch(PDO::FETCH_ASSOC);

        //jika user terdaftar
        if ($wilayah){
            $hasil = $wilayah;
            $pesan = 'Wilayah ditemukan';
            $eror = false;
        } else{
            $hasil = '';
            $pesan = 'Wilayah tidak ditemukan';
            $eror = true;
        }
    }
} else {
    $hasil = '';
    $pesan = 'Data tidak lengkap';
    $eror = true;

}
$arr=array("error"=>$eror,"pesan"=>$pesan,"hasil"=>$hasil);
echo json_encode($arr);

?>

