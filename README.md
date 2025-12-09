![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white&style=for-the-badge)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white&style=for-the-badge)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white&style=for-the-badge)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white&style=for-the-badge)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black&style=for-the-badge)
![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?logo=chartdotjs&logoColor=white&style=for-the-badge)
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?logo=xampp&logoColor=white&style=for-the-badge)

# 📌 Sistem Antrian dan Survei Kepuasan Masyarakat  
### Dinas Pendidikan dan Kebudayaan Kabupaten Pamekasan  
**Backend Application – PHP & MySQL**

Sistem ini dibuat untuk mendukung proses pelayanan publik di Dinas Pendidikan dan Kebudayaan Kabupaten Pamekasan.  
Fokus utama sistem adalah **pengelolaan antrian** dan **survei kepuasan masyarakat** secara terstruktur, cepat, dan efisien.

---

## 🚀 Fitur Utama

### 👥 Pengunjung
- Mengambil nomor antrian  
- Mengisi form data diri  
- Mencetak nomor antrian  
- Melihat display antrian  
- Mengisi survei kepuasan pelayanan  

### 🛠️ Admin Bidang
- Login dan dashboard survei  
- Memanggil antrian (dengan status: belum, dipanggil, dipanggil ulang, selesai)  
- Melihat display antrian  
- Melihat & mencari data user  
- Mencetak data user  
- Melihat, mencari & mencetak data survei  
- Logout  

### 🏛️ Superadmin
- Kelola bidang (CRUD)  
- Kelola admin bidang  
- Melihat data user semua bidang  
- Melihat & mengelola survei keseluruhan  
- Melihat grafik survei berdasarkan filter (bulan, tahun, bidang, jenis survei)  
- Mengganti password  
- Logout  

---

## 🧩 Teknologi yang Digunakan
- **PHP** (Native)
- **MySQL**  
- **HTML, CSS, JavaScript**
- **XAMPP** (Local Server)
- **Chart.js** untuk visualisasi grafik survei

---

## 🗄️ Struktur Database (Tabel Utama)

- `antrian` — Data nomor antrian & status  
- `pelayanan` — Jenis pelayanan per bidang  
- `bidang` — Daftar bidang layanan  
- `user` — Data pengunjung yang mendaftar  
- `survei` — Data survei kepuasan  
- `loket` — Loket layanan  
- `login` — Data akun superadmin & admin  
- `profil` — Identitas instansi  

---

## 🔄 Alur Sistem Singkat

### **Pengunjung**
1. Datang → pilih menu *Ambil Antrian*  
2. Mengisi data diri  
3. Sistem memberikan nomor antrian → dapat dicetak  
4. Pengunjung menunggu hingga dipanggil  
5. Setelah layanan selesai, pengunjung mengisi survei  

### **Admin Bidang**
1. Login  
2. Melihat dashboard survei  
3. Memanggil antrian → suara otomatis  
4. Mencetak data user atau survei bila diperlukan  

### **Superadmin**
1. Mengelola bidang dan akun admin  
2. Melihat semua data layanan  
3. Mengelola hasil survei  

---

## 📊 Jenis Survei
Pengunjung menilai pelayanan berdasarkan 5 indikator:
- Interaksi petugas  
- Kecepatan pelayanan  
- Ketepatan pelayanan  
- Penanganan masalah  
- Kesalahan pelayanan  

Masing-masing indikator memiliki rating:  
**Sangat Puas – Puas – Netral – Tidak Puas – Sangat Tidak Puas**

---

## Tampilan Superadmin

### Halaman Login Superadmin
![Login Superadmin](assets/img/screenshot/login_superadmin.png)

### Dashboard Superadmin
![Dashboard Superadmin](assets/img/screenshot/dashboard_superadmin.png)

---

## Tampilan Admin

### Dashboard Admin
![Dashboard Admin](assets/img/screenshot/dashboard_admin.png)

### Halaman Panggil Antrian
![Panggil Antrian](assets/img/screenshot/panggil_antrian.png)

---

## Tampilan Display Antrian
![Display Antrian](assets/img/screenshot/display_antrian.png)

---

## Tampilan Pengunjung

### Halaman Mengambil Antrian & Survei
![Menu Pengunjung](assets/img/screenshot/menu_pengunjung.png)

### Halaman Form Data Diri
![Form Data Diri](assets/img/screenshot/form_data_diri.png)

### Halaman Cetak Antrian
![Cetak Antrian](assets/img/screenshot/cetak_antrian.png)

### Halaman Beri Rating
![Beri Rating](assets/img/screenshot/beri_rating.png)

