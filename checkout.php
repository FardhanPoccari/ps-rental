<?php
require_once __DIR__ . '/config.php';
$page_title = 'Checkout';
$active_nav = 'bookings';
$show_back = true;

if (empty($_SESSION['booking'])) {
    header('Location: katalog.php');
    exit;
}
$booking = $_SESSION['booking'];
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body class="bg-background text-on-background">
<div class="app-shell">
    <?php include __DIR__ . '/includes/topbar.php'; ?>

    <main class="app-main px-margin-mobile py-stack-lg">
        <!-- Stepper -->
        <div class="flex justify-center mb-stack-lg">
            <div class="flex items-center w-full max-w-xs">
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center text-label-sm">1</div>
                    <span class="text-[10px] mt-1 text-primary font-bold">Jadwal</span>
                </div>
                <div class="flex-1 h-[1px] bg-primary mx-2 mt-[-18px]"></div>
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center text-label-sm">2</div>
                    <span class="text-[10px] mt-1 text-primary font-bold">Bayar</span>
                </div>
                <div class="flex-1 h-[1px] bg-outline-variant mx-2 mt-[-18px]"></div>
                <div class="flex flex-col items-center opacity-50">
                    <div class="w-8 h-8 rounded-full bg-surface-container-highest text-on-surface flex items-center justify-center text-label-sm">3</div>
                    <span class="text-[10px] mt-1">Selesai</span>
                </div>
            </div>
        </div>

        <?php if ($error === '1'): ?>
        <div class="mb-4 p-3 rounded-lg bg-error-container text-on-error-container text-body-sm">
            Mohon lengkapi semua data sebelum melanjutkan.
        </div>
        <?php endif; ?>

        <form action="checkout_process.php" method="post" class="space-y-gutter">
            <!-- Data Pemesan -->
            <section class="bg-surface-container-lowest border border-outline-variant p-4 rounded-lg">
                <h2 class="text-body-lg font-bold text-on-background mb-4">Data Pemesan</h2>
                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="block text-label-sm text-on-surface-variant">Nama Lengkap</label>
                        <input name="nama" required class="w-full h-11 px-3 bg-white border border-outline-variant rounded-lg focus:outline-none focus:border-primary text-body-sm"
                            placeholder="Nama sesuai KTP" value="<?php echo htmlspecialchars($_SESSION['user']['nama'] ?? ''); ?>">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-label-sm text-on-surface-variant">Nomor WhatsApp</label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-outline-variant bg-surface-container-low text-on-surface-variant text-label-sm">+62</span>
                            <input name="whatsapp" required type="tel" class="flex-1 h-11 px-3 bg-white border border-outline-variant rounded-r-lg focus:outline-none focus:border-primary text-body-sm" placeholder="812-3456-7890">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Metode Pembayaran -->
            <section class="bg-surface-container-lowest border border-outline-variant p-4 rounded-lg">
                <h2 class="text-body-lg font-bold text-on-background mb-4">Metode Pembayaran</h2>
                <div class="space-y-3" id="paymentGroup">
                    <label class="relative flex items-center p-3 border-2 border-primary rounded-xl cursor-pointer bg-secondary-fixed/10 payment-option">
                        <input checked class="hidden" name="metode" value="transfer" type="radio"/>
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg border border-outline-variant flex items-center justify-center mr-3">
                            <span class="material-symbols-outlined text-primary text-[20px]">account_balance</span>
                        </div>
                        <div class="flex-1">
                            <span class="block text-label-sm font-bold text-primary">Transfer Bank</span>
                            <span class="text-[10px] text-on-secondary-container">BCA, Mandiri, BNI</span>
                        </div>
                        <span class="material-symbols-outlined text-primary text-[18px] check-icon" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </label>
                    <label class="relative flex items-center p-3 border border-outline-variant rounded-xl cursor-pointer hover:border-primary transition-all payment-option">
                        <input class="hidden" name="metode" value="ewallet" type="radio"/>
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg border border-outline-variant flex items-center justify-center mr-3">
                            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">account_balance_wallet</span>
                        </div>
                        <div class="flex-1">
                            <span class="block text-label-sm font-bold text-on-surface">Dompet Digital</span>
                            <span class="text-[10px] text-on-surface-variant">GoPay, OVO, Dana</span>
                        </div>
                    </label>
                    <label class="relative flex items-center p-3 border border-outline-variant rounded-xl cursor-pointer hover:border-primary transition-all payment-option">
                        <input class="hidden" name="metode" value="cash" type="radio"/>
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg border border-outline-variant flex items-center justify-center mr-3">
                            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">payments</span>
                        </div>
                        <div class="flex-1">
                            <span class="block text-label-sm font-bold text-on-surface">Bayar di Tempat</span>
                            <span class="text-[10px] text-on-surface-variant">Cash saat unit diantar</span>
                        </div>
                    </label>
                </div>
                <div class="mt-4 p-3 bg-surface-container rounded-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary text-[18px]">info</span>
                    <p class="text-[11px] leading-relaxed text-on-secondary-container">
                        Instruksi pembayaran akan dikirim ke nomor WhatsApp Anda setelah booking dikonfirmasi.
                    </p>
                </div>
            </section>

            <!-- Ringkasan -->
            <section class="bg-surface-container-lowest border border-outline-variant rounded-lg overflow-hidden">
                <div class="p-4 border-b border-outline-variant">
                    <h3 class="text-[10px] font-bold text-primary tracking-widest uppercase mb-3">Ringkasan Pesanan</h3>
                    <div class="flex gap-3 items-start">
                        <div class="w-16 h-16 bg-surface-container-low rounded-lg overflow-hidden flex-shrink-0">
                            <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($booking['unit_foto']); ?>" alt="">
                        </div>
                        <div>
                            <span class="text-[10px] text-secondary block">Gaming</span>
                            <h4 class="text-body-sm font-bold text-on-surface"><?php echo htmlspecialchars($booking['unit_nama']); ?></h4>
                            <span class="text-[10px] text-on-surface-variant">
                                <?php echo date('d M Y', strtotime($booking['tanggal'])); ?>, <?php echo htmlspecialchars($booking['jam_mulai']); ?> · <?php echo $booking['durasi']; ?> jam
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-4 space-y-2">
                    <div class="flex justify-between text-[12px] text-on-surface-variant">
                        <span>Sewa (<?php echo $booking['durasi']; ?> jam)</span>
                        <span><?php echo format_rupiah($booking['subtotal']); ?></span>
                    </div>
                    <div class="flex justify-between text-[12px] text-on-surface-variant">
                        <span>Biaya Admin</span>
                        <span><?php echo format_rupiah($booking['biaya_admin']); ?></span>
                    </div>
                    <div class="pt-2 border-t border-outline-variant flex justify-between items-baseline">
                        <span class="text-label-sm font-bold text-on-surface">Total</span>
                        <span class="text-body-lg font-bold text-primary"><?php echo format_rupiah($booking['total']); ?></span>
                    </div>
                </div>
                <div class="p-4 pt-0">
                    <button type="submit" class="w-full h-12 bg-primary text-on-primary rounded-lg font-bold text-label-sm hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                        KONFIRMASI &amp; BAYAR
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                    <p class="text-center text-[10px] text-on-surface-variant mt-3 leading-tight px-4">
                        Dengan konfirmasi, Anda menyetujui <a class="underline" href="#">Syarat</a> dan <a class="underline" href="#">Ketentuan</a> kami.
                    </p>
                </div>
            </section>
        </form>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <?php include __DIR__ . '/includes/bottomnav.php'; ?>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
