<?php
session_start();

// Sisipkan koneksi ke database
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data yang dikirimkan melalui formulir login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengambil hash kata sandi dari database berdasarkan alamat email
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $row['password'];

        // Memeriksa apakah kata sandi yang dimasukkan oleh pengguna cocok dengan hash di database
        if (password_verify($password, $hashedPasswordFromDatabase)) {
            // Autentikasi berhasil, arahkan pengguna ke halaman beranda (misalnya, index.html)
            header("Location: index.html");
            exit;
        } else {
            // Autentikasi gagal, tampilkan pesan kesalahan atau arahkan kembali ke halaman login
            echo "Autentikasi gagal. Kata sandi salah.";
        }
    } else {
        // Pengguna tidak ditemukan, tampilkan pesan kesalahan atau arahkan kembali ke halaman login
        echo "Autentikasi gagal. Pengguna tidak ditemukan.";
    }
}

// Tutup koneksi ke database
$conn->close();
?>

