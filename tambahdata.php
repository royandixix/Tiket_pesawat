<?php require 'templates/header.php'; ?>
<?php require 'templates/navbar.php'; ?>

<style>
    
</style>

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">Form Input Jadwal Penerbangan</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="proses_input.php" method="POST">
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
                    <label for="harga" class="form-label fw-bold">Harga</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        class="form-control" 
                        id="harga" 
                        name="harga" 
                        placeholder="Masukkan harga tiket" 
                        required
                    >
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>
