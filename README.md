# Pustaka Booking - Website Perpustakaan Online✨
Ini merupakan proyek yang mengintegrasikan materi yang telah saya pelajari dalam mata kuliah Web Programming 1 hingga 3. Kami ditugaskan untuk mengembangkan sebuah website menggunakan framework CodeIgniter 3 dan framework tampilan Bootstrap. Website ini dirancang sebagai perpustakaan online, dengan fokus pada fitur-fitur yang memungkinkan pengguna untuk mencari, melihat, dan meminjam buku secara digital. Proyek ini dibuat untuk memenuhi tugas Web Programming 1 hingga 3, yang mencakup berbagai konsep penting yang telah dipelajari selama perkuliahan, mulai dari dasar pengembangan web hingga implementasi framework PHP dan tampilan responsif.
## 🚀 Tech Stack Used
- HTML, CSS , Javascript
- Bootstrap
- PHP, CodeIgniter 3


## 🖼️ Tampilan Website
**Dashboard**

![firefox_iCMhnh3s5l](https://github.com/user-attachments/assets/7e886fe7-0e4b-4449-a488-bfc684284022)

**Detail Buku**

![firefox_iCMhnh3s5l](https://github.com/user-attachments/assets/481e9dae-5d0e-463a-aca4-fbd4edfac2e9)

## 🛠️ Tampilan Admin
**Dashboard Admin**

![firefox_aTNgoDxWIX](https://github.com/user-attachments/assets/2dc1f696-0b6b-4537-8583-4c0e3414b703)

**Data Peminjam**

![firefox_iCMhnh3s5l](https://github.com/user-attachments/assets/b01302c5-2581-475b-9b9c-f321dabcd110)

**Data Buku**

![firefox_iCMhnh3s5l](https://github.com/user-attachments/assets/b012ec2f-5ce9-4b52-966a-72af7132e138)

## 👤Tampilan User
**Profile User**

![firefox_L1OXxRCkcn](https://github.com/user-attachments/assets/9f85d0e8-3fcc-48ec-9f39-2b8bb99e0172)
**Keranjang User**

![firefox_iCMhnh3s5l](https://github.com/user-attachments/assets/b012ec2f-5ce9-4b52-966a-72af7132e138)





## 🔧 Panduan Instalasi

### Prasyarat

- **PHP 7.x atau lebih baru**
- **Web Server Apache**
- **MySQL Database Server**

---

### Langkah-langkah Instalasi

#### 1. Clone atau Download Repositori:

**Clone repositori:**

```bash
git clone https://github.com/auliyaapri/Pustaka-Booking.git
cd Pustaka-Booking
```

**Atau download repositori sebagai file ZIP dan ekstrak:**

```bash
cd path/to/extracted-folder
```

---

#### 2. Ubah nama direktori proyek:

Pindahkan folder proyek ke dalam direktori **xampp/htdocs** atau sejenisnya:

```bash
mv Pustaka-Booking pustaka_booking
cd pustaka_booking
```

---


---

#### 3. Buat Basis Data:

- Buat basis data baru di server MySQL Anda dengan nama **`pustaka`**.

---

#### 4. Import Basis Data:

- Import file SQL **`pustaka.sql`** yang disediakan ke dalam basis data MySQL Anda. Pastikan file ini berada di direktori yang sesuai di komputer Anda.

- Gunakan terminal atau alat seperti phpMyAdmin untuk mengimpor:

```bash
mysql -u your-username -p pustaka < path/to/pustaka.sql
```

- Jika menggunakan phpMyAdmin, unggah file SQL tersebut melalui antarmuka import.

---

#### 5. Konfigurasi Aplikasi:

- Perbarui konfigurasi basis data di **`application/config/database.php`**:

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'your-username',
    'password' => 'your-password',
    'database' => 'pustaka',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

---

#### 6. Jalankan Aplikasi:

- Mulai server Apache Anda.
- Buka browser, lalu navigasikan ke **[http://localhost/Pustaka-Booking](http://localhost/Pustaka-Booking)** atau sesuai dengan konfigurasi yang Anda gunakan.

---



