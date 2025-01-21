<?php
    include "koneksi.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <h5 class="card-header fs-2 p-4 text-center bg-dark text-light">Form pemesanan</h5>
                    <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Nama lengkap</label>
                                <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama lengkap" name="nama" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Nomor identitas</label>
                                <input type="number" class="form-control" id="no_identitas" aria-describedby="emailHelp" placeholder="Masukkan nomor identitas anda" name="no_identitas" oninput="validateIdentitas(this)" required>
                                <div id="identitasError" class="text-danger" style="display: none;">Isian salah, data harus 16 digit</div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Nomor HP</label>
                                <input type="number" class="form-control" id="no_hp" aria-describedby="emailHelp" placeholder="Masukkan nomor HP anda" name="no_hp" required>
                            </div>

                            <div class="mb-3">
                                <label for="tempat_wisata" class="form-label fw-semibold">Tempat wisata</label>
                                <select class="form-select" aria-label="Default select example" name="tempat_wisata" id="tempat_wisata" required>
                                <option selected disabled value="">-- Pilih tempat wisata --</option>
                                    <?php
                                        $sql = "SELECT * FROM `tempat-wisata`";
                                        $result = mysqli_query($connect, $sql);

                                        while ($data = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $data['id_tempat'] . "' data-price='" . $data['harga'] . "'>" . $data['tempat_wisata'] . "</option>";
                                        }
                                    ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Tanggal kunjungan</label>
                                <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label fw-semibold">Jumlah pengunjung</label>
                                <select class="form-select" aria-label="Default select example" name="jumlah_pengunjung" id="jumlah_pengunjung">
                                    <!-- looping -->
                                    <option selected>-- Pilih jumlah pengunjung --</option>
                                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="semester" class="form-label fw-semibold">Pengunjung anak - anak</label>
                                <small id="keterangan" class="text-danger">Usia dibawah 12 tahun</small>
                                <select class="form-select" aria-label="Default select example" name="pengunjung_anak" id="pengunjung_anak">
                                    <!-- looping -->
                                    <option selected>-- Pilih jumlah pengunjung --</option>
                                    <?php for ($i = 1; $i <= 10; $i++) : ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label fw-semibold">Total bayar</label>
                                <input type="text" class="form-control" id="total" aria-describedby="emailHelp" name="total" readonly>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="syarat" required>
                                    <label class="form-check-label" for="flexCheckDefault">Saya dan / atau rombongan telah membaca, memahami, dan setuju berdasarkan syarat dan ketentuan yang telah ditetapkan</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3">
                                <div class="p-2">
                                    <button type="button" class="btn btn-secondary me-2" id="hitungTotal">Hitung Total Bayar</button>
                                </div>
                                <div class="p-2">
                                    <button type="submit" class="btn btn-dark" id="submit" name="submit">Pesan tiket</button>
                                </div>
                                <div class="p-2">
                                    <button type="submit" class="btn btn-danger" id="submit" name="cancel">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
            if (isset($_POST['submit'])) {
                $nama = $_POST['nama'];
                $no_identitas = $_POST['no_identitas'];
                $no_hp = $_POST['no_hp'];
                $tempat_wisata = $_POST['tempat_wisata'];
                $tanggal = $_POST['tanggal'];
                $jumlah_pengunjung = $_POST['jumlah_pengunjung'];
                $pengunjung_anak = $_POST['pengunjung_anak'];
                $total = $_POST['total'];

                $sql = "INSERT INTO pemesanan_tiket (nama, no_identitas, no_hp, tempat_wisata, tanggal, jumlah_pengunjung, pengunjung_anak, total) VALUES ('$nama', '$no_identitas', '$no_hp', '$tempat_wisata', '$tanggal', '$jumlah_pengunjung', '$pengunjung_anak', '$total')";
                
                //buat diskon
                $sql2 = "SELECT pemesanan_tiket.*, `tempat-wisata`.tempat_wisata, `tempat-wisata`.harga 
                FROM pemesanan_tiket 
                JOIN `tempat-wisata` ON pemesanan_tiket.tempat_wisata = `tempat-wisata`.id_tempat
                WHERE pemesanan_tiket.id = (SELECT MAX(id) FROM pemesanan_tiket)";

                $query = mysqli_query($connect, $sql2);
                while ($data = mysqli_fetch_array($query)) {
                $potongan = $data['harga'] * $data['pengunjung_anak'];

                $tempat_wisata = $data['tempat_wisata'];
                $harga = $data['harga'];
                }

                if ($connect->query($sql2)) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pemesanan tiket berhasil disimpan',
                    confirmButtonColor: '#212529'
                }).then(() => {
                    Swal.fire({
                        title: 'Data Pemesanan',
                        html: `
                            <p><strong>Nama:</strong> $nama</p>
                            <p><strong>Nomor Identitas:</strong> $no_identitas</p>
                            <p><strong>Nomor HP:</strong> $no_hp</p>
                            <p><strong>Tempat Wisata:</strong> $tempat_wisata</p>
                            <p><strong>Tanggal Kunjungan:</strong> $tanggal</p>
                            <p><strong>Jumlah Pengunjung:</strong> $jumlah_pengunjung</p>
                            <p><strong>Pengunjung Anak:</strong> $pengunjung_anak</p>
                            <p><strong>Potongan harga:</strong> Rp. $potongan</p>
                            <p><strong>Total Bayar:</strong> $total</p>
                        `,
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                });
                </script>";
                }
            }
        ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>
