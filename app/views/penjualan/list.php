<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="padding: 20px;">
    <h1>Daftar Penjualan</h1>
    <br>
    <a href="index.php?controller=penjualan&page=tambah" class="btn btn-primary">Tambah Penjualan</a>
    <a href="index.php?controller=pelanggan" class="btn btn-outline-info">List Pelanggan</a>
    <a href="index.php?controller=produk" class="btn btn-outline-warning">List Produk</a>
    <br><br>    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>Nama Pelanggan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $value): ?>
            <tr>
                <td><?= $value['penjualanid']; ?></td>
                <td><?= $value['tanggalpenjualan']; ?></td>
                <td><?= number_format($value['totalharga'], 2); ?></td>
                <td><?= $value['namapelanggan']; ?></td>
                <td>
                    <a href="index.php?controller=penjualan&page=detail&id=<?= $value['penjualanid']; ?>" class="btn btn-info">Detail</a>
                    <a href="index.php?controller=penjualan&page=edit&id=<?= $value['penjualanid']; ?>" class="btn btn-warning">Edit</a>
                    <a href="index.php?controller=penjualan&page=delete&id=<?= $value['penjualanid']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus penjualan?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>