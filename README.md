# Theme WordPress CKDI — Cipta Karya Digital Indonesia

Theme WordPress custom hasil konversi dari landing page statis `ckdi_landing_page.html`.
Desain, konten, dan interaksi **sama persis** dengan landing page aslinya, tapi sekarang
sepenuhnya dikelola dari WordPress.

## ✨ Fitur

| Fitur | Keterangan |
|---|---|
| **Homepage Elementor** | Halaman Beranda dibuat otomatis dengan widget kustom CKDI (Hero, Layanan, Mengapa Kami, Portofolio, Harga, Kontak). Semua teks/gambar/tombol bisa diedit via Elementor — tinggal klik → edit. |
| **Halaman lain otomatis ada** | Pages: `Beranda`, `Layanan`, `Tentang Kami`, `Portofolio`, `Harga`, `Kontak` — semuanya page WordPress yang bisa diedit Elementor juga. |
| **Footer via Widgets & Menus** | 3 area widget footer (Brand / Layanan / Kontak) + copyright & sosmed. Menu footer dikelola dari **Appearance → Menus**. |
| **Navbar via Menu** | Menu utama dari **Appearance → Menus → Menu Utama**, sudah otomatis support submenu dropdown. |
| **Chatbot AI Groq** | Chatbot terintegrasi. API key disimpan aman di server (Customizer) & diproxy via `admin-ajax` — **tidak terekspos** ke pengunjung. |
| **Tombol WhatsApp** | Nomor & pesan default bisa diubah dari Customizer. |
| **Dark / Light Mode** | Toggle sama seperti landing page, tersimpan di localStorage. |
| **Animasi lengkap** | Orb background, custom cursor, parallax hero & why-us, counter angka, scroll reveal, floating elements, service modal — semua jalan. |

## 📦 Instalasi

1. **Install theme**
   - Zip folder `ckdi` → `Appearance → Themes → Add New → Upload Theme` → pilih `ckdi.zip` → Activate.
   - (atau salin folder `ckdi` ke `wp-content/themes/` lalu aktifkan)

2. **Install plugin Elementor** (wajib)
   - `Plugins → Add New` → cari **Elementor** → Install & Activate.

3. **Import Demo (otomatis)**
   - Jika Elementor sudah aktif saat theme diaktifkan → semua halaman, menu, widget footer langsung dibuat otomatis.
   - Jika Elementor diaktifkan **belakangan** (theme sudah aktif dulu) → import tetap berjalan **otomatis** saat plugin Elementor diaktifkan.
   - Safety net: Elementor aktif tapi demo belum pernah diimport (mis. plugin diunggah via FTP) → import otomatis jalan saat admin dibuka.
   - Manual: buka **Appearance → CKDI Demo Import** → klik **"Import Demo Sekarang"** (bisa dipakai juga untuk re-import/perbaiki halaman).

4. **Homepage tidak pernah kosong**
   - Sebelum/selama halaman belum dibangun dengan Elementor, theme otomatis merender konten landing page (1:1 dengan `ciptakaryadigital.id/new/`) langsung dari theme — jadi homepage, Layanan, Portofolio, Harga, dan Kontak selalu tampil isinya.
   - Setelah demo import dijalankan, halaman berisi widget Elementor dan fallback otomatis tidak dipakai lagi.

5. **Import Manual (alternatif)** — file import tersedia di folder `demo-import/`
   - **`ckdi-homepages.xml`** (cara tercepat, 6 halaman sekaligus):
     1. `Tools → Import → WordPress` → install importer → pilih file `ckdi-homepages.xml` → **Download & import file attachments** bisa dicentang → Submit.
     2. Buat halaman **Beranda** jadi homepage: `Settings → Reading → Your homepage displays → A static page → Homepage: Beranda`.
     3. Selesai — semua halaman (Beranda, Layanan, Tentang Kami, Portofolio, Harga, Kontak) berisi widget Elementor siap edit.
   - **`ckdi-homepage.json`** (template Elementor homepage saja):
     1. `Templates → Saved Templates → Import Templates` → upload `ckdi-homepage.json`.
     2. Buat/edit halaman → `Edit with Elementor` → klik ikon **folder** (Add Template) → tab **My Templates** → pilih **CKDI — Beranda (Homepage)** → Insert.
     3. Khusus import JSON: set `Settings → Reading` ke static page **Beranda**.
   - ⚠️ Import manual (XML/JSON) tidak membuat menu & widget footer — untuk itu tetap jalankan **Appearance → CKDI Demo Import**.

## ✏️ Mengedit Konten Homepage

`Pages → Beranda → Edit with Elementor`

Widget kustom tersedia di panel Elementor dengan kategori **"CKDI Elements"**:

