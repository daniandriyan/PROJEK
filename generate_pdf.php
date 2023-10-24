<?php
require_once 'vendor/autoload.php';

use TCPDF;

$pdf = new TCPDF();

// Mengatur informasi dokumen
$pdf->SetCreator('Nama Anda');
$pdf->SetAuthor('Nama Anda');
$pdf->SetTitle('Data Obat PDF');
$pdf->SetSubject('Data Obat');

// Menambahkan halaman
$pdf->AddPage();

// Membangun konten HTML untuk PDF dengan Bootstrap CSS
$html ='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Obat</title>
    <style>
        body {
            font-family: arial;
        }
        tr:nth-child(even){
            background-color: #ddd;
        }
        thead th {
            padding-bottom: 50px; /* Menambahkan jarak di bawah elemen <th> di dalam <thead> */
        }
    </style>
</head>
<body>
<h2>Request Obat Apotek</h2>
<table class="table table-hover">
        <tr>
            <th>Nama Obat</th>
            <th>Jumalah</th>
            <th>Satuan</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
         </tr>';


// Mengambil data dari database (Anda dapat menggunakan kode database yang sudah ada)
include 'database.php';

$sql = "SELECT * FROM obat";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['nama_obat'] . '</td>';
        $html .= '<td>' . $row['jumlah'] . '</td>';
        $html .= "<td>" . $row["satuan"] . "</td>";
        $html .= "<td>Rp " . number_format($row["harga_beli"], 0, ',', '.') . "</td>";
        $html .= "<td>Rp " . number_format($row["harga_jual"], 0, ',', '.') . "</td>";
        $html .= '</tr>';
    }
}

$html .= '</tbody>';
$html .= '</table>';

// Menampilkan konten HTML ke dalam PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Mengosongkan buffer output
ob_clean();

// Menutup dan menghasilkan PDF
$pdf->Output('data_obat.pdf', 'I');
?>
