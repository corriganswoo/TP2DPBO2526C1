from FilmLayarLebar import FilmLayarLebar

# Container dinamis penampung objek
list_film = []

def cek_id_ada(id_input: str) -> bool:
    """Mengecek keunikan Kode ID."""
    for item in list_film:
        if item.get_id_media().lower() == id_input.lower():
            return True
    return False

def hitung_lebar_kolom(kategori: str) -> int:
    """Menghitung panjang isi teks terpanjang + 2 spasi margin."""
    max_len = len(kategori)

    for f in list_film:
        nilai = ""
        if kategori == "Kode ID":
            nilai = f.get_id_media()
        elif kategori == "Judul Film":
            nilai = f.get_judul()
        elif kategori == "Tahun":
            nilai = str(f.get_tahun_rilis())
        elif kategori == "Genre":
            nilai = f.get_genre()
        elif kategori == "Sutradara":
            nilai = f.get_sutradara()
        elif kategori == "Rating Usia":
            nilai = f.get_rating_usia()
        elif kategori == "Harga Tiket":
            nilai = f"Rp{int(f.get_harga_tiket())}"
        elif kategori == "Bioskop":
            nilai = f.get_jaringan_bioskop()
        elif kategori == "Format Proyeksi":
            nilai = f.get_format_proyeksi()

        if len(nilai) > max_len:
            max_len = len(nilai)

    return max_len + 2

def cetak_tabel_film():
    """Menggambar tabel dinamis dengan perataan presisi."""
    if not list_film:
        print("\n[!] Belum ada koleksi film yang tersimpan.")
        return

    # Hitung lebar tiap kolom secara presisi
    w_id        = hitung_lebar_kolom("Kode ID")
    w_judul     = hitung_lebar_kolom("Judul Film")
    w_tahun     = hitung_lebar_kolom("Tahun")
    w_genre     = hitung_lebar_kolom("Genre")
    w_sutradara = hitung_lebar_kolom("Sutradara")
    w_rating    = hitung_lebar_kolom("Rating Usia")
    w_harga     = hitung_lebar_kolom("Harga Tiket")
    w_bioskop   = hitung_lebar_kolom("Bioskop")
    w_format    = hitung_lebar_kolom("Format Proyeksi")

    # Pembatas Tabel
    line_header = "+" + "="*w_id + "+" + "="*w_judul + "+" + "="*w_tahun + "+" + "="*w_genre + "+" + "="*w_sutradara + "+" + "="*w_rating + "+" + "="*w_harga + "+" + "="*w_bioskop + "+" + "="*w_format + "+"
    line_bottom = "+" + "-"*w_id + "+" + "-"*w_judul + "+" + "-"*w_tahun + "+" + "-"*w_genre + "+" + "-"*w_sutradara + "+" + "-"*w_rating + "+" + "-"*w_harga + "+" + "-"*w_bioskop + "+" + "-"*w_format + "+"

    print("\n=========================================================================================================")
    print("                                  KATALOG FILM LAYAR LEBAR (BIOSKOP)                                     ")
    print("=========================================================================================================")

    # Format string presisi menggunakan ljust
    fmt = "|{}|{}|{}|{}|{}|{}|{}|{}|{}|"

    # Header
    print(line_header)
    print(fmt.format(
        " Kode ID".ljust(w_id),
        " Judul Film".ljust(w_judul),
        " Tahun".ljust(w_tahun),
        " Genre".ljust(w_genre),
        " Sutradara".ljust(w_sutradara),
        " Rating Usia".ljust(w_rating),
        " Harga Tiket".ljust(w_harga),
        " Bioskop".ljust(w_bioskop),
        " Format Proyeksi".ljust(w_format)
    ))
    print(line_header)

    # Baris Rekaman Data
    for f in list_film:
        print(fmt.format(
            f" {f.get_id_media()}".ljust(w_id),
            f" {f.get_judul()}".ljust(w_judul),
            f" {f.get_tahun_rilis()}".ljust(w_tahun),
            f" {f.get_genre()}".ljust(w_genre),
            f" {f.get_sutradara()}".ljust(w_sutradara),
            f" {f.get_rating_usia()}".ljust(w_rating),
            f" Rp{int(f.get_harga_tiket())}".ljust(w_harga),
            f" {f.get_jaringan_bioskop()}".ljust(w_bioskop),
            f" {f.get_format_proyeksi()}".ljust(w_format)
        ))

    print(line_bottom)

def main():
    # Inisialisasi 5 dataset default awal
    list_film.append(FilmLayarLebar("F01", "Laskar Pelangi", 2008, "Drama", "Riri Riza", "SU", 40000, "XXI / CGV", "Digital 2D"))
    list_film.append(FilmLayarLebar("F02", "KKN di Desa Penari", 2022, "Horor", "Awi Suryadi", "17+", 45000, "XXI / Cinepolis", "Digital 2D"))
    list_film.append(FilmLayarLebar("F03", "Avatar: The Way of Water", 2022, "Aksi / Sci-Fi", "James Cameron", "13+", 65000, "XXI / CGV", "IMAX 3D"))
    list_film.append(FilmLayarLebar("F04", "Oppenheimer", 2023, "Biografi / Drama", "Christopher Nolan", "17+", 60000, "XXI", "IMAX 70mm"))
    list_film.append(FilmLayarLebar("F05", "Spider-Man: Brand New Day", 2026, "Aksi / Pahlawan Super", "Destin Cretton", "13+", 55000, "XXI / CGV / Cinepolis", "3D 4DX"))

    while True:
        print("\n==============================")
        print("   MANAJEMEN DATABASE FILM    ")
        print("==============================")
        print(" [1] Lihat Katalog Film")
        print(" [2] Entri Film Baru")
        print(" [3] Selesai & Keluar")
        opt_input = input("Pilihan Anda (1-3): ").strip()

        if not opt_input.isdigit():
            print("[ERR] Input harus berupa angka!")
            continue

        opt = int(opt_input)

        if opt == 1:
            cetak_tabel_film()
        elif opt == 2:
            print("\n--- FORM INPUT FILM BARU ---")

            # Validasi ID Unik
            while True:
                id_film = input("Kode ID Film   : ").strip()
                if cek_id_ada(id_film):
                    print("[ERR] Kode ID sudah terpakai! Gunakan ID lain.")
                else:
                    break

            judul = input("Judul Film     : ").strip()

            # Validasi Tahun
            while True:
                tahun_input = input("Tahun Rilis    : ").strip()
                if tahun_input.isdigit() and int(tahun_input) > 0:
                    tahun = int(tahun_input)
                    break
                print("[ERR] Tahun rilis harus angka positif!")

            genre = input("Genre Film     : ").strip()
            sutradara = input("Nama Sutradara : ").strip()
            rating = input("Rating Usia    : ").strip()

            # Validasi Harga
            while True:
                try:
                    harga_input = input("Harga Tiket    : ").strip()
                    harga = float(harga_input)
                    if harga > 0:
                        break
                    print("[ERR] Harga tiket harus angka positif!")
                except ValueError:
                    print("[ERR] Harga tiket harus berupa nominal angka valid!")

            bioskop = input("Jaringan Bioskop: ").strip()
            format_p = input("Format Proyeksi : ").strip()

            list_film.append(FilmLayarLebar(id_film, judul, tahun, genre, sutradara, rating, harga, bioskop, format_p))
            print("\n[OK] Data film layar lebar berhasil ditambahkan!")
        elif opt == 3:
            print("\nProgram selesai. Sampai jumpa!")
            break

if __name__ == "__main__":
    main()