<?php
try {
  $pdo = new PDO("pgsql:host=localhost;dbname=db_mahasiswa", "postgres", "1234");
  // untuk test apakah sudah konek atau belum. Kalau belum setting dulu di xampp -> php
  // Aktifkan extension=pdo_pgsql dan extension=pgsql untuk postgreeSQL di folder php -> php.ini
  // echo "Koneksi berhasil!";
} catch (PDOException $e) {
  echo "Koneksi gagal: " . $e->getMessage();
}
