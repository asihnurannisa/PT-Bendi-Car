<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ptbendicar";

// Koneksi MySQLi
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi MySQLi gagal: " . mysqli_connect_error());
}

// Koneksi PDO
try {
    $pdo_conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>
