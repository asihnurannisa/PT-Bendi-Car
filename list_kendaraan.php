<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Proses Hapus Kendaraan
if (isset($_GET['hapus'])) {
    $id_kendaraan = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query_delete = "DELETE FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
    $result_delete = mysqli_query($koneksi, $query_delete);

    if ($result_delete) {
        // Redirect setelah hapus
        header("Location: list_kendaraan.php?status=deleted");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data kendaraan!');</script>";
    }
}

// Ambil data kendaraan untuk ditampilkan di tabel
$query = "SELECT * FROM kendaraan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kendaraan</title>
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
        .edit-btn { background-color:rgb(205, 119, 146); }
        .delete-btn { background-color:rgb(161, 56, 91); }
        a { color: white; text-decoration: none; }
        .action-btns { display: flex; gap: 5px; justify-content: center; }
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
        <h2>Daftar Kendaraan</h2>

        <!-- Notifikasi -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
            <p style="color: green; text-align: center;">Data kendaraan berhasil dihapus!</p>
        <?php endif; ?>

        <table>
            <tr>
                <th>No</th>
                <th>Merk</th>
                <th>Plat Nomor</th>
                <th>Harga Sewa</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['merk']; ?></td>
                <td><?php echo $row['no_pol']; ?></td>
                <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $row['jenis']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <img src="uploads/<?php echo $row['gambar']; ?>" alt="Gambar Kendaraan">
                </td>
                <td class="action-btns">
                    <!-- Tombol Edit -->
                    <button class="edit-btn">
                        <a href="edit_kendaraan.php?id=<?php echo $row['id_kendaraan']; ?>">Edit</a>
                    </button>
                    <!-- Tombol Hapus -->
                    <button class="delete-btn" onclick="confirmHapus(<?php echo $row['id_kendaraan']; ?>)">
                        Hapus
                    </button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <br><br><?php include 'footer.php'; ?>
    </div>

    <script>
        function confirmHapus(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "list_kendaraan.php?hapus=" + id;
            }
        }
    </script>
    
</body>
</html>
