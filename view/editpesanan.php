<?php
include '../koneksi.php';

if (!isset($_GET['id'])){
    header('Location:../pesanan.php');
}

$id = $_GET['id'];

$sql = "select * from pesanan_master where id = :id";
$stmt = $db->prepare($sql);
$param = array(
    ":id" => $id
);

$stmt->execute($param);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data){
    $get_status_pesanan = $data['status_pesanan'];
}

if (isset($_POST['simpan'])){

    $status_pesanan = $_POST['status_pesanan'];
    $id = $_GET['id'];

    if ($status_pesanan == '' || $id == ''){
        $err = -1;
    } else {
        //update
        $sql = "update pesanan_master set status_pesanan =:status_pesanan where id =:id";
        $stmt = $db->prepare($sql);
        $param = array(
            ":status_pesanan" => $status_pesanan,
            ":id" => $id
        );
        $saved = $stmt->execute($param);
        $err = 1;

        header('Location:pesanan.php');
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

    <title>Edit Pesanan</title>
</head>
<body>

<?php
include_once 'nav.php';

?>

<div class="container">
    <div class="container-fluid">
        <br>
        <h2>Ubah status pesanan </h2>
        <br>
        <form action="" method="post">

            <?
            $sql = "select * from status_pesanan order by kode";
            $stmt = $db->query($sql);

            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                if ($data['kode'] == $get_status_pesanan){
                    $cek = ' checked';
                }else{
                    $cek = '';
                }
                echo '<div class="form-check">
                            <input class="form-check-input" type="radio" value="' .$data['kode']. '" name="status_pesanan" id="status_pesanan" '.$cek.'>
                            <label class="form-check-label" for="status_pesanan">'.$data['keterangan']. '</label>
                        </div>';
            }
            ?>

            <br>
            <input name="simpan" type="submit" value="Simpan" class="btn btn-primary">
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>