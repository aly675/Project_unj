---

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">Laravel App - Project UNJ</h2>

---

## ✨ Tentang Project

Project ini dibuat menggunakan [Laravel](https://laravel.com/), framework PHP yang modern, mudah dikembangkan, dan powerful untuk membangun aplikasi web.
Struktur kode sudah menggunakan fitur-fitur seperti migration, Eloquent ORM, Blade, dan sistem autentikasi bawaan.

---

## 🚀 **Mulai Cepat**

1. **Clone repository**

   ```bash
   git clone https://github.com/username/namaproject.git
   cd namaproject
   ```

2. **Install dependency**

   ```bash
   composer install
   ```

3. **Copy environment**

   ```bash
   cp .env.example .env
   ```

4. **Generate app key**

   ```bash
   php artisan key:generate
   ```

5. **Setup database**

   * Buat database di MySQL/MariaDB, edit file `.env` bagian DB sesuai setting lokalmu.

6. **Jalankan migration dan (jika ada) seeder**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Storage symlink (agar upload gambar bisa diakses)**

   ```bash
   php artisan storage:link
   ```

8. **Jalankan project**

   ```bash
   php artisan serve
   ```

   Akses di [http://localhost:8000](http://localhost:8000)

---

## 🛠️ **Panduan Git untuk Developer**

### **Tarik Perubahan (Pull)**

Selalu lakukan pull sebelum memulai kerja:

```bash
git pull origin main
```

---

### **Push Kode - Standar Commit**

**WAJIB:**

* Gunakan prefix **Feat:** jika commit untuk *menambah fitur baru*
* Gunakan prefix **Fix:** jika commit untuk *perbaikan bug*

#### **Contoh:**

```bash
# Untuk menambah fitur baru:
git add .
git commit -m "Feat: Tambah fitur booking ruangan"
git push origin main

# Untuk memperbaiki bug:
git add .
git commit -m "Fix: Perbaiki validasi upload gambar ruangan"
git push origin main
```

---

### **Langkah Standar Workflow**

1. **Tarik kode terbaru:**
   `git pull origin main`
2. **Lakukan perubahan, tes di lokal**
3. **Add & commit dengan pesan sesuai format**
4. **Push ke remote:**
   `git push origin main`

---

## 📚 **Referensi & Dokumentasi**

* [Laravel Docs](https://laravel.com/docs)
* [Laracasts (Video Belajar)](https://laracasts.com)
* [Laravel Bootcamp](https://bootcamp.laravel.com)

---

## ❤️ **Kontribusi**

Kontribusi sangat terbuka!
Baca pedoman di [CONTRIBUTING.md](CONTRIBUTING.md) sebelum pull request.

---

## ⚖️ **Lisensi**

Project ini berlisensi [MIT License](https://opensource.org/licenses/MIT).

---

**Happy coding! 🚀**
