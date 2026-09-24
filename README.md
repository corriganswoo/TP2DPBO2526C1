# TP2DPBO2425C1
TUGAS PRAKTIKUM 2 DPBO INHERITANCE

## ✊🏻 JANJI
Saya Irsyad Afif Musyaffa dengan NIM 2508023 mengerjakan Tugas Praktikum 2 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan.

## 👾 DESKRIPSI PROGRAM
Program ini menerapkan konsep *multilevel inheritance* dalam studi kasus **Katalog Media & Koleksi Film** menggunakan pendekatan Pemrograman Berorientasi Objek (OOP).

Sistem memiliki hierarki 3 tingkat kelas:
1. **KaryaMedia**: *Base class* yang menyimpan identitas paling umum dari entitas media.
2. **Film**: Class turunan pertama (*extends* KaryaMedia) yang menambahkan informasi umum seputar entitas film.
3. **FilmIndonesia**: Class turunan tingkat akhir (*extends* Film) yang memuat spesifikasi khusus untuk katalog film lokal.

Repositori ini menyediakan implementasi dalam 4 bahasa pemograman:
- C++
- Java
- Python
- PHP

**Fitur & Ketentuan Utama:**
- Inisialisasi awal dengan 5 data *default*.
- Menu interaktif untuk menambah data baru (*add*).
- Output katalog ditampilkan menggunakan tabel CLI dinamis yang menyesuaikan panjang data terpanjang secara otomatis.
- Menampilkan informasi data dari class tingkat paling bawah (`FilmIndonesia`).
- Khusus pada PHP, ditambahkan kemampuan penanganan atribut media/foto.

## ❌ ERROR HANDLING
Program dilengkapi dengan mekanisme validasi input untuk menjaga integritas data:
- **Proteksi Tipe Data Numerik:** Memastikan entri berupa angka valid dan positif (misalnya pada input tahun rilis dan harga tiket). Jika input berupa teks/karakter non-numerik atau bernilai negatif, sistem memunculkan pesan error dan meminta input ulang hingga valid.
- **Validasi Keunikan ID:** Mencegah pendaftaran data baru dengan Kode ID yang sudah terpakai (*duplicate primary key*).

## 📐 DIAGRAM KONSEP

<img width="202" height="702" alt="diagramtp2" src="https://github.com/user-attachments/assets/a30d6913-c8cf-4ea4-9302-6cb04d84ff4c" />


**Alasan Pemilihan Class:**
1. **KaryaMedia:** KaryaMedia merupakan class paling umum dalam katalog media, bukan hanya film saja melainkan bisa berupa musik atau buku. Oleh karena itu, atribut umum seperti `idMedia`, `judul`, dan `tahunRilis` diletakkan di class ini.
2. **Film:** Film merupakan kategori yang lebih khusus dari KaryaMedia. Menambahkan atribut spesifik film seperti `genre`, `hargaTiket`, dan `sutradara`.
3. **FilmIndonesia:** FilmIndonesia merupakan turunan dari Film. Mengambil salah satu contoh spesifik yaitu film lokal yang memiliki atribut khas seperti `rumahProduksi`, `bahasaDaerah`, dan `lokasiSyuting`. Kedepannya bisa ditambahkan class lain untuk diturunkan dari Film seperti `FilmAnimasi` atau `FilmDokumenter`.

## ☕️ CLASS & ATRIBUT
1. **KaryaMedia**
   - `idMedia` : string
   - `judul` : string
   - `tahunRilis` : int

2. **Film** *(extends KaryaMedia)*
   - `genre` : string
   - `hargaTiket` : float
   - `sutradara` : string

3. **FilmIndonesia** *(extends Film)*
   - `rumahProduksi` : string
   - `bahasaDaerah` : string
   - `lokasiSyuting` : string

## 🍎 ALUR PROGRAM
1. Program memuat 5 data default/awal.
2. User dapat memilih opsi untuk menampilkan data/menambahkan data.
3. Semua data dapat ditampilkan di tabel dinamis.
4. User dapat menginput data baru.
5. Pada PHP dapat mengupload gambar ke atribut foto.
6. Khusus di PHP, untuk merestart data dan kembali hanya 5 atribut awal bisa dilakukan dengan menekan tombol **Reset Data**.

## DOKUMENTASI PROGRAM
### C++
<img width="1203" height="781" alt="tambah data dan tampilkan data" src="https://github.com/user-attachments/assets/5625c961-6467-49c6-b7d4-69b551d1aa00" />

### Java
<img width="1171" height="779" alt="tambah data dan tampilkan data" src="https://github.com/user-attachments/assets/388bef02-1b1f-4d1e-934f-04f4690471b4" />

### Python
<img width="1146" height="783" alt="tambah data dan tampilkan data" src="https://github.com/user-attachments/assets/b0156343-8141-492f-bd05-5b2708dd4df8" />

### PHP
<img width="1409" height="818" alt="tambah film" src="https://github.com/user-attachments/assets/ff3e5286-1b9e-41ab-a256-521573bd7c67" />

<img width="1340" height="850" alt="tampilkan film" src="https://github.com/user-attachments/assets/9c5facc8-c069-410b-8932-679db68832de" />

