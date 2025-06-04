<?php 
// include file Pelanggan.php yang berisi definisi class Pelanggan
include "../app/models/Pelanggan.php";

// definisi class PelangganControllers
class PelangganControllers {
    // deklarasi properti $model sebagai private
    private $model;

    // konstruktor class PelangganControllers
    public function __construct() {
        // Inisialisasi properti $model dengan membuat instance class Pelanggan
        $this->model = new Pelanggan();
    }

    // metode index yang akan dijalankan saat controller dipanggil
    public function index() {
        // memanggil metode panggilSemua() dari model Pelanggan untuk mengambil semua data pelanggan
        $data = $this->model->panggilSemua();
        
        // include file view untuk menampilkan data pelanggan
        include "../app/views/pelanggan/list.php";
    }

    // metode detail yang akan dijalankan saat controller dipanggil
    public function detail($param){
        $data = $this->model->panggilkhusus($param);
        include "../app/views/pelanggan/detail.php";
    }

    public function delete($param){
        $run = $this->model->hapus($param);
        $this->index(); //menjalankan method index
    }

    public function tambah(){
        include "../app/views/pelanggan/tambah.php";
    }

    public function simpan() {
        $gambar = null;

        // Cek apakah user upload gambar
        if (isset($_FILES['filefoto']) && $_FILES['filefoto']['error'] == 0) {
            $typediizinkan = ['png', 'jpg', 'jpeg'];
            $extfile = strtolower(pathinfo($_FILES['filefoto']['name'], PATHINFO_EXTENSION));
            $extvalid = in_array($extfile, $typediizinkan);
            if (!$extvalid) {
                die("Tipe file tidak bisa digunakan");
            }
            $ukurandiizinkan = 1024 * 1024 * 10; // ukuran diizinkan 10mb
            $ukuranfile = $_FILES['filefoto']['size'];
            if ($ukuranfile > $ukurandiizinkan) {
                die('Ukuran terlalu besar, maksimal 10mb');
            }
            $targetDir = "uploads/";
            $gambar = date("d-m-Y-H-i-s") . "_" . basename($_FILES['filefoto']['name']);
            $targetFile = $targetDir . $gambar;

            // Simpan file
            move_uploaded_file($_FILES['filefoto']['tmp_name'], $targetFile);
        }

        $data = [
            'id' => $_POST['txtid'],
            'nama' => $_POST['txtnama'], // Baris 68
            'alamat' => $_POST['txtalamat'], // Baris 69
            'notelp' => $_POST['txtno'], // Baris 70
            'foto' => $gambar
        ];
        $run = $this->model->simpanData($data);
        $this->index();
    }

    public function edit($id){
        $data = $this->model->panggilkhusus($id); //menampung data dari database
        include "../app/views/pelanggan/edit.php"; //
    }

    public function update(){

        $gambar= null;

        //cek apakah user upload gambar
        if(isset($_FILES['filefoto']) && $_FILES['filefoto']['error'] == 0){

            $typediizinkan = ['png', 'jpg', 'jpeg']; //ext yang diizikan
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

        $data = [                               // untuk mengambil data
            'id'        =>  $_POST['txtid'],
            'nama'      =>  $_POST['txtnama'],
            'alamat'    =>  $_POST['txtalamat'],
            'notelp'    =>  $_POST['txtno'],
            'foto'      =>  $gambar
        ];
        $run = $this->model->update($data);
        $this->index(); //kembali ke halaman list
    }
}
?>
