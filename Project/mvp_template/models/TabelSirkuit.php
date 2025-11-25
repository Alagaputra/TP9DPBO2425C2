<?php
include_once("DB.php");
include_once("KontrakModelSirkuit.php");

class TabelSirkuit extends DB implements KontrakModelSirkuit {
    public function __construct($host, $db_name, $username, $password){
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllSirkuit(): array {
        $this->executeQuery("SELECT * FROM sirkuit");
        return $this->getAllResult();
    }

    public function getSirkuitById($id): ?array {
        $this->executeQuery("SELECT * FROM sirkuit WHERE id = :id", ['id' => $id]);
        return $this->getAllResult()[0] ?? null;
    }

    public function addSirkuit($nama, $lokasi, $panjang, $tikungan): void {
        // kolom disesuaikan dengan yang ada di database
        $q = "INSERT INTO sirkuit (nama, lokasi, panjang, jumlahTikungan) 
              VALUES (:n, :neg, :p, :t)";
        $this->executeQuery($q, [
            'n'   => $nama,
            'neg' => $lokasi,
            'p'   => $panjang,
            't'   => $tikungan
        ]);
    }

    public function updateSirkuit($id, $nama, $lokasi, $panjang, $tikungan): void {
        $q = "UPDATE sirkuit 
              SET nama = :n, lokasi = :neg, panjang = :p, jumlahTikungan = :t 
              WHERE id = :id";
        $this->executeQuery($q, [
            'id'  => $id,
            'n'   => $nama,
            'neg' => $lokasi,
            'p'   => $panjang,
            't'   => $tikungan
        ]);
    }

    public function deleteSirkuit($id): void {
        $this->executeQuery("DELETE FROM sirkuit WHERE id = :id", ['id' => $id]);
    }
}
?>
