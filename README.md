# ZAWA DIGITAL — WordPress Theme

Theme WordPress modern untuk **ZAWA Digital** — full-service digital strategy partner.
Desain **clean, light & keren**, full responsive mobile-first, kompatibel penuh dengan **Elementor**.

## Fitur Utama

| Fitur | Detail |
|---|---|
| 🎨 Desain modern & clean | Light theme dengan aksen coral `#F5737F` + aksen multi-warna dari logo (biru, kuning, hijau lime) |
| 📱 Full responsive | Mobile-first, hamburger nav, off-canvas menu, breakpoint halus (1024 / 900 / 640 / 400px) |
| 🖼️ Logo custom | Ganti lewat **Customizer → Site Identity → Logo**. Default: `Logo_Zawa_Digital.png` |
| 🔖 Favicon custom | Ganti lewat **Customizer → Site Identity → Site Icon**. Default: favicon dari logo ZAWA |
| 🧱 Elementor ready | Homepage bebas dikustom dengan Elementor; dukung Theme Builder (Header/Footer/Single/Archive locations) |
| ⚡ Auto setup | Saat aktivasi otomatis membuat halaman **Home, Services, Case Studies, Blog, Request Quote** + menu utama |
| 📝 Homepage fallback | Bila belum pakai Elementor, homepage default (Hero, Services 2×2, Portfolio image-left, About 3 paragraf, Team 3×1, CTA) tampil otomatis & bisa diedit dari **Customizer** |
| 💬 Form Request Quote | Multi-step ala cranserco: pilih layanan → detail proyek → kontak. Submit dikirim via email + opsi WhatsApp |
| 🟢 Floating button | Tombol melayang "Request Quote" seperti cranserco — **hanya tampil di mobile**, posisi sejajar margin konten, **selalu bertahan sampai bawah halaman**; bisa dimatikan/diubah labelnya || ♿ Aksesibilitas | Skip-link, ARIA, focus states, `prefers-reduced-motion` |
| 🚀 Performance | Tanpa jQuery di front-end, SVG inline, tanpa framework CSS |

## Instalasi

1. Zip folder `zawa-digital` → **Appearance → Themes → Add New → Upload Theme**.
2. Aktifkan. Halaman & menu utama **dibuat otomatis**.
3. (Disarankan) Install plugin **Elementor** untuk kustom homepage bebas.

## Kustomisasi

### Ganti Logo & Favicon
- **Customizer → Site Identity → Logo** → unggah logo baru.
- **Customizer → Site Identity → Site Icon** → unggah favicon baru (32×32 s.d. 512×512).
- Bila kosong, theme otomatis memakai logo & favicon bawaan ZAWA.

### Homepage dengan Elementor
1. **Pages → Home → Edit with Elementor**.
2. Rancang bebas — theme otomatis mendeteksi & me-render full-width tanpa pembungkus.
3. Saranan layout sesuai konsep: Hero (big image + teks) → Services 2×2 → Portfolio 4 (gambar kiri) → About Us 3 paragraf → Team 3×1.

### Konten homepage tanpa Elementor
**Customizer → ZAWA Digital — Pengaturan Theme** → atur Hero, Services, Portfolio, About, Team, CTA, Kontak footer, dan Floating Button. Semua nilai default sudah diisi sesuai dokumen konsep.

### Warna brand (di `theme.json` & CSS variables)
| Token | Nilai |
|---|---|
| Coral (primary) | `#F5737F` |
| Coral dark | `#E0515F` |
| Blue | `#A8E4F0` |
| Yellow | `#FFCC7D` |
| Green | `#CCE478` |
| Ink | `#0B0F14` |
| Soft bg | `#F6F8FB` |

## Konten Dummy — Import XML (2 file)

### 1. `zawa-digital-portfolio-dummy.xml` — Post blog portofolio

Berisi 6 artikel portofolio siap import:

