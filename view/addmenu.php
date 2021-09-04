<?php
include '../koneksi.php';

if (isset($_POST['simpan'])){


    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $keterangan = filter_input(INPUT_POST, 'keterangan', FILTER_SANITIZE_STRING);
    $harga = filter_input(INPUT_POST,'harga', FILTER_SANITIZE_NUMBER_INT);
    $jenis = filter_input(INPUT_POST,'jenis', FILTER_SANITIZE_NUMBER_INT);


    //persiapan gambar
    $target_dir = "../gambar/";
    $target_file = $target_dir . basename($_FILES["foto1"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $adaFile = $_FILES["foto1"]["tmp_name"];
    if ( $adaFile ){
        $check = getimagesize($_FILES["foto1"]["tmp_name"]);
        if($check !== false) {
            $pesan = "Tipe file adalah - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            $pesan = "Foto yang Anda masukkan bukan gambar.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $pesan = "Maaf nama foto sudah ada.";
            $uploadOk = 0;
        }

        //periksa ukuran file
        if ($_FILES["foto1"]["size"] > 200000) {
            $pesan = "Maaf, ukuran foto terlalu besar (lebih besar dari 200 MB).";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $pesan = "Maaf, hanya file tipe JPG, JPEG, PNG & GIF yang diizinkan.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error

        if ($uploadOk == 0) {
            $pesan = "Maaf, foto tidak dapat diunggah.";
// if everything is ok, try to upload file
        } else {
            $temp = explode(".", $_FILES["foto1"]["name"]);
            $newfilename = $nama . '.' . end($temp);

            if (move_uploaded_file($_FILES["foto1"]["tmp_name"], $target_dir . $newfilename)) {
                $pesan = "Foto berhasil diunggah.";
            } else {
                $pesan = "Maaf, terjadi error.";
            }
        }
    }else{
        $newfilename='noimage.png';
    }


    if ($nama == '' || $keterangan == '' || $harga == ''){
        $err = -1;
    } else {
        //cek dulu

        $sql = "select * from produk where nama = :nama";
        $stmt = $db->prepare($sql);
        $param = array(
            ":nama" => $nama
        );

        $stmt->execute($param);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data){
            $err = -2;
        }else{
            $sql = "insert into produk (nama,jenis,harga,keterangan,gambar) VALUES (:nama,:jenis,:harga,:keterangan,:gambar)";
            $stmt = $db->prepare($sql);
            $param = array(
                ":nama" => $nama,
                ":jenis" => $jenis,
                ":harga" => $harga,
                ":keterangan" => $keterangan,
                ":gambar" => $newfilename
            );

            $saved = $stmt->execute($param);
            $err = 1;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Tambah Menu</title>
</head>
<body>

<?php
include_once 'nav.php';

?>

<div class="container">
    <div class="container-fluid">

        <br>
        <?php

        if (isset($_POST['simpan'])){
            if ($err == -1){
                $pesan = "Harus diisi lengkap";
                echo '<div class="alert alert-danger" role="alert">';
                echo $pesan;
                echo '</div>';
            } elseif ($err == 0){
                $pesan="Data tidak sama";
                echo '<div class="alert alert-danger" role="alert">';
                echo $pesan;
                echo '</div>';
            } elseif ($err == 1){
                $pesan ="Berhasil disimpan";
                echo '<div class="alert alert-success" role="alert">';
                echo $pesan;
                echo '</div>';
            } elseif ($err == -2){
                $pesan="Data duplikat. Silakan diganti";
                echo '<div class="alert alert-danger" role="alert">';
                echo $pesan;
                echo '</div>';
            }
        }
        ?>

        <br>
        <br>
        <form action="" method="post" enctype="multipart/form-data">

            <br>
            <div class="form-group">
                Nama menu
                <input class="form-control" id="nama" name="nama"/>
            </div>

            <br>
            <div class="form-group">
                Harga
                <input type="number" class="form-control" id="harga" name="harga"/>
            </div>

            <br>
            <div class="form-group">
                Jenis
                <br>
                <input checked type="radio" id="jenis" value="1" name="jenis"/>Makanan
                <br>
                <input type="radio" id="jenis" value="2" name="jenis"/>Minuman
            </div>

            <br>
            <div class="form-group">
                Keterangan
                <input  class="form-control" id="keterangan" name="keterangan"/>
            </div>

            <br>
            <div class="form-group">
                <label for="foto1">Pilih foto</label>
                <input type="file" name="foto1" class="form-control-file" id="foto1">
            </div>
            <br>
            <br>
            <input name="simpan" type="submit" value="Simpan" class="btn btn-primary">
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>