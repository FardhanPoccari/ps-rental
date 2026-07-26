<?php
require_once __DIR__ . '/config.php';
$page_title = 'Katalog';
$active_nav = 'katalog';

$units = get_units();
$cari = trim($_GET['cari'] ?? '');
$tipe = $_GET['tipe'] ?? '';

if ($cari !== '') {
    $units = array_filter($units, fn($u) => stripos($u['nama'], $cari) !== false);
}
if ($tipe !== '') {
    $units = array_filter($units, fn($u) => $u['tipe'] === $tipe);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body class="bg-surface-container-low text-on-background">
<div class="app-shell">
    <?php include __DIR__ . '/includes/topbar.php'; ?>

    <main class="app-main px-margin-mobile py-stack-lg">
        <div class="mb-stack-lg">
            <h2 class="text-headline-lg text-primary" style="font-size:24px;">Katalog Unit PS</h2>
            <p class="text-body-sm text-secondary mt-1">Temukan konsol terbaik untuk sesi mainmu.</p>
        </div>

        <!-- Filter -->
        <form method="get" class="flex items-center gap-3 mb-stack-lg">
            <input type="text" name="cari" value="<?php echo htmlspecialchars($cari); ?>" placeholder="Cari nama unit..." class="flex-1 h-11 px-3 bg-white border border-outline-variant rounded-lg text-body-sm focus:outline-none focus:border-primary">
            <select name="tipe" onchange="this.form.submit()" class="h-11 px-3 bg-white border border-outline-variant rounded-lg text-body-sm">
                <option value="">Semua Tipe</option>
                <option value="PS4" <?php echo $tipe === 'PS4' ? 'selected' : ''; ?>>PS4</option>
                <option value="PS5" <?php echo $tipe === 'PS5' ? 'selected' : ''; ?>>PS5</option>
            </select>
            <button type="submit" class="h-11 px-4 bg-primary text-on-primary rounded-lg text-label-sm">Cari</button>
        </form>

        <?php if (empty($units)): ?>
            <div class="text-center py-stack-xl text-secondary">
                <span class="material-symbols-outlined text-[40px] opacity-40">search_off</span>
                <p class="mt-2 text-body-sm">Unit tidak ditemukan.</p>
            </div>
        <?php endif; ?>

        <div class="flex flex-col gap-gutter">
            <?php foreach ($units as $u): ?>
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden flex flex-col <?php echo $u['status'] !== 'tersedia' ? 'opacity-75' : ''; ?>">
                <div class="relative h-44 w-full bg-surface-container-low <?php echo $u['status'] !== 'tersedia' ? 'grayscale' : ''; ?>">
                    <img alt="<?php echo htmlspecialchars($u['nama']); ?>" class="w-full h-full object-cover" src="<?php echo htmlspecialchars($u['foto']); ?>">
                    <?php if ($u['status'] !== 'tersedia'): ?>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <span class="bg-white/90 text-primary text-label-md font-bold px-4 py-2 rounded-full">Sedang Dipakai</span>
                        </div>
                    <?php else: ?>
                        <div class="absolute top-3 left-3">
                            <span class="bg-primary text-white text-[10px] font-bold tracking-widest px-2 py-1 rounded uppercase"><?php echo $u['tipe']; ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-headline-md text-primary" style="font-size:18px;"><?php echo htmlspecialchars($u['nama']); ?></h3>
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-amber-500 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-label-sm"><?php echo $u['rating']; ?></span>
                        </div>
                    </div>
                    <p class="text-body-sm text-secondary mb-4"><?php echo htmlspecialchars($u['deskripsi']); ?></p>
                    <div class="mt-auto flex items-center justify-between pt-4 border-t border-outline-variant">
                        <div>
                            <p class="text-label-sm text-secondary uppercase tracking-wider">Per Jam</p>
                            <p class="text-headline-md text-primary" style="font-size:18px;"><?php echo format_rupiah($u['harga_per_jam']); ?></p>
                        </div>
                        <?php if ($u['status'] === 'tersedia'): ?>
                            <a href="detail.php?id=<?php echo $u['id']; ?>" class="bg-primary text-on-primary px-5 py-2.5 rounded-lg font-label-md text-label-sm">Lihat Detail</a>
                        <?php else: ?>
                            <button class="bg-outline-variant text-on-surface-variant px-5 py-2.5 rounded-lg font-label-md text-label-sm cursor-not-allowed" disabled>Tidak Tersedia</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <?php include __DIR__ . '/includes/bottomnav.php'; ?>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
