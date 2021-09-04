<?php
include '../koneksi.php';

if (!isset($_GET['id'])){
    header('Location:../menu.php');
}

$id = $_GET['id'];

$sql = "select * from produk where id = :id";
$stmt = $db->prepare($sql);
$param = array(
    ":id" => $id
);

$stmt->execute($param);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data){
    $get_nama = $data['nama'];
    $get_jenis = $data['jenis'];
    $get_harga = $data['harga'];
    $get_keterangan = $data['keterangan'];
}


if (isset($_POST['simpan'])){

    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $keterangan = filter_input(INPUT_POST, 'keterangan', FILTER_SANITIZE_STRING);
    $harga = filter_input(INPUT_POST,'harga', FILTER_SANITIZE_NUMBER_INT);
    $jenis = filter_input(INPUT_POST,'jenis', FILTER_SANITIZE_NUMBER_INT);
    $id = $_GET['id'];

    if ($nama == '' || $keterangan == '' || $harga == ''){
        $err = -1;
    } else {
        //update
        $sql = "update produk set nama =:nama, jenis =:jenis, harga =:harga, keterangan =:keterangan, harga =:harga where id =:id";
        $stmt = $db->prepare($sql);
        $param = array(
            ":nama" => $nama,
            ":jenis" => $jenis,
            ":harga" => $harga,
            ":keterangan" => $keterangan,
            ":id" => $id
        );
        $saved = $stmt->execute($param);
        $err = 1;
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

    <title>Edit Menu</title>
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
                $pesan ="Berhasil diedit";
                echo '<div class="alert alert-success" role="alert">';
                echo $pesan;
                echo '</div>';
                header('Location:menu.php');
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
        <form action="" method="post">

            <br>
            <div class="form-group">
                Nama menu
                <input class="form-control" value="<?php echo $get_nama ?>" id="nama" name="nama"/>
            </div>

            <br>
            <div class="form-group">
                Harga
                <input type="number" value="<?php echo $get_harga ?>" class="form-control" id="harga" name="harga"/>
            </div>

            <br>
            <div class="form-group">
                Jenis
                <br>
                <input <?php if ($get_jenis=='1') echo "checked"; ?> type="radio" id="jenis" value="1" name="jenis"/>Makanan
                <br>
                <input <?php if ($get_jenis=='2') echo "checked"; ?> type="radio" id="jenis" value="2" name="jenis"/>Minuman
            </div>

            <br>
            <div class="form-group">
                Keterangan
                <input value="<?php echo $get_keterangan ?>" class="form-control" id="keterangan" name="keterangan"/>
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