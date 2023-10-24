<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Obat</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />


</head>
<body class="sb-nav-fixed">
    <!-- ... Navbar and sidebar code ... -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Data Obat</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Obat</li>
                </ol>
                <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                   
                       

                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#inputObatModal">Tambah Obat Baru</button>
                            <button type="button" class="btn btn-primary ml-auto btn-update-obat" data-toggle="modal" data-target="#updateObatModal" data-nama-obat="NamaObatValue" data-jumlah-obat="JumlahObatValue">Update Obat</button>
                            <button type="button" class="btn btn-primary ml-auto" data-toggle "modal" data-target="#inputObatModal">Buat PDF</button>
                            <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#pdfModal">Buat PDF</button>
                        </div>
                    </div>
                </div>

              
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>nama obat</th>
                                        <th>jumlah</th>
                                        <th>satuan</th>
                                        <th>harga beli</th>
                                        <th>harga jual</th>
                                        <th>tanggal masuk</th>
                                        <th>tanggal expired</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include 'database.php';

                                    // Query untuk mengambil data dari tabel
                                    $sql = "SELECT * FROM obat"; // Ganti "nama_tabel" dengan nama tabel Anda.

                                    $result = $conn->query($sql);

                                    // Error handling
                                    error_reporting(E_ALL);
                                    ini_set('display_errors', 1);

                                    ?>
                                    <?php

            

                                  
                                    // Loop through the data and display it in the table
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["nama_obat"] . "</td>";
                                            echo "<td>" . $row["jumlah"] . "</td>";
                                            echo "<td>" . $row["satuan"] . "</td>";
                                            echo "<td>Rp " . number_format($row["harga_beli"], 0, ',', '.') . "</td>";
                                            echo "<td>Rp " . number_format($row["harga_jual"], 0, ',', '.') . "</td>";
                                            echo "<td>" . $row["tanggal_masuk"] . "</td>";
                                            echo "<td>" . $row["tanggal_expired"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
                                    }
                                    ?>
                                </tbody>
        
                            </table>
                        </div>
                    </div>
                </div>
               
            </div>
        </main>
        <!-- ... Footer code ... -->
    </div>
    <!-- Modal untuk tombol "Buat PDF" -->
    <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Buat PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda dapat membuat PDF di sini. Tekan tombol di bawah untuk menghasilkan PDF.</p>
                    <a href="generate_pdf.php" target="_blank" class="btn btn-primary">Buat PDF</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal untuk menginput data obat -->
    <div class="modal fade" id="inputObatModal" tabindex="-1" role="dialog" aria-labelledby="inputObatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="proses_data.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputObatModalLabel">Tambah Data Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk menginput data -->
                     
                        <div class="form-group">
                            <label for="namaObat">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat" id="namaObat" placeholder="Nama Obat">
                        </div>
                                                <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Obat">
                        </div>

                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select class="form-control" name="satuan" id="satuan">
                                <option value="botol">Botol</option>
                                <option value="strip">Strip</option>
                                <option value="tablet">Tablet</option>
                                <option value="pcs">Pcs</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hargaBeli">Harga Beli</label>
                            <input type="number" class="form-control" name="harga_beli" id="hargaBeli" placeholder="Harga Beli">
                        </div>
                        <div class="form-group">
                            <label for="hargaJual">Harga Jual</label>
                            <input type="number" class="form-control" name="harga_jual" id="hargaJual" placeholder="Harga Jual">
                        </div>
                        <div class="form-group">
                            <label for="tanggalMasuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" id="tanggalMasuk">
                        </div>
                        <div class="form-group">
                            <label for="tanggalExpired">Tanggal Expired</label>
                            <input type="date" class="form-control" name="tanggal_expired" id="tanggalExpired">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- Modal untuk mengupdate data obat -->
    <div class="modal fade" id="updateObatModal" tabindex="-1" role="dialog" aria-labelledby="updateObatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="proses_data.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateObatModalLabel">Update Data Obat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Input field untuk mengupdate data -->
                        <div class="form-group">
                            <label for="namaObatUpdate">Nama Obat</label>
                            <input type="text" class="form-control" name="nama_obat_update" id="namaObatUpdate" placeholder="Nama Obat">
                        </div>
                        <div class="form-group">
                            <label for="jumlahObatUpdate">Jumlah Obat</label>
                            <input type="number" class="form-control" name="jumlah_obat_update" id="jumlahObatUpdate" placeholder="Jumlah Obat">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Urutan pemuatan pustaka -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/tables.js"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script>
            // Fungsi untuk mendapatkan parameter dari URL
            function getUrlParameter(name) {
                name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            // Cek apakah ada parameter "success" dalam URL
            var successMessage = getUrlParameter('success');

 
    </script>

</body>
</html>