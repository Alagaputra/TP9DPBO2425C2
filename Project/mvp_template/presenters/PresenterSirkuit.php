<?php
include_once("models/TabelSirkuit.php");
include_once("views/ViewSirkuit.php");

class PresenterSirkuit {
    private $tabel;
    private $view;

    public function __construct($tabel, $view){
        $this->tabel = $tabel;
        $this->view = $view;
    }

    public function tampilkanSirkuit(){
        $data = $this->tabel->getAllSirkuit();
        // Convert array assoc ke array object Sirkuit
        $list = [];
        foreach($data as $row){
            $list[] = new Sirkuit($row['id'], $row['nama'], $row['lokasi'], $row['panjang'], $row['jumlahTikungan']);
        }
        return $this->view->tampilSirkuit($list);
    }

    public function tampilkanForm($id = null){
        $data = $id ? $this->tabel->getSirkuitById($id) : null;
        return $this->view->tampilFormSirkuit($data);
    }

    public function prosesTambah($post){
        $this->tabel->addSirkuit($post['nama'], $post['lokasi'], $post['panjang'], $post['tikungan']);
    }
    public function prosesUbah($post){
        $this->tabel->updateSirkuit($post['id'], $post['nama'], $post['lokasi'], $post['panjang'], $post['tikungan']);
    }
    public function prosesHapus($id){
        $this->tabel->deleteSirkuit($id);
    }
}
?>