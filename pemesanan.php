<?php
// Include koneksi database
require 'config/fungsi.php';  // Koneksi ke database
require 'templates/navbar.php';  // Navbar
require 'templates/header.php';  // Header
require 'templates/footer.php';  // Footer

// Proses pemesanan tiket
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form modal
    $jadwal_id = mysqli_real_escape_string($db, $_POST['jadwal_id']);
    $jumlah_tiket = mysqli_real_escape_string($db, $_POST['jumlah_tiket']);
    $pengguna_id = 1;  // ID pengguna yang melakukan pemesanan, sesuaikan dengan sistem login Anda

    // Query untuk mengambil nama pengguna berdasarkan pengguna_id
    $query_nama = "SELECT nama FROM pengguna WHERE id = '$pengguna_id'";
    $result_nama = mysqli_query($db, $query_nama);

    // Cek apakah nama pengguna ditemukan
    if ($result_nama && mysqli_num_rows($result_nama) > 0) {
        $data_nama = mysqli_fetch_assoc($result_nama);
        $nama_pengguna = $data_nama['nama'];  // Ambil nama pengguna
    } else {
        echo '<div class="alert alert-danger" role="alert">Nama pengguna tidak ditemukan.</div>';
        exit;
    }

    // Pastikan nama pengguna tidak kosong
    if (empty($nama_pengguna)) {
        echo '<div class="alert alert-danger" role="alert">Nama pengguna tidak ditemukan atau kosong.</div>';
        exit;
    }

    // Hapus bagian upload gambar
    $gambar_path = null;  // Tidak ada gambar, set null

    // Pastikan jadwal_id, jumlah_tiket tidak kosong
    if (empty($jadwal_id) || empty($jumlah_tiket)) {
        echo '<div class="alert alert-danger" role="alert">Data tidak lengkap. Silakan periksa kembali form Anda.</div>';
        exit;
    }

    // Ambil data jadwal penerbangan berdasarkan jadwal_id
    $query_jadwal = "SELECT maskapai, harga FROM jadwal_penerbangan WHERE id = '$jadwal_id'";
    $result_jadwal = mysqli_query($db, $query_jadwal);

    // Cek apakah jadwal ditemukan
    if ($result_jadwal && mysqli_num_rows($result_jadwal) > 0) {
        $data_jadwal = mysqli_fetch_assoc($result_jadwal);
        $maskapai = $data_jadwal['maskapai'];
        $harga_per_tiket = $data_jadwal['harga'];
        $total_harga = $harga_per_tiket * $jumlah_tiket;  // Hitung total harga
    } else {
        echo '<div class="alert alert-danger" role="alert">Jadwal penerbangan tidak ditemukan.</div>';
        exit;
    }

    // Query untuk memasukkan data pemesanan tiket beserta nama pengguna dan maskapai
    $query = "INSERT INTO pemesanan (pengguna_id, nama, jadwal_id, jumlah_tiket, total_harga, maskapai, gambar) 
              VALUES ('$pengguna_id', '$nama_pengguna', '$jadwal_id', '$jumlah_tiket', '$total_harga', '$maskapai', '$gambar_path')";

    // Eksekusi query dan tampilkan pesan sukses atau error
    if (mysqli_query($db, $query)) {
        echo '<div class="alert alert-success" role="alert">Pemesanan berhasil!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan: ' . mysqli_error($db) . '</div>';
    }
}

// Query untuk mengambil data jadwal penerbangan
$query = "SELECT * FROM jadwal_penerbangan";  // Ganti dengan query yang sesuai jika perlu
$result = mysqli_query($db, $query);  // Eksekusi query

// Cek apakah query berhasil
if (!$result) {
    echo "Error: " . mysqli_error($db);
    exit;
}
?>


