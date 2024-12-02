<?php
require 'config/fungsi.php'; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dengan validasi
    $maskapai = mysqli_real_escape_string($db, $_POST['maskapai']);
    $kota_asal = mysqli_real_escape_string($db, $_POST['kota_asal']);
    $kota_tujuan = mysqli_real_escape_string($db, $_POST['kota_tujuan']);
    $tanggal_berangkat = mysqli_real_escape_string($db, $_POST['tanggal_berangkat']);
    $harga = mysqli_real_escape_string($db, $_POST['harga']);

    // Validasi harga (hanya angka)
    if (!is_numeric($harga)) {
        echo "Harga harus berupa angka.";
        exit;
    }

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];
    $folder_tujuan = "/uploads"; // Pastikan folder ini ada di server Anda
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
                header("Location: pemesanan.php"); // Redirect ke halaman sukses
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
                        required>
                </div>

                <!-- Dropdown Kota Asal -->
                <div class="mb-3">
                    <label for="kota_asal" class="form-label fw-bold">Kota Asal</label>
                    <select
                        class="form-control"
                        id="kota_asal"
                        name="kota_asal"
                        required>
                        <option value="">Pilih Kota Asal</option>
                        <!-- Provinsi Aceh -->
                        <option value="Banda Aceh">Banda Aceh</option>
                        <!-- Provinsi Sumatera Utara -->
                        <option value="Medan">Medan</option>
                        <option value="Binjai">Binjai</option>
                        <option value="Pematangsiantar">Pematangsiantar</option>
                        <!-- Provinsi Sumatera Barat -->
                        <option value="Padang">Padang</option>
                        <option value="Bukittinggi">Bukittinggi</option>
                        <option value="Payakumbuh">Payakumbuh</option>
                        <!-- Provinsi Riau -->
                        <option value="Pekanbaru">Pekanbaru</option>
                        <option value="Dumai">Dumai</option>
                        <!-- Provinsi Jambi -->
                        <option value="Jambi">Jambi</option>
                        <!-- Provinsi Sumatera Selatan -->
                        <option value="Palembang">Palembang</option>
                        <option value="Lubuklinggau">Lubuklinggau</option>
                        <option value="Prabumulih">Prabumulih</option>
                        <!-- Provinsi Bengkulu -->
                        <option value="Bengkulu">Bengkulu</option>
                        <!-- Provinsi Lampung -->
                        <option value="Bandar Lampung">Bandar Lampung</option>
                        <option value="Metro">Metro</option>
                        <!-- Provinsi Kepulauan Riau -->
                        <option value="Batam">Batam</option>
                        <option value="Tanjungpinang">Tanjungpinang</option>
                        <!-- Provinsi Jakarta -->
                        <option value="Jakarta">Jakarta</option>
                        <option value="Jakarta Pusat">Jakarta Pusat</option>
                        <option value="Jakarta Utara">Jakarta Utara</option>
                        <option value="Jakarta Timur">Jakarta Timur</option>
                        <option value="Jakarta Barat">Jakarta Barat</option>
                        <option value="Jakarta Selatan">Jakarta Selatan</option>
                        <!-- Provinsi Jawa Barat -->
                        <option value="Bandung">Bandung</option>
                        <option value="Bekasi">Bekasi</option>
                        <option value="Depok">Depok</option>
                        <option value="Cimahi">Cimahi</option>
                        <option value="Bogor">Bogor</option>
                        <!-- Provinsi Jawa Tengah -->
                        <option value="Semarang">Semarang</option>
                        <option value="Solo">Solo (Surakarta)</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Magelang">Magelang</option>
                        <option value="Salatiga">Salatiga</option>
                        <!-- Provinsi DI Yogyakarta -->
                        <option value="Yogyakarta">Yogyakarta</option>
                        <!-- Provinsi Jawa Timur -->
                        <option value="Surabaya">Surabaya</option>
                        <option value="Malang">Malang</option>
                        <option value="Kediri">Kediri</option>
                        <option value="Probolinggo">Probolinggo</option>
                        <option value="Blitar">Blitar</option>
                        <!-- Provinsi Bali -->
                        <option value="Denpasar">Denpasar</option>
                        <!-- Provinsi Nusa Tenggara Barat -->
                        <option value="Mataram">Mataram</option>
                        <option value="Bima">Bima</option>
                        <!-- Provinsi Nusa Tenggara Timur -->
                        <option value="Kupang">Kupang</option>
                        <!-- Provinsi Kalimantan Barat -->
                        <option value="Pontianak">Pontianak</option>
                        <!-- Provinsi Kalimantan Tengah -->
                        <option value="Palangkaraya">Palangkaraya</option>
                        <!-- Provinsi Kalimantan Selatan -->
                        <option value="Banjarmasin">Banjarmasin</option>
                        <option value="Banjarbaru">Banjarbaru</option>
                        <!-- Provinsi Kalimantan Timur -->
                        <option value="Samarinda">Samarinda</option>
                        <option value="Balikpapan">Balikpapan</option>
                        <!-- Provinsi Kalimantan Utara -->
                        <option value="Tarakan">Tarakan</option>
                        <!-- Provinsi Sulawesi Utara -->
                        <option value="Manado">Manado</option>
                        <option value="Bitung">Bitung</option>
                        <!-- Provinsi Sulawesi Tengah -->
                        <option value="Palu">Palu</option>
                        <!-- Provinsi Sulawesi Selatan -->
                        <option value="Makassar">Makassar</option>
                        <option value="Parepare">Parepare</option>
                        <option value="Palopo">Palopo</option>
                        <!-- Provinsi Sulawesi Tenggara -->
                        <option value="Kendari">Kendari</option>
                        <option value="Baubau">Baubau</option>
                        <!-- Provinsi Gorontalo -->
                        <option value="Gorontalo">Gorontalo</option>
                        <!-- Provinsi Maluku -->
                        <option value="Ambon">Ambon</option>
                        <!-- Provinsi Maluku Utara -->
                        <option value="Ternate">Ternate</option>
                        <option value="Tidore">Tidore</option>
                        <!-- Provinsi Papua -->
                        <option value="Jayapura">Jayapura</option>
                        <option value="Sorong">Sorong</option>
                        <!-- Provinsi Papua Barat -->
                        <option value="Manokwari">Manokwari</option>
                        <option value="Raja Ampat">Raja Ampat</option>
                        <!-- Provinsi Sulawesi Barat -->
                        <option value="Mamuju">Mamuju</option>
                    </select>
                </div>

                <!-- Dropdown Kota Tujuan -->
                <div class="mb-3">
                    <label for="kota_tujuan" class="form-label fw-bold">Kota Tujuan</label>
                    <select
                        class="form-control"
                        id="kota_tujuan"
                        name="kota_tujuan"
                        required>
                        <option value="">Pilih Kota Asal</option>
                        <!-- Provinsi Aceh -->
                        <option value="Banda Aceh">Banda Aceh</option>
                        <!-- Provinsi Sumatera Utara -->
                        <option value="Medan">Medan</option>
                        <option value="Binjai">Binjai</option>
                        <option value="Pematangsiantar">Pematangsiantar</option>
                        <!-- Provinsi Sumatera Barat -->
                        <option value="Padang">Padang</option>
                        <option value="Bukittinggi">Bukittinggi</option>
                        <option value="Payakumbuh">Payakumbuh</option>
                        <!-- Provinsi Riau -->
                        <option value="Pekanbaru">Pekanbaru</option>
                        <option value="Dumai">Dumai</option>
                        <!-- Provinsi Jambi -->
                        <option value="Jambi">Jambi</option>
                        <!-- Provinsi Sumatera Selatan -->
                        <option value="Palembang">Palembang</option>
                        <option value="Lubuklinggau">Lubuklinggau</option>
                        <option value="Prabumulih">Prabumulih</option>
                        <!-- Provinsi Bengkulu -->
                        <option value="Bengkulu">Bengkulu</option>
                        <!-- Provinsi Lampung -->
                        <option value="Bandar Lampung">Bandar Lampung</option>
                        <option value="Metro">Metro</option>
                        <!-- Provinsi Kepulauan Riau -->
                        <option value="Batam">Batam</option>
                        <option value="Tanjungpinang">Tanjungpinang</option>
                        <!-- Provinsi Jakarta -->
                        <option value="Jakarta">Jakarta</option>
                        <option value="Jakarta Pusat">Jakarta Pusat</option>
                        <option value="Jakarta Utara">Jakarta Utara</option>
                        <option value="Jakarta Timur">Jakarta Timur</option>
                        <option value="Jakarta Barat">Jakarta Barat</option>
                        <option value="Jakarta Selatan">Jakarta Selatan</option>
                        <!-- Provinsi Jawa Barat -->
                        <option value="Bandung">Bandung</option>
                        <option value="Bekasi">Bekasi</option>
                        <option value="Depok">Depok</option>
                        <option value="Cimahi">Cimahi</option>
                        <option value="Bogor">Bogor</option>
                        <!-- Provinsi Jawa Tengah -->
                        <option value="Semarang">Semarang</option>
                        <option value="Solo">Solo (Surakarta)</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                        <option value="Magelang">Magelang</option>
                        <option value="Salatiga">Salatiga</option>
                        <!-- Provinsi DI Yogyakarta -->
                        <option value="Yogyakarta">Yogyakarta</option>
                        <!-- Provinsi Jawa Timur -->
                        <option value="Surabaya">Surabaya</option>
                        <option value="Malang">Malang</option>
                        <option value="Kediri">Kediri</option>
                        <option value="Probolinggo">Probolinggo</option>
                        <option value="Blitar">Blitar</option>
                        <!-- Provinsi Bali -->
                        <option value="Denpasar">Denpasar</option>
                        <!-- Provinsi Nusa Tenggara Barat -->
                        <option value="Mataram">Mataram</option>
                        <option value="Bima">Bima</option>
                        <!-- Provinsi Nusa Tenggara Timur -->
                        <option value="Kupang">Kupang</option>
                        <!-- Provinsi Kalimantan Barat -->
                        <option value="Pontianak">Pontianak</option>
                        <!-- Provinsi Kalimantan Tengah -->
                        <option value="Palangkaraya">Palangkaraya</option>
                        <!-- Provinsi Kalimantan Selatan -->
                        <option value="Banjarmasin">Banjarmasin</option>
                        <option value="Banjarbaru">Banjarbaru</option>
                        <!-- Provinsi Kalimantan Timur -->
                        <option value="Samarinda">Samarinda</option>
                        <option value="Balikpapan">Balikpapan</option>
                        <!-- Provinsi Kalimantan Utara -->
                        <option value="Tarakan">Tarakan</option>
                        <!-- Provinsi Sulawesi Utara -->
                        <option value="Manado">Manado</option>
                        <option value="Bitung">Bitung</option>
                        <!-- Provinsi Sulawesi Tengah -->
                        <option value="Palu">Palu</option>
                        <!-- Provinsi Sulawesi Selatan -->
                        <option value="Makassar">Makassar</option>
                        <option value="Parepare">Parepare</option>
                        <option value="Palopo">Palopo</option>
                        <!-- Provinsi Sulawesi Tenggara -->
                        <option value="Kendari">Kendari</option>
                        <option value="Baubau">Baubau</option>
                        <!-- Provinsi Gorontalo -->
                        <option value="Gorontalo">Gorontalo</option>
                        <!-- Provinsi Maluku -->
                        <option value="Ambon">Ambon</option>
                        <!-- Provinsi Maluku Utara -->
                        <option value="Ternate">Ternate</option>
                        <option value="Tidore">Tidore</option>
                        <!-- Provinsi Papua -->
                        <option value="Jayapura">Jayapura</option>
                        <option value="Sorong">Sorong</option>
                        <!-- Provinsi Papua Barat -->
                        <option value="Manokwari">Manokwari</option>
                        <option value="Raja Ampat">Raja Ampat</option>
                        <!-- Provinsi Sulawesi Barat -->
                        <option value="Mamuju">Mamuju</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_berangkat" class="form-label fw-bold">Tanggal Berangkat</label>
                    <input
                        type="datetime-local"
                        class="form-control"
                        id="tanggal_berangkat"
                        name="tanggal_berangkat"
                        required>
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
                        required>
                    <small id="formattedHarga" class="text-muted"></small>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label fw-bold">Upload Gambar Tiket</label>
                    <input
                        type="file"
                        class="form-control"
                        id="gambar"
                        name="gambar"
                        accept="image/*"
                        required>
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
        max-width: 600px;
        /* Atur lebar maksimal lebih besar */
        margin: 30px auto;
        /* Rata tengah dengan jarak lebih besar */
        padding: 25px;
        /* Spasi dalam */
        border-radius: 15px;
        /* Sudut lebih besar */
    }

    .card-body {
        padding: 20px;
        /* Spasi dalam konten */
    }

    .form-control {
        font-size: 16px;
        /* Ukuran font lebih besar */
        padding: 10px;
        /* Padding lebih nyaman */
    }

    .btn-primary {
        font-size: 16px;
        /* Ukuran teks lebih besar */
        padding: 12px 25px;
        /* Sesuaikan padding tombol */
        border-radius: 10px;
        /* Sudut tombol */
        transition: all 0.3s ease;
        /* Animasi tombol */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Efek hover */
        transform: scale(1.05);
        /* Efek zoom */
    }

    /* Customize the appearance of the dropdown */
    .form-control {
        background-color: #f9fafb;
        /* Light background color */
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        /* Blue border on focus */
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        /* Blue shadow */
    }

    /* Add some padding and spacing */
    .mb-4 {
        margin-bottom: 1.5rem;
    }

    h1 {
        font-size: 1.875rem;
        /* Adjust title font size */
    }

    button {
        font-weight: bold;
    }

    /* Button Hover */
    button:hover {
        background-color: #2563eb;
        /* Darker blue on hover */
    }
</style>
<script>
    function formatRupiah(angka, prefix = "Rp") {
        // Hapus karakter non-angka
        const numberString = angka.replace(/[^,\d]/g, "").toString();
        const split = numberString.split(",");
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // Tambahkan titik pemisah ribuan
        if (ribuan) {
            const separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        // Tambahkan koma untuk desimal
        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;

        // Tambahkan prefix
        return prefix + rupiah;
    }

    // Ambil elemen input dan elemen untuk tampilan format Rupiah
    const inputanHarga = document.getElementById("harga");
    const formattedHarga = document.getElementById("formattedHarga");

    // Event listener untuk memformat angka di bawah input
    inputanHarga.addEventListener("input", function() {
        let angka = inputanHarga.value; // Ambil nilai input
        // Jika input kosong, jangan tampilkan format
        if (!angka) {
            formattedHarga.textContent = "";
            return;
        }
        // Format angka menjadi Rupiah dan tampilkan
        formattedHarga.textContent = formatRupiah(angka);
    });
</script>

<?php
require 'templates/footer.php';
?>