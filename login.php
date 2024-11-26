<?php
// Inisialisasi pesan
$loginMessage = '';
$registerMessage = '';

// Proses Login
if (isset($_POST['login_email']) && isset($_POST['login_password'])) {
    require 'config/fungsi.php'; // Pastikan koneksi database tersedia
    $email = mysqli_real_escape_string($db, $_POST['login_email']);
    $password = $_POST['login_password'];

    $query = "SELECT * FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['kata_sandi'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nama'];

            // Redirect ke index.php setelah login berhasil
            header('Location: index.php');
            exit; // Hentikan eksekusi setelah redirect
        } else {
            // Pesan jika kata sandi salah
            $loginMessage = 'Kata sandi salah!';
        }
    } else {
        // Pesan jika email tidak ditemukan
        $loginMessage = 'Email tidak ditemukan!';
    }
}

// Proses Register
if (isset($_POST['register_nama']) && isset($_POST['register_email']) && isset($_POST['register_password'])) {
    require 'config/fungsi.php'; // Pastikan koneksi database tersedia
    $nama = mysqli_real_escape_string($db, $_POST['register_nama']);
    $email = mysqli_real_escape_string($db, $_POST['register_email']);
    $password = password_hash($_POST['register_password'], PASSWORD_DEFAULT);

    // Periksa apakah email sudah terdaftar
    $query = "SELECT * FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Pesan jika email sudah terdaftar
        $registerMessage = 'Email sudah terdaftar!';
    } else {
        // Simpan pengguna baru
        $query = "INSERT INTO pengguna (nama, email, kata_sandi) VALUES ('$nama', '$email', '$password')";
        if (mysqli_query($db, $query)) {
            // Pesan jika pendaftaran berhasil
            $registerMessage = 'Pendaftaran berhasil! Silakan login.';
        } else {
            // Pesan jika terjadi kesalahan saat mendaftar
            $registerMessage = 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.';
        }
    }
}

// Header dan koneksi database
require 'templates/header.php';
?>

<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/modal.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background: url('img/pexels-reto-burkler-640438-1443894.jpg') no-repeat center center/cover;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    .card {
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        border-radius: 15px;
        padding: 20px;
    }

    h2 {
        font-weight: 600;
        color: #ffffff;
        text-shadow: 1px 1px 5px rgba(255, 255, 255, 0.2);
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #003d80);
        transform: scale(1.05);
    }

    p {
        color: #ffffff;
        font-size: 14px;
    }

    a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease-in-out;
    }

    a:hover {
        color: #0056b3;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">
                Selamat Datang di <span style="color: #efefef;">Web Pemesanan Tiket Pesawat</span>
            </h2>
            <div class="card">
                <div class="card-body">
                    <form id="loginForm" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="loginEmail" name="login_email" placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="loginPassword" name="login_password" placeholder="Masukkan kata sandi Anda" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Masuk</button>
                    </form>
                </div>
            </div>

            <p class="text-center mt-3">
                Belum memiliki akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>

<!-- Modal Pendaftaran -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="registerName" name="register_nama" placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Masukkan Email</label>
                        <input type="email" class="form-control" id="registerEmail" name="register_email" placeholder="Masukkan email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="registerPassword" name="register_password" placeholder="Masukkan kata sandi Anda" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle form submission with AJAX for login
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "config/fungsi.php", // File PHP yang menangani login
                data: formData,
                success: function(response) {
                    if (response.status === "login_success") {
                        Swal.fire({
                            icon: 'info',
                            title: 'Login Information',
                            text: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                }
            });
        });

        // Handle form submission with AJAX for register
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "config/fungsi.php", // File PHP yang menangani register
                data: formData,
                success: function(response) {
                    if (response.status === "register_success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Success',
                            text: response.message
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                }
            });
        });
    });
</script>

<?php require 'templates/footer.php'; ?>