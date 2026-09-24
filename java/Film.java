// Child Class Pertama (Mewarisi KaryaMedia)
public class Film extends KaryaMedia {
    // Atribut tambahan spesifik Film
    private String genre;
    private String sutradara;
    private String ratingUsia;

    // Constructor dengan pemanggilan constructor superclass
    public Film(String idMedia, String judul, int tahunRilis, String genre, String sutradara, String ratingUsia) {
        super(idMedia, judul, tahunRilis); // Memanggil constructor KaryaMedia
        this.genre = genre;
        this.sutradara = sutradara;
        this.ratingUsia = ratingUsia;
    }

    // Setter
    public void setGenre(String genre) { this.genre = genre; }
    public void setSutradara(String sutradara) { this.sutradara = sutradara; }
    public void setRatingUsia(String ratingUsia) { this.ratingUsia = ratingUsia; }

    // Getter
    public String getGenre() { return genre; }
    public String getSutradara() { return sutradara; }
    public String getRatingUsia() { return ratingUsia; }

    // Method Overriding
    @Override
    public void tampilkanData() {
        super.tampilkanData(); // Panggil method dari KaryaMedia
        System.out.println("Genre       : " + getGenre());
        System.out.println("Sutradara   : " + getSutradara());
        System.out.println("Rating Usia : " + getRatingUsia());
    }
}