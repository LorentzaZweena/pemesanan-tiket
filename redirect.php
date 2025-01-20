<?php
    include "koneksi.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BNSP | Pemesanan tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="../portal-bnsp/">WISATA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-1" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="tempat-wisata.php">Tempat wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Pesan tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="daftar-harga.php">Daftar harga</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- hasil -->
    <div class="container mt-5">
        <?php 
        $sql = "SELECT pemesanan_tiket.*, `tempat-wisata`.tempat_wisata, `tempat-wisata`.harga 
                FROM pemesanan_tiket 
                JOIN `tempat-wisata` ON pemesanan_tiket.id = `tempat-wisata`.id_tempat 
                WHERE pemesanan_tiket.id = (SELECT MAX(id) FROM pemesanan_tiket)";

        $query = mysqli_query($connect, $sql);

        while($data = mysqli_fetch_array($query)){
            $potongan = $data['harga'] * $data['pengunjung_anak'];
        ?>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Detail Pemesanan Tiket</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                        <tbody>
                        <?php 
                        $no = 1;
                        $sql = "SELECT pemesanan_tiket.*, `tempat-wisata`.tempat_wisata, `tempat-wisata`.harga 
                        FROM pemesanan_tiket 
                        JOIN `tempat-wisata` ON pemesanan_tiket.id_tempat = `tempat-wisata`.id_tempat 
                        WHERE pemesanan_tiket.id = (SELECT MAX(id) FROM pemesanan_tiket)";
                        $query = mysqli_query($connect, $sql);

                        while($data = mysqli_fetch_array($query)){
                            echo "<tr>";
                            echo "<td>".$no++."</td>";
                            echo "<td>".$data['nama']."</td>";
                            echo "<td>".$data['jenis_kelamin']."</td>";
                            echo "<td>".$data['jenis_kamar']."</td>";
                            echo "<td>".$data['no_identitas']."</td>";
                            echo "<td>".$data['tanggal_pesan']."</td>";
                            echo "<td>".$data['durasi_menginap']." malam</td>";
                            echo "<td>".$data['diskon']."%</td>";
                            echo "<td>".$data['total']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
