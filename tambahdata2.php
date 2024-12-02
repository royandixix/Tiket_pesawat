<?php
require 'config/fungsi.php'; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $folder_tujuan = $_SERVER['DOCUMENT_ROOT'] . "/uploads/"; // Path absolut folder tujuan
    if (!is_dir($folder_tujuan)) {
        mkdir($folder_tujuan, 0777, true); // Buat folder jika belum ada
    }

    $gambar = $_FILES['gambar']['name'];
    $tmp_gambar = $_FILES['gambar']['tmp_name'];
    $file_extension = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $new_file_name = uniqid("img_", true) . "." . $file_extension; // Nama file unik
    $path_gambar = $folder_tujuan . $new_file_name;

    if (in_array($file_extension, $allowed_extensions)) {
        if (move_uploaded_file($tmp_gambar, $path_gambar)) {
            // Query insert data
            $sql = "INSERT INTO jadwal_penerbangan (maskapai, kota_asal, kota_tujuan, tanggal_berangkat, harga, gambar) 
                    VALUES ('$maskapai', '$kota_asal', '$kota_tujuan', '$tanggal_berangkat', '$harga', '$new_file_name')";

            if (mysqli_query($db, $sql)) {
                header("Location: dashboard.php"); // Redirect ke halaman sukses
                exit;
            } else {
                echo "Error saat menyimpan data ke database: " . mysqli_error($db);
            }
        } else {
            echo "Gagal mengupload gambar.";
        }
    } else {
        echo "Format file tidak didukung. Harap unggah file dengan format: jpg, jpeg, png, atau gif.";
    }
}
?>



<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard/css/style.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">CodzSword</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Dashboard
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="tambahdata2.php" class="sidebar-link">Tambah Data</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="dhasboard.php" class="sidebar-link">Detail Pemesanan</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Transakasi Pembayaran</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-header">
                        Multi Level Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Dropdown
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1"
                                    data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="dashboard/image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="#" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashboard, CodzSword</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="dashboard/image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                $ 78.00
                                            </h4>
                                            <p class="mb-2">
                                                Total Earnings
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title text-primary">
                                Data Pemesanan Tiket Pesawat
                            </h5>

                        </div>
                        <div class="card-body">
                            <form action="dashboard.php" method="POST" enctype="multipart/form-data">
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
                                        required
                                        onchange="previewImage()">
                                    <div id="imagePreview" class="mt-3"></div>
                                </div>
                                <div class="">
                                    <!-- Tombol Submit dengan ikon -->
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i>&nbsp;Submit
                                    </button>

                                    <!-- Tombol Kembali dengan ikon -->
                                    <a href="dhasboard.php">
                                        <button type="button" id="kembali" class="btn btn-dark ms-2">
                                            <i class="fas fa-arrow-left"></i>&nbsp;Kembali
                                        </button>
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dashboard/js/script.js"></script>
    <script src="js/script.js"></script>
    <script src="js/buttonKembali.js"></script>
    <script src="js/chosefile.js"></script>
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

</body>

</html>