# 📦 Inventory Management Challenge

## Web-Based Inventory, Borrowing, Reporting, and Monitoring System Using Laravel

---

## 📄 Deskripsi Proyek

Aplikasi web berbasis **Laravel 12** yang dikembangkan untuk membantu pengelolaan inventaris kantor secara digital. Aplikasi ini menyediakan fitur pengelolaan kategori barang, data barang, stok, lokasi penyimpanan, kondisi barang, peminjaman, pengembalian, laporan, activity log, serta dashboard monitoring.

---

## 🛠 Built With

<p align="left">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
  <img src="https://img.shields.io/badge/TailwindCSS-Frontend-38B2AC?style=for-the-badge&logo=tailwindcss&logoColor=white">
  <br>
  <img src="https://img.shields.io/badge/Vite-Build-646CFF?style=for-the-badge&logo=vite&logoColor=white">
  <img src="https://img.shields.io/badge/Alpine.js-UI-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white">
  <img src="https://img.shields.io/badge/Laravel_Breeze-Authentication-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <br>
  <img src="https://img.shields.io/badge/REST_API-JSON-02569B?style=for-the-badge">
  <img src="https://img.shields.io/badge/Pest-Testing-8A2BE2?style=for-the-badge">
  <img src="https://img.shields.io/badge/GitHub_Actions-CI/CD-2088FF?style=for-the-badge&logo=githubactions&logoColor=white">
  <br>
  <img src="https://img.shields.io/badge/Azure_App_Service-Deployment-0078D4?style=for-the-badge&logo=microsoftazure&logoColor=white">
  <img src="https://img.shields.io/badge/Azure_MySQL-Database-0078D4?style=for-the-badge&logo=microsoftazure&logoColor=white">
</p>

---

## 👥 Role dan Hak Akses

| Role    | Hak Akses                                                                                  |
| ------- | ------------------------------------------------------------------------------------------ |
| Admin   | Full access ke dashboard, kategori, barang, peminjaman, laporan, activity log, dan profile |
| Staff   | Mengelola kategori, barang, peminjaman, pengembalian, dashboard, dan profile               |
| Manager | Melihat dashboard, laporan, dan profile                                                    |

---

## 🧩 Modul Aplikasi

### 1. Dashboard

Dashboard digunakan untuk memantau kondisi inventaris secara ringkas melalui total jenis barang, total stok tersedia, barang yang sedang dipinjam, stok menipis, stok habis, barang rusak, peminjaman terlambat, grafik peminjaman bulanan, top barang paling sering dipinjam, dan ringkasan produk berdasarkan kategori.

### 2. Kategori Barang

Modul kategori digunakan untuk mengelompokkan barang berdasarkan jenis atau fungsi. Fitur yang tersedia mencakup tambah, edit, hapus, detail kategori, validasi nama kategori agar tidak duplikat, dan pencatatan aktivitas kategori.

### 3. Data Barang

Modul data barang digunakan untuk mengelola inventaris. Field utama barang meliputi kode barang, nama barang, kategori, stok, lokasi penyimpanan, kondisi barang, dan gambar barang.

Fitur yang tersedia meliputi tambah, edit, hapus, detail barang, upload gambar, search, filter, sorting, pagination, generate kode barang otomatis, validasi stok, dan validasi duplikasi barang.

### 4. Peminjaman Barang

Modul peminjaman digunakan untuk mencatat transaksi peminjaman dan pengembalian barang. Field utama peminjaman meliputi nama peminjam, divisi, barang, jumlah, tanggal pinjam, tanggal kembali, dan status.

Saat peminjaman dibuat, stok barang otomatis berkurang. Saat barang dikembalikan, stok otomatis bertambah sesuai kondisi pengembalian.

### 5. Laporan

Modul laporan digunakan untuk melihat dan mengunduh data inventaris. Laporan yang tersedia mencakup laporan barang, laporan peminjaman, barang tersedia, stok menipis, stok habis, barang rusak, dan peminjaman terlambat.

