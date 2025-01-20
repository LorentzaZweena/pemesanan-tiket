document.addEventListener('DOMContentLoaded', function() {
    const tempatWisata = document.getElementById('tempat_wisata');
    const jumlahPengunjung = document.getElementById('jumlah_pengunjung');
    const pengunjungAnak = document.getElementById('pengunjung_anak');
    const totalInput = document.getElementById('total');
    const hitungTotalBtn = document.getElementById('hitungTotal');

    hitungTotalBtn.addEventListener('click', calculateTotal);

    function calculateTotal() {
        const selectedOption = tempatWisata.options[tempatWisata.selectedIndex];
        const hargaPerOrang = parseFloat(selectedOption.dataset.price);
        
        // Ngambil nilai dari input jumlah pengunjung dan jumlah anak
        const totalPengunjung = jumlahPengunjung.value === '-- Pilih jumlah pengunjung --' ? 0 : parseInt(jumlahPengunjung.value);
        const jumlahAnak = pengunjungAnak.value === '-- Pilih jumlah pengunjung --' ? 0 : parseInt(pengunjungAnak.value);
        
        // Buat ngitung
        const pengunjungBayar = totalPengunjung - jumlahAnak;
        
        // Ngitung total
        const totalBayar = hargaPerOrang * pengunjungBayar;
        
        // Jadi format rupiah
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        totalInput.value = formatter.format(totalBayar);
    }
});

function validateIdentitas(input) {
    const errorDiv = document.getElementById('identitasError');
    if(input.value.length !== 16) {
        errorDiv.style.display = 'block';
        input.setCustomValidity('Nomor identitas harus 16 digit');
    } else {
        errorDiv.style.display = 'none';
        input.setCustomValidity('');
    }
}
