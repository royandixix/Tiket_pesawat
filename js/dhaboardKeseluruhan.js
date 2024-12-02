// Fungsi untuk animasi angka
function animateCounter(elementId, targetValue, duration) {
    const element = document.getElementById(elementId);
    let startValue = 0;
    const increment = targetValue / (duration / 10);
    const interval = setInterval(() => {
        startValue += increment;
        if (startValue >= targetValue) {
            startValue = targetValue;
            clearInterval(interval);
        }
        element.textContent = Math.floor(startValue);
    }, 10);
}

// Eksekusi animasi setelah halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    const totalPemesanan = parseInt("<?php echo htmlspecialchars($total_pemesanan); ?>", 10);
    animateCounter("counter", totalPemesanan, 2000);
});
