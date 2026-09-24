<?php
// Class Induk Utama
class KaryaMedia {
    private $idMedia;
    private $judul;
    private $tahunRilis;

    public function __construct($idMedia, $judul, $tahunRilis) {
        $this->idMedia = $idMedia;
        $this->judul = $judul;
        $this->tahunRilis = $tahunRilis;
    }

    // Getter
    public function getIdMedia() { return $this->idMedia; }
    public function getJudul() { return $this->judul; }
    public function getTahunRilis() { return $this->tahunRilis; }

    // Setter
    public function setIdMedia($idMedia) { $this->idMedia = $idMedia; }
    public function setJudul($judul) { $this->judul = $judul; }
    public function setTahunRilis($tahunRilis) { $this->tahunRilis = $tahunRilis; }
}
?>