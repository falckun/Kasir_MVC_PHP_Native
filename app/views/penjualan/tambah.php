<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tambah Penjualan</title>
    <style>
        .product-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .remove-product {
            margin-left: 10px;
        }
    </style>
</head>
<body style="padding: 30px;">
    <h1>Tambah Penjualan</h1>
    <br>
    <form action="index.php?controller=penjualan&page=simpan" method="POST">
        <div class="mb-3">
            <label for="idpenjualan" class="form-label">ID Penjualan</label>
            <input type="text" name="txtid" class="form-control" id="idpenjualan" required>
        </div>
        <div class="mb-3">
            <label for="tanggalpenjualan" class="form-label">Tanggal Penjualan</label>
            <input type="date" name="txttanggal" class="form-control" id="tanggalpenjualan" value="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="mb-3">
            <label for="pelangganid" class="form-label">Pelanggan</label>
            <select name="txtpelangganid" class="form-control" id="pelangganid" required>
                <option value="">Pilih Pelanggan</option>
                <?php
                if (isset($data['pelanggan']) && is_array($data['pelanggan'])) {
                    foreach ($data['pelanggan'] as $p) {
                        echo "<option value='{$p['pelangganid']}'>{$p['namapelanggan']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <h4>Detail Produk</h4>
        <div id="product-list">
            <div class="product-item">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="produkid_1" class="form-label">Produk</label>
                        <select name="produkid[]" class="form-control" id="produkid_1" required>
                            <option value="">Pilih Produk</option>
                            <?php
                            if (isset($data['produk']) && is_array($data['produk'])) {
                                foreach ($data['produk'] as $pr) {
                                    echo "<option value='{$pr['produkid']}' data-harga='{$pr['harga']}'>{$pr['namaproduk']} (Rp " . number_format($pr['harga'], 0, ',', '.') . ")</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jumlah_1" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah[]" class="form-control" id="jumlah_1" min="1" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="subtotal_1" class="form-label">Subtotal</label>
                        <input type="text" name="subtotal[]" class="form-control" id="subtotal_1" readonly>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-product" class="btn btn-primary mb-3">Tambah Produk</button>
        <div class="mb-3">
            <label for="totalharga" class="form-label">Total Harga</label>
            <input type="text" name="txttotal" class="form-control" id="totalharga" readonly>
        </div>
        <button type="submit" name="btnsimpan" class="btn btn-success">Simpan</button>
        <a href="index.php?controller=penjualan" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        let productCount = 1;

        //menghitung subtotal
        function calculateSubtotal() {
            let total = 0;
            document.querySelectorAll('.product-item').forEach((item, index) => {
                const produkSelect = item.querySelector(`#produkid_${index + 1}`);
                const jumlahInput = item.querySelector(`#jumlah_${index + 1}`);
                const subtotalInput = item.querySelector(`#subtotal_${index + 1}`);
                const harga = parseFloat(produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga')) || 0;
                const jumlah = parseInt(jumlahInput.value) || 0;
                const subtotal = harga * jumlah;
                subtotalInput.value = subtotal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace('Rp', 'Rp ');
                total += subtotal;
            });
            document.getElementById('totalharga').value = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace('Rp', 'Rp ');
        }

        //untuk perubahan produk dan jumlah
        document.querySelectorAll('select[name="produkid[]"], input[name="jumlah[]"]').forEach(element => {
            element.addEventListener('change', calculateSubtotal);
        });

        //untuk menambah item produk
        document.getElementById('add-product').addEventListener('click', () => {
            productCount++;
            const productList = document.getElementById('product-list');
            const newItem = `
                <div class="product-item">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="produkid_${productCount}" class="form-label">Produk</label>
                            <select name="produkid[]" class="form-control" id="produkid_${productCount}" required>
                                <option value="">Pilih Produk</option>
                                <?php
                                if (isset($data['produk']) && is_array($data['produk'])) {
                                    foreach ($data['produk'] as $pr) {
                                        echo "<option value='{$pr['produkid']}' data-harga='{$pr['harga']}'>{$pr['namaproduk']} (Rp " . number_format($pr['harga'], 0, ',', '.') . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="jumlah_${productCount}" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control" id="jumlah_${productCount}" min="1" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="subtotal_${productCount}" class="form-label">Subtotal</label>
                            <input type="text" name="subtotal[]" class="form-control" id="subtotal_${productCount}" readonly>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-danger remove-product" onclick="this.parentElement.parentElement.parentElement.remove()">Hapus</button>
                        </div>
                    </div>
                </div>
            `;
            productList.insertAdjacentHTML('beforeend', newItem);

            document.querySelector(`#produkid_${productCount}`).addEventListener('change', calculateSubtotal);
            document.querySelector(`#jumlah_${productCount}`).addEventListener('change', calculateSubtotal);
        });

        // hitung subtotal
        calculateSubtotal();
    </script>
</body>
</html>