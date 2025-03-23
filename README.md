# Simangga

Simangga adalah aplikasi berbasis Laravel untuk manajemen anggaran.

## Persyaratan
Sebelum menjalankan proyek ini, pastikan Anda telah menginstal:
- PHP (>= 8.0)
- Composer
- Node.js dan NPM
- MySQL atau database lain yang kompatibel
- Git

## Instalasi

1. **Kloning Repository**
   ```bash
   git clone https://github.com/fahmifath/simangga.git
   cd simangga
   ```

2. **Instal Dependensi Composer**
   ```bash
   composer install
   ```

3. **Instal Dependensi NPM**
   ```bash
   npm install
   ```

4. **Salin File Environment**
   ```bash
   cp .env.example .env
   ```

5. **Generate Kunci Aplikasi**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi Database**
   - Buka file `.env`
   - Sesuaikan konfigurasi database, misalnya:
     ```ini
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nama_database
     DB_USERNAME=root
     DB_PASSWORD=password
     ```

7. **Jalankan Migrasi Database**
   ```bash
   php artisan migrate
   ```

8. **Jalankan Server Laravel**
   ```bash
   php artisan serve
   ```
   Akses aplikasi melalui `http://localhost:8000/si-mangga`.

