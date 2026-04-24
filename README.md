# Aplikasi Parkir

**Aplikasi Parkir** merupakan sistem yang di rancang untuk mempermudahkan Petugas dan
admin untuk mengelola parkir pada lahan parkir yang tersedia. Program ini di buat juga untuk mempermudahkan
pengguna kendaraan bisa reservasi tempat parkir kendaraan mereka.

## Fitur Utama 
   - **Pemantauan Area Parkir** : Pada Program ini admin dan petugas bisa memantau apakah masi ada slot tersedia pada area parkir tersebut , dan admin bisa menambahkan area baru.
   - **Reservasi Area Parkir** : Users / Owner bisa reservasi area parkir dan datang dengan tanggal dan jam yang dia reservasi.
   - **Cetak Struk Parkir** : Petugas dapat cetak struk setelah Owner bayar parkir dengan status keluar parkir / parkir telah selesai.

## Teknologi Digunakan
   -  **PHP 8.2**
   -  **CSS**
   -  **HTML**
   -  **JavaScript**
   -  **Bootstrap**

## Persiapan dan Instalasi

   1. **Clone Repository**
      ```bash
      git clone https://github.com/KuchAli/Parkir_Project.git

      cd Parkir_Project
      ```

    2. **Install Dependensi Backend**
        ```bash
        composer install
        ```
    
    3. **Copy File Environment**
        ```bash
        cp .env.example .env
        ```

    4. **Konfigurasi File .env**
        - Sesuaikan konfigurasi database, dsb

    5. **Generate Application Key**
        ```bash
        php artisan key:generate
        ```

    6. **Migrasi Database**
        ```bash
        php artisan migrate
        ```

    7. **Jalankan Aplikasi**
        ```bash 
        php artisan serve
        ```

## Contoh Penggunaan

- **Login ke Aplikasi**  
  Akses `http://localhost:8000`, login dengan akun admin dan petugas , default (lihat pada seeder atau tanya admin sistem).

## Lisensi

Program Ini Dibuat Oleh : **MisterK**
