import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    // Container dinamis penampung daftar objek FilmLayarLebar
    private static ArrayList<FilmLayarLebar> listFilm = new ArrayList<>();
    private static Scanner scanner = new Scanner(System.in);

    // Fungsi untuk mengecek keunikan Kode ID
    private static boolean cekIdAda(String id) {
        for (FilmLayarLebar item : listFilm) {
            if (item.getIdMedia().equalsIgnoreCase(id)) {
                return true;
            }
        }
        return false;
    }

    // Fungsi kalkulasi lebar kolom dinamis berdasarkan data terpanjang
    private static int hitungLebarKolom(String kategori) {
        int maxLen = kategori.length();

        for (FilmLayarLebar f : listFilm) {
            String nilai = "";
            switch (kategori) {
                case "Kode ID": nilai = f.getIdMedia(); break;
                case "Judul Film": nilai = f.getJudul(); break;
                case "Tahun": nilai = String.valueOf(f.getTahunRilis()); break;
                case "Genre": nilai = f.getGenre(); break;
                case "Sutradara": nilai = f.getSutradara(); break;
                case "Rating Usia": nilai = f.getRatingUsia(); break;
                case "Harga Tiket": nilai = "Rp" + (int) f.getHargaTiket(); break;
                case "Bioskop": nilai = f.getJaringanBioskop(); break;
                case "Format Proyeksi": nilai = f.getFormatProyeksi(); break;
            }
            if (nilai.length() > maxLen) {
                maxLen = nilai.length();
            }
        }
        return maxLen + 2; // +2 spasi untuk margin kiri & kanan
    }

    // Prosedur mencetak garis pembatas tabel
    private static void cetakGaris(int[] widths, char fill) {
        StringBuilder sb = new StringBuilder("+");
        for (int w : widths) {
            for (int i = 0; i < w; i++) sb.append(fill);
            sb.append("+");
        }
        System.out.println(sb.toString());
    }

    // Prosedur mencetak tabel data dinamis
    private static void cetakTabelFilm() {
        if (listFilm.isEmpty()) {
            System.out.println("\n[!] Belum ada koleksi film yang tersimpan.");
            return;
        }

        // Hitung lebar tiap kolom
        int[] w = {
            hitungLebarKolom("Kode ID"),
            hitungLebarKolom("Judul Film"),
            hitungLebarKolom("Tahun"),
            hitungLebarKolom("Genre"),
            hitungLebarKolom("Sutradara"),
            hitungLebarKolom("Rating Usia"),
            hitungLebarKolom("Harga Tiket"),
            hitungLebarKolom("Bioskop"),
            hitungLebarKolom("Format Proyeksi")
        };

        System.out.println("\n=========================================================================================================");
        System.out.println("                                  KATALOG FILM LAYAR LEBAR (BIOSKOP)                                     ");
        System.out.println("=========================================================================================================");

        // Garis Header Atas
        cetakGaris(w, '=');

        // Header
        String fmt = "| %-" + (w[0]-1) + "s| %-" + (w[1]-1) + "s| %-" + (w[2]-1) + "s| %-" + (w[3]-1) + "s| %-" + (w[4]-1) + "s| %-" + (w[5]-1) + "s| %-" + (w[6]-1) + "s| %-" + (w[7]-1) + "s| %-" + (w[8]-1) + "s|%n";
        System.out.printf(fmt, "Kode ID", "Judul Film", "Tahun", "Genre", "Sutradara", "Rating Usia", "Harga Tiket", "Bioskop", "Format Proyeksi");

        // Garis Header Bawah
        cetakGaris(w, '=');

        // Iterasi Baris Data
        for (FilmLayarLebar f : listFilm) {
            System.out.printf(fmt,
                f.getIdMedia(),
                f.getJudul(),
                f.getTahunRilis(),
                f.getGenre(),
                f.getSutradara(),
                f.getRatingUsia(),
                "Rp" + (int) f.getHargaTiket(),
                f.getJaringanBioskop(),
                f.getFormatProyeksi()
            );
        }

        // Garis Penutup Tabel
        cetakGaris(w, '-');
    }

    public static void main(String[] args) {
        // Inisialisasi 5 dataset default awal
        listFilm.add(new FilmLayarLebar("F01", "Laskar Pelangi", 2008, "Drama", "Riri Riza", "SU", 40000, "XXI / CGV", "Digital 2D"));
        listFilm.add(new FilmLayarLebar("F02", "KKN di Desa Penari", 2022, "Horor", "Awi Suryadi", "17+", 45000, "XXI / Cinepolis", "Digital 2D"));
        listFilm.add(new FilmLayarLebar("F03", "Avatar: The Way of Water", 2022, "Aksi / Sci-Fi", "James Cameron", "13+", 65000, "XXI / CGV", "IMAX 3D"));
        listFilm.add(new FilmLayarLebar("F04", "Oppenheimer", 2023, "Biografi / Drama", "Christopher Nolan", "17+", 60000, "XXI", "IMAX 70mm"));
        listFilm.add(new FilmLayarLebar("F05", "Spider-Man: Brand New Day", 2026, "Aksi / Pahlawan Super", "Destin Cretton", "13+", 55000, "XXI / CGV / Cinepolis", "3D 4DX"));

        int opt = 0;

        do {
            System.out.println("\n==============================");
            System.out.println("   MANAJEMEN DATABASE FILM    ");
            System.out.println("==============================");
            System.out.println(" [1] Lihat Katalog Film");
            System.out.println(" [2] Entri Film Baru");
            System.out.println(" [3] Selesai & Keluar");
            System.out.print("Pilihan Anda (1-3): ");

            if (!scanner.hasNextInt()) {
                System.out.println("[ERR] Input harus berupa angka!");
                scanner.next();
                continue;
            }

            opt = scanner.nextInt();
            scanner.nextLine(); // Clear buffer newline

            if (opt == 1) {
                cetakTabelFilm();
            } else if (opt == 2) {
                System.out.println("\n--- FORM INPUT FILM BARU ---");

                // Validasi ID Unik
                String id = "";
                while (true) {
                    System.out.print("Kode ID Film   : ");
                    id = scanner.nextLine().trim();
                    if (cekIdAda(id)) {
                        System.out.println("[ERR] Kode ID sudah terpakai! Gunakan ID lain.");
                    } else {
                        break;
                    }
                }

                System.out.print("Judul Film     : ");
                String judul = scanner.nextLine().trim();

                // Validasi Input Tahun
                int tahun = 0;
                while (true) {
                    System.out.print("Tahun Rilis    : ");
                    if (scanner.hasNextInt()) {
                        tahun = scanner.nextInt();
                        if (tahun > 0) {
                            scanner.nextLine();
                            break;
                        }
                    } else {
                        scanner.next();
                    }
                    System.out.println("[ERR] Tahun rilis harus angka positif!");
                }

                System.out.print("Genre Film     : ");
                String genre = scanner.nextLine().trim();

                System.out.print("Nama Sutradara : ");
                String sutradara = scanner.nextLine().trim();

                System.out.print("Rating Usia    : ");
                String rating = scanner.nextLine().trim();

                // Validasi Input Harga
                double harga = 0;
                while (true) {
                    System.out.print("Harga Tiket    : ");
                    if (scanner.hasNextDouble()) {
                        harga = scanner.nextDouble();
                        if (harga > 0) {
                            scanner.nextLine();
                            break;
                        }
                    } else {
                        scanner.next();
                    }
                    System.out.println("[ERR] Harga tiket harus berupa nominal angka valid!");
                }

                System.out.print("Jaringan Bioskop: ");
                String bioskop = scanner.nextLine().trim();

                System.out.print("Format Proyeksi : ");
                String format = scanner.nextLine().trim();

                // Menambahkan ke ArrayList
                listFilm.add(new FilmLayarLebar(id, judul, tahun, genre, sutradara, rating, harga, bioskop, format));
                System.out.println("\n[OK] Data film layar lebar berhasil ditambahkan!");
            }
        } while (opt != 3);

        System.out.println("\nProgram selesai. Sampai jumpa!");
    }
}