| Format | Keterangan                        |
| ------ | --------------------------------- |
| PDF    | Export laporan dalam bentuk PDF   |
| Excel  | Export laporan dalam bentuk Excel |
| CSV    | Export laporan dalam bentuk CSV   |

### 6. Activity Log

Activity log digunakan untuk mencatat aktivitas penting pengguna, seperti menambahkan data, mengubah data, menghapus data, mencatat peminjaman, dan mencatat pengembalian barang.

---

## 🗃️ Database Schema

### Tabel Utama

| Tabel               | Deskripsi                             |
| ------------------- | ------------------------------------- |
| `users`             | Menyimpan data pengguna               |
| `roles`             | Menyimpan data role pengguna          |
| `categories`        | Menyimpan kategori barang             |
| `products`          | Menyimpan data barang                 |
| `borrowings`        | Menyimpan data transaksi peminjaman   |
| `borrowing_details` | Menyimpan detail barang yang dipinjam |
| `activity_logs`     | Menyimpan riwayat aktivitas pengguna  |

### Relasi Utama

```text
roles 1 ─── * users
categories 1 ─── * products
borrowings 1 ─── * borrowing_details
products 1 ─── * borrowing_details
users 1 ─── * activity_logs
```

---

## 📁 Database SQL

File database SQL tersedia pada folder:

```text
database/sql/inventory_management_azure.sql
```

File ini merupakan hasil export database dari Azure MySQL dan berisi struktur tabel serta data demo untuk kebutuhan testing dan presentasi.

### Cara Import Database SQL

1. Buat database MySQL baru, misalnya:

```sql
CREATE DATABASE inventory_management;
```

2. Import file SQL:

```bash
mysql -u root -p inventory_management < database/sql/inventory_management_azure.sql
```

3. Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=
```

4. Jalankan project Laravel.

---

## 📂 Struktur Folder

```bash
inventory-management-challenge/
├── app/
│   ├── Exports/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   ├── Auth/
│   │   │   ├── ActivityLogController.php
│   │   │   ├── BorrowingController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ProfileController.php
│   │   │   └── ReportController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   └── Models/
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── sql/
│       └── inventory_management_azure.sql
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   ├── api.php
│   ├── auth.php
│   ├── console.php
│   └── web.php
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── .github/
│   └── workflows/
│       └── inventory-management-ayesha.yml
│
├── public/
├── storage/
├── bootstrap/
├── config/
├── lang/
├── ssl/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## ⚙️ Instalasi Lokal

### 1. Clone Repository

```bash
git clone https://github.com/yeshaa23/inventory-management-challenge.git
cd inventory-management-challenge
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Buat File Environment

```bash
cp .env.example .env
```

Untuk Windows Command Prompt, gunakan:

```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Gunakan konfigurasi MySQL berikut pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=telkomsel_inventory
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Jalankan Migration dan Seeder

Jika ingin membuat database dari migration dan seeder:

```bash
php artisan migrate --seed
```

Jika ingin menggunakan database demo dari file SQL, import file berikut:

```text
database/sql/inventory_management_azure.sql
```

### 8. Buat Storage Link

```bash
php artisan storage:link
```

---

## ▶️ Cara Menjalankan Project

Jalankan Laravel server:

```bash
php artisan serve
```

Jalankan Vite development server:

```bash
npm run dev
```

Akses aplikasi melalui:

```text
http://127.0.0.1:8000
```

Untuk membuat build frontend production:

```bash
npm run build
```

Untuk reset database lokal:

```bash
php artisan migrate:fresh --seed
```

---

## 👤 Akun Login Testing

Gunakan akun berikut untuk mencoba aplikasi.

| Role    | Email                                             | Password |
| ------- | ------------------------------------------------- | -------- |
| Admin   | [admin@example.com](mailto:admin@example.com)     | password |
| Staff   | [staff@example.com](mailto:staff@example.com)     | password |
| Manager | [manager@example.com](mailto:manager@example.com) | password |

---

## 🔌 REST API Documentation

Project ini menyediakan REST API sederhana untuk mengakses data inventaris, kategori, peminjaman, dan dashboard dalam format JSON.

