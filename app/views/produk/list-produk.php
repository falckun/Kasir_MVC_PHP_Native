<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="padding: 20px;">
    <h1>Daftar Produk</h1>
    <br>
    <a href="index.php?controller=produk&page=tambah" class="btn btn-primary">Tambah Produk</a>
    <a href="index.php?controller=pelanggan" class="btn btn-outline-info">List Pelanggan</a>
    <a href="index.php?controller=penjualan" class="btn btn-outline-warning">List Penjualan</a>
    <br><br>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            //looping dimensi pertama dari array database
            foreach($data as $value):
            ?>
            <tr>
                <td><?= $value['produkid']?></td>
                <td><?= $value['namaproduk']?></td>
                <td><?= $value['harga']?></td>
                <td><?= $value['stok']?></td>
                <td><img src="uploads/<?= $value['foto']?>" alt="Foto Produk" width="100"></td>
                <td>
                    <a href="index.php?controller=produk&page=detail&id=<?= $value['produkid']?>" class="btn btn-info">Detail</a>
                    <a href="index.php?controller=produk&page=edit&id=<?= $value['produkid']?>" class="btn btn-warning">Edit</a>
                    <a href="index.php?controller=produk&page=delete&id=<?= $value['produkid']?>" onclick="return confirm('Apakah anda yakin akan menghapus produk?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</body>
</html>