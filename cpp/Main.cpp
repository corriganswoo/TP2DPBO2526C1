#include "FilmLayarLebar.cpp"
#include <iostream>
#include <vector>
#include <iomanip>
#include <limits>

using namespace std;

// Container dinamis penampung daftar objek FilmLayarLebar
vector<FilmLayarLebar> listFilm;

// Fungsi untuk mengecek keunikan Kode ID agar tidak duplikat
bool cekIdAda(const string &id)
{
    for (const auto &item : listFilm)
    {
        if (item.getIdMedia() == id)
        {
            return true; // ID ditemukan
        }
    }
    return false; // ID belum ada (unik)
}

// Fungsi kalkulasi lebar kolom dinamis berdasarkan data terpanjang
int hitungLebarKolom(vector<FilmLayarLebar> &data, string kategori)
{
    int maxLen = (int)kategori.length(); // Panjang string header sebagai batas minimal

    if (kategori == "Harga Tiket")
    {
        for (const auto &f : data)
        {
            string strHarga = "Rp" + to_string((int)f.getHargaTiket());
            if ((int)strHarga.length() > maxLen)
                maxLen = (int)strHarga.length();
        }
    }
    else
    {
        for (const auto &f : data)
        {
            string nilai = "";
            if (kategori == "Kode ID") nilai = f.getIdMedia();
            else if (kategori == "Judul Film") nilai = f.getJudul();
            else if (kategori == "Tahun") nilai = to_string(f.getTahunRilis());
            else if (kategori == "Genre") nilai = f.getGenre();
            else if (kategori == "Sutradara") nilai = f.getSutradara();
            else if (kategori == "Rating Usia") nilai = f.getRatingUsia();
            else if (kategori == "Bioskop") nilai = f.getJaringanBioskop();
            else if (kategori == "Format Proyeksi") nilai = f.getFormatProyeksi();

            if ((int)nilai.length() > maxLen)
                maxLen = (int)nilai.length();
        }
    }
    return maxLen; // Mengembalikan panjang karakter terbanyak
}

// Prosedur mencetak tabel data dinamis
void cetakTabelFilm(vector<FilmLayarLebar> &data)
{
    // Cek jika database kosong
    if (data.empty())
    {
        cout << "\n[!] Belum ada koleksi film yang tersimpan.\n";
        return;
    }

    // Kalkulasi margin lebar tiap kolom (+2 untuk spasi pembatas kiri & kanan)
    int cId        = hitungLebarKolom(data, "Kode ID") + 2;
    int cJudul     = hitungLebarKolom(data, "Judul Film") + 2;
    int cTahun     = hitungLebarKolom(data, "Tahun") + 2;
    int cGenre     = hitungLebarKolom(data, "Genre") + 2;
    int cSutradara = hitungLebarKolom(data, "Sutradara") + 2;
    int cRating    = hitungLebarKolom(data, "Rating Usia") + 2;
    int cHarga     = hitungLebarKolom(data, "Harga Tiket") + 2;
    int cBioskop   = hitungLebarKolom(data, "Bioskop") + 2;
    int cFormat    = hitungLebarKolom(data, "Format Proyeksi") + 2;

    cout << "\n=========================================================================================================\n";
    cout << "                                  KATALOG FILM LAYAR LEBAR (BIOSKOP)                                     \n";
    cout << "=========================================================================================================\n";

    // Garis Atas Header
    cout << "+" << string(cId, '=')
         << "+" << string(cJudul, '=')
         << "+" << string(cTahun, '=')
         << "+" << string(cGenre, '=')
         << "+" << string(cSutradara, '=')
         << "+" << string(cRating, '=')
         << "+" << string(cHarga, '=')
         << "+" << string(cBioskop, '=')
         << "+" << string(cFormat, '=') << "+\n";

    // Nama-Nama Header Kolom
    cout << "|" << left << setw(cId) << " Kode ID"
         << "|" << setw(cJudul) << " Judul Film"
         << "|" << setw(cTahun) << " Tahun"
         << "|" << setw(cGenre) << " Genre"
         << "|" << setw(cSutradara) << " Sutradara"
         << "|" << setw(cRating) << " Rating Usia"
         << "|" << setw(cHarga) << " Harga Tiket"
         << "|" << setw(cBioskop) << " Bioskop"
         << "|" << setw(cFormat) << " Format Proyeksi" << "|\n";

    // Garis Bawah Header
    cout << "+" << string(cId, '=')
         << "+" << string(cJudul, '=')
         << "+" << string(cTahun, '=')
         << "+" << string(cGenre, '=')
         << "+" << string(cSutradara, '=')
         << "+" << string(cRating, '=')
         << "+" << string(cHarga, '=')
         << "+" << string(cBioskop, '=')
         << "+" << string(cFormat, '=') << "+\n";

    // Iterasi mencetak setiap baris data
    for (auto &f : data)
    {
        cout << "|" << left << setw(cId) << (" " + f.getIdMedia() + " ")
             << "|" << setw(cJudul) << (" " + f.getJudul() + " ")
             << "|" << setw(cTahun) << (" " + to_string(f.getTahunRilis()) + " ")
             << "|" << setw(cGenre) << (" " + f.getGenre() + " ")
             << "|" << setw(cSutradara) << (" " + f.getSutradara() + " ")
             << "|" << setw(cRating) << (" " + f.getRatingUsia() + " ")
             << "|" << setw(cHarga) << (" " + ("Rp" + to_string((int)f.getHargaTiket())) + " ")
             << "|" << setw(cBioskop) << (" " + f.getJaringanBioskop() + " ")
             << "|" << setw(cFormat) << (" " + f.getFormatProyeksi() + " ")
             << "|\n";
    }

    // Garis Penutup Tabel
    cout << "+" << string(cId, '-')
         << "+" << string(cJudul, '-')
         << "+" << string(cTahun, '-')
         << "+" << string(cGenre, '-')
         << "+" << string(cSutradara, '-')
         << "+" << string(cRating, '-')
         << "+" << string(cHarga, '-')
         << "+" << string(cBioskop, '-')
         << "+" << string(cFormat, '-') << "+\n";
}

