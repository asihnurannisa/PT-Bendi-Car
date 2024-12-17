<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Cek apakah ID kendaraan diterima
if (isset($_GET['id'])) {
    $id_kendaraan = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil informasi gambar untuk dihapus dari folder
    $query_gambar = "SELECT gambar FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
    $result_gambar = mysqli_query($koneksi, $query_gambar);
    $data_gambar = mysqli_fetch_assoc($result_gambar);

    if ($data_gambar && !empty($data_gambar['gambar'])) {
        $file_path = "uploads/" . $data_gambar['gambar'];
        if (file_exists($file_path)) {
            unlink($file_path); // Hapus file gambar
        }
    }

    // Query hapus data kendaraan
    $query_delete = "DELETE FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
    $result_delete = mysqli_query($koneksi, $query_delete);

    if ($result_delete) {
        echo "<script>alert('Data kendaraan berhasil dihapus!'); window.location.href='list_kendaraan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data kendaraan!'); window.location.href='list_kendaraan.php';</script>";
    }
} else {
    header("Location: list_kendaraan.php");
    exit();
}
?>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
