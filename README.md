---

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h2 align="center">Project UNJ - Laravel Web Application</h2>

---

## 🚀 Tentang Project

**Project UNJ** adalah aplikasi berbasis web menggunakan [Laravel](https://laravel.com/).
Dikembangkan untuk memenuhi kebutuhan manajemen ruangan, fasilitas, dan aktivitas kampus secara efisien dan terstruktur.

---

## 🛠️ Cara Setup Project

1. **Clone Repository**

   ```bash
   git clone https://github.com/aly675/Project_unj.git
   cd Project_unj
   ```

2. **Install Dependency**

   ```bash
   composer install
   ```

3. **Copy dan Edit .env**

   ```bash
   cp .env.example .env
   # Edit file .env, sesuaikan database, dll
   ```

4. **Generate App Key**

   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Seeder (jika ada)**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Buat Storage Link**

   ```bash
   php artisan storage:link
   ```

7. **Jalankan Server**

   ```bash
   php artisan serve
   ```

   Akses: [http://localhost:8000](http://localhost:8000)

---

## 🔄 Panduan Git (Wajib Developer Baca!)

### **1. Selalu Pull Sebelum Mulai**

```bash
git pull origin main
```

### **2. Format Commit Saat Push**

* **Feat:** untuk penambahan/fitur baru
* **Fix:** untuk perbaikan bug

**Contoh:**

```bash
# Fitur baru:
git add .
git commit -m "Feat: Tambah fitur export PDF laporan ruangan"
git push origin main

# Fix bug:
git add .
git commit -m "Fix: Perbaiki validasi login"
git push origin main
```

---

### **Workflow Ringkas**

1. `git pull origin main`
2. Lakukan perubahan & tes lokal
3. `git add .`
4. Commit dengan pesan sesuai format di atas
5. `git push origin main`

---

## 📚 Referensi

* [Laravel Official Documentation](https://laravel.com/docs)
* [Laracasts (Tutorial Video)](https://laracasts.com)
* [Laravel Bootcamp](https://bootcamp.laravel.com)

---

## ❤️ Kontribusi

Kontribusi sangat terbuka! Silakan pull request, saran, atau issue.
Baca [CONTRIBUTING.md](CONTRIBUTING.md) jika tersedia.

---

## ⚖️ Lisensi

[MIT License](https://opensource.org/licenses/MIT)

---

**Happy coding & selamat berkarya di Project UNJ! 🚀**

---

> Copy-paste saja README ini ke repo-mu!
> Kalau mau tambah bagian lain (fitur, demo, atau lain-lain), tinggal bilang saja!
