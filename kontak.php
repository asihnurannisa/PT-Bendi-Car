<?php
session_start();
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
    <title>Kontak PT Bendi Car</title>
    <link rel="stylesheet" href="style.css">
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
<style>
    /* Styling untuk bagian Tentang Kami dan Hubungi Kami */
h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 15px;
    font-family: 'Quicksand', sans-serif;
    text-align: center;
    border-bottom: 2px solid #5D4037;
    padding-bottom: 10px;
    width: 60%;
    margin: 20px auto;
}

p {
    font-size: 1rem;
    line-height: 1.6;
    color: #555;
    margin-bottom: 15px;
    font-family: 'Quicksand', sans-serif;
    text-align: justify;
    width: 80%;
    margin: 10px auto;
}

ul {
    list-style-type: none;
    padding-left: 0;
    margin-bottom: 20px;
}

ul li {
    font-size: 1rem;
    line-height: 1.6;
    color: #555;
    margin: 10px 0;
}

ul li strong {
    font-weight: bold;
    color: #333;
}

a {
    color: #5D4037;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsiveness */
@media (max-width: 768px) {
    h2 {
        font-size: 1.5rem;
        width: 90%;
    }

    p {
        font-size: 0.95rem;
        width: 90%;
    }

    ul li {
        font-size: 0.95rem;
    }
}

</style><b>
<h2>Tentang PT Bendi Car</h2>
<p>PT Bendi Car adalah perusahaan rental mobil terpercaya yang telah beroperasi sejak tahun 2024. Kami menyediakan berbagai jenis kendaraan untuk memenuhi berbagai kebutuhan pelanggan, mulai dari mobil pribadi hingga mobil bisnis yang siap pakai dengan harga terjangkau.</p>
<p>Kami berkomitmen untuk memberikan pelayanan terbaik dengan selalu menjaga kondisi kendaraan agar selalu siap digunakan. Kami juga memastikan bahwa setiap pelanggan kami merasakan kenyamanan dan kepuasan selama menggunakan layanan kami.</p>
<p>Visi kami adalah menjadi penyedia layanan rental kendaraan terbaik di Indonesia, memberikan kenyamanan dan kemudahan akses bagi semua pelanggan. Misi kami adalah memberikan pelayanan yang cepat, efisien, dan selalu memprioritaskan keamanan serta kenyamanan pelanggan kami.</p>

<h2>Hubungi Kami</h2>
<p>Jika Anda memiliki pertanyaan lebih lanjut atau ingin melakukan booking, Anda bisa menghubungi kami melalui saluran berikut:</p>
<ul>
    <li>📞 <strong>Telepon</strong>: 0812-3456-7890</li>
    <li>📧 <strong>Email</strong>: ptbendicar@gmail.com</li>
    <li>🏢 <strong>Alamat</strong>: Jl. Gang senen No. 24, Lampung</li>
    <li>🌐 <strong>Website</strong>: <a href="#">www.ptbendicar.com</a></li>
</ul>
<p>Jangan ragu untuk menghubungi kami kapan saja. Tim kami siap melayani Anda dengan sepenuh hati!</p>
<br><br><br></b>
<?php include 'footer.php'; ?>
    </div>
   
</body>
</html>
