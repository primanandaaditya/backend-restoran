<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Daftar Menu</title>
</head>
<body>

<?php
include_once 'nav.php';
include '../koneksi.php';
?>

<div class="container">
    <div class="container-fluid">

        <br>
        <a href="addmenu.php" class="btn btn-primary">Tambah</a>

        <br>
        <br>
        <table id="tabel" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th style="text-align: end">Harga (Rp.)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $sql = "select * from produk order by nama";
            $stmt = $db->query($sql);

            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
                echo "<td>".$i."</td>";
                echo "<td>".$data['nama']."</td>";
                echo "<td style='text-align: end'>".$data['harga']."</td>";


                echo "<td>";
                echo '<form method="post" action="delete_menu.php?id='. $data['id'] .'">';
                echo "<a class='btn btn-info btn-sm' href='editmenu.php?id=".$data['id']."'>Edit</a>";
                echo ' <input type="submit" onclick="return confirm(\'Hapus data ini?\')" class="btn btn-danger btn-sm" value="Hapus"> ';
                echo '</form>';
                echo "</td>";
                echo '</tr>';
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