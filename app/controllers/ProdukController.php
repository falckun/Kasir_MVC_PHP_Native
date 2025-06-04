<?php 
// Include file Produk.php yang berisi definisi class Produk
include "../app/models/Produk.php";

// Definisi class ProdukControllers
class ProdukControllers {
    // Deklarasi properti $model sebagai private
    private $model;

    // Konstruktor class ProdukControllers
    public function __construct() {
        // Inisialisasi properti $model dengan membuat instance class Produk
        $this->model = new Produk();
    }

    // Metode index() yang akan dijalankan saat controller dipanggil
    public function index() {
        // Memanggil metode panggilSemua() dari model Pelanggan untuk mengambil semua data pelanggan
        $data = $this->model->panggilSemua();
        
        // Include file view untuk menampilkan data pelanggan
        include "../app/views/produk/list-produk.php";
    }
    
    public function detail($param){
        $data= $this->model->panggilkhusus($param);
        include "../app/views/produk/detail-produk.php";
    }

    public function tambah(){
        include "../app/views/produk/tambah-produk.php";
    }

    public function simpan(){

        $gambar= null;

        //cek apakah user upload gambar
        if(isset($_FILES['filefoto']) && $_FILES['filefoto']['error'] == 0){

            $typediizinkan = ['png', 'jpg', 'jpeg'];
            $extfile = strtolower(pathinfo($_FILES['filefoto']['name'],PATHINFO_EXTENSION));
            $extvalid = in_array($extfile, $typediizinkan);
            if(!$extvalid){
                die("tipe file tidak bisa digunakan");
            }
            $ukurandiizinkan = 1024 * 1024 * 10; //ukuran diizinkan 10mb
            $ukuranfile = $_FILES['filefoto']['size'];
            if($ukuranfile > $ukurandiizinkan){
                die('ukuran terlalu besar, maskimal 10mb');
            }
            $targetDir = "uploads/"; 
            $gambar = date("d-m-Y-H-i-s") . "_" . basename($_FILES['filefoto']['name']); //membuat nama file dengan date & time
            $targetFile = $targetDir . $gambar;

            //Simpan file
            move_uploaded_file($_FILES['filefoto']['tmp_name'], $targetFile);
        }

        $data = [
            'id'        =>  $_POST['txtid'],
            'nama'      =>  $_POST['txtnama'],
            'harga'     =>  $_POST['txtharga'],
            'stok'      =>  $_POST['txtstok'],
            'foto'      =>  $gambar
        ];
        $run = $this->model->simpanData($data);
        $this->index(); //kembali ke halaman list
    }

    public function delete($param){
        $run = $this->model->hapus($param);
        $this->index(); //menjalankan method index
    }

    public function edit($id){
        $data = $this->model->panggilkhusus($id); //menampung data dari database
        include "../app/views/produk/edit-produk.php"; //
    }

    public function update(){

        $gambar= null;

        //cek apakah user upload gambar
        if(isset($_FILES['filefoto']) && $_FILES['filefoto']['error'] == 0){

            $typediizinkan = ['png', 'jpg', 'jpeg'];
            $extfile = strtolower(pathinfo($_FILES['filefoto']['name'],PATHINFO_EXTENSION));
            $extvalid = in_array($extfile, $typediizinkan);
            if(!$extvalid){
                die("tipe file tidak bisa digunakan");
            }
            $ukurandiizinkan = 1024 * 1024 * 10; //ukuran diizinkan 10mb
            $ukuranfile = $_FILES['filefoto']['size'];
            if($ukuranfile > $ukurandiizinkan){
                die('ukuran terlalu besar, maskimal 10mb');
            }
            $targetDir = "uploads/"; 
            $gambar = date("d-m-Y-H-i-s") . "_" . basename($_FILES['filefoto']['name']); //membuat nama file dengan date & time
            $targetFile = $targetDir . $gambar;

            //Simpan file
            move_uploaded_file($_FILES['filefoto']['tmp_name'], $targetFile);
        }

        $data = [
            'id'        =>  $_POST['txtid'],
            'nama'      =>  $_POST['txtnama'],
            'harga'    =>  $_POST['txtharga'],
            'stok'    =>  $_POST['txtstok']
        ];
        $run = $this->model->update($data);
        $this->index(); //kembali ke halaman list
    }
}
?>
