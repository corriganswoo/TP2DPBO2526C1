<?php
require_once 'KaryaMedia.php';
require_once 'Film.php';
require_once 'FilmLayarLebar.php';

session_start();

// Reset SESSION
if (isset($_POST['reset_data'])) {
    session_unset();
    session_destroy();
    header("Location: Main.php");
    exit();
}

// Inisialisasi dataset awal dengan kelas FilmLayarLebar
if (!isset($_SESSION['daftarFilm']) || !is_array($_SESSION['daftarFilm'])) {
    $_SESSION['daftarFilm'] = [
        new FilmLayarLebar('F01', 'Laskar Pelangi', 2008, 'Drama', 'Riri Riza', 'SU', 40000, 'XXI / CGV', 'Digital 2D', './images/laskar_pelangi.jpg'),
        new FilmLayarLebar('F02', 'KKN di Desa Penari', 2022, 'Horor', 'Awi Suryadi', '17+', 45000, 'XXI / Cinepolis', 'Digital 2D', './images/kkn.jpg'),
        new FilmLayarLebar('F03', 'Avatar: The Way of Water', 2022, 'Aksi / Sci-Fi', 'James Cameron', '13+', 65000, 'XXI / CGV', 'IMAX 3D', './images/avatar.jpg'),
        new FilmLayarLebar('F04', 'Oppenheimer', 2023, 'Biografi / Drama', 'Christopher Nolan', '17+', 60000, 'XXI', 'IMAX 70mm', './images/oppenheimer.jpg'),
        new FilmLayarLebar('F05', 'Spider-Man: Brand New Day', 2026, 'Aksi / Superpahlawan', 'Destin Cretton', '13+', 55000, 'XXI / CGV / Cinepolis', '3D 4DX', './images/spiderman.jpg')
    ];
}

$message = '';
$message_type = '';

function isIdExists($id, $list) {
    foreach ($list as $item) {
        if (is_object($item) && method_exists($item, 'getIdMedia')) {
            if (strcasecmp($item->getIdMedia(), $id) === 0) {
                return true;
            }
        }
    }
    return false;
}

