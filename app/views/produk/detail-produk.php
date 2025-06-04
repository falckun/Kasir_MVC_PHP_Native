<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="text-align: center; padding: 20px">
    <h1>Detail Produk</h1>
    <br>
    <img src="uploads/<?= $data['foto']?>" alt="Foto Produk" width="200">
    <br>
    <span class="fs-4">ID Produk: <?= $data['produkid']?> </span><br>
    <span class="fs-4">Nama Produk: <?= $data['namaproduk']?></span><br>
    <span class="fs-4">Harga: <?= $data['harga']?></span><br>
    <span class="fs-4">stok: <?= $data['stok']?></span><br><br>
    <a href="index.php?controller=produk" class="btn btn-secondary">Kembali</a>

</body>
</html>