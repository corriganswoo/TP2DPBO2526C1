#include <iostream>
#include <string>

using namespace std;

// Base Class (Parent Class Utama)
class KaryaMedia
{
private:
    // Atribut dasar entitas karya media
    string idMedia;
    string judul;
    int tahunRilis;

public:
    // Constructor untuk inisialisasi nilai awal KaryaMedia
    KaryaMedia(string idMedia, string judul, int tahunRilis)
    {
        this->idMedia = idMedia;
        this->judul = judul;
        this->tahunRilis = tahunRilis;
    }

    // Setter untuk memperbarui nilai atribut
    void setIdMedia(const string &id) { this->idMedia = id; }
    void setJudul(const string &judul) { this->judul = judul; }
    void setTahunRilis(const int &tahunRilis) { this->tahunRilis = tahunRilis; }

    // Getter untuk mengambil nilai atribut
    string getIdMedia() const { return idMedia; }
    string getJudul() const { return judul; }
    int getTahunRilis() const { return tahunRilis; }

    // Prosedur menampilkan informasi data dasar
    void tampilkanData() const
    {
        cout << "ID Media    : " << getIdMedia() << endl
             << "Judul       : " << getJudul() << endl
             << "Tahun Rilis : " << getTahunRilis() << endl;
    }

    // Destructor
    ~KaryaMedia() {}
};