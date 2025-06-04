<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="padding: 30px;">
    <h1>Ubah Data Produk</h1>
    <br>
    <form action="index.php?page=update" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="idproduk" class="form-label">ID Produk</label>
            <input type="text" class="form-control" id="idproduk" name="txtid" value="<?=$data['produkid']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="namaproduk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="namaproduk" name="txtnama" value="<?=$data['namaproduk']?>" required>
        </div>
        <div class="mb-3">
            <label for="hargaproduk" class="form-label">Harga</label>
            <input type="text" class="form-control" id="hargaproduk" name="txtharga"  value="<?=$data['harga']?>" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="filefoto" class="form-control" id="foto">
        </div>
        <div class="mb-3">
            <label for="stokproduk" class="form-label">Stok</label>
            <input type="text" class="form-control" id="stokproduk" name="txtstok"  value="<?=$data['stok']?>" required>
        </div>
        <button type="submit" name="btnupdate" class="btn btn-success">Update</button>
        <a href="index.php?controller=produk" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>