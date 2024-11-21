<?php
require 'templates/header.php';
require 'templates/navbar.php';
?>

<div class="mt-5 pt-4"> <!-- Menambahkan padding-top -->
    <div class="container mt-5">
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
        <img src="img/pexels-reto-burkler-640438-1443894.jpg" class="card-img-top" alt="Traveling Image">
        <div class="card-body">
            <h5 class="card-title">Traveling Murah</h5>
            <p class="card-text">Rencanakan perjalanan Anda dengan harga terbaik dan kenyamanan maksimal. Nikmati liburan dengan penawaran eksklusif kami.</p>
            <a href="#" class="btn btn-primary">Pesan Sekarang</a>
        </div>
    </div>

    <div class="card mb-5 shadow-lg rounded wow fadeInUp">
        <img src="img/pexels-reto-burkler-640438-1443894.jpg" class="card-img-top" alt="Traveling Image">
        <div class="card-body">
            <h5 class="card-title">Traveling Murah</h5>
            <p class="card-text">Rencanakan perjalanan Anda dengan harga terbaik dan kenyamanan maksimal. Nikmati liburan dengan penawaran eksklusif kami.</p>
            <a href="#" class="btn btn-primary">Pesan Sekarang</a>
        </div>
    </div>
</div>

<?php
require 'templates/footer.php';
?>

<!-- Tambahkan CSS untuk mempercantik tulisan dan desain -->
<style>
    /* Menggunakan font dari Google Fonts */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f7fa;
        color: #333;
        padding-top: 0;
    }

    /* Efek Bayangan pada Teks */
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

    /* Animasi Fade In */
    .wow {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 1s ease, transform 1s ease;
    }

    .wow.fadeIn {
        opacity: 1;
        transform: translateY(0);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Menambahkan efek hover pada teks */
    h2:hover {
        color: #2575fc;
        transform: scale(1.05);
        transition: all 0.3s ease;
    }

    /* Card Design */
    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
        margin: 0 auto;
        max-width: 600px;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-weight: bold;
        color: #2575fc;
    }

    /* Tombol pada Card */
    .card .btn-primary {
        background-color: #2575fc;
        border-color: #2575fc;
        transition: background-color 0.3s ease;
    }

    .card .btn-primary:hover {
        background-color: #ff6f61;
        border-color: #ff6f61;
    }

    /* Menambahkan padding dan margin yang lebih baik untuk responsivitas */
    .container {
        padding: 30px;
    }

    /* Memastikan gambar dalam card tidak terlalu besar dan responsif */
    .card-img-top {
        max-height: 250px;
        object-fit: cover;
        width: 100%;
        margin: 0 auto;
    }

    /* Desain gambar agar responsif di desktop */
    @media (min-width: 992px) {
        .card-img-top {
            max-height: 300px;
        }
    }

    /* Responsive Media Queries untuk Mobile */
    @media (max-width: 576px) {
        .container {
            padding: 15px;
        }

        .card {
            max-width: 100%;
        }

        .wow {
            animation-duration: 1s;
        }
    }

    /* Shadow effect for buttons */
    .btn-primary {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Transition effect for hover */
    .btn-primary:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
    }

    /* Parallax background effect */
    .parallax {
        background-image: url('img/pexels-reto-burkler-640438-1443894.jpg');
        min-height: 400px;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<!-- JavaScript untuk efek interaktif -->
<script>
    // Smooth Scroll untuk navigasi
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Hover effect on card buttons (active state)
    const buttons = document.querySelectorAll('.btn-primary');
    buttons.forEach(button => {
        button.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.1)';
        });
        button.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Menambahkan efek fade-in pada gambar dalam card
    document.querySelectorAll('.card-img-top').forEach((img) => {
        img.style.opacity = 0;
        img.style.transition = 'opacity 1.5s ease';
        window.addEventListener('scroll', function () {
            const rect = img.getBoundingClientRect();
            if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                img.style.opacity = 1;
            }
        });
    });

    // Menambahkan class 'fadeIn' untuk animasi pada elemen dengan class 'wow'
    document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll('.wow');
        elements.forEach((el) => {
            el.classList.add('fadeIn');
        });
    });
</script>
