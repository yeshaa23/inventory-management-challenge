# 📦 Inventory Management Challenge

## Web-Based Inventory, Borrowing, Reporting, and Monitoring System Using Laravel

---

### 📄 Deskripsi Proyek

Inventory Management Challenge adalah aplikasi web berbasis **Laravel 12** yang dibuat untuk membantu pengelolaan data inventaris kantor secara digital. Aplikasi ini mencakup pengelolaan kategori barang, data barang, stok, lokasi penyimpanan, kondisi barang, peminjaman barang, pengembalian barang, laporan, serta pencatatan aktivitas pengguna.

Project ini dikembangkan sebagai prototype sistem inventory dengan fokus pada **frontend improvement**, **backend configuration**, **role-based access**, **automated testing**, dan **deployment**. Aplikasi ini mendukung tiga role utama, yaitu **Admin**, **Staff**, dan **Manager**, dengan hak akses yang berbeda sesuai kebutuhan pengguna.

---

### 🛠 Built With

<p align="left">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
  <img src="https://img.shields.io/badge/SQLite-Testing-003B57?style=for-the-badge&logo=sqlite&logoColor=white">
  <br>
  <img src="https://img.shields.io/badge/TailwindCSS-Frontend-38B2AC?style=for-the-badge&logo=tailwindcss&logoColor=white">
  <img src="https://img.shields.io/badge/Vite-Build-646CFF?style=for-the-badge&logo=vite&logoColor=white">
  <img src="https://img.shields.io/badge/Alpine.js-UI-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white">
  <br>
  <img src="https://img.shields.io/badge/Pest-Testing-8A2BE2?style=for-the-badge">
  <img src="https://img.shields.io/badge/GitHub_Actions-CI/CD-2088FF?style=for-the-badge&logo=githubactions&logoColor=white">
  <img src="https://img.shields.io/badge/Azure_App_Service-Deployment-0078D4?style=for-the-badge&logo=microsoftazure&logoColor=white">
</p>

---

### ✨ Fitur Utama

- Authentication menggunakan Laravel Breeze
- Login, register, logout, forgot password, dan reset password
- Role-based access control untuk Admin, Staff, dan Manager
- CRUD kategori barang
- CRUD data barang
- Detail barang
- Upload dan preview gambar barang
- Generate kode barang otomatis berdasarkan kategori
- Pencarian, filter, sorting, dan pagination data barang
- Validasi stok, kode barang unik, dan duplikasi barang
- Peminjaman barang dengan pengurangan stok otomatis
- Pengembalian barang dengan pemulihan stok otomatis
- Status peminjaman: borrowed, returned, dan overdue
- Status stok otomatis: tersedia, stok menipis, habis, atau perlu perhatian
- Dashboard monitoring inventory
- Grafik peminjaman per bulan
- Laporan barang dan laporan peminjaman
- Export laporan ke PDF, Excel, dan CSV
- Activity log untuk mencatat aktivitas pengguna
- Multi-language support Bahasa Indonesia dan English
- Automated testing menggunakan Pest
- CI/CD menggunakan GitHub Actions
- Deployment menggunakan Azure App Service

---

### 👥 Role dan Hak Akses

| Role | Hak Akses |
|------|----------|
| Admin | Full access ke dashboard, kategori, barang, peminjaman, laporan, activity log, dan profile |
| Staff | Mengelola kategori, barang, peminjaman, pengembalian, dashboard, dan profile |
| Manager | Melihat dashboard, laporan, dan profile |

---

### 🧩 Modul Aplikasi

#### 1. Dashboard

Dashboard menampilkan ringkasan kondisi inventory, seperti:

- Total jenis barang
- Total stok tersedia
- Barang yang sedang dipinjam
- Barang stok menipis
- Barang habis stok
- Barang rusak
- Peminjaman terlambat
- Grafik peminjaman bulanan
- Top barang paling sering dipinjam
- Ringkasan produk berdasarkan kategori

#### 2. Kategori Barang

Fitur kategori digunakan untuk mengelompokkan barang berdasarkan jenis atau fungsi barang.

Fitur yang tersedia:

- Tambah kategori
- Edit kategori
- Hapus kategori
- Detail kategori
- Validasi nama kategori agar tidak duplikat
- Activity log untuk aktivitas kategori

#### 3. Data Barang

Fitur barang digunakan untuk mengelola data inventory.

Field utama barang:

- Kode barang
- Nama barang
- Kategori
- Stok
- Lokasi penyimpanan
- Kondisi barang
- Gambar barang

