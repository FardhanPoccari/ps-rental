<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - Serene Rentals' : 'Serene Rentals'; ?></title>

<!-- Tailwind CSS (CDN, JIT) -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<!-- Google Fonts: Manrope -->
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols Outlined -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

<!-- Konfigurasi tema Tailwind - konsisten dengan design system "Serene Professional" -->
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    background: "#f8f9ff",
                    surface: "#f8f9ff",
                    "surface-dim": "#ccdbf2",
                    "surface-bright": "#f8f9ff",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-low": "#eef4ff",
                    "surface-container": "#e5efff",
                    "surface-container-high": "#dbe9ff",
                    "surface-container-highest": "#d4e4fa",
                    "on-surface": "#0d1c2d",
                    "on-surface-variant": "#44474a",
                    "on-background": "#0d1c2d",
                    "inverse-surface": "#233143",
                    "inverse-on-surface": "#e9f1ff",
                    outline: "#75777a",
                    "outline-variant": "#c5c6ca",
                    primary: "#000101",
                    "on-primary": "#ffffff",
                    "primary-container": "#1a1c1e",
                    "on-primary-container": "#838486",
                    "inverse-primary": "#c6c6c9",
                    secondary: "#505f76",
                    "on-secondary": "#ffffff",
                    "secondary-container": "#d0e1fb",
                    "on-secondary-container": "#54647a",
                    "secondary-fixed": "#d3e4fe",
                    "on-secondary-fixed": "#0b1c30",
                    error: "#ba1a1a",
                    "on-error": "#ffffff",
                    "error-container": "#ffdad6",
                    "on-error-container": "#93000a",
                },
                borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
                spacing: {
                    unit: "8px",
                    "stack-sm": "8px",
                    "stack-md": "16px",
                    "stack-lg": "32px",
                    "stack-xl": "64px",
                    "margin-mobile": "16px",
                    "margin-desktop": "48px",
                    gutter: "24px",
                },
                fontFamily: {
                    sans: ["Manrope", "sans-serif"],
                },
                fontSize: {
                    "headline-xl": ["40px", { lineHeight: "48px", letterSpacing: "-0.02em", fontWeight: "700" }],
                    "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.01em", fontWeight: "600" }],
                    "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                    "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                    "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                    "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                    "label-md": ["14px", { lineHeight: "16px", letterSpacing: "0.05em", fontWeight: "600" }],
                    "label-sm": ["12px", { lineHeight: "16px", fontWeight: "500" }],
                },
            },
        },
    };
</script>

<link rel="stylesheet" href="assets/css/style.css">
