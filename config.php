<?php
/**
 * config.php
 * Dipanggil di paling atas setiap halaman.
 * Menyalakan session PHP (dipakai untuk menyimpan status login,
 * data booking sementara, dan riwayat booking) serta memuat data unit.
 */
session_start();

require_once __DIR__ . '/data/units.php';

// Inisialisasi riwayat booking di session jika belum ada
if (!isset($_SESSION['riwayat'])) {
    $_SESSION['riwayat'] = [];
}

// Helper: cek apakah user sudah login
function is_logged_in() {
    return isset($_SESSION['user']);
}

// Helper: generate kode booking unik
function generate_kode_booking() {
    return 'PSR-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
}
