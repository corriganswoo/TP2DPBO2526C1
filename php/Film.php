<?php
require_once "KaryaMedia.php";

// Class Film mewarisi KaryaMedia
class Film extends KaryaMedia {
    private $genre;
    private $sutradara;
    private $ratingUsia;

    public function __construct($idMedia, $judul, $tahunRilis, $genre, $sutradara, $ratingUsia) {
        parent::__construct($idMedia, $judul, $tahunRilis);
        $this->genre = $genre;
        $this->sutradara = $sutradara;
        $this->ratingUsia = $ratingUsia;
    }

    // Getter
    public function getGenre() { return $this->genre; }
    public function getSutradara() { return $this->sutradara; }
    public function getRatingUsia() { return $this->ratingUsia; }

    // Setter
    public function setGenre($genre) { $this->genre = $genre; }
    public function setSutradara($sutradara) { $this->sutradara = $sutradara; }
    public function setRatingUsia($ratingUsia) { $this->ratingUsia = $ratingUsia; }
}
?>