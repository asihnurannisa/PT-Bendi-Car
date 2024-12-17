<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil data booking dengan nama penyewa
$query = "SELECT booking.*, kendaraan.merk, kendaraan.no_pol, penyewa.nama AS nama_penyewa
          FROM booking
          JOIN kendaraan ON booking.id_kendaraan = kendaraan.id_kendaraan
          JOIN penyewa ON booking.id_penyewa = penyewa.id_penyewa
          ORDER BY booking.id_booking DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking Penyewa</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        table {
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #ddd; 
            padding: 10px; 
            text-align: center;
        }
        table th {
            background-color:#4e0324; 
            color: #fff;
        }
        img {
            width: 80px; 
            height: auto; 
            border-radius: 8px;
        }
        button {
            padding: 5px 10px; 
            color: #fff; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
<header>
    <div class="judul">PT Bendi Car</div>

<nav>
    <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="tambah_kendaraan.php">Tambah Kendaraan</a></li>
        <li><a href="list_kendaraan.php">list Kendaraan</a></li>
        <li><a href="list_booking.php">Hasil Booking</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav></header>
        <h2>Daftar Booking Penyewa</h2>
       <center> <table>
            <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Merk Kendaraan</th>
                <th>Plat Nomor</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Total Harga</th>
            </tr>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_penyewa'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['merk'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['no_pol'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['tanggal_mulai'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($row['tanggal_selesai'] ?? ''); ?></td>
                <td>Rp <?php echo number_format($row['total_harga'] ?? 0, 0, ',', '.'); ?></td>
                
                
            </tr>
            <?php endwhile; ?>
        </table></center> <br><br><?php include 'footer.php'; ?>
    </div>
    
</body>
</html>
