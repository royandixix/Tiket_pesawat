<?php
require 'templates/header.php';
require 'templates/navbar.php';
require 'config/fungsi.php';

// Query untuk mengambil data dari tabel pemesanan
$query = "SELECT * FROM pemesanan";
$result = mysqli_query($db, $query);

// Ambil semua data sebagai array
$pemesanan_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<style>
    .tabel {
        margin-top: 100px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    td {
        background-color: #f9f9f9;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    img {
        border-radius: 5px;
    }
    .no-image {
        font-style: italic;
        color: gray;
    }
</style>

<div class="tabel">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Data Pemesanan Tiket Pesawat</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th> <!-- Menambahkan kolom No -->
                        <th class="d-none">ID</th> <!-- Menyembunyikan kolom ID -->
                        <th>Pengguna ID</th>
                        <th>Nama</th>
                        <th>Jadwal ID</th>
                        <th>Maskapai</th>
                        <th>Jumlah Tiket</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pemesanan_data)) : ?>
                        <?php $no = 1; // Variabel untuk nomor urut ?>
                        <?php foreach ($pemesanan_data as $row) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
                                <td class="d-none"><?php echo $row['id']; ?></td> <!-- Kolom ID yang disembunyikan -->
                                <td><?php echo $row['pengguna_id']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['jadwal_id']; ?></td>
                                <td><?php echo $row['maskapai']; ?></td>
                                <td><?php echo $row['jumlah_tiket']; ?></td>
                                <td><?php echo number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                <td><?php echo $row['tanggal_pemesanan']; ?></td>
                                <td>
                                    <?php if ($row['gambar']) : ?>
                                        <img src="<?php echo $row['gambar']; ?>" alt="Gambar" style="width: 50px; height: 50px;">
                                    <?php else : ?>
                                        <span class="no-image">No image</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script untuk tambahan fungsionalitas jika diperlukan -->
<script>
    // Contoh: Menambahkan efek hover pada gambar
    const images = document.querySelectorAll('img');
    images.forEach(image => {
        image.addEventListener('mouseover', () => {
            image.style.transform = 'scale(1.1)';
            image.style.transition = 'transform 0.3s';
        });
        image.addEventListener('mouseout', () => {
            image.style.transform = 'scale(1)';
        });
    });
</script>

<?php
require 'templates/footer.php';
?>
