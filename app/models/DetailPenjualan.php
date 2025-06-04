<?php 

include_once '../config/Database.php';

class DetailPenjualan {
    private $db; 
    private $tabel = "detail_penjualan";

    public function __construct() {
        $this->db = new Database();
        $this->db = $this->db->hubungkan();
    }

    public function simpanData($data) {
        $query = "INSERT INTO $this->tabel (penjualanid, produkid, jumlahproduk, subtotal) 
                  VALUES (:penjualanid, :produkid, :jumlahproduk, :subtotal)";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute($data);
        return $result;
    }
}
?>