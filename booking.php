<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil data kendaraan dari database
$queryKendaraan = "SELECT * FROM kendaraan";
$resultKendaraan = mysqli_query($koneksi, $queryKendaraan);
if (!$resultKendaraan) {
    die("Query gagal: " . mysqli_error($koneksi));
}

if (isset($_POST['booking'])) {
    $id_kendaraan = $_POST['id_kendaraan'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Mengambil harga kendaraan dari database
    $queryHarga = "SELECT harga FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
    $resultHarga = mysqli_query($koneksi, $queryHarga);
    if (!$resultHarga) {
        die("Query gagal: " . mysqli_error($koneksi));
    }
    $kendaraan = mysqli_fetch_assoc($resultHarga);
    $harga_per_hari = $kendaraan['harga'];

    // Menghitung total harga
    $tglMulai = new DateTime($tanggal_mulai);
    $tglSelesai = new DateTime($tanggal_selesai);

    // Validasi tanggal selesai lebih besar dari tanggal mulai
    if ($tglSelesai < $tglMulai) {
        die("Tanggal selesai tidak boleh lebih awal dari tanggal mulai.");
    }

    $selisih = $tglMulai->diff($tglSelesai)->days;
    $total_harga = $selisih * $harga_per_hari;

    // Insert data booking ke database
    $queryBooking = "INSERT INTO booking (id_kendaraan, tanggal_mulai, tanggal_selesai, metode_pembayaran, total_harga)
                     VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $queryBooking);
    if ($stmt === false) {
        die("Gagal mempersiapkan query: " . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "isssi", $id_kendaraan, $tanggal_mulai, $tanggal_selesai, $metode_pembayaran, $total_harga);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect ke halaman konfirmasi atau dashboard
    header("Location: konfirmasi_booking.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kendaraan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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

    <center><style>
        /* Styling untuk judul */
.center h2 {
    font-size: 2rem;
    color: #333;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Styling untuk form */
form {
    background-color: #f9f9f9;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 600px;
    height: 800px;
    margin: 0 auto;
}

/* Styling untuk label dan input fields */
label {
    font-size: 1.1rem;
    color: #555;
    display: block;
    margin-bottom: 10px;
}

input[type="date"],
select {
    width: 100%;
    padding: 12px;
    margin: 10px 0 20px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    box-sizing: border-box;
    background-color: #fff;
}

select:focus, 
input[type="date"]:focus {
    border-color:rgb(66, 5, 27);
    outline: none;
}

/* Styling untuk button */
button {
    background-color:rgb(66, 5, 27);
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color:rgb(143, 68, 86);
}

/* Styling untuk responsive design */
@media (max-width: 768px) {
    form {
        width: 100%;
        padding: 20px;
    }

    h2 {
        font-size: 1.5rem;
    }

    button {
        padding: 10px 18px;
    }
}

    </style><br><br>
        <h2>Booking Kendaraan</h2><br><br>
        <form action="proses_booking.php" method="post">
            <label for="id_kendaraan">Pilih Kendaraan:</label>
            <select name="id_kendaraan" required>
                <option value="">-- Pilih Kendaraan --</option>
                <?php while ($kendaraan = mysqli_fetch_assoc($resultKendaraan)) { ?>
                    <option value="<?= $kendaraan['id_kendaraan'] ?>">
                        <?= $kendaraan['merk'] ?> - Rp<?= number_format($kendaraan['harga'], 0, ',', '.') ?>/hari
                    </option>
                <?php } ?>
            </select><br>
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" name="tanggal_mulai" required><br>
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" name="tanggal_selesai" required><br>
            
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select name="metode_pembayaran" required>
                <option value="">-- Pilih Metode Pembayaran --</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="Kartu Kredit">Kartu Kredit</option>
                <option value="Tunai">Tunai</option>
            </select><br>
            <button type="submit" name="booking">Booking</button>

        </form></center>
        <br><br><br><br><br><br>
<?php include 'footer.php'; ?>
    </div>
    
    
</body>
</html>
