<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PT Bendi Car</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Container Utama -->
    <div class="container">
        <!-- Header -->
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

        <!-- Carousel -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
            </div>

            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slide1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption">
                        <h2>Sewa Mobil Kantor</h2>
                        <p>Ga Pernah Selengkap Ini</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slide2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption">
                        <h2>Armada Terlengkap</h2>
                        <p>Banyak pilihan sesuai kebutuhan Anda</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slide3.jpg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption">
                        <h2>Layanan 24 Jam</h2>
                        <p>Tim siap membantu kapan saja</p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div><br>

        <!-- Hero Section -->
        <div id="home" class="hero-section text-center">
            <h2>Jelajahi Dunia dengan Kendaraan Impian Anda!</h2>
            <p>Kami siap memberikan layanan terbaik untuk perjalanan Anda.</p>
            
        </div>


        <!-- Keunggulan Section -->
        <section id="keunggulan" class="keunggulan-section text-center">
            <h2>Mengapa Memilih PT Bendi Car?</h2>
            <div class="keunggulan-grid d-flex justify-content-center">
                <div class="keunggulan-item p-3">
                    <h3>Armada Terbaru</h3>
                    <p>Semua kendaraan kami dalam kondisi prima dan siap digunakan.</p>
                </div>
                <div class="keunggulan-item p-3">
                    <h3>Harga Transparan</h3>
                    <p>Tidak ada biaya tersembunyi, Anda hanya membayar sesuai kesepakatan.</p>
                </div>
                <div class="keunggulan-item p-3">
                    <h3>Layanan 24/7</h3>
                    <p>Kami selalu tersedia kapan pun Anda membutuhkan bantuan.</p>
                </div>
            </div>
        </section>

        <h1>Apa itu Bendi Car?</h1>
        <div class="content">
            <!-- Bagian Teks -->
            <div class="text">
                <h2>Sewa Mobil Mudah & Terpercaya</h2>
                <p>
                    Bendi Car adalah layanan penyewaan mobil yang siap memenuhi kebutuhan perjalanan Anda. 
                    Dengan armada lengkap, harga terjangkau, dan pelayanan 24 jam, Bendi Car hadir untuk memudahkan perjalanan 
                    bisnis, liburan keluarga, maupun acara spesial Anda.
                </p>
                <p>
                    Kami menyediakan berbagai jenis kendaraan mulai dari city car, SUV, hingga kendaraan mewah dengan opsi 
                    pengemudi profesional atau lepas kunci. Jelajahi dunia dengan kendaraan impian Anda hanya bersama Bendi Car!
                </p>
            </div>

            <!-- Bagian Video -->
            <div class="video">
                <video controls>
                    <source src="video/bendi-car.mp4" type="video/mp4">
                    Browser Anda tidak mendukung elemen video.
                </video>
            </div>
        </div>
        <section id="promo" class="promo-section text-center">
            <h2>Promo Hebat untuk Setiap Petualangan Anda!</h2>
            <ul>
                <li><strong>Diskon 20%</strong> untuk pemesanan lebih dari 3 hari.</li>
                <li><strong>Free Driver</strong> untuk pemesanan di akhir pekan.</li>
                <li><strong>Cashback</strong> hingga Rp 200.000 untuk pelanggan baru.</li>
            </ul>
        </section>
        <center><a href="mobil.php" class="btn-cta">Pilih Mobil</a></center>
        <!-- Grid Foto -->
        <div class="grid-foto">
            <?php
            // Ambil data mobil dari database
            $query = "SELECT merk, gambar FROM kendaraan";
            $result = mysqli_query($koneksi, $query);

            // Looping untuk menampilkan data
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="grid-item text-center p-3">
                    <img src="uploads/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['merk']) . '" class="img-fluid">
                    <p>' . htmlspecialchars($row['merk']) . '</p>
                </div>';
            }
            ?>
        </div><br><br><br>
        
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
