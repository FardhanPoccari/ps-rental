<?php
require_once __DIR__ . '/config.php';
$page_title = 'Login';
$error = '';

// Jika sudah login, langsung ke katalog
if (is_logged_in()) {
    header('Location: katalog.php');
    exit;
}

// Proses form login (disederhanakan untuk keperluan demo/tugas)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $error = 'Email dan kata sandi wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } elseif (strlen($password) < 6) {
        $error = 'Kata sandi minimal 6 karakter.';
    } else {
        // Simulasi login berhasil (tanpa database)
        $_SESSION['user'] = [
            'nama' => explode('@', $email)[0],
            'email' => $email,
        ];
        header('Location: katalog.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body class="bg-surface-container-low text-on-background flex items-center justify-center min-h-screen">
<div class="app-shell" style="min-height:auto;">
    <header class="w-full h-20 flex justify-center items-center px-margin-mobile bg-background/80 backdrop-blur-sm border-b border-outline-variant">
        <a href="index.php" class="text-headline-md font-bold tracking-tight text-primary no-underline">SERENE RENTALS</a>
    </header>

    <main class="app-main flex flex-col items-center px-margin-mobile pt-stack-xl">
        <div class="w-full bg-surface-container-lowest border border-outline-variant p-stack-xl rounded-xl shadow-sm">
            <div class="mb-stack-xl text-center">
                <h1 class="text-headline-lg text-primary mb-2">Selamat Datang</h1>
                <p class="text-body-md text-secondary">Masuk untuk mulai booking rental PS.</p>
            </div>

            <?php if ($error): ?>
            <div class="mb-4 p-3 rounded-lg bg-error-container text-on-error-container text-body-sm">
                <?php echo htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <form method="post" class="space-y-stack-lg">
                <div class="flex flex-col space-y-2">
                    <label class="text-label-md text-on-surface-variant" for="email">EMAIL</label>
                    <input class="w-full h-12 px-4 bg-background border border-outline-variant rounded-lg text-body-md outline-none focus:border-primary transition-all" id="email" name="email" placeholder="nama@email.com" type="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required/>
                </div>
                <div class="flex flex-col space-y-2">
                    <label class="text-label-md text-on-surface-variant" for="password">KATA SANDI</label>
                    <div class="relative">
                        <input class="w-full h-12 px-4 bg-background border border-outline-variant rounded-lg text-body-md outline-none focus:border-primary transition-all" id="password" name="password" placeholder="••••••••" type="password" required/>
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-4 flex items-center text-outline opacity-60">
                            <span class="material-symbols-outlined text-[20px]" id="toggleIcon">visibility</span>
                        </button>
                    </div>
                </div>
                <button class="w-full h-14 bg-primary text-on-primary font-label-md flex items-center justify-center gap-2 rounded-lg hover:opacity-90 transition-all" type="submit">
                    <span>MASUK</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </form>

            <p class="mt-stack-xl text-body-sm text-secondary text-center">
                Belum punya akun? <a class="text-primary font-bold hover:underline" href="#">Daftar gratis</a>
            </p>
        </div>
    </main>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
