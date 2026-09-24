#include "Film.cpp"

// Sub-child Class 
class FilmLayarLebar : public Film
{
private:
    // Atribut khusus komersil bioskop
    double hargaTiket;
    string jaringanBioskop;
    string formatProyeksi;

public:
    // Constructor penuh memanggil constructor Film
    FilmLayarLebar(string idMedia, string judul, int tahunRilis, string genre, string sutradara, string ratingUsia, double hargaTiket, string jaringanBioskop, string formatProyeksi)
        : Film(idMedia, judul, tahunRilis, genre, sutradara, ratingUsia) // Inisialisasi atribut Film & KaryaMedia
    {
        this->hargaTiket = hargaTiket;
        this->jaringanBioskop = jaringanBioskop;
        this->formatProyeksi = formatProyeksi;
    }

    // Setter atribut FilmLayarLebar
    void setHargaTiket(double hargaTiket) { this->hargaTiket = hargaTiket; }
    void setJaringanBioskop(string jaringanBioskop) { this->jaringanBioskop = jaringanBioskop; }
    void setFormatProyeksi(string formatProyeksi) { this->formatProyeksi = formatProyeksi; }

    // Getter atribut FilmLayarLebar
    double getHargaTiket() const { return hargaTiket; }
    string getJaringanBioskop() const { return jaringanBioskop; }
    string getFormatProyeksi() const { return formatProyeksi; }

    // Destructor
    ~FilmLayarLebar() {}
};