<?php
// Sisipkan file config.php dan impor TCPDF
include "database.php";
require_once 'vendor/autoload.php';

// Fungsi untuk mencetak gaji dokter
function cetakGajiDokter($data) {
    // Buat objek TCPDF
    
    $pdf = new TCPDF();
    
    // Atur properti dokumen seperti judul, pembuat, dll.
    $pdf->SetTitle('Gaji Dokter');
    $pdf->SetAuthor('Nama Anda');
    
    // Tambahkan halaman pertama
    $pdf->AddPage();
    
    // Buat konten PDF
    $content = 'Nama Dokter: ' . $data['nama_dokter'] . "\n";
    $content .= 'Tanggal: ' . $data['tanggal'] . "\n";
    $content .= 'PASIEN UMUM: ' . $data['pasien_umum'] . "\n";
    $content .= 'KB: ' . $data['KB'] . "\n";
    $content .= 'SKBS: ' . $data['SKBS'] . "\n";
    // Tambahkan rincian item lainnya di sini
    
    $content .= 'TOTAL GAJI: ' . $data['TOTAL_GAJI'] . "\n";
    
    // Tambahkan konten ke dokumen PDF
    $pdf->writeHTML($content, true, 0, true, 0);

    // Mengosongkan buffer output
    ob_clean(); 
    
    // Simpan dokumen PDF ke file atau tampilkan dalam browser
    $pdf->Output('gaji_dokter.pdf', 'I');
}

if (isset($_GET['cetak'])) {
    // Jika parameter cetak ada dalam URL
    $id = $_GET['cetak'];
    // Ambil data dari database berdasarkan ID atau nomor gaji dokter
    $sql = "SELECT * FROM gaji_dokter_data WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        // Panggil fungsi cetakGajiDokter dengan data yang ditemukan
        cetakGajiDokter($data);
    }
}

// Query untuk mengambil data gaji dokter
$sql = "SELECT * FROM gaji_dokter_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Gaji Dokter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Data Gaji Dokter</h2>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>PASIEN UMUM</th>
        <th>KB</th>
        <th>SKBS</th>
        <!-- Tambahkan kolom untuk item lainnya di sini -->
        <th>NEBU</th>
        <th>AU</th>
        <th>CHOL</th>
        <th>GDS</th>
        <th>WTS</th>
        <th>WTB</th>
        <th>EXTRAKSI KUKU</th>
        <th>UANG MAKAN</th>
        <th>TOTAL GAJI</th>
        <th>Cetak</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;



      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $no . "</td>";
          echo "<td>" . $row["pasien_umum"] . " x Rp. 10,000 = Rp. " . ($row["pasien_umum"] * 10000) . "</td>";
          echo "<td>" . $row["KB"] . " x Rp. 5,000 = Rp. " . ($row["KB"] * 5000) . "</td>";
          echo "<td>" . $row["SKBS"] . " x Rp. 10,000 = Rp. " . ($row["SKBS"] * 10000) . "</td>";
          // Tambahkan kolom dan rincian untuk item lainnya di sini
          echo "<td>" . $row["NEBU"] . " x Rp. 15,000 = Rp. " . ($row["NEBU"] * 15000) . "</td>";
          echo "<td>" . $row["AU"] . " x Rp. 3,000 = Rp. " . ($row["AU"] * 3000) . "</td>";
          echo "<td>" . $row["CHOL"] . " x Rp. 3,000 = Rp. " . ($row["CHOL"] * 3000) . "</td>";
          echo "<td>" . $row["GDS"] . " x Rp. 3,000 = Rp. " . ($row["GDS"] * 3000) . "</td>";
          echo "<td>" . $row["WTS"] . " x Rp. 15,000 = Rp. " . ($row["WTS"] * 15000) . "</td>";
          echo "<td>" . $row["WTB"] . " x Rp. 15,000 = Rp. " . ($row["WTB"] * 15000) . "</td>";
          echo "<td>" . $row["EXTRAKSI_KUKU"] . "</td>";
          echo "<td>" . $row["UANG_MAKAN"] . " x Rp. 15,000 = Rp. " . ($row["UANG_MAKAN"] * 15000) . "</td>";
          echo "<td>" . $row["TOTAL_GAJI"] . "</td>";
          echo '<td><a href="?cetak=' . $row["id"] . '" class="btn btn-primary">Cetak</a></td>';
          echo "</tr>";
          $no++;
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
