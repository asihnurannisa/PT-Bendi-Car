<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi sudah benar

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Jika tombol tambah ditekan
if (isset($_POST['tambah'])) {
    $merk = $_POST['merk'];
    $no_pol = $_POST['no_pol'];
    $harga = $_POST['harga'];
    $jenis = $_POST['jenis'];
    $status = $_POST['status'];

    // Cek apakah file gambar di-upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
    } else {
        $gambar = NULL; // Jika tidak ada gambar yang di-upload
    }

    // Validasi input kosong
    if (empty($merk) || empty($no_pol) || empty($harga) || empty($jenis) || empty($status)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        // Query untuk menambahkan data kendaraan dengan prepared statement
        $stmt = $koneksi->prepare("INSERT INTO kendaraan (merk, no_pol, harga, jenis, status, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $merk, $no_pol, $harga, $jenis, $status, $gambar);

        if ($stmt->execute()) {
            echo "<script>alert('Data kendaraan berhasil ditambahkan!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            $error = "Gagal menambahkan data: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan</title>
    <link rel="stylesheet" href="style1.css">
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
    <center>
        <h2>Tambah Data Kendaraan</h2>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="merk">Merk Kendaraan:</label>
            <input type="text" name="merk" id="merk" required>

            <label for="no_pol">Plat Nomor:</label>
            <input type="text" name="no_pol" id="no_pol" required>

            <label for="harga">Harga Sewa:</label>
            <input type="number" name="harga" id="harga" required>

            <label for="jenis">Jenis Kendaraan:</label>
            <input type="text" name="jenis" id="jenis" required>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>

            <label for="gambar">Gambar Kendaraan:</label>
            <input type="file" name="gambar" id="gambar" accept="image/*"><br><br>

            <button type="submit" name="tambah">Tambah Kendaraan</button>
            <a href="admin_dashboard.php">Kembali ke Dashboard</a>
        </form>
    </center>
    <br><br><?php include 'footer.php'; ?>
</div>

</body>
</html>
