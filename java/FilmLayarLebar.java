// Sub-child Class 
public class FilmLayarLebar extends Film {
    // Atribut khusus bioskop
    private double hargaTiket;
    private String jaringanBioskop;
    private String formatProyeksi;

    // Constructor penuh memanggil constructor Film
    public FilmLayarLebar(String idMedia, String judul, int tahunRilis, String genre, String sutradara, 
                          String ratingUsia, double hargaTiket, String jaringanBioskop, String formatProyeksi) {
        super(idMedia, judul, tahunRilis, genre, sutradara, ratingUsia); // Memanggil constructor Film
        this.hargaTiket = hargaTiket;
        this.jaringanBioskop = jaringanBioskop;
        this.formatProyeksi = formatProyeksi;
    }

    // Setter
    public void setHargaTiket(double hargaTiket) { this.hargaTiket = hargaTiket; }
    public void setJaringanBioskop(String jaringanBioskop) { this.jaringanBioskop = jaringanBioskop; }
    public void setFormatProyeksi(String formatProyeksi) { this.formatProyeksi = formatProyeksi; }

    // Getter
    public double getHargaTiket() { return hargaTiket; }
    public String getJaringanBioskop() { return jaringanBioskop; }
    public String getFormatProyeksi() { return formatProyeksi; }
}