// Logika Tambah Data Film
if (isset($_POST['tambah'])) {
    $idMedia         = trim($_POST['idMedia']);
    $judul           = trim($_POST['judul']);
    $genre           = trim($_POST['genre']);
    $sutradara       = trim($_POST['sutradara']);
    $ratingUsia      = trim($_POST['ratingUsia']);
    $jaringanBioskop = trim($_POST['jaringanBioskop']);
    $formatProyeksi  = trim($_POST['formatProyeksi']);
    $tahunRilis      = filter_input(INPUT_POST, 'tahunRilis', FILTER_VALIDATE_INT);
    $hargaTiket      = filter_input(INPUT_POST, 'hargaTiket', FILTER_VALIDATE_FLOAT);

    $errors = [];
    if (empty($idMedia)) { $errors[] = "ID Film wajib diisi."; }
    elseif (isIdExists($idMedia, $_SESSION['daftarFilm'])) { $errors[] = "ID Film '" . htmlspecialchars($idMedia) . "' sudah digunakan."; }
    if (empty($judul)) { $errors[] = "Judul film wajib diisi."; }
    if ($tahunRilis === false || $tahunRilis <= 0) { $errors[] = "Tahun rilis harus berupa angka positif."; }
    if (empty($genre)) { $errors[] = "Genre film wajib diisi."; }
    if (empty($sutradara)) { $errors[] = "Nama sutradara wajib diisi."; }
    if (empty($ratingUsia)) { $errors[] = "Rating usia wajib diisi."; }
    if ($hargaTiket === false || $hargaTiket <= 0) { $errors[] = "Harga tiket harus berupa angka positif."; }
    if (empty($jaringanBioskop)) { $errors[] = "Jaringan bioskop wajib diisi."; }
    if (empty($formatProyeksi)) { $errors[] = "Format proyeksi wajib diisi."; }

    if (empty($errors)) {
        $poster_path = '';
        if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "./images/";
            if (!is_dir($target_dir)) { mkdir($target_dir, 0755, true); }
            $file_extension = strtolower(pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION));
            $safe_filename = bin2hex(random_bytes(16)) . '.' . $file_extension;
            $target_file = $target_dir . $safe_filename;
            if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
                $poster_path = $target_file;
            } else {
                $errors[] = "Gagal memindahkan file poster yang diunggah.";
            }
        } else {
            $errors[] = "Poster film wajib diunggah.";
        }

        if (empty($errors)) {
            $film_baru = new FilmLayarLebar($idMedia, $judul, $tahunRilis, $genre, $sutradara, $ratingUsia, $hargaTiket, $jaringanBioskop, $formatProyeksi, $poster_path);
            $_SESSION['daftarFilm'][] = $film_baru;
            $message = "✅ Data film layar lebar berhasil ditambahkan!";
            $message_type = 'success';
        }
    }
    if (!empty($errors)) {
        $message = implode("<br>", $errors);
        $message_type = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Database Film Layar Lebar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-bg: #0f172a;
            --color-card: #1e293b;
            --color-primary: #8b5cf6;
            --color-primary-hover: #7c3aed;
            --color-text: #f8fafc;
            --color-muted: #94a3b8;
            --color-border: #334155;
            --color-success: #10b981;
            --color-error: #ef4444;
            --font-family: 'Poppins', sans-serif;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--color-bg);
            color: var(--color-text);
            padding: 2.5rem 1.5rem;
            display: flex;
            justify-content: center;
        }

        .main-container {
            width: 100%;
            max-width: 1300px;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
            padding: 2.5rem;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(to right, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.25rem;
        }

        h1 + p {
            text-align: center;
            color: var(--color-muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
        }

        h2 {
            font-size: 1.25rem;
            color: var(--color-text);
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .message {
            padding: 0.85rem 1.25rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .message.success {
            background-color: rgba(16, 185, 129, 0.15);
            border: 1px solid var(--color-success);
            color: var(--color-success);
        }
        .message.error {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid var(--color-error);
            color: var(--color-error);
        }

        .form-container {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--color-border);
            padding: 1.75rem;
            border-radius: 12px;
            margin-bottom: 3rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group label {
            margin-bottom: 0.4rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--color-muted);
        }

        .input-group input {
            padding: 0.65rem 0.9rem;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 6px;
            color: var(--color-text);
            font-family: var(--font-family);
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.25);
        }

        .btn {
            grid-column: 1 / -1;
            padding: 0.85rem;
            border-radius: 6px;
            border: none;
            background: var(--color-primary);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }

        .btn:hover {
            background: var(--color-primary-hover);
        }

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--color-border);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.875rem;
        }

        thead {
            background-color: rgba(15, 23, 42, 0.8);
        }

        th {
            padding: 0.85rem 1rem;
            font-weight: 600;
            color: var(--color-muted);
            border-bottom: 1px solid var(--color-border);
            white-space: nowrap;
        }

        td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-text);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .product-image {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--color-border);
        }

        .reset-container {
            text-align: right;
            margin-top: 2rem;
        }

        .btn-reset {
            background: transparent;
            color: var(--color-error);
            border: 1px solid var(--color-error);
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            background: var(--color-error);
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .reset-container { text-align: center; }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>🎬 Manajemen Database Film Layar Lebar</h1>
        <p>Kelola data katalog film bioskop secara dinamis.</p>

        <?php if (!empty($message)): ?>
            <div class="message <?= htmlspecialchars($message_type); ?>">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <h2>✨ Tambah Data Film Baru</h2>
            <form action="Main.php" method="POST" enctype="multipart/form-data" class="form-grid">
                <div class="input-group"><label for="idMedia">ID Film</label><input type="text" id="idMedia" name="idMedia" required></div>
                <div class="input-group"><label for="judul">Judul Film</label><input type="text" id="judul" name="judul" required></div>
                <div class="input-group"><label for="tahunRilis">Tahun Rilis</label><input type="number" id="tahunRilis" name="tahunRilis" min="1800" required></div>
                <div class="input-group"><label for="genre">Genre Film</label><input type="text" id="genre" name="genre" required></div>
                <div class="input-group"><label for="sutradara">Sutradara</label><input type="text" id="sutradara" name="sutradara" required></div>
                <div class="input-group"><label for="ratingUsia">Rating Usia</label><input type="text" id="ratingUsia" name="ratingUsia" placeholder="SU / 13+ / 17+" required></div>
                <div class="input-group"><label for="hargaTiket">Harga Tiket (Rp)</label><input type="number" id="hargaTiket" name="hargaTiket" min="1" required></div>
                <div class="input-group"><label for="jaringanBioskop">Jaringan Bioskop</label><input type="text" id="jaringanBioskop" name="jaringanBioskop" placeholder="XXI / CGV / Cinepolis" required></div>
                <div class="input-group"><label for="formatProyeksi">Format Proyeksi</label><input type="text" id="formatProyeksi" name="formatProyeksi" placeholder="Digital 2D / IMAX 3D" required></div>
                <div class="input-group"><label for="poster">Poster Film</label><input type="file" id="poster" name="poster" accept="image/*" required></div>
                <button type="submit" name="tambah" class="btn">➕ Tambah Film</button>
            </form>
        </div>

        <div class="table-container">
            <h2>📊 Katalog Film Bioskop</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th>ID</th>
                            <th>Judul Film</th>
                            <th>Tahun</th>
                            <th>Genre</th>
                            <th>Sutradara</th>
                            <th>Rating Usia</th>
                            <th>Harga Tiket</th>
                            <th>Bioskop</th>
                            <th>Format Proyeksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($_SESSION['daftarFilm'])): ?>
                            <tr>
                                <td colspan="10" style="text-align:center; padding: 2rem; color: var(--color-muted);">Belum ada data film. Silakan tambahkan data melalui form di atas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($_SESSION['daftarFilm'] as $film): ?>
                                <?php if (is_object($film) && method_exists($film, 'getJudul')): ?>
                                <tr>
                                    <td>
                                        <?php if ($film->getPoster() && file_exists($film->getPoster())): ?>
                                            <img src="<?= htmlspecialchars($film->getPoster()); ?>" alt="<?= htmlspecialchars($film->getJudul()); ?>" class="product-image">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($film->getIdMedia()); ?></td>
                                    <td><strong><?= htmlspecialchars($film->getJudul()); ?></strong></td>
                                    <td><?= htmlspecialchars((string)$film->getTahunRilis()); ?></td>
                                    <td><?= htmlspecialchars($film->getGenre()); ?></td>
                                    <td><?= htmlspecialchars($film->getSutradara()); ?></td>
                                    <td><?= htmlspecialchars($film->getRatingUsia()); ?></td>
                                    <td>Rp <?= htmlspecialchars(number_format($film->getHargaTiket(), 0, ',', '.')); ?></td>
                                    <td><?= htmlspecialchars($film->getJaringanBioskop()); ?></td>
                                    <td><?= htmlspecialchars($film->getFormatProyeksi()); ?></td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="reset-container">
            <form action="Main.php" method="POST">
                <button type="submit" name="reset_data" class="btn-reset" onclick="return confirm('Anda yakin ingin menghapus semua data? Tindakan ini tidak dapat dibatalkan.');">
                    🗑️ Hapus Semua Data
                </button>
            </form>
        </div>

    </div>
</body>
</html>