<?php 
include "../app/models/Penjualan.php";

class PenjualanControllers {
    private $model;
    private $db;

    public function __construct() {
        $this->model = new Penjualan();
    }

    public function index() {
        $data = $this->model->panggilSemua();
        include "../app/views/penjualan/list.php";
    }

    public function detail($param) {
        $data = $this->model->panggilkhusus($param);
        include "../app/views/penjualan/detail.php";
    }

    public function delete($param) {
        $run = $this->model->hapus($param);
        $this->index();
    }

    public function tambah() {
    include_once "../app/models/Pelanggan.php";
    include_once "../app/models/Produk.php";
    $pelangganModel = new Pelanggan();
    $produkModel = new Produk();
    $data['pelanggan'] = $pelangganModel->panggilSemua();
    $data['produk'] = $produkModel->panggilSemua();
    include "../app/views/penjualan/tambah.php";
    }

    public function simpan() {
    include_once "../app/models/DetailPenjualan.php";

    $penjualanData = [
        'tanggal' => $_POST['txttanggal'],
        'total' => str_replace(['Rp', ' '], '', $_POST['txttotal']), // Hapus format mata uang
        'pelangganid' => $_POST['txtpelangganid']
    ];
    $run = $this->model->simpanData($penjualanData);

    if ($run) {
        // Ambil ID penjualan terakhir yang diinsert melalui model
        $lastId = $this->model->getLastInsertId();
        $detailModel = new DetailPenjualan();

        // Proses detail penjualan
        $produkid = $_POST['produkid'];
        $jumlah = $_POST['jumlah'];
        $subtotal = $_POST['subtotal'];

        for ($i = 0; $i < count($produkid); $i++) {
            $detailData = [
                'penjualanid' => $lastId,
                'produkid' => $produkid[$i],
                'jumlahproduk' => $jumlah[$i],
                'subtotal' => str_replace(['Rp', ' '], '', $subtotal[$i]) // Hapus format mata uang
            ];

            // Simpan ke detail_penjualan
            $detailModel->simpanData($detailData);
        }
    }
    $this->index();
}

    public function edit($id) {
        $data = $this->model->panggilkhusus($id);
        include "../app/views/penjualan/edit.php";
    }

    public function update() {
        $data = [
            'id' => $_POST['txtid'],
            'tanggal' => $_POST['txttanggal'],
            'total' => $_POST['txttotal'],
            'pelangganid' => $_POST['txtpelangganid']
        ];
        $run = $this->model->update($data);
        $this->index();
    }
}
?>