<?php

class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $namadb = "27rplb_10";
    public $koneksi;

    public function hubungkan(){
        $this -> koneksi = new PDO("mysql:host=$this->host;dbname=$this->namadb","$this->user","$this->pass");
        //  method dari PDO untuk memberi informasi jika ada error
        $this -> koneksi -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->koneksi;
    }

}

?>
