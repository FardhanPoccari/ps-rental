<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: katalog.php');
    exit;
}

$unit_id = (int)($_POST['unit_id'] ?? 0);
$tanggal = $_POST['tanggal'] ?? '';
$jam_mulai = $_POST['jam_mulai'] ?? '';
$durasi = max(1, (int)($_POST['durasi'] ?? 1));

$unit = get_unit($unit_id);

if (!$unit || $tanggal === '' || $jam_mulai === '') {
    header('Location: detail.php?id=' . $unit_id . '&error=1');
    exit;
}

$subtotal = $unit['harga_per_jam'] * $durasi;
$biaya_admin = 2000;
$total = $subtotal + $biaya_admin;

// Simpan data booking sementara di session, dipakai di halaman checkout & konfirmasi
$_SESSION['booking'] = [
    'unit_id' => $unit['id'],
    'unit_nama' => $unit['nama'],
    'unit_foto' => $unit['foto'],
    'tanggal' => $tanggal,
    'jam_mulai' => $jam_mulai,
    'durasi' => $durasi,
    'harga_per_jam' => $unit['harga_per_jam'],
    'subtotal' => $subtotal,
    'biaya_admin' => $biaya_admin,
    'total' => $total,
];

header('Location: checkout.php');
exit;
