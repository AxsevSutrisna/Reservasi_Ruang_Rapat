# 📘 Dokumentasi Skema Database

## Sistem Reservasi Ruang Rapat

Dokumentasi ini menjelaskan struktur tabel dan hubungan antar tabel pada
sistem **Reservasi Ruang Rapat**.

------------------------------------------------------------------------

## **1. Tabel `users`**

Digunakan untuk menyimpan data seluruh pengguna sistem, termasuk admin
dan karyawan.

### **Struktur Tabel**

| Kolom                    | Tipe                         | Keterangan                                       |
| ----------------------- | ---------------------------- | -------------------------------------------- |
| id                         |  BIGINT UNSIGNED        | Primary Key|
| name  |    VARCHAR(255) UNIQUE   | Nama pengguna|
|email              | VARCHAR(255)          |Email pengguna|
|password            |VARCHAR(255)          |Password terenkripsi|
|email_verified_at   |TIMESTAMP             |Waktu verifikasi email|
|remember_token      |VARCHAR(100)          |Token remember me|
|created_at          |TIMESTAMP NULL        |Timestamp dibuat|
|updated_at          |TIMESTAMP NULL        |Timestamp diperbarui|

------------------------------------------------------------------------

## **2. Tabel `reservations`**

### **Struktur Tabel**
| Kolom                    | Tipe                         | Keterangan                                       |
| ----------------------- | ---------------------------- | -------------------------------------------- |
|  id             |  BIGINT UNSIGNED  | Primary Key|
|  user_id       |   BIGINT UNSIGNED | FK → users.id|
|  room_id       |   BIGINT UNSIGNED |  FK → rooms.id|
 | tanggal       |   DATE             | Tanggal pemesanan|
|  waktu_mulai    |  TIME             | Jam mulai|
|  waktu_berakhir  | TIME             | Jam berakhir|
 | tujuan          | TEXT              |Tujuan rapat|
 | created_at     |  TIMESTAMP NULL   | Timestamp dibuat|
|  updated_at   |    TIMESTAMP NULL    |Timestamp diperbarui|



------------------------------------------------------------------------

## **3. Tabel `rooms`**

### **Struktur Tabel**

| Kolom                    | Tipe                         | Keterangan                                       |
| ----------------------- | ---------------------------- | -------------------------------------------- |
|id           |BIGINT UNSIGNED       |Primary Key|
|nama         |VARCHAR(255) UNIQUE   |Nama ruangan|
|kapasitas    |INT                   |Kapasitas maksimal|
|lokasi       |VARCHAR(255) NULL     |Lokasi ruangan|
|deskripsi    |TEXT NULL             |Deskripsi ruangan|
|created_at   |TIMESTAMP NULL       | Timestamp dibuat|
|updated_at   |TIMESTAMP NULL        |Timestamp diperbarui|

------------------------------------------------------------------------

## **Relationship Antar Tabel**

### **1. users → reservations (One-to-Many)**

-   Satu pengguna dapat membuat banyak reservasi.\
-   Relasi:
    -   `reservations.user_id` → `users.id`

### **2. rooms → reservations (One-to-Many)**

-   Satu ruangan dapat digunakan untuk banyak reservasi yang berbeda.\
-   Relasi:
    -   `reservations.room_id` → `rooms.id`

------------------------------------------------------------------------

## ERD (Entity Relationship Diagram)

    +---------+        1     n        +----------------+
    | users   |-----------------------| reservations   |
    +---------+                       +----------------+
          |                                 |
          | 1                               | n
          |                                 |
          |        +----------------+       |
          +--------| rooms          |-------+
                   +----------------+

