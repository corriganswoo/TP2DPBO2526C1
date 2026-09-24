#include "KaryaMedia.cpp"

// Child Class Pertama (Mewarisi KaryaMedia)
class Film : public KaryaMedia
{
private:
    // Atribut tambahan spesifik entitas Film
    string genre;
    string sutradara;
    string ratingUsia;

public:
    // Constructor dengan memanggil constructor parent (KaryaMedia)
    Film(string idMedia, string judul, int tahunRilis, string genre, string sutradara, string ratingUsia)
        : KaryaMedia(idMedia, judul, tahunRilis) // Inisialisasi atribut parent
    {
        this->genre = genre;
        this->sutradara = sutradara;
        this->ratingUsia = ratingUsia;
    }

    // Setter atribut Film
    void setGenre(string genre) { this->genre = genre; }
    void setSutradara(string sutradara) { this->sutradara = sutradara; }
    void setRatingUsia(string ratingUsia) { this->ratingUsia = ratingUsia; }

    // Getter atribut Film
    string getGenre() const { return genre; }
    string getSutradara() const { return sutradara; }
    string getRatingUsia() const { return ratingUsia; }

    // Prosedur menampilkan data film (Overriding + memanggil parent)
    void tampilkanData() const
    {
        KaryaMedia::tampilkanData(); // Cetak atribut KaryaMedia
        cout << "Genre       : " << getGenre() << endl
             << "Sutradara   : " << getSutradara() << endl
             << "Rating Usia : " << getRatingUsia() << endl;
    }

    // Destructor
    ~Film() {}
};