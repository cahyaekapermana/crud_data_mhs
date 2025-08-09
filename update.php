<?php
require_once 'config.php';
// untuk alert harus pakai session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

    <!-- Proses Update -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id  = $_POST['id'];
        $nim  = $_POST['nim'];
        $nama = $_POST['nama'];
        $jurusan = $_POST['jurusan'];
        $tahun_masuk = $_POST['tahun_masuk'];

        $pdo->prepare("UPDATE daftar_mhs SET nim=?, nama=?, jurusan=?, tahun_masuk=? WHERE id=?")
            ->execute([$nim, $nama, $jurusan, $tahun_masuk, $id]);

        // Otomatis kembali ke halaman awal saat selesai input dan ada alert kalau data berhasil ditambah
        $_SESSION['update'] = "Data berhasil diperbarui!";
        header("Location: index.php");
        exit;
    }

    // --- AMBIL DATA BERDASARKAN ID ---
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("ID tidak ditemukan!");
    }

    // Get Data dari table id 
    $stmt = $pdo->prepare("SELECT * FROM daftar_mhs WHERE id=?");
    $stmt->execute([$id]);

    $mhs = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mhs) {
        die("Data tidak ditemukan!");
    }

    ?>

</head>

<body>
    <h1>Edit Data Mahasiswa</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($mhs['id']) ?>">

        <label>NIM:</label><br>
        <input type="text" name="nim" value="<?= htmlspecialchars($mhs['nim']) ?>" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($mhs['nama']) ?>" required><br><br>

        <label>Jurusan:</label><br>
        <input type="text" name="jurusan" value="<?= htmlspecialchars($mhs['jurusan']) ?>" required><br><br>

        <label>Tahun Masuk:</label><br>
        <input type="number" name="tahun_masuk" value="<?= htmlspecialchars($mhs['tahun_masuk']) ?>" required><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="index.php">← Kembali</a>


</body>

</html>