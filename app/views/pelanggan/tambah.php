<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="padding: 30px;">
    <h1>Tambah Pelanggan</h1>
    <br>
    <form action="index.php?page=simpan" method="POST" enctype="multipart/form-data"> 
        <div class="mb-3">
            <label for="idpelanggan" class="form-label">ID Pelanggan</label>
            <input type="text" name="txtid" class="form-control" id="idpelanggan" required>
        </div>
        <div class="mb-3">
            <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" name="txtnama" class="form-control" id="namapelanggan" required>
        </div>
        <div class="mb-3">
            <label for="notelepon" class="form-label">No Telepon</label>
            <input type="text" name="txtno" class="form-control" id="notelepon" required>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="filefoto" class="form-control" id="foto">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="txtalamat" id="alamat" class="form-control" required></textarea>
        </div>
         <button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>