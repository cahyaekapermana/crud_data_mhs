<!-- Koneksikan ke config untuk singkron di db -->
<?php
require_once 'config.php';
// untuk alert harus pakai session
session_start();
$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);

$hapus = $_SESSION['hapus'] ?? null;
unset($_SESSION['hapus']);

$update = $_SESSION['update'] ?? null;
unset($_SESSION['update']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <!-- Session Cek jika sudah sukses input data -->
    <?php if ($success): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <!-- Session hapus data  -->
    <?php if ($hapus): ?>
        <p style="color: red;"><?= htmlspecialchars($hapus) ?></p>
    <?php endif; ?>
    <!-- Session update data  -->
    <?php if ($update): ?>
        <p style="color: blue;"><?= htmlspecialchars($update) ?></p>
    <?php endif; ?>
</head>

<body>
    <a href="create.php"> Tambah Mhs</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Tahun Masuk</th>
            <th>Recently Add</th>
            <th>Aksi</th>

        </tr>

        <?php
        // Sebagai nomer pengganti id jd agar urut tidak ikut di table
        $no = 1; // mulai dari 1

        foreach ($pdo->query("SELECT * FROM daftar_mhs ORDER BY id ASC") as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['tahun_masuk'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>