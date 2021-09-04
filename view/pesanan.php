<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Daftar Pesanan</title>
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
                <th>Jenis Order</th>
                <th>Nomor Trx</th>
                <th>Tanggal</th>
                <th>Ongkos Kirim</th>
                <th style="text-align: end">Total (Rp.)</th>
                <th>Pelanggan</th>
                <th>No. meja</th>
                <th>Tgl reservasi</th>
                <th>Cara bayar</th>
                <th>Bukti transfer</th>
                <th>Status pesanan</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $sql = "SELECT pesanan_master.id, pesanan_master.alamat, jenis_order.nama as jenis_order, pesanan_master.nomor, pesanan_master.tanggal, pesanan_master.ongkir, pesanan_master.total, users.nama as pelanggan, pesanan_master.meja, pesanan_master.tgl_reservasi, cara_pembayaran.nama as cara_bayar, pesanan_master.foto_transfer, status_pesanan.keterangan as status_pesanan 
                    FROM pesanan_master
                    INNER JOIN jenis_order
                    ON pesanan_master.jenis_pesanan = jenis_order.kode
                    INNER JOIN users
                    on pesanan_master.id_user = users.id
                    INNER join cara_pembayaran
                    on pesanan_master.cara_bayar = cara_pembayaran.kode
                    INNER JOIN status_pesanan
                    on pesanan_master.status_pesanan = status_pesanan.kode
                    ORDER by pesanan_master.tanggal DESC";
            $stmt = $db->query($sql);

            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                $foto="../foto_bukti_transfer/".$data['foto_transfer'];
                echo '<tr>';
                echo "<td>".$i."</td>";
                echo "<td>".$data['jenis_order']."</td>";
                echo "<td>".$data['nomor']."</td>";
                echo "<td>".$data['tanggal']."</td>";
                echo "<td>".$data['ongkir']."</td>";
                echo "<td style='text-align: right'>". number_format($data['total'])."</td>";
                echo "<td>".$data['pelanggan']."</td>";
                echo "<td>".$data['meja']."</td>";
                echo "<td>".$data['tgl_reservasi']."</td>";
                echo "<td>".$data['cara_bayar']."</td>";

                if ($data['foto_transfer'] == null || $data['foto_transfer'] == ''){
                    echo "<td>"."</td>";
                }else{
                    echo "<td>".
                        "<a href='$foto'>Foto</a>"
                        ."</td>";
                }

                echo "<td>".$data['status_pesanan']."</td>";
                echo "<td>";
                echo "<a class='btn btn-warning btn-sm' href='editpesanan.php?id=".$data['id']."'>Ubah status</a>";
                echo "<br>";
                echo "<a class='btn btn-info btn-sm' href='detailpesanan.php?nomor=".$data['nomor']."'>Detail</a>";
                echo "</td>";
                echo '</tr>';

                if ($data['jenis_order'] == 'Delivery'){
                    echo "<tr><td></td><td colspan='12'>Alamat pengiriman : ".$data['alamat']."
</td>"."</tr>";
                }
                $i = $i + 1;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>