REST API ini bersifat **read-only**, sehingga endpoint digunakan untuk mengambil data tanpa mengubah data utama aplikasi.

### Daftar Endpoint

| Method | Endpoint               | Description                          |
| ------ | ---------------------- | ------------------------------------ |
| GET    | `/api/dashboard`       | Menampilkan ringkasan data dashboard |
| GET    | `/api/products`        | Menampilkan daftar barang            |
| GET    | `/api/products/{id}`   | Menampilkan detail barang            |
| GET    | `/api/categories`      | Menampilkan daftar kategori          |
| GET    | `/api/borrowings`      | Menampilkan daftar peminjaman        |
| GET    | `/api/borrowings/{id}` | Menampilkan detail peminjaman        |

### Query Parameter Produk

Endpoint `/api/products` mendukung parameter berikut:

| Parameter     | Contoh                           | Keterangan                                                   |
| ------------- | -------------------------------- | ------------------------------------------------------------ |
| `search`      | `/api/products?search=laptop`    | Mencari barang berdasarkan kode, nama, lokasi, atau kategori |
| `category_id` | `/api/products?category_id=1`    | Filter barang berdasarkan kategori                           |
| `status`      | `/api/products?status=low_stock` | Filter status barang                                         |
| `per_page`    | `/api/products?per_page=5`       | Mengatur jumlah data per halaman                             |

Status yang tersedia:

```text
available
low_stock
out_of_stock
damaged
```

### Query Parameter Peminjaman

Endpoint `/api/borrowings` mendukung parameter berikut:

| Parameter  | Contoh                            | Keterangan                                                               |
| ---------- | --------------------------------- | ------------------------------------------------------------------------ |
| `search`   | `/api/borrowings?search=IT`       | Mencari berdasarkan nama peminjam, divisi, kode barang, atau nama barang |
| `status`   | `/api/borrowings?status=borrowed` | Filter status peminjaman                                                 |
| `per_page` | `/api/borrowings?per_page=5`      | Mengatur jumlah data per halaman                                         |

Status yang tersedia:

```text
borrowed
returned
overdue
```

### Contoh Request

```text
GET /api/products
GET /api/products?search=laptop
GET /api/products?status=low_stock
GET /api/borrowings?status=borrowed
GET /api/dashboard
```

### Contoh Response

```json
{
  "success": true,
  "message": "Product list retrieved successfully",
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 10,
    "total": 0
  }
}
```

### Test REST API Lokal

Jalankan project, lalu akses endpoint berikut melalui browser atau Postman:

```text
http://127.0.0.1:8000/api/products
http://127.0.0.1:8000/api/categories
http://127.0.0.1:8000/api/borrowings
http://127.0.0.1:8000/api/dashboard
```

Cek daftar route API:

```bash
php artisan route:list --path=api
```

---

## 🧪 Testing

Project ini menggunakan **Pest** untuk automated testing.

Jalankan seluruh test:

```bash
php artisan test
```

Jalankan test dengan coverage:

```bash
php artisan test --coverage
```

Jalankan test dengan minimum coverage:

```bash
php artisan test --coverage --min=60
```

### Area Testing

| Test File                                   | Fokus Pengujian                                    |
| ------------------------------------------- | -------------------------------------------------- |
| `tests/Feature/Auth/AuthenticationTest.php` | Login dan logout pengguna                          |
| `tests/Feature/Auth/RegistrationTest.php`   | Register pengguna baru                             |
| `tests/Feature/Auth/PasswordResetTest.php`  | Forgot password dan reset password                 |
| `tests/Feature/CategoryManagementTest.php`  | CRUD kategori dan validasi kategori                |
| `tests/Feature/InventoryFeatureTest.php`    | Alur utama inventory, peminjaman, dan pengembalian |
| `tests/Feature/ProductManagementTest.php`   | CRUD barang, search, filter, dan generate kode     |
| `tests/Feature/ProductValidationTest.php`   | Validasi stok, kode unik, dan duplikasi barang     |
| `tests/Feature/ProfileTest.php`             | Profile, password, dan delete account              |
| `tests/Feature/RoleAccessTest.php`          | Hak akses berdasarkan role                         |
| `tests/Unit/ActivityLogTest.php`            | Pencatatan activity log                            |
| `tests/Unit/BorrowingModelTest.php`         | Status peminjaman                                  |
| `tests/Unit/ExportClassTest.php`            | Mapping data export                                |
| `tests/Unit/ProductStockStatusTest.php`     | Status stok barang                                 |

