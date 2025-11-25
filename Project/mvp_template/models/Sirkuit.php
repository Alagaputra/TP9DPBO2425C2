<?php
class Sirkuit {
    private $id, $nama, $lokasi, $panjang, $tikungan;

    public function __construct($id, $nama, $lokasi, $panjang, $tikungan){
        $this->id = $id; $this->nama = $nama; $this->lokasi = $lokasi;
        $this->panjang = $panjang; $this->tikungan = $tikungan;
    }
    // Getters
    public function getId(){ return $this->id; }
    public function getNama(){ return $this->nama; }
    public function getLokasi(){ return $this->lokasi; }
    public function getPanjang(){ return $this->panjang; }
    public function getTikungan(){ return $this->tikungan; }
}
?>