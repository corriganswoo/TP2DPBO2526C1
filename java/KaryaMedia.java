// Base Class (Parent Class Utama)
public class KaryaMedia {
    // Atribut dasar entitas karya media
    private String idMedia;
    private String judul;
    private int tahunRilis;

    // Constructor
    public KaryaMedia(String idMedia, String judul, int tahunRilis) {
        this.idMedia = idMedia;
        this.judul = judul;
        this.tahunRilis = tahunRilis;
    }

    // Setter
    public void setIdMedia(String idMedia) { this.idMedia = idMedia; }
    public void setJudul(String judul) { this.judul = judul; }
    public void setTahunRilis(int tahunRilis) { this.tahunRilis = tahunRilis; }

    // Getter
    public String getIdMedia() { return idMedia; }
    public String getJudul() { return judul; }
    public int getTahunRilis() { return tahunRilis; }

    // Method menampilkan data dasar
    public void tampilkanData() {
        System.out.println("ID Media    : " + getIdMedia());
        System.out.println("Judul       : " + getJudul());
        System.out.println("Tahun Rilis : " + getTahunRilis());
    }
}