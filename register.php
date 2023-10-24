<?php
// Sisipkan koneksi ke database
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data yang dikirimkan melalui formulir registrasi
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash kata sandi sebelum menyimpannya
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data ke tabel
    $sql = "INSERT INTO user (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Registrasi berhasil, arahkan pengguna ke halaman login
        header("Location: login.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}