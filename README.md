# LMS SMK (Learning Management System)

## Deskripsi

LMS SMK adalah aplikasi berbasis web yang dirancang untuk membantu proses belajar mengajar di Sekolah Menengah Kejuruan (SMK). Aplikasi ini memiliki empat role utama, yaitu Admin, Guru, Siswa, dan Kepala Sekolah, sehingga seluruh proses pembelajaran dapat dikelola dalam satu sistem.

Aplikasi dikembangkan menggunakan Laravel 10 dengan arsitektur MVC (Model-View-Controller) serta menggunakan Blade Template, HTML, CSS, JavaScript, Bootstrap 5, dan MySQL.

---

#  Fitur Utama

## Admin

* Login & Logout
* Dashboard
* CRUD Data Guru
* CRUD Data Siswa
* CRUD Data Kepala Sekolah
* CRUD Kelas
* CRUD Mata Pelajaran
* CRUD Tahun Ajaran
* CRUD Pengumuman
* Kelola seluruh data sistem
* Edit Profil
* Ganti Password

---

## Guru

* Login & Logout
* Dashboard
* Melihat kelas yang diajar
* CRUD Materi Pembelajaran
* Upload file materi (PDF, DOCX, PPT, PPTX)
* CRUD Tugas
* Melihat pengumpulan tugas
* Memberikan nilai
* Memberikan komentar pada tugas
* Melihat daftar siswa
* Edit Profil
* Ganti Password

---

## Siswa

* Login & Logout
* Dashboard
* Melihat materi
* Download materi
* Melihat tugas
* Upload jawaban tugas
* Melihat komentar guru
* Melihat nilai
* Melihat pengumuman
* Edit Profil
* Ganti Password

---

## Kepala Sekolah

Dashboard monitoring yang berisi:

* Jumlah Guru
* Jumlah Siswa
* Jumlah Kelas
* Jumlah Mata Pelajaran
* Jumlah Materi
* Jumlah Tugas
* Rekap Pengumpulan Tugas
* Rekap Nilai
* Daftar Guru
* Daftar Siswa
* Daftar Mata Pelajaran
* Daftar Kelas
* Daftar Pengumuman

> Kepala sekolah hanya memiliki hak akses **melihat data (read-only)** dan tidak dapat menambah, mengubah, atau menghapus data.

---

# Teknologi

| Teknologi  | Versi                   |
| ---------- | ----------------------- |
| Laravel    | 10                      |
| PHP        | 8.1 atau Lebih          |
| MySQL      | 8+                      |
| Bootstrap  | 5                       |
| HTML       | 5                       |
| CSS        | 3                       |
| JavaScript | ES6                     |
| Blade      | Laravel Template Engine |

---

# Struktur Project

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── Guru/
│   │   ├── Siswa/
│   │   └── Kepsek/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Providers/

database/
├── migrations/
├── seeders/

public/
├── css/
├── js/
├── images/
└── uploads/

resources/
├── views/
│   ├── layouts/
│   ├── admin/
│   ├── guru/
│   ├── siswa/
│   ├── kepsek/
│   └── auth/

routes/
├── web.php

storage/
```

---

# Database

Tabel utama yang digunakan:

* users
* classes
* subjects
* materials
* assignments
* submissions
* announcements
* academic_years

---

# Hak Akses

| Fitur                 | Admin | Guru | Siswa | Kepala Sekolah |
| --------------------- | :---: | :--: | :---: | :------------: |
| Login                 |   ✅   |   ✅  |   ✅   |        ✅       |
| Dashboard             |   ✅   |   ✅  |   ✅   |        ✅       |
| Kelola Guru           |   ✅   |   ❌  |   ❌   |        ❌       |
| Kelola Siswa          |   ✅   |   ❌  |   ❌   |        ❌       |
| Kelola Kelas          |   ✅   |   ❌  |   ❌   |        ❌       |
| Kelola Mata Pelajaran |   ✅   |   ❌  |   ❌   |        ❌       |
| Upload Materi         |   ❌   |   ✅  |   ❌   |        ❌       |
| Download Materi       |   ❌   |   ❌  |   ✅   |        ✅       |
| Membuat Tugas         |   ❌   |   ✅  |   ❌   |        ❌       |
| Upload Jawaban        |   ❌   |   ❌  |   ✅   |        ❌       |
| Memberikan Nilai      |   ❌   |   ✅  |   ❌   |        ❌       |
| Melihat Nilai         |   ❌   |   ✅  |   ✅   |        ✅       |
| Monitoring Data       |   ✅   |   ❌  |   ❌   |        ✅       |

---

# Alur Penggunaan

## Admin

```
Login
   │
Dashboard
   │
Kelola Data
   │
Logout
```

## Guru

```
Login
   │
Dashboard
   │
Upload Materi
   │
Membuat Tugas
   │
Menilai Tugas
   │
Logout
```

## Siswa

```
Login
   │
Dashboard
   │
Melihat Materi
   │
Mengerjakan Tugas
   │
Upload Jawaban
   │
Melihat Nilai
   │
Logout
```

## Kepala Sekolah

```
Login
   │
Dashboard Monitoring
   │
Melihat Laporan
   │
Logout
```

---

# Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/username/lms-smk.git
```

## 2. Masuk ke Folder Project

```bash
cd lms-smk
```

## 3. Install Dependency

```bash
composer install
```

## 4. Salin File Environment

```bash
cp .env.example .env
```

## 5. Generate Application Key

```bash
php artisan key:generate
```

## 6. Atur Konfigurasi Database

Sesuaikan file `.env`.

```env
DB_DATABASE=lms_smk
DB_USERNAME=root
DB_PASSWORD=
```

## 7. Jalankan Migrasi

```bash
php artisan migrate
```

## 8. (Opsional) Jalankan Seeder

```bash
php artisan db:seed
```

## 9. Buat Symbolic Link Storage

```bash
php artisan storage:link
```

## 10. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi melalui:

```
http://127.0.0.1:8000
```

---


---

# Lisensi

Proyek ini dikembangkan sebagai media pembelajaran dan tugas akademik. Silakan gunakan, modifikasi, dan kembangkan sesuai kebutuhan dengan tetap mencantumkan atribusi kepada pengembang asli apabila dipublikasikan.

---

# 👨‍💻 Pengembang

**LMS SMK**

Dikembangkan menggunakan Laravel 12, Bootstrap 5, HTML, CSS, JavaScript, dan MySQL sebagai contoh implementasi sederhana sistem Learning Management System untuk Sekolah Menengah Kejuruan (SMK).