---

## 🚀 Live Demo

Project ini sudah dideploy dan dapat diakses melalui link berikut:

```text
https://inventory-management-ayesha-e0gphndhftgacyd8.indonesiacentral-01.azurewebsites.net
```

Gunakan akun login testing pada bagian **Akun Login Testing** untuk mencoba fitur aplikasi.

### REST API Live Demo

Endpoint REST API juga dapat diakses melalui domain deployment:

```text
https://inventory-management-ayesha-e0gphndhftgacyd8.indonesiacentral-01.azurewebsites.net/api/products
https://inventory-management-ayesha-e0gphndhftgacyd8.indonesiacentral-01.azurewebsites.net/api/categories
https://inventory-management-ayesha-e0gphndhftgacyd8.indonesiacentral-01.azurewebsites.net/api/borrowings
https://inventory-management-ayesha-e0gphndhftgacyd8.indonesiacentral-01.azurewebsites.net/api/dashboard
```

---

## 🔄 CI/CD

Project ini menggunakan GitHub Actions melalui workflow:

```text
.github/workflows/inventory-management-ayesha.yml
```

Workflow ini digunakan untuk menjalankan proses build, test, dan deployment otomatis ketika terdapat perubahan pada branch `main`.

Tahapan CI/CD:

```text
Push / Pull Request to main
        ↓
Checkout source code
        ↓
Setup PHP 8.2
        ↓
Install Composer dependencies
        ↓
Setup Node.js
        ↓
Build frontend assets
        ↓
Prepare Laravel test environment
        ↓
Run automated tests
        ↓
Prepare production artifact
        ↓
Deploy to Azure App Service
        ↓
Post-deploy smoke test
```

Deployment menggunakan publish profile dari Azure App Service yang disimpan pada GitHub Repository Secrets.

---

## 🔐 Security Notes

* File `.env` tidak disimpan di repository.
* Konfigurasi production disimpan melalui environment variables.
* Database password dan app key tidak ditulis di source code.
* `APP_DEBUG` pada production diset ke `false`.
* Aplikasi production menggunakan HTTPS.
* Secret deployment disimpan melalui GitHub Secrets.
* REST API dibuat read-only untuk kebutuhan demo dan dokumentasi.

---

## 🤖 Dokumentasi Penggunaan AI

AI digunakan sebagai alat bantu dalam proses pengembangan project. Penggunaan AI dilakukan sebagai pendukung proses pengembangan. Setiap kode yang dibantu oleh AI tetap diperiksa, disesuaikan, dijalankan, dan diperbaiki secara manual agar sesuai dengan kebutuhan project.

| Area          | Bantuan AI                                                                                           | Validasi dan Modifikasi Manual                                       |
| ------------- | ---------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------- |
| Frontend      | Membantu merapikan layout form dan halaman laporan                                                   | Menyesuaikan tampilan dengan kebutuhan project                       |
| Backend       | Membantu memperbaiki controller dan kode error                                                       | Menyesuaikan kode dengan model, migration, route, dan database       |
| Testing       | Membantu memperbaiki feature test serta unit test                                                    | Membuat, menjalankan test lokal, dan menyesuaikan assertion                    |
| Deployment    | Membantu konfigurasi environment variables, startup command, dan SSL CA                              | Menguji langsung di Azure App Service dan memperbaiki error dari log |

---

## 📄 License

Project ini dibuat untuk kebutuhan challenge, pembelajaran, dan demonstrasi implementasi aplikasi inventory berbasis Laravel.
