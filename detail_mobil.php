<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM kendaraan WHERE id_kendaraan = $id";
$result = mysqli_query($koneksi, $query);
$mobil = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - <?php echo $mobil['merk']; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
      

        .detail-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
            padding: 20px;
            display: flex;
            gap: 20px;
        }

        .detail-card img {
            width: 300px;
            height: auto;
            border-radius: 10px;
        }

        .detail-info {
            flex-grow: 1;
        }

        .detail-info h2 {
            margin: 0;
            color: #333;
        }

        .detail-info p {
            margin: 10px 0;
            color: #666;
        }

        .btn-sewa {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color:rgb(54, 2, 14);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-sewa:hover {
            background-color:rgb(139, 83, 105);
        }

       
    </style>
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

    <div class="detail-card">
        <img src="uploads/<?php echo $mobil['gambar']; ?>" alt="Gambar Mobil">
        <div class="detail-info">
            <h2><?php echo $mobil['merk']; ?></h2>
            <p><strong>Plat Nomor:</strong> <?php echo $mobil['no_pol']; ?></p>
            <p><strong>Harga Sewa:</strong> Rp <?php echo number_format($mobil['harga'], 0, ',', '.'); ?></p>
            <p><strong>Jenis:</strong> <?php echo $mobil['jenis']; ?></p>
            <p><strong>Kelebihan:</strong> Mobil ini dilengkapi dengan AC dingin, konsumsi bahan bakar irit, dan kabin yang luas sehingga cocok untuk perjalanan keluarga maupun bisnis.</p>
            <a href="booking.php?id=<?php echo $mobil['id_kendaraan']; ?>" class="btn-sewa">Sewa Sekarang</a>
        </div>
    </div>
    <br><br>
<?php include 'footer.php'; ?>
</div>


</body>
</html>
