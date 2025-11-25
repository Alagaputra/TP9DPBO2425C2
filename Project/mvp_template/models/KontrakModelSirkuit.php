<?php

interface KontrakModelSirkuit {
    public function getAllSirkuit(): array;
    public function getSirkuitById($id): ?array;
    
    // method crud sirkuit
    public function addSirkuit($nama, $lokasi, $panjang, $tikungan): void;
    public function updateSirkuit($id, $nama, $lokasi, $panjang, $tikungan): void;
    public function deleteSirkuit($id): void;
}

?>