Fitur yang tersedia:

- Tambah barang
- Edit barang
- Hapus barang
- Detail barang
- Upload gambar
- Preview gambar
- Search barang
- Filter berdasarkan kategori, kondisi, lokasi, dan status stok
- Sorting data barang
- Generate kode barang otomatis
- Validasi stok dan duplikasi barang

#### 4. Peminjaman Barang

Fitur peminjaman digunakan untuk mencatat barang yang dipinjam.

Field utama peminjaman:

- Nama peminjam
- Divisi
- Barang
- Jumlah
- Tanggal pinjam
- Tanggal kembali
- Status

Fitur yang tersedia:

- Tambah peminjaman
- Riwayat peminjaman
- Detail peminjaman
- Pengembalian barang
- Status borrowed, returned, dan overdue
- Stok otomatis berkurang saat barang dipinjam
- Stok otomatis bertambah saat barang dikembalikan

#### 5. Laporan

Menu laporan digunakan untuk melihat dan mengunduh data inventory.

Jenis laporan:

- Laporan barang
- Laporan peminjaman
- Barang tersedia
- Barang stok menipis
- Barang habis stok
- Barang rusak
- Peminjaman terlambat

Format export:

| Format | Keterangan |
|--------|------------|
| PDF | Export laporan dalam bentuk PDF |
| Excel | Export laporan dalam bentuk Excel |
| CSV | Export laporan dalam bentuk CSV |

#### 6. Activity Log

Activity log digunakan untuk mencatat aktivitas penting yang dilakukan pengguna, seperti:

- Menambahkan data
- Mengubah data
- Menghapus data
- Mencatat peminjaman
- Mencatat pengembalian barang

---

### 🗃️ Database Schema

#### Tabel Utama

| Tabel | Deskripsi |
|------|-----------|
| `users` | Menyimpan data pengguna |
| `roles` | Menyimpan data role pengguna |
| `categories` | Menyimpan kategori barang |
| `products` | Menyimpan data barang |
| `borrowings` | Menyimpan data transaksi peminjaman |
| `borrowing_details` | Menyimpan detail barang yang dipinjam |
| `activity_logs` | Menyimpan riwayat aktivitas pengguna |

#### Relasi Utama

```text
roles 1 ─── * users
categories 1 ─── * products
borrowings 1 ─── * borrowing_details
products 1 ─── * borrowing_details
users 1 ─── * activity_logs
```

---

### 📂 Struktur Folder

