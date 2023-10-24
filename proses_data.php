<?php
include 'database.php';

// Validasi dan membersihkan data yang diterima dari formulir
$nama_obat = mysqli_real_escape_string($conn, $_POST['nama_obat']);
$jumlah = intval($_POST['jumlah']); // Ubah ke tipe data integer
$satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
$harga_beli = floatval(str_replace(',', '', $_POST['harga_beli']));
$harga_jual = floatval(str_replace(',', '', $_POST['harga_jual']));
$tanggal_masuk = mysqli_real_escape_string($conn, $_POST['tanggal_masuk']);
$tanggal_expired = mysqli_real_escape_string($conn, $_POST['tanggal_expired']);

echo "Nilai satuan yang diambil: " . $satuan;

// Query untuk menyimpan data ke database menggunakan parameterized statement
$sql = "INSERT INTO obat (nama_obat, jumlah, satuan, harga_beli, harga_jual, tanggal_masuk, tanggal_expired) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sissdss", $nama_obat, $jumlah, $satuan, $harga_beli, $harga_jual, $tanggal_masuk, $tanggal_expired);

    if ($stmt->execute()) {
        $success_message = "Data berhasil disimpan";
        header("Location: tables.php?success=" . urlencode($success_message));
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
