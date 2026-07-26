<?php
// $active_nav diset di masing-masing halaman: 'home' | 'katalog' | 'bookings' | 'profile'
$active_nav = $active_nav ?? '';
function nav_class($key, $active) {
    return $key === $active
        ? 'flex flex-col items-center justify-center text-primary bg-secondary-fixed rounded-full px-4 py-1'
        : 'flex flex-col items-center justify-center text-on-secondary-container opacity-70 hover:opacity-100 transition-opacity';
}
?>
<nav class="absolute bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-3 bg-surface-container-lowest border-t border-outline-variant">
    <a href="index.php" class="<?php echo nav_class('home', $active_nav); ?>">
        <span class="material-symbols-outlined" <?php echo $active_nav === 'home' ? "style=\"font-variation-settings: 'FILL' 1;\"" : ''; ?>>home</span>
        <span class="text-[10px] font-label-sm">Home</span>
    </a>
    <a href="katalog.php" class="<?php echo nav_class('katalog', $active_nav); ?>">
        <span class="material-symbols-outlined" <?php echo $active_nav === 'katalog' ? "style=\"font-variation-settings: 'FILL' 1;\"" : ''; ?>>grid_view</span>
        <span class="text-[10px] font-label-sm">Katalog</span>
    </a>
    <a href="konfirmasi.php" class="<?php echo nav_class('bookings', $active_nav); ?>">
        <span class="material-symbols-outlined" <?php echo $active_nav === 'bookings' ? "style=\"font-variation-settings: 'FILL' 1;\"" : ''; ?>>calendar_today</span>
        <span class="text-[10px] font-label-sm">Booking</span>
    </a>
    <a href="<?php echo is_logged_in() ? 'logout.php' : 'login.php'; ?>" class="<?php echo nav_class('profile', $active_nav); ?>">
        <span class="material-symbols-outlined" <?php echo $active_nav === 'profile' ? "style=\"font-variation-settings: 'FILL' 1;\"" : ''; ?>>person</span>
        <span class="text-[10px] font-label-sm">Profil</span>
    </a>
</nav>