```bash
inventory-management-challenge/
│
├── app/
│   ├── Exports/
│   │   ├── BorrowingsExport.php
│   │   └── ProductsExport.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── ConfirmablePasswordController.php
│   │   │   │   ├── EmailVerificationNotificationController.php
│   │   │   │   ├── EmailVerificationPromptController.php
│   │   │   │   ├── NewPasswordController.php
│   │   │   │   ├── PasswordController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   └── VerifyEmailController.php
│   │   │   │
│   │   │   ├── ActivityLogController.php
│   │   │   ├── BorrowingController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── Controller.php
│   │   │   ├── DashboardController.php
│   │   │   ├── ProductController.php
│   │   │   ├── ProfileController.php
│   │   │   └── ReportController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── RoleMiddleware.php
│   │   │   └── SetLocale.php
│   │   │
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   └── LoginRequest.php
│   │       └── ProfileUpdateRequest.php
│   │
│   ├── Models/
│   │   ├── ActivityLog.php
│   │   ├── Borrowing.php
│   │   ├── BorrowingDetail.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── Role.php
│   │   └── User.php
│   │
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   │
│   └── View/
│       └── Components/
│           ├── AppLayout.php
│           └── GuestLayout.php
│
├── bootstrap/
│   ├── app.php
│   ├── providers.php
│   └── cache/
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
│
├── database/
│   ├── factories/
│   │   └── UserFactory.php
│   │
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 0001_01_01_000003_roles.php
│   │   ├── 0001_01_01_000004_user_role.php
│   │   ├── 0001_01_01_000005_categories.php
│   │   ├── 0001_01_01_000006_products.php
│   │   ├── 0001_01_01_000007_borrowings.php
│   │   ├── 0001_01_01_000008_borrowing_details.php
│   │   ├── 2026_07_04_065256_create_activity_logs_table.php
│   │   ├── 2026_07_04_065343_return_fields.php
│   │   ├── 2026_07_04_082841_division.php
│   │   └── 2026_07_05_174317_profile_photo.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RoleSeeder.php
│       └── UserSeeder.php
│
├── lang/
│   ├── en/
│   │   └── app.php
│   └── id/
│       └── app.php
│
├── public/
│   ├── images/
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
│
├── resources/
│   ├── css/
│   │   └── app.css
│   │
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   │
│   └── views/
│       ├── activity-logs/
│       │   └── index.blade.php
│       │
│       ├── auth/
│       │   ├── confirm-password.blade.php
│       │   ├── forgot-password.blade.php
│       │   ├── login.blade.php
│       │   ├── register.blade.php
│       │   ├── reset-password.blade.php
│       │   └── verify-email.blade.php
│       │
│       ├── borrowings/
│       │   ├── create.blade.php
│       │   ├── index.blade.php
│       │   ├── return.blade.php
│       │   └── show.blade.php
│       │
│       ├── categories/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       │
│       ├── components/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── guest.blade.php
│       │   └── navigation.blade.php
│       │
│       ├── products/
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       │
│       ├── profile/
│       │   ├── edit.blade.php
│       │   └── partials/
│       │       ├── delete-user-form.blade.php
│       │       ├── update-password-form.blade.php
│       │       └── update-profile-information-form.blade.php
│       │
│       ├── reports/
│       │   ├── index.blade.php
│       │   └── pdf/
│       │       ├── borrowings.blade.php
│       │       └── products.blade.php
│       │
│       ├── dashboard.blade.php
│       └── welcome.blade.php
│
├── routes/
│   ├── auth.php
│   ├── console.php
│   └── web.php
│
├── ssl/
│   └── DigiCertGlobalRootG2.crt.pem
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── tests/
│   ├── Feature/
│   │   ├── Auth/
│   │   │   ├── AuthenticationTest.php
│   │   │   ├── EmailVerificationTest.php
│   │   │   ├── PasswordConfirmationTest.php
│   │   │   ├── PasswordResetTest.php
│   │   │   ├── PasswordUpdateTest.php
│   │   │   └── RegistrationTest.php
│   │   │
│   │   ├── CategoryManagementTest.php
│   │   ├── InventoryFeatureTest.php
│   │   ├── ProductManagementTest.php
│   │   ├── ProductValidationTest.php
│   │   ├── ProfileTest.php
│   │   └── RoleAccessTest.php
│   │
│   ├── Unit/
│   │   ├── ActivityLogTest.php
│   │   ├── BorrowingModelTest.php
│   │   ├── ExportClassTest.php
│   │   └── ProductStockStatusTest.php
│   │
│   ├── Pest.php
│   └── TestCase.php
│
├── .github/
│   └── workflows/
│       └── inventory-management-ayesha.yml
│
├── default
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── phpunit.xml
├── postcss.config.js
├── tailwind.config.js
├── vite.config.js
└── README.md
```

---

### ⚙️ Instalasi Lokal

#### 1. Clone Repository

```bash
git clone https://github.com/yeshaa23/inventory-management-challenge.git
cd inventory-management-challenge
```

#### 2. Install Dependency PHP

```bash
composer install
```

#### 3. Install Dependency Frontend

```bash
npm install
```

#### 4. Buat File Environment

```bash
cp .env.example .env
```

#### 5. Generate Application Key

```bash
php artisan key:generate
```

#### 6. Konfigurasi Database

Untuk menggunakan SQLite:

```env
DB_CONNECTION=sqlite
```

Buat file database SQLite:

```bash
mkdir -p database
touch database/database.sqlite
```