- **CKDI — Hero** : badge, judul, deskripsi, tombol, statistik, video background, gambar, floating icons
- **CKDI — Layanan** : kartu layanan + konten modal detail (repeater — bisa tambah/hapus layanan)
- **CKDI — Mengapa Kami** : gambar + item keunggulan
- **CKDI — Portofolio** : kartu portofolio + link opsional
- **CKDI — Paket Harga** : paket harga, fitur per baris, badge POPULER, tombol WA otomatis
- **CKDI — Kontak & Form** : info kontak + form (submit diteruskan ke WhatsApp)

Urutan section bisa diubah drag & drop, section bisa ditambah/dikurangi.

## 🔧 Pengaturan Theme

`Appearance → Customize → Pengaturan CKDI`

| Section | Isi |
|---|---|
| **Branding / Logo** | Logo mode gelap (putih) & mode terang (hitam) |
| **Kontak & WhatsApp** | Nomor WA, pesan default, email, website, lokasi, on/off tombol WA |
| **Footer** | Teks copyright, URL sosmed (Facebook, Instagram, LinkedIn, X, TikTok, YouTube) |
| **Chatbot AI (Groq)** | On/off chatbot, **Groq API Key** (dari console.groq.com), model, pesan sambutan, system prompt |

> ⚠️ **Penting:** isi **Groq API Key** di Customizer agar chatbot aktif.
> Karena API key lama tertanam di file statis (bisa dicuri siapa saja), di theme ini key
> disimpan di server dan request Groq di-proxy via `admin-ajax.php` — jauh lebih aman.

## 🎨 Mengelola Footer

- **Kolom footer**: `Appearance → Widgets` → area *Footer — Kolom 1/2/3*
  - Kolom 1: widget **Custom HTML** (logo + deskripsi brand)
  - Kolom 2 & 3: widget **Navigation Menu** (menu Footer Layanan / Footer Kontak)
- **Link footer**: `Appearance → Menus` → edit menu *Footer — Layanan* / *Footer — Kontak*
- **Copyright & sosmed**: Customizer → Pengaturan CKDI → Footer

## 📐 Struktur Theme

```
ckdi/
├── style.css                  # Header theme (meta)
├── functions.php              # Setup, enqueue, widget area, AJAX chatbot
├── header.php                 # Navbar (menu WP + toggle theme + CTA WA)
├── footer.php                 # Footer widgets + modal + WA + chatbot
├── front: page.php            # Mendukung Elementor & halaman biasa
├── index/archive/search.php   # Blog styling (kartu serupa landing page)
├── single.php / 404.php / comments.php / searchform.php
├── inc/
│   ├── customizer.php         # Panel pengaturan CKDI
│   ├── elementor-widgets.php  # 6 widget kustom CKDI Elements
│   └── demo-import.php        # Auto-create pages, menus, widgets
├── demo-import/               # File import manual
│   ├── ckdi-homepages.xml     # WXR — 6 halaman sekaligus (Tools → Import)
│   └── ckdi-homepage.json     # Template Elementor homepage (Templates → Import)
└── assets/
    ├── css/main.css           # CSS lengkap dari landing page (1:1)
    ├── js/main.js             # Semua interaksi (cursor, parallax, modal, chat)
    └── img/                   # Logo & thumbnail default
```

## ❓ FAQ

**Q: Homepage masih kosong / menampilkan daftar blog?**
A: Sejak v1.1.0 homepage TIDAK PERNAH kosong — ada fallback berlapis: (1) mode blog tanpa page statis → landing page langsung dirender dari theme (termasuk jika opsi `page_on_front` masih menyimpan ID lama); (2) halaman Elementor yang hasil render-nya kosong (widget tidak dikenal oleh versi Elementor tertentu) → landing page otomatis menggantikan. Setelah upload theme, jalankan sekali **Appearance → CKDI Demo Import → Import Demo Sekarang** untuk memperbaiki setting homepage & membersihkan menu footer yang duplikat.

**Q: Chatbot error / tidak membalas?**
A: Pastikan Groq API Key terisi di Customizer → Chatbot AI. Cek juga kuota API Groq.

**Q: Menu navbar tidak muncul?**
A: `Appearance → Menus` → pastikan menu "Menu Utama" di-assign ke lokasi *Menu Utama (Navbar)*.

**Q: Ingin ganti video hero?**
A: Edit page Beranda di Elementor → widget CKDI Hero → field *Video Background* — isi URL MP4 milik sendiri (upload ke Media Library).

**Q: Form kontak dikirim ke mana?**
A: Sama seperti landing page — diteruskan ke WhatsApp dengan format pesan otomatis.
# ckdi-themes
