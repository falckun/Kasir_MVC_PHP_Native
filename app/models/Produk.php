<?php 

include_once '../config/Database.php';

class Produk {
    private $db; 
    private $tabel="produk";
// Otomatis terhubung ke database   
    public function __construct() {
        $this->db = new Database ();
        $this->db = $this->db->hubungkan();
}

// Method untuk memangill semua databse pelanggan 
    public function panggilSemua() {
        $query = "SELECT * FROM $this->tabel"; //Membuat perintah SQL untuk memanggil tabel pelanggan
        $stmt = $this->db->prepare($query); //Untuk memanggil dan menyiapkan perintah sql 
        $stmt->execute();//Untuk menjalankan query 
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC); //Untuk mendapatkan hasilnya dari perintah stmt. Fetch diambil untuk mengambil baris. DIsini menggunakan fetch assoc jadi menggunakan array asosiatif.
        return $result;//Untuk mengembalikan hasilnya dan mengakhiri suatu function.
    }

//Method untuk memanggil beberapa database tertentu
    public function panggilkhusus($id){
        $query = "SELECT * FROM $this->tabel WHERE produkid=$id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

//Method untuk menyimpan data baru
    public function simpanData($data){
        $query = "INSERT INTO $this->tabel VALUES(:id, :nama, :harga, :stok, :foto)"; //query SQL untuk menambahkan data baru ke table
        $stmt = $this->db->prepare($query); 
        $result = $stmt->execute($data);
        return $result;
    }

//Method untuk menghapus
    public function hapus($id){
        $query = "DELETE FROM $this->tabel WHERE produkid=$id";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute();
        return $result;
    }
    
    public function update($data){
        $query = "UPDATE $this->tabel SET namaproduk = :nama, harga = :harga, stok = :stok WHERE produkid = :id";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute($data);
        return $result;
    }

}


?>