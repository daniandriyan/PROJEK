<?php
$host = "localhost"; // Ganti sesuai dengan host MySQL Anda
$username = "root";   // Ganti sesuai dengan username MySQL Anda
$password = "";       // Ganti sesuai dengan password MySQL Anda
$database = "gaji_dokter"; // Ganti sesuai dengan nama database Anda

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
