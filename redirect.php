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
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Detail Pemesanan Tiket</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Informasi Pemesan</h6>
                                <p class="mb-1"><strong>Nama:</strong> <?php echo $data['nama']; ?></p>
                                <p class="mb-1"><strong>No. Identitas:</strong> <?php echo $data['no_identitas']; ?></p>
                                <p class="mb-1"><strong>No. HP:</strong> <?php echo $data['no_hp']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Detail Wisata</h6>
                                <p class="mb-1"><strong>Tempat Wisata:</strong> <?php echo $data['tempat_wisata']; ?></p>
                                <p class="mb-1"><strong>Tanggal Kunjungan:</strong> <?php echo $data['tanggal']; ?></p>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-muted">Rincian Pengunjung & Biaya</h6>
                                <div class="bg-light p-3 rounded">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Jumlah Pengunjung:</span>
                                        <span><?php echo $data['jumlah_pengunjung']; ?> orang</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Pengunjung Anak:</span>
                                        <span><?php echo $data['pengunjung_anak']; ?> anak</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Potongan Harga:</span>
                                        <span>Rp <?php echo number_format($potongan, 0, ',', '.'); ?></span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong>Total Pembayaran:</strong>
                                        <strong class="text-primary"><?= $data['total'] ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
