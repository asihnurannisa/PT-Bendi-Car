<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil ID kendaraan dari URL
if (!isset($_GET['id'])) {
    header("Location: list_kendaraan.php");
    exit();
}

$id_kendaraan = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data kendaraan berdasarkan ID
$query = "SELECT * FROM kendaraan WHERE id_kendaraan = '$id_kendaraan'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='list_kendaraan.php';</script>";
    exit();
}

// Proses Update Data Kendaraan
if (isset($_POST['update'])) {
    $merk = mysqli_real_escape_string($koneksi, $_POST['merk']);
    $no_pol = mysqli_real_escape_string($koneksi, $_POST['no_pol']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Upload gambar jika ada
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = time() . '_' . basename($_FILES['gambar']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $gambar;

        // Cek direktori uploads
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Validasi upload file
        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                // Hapus gambar lama jika ada
                if ($data['gambar'] && file_exists($target_dir . $data['gambar'])) {
                    unlink($target_dir . $data['gambar']);
                }

                // Query update dengan gambar baru
                $query_update = "UPDATE kendaraan SET 
                    merk = '$merk', 
                    no_pol = '$no_pol', 
                    harga = '$harga', 
                    jenis = '$jenis', 
                    status = '$status', 
                    gambar = '$gambar' 
                    WHERE id_kendaraan = '$id_kendaraan'";
            } else {
                echo "<script>alert('Gagal mengupload gambar!');</script>";
                exit();
            }
        } else {
            echo "<script>alert('Error saat upload gambar: " . $_FILES['gambar']['error'] . "');</script>";
            exit();
        }
    } else {
        // Query update tanpa gambar
        $query_update = "UPDATE kendaraan SET 
            merk = '$merk', 
            no_pol = '$no_pol', 
            harga = '$harga', 
            jenis = '$jenis', 
            status = '$status' 
            WHERE id_kendaraan = '$id_kendaraan'";
    }

    // Eksekusi query update
    $result_update = mysqli_query($koneksi, $query_update);

    if ($result_update) {
        echo "<script>alert('Data kendaraan berhasil diperbarui!'); window.location='list_kendaraan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data kendaraan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Edit Data Kendaraan</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="merk">Merk Kendaraan</label>
                <input type="text" name="merk" id="merk" value="<?php echo htmlspecialchars($data['merk']); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_pol">Plat Nomor</label>
                <input type="text" name="no_pol" id="no_pol" value="<?php echo htmlspecialchars($data['no_pol']); ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga Sewa</label>
                <input type="number" name="harga" id="harga" value="<?php echo htmlspecialchars($data['harga']); ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis">Jenis Kendaraan</label>
                <input type="text" name="jenis" id="jenis" value="<?php echo htmlspecialchars($data['jenis']); ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="Tersedia" <?php if ($data['status'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                    <option value="Tidak Tersedia" <?php if ($data['status'] == 'Tidak Tersedia') echo 'selected'; ?>>Tidak Tersedia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Kendaraan</label>
                <?php if ($data['gambar']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($data['gambar']); ?>" alt="Gambar Kendaraan" width="150">
                <?php endif; ?>
                <input type="file" name="gambar" id="gambar" accept="image/*">
            </div>
            <button type="submit" name="update">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
