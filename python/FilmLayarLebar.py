from Film import Film

# Sub-child Class (Mewarisi Film - Multilevel Inheritance Level 3)
class FilmLayarLebar(Film):
    def __init__(self, id_media: str = "", judul: str = "", tahun_rilis: int = 0,
                 genre: str = "", sutradara: str = "", rating_usia: str = "",
                 harga_tiket: float = 0.0, jaringan_bioskop: str = "", format_proyeksi: str = ""):
        # Multilevel Inheritance Super Constructor Call
        super().__init__(id_media, judul, tahun_rilis, genre, sutradara, rating_usia)
        self.__harga_tiket = harga_tiket
        self.__jaringan_bioskop = jaringan_bioskop
        self.__format_proyeksi = format_proyeksi

    # Setter
    def set_harga_tiket(self, harga_tiket: float):
        self.__harga_tiket = harga_tiket

    def set_jaringan_bioskop(self, jaringan_bioskop: str):
        self.__jaringan_bioskop = jaringan_bioskop

    def set_format_proyeksi(self, format_proyeksi: str):
        self.__format_proyeksi = format_proyeksi

    # Getter
    def get_harga_tiket(self) -> float:
        return self.__harga_tiket

    def get_jaringan_bioskop(self) -> str:
        return self.__jaringan_bioskop

    def get_format_proyeksi(self) -> str:
        return self.__format_proyeksi