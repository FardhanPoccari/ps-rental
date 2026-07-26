<header class="bg-background sticky top-0 z-50 border-b border-outline-variant">
    <div class="flex justify-between items-center w-full px-margin-mobile h-16">
        <div class="flex items-center gap-3">
            <?php if (!empty($show_back)): ?>
                <button class="text-primary" onclick="window.history.back()">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
            <?php else: ?>
                <button class="text-primary">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            <?php endif; ?>
            <a href="index.php" class="text-label-md font-bold tracking-tight text-primary uppercase no-underline">SERENE RENTALS</a>
        </div>
        <div class="flex items-center gap-4">
            <?php if (is_logged_in()): ?>
                <span class="text-body-sm text-secondary hidden sm:inline"><?php echo htmlspecialchars($_SESSION['user']['nama']); ?></span>
                <a href="logout.php" class="text-primary" title="Keluar">
                    <span class="material-symbols-outlined">logout</span>
                </a>
            <?php else: ?>
                <a href="login.php" class="text-primary" title="Login">
                    <span class="material-symbols-outlined">account_circle</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>
