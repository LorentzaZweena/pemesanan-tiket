document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const tempatWisata = document.getElementById('tempat_wisata');
    const jumlahPengunjung = document.getElementById('jumlah_pengunjung');
    const pengunjungAnak = document.getElementById('pengunjung_anak');
    const totalInput = document.getElementById('total');
    const hitungTotalBtn = document.getElementById('hitungTotal');

    hitungTotalBtn.addEventListener('click', calculateTotal);

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const nama = document.getElementById('nama').value;
        const noIdentitas = document.getElementById('no_identitas').value;
        const noHp = document.getElementById('no_hp').value;
        const tempatWisataValue = tempatWisata.options[tempatWisata.selectedIndex].text;
        const tanggal = document.getElementById('tanggal').value;
        const jumlahPengunjungValue = jumlahPengunjung.value;
        const pengunjungAnakValue = pengunjungAnak.value;
        const total = totalInput.value;
    });

    function calculateTotal() {
    const selectedOption = tempatWisata.options[tempatWisata.selectedIndex];
    const hargaPerOrang = parseFloat(selectedOption.dataset.price);
    
    const totalPengunjung = jumlahPengunjung.value === '-- Pilih jumlah pengunjung --' ? 0 : parseInt(jumlahPengunjung.value);
    const jumlahAnak = pengunjungAnak.value === '-- Pilih jumlah pengunjung --' ? 0 : parseInt(pengunjungAnak.value);
    
    const pengunjungBayar = totalPengunjung - jumlahAnak;
    const totalBayar = hargaPerOrang * pengunjungBayar;

    // Store unformatted numeric value for submission
    totalInput.dataset.rawValue = totalBayar;

    // Display formatted value for user
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