Atau gunakan MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=
```

#### 7. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

#### 8. Buat Storage Link

```bash
php artisan storage:link
```

---

### ▶️ Cara Menjalankan Project

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

### 👤 Akun Login Testing

Seeder menyediakan akun default berikut untuk testing dan demo.

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Staff | staff@example.com | password |
| Manager | manager@example.com | password |

---

### 🧪 Testing

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

#### Area Testing

| Test File | Fokus Pengujian |
|----------|-----------------|
| `tests/Feature/Auth/AuthenticationTest.php` | Login dan logout pengguna |
| `tests/Feature/Auth/RegistrationTest.php` | Register pengguna baru |
| `tests/Feature/Auth/PasswordResetTest.php` | Forgot password dan reset password |
| `tests/Feature/CategoryManagementTest.php` | CRUD kategori dan validasi kategori |
| `tests/Feature/InventoryFeatureTest.php` | Alur utama inventory, peminjaman, dan pengembalian |
| `tests/Feature/ProductManagementTest.php` | CRUD barang, search, filter, dan generate kode |
| `tests/Feature/ProductValidationTest.php` | Validasi stok, kode unik, dan duplikasi barang |
| `tests/Feature/ProfileTest.php` | Profile, password, dan delete account |
| `tests/Feature/RoleAccessTest.php` | Hak akses berdasarkan role |
| `tests/Unit/ActivityLogTest.php` | Pencatatan activity log |
| `tests/Unit/BorrowingModelTest.php` | Status peminjaman |
| `tests/Unit/ExportClassTest.php` | Mapping data export |
| `tests/Unit/ProductStockStatusTest.php` | Status stok barang |

---

### 🚀 Live Demo

Project ini sudah dideploy dan dapat diakses melalui link berikut:

```text
https://inventory-management-ayesha-e0gphndhftgacyd8.indonesiacentral-01.azurewebsites.net
```

Gunakan akun login testing yang tersedia pada bagian **Akun Login Testing** untuk mencoba fitur aplikasi.

---

### 🔄 CI/CD

Project ini menggunakan GitHub Actions melalui workflow:

```text
.github/workflows/inventory-management-ayesha.yml
```

Workflow ini digunakan untuk menjalankan proses CI/CD secara otomatis ketika terdapat perubahan pada branch `main`.

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
Run automated tests with coverage minimum 60%
        ↓
Upload coverage report
        ↓
Prepare production artifact
        ↓
Deploy to Azure App Service
        ↓
Post-deploy smoke test
```

Deployment menggunakan publish profile yang disimpan pada GitHub Repository Secrets. Secret yang digunakan pada workflow ini adalah publish profile dari Azure App Service.

---

### 🔐 Security Notes

Beberapa hal yang perlu diperhatikan:

- File `.env` tidak disimpan di repository.
- Konfigurasi production disimpan melalui environment variables.
- Database password dan app key tidak ditulis di source code.
- `APP_DEBUG` di production diset ke `false`.
- Aplikasi production menggunakan HTTPS.
- Secret deployment disimpan melalui GitHub Secrets.

---

### 📌 Hasil Implementasi

Hasil implementasi project ini meliputi:

- Aplikasi inventory berhasil berjalan secara lokal dan online.
- Authentication dan role-based access berhasil diterapkan.
- Admin, Staff, dan Manager memiliki hak akses berbeda.
- Data kategori dan barang dapat dikelola melalui UI.
- Upload dan preview gambar barang berhasil diterapkan.
- Peminjaman barang otomatis mengurangi stok.
- Pengembalian barang otomatis mengembalikan stok.
- Dashboard berhasil menampilkan ringkasan inventory dan grafik peminjaman.
- Laporan barang dan peminjaman dapat diexport ke PDF, Excel, dan CSV.
- Activity log berhasil mencatat aktivitas penting pengguna.
- Automated testing berhasil dijalankan menggunakan Pest.
- CI/CD berhasil menjalankan build, test, dan deployment otomatis.

---

### 🤖 Dokumentasi Penggunaan AI

AI digunakan sebagai alat bantu dalam proses pengembangan project, terutama untuk membantu penyusunan kode, debugging error, perbaikan tampilan frontend, penyusunan test case, konfigurasi deployment, dan dokumentasi project.

Penggunaan AI dilakukan sebagai pendukung proses pengembangan. Setiap kode yang dibantu oleh AI tetap diperiksa, disesuaikan, dijalankan, dan diperbaiki secara manual agar sesuai dengan kebutuhan project.

| Area | Bantuan AI | Validasi dan Modifikasi Manual |
|------|------------|--------------------------------|
| Frontend | Membantu merapikan layout login, register, dashboard, form, tabel, dan halaman laporan | Menyesuaikan tampilan dengan kebutuhan project |
| Backend | Membantu memperbaiki controller, validasi form, role access, upload gambar, dan peminjaman | Menyesuaikan kode dengan model, migration, route, dan database |
| Testing | Membantu membuat dan memperbaiki feature test serta unit test | Menjalankan test lokal dan menyesuaikan assertion |
| Deployment | Membantu konfigurasi environment variables, startup command, SSL CA, dan workflow deployment | Menguji langsung di Azure App Service dan memperbaiki error dari log |
| Documentation | Membantu menyusun README agar rapi dan sesuai project | Menyesuaikan isi README dengan fitur project sebenarnya |

---

### 👩‍💻 Author

| Nama | Peran |
|------|------|
| Ayesha Hana Azkiya | Developer |

---

### 📄 License

Project ini dibuat untuk kebutuhan challenge, pembelajaran, dan demonstrasi implementasi aplikasi inventory berbasis Laravel.
