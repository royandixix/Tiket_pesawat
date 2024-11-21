<?php
require 'config/fungsi.php';
require 'templates/header.php';
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background: 
            url('img/pexels-reto-burkler-640438-1443894.jpg') no-repeat center center/cover;
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
        color: #333;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
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
        color: #555;
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
                Selamat Datang di <span style="color: #efefef ;">Web Pemesanan Tiket Pesawat</span>
            </h2>
            <div class="card">
                <div class="card-body">
                    <form action="process.php" method="POST">
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
                Belum memiliki akun?
                <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar di sini</a>
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
                <form action="register_process.php" method="POST">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="registerName" name="register_name" placeholder="Masukkan nama lengkap Anda" required>
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

<div class="name">
    <div class="value">
        <div class="name">  
            <div class="a"> </div>
        </div>
    </div>
</div>

</div>

<script>
    // Efek klik pada tombol
    document.querySelectorAll('.btn-primary').forEach(button => {
        button.addEventListener('click', (e) => {
            button.style.transform = 'scale(0.95)';
            setTimeout(() => {
                button.style.transform = 'scale(1)';
            }, 100);
        });
    });

    // Validasi form dengan umpan balik dinamis
    document.getElementById('loginEmail').addEventListener('input', function() {
        const emailInput = this;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value)) {
            emailInput.style.borderColor = 'red';
        } else {
            emailInput.style.borderColor = 'green';
        }
    });

    document.getElementById('loginPassword').addEventListener('input', function() {
        const passwordInput = this;
        if (passwordInput.value.length < 6) {
            passwordInput.style.borderColor = 'red';
        } else {
            passwordInput.style.borderColor = 'green';
        }
    });

    // Animasi modal
    const modal = document.getElementById('registerModal');
    modal.addEventListener('show.bs.modal', () => {
        modal.style.opacity = 0;
        setTimeout(() => {
            modal.style.opacity = 1;
            modal.style.transition = 'opacity 0.5s ease-in-out';
        }, 10);
    });

    // Notifikasi pop-up
    function showNotification(message, isSuccess) {
        const notification = document.createElement('div');
        notification.innerText = message;
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.right = '20px';
        notification.style.backgroundColor = isSuccess ? '#28a745' : '#dc3545';
        notification.style.color = '#fff';
        notification.style.padding = '10px 20px';
        notification.style.borderRadius = '5px';
        notification.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        notification.style.transition = 'opacity 0.5s ease-in-out';
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.style.opacity = 0;
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    // Contoh penggunaan notifikasi
    document.querySelector('form[action="process.php"]').addEventListener('submit', function(e) {
        e.preventDefault();
        showNotification('Login berhasil!', true);
    });
</script>

<?php
require 'templates/footer.php';
?>
