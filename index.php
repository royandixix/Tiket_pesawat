<?php
require 'templates/header.php';
require 'templates/navbar.php';
?>

<div class="mt-5 pt-4"> <!-- Menambahkan padding-top -->
    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang di TiketPesawat</h1>
        <p class="text-center">Temukan dan pesan tiket penerbangan dengan mudah!</p>

        <p class="lead mb-4 text-center wow fadeIn" data-wow-duration="5s">
            Hai, apa kabar? Siap untuk traveling atau mau jalan ke mana saja? Ayo kunjungi website kami, terjamin cepat untuk pemesanan tiketnya.
        </p>

        <!-- Teks tambahan untuk memberi informasi lebih -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4 text-left wow fadeInLeft" data-wow-duration="1s">Kenapa Memilih Kami?</h2>
                <p class="lead text-left wow fadeInLeft" data-wow-duration="1.5s">
                    Kami menyediakan layanan pemesanan tiket pesawat yang cepat, mudah, dan aman. Dengan berbagai pilihan maskapai dan harga terbaik, Anda dapat merencanakan perjalanan Anda dengan mudah dan nyaman. Temukan penawaran eksklusif hanya di website kami!
                </p>
                <p class="text-left wow fadeInLeft" data-wow-duration="2s">
                    Tidak hanya tiket pesawat, kami juga menyediakan berbagai layanan perjalanan lainnya, seperti hotel, paket liburan, dan banyak lagi. Jadi, tunggu apa lagi? Segera rencanakan liburan Anda bersama kami!
                </p>
            </div>
        </div>
    </div>

    <!-- Card untuk menampilkan gambar dan teks -->
    <div class="card mb-5 shadow-lg rounded wow fadeInUp">
        <img src="img/pesawat/airplane-4885803_960_720.jpg" class="card-img-top" alt="Pemandangan indah untuk traveling">
        <div class="card-body">
            <h5 class="card-title">Traveling Murah</h5>
            <p class="card-text">Rencanakan perjalanan Anda dengan harga terbaik dan kenyamanan maksimal. Nikmati liburan dengan penawaran eksklusif kami.</p>
            <a href="pemesanan.php" class="btn btn-primary">Ayo Buruan Pesan</a>
        </div>
    </div>

    <!-- Parallax Section -->
    <div class="parallax"></div>

    <!-- Testimonials Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Testimoni Pengguna</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <p class="card-text">"Layanan pemesanan tiket sangat mudah dan cepat. Prosesnya sangat praktis dan saya mendapatkan harga yang sangat terjangkau!"</p>
                        <h5 class="card-title">Rina S.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <p class="card-text">"Saya sangat puas dengan kualitas layanan dan kemudahan pemesanan tiket di TiketPesawat. Pasti akan menggunakan layanan ini lagi!"</p>
                        <h5 class="card-title">Budi T.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <p class="card-text">"TiketPesawat memudahkan saya dalam merencanakan perjalanan liburan saya, dengan penawaran menarik setiap saat!"</p>
                        <h5 class="card-title">Lina H.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'templates/footer.php';
?>

<style>
    /* Font dan Warna Dasar */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f7fa;
        color: #333;
        padding-top: 0;
    }

    /* Efek Bayangan pada Teks */
    h1,
    h2,
    p {
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }

    /* Warna Gradasi untuk Teks */
    .lead {
        background: linear-gradient(90deg, #6a11cb, #2575fc);
        -webkit-background-clip: text;
        color: transparent;
    }

    /* Transisi Halus */
    h2,
    .card,
    .btn-primary {
        transition: all 0.3s ease;
    }

    /* Efek Hover */
    h2:hover,
    .card:hover,
    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    /* Desain Card */
    .card {
        border: none;
        margin: 0 auto;
        max-width: 900px;
        border-radius: 15px;
    }

    /* Gambar Responsif */
    .card-img-top {
        max-height: 250px;
        object-fit: cover;
        width: 100%;
        margin: 0 auto;
    }

    /* Efek Parallax */
    .parallax {
        background-image: url('img/pesawat/airbus-8607152_960_720.jpg');
        min-height: 400px;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    }

    /* Desain Tautan */
    a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease-in-out;
    }

    a:hover {
        color: #0056b3;
    }

    /* Responsif */
    @media (max-width: 576px) {
        .container {
            padding: 15px;
        }
    }
</style>


<!-- JavaScript untuk efek interaktif -->
<script>
    // Smooth scrolling untuk semua tautan internal
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            const target = document.querySelector(this.getAttribute('href'));

            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 100, // Offset untuk navbar
                    behavior: 'smooth'
                });
            }
        });
    });
</script>