<?php
if (isset($_GET['nomor'])){
    $nomor = $_GET['nomor'];
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

    <title>Detail Pesanan</title>
</head>
<body>

<?php
include_once 'nav.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="container-fluid">

        <br>
        <table id="tabel" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Qty</th>
                <th style="text-align: end">Harga satuan (Rp.)</th>
                <th style="text-align: end">Total (Rp.)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $j = 0;
            $sql = "SELECT produk.nama, pesanan_detail.qty, pesanan_detail.harga, (pesanan_detail.qty*pesanan_detail.harga) as total, produk.gambar
                    FROM produk
                    INNER JOIN pesanan_detail
                    ON produk.id = pesanan_detail.id_produk WHERE pesanan_detail.nomor = '$nomor'";
            $stmt = $db->query($sql);

            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){

                echo '<tr>';
                echo "<td>".$i."</td>";
                echo "<td>".$data['nama']."</td>";
                echo "<td>".$data['qty']."</td>";
                echo "<td style='text-align: right'>". number_format($data['harga'])."</td>";
                echo "<td style='text-align: right'>". number_format($data['total'])."</td>";
                echo '</tr>';
                $i = $i + 1;
                $j = $j + $data['total'];
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>