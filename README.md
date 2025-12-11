# 🚀 Laravel Project Setup Guide

Panduan lengkap untuk instalasi dan konfigurasi project Laravel setelah cloning dari GitHub.

---

## 📌 Persyaratan Sistem
Pastikan sudah menginstal:

- PHP 8.x atau sesuai kebutuhan Laravel
- Composer
- Git
- MySQL / MariaDB
- Node.js & NPM
- Ekstensi PHP:
  - openssl  
  - pdo  
  - mbstring  
  - tokenizer  
  - xml  
  - ctype  
  - json  

Cek versi:

```bash
php -v
composer -v
git --version
node -v
npm -v
```

---

## 📥 Clone Repository

```bash
git clone https://github.com/USERNAME/NAMA-REPO.git
cd NAMA-REPO
```

---

## 📦 Install Dependencies

### Composer
```bash
composer install
```

### Node Modules (jika memakai Vite/Mix)
```bash
npm install
```

---

## ⚙️ Setup Environment

### Salin file .env
```bash
cp .env.example .env
```
Windows:
```bash
copy .env.example .env
```

---

## 🔑 Generate APP_KEY
```bash
php artisan key:generate
```

---

## 🗄️ Konfigurasi Database

Edit file `.env`:

```
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi:

```bash
php artisan migrate
```

Jika ada seeder:

```bash
php artisan db:seed
```

---

## 📁 Storage Link

```bash
php artisan storage:link
```

Jika error:
```bash
php artisan storage:link --force
```

---

## 🔐 Permission (Linux/Mac)

```bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
```

Atau:

```bash
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
```

---

## 🚀 Menjalankan Aplikasi

### Laravel Server:
```bash
php artisan serve
```

Akses di:
```
http://127.0.0.1:8000
```

### Menjalankan Vite:
```bash
npm run dev
```

---

## 🛠 Troubleshooting

### Composer error (extensi PHP kurang)
Aktifkan melalui `php.ini` atau instal paket yang diperlukan.

### Storage tidak muncul
Pastikan folder berikut ada:
```
storage/app/public
public/storage
```

Lalu ulangi:
```bash
php artisan storage:link
```

### Node error
```bash
rm -rf node_modules
npm install
```

### DB error
Pastikan:
- nama DB benar  
- user/pass sesuai  
- permission database benar  

---

## 📜 Lisensi
Gunakan file **LICENSE** dalam repository jika tersedia. Jika tidak, hak cipta tetap pada pemilik repository.

