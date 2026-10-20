# LabRPL — Sistem Peminjaman Alat Laboratorium RPL

Starter project Laravel + MySQL untuk tugas PKL. Termasuk login/register, login tunggal dengan role admin/siswa, CRUD alat, pengguna, peminjaman, dan pengembalian. UI menggunakan landing page animatif bertema liquid-metal/glassmorphism: material graphite dan chrome-perak, highlight reflektif, panel kaca blur, serta canvas background interaktif yang bergerak halus mengikuti kursor pada landing page dan dashboard/auth. Animasi menghormati preferensi reduced-motion perangkat.

> Paket ini berisi source code aplikasi yang dipasang ke project Laravel baru. Folder `vendor/` tidak disertakan; Composer akan mengunduh dependensi.

## Persyaratan
- PHP 8.2+
- Composer 2
- MySQL 8+ atau MariaDB
- Laravel 11/12 (disarankan Laravel 12)

## Instalasi cepat

1. Buat project Laravel baru:
   ```bash
   composer create-project laravel/laravel labrpl
   ```
2. Ekstrak paket ini, lalu salin folder `app`, `database`, `resources`, dan file `routes/web.php` ke folder `labrpl`. Jika ditanya, gabungkan folder dan timpa `routes/web.php`.
3. Daftarkan alias middleware `role` di `bootstrap/app.php`. Pada Laravel 11/12, tambahkan import `use Illuminate\\Foundation\\Configuration\\Middleware;` dan `use Illuminate\\Http\\Request;` jika belum ada, lalu gabungkan konfigurasi ini ke rantai `->withMiddleware(...)` yang sudah tersedia:
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias([
           'role' => \\App\\Http\\Middleware\\RoleMiddleware::class,
       ]);
       $middleware->redirectGuestsTo(fn (Request $request) =>
           route('login')
       );
   })
   ```
   Jika `withMiddleware` sudah ada, gabungkan kedua konfigurasi ke callback tersebut—jangan membuat callback kedua. Ini membuat pengunjung yang belum login dan membuka halaman admin diarahkan ke `/login`.
4. Masuk ke folder project:
   ```bash
   cd labrpl
   ```
5. Buat database MySQL, misalnya `labrpl`.
6. Atur `.env`:
   ```env
   APP_NAME=LabRPL
   APP_URL=http://127.0.0.1:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=labrpl
   DB_USERNAME=root
   DB_PASSWORD=
   ```
7. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```
8. Jalankan server:
   ```bash
   php artisan serve
   ```
9. Buka `http://127.0.0.1:8000`.

## Cara membuka database MySQL (phpMyAdmin / HeidiSQL)

Project ini menggunakan **MySQL/MariaDB**, bukan SQLite. Untuk melihat tabel dan data:

1. Jalankan MySQL dari Laragon atau XAMPP.
2. Buka `http://localhost/phpmyadmin` di browser (jika phpMyAdmin terpasang).
3. Pilih database `labrpl` di panel kiri. Tabel seperti `users`, `alat`, dan tabel peminjaman akan muncul setelah migrasi.
4. Jika database belum ada, buat database bernama `labrpl`, lalu jalankan perintah berikut dari terminal di folder project yang berisi file `artisan`:
   ```bash
   php artisan migrate --seed
   ```
5. Jika memakai Laragon dan tidak ada phpMyAdmin, buka Laragon → **Database** untuk membuka HeidiSQL, lalu konek ke MySQL dengan host `127.0.0.1`, port `3306`, dan username/password yang sesuai konfigurasi `.env`.

File koneksi ada di `.env` (bukan `.env.example`). Nilai `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, dan `DB_PORT` harus sesuai dengan server lokalmu. Jangan membagikan password database.

## Troubleshooting MySQL di Laragon

Jika muncul `SQLSTATE[HY000] [1045] Access denied`, periksa kredensial MySQL pada file `.env` di folder utama project Laravel (folder yang berisi file `artisan`). Contoh konfigurasi Laragon standar, hanya jika akun `root` memang tidak memakai password dan MySQL menggunakan port 3306:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=labrpl
DB_USERNAME=root
DB_PASSWORD=
```

