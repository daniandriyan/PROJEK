<?php
include "database.php";

$tanggal = $_POST['tanggal'];
$nama_dokter = $_POST['nama_dokter'];

// Ambil data gaji pasien
$pasien_umum = $_POST['pasien_umum'];
$KB = isset($_POST['KB']) ? $_POST['KB'] : 0;
$SKBS = isset($_POST['SKBS']) ? $_POST['SKBS'] : 0;
$NEBU = isset($_POST['NEBU']) ? $_POST['NEBU'] : 0;
$AU = isset($_POST['AU']) ? $_POST['AU'] : 0;
$CHOL = isset($_POST['CHOL']) ? $_POST['CHOL'] : 0;
$GDS = isset($_POST['GDS']) ? $_POST['GDS'] : 0;
$WTS = isset($_POST['WTS']) ? $_POST['WTS'] : 0;
$WTB = isset($_POST['WTB']) ? $_POST['WTB'] : 0;
$EXTRAKSI_KUKU = isset($_POST['EXTRAKSI_KUKU']) ? $_POST['EXTRAKSI_KUKU'] : 0;
$UANG_MAKAN = isset($_POST['UANG_MAKAN']) ? $_POST['UANG_MAKAN'] : 0;

// Hitung total gaji
$total_gaji = ($pasien_umum * 10000) + ($KB * 5000) + ($SKBS * 10000) + ($NEBU * 15000) + ($AU * 3000) + ($CHOL * 3000) + ($GDS * 3000) + ($WTS * 15000) + ($WTB * 15000) + ($EXTRAKSI_KUKU) + ($UANG_MAKAN * 15000);

// Simpan data ke database
$sql = "INSERT INTO gaji_dokter_data (tanggal, nama_dokter, pasien_umum, KB, SKBS, NEBU, AU, CHOL, GDS, WTS, WTB, EXTRAKSI_KUKU, UANG_MAKAN, TOTAL_GAJI) VALUES ('$tanggal', '$nama_dokter', $pasien_umum, $KB, $SKBS, $NEBU, $AU, $CHOL, $GDS, $WTS, $WTB, $EXTRAKSI_KUKU, $UANG_MAKAN, $total_gaji)";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header('Location: hasil.php'); // Arahkan ke halaman tampilkan hasil penjumlahan
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>



