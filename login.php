<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username ada di tabel admin
    $queryAdmin = "SELECT * FROM admin WHERE username = ?";
    $stmt = $koneksi->prepare($queryAdmin);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultAdmin = $stmt->get_result();

    // Cek apakah username ada di tabel penyewa
    $queryPenyewa = "SELECT * FROM penyewa WHERE username = ?";
    $stmt2 = $koneksi->prepare($queryPenyewa);
    $stmt2->bind_param("s", $username);
    $stmt2->execute();
    $resultPenyewa = $stmt2->get_result();

    // Cek jika username ditemukan di tabel admin
    if ($resultAdmin->num_rows > 0) {
        $userAdmin = $resultAdmin->fetch_assoc();
        // Verifikasi password admin
        if ($password == $userAdmin['password']) {
            $_SESSION['role'] = 'admin';
            $_SESSION['username'] = $userAdmin['username'];
            $_SESSION['id_admin'] = $userAdmin['id_admin'];
            header("Location: admin_dashboard.php");  // Arahkan ke halaman admin
        } else {
            echo "<p style='color: red; text-align: center;'>Password salah!</p>";
        }
    }
    // Cek jika username ditemukan di tabel penyewa
    elseif ($resultPenyewa->num_rows > 0) {
        $userPenyewa = $resultPenyewa->fetch_assoc();
        // Verifikasi password penyewa
        if ($password == $userPenyewa['password']) {
            $_SESSION['role'] = 'penyewa';
            $_SESSION['username'] = $userPenyewa['username'];
            $_SESSION['id_penyewa'] = $userPenyewa['id_penyewa'];
            header("Location: dashboard.php");  // Arahkan ke halaman penyewa
        } else {
            echo "<p style='color: red; text-align: center;'>Password salah!</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Username tidak ditemukan!</p>";
    }

    $stmt->close();
    $stmt2->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PT Bendi Car</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<style>
    /* Import font */
@import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');

/* General Styles */
body {
    font-family: 'Quicksand', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom right,rgb(10, 11, 11),rgb(101, 3, 42));
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container Style */
.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
    animation: fadeIn 1s;
}

/* Judul Style */
.judul {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-transform: uppercase;
}

/* Form Elements */
label {
    display: block;
    text-align: left;
    margin-bottom: 8px;
    font-size: 14px;
    color: #666;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    transition: border 0.3s ease-in-out;
}

input[type="text"]:focus, input[type="password"]:focus {
    outline: none;
    border-color:rgb(56, 2, 19);
}

button {
    background-color:rgb(230, 10, 113);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

button:hover {
    background-color:rgb(24, 1, 22);
}

/* Link Style */
a {
    text-decoration: none;
    color:rgb(46, 1, 19);
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color:rgb(233, 115, 166);
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
<body>
    <center>
    <div class="container">
    <div class="judul">PT Bendi Car</div>
        <form action="" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
           <button type="submit" name="login">Login</button><br>
           <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </form>
    </div>
    </center>
</body>
</html>
