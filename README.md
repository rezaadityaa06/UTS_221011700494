# BumiBaik

Katalog Produk Ramah Lingkungan untuk UTS Rekayasa Web.

- Nama: Reza Novyan Aditya
- NIM: 221011700494
- Kode kelas: **ISI_KODEKELAS**
- Tema digit akhir NIM 4: Katalog Produk Ramah Lingkungan
- Proyek lokal: `UTS_221011700494`
- Database MySQL: `db_uts_221011700494`

## Kebutuhan

Laravel 13, PHP >=8.3, Composer, MySQL, dan browser. Bootstrap 5.3.8 sudah disertakan di `public/Bootstrap/`. Tidak perlu Node.js, NPM, Vite, atau CDN untuk halaman aplikasi ini. Produk, harga, ilustrasi, dan skor lingkungan adalah data simulasi untuk pembelajaran.

## Jalankan di Laragon Windows

1. Ekstrak proyek ke `C:\laragon\www\UTS_221011700494`. Pastikan `artisan` berada langsung di folder ini, bukan di subfolder ganda.
2. Buka Laragon, klik Start All. Buka CMD biasa bila terminal ConEmu bermasalah.
3. Jalankan:

```bat
cd /d C:\laragon\www\UTS_221011700494
php -v
composer --version
composer install
copy .env.example .env
php artisan key:generate
mysql -u root < database\create_database.sql
php artisan config:clear
php artisan migrate --seed
php artisan route:list --except-vendor
php artisan serve
```

Konfigurasi contoh memakai MySQL root tanpa password. Jika MySQL Anda memakai password, isi `DB_PASSWORD` di `.env` dan buat database memakai `mysql -u root -p` lalu jalankan isi file SQL. Jangan menimpa `.env` yang sudah berisi konfigurasi/key saat mengulang instalasi.

4. Buka `http://127.0.0.1:8000`. Katalog berada di `/produk`. Halaman detail berada di `/produk/1` untuk instalasi baru.

## Arsitektur

Request browser -> routes/web.php -> EcoProductController -> EcoProduct -> tabel eco_products -> Blade -> browser.

- Migration: membuat tabel dan tipe kolom.
- EcoProductSeeder: sumber 10 produk beserta nama, material, harga, skor, gambar, dan deskripsi.
- DatabaseSeeder: menjalankan EcoProductSeeder.
- Model: akses data Eloquent dan konversi tipe harga/skor.
- Controller: mengambil data beranda, menyaring katalog, dan mengirim satu produk ke detail.
- Layout Blade: struktur HTML, navbar, CSS, footer, dan JavaScript bersama.
- Komponen kartu: satu tampilan kartu dipakai oleh beranda dan katalog.

## Struktur tabel

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint unsigned | Primary key |
| name | varchar(255), unique | Nama produk |
| material | varchar(255) | Material produk |
| price | decimal(12,2) | Harga rupiah |
| eco_rating | tinyint unsigned | Skor simulasi 1-5 |
| image | varchar(255) | Path lokal dari folder public |
| description | text | Deskripsi produk |
| created_at / updated_at | timestamp | Waktu data |

Path contoh pada seeder: `assets/images/tas-kanvas.svg`. File fisik: `public/assets/images/tas-kanvas.svg`. Blade memakai `asset($product->image)`; jangan menambahkan `public/` ke nilai image.

## Fitur

- Beranda dengan jumlah dan tiga produk pilihan dari database.
- Katalog seluruh produk dengan kartu Bootstrap dan grid responsif.
- Pencarian nama/material, filter skor minimum, dan reset filter.
- Halaman detail produk, breadcrumb, dan tombol kembali.
- Halaman 404 untuk ID yang tidak ada.
- Seeder dapat diulang dengan `php artisan db:seed` tanpa menggandakan nama produk.

## Uji

```bat
php artisan test
php artisan tinker --execute="dump(App\Models\EcoProduct::count());"
```

Pengujian otomatis memakai SQLite in-memory sesuai `phpunit.xml`; database aplikasi tetap MySQL. Pastikan ekstensi `pdo_sqlite`/`sqlite3` tersedia untuk test, serta `pdo_mysql` untuk aplikasi. Uji browser juga harus dilakukan pada MySQL.

Kode test memeriksa beranda, katalog, detail, produk tidak ada, pencarian, filter skor, seeder berulang, dan keberadaan gambar lokal. Pemeriksaan paket oleh penyusun meliputi sintaks PHP dan kelengkapan aset; eksekusi Laravel/MySQL dan test harus dikonfirmasi di lingkungan pengguna.

## GitHub dan dokumentasi

Nama repository sesuai soal:
`UTS_REZA_NOVYAN_ADITYA_221011700494_ISI_KODEKELAS`

Ganti `ISI_KODEKELAS` dengan kelas Anda. Baca panduan di luar folder proyek untuk langkah GitHub dan screenshot. Jangan mengunggah `.env`, `vendor`, `node_modules`, atau data sensitif. Simpan `composer.lock` hasil instalasi agar versi dependensi dapat direproduksi.

## Sumber

- Soal UTS Rekayasa Web P3 dari dosen Afif Efendi.
- Laravel skeleton resmi: https://github.com/laravel/laravel/tree/13.x
- Laravel 13: https://laravel.com/docs/13.x
- Bootstrap: https://getbootstrap.com/docs/5.3/getting-started/download/
- Ilustrasi SVG lokal dibuat khusus untuk proyek ini. Bootstrap dan Laravel tetap mengikuti lisensi masing-masing.
