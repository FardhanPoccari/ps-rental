document.addEventListener('DOMContentLoaded', () => {

    /* ================== LOGIN: toggle show/hide password ================== */
    window.togglePassword = function () {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (!input) return;
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    };

    /* ================== DETAIL: pilih slot jam, durasi, hitung total ================== */
    const slotButtons = document.querySelectorAll('.slot-btn:not(.taken)');
    const jamInput = document.getElementById('jam_mulai_input');
    const submitBooking = document.getElementById('submitBooking');
    const durasiInput = document.getElementById('durasiInput');
    const durasiMin = document.getElementById('durasiMin');
    const durasiPlus = document.getElementById('durasiPlus');
    const subtotalEl = document.getElementById('subtotal');
    const totalEl = document.getElementById('totalHarga');
    const rincianEl = document.getElementById('rincianHarga');

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    function hitungTotal() {
        if (!subtotalEl) return;
        const hargaJam = parseInt(subtotalEl.dataset.harga, 10);
        const durasi = parseInt(durasiInput.value, 10) || 1;
        const subtotal = hargaJam * durasi;
        const biayaAdmin = 2000;
        const total = subtotal + biayaAdmin;

        rincianEl.textContent = `${formatRupiah(hargaJam)} x ${durasi} jam`;
        subtotalEl.textContent = formatRupiah(subtotal);
        totalEl.textContent = formatRupiah(total);
    }

    if (slotButtons.length) {
        slotButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));
                btn.classList.add('selected');
                jamInput.value = btn.dataset.slot;
                if (submitBooking) submitBooking.disabled = false;
            });
        });
    }

    if (durasiMin && durasiPlus) {
        durasiMin.addEventListener('click', () => {
            let v = parseInt(durasiInput.value, 10) || 1;
            if (v > 1) durasiInput.value = v - 1;
            hitungTotal();
        });
        durasiPlus.addEventListener('click', () => {
            let v = parseInt(durasiInput.value, 10) || 1;
            if (v < 8) durasiInput.value = v + 1;
            hitungTotal();
        });
        hitungTotal();
    }

    /* ================== CHECKOUT: toggle metode pembayaran ================== */
    const paymentOptions = document.querySelectorAll('.payment-option');
    if (paymentOptions.length) {
        paymentOptions.forEach(label => {
            label.addEventListener('click', () => {
                paymentOptions.forEach(el => {
                    el.classList.remove('border-primary', 'bg-secondary-fixed/10', 'border-2');
                    el.classList.add('border-outline-variant', 'border');
                    const check = el.querySelector('.check-icon');
                    if (check) check.remove();
                    const icon = el.querySelector('.material-symbols-outlined');
                    if (icon) {
                        icon.classList.remove('text-primary');
                        icon.classList.add('text-on-surface-variant');
                    }
                });

                label.classList.remove('border-outline-variant', 'border');
                label.classList.add('border-primary', 'bg-secondary-fixed/10', 'border-2');
                const icon = label.querySelector('.material-symbols-outlined');
                if (icon) {
                    icon.classList.add('text-primary');
                    icon.classList.remove('text-on-surface-variant');
                }
                if (!label.querySelector('.check-icon')) {
                    const check = document.createElement('span');
                    check.className = 'material-symbols-outlined text-primary text-[18px] check-icon';
                    check.style.fontVariationSettings = "'FILL' 1";
                    check.textContent = 'check_circle';
                    label.appendChild(check);
                }
            });
        });
    }

    /* ================== Animasi muncul saat section terlihat ================== */
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-4');
            }
        });
    }, observerOptions);

    document.querySelectorAll('main > section').forEach(section => {
        section.classList.add('transition-all', 'duration-500');
        observer.observe(section);
    });
});
