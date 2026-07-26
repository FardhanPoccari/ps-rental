<?php
require_once __DIR__ . '/config.php';

$id = (int)($_GET['id'] ?? 0);
$unit = get_unit($id);

if (!$unit) {
    header('Location: katalog.php');
    exit;
}

$page_title = $unit['nama'];
$active_nav = 'katalog';
$show_back = true;

// Slot jam yang sudah terisi (simulasi jadwal terpakai per unit)
$slot_terisi = ['11:00', '13:00'];
$semua_slot = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body class="bg-background text-on-background">
<div class="app-shell">
    <?php include __DIR__ . '/includes/topbar.php'; ?>

    <main class="app-main px-margin-mobile py-stack-md">
        <!-- Foto -->
        <div class="w-full aspect-video rounded-xl overflow-hidden border border-outline-variant bg-surface-container mb-stack-md">
            <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($unit['foto']); ?>" alt="<?php echo htmlspecialchars($unit['nama']); ?>">
        </div>

        <!-- Info -->
        <div class="mb-stack-lg">
            <span class="bg-surface-container-high text-on-secondary-container text-[11px] px-3 py-1 rounded-full uppercase tracking-wider"><?php echo htmlspecialchars($unit['tipe']); ?></span>
            <h2 class="text-headline-md text-primary mt-2"><?php echo htmlspecialchars($unit['nama']); ?></h2>
            <div class="flex items-baseline gap-2 mt-1">
                <p class="text-headline-md text-primary" style="font-size:22px;"><?php echo format_rupiah($unit['harga_per_jam']); ?></p>
                <p class="text-body-sm text-secondary">/ jam</p>
            </div>
            <p class="text-body-md text-on-surface-variant leading-relaxed mt-3"><?php echo htmlspecialchars($unit['deskripsi']); ?></p>

            <div class="mt-4 border border-outline-variant rounded-xl overflow-hidden bg-white">
                <div class="bg-surface-container-low px-4 py-3 border-b border-outline-variant">
                    <h3 class="text-label-md text-primary uppercase tracking-wider">Spesifikasi</h3>
                </div>
                <div class="divide-y divide-outline-variant">
                    <?php foreach ($unit['spesifikasi'] as $key => $val): ?>
                    <div class="grid grid-cols-2 px-4 py-3">
                        <span class="text-label-sm text-secondary"><?php echo htmlspecialchars($key); ?></span>
                        <span class="text-body-sm text-on-surface"><?php echo htmlspecialchars($val); ?></span>
                    </div>
                    <?php endforeach; ?>
                    <div class="grid grid-cols-2 px-4 py-3">
                        <span class="text-label-sm text-secondary">Jumlah Stik</span>
                        <span class="text-body-sm text-on-surface"><?php echo $unit['stik']; ?> Stik Wireless</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Booking -->
        <form action="booking_process.php" method="post" id="bookingForm" class="bg-white border border-outline-variant rounded-xl p-4 shadow-sm">
            <input type="hidden" name="unit_id" value="<?php echo $unit['id']; ?>">
            <input type="hidden" name="jam_mulai" id="jam_mulai_input" required>

            <h3 class="text-headline-md text-primary mb-4" style="font-size:18px;">Pilih Jadwal Booking</h3>

            <div class="space-y-4">
                <div>
                    <label class="text-label-sm text-primary block mb-2" for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required
                        class="w-full h-11 px-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-body-sm focus:outline-none focus:border-primary">
                </div>

                <div>
                    <label class="text-label-sm text-primary block mb-2">Pilih Jam Mulai (slot tersedia)</label>
                    <div class="grid grid-cols-4 gap-2" id="slotContainer">
                        <?php foreach ($semua_slot as $slot): ?>
                            <?php $taken = in_array($slot, $slot_terisi); ?>
                            <button type="button"
                                class="slot-btn <?php echo $taken ? 'taken' : ''; ?> border border-outline-variant rounded-lg py-2 text-[12px] text-on-surface-variant hover:border-primary transition-all"
                                data-slot="<?php echo $slot; ?>" <?php echo $taken ? 'disabled' : ''; ?>>
                                <?php echo $slot; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <p class="text-[10px] text-secondary mt-2">Slot abu-abu artinya sudah terisi.</p>
                </div>

                <div>
                    <label class="text-label-sm text-primary block mb-2">Durasi (jam)</label>
                    <div class="flex items-center gap-2">
                        <button type="button" id="durasiMin" class="w-10 h-10 border border-outline-variant rounded-lg text-primary">−</button>
                        <input type="number" name="durasi" id="durasiInput" value="1" min="1" max="8" readonly
                            class="w-16 h-10 text-center border border-outline-variant rounded-lg bg-surface-container-lowest text-body-md">
                        <button type="button" id="durasiPlus" class="w-10 h-10 border border-outline-variant rounded-lg text-primary">+</button>
                    </div>
                </div>

                <div class="pt-3 border-t border-outline-variant flex flex-col gap-1">
                    <div class="flex justify-between text-body-sm text-on-surface-variant">
                        <span id="rincianHarga"><?php echo format_rupiah($unit['harga_per_jam']); ?> x 1 jam</span>
                        <span id="subtotal" data-harga="<?php echo $unit['harga_per_jam']; ?>"><?php echo format_rupiah($unit['harga_per_jam']); ?></span>
                    </div>
                    <div class="flex justify-between text-headline-md text-primary mt-1" style="font-size:18px;">
                        <span>Total Harga</span>
                        <span id="totalHarga"><?php echo format_rupiah($unit['harga_per_jam']); ?></span>
                    </div>
                </div>

                <button type="submit" id="submitBooking" disabled
                    class="w-full bg-primary text-white py-4 rounded-xl text-label-md uppercase tracking-widest hover:opacity-90 transition-all flex items-center justify-center gap-2 mt-2 disabled:opacity-40">
                    Lanjut ke Pembayaran
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
                <p class="text-center text-[10px] text-secondary flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[12px]">verified_user</span>
                    Pilih jam terlebih dahulu untuk melanjutkan
                </p>
            </div>
        </form>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <?php include __DIR__ . '/includes/bottomnav.php'; ?>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
