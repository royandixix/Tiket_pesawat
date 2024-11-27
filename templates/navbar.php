
<?php 
require 'header.php';
?>
    <style>
        /* Navbar Customization */
        .navbar-custom {
            background-color: #ffffff; /* White background */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for the navbar */
            padding: 0.5rem 1rem;
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
            color: #0066cc; /* Blue color for the brand */
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .navbar-custom .navbar-brand img {
            width: 40px; /* Set image size */
            height: 40px;
            margin-right: 10px;
            object-fit: cover;
        }

        .navbar-custom .navbar-brand:hover {
            color: #3399ff; /* Lighter blue on hover */
        }

        .navbar-custom .nav-link {
            color: #333; /* Dark color for text */
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #0066cc; /* Blue on hover */
            text-decoration: underline; /* Underline on hover for better UX */
        }

        .navbar-custom .navbar-toggler {
            border-color: #0066cc;
        }

        .navbar-custom .navbar-toggler-icon {
            background-color: #0066cc;
        }

        .navbar-nav .nav-item {
            margin-left: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="img/logo/logo.png" alt="Logo Tiket Pesawat" style="width: 130px;">
                TiketPesawat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pemesanan.php">Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cek Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahTiket.php">Tambah Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahdata.php">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
