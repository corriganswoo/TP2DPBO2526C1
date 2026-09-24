from KaryaMedia import KaryaMedia

# Child Class Pertama (Mewarisi KaryaMedia)
class Film(KaryaMedia):
    def __init__(self, id_media: str = "", judul: str = "", tahun_rilis: int = 0,
                 genre: str = "", sutradara: str = "", rating_usia: str = ""):
        # Pemanggilan constructor superclass (KaryaMedia)
        super().__init__(id_media, judul, tahun_rilis)
        self._genre = genre
        self._sutradara = sutradara
        self._rating_usia = rating_usia

    # Setter
    def set_genre(self, genre: str):
        self._genre = genre

    def set_sutradara(self, sutradara: str):
        self._sutradara = sutradara

    def set_rating_usia(self, rating_usia: str):
        self._rating_usia = rating_usia

    # Getter
    def get_genre(self) -> str:
        return self._genre

    def get_sutradara(self) -> str:
        return self._sutradara

    def get_rating_usia(self) -> str:
        return self._rating_usia

    # Method Overriding
    def tampilkan_data(self):
        super().tampilkan_data() # Panggil method dari KaryaMedia
        print(f"Genre       : {self.get_genre()}")
        print(f"Sutradara   : {self.get_sutradara()}")
        print(f"Rating Usia : {self.get_rating_usia()}")