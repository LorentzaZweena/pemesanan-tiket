<?php
    session_start();
    include "koneksi.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan tiket</title>
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
                                    <!-- Modify the form submit button to include data-bs-toggle -->
<button type="submit" class="btn btn-dark" id="submit" name="submit" data-bs-toggle="modal" data-bs-target="#pemesananModal">Pesan tiket</button>
                                </div>
                                <div class="p-2">
                                    <button type="reset" class="btn btn-danger" id="reset">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
// session_start();
include "koneksi.php";

// Initialize variables
$formData = [
    'nama' => '',
    'no_identitas' => '',
    'no_hp' => '',
    'tempat_wisata' => '',
    'tanggal' => '',
    'jumlah_pengunjung' => '',
    'pengunjung_anak' => '',
    'total' => '',
    'potongan' => '',
    'tempat_wisata_nama' => ''
];

// Process form submission
if (isset($_POST['submit'])) {
    // Capture form data
    $formData = [
        'nama' => $_POST['nama'],
        'no_identitas' => $_POST['no_identitas'],
        'no_hp' => $_POST['no_hp'],
        'tempat_wisata' => $_POST['tempat_wisata'],
        'tanggal' => $_POST['tanggal'],
        'jumlah_pengunjung' => $_POST['jumlah_pengunjung'],
        'pengunjung_anak' => $_POST['pengunjung_anak'],
        'total' => $_POST['total']
    ];

    // Insert into database
    $sql = "INSERT INTO pemesanan_tiket (nama, no_identitas, no_hp, tempat_wisata, tanggal, jumlah_pengunjung, pengunjung_anak, total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssssiid", 
        $formData['nama'],
        $formData['no_identitas'],
        $formData['no_hp'],
        $formData['tempat_wisata'],
        $formData['tanggal'],
        $formData['jumlah_pengunjung'],
        $formData['pengunjung_anak'],
        $formData['total']
    );

    if ($stmt->execute()) {
        // Get additional details for the modal
        $sql2 = "SELECT pt.*, tw.tempat_wisata, tw.harga 
                FROM pemesanan_tiket pt 
                JOIN `tempat-wisata` tw ON pt.tempat_wisata = tw.id_tempat 
                WHERE pt.id = LAST_INSERT_ID()";
        
        $result = $connect->query($sql2);
        if ($data = $result->fetch_assoc()) {
            $formData['potongan'] = $data['harga'] * $data['pengunjung_anak'];
            $formData['tempat_wisata_nama'] = $data['tempat_wisata'];
        }
    }
}
?>

<!-- Replace the existing modal code with this -->
<div class="modal fade" id="pemesananModal" tabindex="-1" aria-labelledby="pemesananModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pemesananModalLabel">Detail Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                    <!-- Content will be populated dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pemesananModal" tabindex="-1" aria-labelledby="pemesananModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pemesananModalLabel">Detail Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload();"></button>
            </div>
            <div class="modal-body">
                <div id="modalContent">
                    <!-- Content will be populated dynamically -->
                </div>
            </div>
            <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="window.location.reload();">Close</button>
</div>

        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        // Submit the form data
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form)
        })
        .then(response => {
            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('pemesananModal'));
            myModal.show();
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const nama = document.getElementById('nama').value;
        const noIdentitas = document.getElementById('no_identitas').value;
        const noHp = document.getElementById('no_hp').value;
        const tempatWisata = document.getElementById('tempat_wisata');
        const tempatWisataText = tempatWisata.options[tempatWisata.selectedIndex].text;
        const tanggal = document.getElementById('tanggal').value;
        const jumlahPengunjung = document.getElementById('jumlah_pengunjung').value;
        const pengunjungAnak = document.getElementById('pengunjung_anak').value;
        const total = document.getElementById('total').value;

        // Format currency
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        // Populate modal content
        const modalContent = `
            <p><strong>Nama:</strong> ${nama}</p>
            <p><strong>Nomor Identitas:</strong> ${noIdentitas}</p>
            <p><strong>Nomor HP:</strong> ${noHp}</p>
            <p><strong>Tempat Wisata:</strong> ${tempatWisataText}</p>
            <p><strong>Tanggal Kunjungan:</strong> ${tanggal}</p>
            <p><strong>Jumlah Pengunjung:</strong> ${jumlahPengunjung}</p>
            <p><strong>Pengunjung Anak:</strong> ${pengunjungAnak}</p>
            <p><strong>Total Bayar:</strong> ${formatter.format(total)}</p>
        `;

        document.getElementById('modalContent').innerHTML = modalContent;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('pemesananModal'));
        modal.show();

        // Submit form data to server
        form.submit();
    });
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
