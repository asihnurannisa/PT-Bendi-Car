<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['booking'])) {
    $id_penyewa = $_SESSION['id_penyewa'];
    $id_kendaraan = $_POST['id_kendaraan'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];

    // Hitung total hari
    $date1 = new DateTime($tanggal_mulai);
    $date2 = new DateTime($tanggal_selesai);
    $interval = $date1->diff($date2);
    $total_hari = $interval->days + 1; // Menambahkan 1 karena termasuk hari pertama


    // Ambil harga sewa kendaraan
    $queryKendaraan = "SELECT harga FROM kendaraan WHERE id_kendaraan = ?";
    $stmt = $koneksi->prepare($queryKendaraan);
    $stmt->bind_param("i", $id_kendaraan);
    $stmt->execute();
    $resultKendaraan = $stmt->get_result();
    $kendaraan = $resultKendaraan->fetch_assoc();
    $harga_sewa = $kendaraan['harga'];
    var_dump($harga);


    // Hitung total harga
    $total_harga = $total_hari * $harga_sewa;

    // Simpan data booking ke database
    $queryBooking = "INSERT INTO booking (id_penyewa, id_kendaraan, tanggal_mulai, tanggal_selesai, total_harga) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($queryBooking);
    $stmt->bind_param("iissd", $id_penyewa, $id_kendaraan, $tanggal_mulai, $tanggal_selesai, $total_harga);

    if ($stmt->execute()) {
        echo "<script>
                alert('Booking berhasil! Total harga: Rp$total_harga');
                window.location.href = 'konfirmasi_booking.php';
              </script>";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}
?>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">