<style>
    body {
        background-image: url('path-to-your-background-image.jpg');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<link rel="stylesheet" href="css/pemesanan.css">

<div class="sticky-top bg-white shadow-sm py-3">
    <div class="container">
        <h1 class="text-left mb text-primary">Cari Tiket Pesawat Anda</h1>
        <!-- Form Pencarian -->
        <div class="card p-3 shadow-sm">
            <form action="pemesanan.php" method="GET">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label for="kota_asal" class="form-label fw-bold">Kota Asal</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control form-control-sm" id="kota_asal" name="kota_asal" placeholder="Contoh: Jakarta" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="kota_tujuan" class="form-label fw-bold">Kota Tujuan</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-geo"></i></span>
                            <input type="text" class="form-control form-control-sm" id="kota_tujuan" name="kota_tujuan" placeholder="Contoh: Surabaya" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                            <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" required>
                        </div>
                    </div>
                    <div class="col-md-1 text-center">
                        <button type="submit" class="btn btn-primary btn-sm w-100 shadow-sm d-flex flex-column align-items-center">
                            <span>Cari Tiket</span>
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-2">
    <div class="row g-4">
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card shadow-lg rounded-lg">
                    <!-- Gambar Maskapai -->
                    <img src="uploads/<?= htmlspecialchars($data['gambar']); ?>"
                        alt="<?= htmlspecialchars($data['maskapai']); ?>"
                        class="img-fluid">

                    <div class="card-body">
                        <!-- Detail Maskapai -->
                        <p class="card-text">
                            <strong>Nama Maskapai:</strong> <?= htmlspecialchars($data['maskapai']); ?>
                        </p>
                        <p class="card-text">
                            <strong>Kota Asal:</strong> <?= htmlspecialchars($data['kota_asal']); ?>
                        </p>
                        <p class="card-text">
                            <strong>Kota Tujuan:</strong> <?= htmlspecialchars($data['kota_tujuan']); ?>
                        </p>
                        <p class="card-text">
                            <strong>Tanggal:</strong> <?= htmlspecialchars($data['tanggal_berangkat']); ?>
                        </p>
                        <p class="card-text text-primary">
                            <strong>Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.'); ?>
                        </p>

                        <!-- Tombol Beli Tiket -->
                        <button type="button" class="btn btn-primary btn-sm w-100"
                            data-bs-toggle="modal" data-bs-target="#purchaseModal"
                            data-id="<?= $data['id']; ?>"
                            data-harga="<?= $data['harga']; ?>"
                            data-maskapai="<?= htmlspecialchars($data['maskapai']); ?>"
                            data-gambar="<?= htmlspecialchars($data['gambar']); ?>"
                            data-jumlah="1">
                            Beli Tiket
                        </button>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Modal Konfirmasi Pembelian -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel">Pemesanan Tiket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="pemesanan.php" method="POST">
                    <input type="hidden" name="jadwal_id" id="modalJadwalId">
                    <div class="mb-3">
                        <label for="modalTotalHarga" class="form-label">Harga Tiket (per tiket)</label>
                        <input type="text" class="form-control" id="modalHargaPerTiket" name="harga_per_tiket" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalJumlahTiket" class="form-label">Jumlah Tiket</label>
                        <input type="number" class="form-control" id="modalJumlahTiket" name="jumlah_tiket" value="1" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalTotalHarga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="modalTotalHarga" name="total_harga" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Pesan Tiket</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event listener untuk tombol yang membuka modal
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                // Ambil data yang ada pada tombol yang diklik
                const hargaTiket = parseFloat(button.getAttribute('data-harga')); // Harga tiket
                const jumlahTiket = 1; // Jumlah tiket default

                // Isi nilai-nilai modal dengan data yang sesuai
                document.getElementById('modalJadwalId').value = button.getAttribute('data-id');
                document.getElementById('modalHargaPerTiket').value = 'Rp ' + hargaTiket.toLocaleString('id-ID'); // Format harga
                document.getElementById('modalTotalHarga').value = 'Rp ' + (hargaTiket * jumlahTiket).toLocaleString('id-ID'); // Total harga

                // Update total harga saat jumlah tiket berubah
                const jumlahTiketInput = document.getElementById('modalJumlahTiket');
                jumlahTiketInput.addEventListener('input', function() {
                    const totalHarga = hargaTiket * parseInt(jumlahTiketInput.value); // Hitung total harga
                    document.getElementById('modalTotalHarga').value = 'Rp ' + totalHarga.toLocaleString('id-ID');

                    // Perbarui nilai hidden input untuk total harga yang akan dikirim
                    document.getElementById('modalTotalHarga').name = 'total_harga';
                });
            });
        });

        // Mengisi modal dengan detail tiket saat modal dibuka
        var purchaseModal = document.getElementById('purchaseModal');
        purchaseModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Tombol yang membuka modal
            var jadwalId = button.getAttribute('data-id');
            var harga = button.getAttribute('data-harga');
            var maskapai = button.getAttribute('data-maskapai');
            var gambar = button.getAttribute('data-gambar');
            var jumlah = button.getAttribute('data-jumlah');

            // Mengisi konten modal dengan data tiket
            var modalId = purchaseModal.querySelector('#modalId');
            var modalHarga = purchaseModal.querySelector('#modalHarga');
            var modalHargaValue = purchaseModal.querySelector('#modalHargaValue');
            var modalMaskapai = purchaseModal.querySelector('#modalMaskapai');
            var modalImage = purchaseModal.querySelector('#modalImage');

            modalId.value = jadwalId;
            modalHarga.textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
            modalHargaValue.value = harga;
            modalMaskapai.textContent = maskapai;

            // Mengatur path gambar dinamis (menggunakan nama gambar yang ada di database)
            modalImage.src = 'uploads/tiket/' + gambar; // Path relatif ke folder 'uploads/tiket'
        });
    });
</script>