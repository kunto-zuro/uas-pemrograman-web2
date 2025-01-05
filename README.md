# To-Do List Application

## Deskripsi
Aplikasi To-Do List ini adalah aplikasi web sederhana yang memungkinkan pengguna untuk mengelola tugas mereka. Pengguna dapat mendaftar, login, menambahkan, mengedit, dan menghapus tugas. Aplikasi ini juga dilengkapi dengan fitur reset password.

## Folder Path
Pastikan Anda menyimpan semua file aplikasi dalam folder berikut:
```
C:\xampp\htdocs\uas-pemrograman-web2
```

## Struktur Folder
```
todo_app/
│
├── add_user.php           # Halaman untuk registrasi pengguna
├── login.php              # Halaman untuk login pengguna
├── forgot_password.php    # Halaman untuk reset password
├── reset_password.php     # Halaman untuk mengatur password baru
├── index.php              # Halaman utama untuk menampilkan daftar tugas
├── db.php                 # File koneksi ke database
├── style.css              # File CSS untuk styling
└── README.md              # File ini
```

## Cara Akses Aplikasi
1. **Pastikan Anda telah menginstal server web (seperti Apache) dan PHP.**
2. **Buat database dan tabel menggunakan query SQL yang disediakan di bawah ini.**
3. **Akses aplikasi melalui browser dengan URL berikut:**
   - **Halaman Registrasi:** `http://localhost/todo_app/add_user.php`
   - **Halaman Login:** `http://localhost/todo_app/login.php`
   - **Halaman Lupa Password:** `http://localhost/todo_app/forgot_password.php`
   - **Halaman Reset Password:** `http://localhost/todo_app/reset_password.php`
   - **Halaman Utama (Daftar Tugas):** `http://localhost/todo_app/index.php`

## Query untuk Membuat Database dan Tabel
Berikut adalah query SQL untuk membuat database dan tabel yang diperlukan untuk aplikasi ini:

```sql
-- Membuat database
CREATE DATABASE todo_app;

-- Menggunakan database
USE todo_app;

-- Membuat tabel users untuk menyimpan data pengguna
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Membuat tabel password_resets untuk menyimpan token reset password
CREATE TABLE password_resets (
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires INT NOT NULL,
    PRIMARY KEY (token)
);

-- Membuat tabel todo_list untuk menyimpan data tugas
CREATE TABLE todo_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Cara Menggunakan Aplikasi
1. **Registrasi:** Akses halaman registrasi dan isi form untuk membuat akun baru.
2. **Login:** Setelah registrasi, login menggunakan username dan password yang telah dibuat.
3. **Mengelola Tugas:** Setelah login, Anda dapat menambahkan, mengedit, dan menghapus tugas di halaman utama.
4. **Reset Password:** Jika Anda lupa password, gunakan fitur lupa password untuk mengatur ulang password Anda.
