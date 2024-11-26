<?php
require 'config/fungsi.php'; // Pastikan file koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $maskapai = mysqli_real_escape_string($db, $_POST['maskapai']);
    $kota_asal = mysqli_real_escape_string($db, $_POST['kota_asal']);
    $kota_tujuan = mysqli_real_escape_string($db, $_POST['kota_tujuan']);
    $tanggal_berangkat = mysqli_real_escape_string($db, $_POST['tanggal_berangkat']);
    $harga = mysqli_real_escape_string($db, $_POST['harga']);

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];
    $folder_tujuan = "uploads/"; // Pastikan folder ini ada di server Anda
    $path_gambar = $folder_tujuan . basename($gambar);

    // Validasi file upload
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($path_gambar, PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_extensions)) {
        if (move_uploaded_file($tmp_gambar, $path_gambar)) {
            // Query insert data
            $sql = "INSERT INTO jadwal_penerbangan (maskapai, kota_asal, kota_tujuan, tanggal_berangkat, harga, gambar) 
                    VALUES ('$maskapai', '$kota_asal', '$kota_tujuan', '$tanggal_berangkat', '$harga', '$gambar')";

            if (mysqli_query($db, $sql)) {
                // Berhasil menyimpan data
                header("Location:"); // Redirect ke halaman tertentu
                exit;
            } else {
                // Gagal menyimpan data
                echo "Error: " . mysqli_error($db);
            }
        } else {
            echo "Gagal mengupload gambar.";
        }
    } else {
        echo "Format file tidak didukung. Harap unggah file dengan format: jpg, jpeg, png, atau gif.";
    }
}
?>

<?php require 'config/fungsi.php' ?>

<?php
require 'templates/navbar.php';
require 'templates/header.php';
?>

<link rel="stylesheet" href="pemesanan.css">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="text-center text-primary mb-4">Tambah Data Tiket</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="maskapai" class="form-label fw-bold">Maskapai</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="maskapai" 
                        name="maskapai" 
                        placeholder="Masukkan nama maskapai" 
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="kota_asal" class="form-label fw-bold">Kota Asal</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="kota_asal" 
                        name="kota_asal" 
                        placeholder="Masukkan kota asal" 
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="kota_tujuan" class="form-label fw-bold">Kota Tujuan</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="kota_tujuan" 
                        name="kota_tujuan" 
                        placeholder="Masukkan kota tujuan" 
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="tanggal_berangkat" class="form-label fw-bold">Tanggal Berangkat</label>
                    <input 
                        type="datetime-local" 
                        class="form-control" 
                        id="tanggal_berangkat" 
                        name="tanggal_berangkat" 
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Harga Tiket</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        min="0" 
                        class="form-control" 
                        id="harga" 
                        name="harga" 
                        placeholder="Masukkan harga tiket (contoh: 1500000)" 
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label fw-bold">Upload Gambar Tiket</label>
                    <input 
                        type="file" 
                        class="form-control" 
                        id="gambar" 
                        name="gambar" 
                        accept="image/*" 
                        required
                    >
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Tambah Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        max-width: 600px; /* Atur lebar maksimal lebih besar */
        margin: 30px auto; /* Rata tengah dengan jarak lebih besar */
        padding: 25px; /* Spasi dalam */
        border-radius: 15px; /* Sudut lebih besar */
    }

    .card-body {
        padding: 20px; /* Spasi dalam konten */
    }

    .form-control {
        font-size: 16px; /* Ukuran font lebih besar */
        padding: 10px; /* Padding lebih nyaman */
    }

    .btn-primary {
        font-size: 16px; /* Ukuran teks lebih besar */
        padding: 12px 25px; /* Sesuaikan padding tombol */
        border-radius: 10px; /* Sudut tombol */
        transition: all 0.3s ease; /* Animasi tombol */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Efek hover */
        transform: scale(1.05); /* Efek zoom */
    }
</style>

<?php
require 'templates/footer.php';
?>
