<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Tiket Pesawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Custom Navbar */
        .navbar-custom {
            background: linear-gradient(90deg, #0066cc, #3399ff);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transition: background 0.4s ease, padding 0.3s ease, font-size 0.3s ease;
            padding: 0.3rem 0.8rem;
            font-size: 1rem;
        }

        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: white !important;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .navbar-custom .nav-link {
            color: white !important;
            font-weight: 500;
            transition: color 0.3s ease, background 0.3s ease;
            border-radius: 8px;
            padding: 4px 10px;
        }

        .navbar-custom .nav-item {
            margin-left: 0.8rem;
        }

        .navbar-custom .btn-light {
            color: #0066cc;
            background-color: white;
            border-color: #0066cc;
            border-radius: 8px;
            padding: 6px 12px;
            font-weight: 900px;
        }

        .navbar-custom .btn-light:hover {
            background-color: #0066cc;
            color: white;
            border-color: #0066cc;
            transform: scale(1.1); /* Scale effect */
            transition: transform 0.3s ease;
        }

        @media (max-width: 991px) {
            .navbar-custom .nav-item {
                margin-left: 0;
                margin-top: 0.5rem;
            }
        }

        /* Navbar Toggler */
        .navbar-toggler {
            border-color: #0066cc;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler-icon {
            background-color: #0066cc;
            width: 18px;
            height: 13px;
        }

        /* Active link transition */
        .nav-link.active {
            background-color: #3399ff !important;
            color: white !important;
            transform: scale(1.1);
            transition: background-color 0.3s, transform 0.3s;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">TiketPesawat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cek Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bantuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light nav-link px-3 py-2" href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Script for active link toggle and interactive animations -->
    <script>
        // Toggle active class for links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(link => link.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add hover effect for login button
        const loginButton = document.querySelector('.btn-light');
        loginButton.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });

        loginButton.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });

        // Scroll event for navbar transition
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 100) {
                navbar.style.backgroundColor = 'rgba(0, 102, 204, 0.9)';
                navbar.style.padding = '0.2rem 0.8rem';
                navbar.style.fontSize = '0.9rem';
            } else {
                navbar.style.backgroundColor = 'transparent';
                navbar.style.padding = '0.3rem 0.8rem';
                navbar.style.fontSize = '1rem';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>
