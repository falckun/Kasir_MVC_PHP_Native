<?php 

include_once '../config/Database.php';

class Penjualan {
    private $db; 
    private $tabel = "penjualan";

    public function __construct() {
        $this->db = new Database();
        $this->db = $this->db->hubungkan();
    }

    // Method untuk memanggil semua data penjualan
    public function panggilSemua() {
        $query = "SELECT penjualan.*, pelanggan.namapelanggan 
                  FROM penjualan 
                  JOIN pelanggan ON penjualan.pelangganid = pelanggan.pelangganid";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method untuk memanggil data penjualan berdasarkan ID
    public function panggilkhusus($id) {
        $query = "SELECT penjualan.*, pelanggan.namapelanggan 
                  FROM penjualan 
                  JOIN pelanggan ON penjualan.pelangganid = pelanggan.pelangganid 
                  WHERE penjualan.penjualanid = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method untuk mendapatkan ID penjualan terakhir yang diinsert
    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }

    // Method untuk menghapus data penjualan
    public function hapus($id) {
        $query = "DELETE FROM penjualan WHERE penjualanid = :id";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute(['id' => $id]);
        return $result;
    }

    // Method untuk menyimpan data penjualan baru
    public function simpanData($data) {
        $query = "INSERT INTO penjualan (tanggalpenjualan, totalharga, pelangganid) 
                  VALUES (:tanggal, :total, :pelangganid)";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute($data);
        return $result;
    }

    // Method untuk memperbarui data penjualan
    public function update($data) {
        $query = "UPDATE penjualan 
                  SET tanggalpenjualan = :tanggal, totalharga = :total, pelangganid = :pelangganid 
                  WHERE penjualanid = :id";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute($data);
        return $result;
    }
}
?>