# Base Class (Parent Class Utama)
class KaryaMedia:
    def __init__(self, id_media: str = "", judul: str = "", tahun_rilis: int = 0):
        # Atribut dasar entitas karya media
        self._id_media = id_media
        self._judul = judul
        self._tahun_rilis = tahun_rilis

    # Setter
    def set_id_media(self, id_media: str):
        self._id_media = id_media

    def set_judul(self, judul: str):
        self._judul = judul

    def set_tahun_rilis(self, tahun_rilis: int):
        self._tahun_rilis = tahun_rilis

    # Getter
    def get_id_media(self) -> str:
        return self._id_media

    def get_judul(self) -> str:
        return self._judul

    def get_tahun_rilis(self) -> int:
        return self._tahun_rilis

    # Method menampilkan data dasar
    def tampilkan_data(self):
        print(f"ID Media    : {self.get_id_media()}")
        print(f"Judul       : {self.get_judul()}")
        print(f"Tahun Rilis : {self.get_tahun_rilis()}")