Buat database bernama `labrpl` melalui phpMyAdmin atau HeidiSQL jika belum ada. Jika akun MySQL kamu memakai password atau port berbeda, isi nilai yang benar; jangan mengubah password MySQL secara asal. Setelah mengubah `.env`, jalankan dari terminal di folder project:

```bash
php artisan config:clear
php artisan cache:clear
php artisan migrate --seed
```

Perintah `migrate --seed` membuat tabel yang belum ada dan memasukkan data demo; perintah ini bukan `migrate:fresh` dan tidak dimaksudkan untuk menghapus seluruh tabel. Jika masih gagal, catat pesan lengkap `Access denied for user '...'@'...'` dan pastikan MySQL aktif serta portnya sesuai. Jangan kirim password asli ke siapa pun.

## Akun demo
- Admin: `admin@labrpl.test` / `password` — masuk melalui `/login`
- Siswa demo: `siswa@labrpl.test` / `password` — masuk melalui `/login`

Ganti password demo sebelum dipakai sungguhan. Akun demo siswa tetap dapat digunakan, sedangkan pengguna baru dapat mendaftar melalui `/register`.

## Fitur
- Login, register, dan logout berbasis session.
- Username tanpa domain otomatis dinormalisasi menjadi `username@gmail.com`; email lengkap juga diterima.
- Register publik selalu membuat akun ber-role `siswa`; role tidak bisa dipilih dari formulir.
- Login admin dan siswa menggunakan halaman `/login` yang sama. Role akun menentukan dashboard dan hak akses; formulir registrasi publik hanya membuat akun siswa. Endpoint administrasi dilindungi middleware role.
- Animasi antarmuka yang halus, responsif untuk layar kecil, background liquid-metal interaktif yang bereaksi terhadap posisi kursor, efek chrome-perak pada tombol/panel kaca, dukungan reduced-motion, dan toggle SFX opsional di kanan bawah (preferensi disimpan di browser).
- Role `admin` dan `siswa`; siswa hanya dapat melihat inventaris, melihat transaksi miliknya, dan mengajukan peminjaman.
- CRUD data alat: tambah, lihat, edit, hapus.
- CRUD pengguna (khusus admin).
- Pengajuan peminjaman alat oleh siswa.
- Admin menyetujui/menolak peminjaman.
- Persetujuan mengurangi stok yang tersedia; penolakan tidak mengurangi stok.
- Pengembalian mencatat kondisi dan menambah kembali stok.
- Validasi form dan proteksi CSRF bawaan Laravel.

## Perilaku login/register
- Pada login dan register, input `iqbal123` akan disimpan/diperiksa sebagai `iqbal123@gmail.com`. Input `iqbal123@gmail.com` juga diterima tanpa menambahkan domain dua kali. Alamat email lengkap dengan domain lain juga diterima jika formatnya valid.
- Otomatis menambahkan domain tidak memverifikasi kepemilikan Gmail. Jika perlu verifikasi kepemilikan email, tambahkan alur verifikasi email sebelum aplikasi dipakai secara publik.
- SFX dibuat dengan Web Audio API dan hanya diaktifkan setelah pengguna menyalakan toggle; suara dapat dimatikan kapan saja. Browser mungkin memerlukan interaksi pengguna sebelum audio diputar.

## Catatan penting
- Paket ini merupakan starter aplikasi; bukan file `vendor` Laravel lengkap.
- Data statistik/daftar di dashboard berasal dari database.
- Sistem mengurangi stok ketika peminjaman disetujui. Untuk produksi, tambahkan transaksi database dan penguncian baris (`lockForUpdate`) jika banyak petugas dapat memproses peminjaman bersamaan.
- Untuk lingkungan produksi, gunakan HTTPS, password unik, backup database, dan konfigurasi email/reset password.
