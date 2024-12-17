<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash password

    // Cek apakah username sudah digunakan
    $query = "SELECT * FROM penyewa WHERE username = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color: red; text-align: center;'>Username sudah digunakan! Silakan pilih username lain.</p>";
    } else {
        // Insert data ke database
        $insertQuery = "INSERT INTO penyewa (nama, alamat, no_telp, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($insertQuery);
        $stmt->bind_param("sssss", $nama, $alamat, $no_telp, $username, $password);
        if ($stmt->execute()) {
            // Tampilkan pesan sukses dan arahkan ke login
            echo "<script>
                    alert('Selamat, akun Anda telah berhasil dibuat! Silakan login.');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<p style='color: red; text-align: center;'>Terjadi kesalahan: " . $koneksi->error . "</p>";
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<style>
    /* General Styling */
body {
    font-family: 'Quicksand', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right,rgb(2, 2, 3),rgb(67, 4, 27));
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    animation: fadeIn 1.5s;
}

/* Container Styling */
.container {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    padding: 30px 40px;
    width: 350px;
    text-align: center;
    animation: slideUp 1s;
}

h2 {
    color:rgb(43, 3, 25);
    margin-bottom: 20px;
}

/* Form Styling */
label {
    display: block;
    text-align: left;
    margin: 10px 0 5px;
    color: #555;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    box-sizing: border-box;
    transition: all 0.3s ease;
}

input:focus {
    border-color:rgb(203, 17, 76);
    box-shadow: 0 0 5px rgba(97, 9, 33, 0.5);
    outline: none;
}

button {
    background: linear-gradient(to right,rgb(64, 3, 22),rgb(249, 124, 157));
    border: none;
    color: white;
    font-size: 16px;
    padding: 10px;
    width: 100%;
    cursor: pointer;
    border-radius: 6px;
    transition: all 0.3s ease;
    font-weight: bold;
}

button:hover {
    background: linear-gradient(to right,rgb(94, 38, 57),rgb(130, 54, 95));
    transform: scale(1.05);
}

p {
    margin-top: 15px;
    font-size: 14px;
}

a {
    color:rgb(49, 2, 25);
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color:rgb(255, 166, 203);
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

</style>
<body>
    
<div class="container">
    <center>
        <h2>Registrasi Akun</h2>
        <form action="" method="post">
            <label>Nama:</label>
            <input type="text" name="nama" required>
            <label>Alamat:</label>
            <input type="text" name="alamat" required>
            <label>No. Telepon:</label>
            <input type="text" name="no_telp" required>
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="register">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
    </center>
</body>
</html>
