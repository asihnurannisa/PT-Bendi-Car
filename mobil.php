<?php
include 'koneksi.php';
$query = "SELECT * FROM kendaraan";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil - PT Bendi Car</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <style>
       

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-body h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }

        .card-body p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .card-body a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color:rgb(69, 1, 28);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .card-body a:hover {
            background-color:rgb(167, 105, 132);
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            margin-top: 20px;
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

    <h2 style="text-align: center; margin-top: 20px;">Daftar Kendaraan</h2>

    <div class="card-grid">
        <?php 
        while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="card">
            <img src="uploads/<?php echo $row['gambar']; ?>" alt="Gambar Kendaraan">
            <div class="card-body">
                <h3><?php echo $row['merk']; ?></h3>
                <p>Plat Nomor: <?php echo $row['no_pol']; ?></p>
                <p>Harga Sewa: Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                <p>Jenis: <?php echo $row['jenis']; ?></p>
                <a href="detail_mobil.php?id=<?php echo $row['id_kendaraan']; ?>">Detail</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <br><br><?php include 'footer.php'; ?>
</div>



</body>
</html>