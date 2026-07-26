<?php
require_once __DIR__ . '/config.php';
$page_title = 'Home';
$active_nav = 'home';
$units = get_units();
$populer = array_slice($units, 0, 3, true);
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
        <!-- Hero & Search -->
        <section class="px-margin-mobile pt-stack-lg pb-stack-lg text-center bg-surface-container-lowest">
            <div class="space-y-4">
                <h2 class="text-headline-md text-primary font-bold">Sewa PS4 &amp; PS5 Mudah, Cepat, Anti Ribet</h2>
                <p class="text-body-sm text-secondary">Rental konsol premium untuk sesi gaming santai maupun serius.</p>
                <form action="katalog.php" method="get" class="relative mt-6">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-secondary">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input name="cari" class="w-full pl-10 pr-24 py-3 bg-white border border-outline-variant rounded-lg focus:outline-none focus:border-primary transition-all text-body-sm shadow-sm" placeholder="Cari unit..." type="text"/>
                    <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 px-4 bg-primary text-on-primary text-label-sm rounded-md hover:bg-opacity-90 transition-all">
                        Cari
                    </button>
                </form>
            </div>
        </section>

        <!-- Unit Populer -->
        <section class="mt-stack-lg">
            <div class="px-margin-mobile flex justify-between items-end mb-stack-sm">
                <div>
                    <span class="text-[10px] font-label-sm text-secondary uppercase tracking-widest">Unit unggulan</span>
                    <h3 class="text-headline-md text-primary font-bold" style="font-size:20px;">Unit Populer</h3>
                </div>
                <a class="text-label-sm text-primary hover:underline flex items-center gap-1" href="katalog.php">
                    Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
            <div class="flex overflow-x-auto gap-4 px-margin-mobile hide-scrollbar pb-4 snap-x">
                <?php foreach ($populer as $u): ?>
                <div class="min-w-[240px] snap-start bg-white border border-outline-variant rounded-lg overflow-hidden">
                    <div class="aspect-video overflow-hidden bg-surface-container-low">
                        <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($u['foto']); ?>" alt="<?php echo htmlspecialchars($u['nama']); ?>">
                    </div>
                    <div class="p-4 space-y-2">
                        <div class="flex justify-between items-start">
                            <h4 class="text-body-md font-bold text-primary"><?php echo htmlspecialchars($u['nama']); ?></h4>
                            <span class="<?php echo $u['status'] === 'tersedia' ? 'bg-secondary-fixed text-on-secondary-fixed' : 'bg-surface-container-high text-on-surface-variant'; ?> text-[10px] px-2 py-0.5 rounded-full">
                                <?php echo $u['status'] === 'tersedia' ? 'Tersedia' : 'Dipakai'; ?>
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-secondary">
                            <span class="material-symbols-outlined text-[16px]">sports_esports</span>
                            <span class="text-[12px]"><?php echo $u['stik']; ?> Stik</span>
                        </div>
                        <div class="pt-3 border-t border-outline-variant flex justify-between items-center">
                            <div>
                                <p class="text-[10px] text-secondary">Mulai dari</p>
                                <p class="text-body-md font-bold text-primary"><?php echo format_rupiah($u['harga_per_jam']); ?><span class="text-[10px] font-normal">/jam</span></p>
                            </div>
                            <a href="detail.php?id=<?php echo $u['id']; ?>" class="bg-primary text-on-primary px-4 py-1.5 rounded-md text-[12px] font-label-md">Sewa</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Cara Booking -->
        <section class="mt-stack-lg px-margin-mobile py-stack-lg bg-surface-container-low rounded-xl mx-4">
            <div class="text-center mb-stack-md">
                <span class="text-[10px] font-label-sm text-secondary uppercase tracking-widest">Alur booking</span>
                <h3 class="text-headline-md text-primary font-bold" style="font-size:20px;">Langkah Mudah Booking</h3>
            </div>
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex-shrink-0 bg-white border border-outline-variant rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[20px]">search</span>
                    </div>
                    <div>
                        <h5 class="text-label-md font-bold text-primary">1. Pilih Unit</h5>
                        <p class="text-[12px] text-secondary">Jelajahi katalog dan pilih konsol favoritmu.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex-shrink-0 bg-white border border-outline-variant rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[20px]">calendar_month</span>
                    </div>
                    <div>
                        <h5 class="text-label-md font-bold text-primary">2. Pilih Jadwal</h5>
                        <p class="text-[12px] text-secondary">Tentukan tanggal, jam, dan durasi sewa.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex-shrink-0 bg-white border border-outline-variant rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[20px]">payments</span>
                    </div>
                    <div>
                        <h5 class="text-label-md font-bold text-primary">3. Bayar &amp; Main</h5>
                        <p class="text-[12px] text-secondary">Pembayaran instan, langsung siap main.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <?php include __DIR__ . '/includes/bottomnav.php'; ?>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
