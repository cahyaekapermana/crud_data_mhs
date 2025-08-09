<?php
require_once 'config.php';
// untuk alert harus pakai session

session_start();


$id = $_GET['id'];

$sql = "DELETE FROM daftar_mhs WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
$_SESSION['success'] = "Data berhasil dihapus!";

exit;
