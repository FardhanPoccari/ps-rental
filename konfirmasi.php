<?php
require_once __DIR__ . '/config.php';
$page_title = 'Konfirmasi';
$active_nav = 'bookings';

$terakhir = $_SESSION['booking_terakhir'] ?? null;
$riwayat = $_SESSION['riwayat'] ?? [];

$status_color = [
    'Terjadwal' => 'bg-secondary-fixed text-on-secondary-fixed',
    'Selesai' => 'bg-surface-container-high text-on-surface-variant',
    'Dibatalkan' => 'bg-error-container text-on-error-container',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body class="bg-surface-container-low text-on-background">
<div class="app-shell">
    <?php include __DIR__ . '/includes/topbar.php'; ?>

    <main class="app-main">
        <?php if ($terakhir): ?>
        <!-- Success Banner -->
        <div class="bg-primary py-stack-xl flex flex-col items-center justify-center text-on-primary gap-stack-md px-margin-mobile">
            <div class="w-20 h-20 rounded-full bg-on-primary/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-[48px] text-on-primary">check_circle</span>
            </div>
            <h1 class="text-headline-lg text-center">Booking Berhasil!</h1>
            <p class="text-body-md opacity-90 text-center max-w-md">
                Terima kasih! Pesanan Anda telah dikonfirmasi. Instruksi pembayaran dikirim ke WhatsApp Anda.
            </p>
        </div>

        <div class="p-margin-mobile">
            <div class="flex flex-col gap-stack-md mb-stack-lg">
                <div class="flex justify-between items-center border-b border-outline-variant pb-2">
                    <span class="text-label-md text-secondary">Kode Booking</span>
                    <span class="text-body-md font-bold text-primary"><?php echo htmlspecialchars($terakhir['kode']); ?></span>
                </div>
                <div class="flex justify-between items-center border-b border-outline-variant pb-2">
                    <span class="text-label-md text-secondary">Waktu Transaksi</span>
                    <span class="text-body-md text-on-surface"><?php echo htmlspecialchars($terakhir['waktu_transaksi']); ?></span>
                </div>
                <div class="flex justify-between items-center border-b border-outline-variant pb-2">
                    <span class="text-label-md text-secondary">Metode Bayar</span>
                    <span class="text-body-md text-on-surface"><?php echo htmlspecialchars($terakhir['metode']); ?></span>
                </div>
            </div>

            <div class="flex gap-4 bg-surface-container-low p-4 rounded-lg mb-stack-lg">
                <div class="w-16 h-16 bg-surface-container-high rounded-lg overflow-hidden flex-shrink-0">
                    <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($terakhir['unit_foto']); ?>" alt="">
                </div>
                <div>
                    <h3 class="text-body-md font-bold text-primary"><?php echo htmlspecialchars($terakhir['unit_nama']); ?></h3>
                    <div class="flex items-center gap-2 text-secondary mt-1">
                        <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                        <span class="text-[12px]"><?php echo date('d M Y', strtotime($terakhir['tanggal'])); ?>, <?php echo htmlspecialchars($terakhir['jam_mulai']); ?> · <?php echo $terakhir['durasi']; ?> jam</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-baseline mb-stack-lg pt-2 border-t border-outline-variant">
                <span class="text-headline-md text-primary" style="font-size:18px;">Total Dibayar</span>
                <span class="text-headline-md text-primary" style="font-size:20px;"><?php echo format_rupiah($terakhir['total']); ?></span>
            </div>

            <div class="flex flex-col gap-3">
                <a href="index.php" class="bg-primary text-on-primary py-3.5 rounded-lg text-label-md text-center hover:opacity-90">Kembali ke Beranda</a>
                <button onclick="window.print()" class="bg-transparent border border-outline-variant text-primary py-3.5 rounded-lg text-label-md hover:bg-surface-container-low">Unduh / Cetak Bukti</button>
            </div>
        </div>
        <?php endif; ?>

        <!-- Riwayat -->
        <div class="px-margin-mobile pb-stack-lg <?php echo $terakhir ? 'pt-stack-lg border-t border-outline-variant' : 'pt-stack-lg'; ?>">
            <h2 class="text-headline-md text-primary mb-stack-md" style="font-size:18px;">Riwayat Booking Saya</h2>

            <?php if (empty($riwayat)): ?>
                <div class="text-center py-stack-xl text-secondary">
                    <span class="material-symbols-outlined text-[40px] opacity-40">event_busy</span>
                    <p class="mt-2 text-body-sm">Belum ada riwayat booking.</p>
                    <a href="katalog.php" class="inline-block mt-4 text-primary text-label-sm underline">Mulai booking sekarang</a>
                </div>
            <?php else: ?>
                <div class="flex flex-col gap-3">
                    <?php foreach ($riwayat as $r): ?>
                    <div class="bg-white border border-outline-variant rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-label-sm font-bold text-primary"><?php echo htmlspecialchars($r['kode']); ?></span>
                            <span class="text-[10px] px-2 py-0.5 rounded-full <?php echo $status_color[$r['status']] ?? 'bg-surface-container-high'; ?>"><?php echo htmlspecialchars($r['status']); ?></span>
                        </div>
                        <p class="text-body-sm font-bold text-on-surface"><?php echo htmlspecialchars($r['unit_nama']); ?></p>
                        <p class="text-[12px] text-secondary"><?php echo date('d M Y', strtotime($r['tanggal'])); ?>, <?php echo htmlspecialchars($r['jam_mulai']); ?> · <?php echo $r['durasi']; ?> jam</p>
                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-outline-variant">
                            <span class="text-[12px] text-secondary">Total</span>
                            <span class="text-body-sm font-bold text-primary"><?php echo format_rupiah($r['total']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <?php include __DIR__ . '/includes/bottomnav.php'; ?>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
