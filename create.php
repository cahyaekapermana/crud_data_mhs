<!-- Koneksikan ke config untuk singkron di db -->
<?php
require_once 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>
</head>

<body>
    <!-- Integrasi GUI ke DB saat add data -->
    <!-- Proses Input -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nim  = $_POST['nim'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $tahun_masuk = $_POST['tahun_masuk'];

        $pdo->prepare("INSERT INTO daftar_mhs (nim, nama, jurusan, tahun_masuk) VALUES (?, ?, ?, ?)")
            ->execute([$nim, $nama, $jurusan, $tahun_masuk]);

        // Otomatis kembali ke halaman awal saat selesai input dan ada alert kalau data berhasil ditambah
        $_SESSION['success'] = "Data berhasil ditambahkan!";
        header("Location: index.php");
        exit;
    }
    ?>

    <h2>Tambah Mhs Baru</h2>
    <form method="POST">
        Nim: <input type="number" name="nim" required><br>
        Nama: <input type="text" name="nama"><br>
        Jurusan: <input type="text" name="jurusan"><br>
        Tahun Masuk : <input type="number" name="tahun_masuk"><br>
        <button type="submit" href="index.php">Simpan</button>
    </form>
    <a href="index.php">← Kembali</a>

    <!-- PR INPUT DATA COBA KALAU DATANYA ADA YG SAMA JD TIDAK BISA INPUT! -->
    <!-- PR SAAT SUDAH TAMBAH DATA, ADA ALERT DATA BERHASIL DITAMBAH -->
</body>

</html>