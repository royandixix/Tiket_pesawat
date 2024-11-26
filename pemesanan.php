<?php
// Include koneksi database
require 'config/fungsi.php';  // Koneksi ke database
require 'templates/navbar.php';  // Navbar
require 'templates/header.php';  // Header

// Proses pemesanan tiket
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form modal
    $jadwal_id = $_POST['jadwal_id'];
    $total_harga = $_POST['total_harga'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $pengguna_id = 1;  // ID pengguna yang melakukan pemesanan, sesuaikan dengan sistem login Anda

    // Proses upload gambar jika ada
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
        $gambar_dir = 'uploads/';  // Folder upload gambar
        $gambar_path = $gambar_dir . $gambar_name;

        // Pindahkan gambar ke folder uploads
        if (move_uploaded_file($gambar_tmp_name, $gambar_path)) {
            $gambar_uploaded = true;
        } else {
            $gambar_path = null;  // Jika gagal, set gambar ke null
        }
    } else {
        $gambar_path = null;  // Jika tidak ada gambar, set null
    }

    if (empty($jadwal_id) || empty($total_harga) || empty($jumlah_tiket)) {
        echo '<div class="alert alert-danger" role="alert">Data tidak lengkap. Silakan periksa kembali form Anda.</div>';
        exit;
    }


    // Query untuk memasukkan data pemesanan tiket
    $query = "INSERT INTO pemesanan (pengguna_id, jadwal_id, jumlah_tiket, total_harga, gambar) 
          VALUES ('$pengguna_id', '$jadwal_id', '$jumlah_tiket', '$total_harga', '$gambar_path')";

    // Eksekusi query dan tampilkan pesan sukses atau error
    if (mysqli_query($db, $query)) {
        echo '<div class="alert alert-success" role="alert">Pemesanan berhasil!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Terjadi kesalahan: ' . mysqli_error($db) . '</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Jadwal ID tidak valid.</div>';
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

<!-- Lanjutkan dengan bagian HTML jika diperlukan -->

<link rel="stylesheet" href="pemesanan.css">
<div class="sticky-top bg-white shadow-sm py-3">
    <div class="container">
        <h1 class="text-left mb-3 text-primary">Cari Tiket Pesawat Anda</h1>
        <!-- Form Pencarian -->
        <div class="card p-3 shadow-sm">
            <form action="search.php" method="GET">
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



<div class="container">
    <div class="row g-4">
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <img src="uploads/<?= htmlspecialchars($data['gambar']); ?>"
                                alt="<?= htmlspecialchars($data['maskapai']); ?>"
                                class="img-fluid me-2"
                                style="width: 30px;">
                            <?= htmlspecialchars($data['maskapai']); ?>
                        </h5>
                        <p class="card-text mb-1"><strong>Kota Asal:</strong> <?= htmlspecialchars($data['kota_asal']); ?></p>
                        <p class="card-text mb-1"><strong>Kota Tujuan:</strong> <?= htmlspecialchars($data['kota_tujuan']); ?></p>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> <?= htmlspecialchars($data['tanggal_berangkat']); ?></p>
                        <p class="card-text text-primary"><strong>Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.'); ?></p>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#purchaseModal"
                            data-id="<?= $data['id']; ?>"
                            data-harga="<?= $data['harga']; ?>"
                            data-maskapai="<?= htmlspecialchars($data['maskapai']); ?>"
                            data-gambar="<?= htmlspecialchars($data['gambar']); ?>"
                            data-jumlah="1">Beli Tiket</button> <!-- Jumlah tiket default -->
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
                <h5 class="modal-title" id="purchaseModalLabel">Konfirmasi Pembelian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin membeli tiket ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="jadwal_id" id="jadwal_id">
                    <input type="hidden" name="total_harga" id="total_harga">
                    <input type="hidden" name="jumlah_tiket" id="jumlah_tiket">
                    <!-- <input type="file" name="gambar" accept="image/*"> -->
                    <button type="submit" class="btn btn-primary">Ya, Beli Tiket</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require 'templates/footer.php';
?>

<script>
    document.querySelectorAll('.btn-primary').forEach(button => {
        button.addEventListener('click', function() {
            var jadwalId = this.getAttribute('data-id');
            var harga = this.getAttribute('data-harga');
            var jumlahTiket = this.getAttribute('data-jumlah');

            document.getElementById('jadwal_id').value = jadwalId;
            document.getElementById('total_harga').value = harga * jumlahTiket;
            document.getElementById('jumlah_tiket').value = jumlahTiket;
        });
    });
</script>