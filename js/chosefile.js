function previewImage() {
    const file = document.getElementById("gambar").files[0]; // Ambil file yang dipilih
    const previewContainer = document.getElementById("imagePreview");

    // Pastikan ada file yang dipilih
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Tampilkan gambar yang telah dipilih di bawah input
            previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid" style="max-width: 300px; height: auto;">`;
        }
        
        reader.readAsDataURL(file);
    } else {
        previewContainer.innerHTML = ''; // Jika tidak ada gambar, hapus preview
    }
} 