int main()
{
    // Pengisian 5 dataset default awal
    listFilm.push_back(FilmLayarLebar("F01", "Laskar Pelangi", 2008, "Drama", "Riri Riza", "SU", 40000, "XXI / CGV", "Digital 2D"));
    listFilm.push_back(FilmLayarLebar("F02", "KKN di Desa Penari", 2022, "Horor", "Awi Suryadi", "17+", 45000, "XXI / Cinepolis", "Digital 2D"));
    listFilm.push_back(FilmLayarLebar("F03", "Avatar: The Way of Water", 2022, "Aksi / Sci-Fi", "James Cameron", "13+", 65000, "XXI / CGV", "IMAX 3D"));
    listFilm.push_back(FilmLayarLebar("F04", "Oppenheimer", 2023, "Biografi / Drama", "Christopher Nolan", "17+", 60000, "XXI", "IMAX 70mm"));
    listFilm.push_back(FilmLayarLebar("F05", "Spider-Man: Brand New Day", 2026, "Aksi / Pahlawan Super", "Destin Cretton", "13+", 55000, "XXI / CGV / Cinepolis", "3D 4DX"));

    int opt;

    // Loop menu utama
    do
    {
        cout << "\n==============================\n";
        cout << "   MANAJEMEN DATABASE FILM    \n";
        cout << "==============================\n";
        cout << " [1] Lihat Katalog Film\n";
        cout << " [2] Entri Film Baru\n";
        cout << " [3] Selesai & Keluar\n";
        cout << "Pilihan Anda (1-3): ";
        cin >> opt;

        if (opt == 1)
        {
            cetakTabelFilm(listFilm); // Opsi tampilkan data
        }
        else if (opt == 2)
        {
            string id, judul, genre, sutradara, rating, bioskop, format;
            int tahun;
            double harga;

            cout << "\n--- FORM INPUT FILM BARU ---\n";
            
            // Validasi keberadaan ID agar unik
            do
            {
                cout << "Kode ID Film   : ";
                cin >> id;
                if (cekIdAda(id))
                {
                    cout << "[ERR] Kode ID sudah terpakai! Gunakan ID lain.\n";
                }
            } while (cekIdAda(id));

            cin.ignore();
            cout << "Judul Film     : "; getline(cin, judul);

            // Validasi input numerik positif untuk tahun rilis
            while (true)
            {
                cout << "Tahun Rilis    : ";
                cin >> tahun;
                if (cin.fail() || tahun <= 0)
                {
                    cout << "[ERR] Tahun rilis harus angka positif!\n";
                    cin.clear();
                    cin.ignore(numeric_limits<streamsize>::max(), '\n');
                }
                else
                {
                    cin.ignore(numeric_limits<streamsize>::max(), '\n');
                    break;
                }
            }

            cout << "Genre Film     : "; getline(cin, genre);
            cout << "Nama Sutradara : "; getline(cin, sutradara);
            cout << "Rating Usia    : "; getline(cin, rating);

            // Validasi input numerik positif untuk harga tiket
            while (true)
            {
                cout << "Harga Tiket    : ";
                cin >> harga;
                if (cin.fail() || harga <= 0)
                {
                    cout << "[ERR] Harga tiket harus berupa nominal angka valid!\n";
                    cin.clear();
                    cin.ignore(numeric_limits<streamsize>::max(), '\n');
                }
                else
                {
                    cin.ignore(numeric_limits<streamsize>::max(), '\n');
                    break;
                }
            }

            cout << "Jaringan Bioskop: "; getline(cin, bioskop);
            cout << "Format Proyeksi : "; getline(cin, format);

            // Menambahkan objek baru ke dalam vector
            listFilm.push_back(FilmLayarLebar(id, judul, tahun, genre, sutradara, rating, harga, bioskop, format));

            cout << "\n[OK] Data film layar lebar berhasil ditambahkan!\n";
        }
    } while (opt != 3);

    cout << "\nProgram selesai. Sampai jumpa!\n";
    return 0;
}