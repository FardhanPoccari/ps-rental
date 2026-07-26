<?php
/**
 * Data unit PS (simulasi database).
 * Di project nyata, data ini idealnya diambil dari MySQL/MariaDB.
 * Untuk keperluan tugas praktik demonstrasi, disimpan sebagai array PHP.
 */
function get_units() {
    return [
        1 => [
            'id' => 1,
            'nama' => 'PS5 Unit A',
            'tipe' => 'PS5',
            'harga_per_jam' => 15000,
            'stik' => 2,
            'status' => 'tersedia',
            'rating' => 4.9,
            'foto' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBpLRkz9LXl2XKUgIec6Sxo-QmMFqJC7W5b7n69sA3rXJrJLgf6Wx2DZwKCcTvIikq69LpEa8ZdSAD5x5m4E0IvZtognZKjArDT3tw_eQKQ9Q9BVmIudKkeLZgH-iRvRJlYj0lUgiZuI6eEafFnXsoOYQyFvs2Cifdx49aUkTneoMgDN5N86hSbm2CgjuVsLdm1bJnVxlB67XgHf5RXWEVrM0z9-hn2CwgAq26ZdLxqxP_UUbq6OjWHEyHzhO2cLVhMItVtrz60T-0',
            'deskripsi' => 'PS5 dengan SSD ultra cepat, dukungan haptic feedback dan adaptive trigger untuk pengalaman gaming terbaik.',
            'spesifikasi' => [
                'Prosesor' => 'AMD Ryzen Zen 2',
                'Grafis' => 'AMD Radeon RDNA 2',
                'Memori' => '16GB GDDR6',
                'Penyimpanan' => '825GB SSD',
            ],
        ],
        2 => [
            'id' => 2,
            'nama' => 'PS4 Unit B',
            'tipe' => 'PS4',
            'harga_per_jam' => 10000,
            'stik' => 2,
            'status' => 'tersedia',
            'rating' => 4.7,
            'foto' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDx6XFI4mEE1M6P-x0CmI5Z4pucN0TK5SJmCx6r7eBotZukSE9Qt25reOtguMcsuoN_y0J5clUvFeeRH4axauG-jjkNANz_T5q7d_1929fhnLZvfvOw4gHASAVp0qPziJ_xNlqLLN9xeS085EkgRB1J6Z-gIyTaknEXFdATmLWq1nIK5uRyIb12sEfE3heU_qVPd2Q-dUj5WZ9YsUe3xN6-LtJ71-toS9zn_Z7RXaNWwMmfZhuXrXhMWYKKqMkeZP0iM9lwbqNvJ4s',
            'deskripsi' => 'PS4 edisi standar, cocok untuk sesi santai bareng teman dengan koleksi game lengkap.',
            'spesifikasi' => [
                'Prosesor' => 'AMD Jaguar 8-core',
                'Grafis' => 'AMD Radeon GCN',
                'Memori' => '8GB GDDR5',
                'Penyimpanan' => '500GB HDD',
            ],
        ],
        3 => [
            'id' => 3,
            'nama' => 'PS5 Unit C',
            'tipe' => 'PS5',
            'harga_per_jam' => 15000,
            'stik' => 4,
            'status' => 'tersedia',
            'rating' => 4.8,
            'foto' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAd5Qj5A9ZW0b0ij2f6kKHemgZ5Amja5Kt1NaERIrfP76niSCEYsSxyV_Ullc0hk8z3wOPZiKTlg0wuzLJ6HKG07OFtUQghgx1YbGmS8549Ucrkv9mq-zZjdVar1CzKlMhSeXrVrKT0LO9eOhy049oD6EV2oom1zH3bybIzm7Wdcz0WP2FY6WDjrBVL-Cf3iRZP72AVRkm0s19sYXLsvpYJeH0hTACFWICVPyHy5hbsbJzoB7GqiaZId7YK7LhsrsysETwoND5216c',
            'deskripsi' => 'PS5 dengan 4 stik, cocok untuk party gaming bareng banyak teman di ruangan ber-AC.',
            'spesifikasi' => [
                'Prosesor' => 'AMD Ryzen Zen 2',
                'Grafis' => 'AMD Radeon RDNA 2',
                'Memori' => '16GB GDDR6',
                'Penyimpanan' => '1TB SSD',
            ],
        ],
        4 => [
            'id' => 4,
            'nama' => 'PS4 Pro Unit D',
            'tipe' => 'PS4',
            'harga_per_jam' => 12000,
            'stik' => 2,
            'status' => 'habis',
            'rating' => 4.6,
            'foto' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBjkDnjurqho8kHk9-kYCQGO0YjP4DlTlv-j1qR9FkLNAoaeao-WuQDPPiya38fUOAqZ-3LX_R3pml_C6DOEK33XNsJrozHZcLkePCyU80ts4c_Ac_GFliAlcuH0B61emgGpAj_n4y9doc_-gw4CF3-ij6d--EMUwR_xrQG8kYGt8_uLDkwvtwlQm3ZYyMznivsQgNvDF--lSZnDp8S0zH_EcTrZAOmtTzo9pGt1q1fjr5JcVDUIqltZwvxoaf1LA2vnxWSDBC9EDw',
            'deskripsi' => 'PS4 Pro dengan performa lebih tinggi untuk game-game berat, saat ini sedang dipakai penyewa lain.',
            'spesifikasi' => [
                'Prosesor' => 'AMD Jaguar 8-core (enhanced)',
                'Grafis' => 'AMD Radeon (Pro)',
                'Memori' => '8GB GDDR5',
                'Penyimpanan' => '1TB HDD',
            ],
        ],
    ];
}

function get_unit($id) {
    $units = get_units();
    return $units[$id] ?? null;
}

function format_rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