| Post | Kategori | Tag |
|---|---|---|
| Cranserco — Corporate Identity & Digital Presence | Portfolio | Web Development, Branding |
| WingDik 300 TNI AU — Official Website & Information System | Portfolio | Web Development, Information System |
| ICON+ — Integrated Digital Platform & Campaign | Portfolio | Web Development, Digital Campaign |
| Kopi Kirana — KOL Campaign & Online Media Placement *(dummy)* | Portfolio | KOL Campaign, Digital Campaign |
| NusaAnalytics — SEO & GEO Growth Program *(dummy)* | Portfolio | SEO & GEO |
| Sagara Fit — Mobile App Design & Development *(dummy)* | Portfolio | App Development, UX Design |

Setiap post sudah dilengkapi **Title, featured image, excerpt,** dan konten case-study (Gutenberg blocks).

### 2. `zawa-digital-pages-dummy.xml` — Halaman Services & Case Studies

Dua halaman lengkap dengan **featured image banner** dan banyak animasi:

- **Services** — marquee “Trusted by” yang berjalan otomatis (pause saat hover), 6 kartu layanan (icon SVG + checklist + gradient bar saat hover), proses 4 langkah dengan reveal kiri/kanan, statistik **counter count-up** (40+, 12, 4.2×, 98%), **FAQ accordion** dengan chevron animasi, dan CTA band gelap.
- **Case Studies** — statistik counter, 6 kartu case study (monogram gradient, tag layanan, metrik hasil, tombol panah yang berputar saat hover) yang **me-link ke post portofolio** dari file #1, kutipan klien besar, dan CTA band.

Animasi didukung theme **v1.2.0+**: `.zawa-reveal` multi-arah + stagger delay, `.zawa-marquee`, `.zawa-count` (count-up, support desimal via `data-decimals`), `.zawa-faq`, `.zawa-case`, `.zawa-scard`, `.zawa-breakout`, `.zawa-grad-text`.

### Cara import
1. **PENTING untuk file #2**: theme membuat halaman Services & Case Studies sederhana saat aktivasi — **hapus dulu halaman lama** (Pages → Trash) supaya tidak dobel.
2. **Tools → Import → WordPress** (install importer bila belum ada) → **Run Importer**.
3. Upload file XML → pilih user penulis.
4. ✅ Centang **"Download and import file attachments"** — gambar diunduh dari picsum.photos (butuh internet; ganti dengan aset asli setelahnya).
5. Setelah import file #2: **Appearance → Menus** → pastikan item menu Services & Case Studies menunjuk halaman baru.
6. Import kedua file agar link kartu case study → post portofolio hidup.

## Catatan

- **Form quote** mengirim email ke alamat di *Customizer → Kontak & Footer → Email* (default `zawa.web.seo@gmail.com`).
- Permintaan pembuatan **sales@zawa.co.id** yang forwarding ke `zawa.web.seo@gmail.com` adalah konfigurasi server email (MX/forwarding di provider domain), bukan bagian theme. Setelah email aktif, tinggal ganti alamat tujuan di Customizer.
- Untuk pengiriman email yang andal dari server WordPress, disarankan plugin SMTP (mis. *WP Mail SMTP*).

## Struktur

```
zawa-digital/
├── style.css              # Header theme (wajib)
├── theme.json             # Design tokens WP (v3)
├── functions.php
├── front-page.php         # Deteksi Elementor / homepage default
├── header.php / footer.php
├── index.php  single.php  page.php  archive.php  search.php  404.php
├── comments.php  searchform.php
├── page-templates/
│   ├── request-quote.php  # Form multi-step
│   └── full-width.php
├── template-parts/
│   ├── header/  footer/
│   ├── home/              # hero, services, portfolio, about, team, cta
│   └── content/card.php   # Kartu blog
├── inc/
│   ├── customizer.php     # Semua opsi theme
│   ├── demo-setup.php     # Auto pages + menu saat aktivasi
│   ├── quote-form.php     # Handler email form quote
│   └── template-tags.php
└── assets/
    ├── css/  js/  img/    # logo.png, favicon.png default
```

Versi: 1.2.0 · License: GPL v2+
# zawa-digital
