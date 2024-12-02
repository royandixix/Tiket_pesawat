<?php
require 'config/fungsi.php';

// Hitung total pemesanan
$total_pemesanan = 0;
$count_query = "SELECT COUNT(*) AS total_pemesanan FROM pemesanan";
$count_result = mysqli_query($db, $count_query);
if ($count_result) {
    $total_pemesanan = mysqli_fetch_assoc($count_result)['total_pemesanan'] ?? 0;
}

// Ambil semua data dari tabel pemesanan
$pemesanan_query = "SELECT * FROM pemesanan";
$pemesanan_result = mysqli_query($db, $pemesanan_query);
$pemesanan_data = mysqli_fetch_all($pemesanan_result, MYSQLI_ASSOC) ?? [];
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
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Dashboard</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            Menu
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
                                                <h4>halo Admin</h4>
                                                <h4>Selemat Datang </h4>
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
                                        <div class="d-flex align-items-center p-3 border rounded shadow-sm bg-light">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-2 text-primary fw-bold">
                                                    <i class="fas fa-ticket-alt me-2"></i>Total Pemesanan

                                                </h4>
                                                <div class="mb-0">
                                                    <span class="badge bg-success me-2">
                                                        <i class="fas fa-ticket-alt me-1"></i>
                                                        <?php echo htmlspecialchars($total_pemesanan); ?>
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
                    </div>
                </div>
                <!-- Table Element -->
                <div class="card border-0">
                    <div class="card-header">
                        <h5 class="card-title text-primary  ">
                            Data Pemesanan Tiket Pesawat
                        </h5>
                    </div>
                    <a href="tambahdata2.php">
                        <button type="button" class="btn btn-primary ms-3 mt-3">
                            <i class="fas fa-plus"></i>&nbsp;Tambah Data
                        </button>

                    </a>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="d-none">ID</th>
                                    <th>Pengguna ID</th>
                                    <th>Nama</th>
                                    <th>Jadwal ID</th>
                                    <th>Maskapai</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Pemesanan</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($pemesanan_data)) : ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pemesanan_data as $row) : ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td class="d-none"><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['pengguna_id']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['jadwal_id']; ?></td>
                                            <td><?php echo $row['maskapai']; ?></td>
                                            <td><?php echo $row['jumlah_tiket']; ?></td>
                                            <td>Rp. <?php echo number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td><?php echo $row['tanggal_pemesanan']; ?></td>
                                            <td>
                                                <?php if ($row['gambar']) : ?>
                                                    <img src="<?php echo $row['gambar']; ?>" alt="Gambar" style="max-width: 50px; max-height: 50px;">
                                                <?php else : ?>
                                                    <span class="no-image">No image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11" class="text-center">Tidak ada data ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
</body>

</html>