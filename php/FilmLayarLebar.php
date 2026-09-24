<?php
require_once "Film.php";

// Class FilmLayarLebar mewarisi Film (Multilevel Inheritance Level 3)
class FilmLayarLebar extends Film {
    private $hargaTiket;
    private $jaringanBioskop;
    private $formatProyeksi;
    private $poster;

    public function __construct($idMedia, $judul, $tahunRilis, $genre, $sutradara, $ratingUsia, $hargaTiket, $jaringanBioskop, $formatProyeksi, $poster = '') {
        parent::__construct($idMedia, $judul, $tahunRilis, $genre, $sutradara, $ratingUsia);
        $this->hargaTiket = $hargaTiket;
        $this->jaringanBioskop = $jaringanBioskop;
        $this->formatProyeksi = $formatProyeksi;
        $this->poster = $poster;
    }

    // Getter
    public function getHargaTiket() { return $this->hargaTiket; }
    public function getJaringanBioskop() { return $this->jaringanBioskop; }
    public function getFormatProyeksi() { return $this->formatProyeksi; }
    public function getPoster() { return $this->poster; }

    // Setter
    public function setHargaTiket($hargaTiket) { $this->hargaTiket = $hargaTiket; }
    public function setJaringanBioskop($jaringanBioskop) { $this->jaringanBioskop = $jaringanBioskop; }
    public function setFormatProyeksi($formatProyeksi) { $this->formatProyeksi = $formatProyeksi; }
    public function setPoster($poster) { $this->poster = $poster; }
}
?>