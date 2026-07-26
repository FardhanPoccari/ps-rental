<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['booking'])) {
    header('Location: katalog.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$whatsapp = trim($_POST['whatsapp'] ?? '');
$metode = $_POST['metode'] ?? '';

if ($nama === '' || $whatsapp === '' || $metode === '') {
    header('Location: checkout.php?error=1');
    exit;
}

$booking = $_SESSION['booking'];

$label_metode = [
    'transfer' => 'Transfer Bank',
    'ewallet'  => 'Dompet Digital',
    'cash'     => 'Bayar di Tempat',
];

$kode = generate_kode_booking();

$riwayat_item = [
    'kode' => $kode,
    'unit_nama' => $booking['unit_nama'],
    'unit_foto' => $booking['unit_foto'],
    'tanggal' => $booking['tanggal'],
    'jam_mulai' => $booking['jam_mulai'],
    'durasi' => $booking['durasi'],
    'total' => $booking['total'],
    'nama' => $nama,
    'whatsapp' => $whatsapp,
    'metode' => $label_metode[$metode] ?? $metode,
    'status' => 'Terjadwal',
    'waktu_transaksi' => date('d M Y, H:i') . ' WIB',
];

// Simpan ke riwayat (di depan array supaya booking terbaru muncul pertama)
array_unshift($_SESSION['riwayat'], $riwayat_item);

// Simpan booking terakhir yang dikonfirmasi untuk ditampilkan di halaman konfirmasi
$_SESSION['booking_terakhir'] = $riwayat_item;

// Bersihkan draft booking sementara
unset($_SESSION['booking']);

header('Location: konfirmasi.php');
exit;
