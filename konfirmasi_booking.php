<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id_penyewa = $_SESSION['id_penyewa'];

// Ambil data booking dari database
$queryBooking = "SELECT b.*, k.merk FROM booking b 
                 JOIN kendaraan k ON b.id_kendaraan = k.id_kendaraan 
                 WHERE b.id_penyewa = ? ORDER BY b.created_at DESC";

$stmt = $koneksi->prepare($queryBooking);
$stmt->bind_param("i", $id_penyewa);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    
<div class="container">
<header>
        <div class="navbar">
        <div class="judul">PT Bendi Car</div>
            <nav>
                <ul>
                <li><a href="dashboard.php">Home</a></li>
                    <li><a href="mobil.php">Daftar Mobil</a></li>
                    <li><a href="booking.php">Booking</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <center>
        <h2>Konfirmasi Booking</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kendaraan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    <?php $no = 1; while ($booking = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $booking['merk'] ?></td>
            <td><?= $booking['tanggal_mulai'] ?></td>
            <td><?= $booking['tanggal_selesai'] ?></td>
            <td>Rp<?= number_format($booking['total_harga'], 0, ',', '.') ?></td>
            <td><?= $booking['status'] ?></td>
        </tr>
    <?php } ?>
</tbody>


        </table>
    </div>
    </center>
    <?php include 'footer.php'; ?>
</body>
</html>
