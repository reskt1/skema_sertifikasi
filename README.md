Sistem Sertifikasi 

Pembuat: Muhammad Resky Azzamy XII RPL 1

Petunjuk singkat instalasi dan menjalankan aplikasi
1. Sebelum menjalankan aplikasi, pastikan komputer sudah memiliki:

- PHP 8.3 atau lebih baru.
- Composer.
- MySQL.
- Node.js dan NPM.
- Web browser.
- Web server lokal seperti Laragon, XAMPP, atau server bawaan Laravel.

2. Masuk ke folder project

ketik di CMD atau Powershell untuk masuk ke dalam folder project
cd skema_sertifikasi_resky

3. Install dependency laravel

ketik di CMD atau Powershell
composer install

4. siapkan file Environment

Buat file `.env` dari `.env.example`.
caranya
- buka CMD atau Powershell
- lalu ketik Copy-Item .env.example .env

5. Generate Application Key

Ketik lagi
php artisan key:generate

6. Jalankan Migration dan Seeder

Ketikan 
php artisan migrate 

Dan
php artisan db:seed

7. Jalankan Website 

Ketikan php aritisan serve 
lalu buka urlnya 

8. Login ke Dashboard

Loginkan dengan email admin@gmail.com dan password admin123
