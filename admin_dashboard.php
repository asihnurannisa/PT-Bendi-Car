<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
   
</head>
<style>
    h2 {
    text-align: center;
    color:rgb(47, 4, 19);
    font-size: 28px;
    margin-top: 30px;
}

/* Dashboard Info Section */
.dashboard-info {
    display: flex;
    justify-content: space-around;
    margin-top: 40px;
}

.info-box {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 200px;
    text-align: center;
}

.info-box h3 {
    font-size: 18px;
    color:rgb(47, 1, 9);
    margin-bottom: 10px;
}

.info-box p {
    font-size: 24px;
    color: #333;
    font-weight: bold;
}
</style>
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

        <div class="content">
            <h2>Selamat Datang di Dashboard Admin</h2>
            <p>Kelola data kendaraan dan transaksi dengan mudah melalui panel ini.</p>

            <div class="dashboard-info">
                <div class="info-box">
                    <h3>Total Kendaraan</h3>
                    <p>15</p>
                </div>
                <div class="info-box">
                    <h3>Total Transaksi</h3>
                    <p>27</p>
                </div>
                <div class="info-box">
                    <h3>Transaksi Pending</h3>
                    <p>5</p>
                </div>
                <div class="info-box">
                    <h3>Admin Aktif</h3>
                    <p>3</p>
                </div>
            </div>
        </div>
        <br><br><?php include 'footer.php'; ?>
    </div>
   
</body>
</html>
