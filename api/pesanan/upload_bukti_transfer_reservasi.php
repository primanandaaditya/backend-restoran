<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-Type: application/json");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

require_once ('../../koneksi.php');

if (isset($_FILES['foto']) && isset($_POST['nomor']) ){

    $target_dir = "../../foto_bukti_transfer/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if($check !== false) {
        $pesan = "Tipe file adalah - " . $check["mime"] . ". ";
        $eror = true;
    } else {
        $pesan = "Foto yang Anda masukkan bukan gambar.";
        $eror = true;
    }


    if (file_exists($target_file)) {
        $pesan = "Maaf nama foto sudah ada.";
        $eror = true;
    }

    //periksa ukuran file
    if ($_FILES["foto"]["size"] > 500000) {
        $pesan = "Maaf, ukuran foto terlalu besar (lebih besar dari 500 MB).";
        $eror = true;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $pesan = "Maaf, hanya file tipe JPG, JPEG, PNG & GIF yang diizinkan.";
        $eror = true;
    }


    if ($uploadOk == 0) {
        $pesan = "Maaf, foto tidak dapat diunggah.";
        $eror = true;
    } else {
        $temp = explode(".", $_FILES["foto"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newfilename)) {

            $nomor = $_POST['nomor'];
            $sql = "update pesanan_master set foto_transfer =:foto_transfer where nomor = :nomor";
            $stmt = $db->prepare($sql);

            $param = array(
                ":foto_transfer" => $newfilename,
                ":nomor" => $nomor
            );
            $saved = $stmt->execute($param);

            $pesan = "Foto berhasil diunggah.";
            $eror = false;
        } else {
            $pesan = "Maaf, terjadi error.";
            $eror = true;
        }
    }
}else{
    $eror=true;
    $pesan="Data tidak lengkap";
}

$arr=array("error"=>$eror,"pesan"=>$pesan);
echo json_encode($arr);
?>