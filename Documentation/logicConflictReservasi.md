
# Logic Cek Konflik Jadwal Reservasi Ruang Rapat

Dokumentasi ini menjelaskan langkah‑langkah logika (algorithm flow) yang digunakan untuk mencegah bentrok jadwal reservasi ruang rapat sebelum data disimpan ke database.

---
## **Flow Reservasi**

1. User mengisi form reservasi
2. Backend menerima input
3. Backend cek database berdasarkan `room_id` + `tanggal`
4. Backend cek waktu menggunakan logika overlap
5. Jika **tidak ada conflict → Simpan reservasi**
6. Jika **conflict → Tampilkan pesan error**
   
## **Parameter yang Dicek**

Sebelum menyimpan reservasi, sistem memeriksa tiga parameter berikut:

- `room_id` — Ruangan yang dipilih.
- `tanggal` — Tanggal reservasi.
- `waktu_mulai` — Jam mulai.
- `waktu_berakhir` — Jam selesai.

Reservasi tidak boleh bertabrakan dengan jadwal ruangan yang sama pada tanggal yang sama.

---

Konflik terjadi apabila *dua periode waktu beririsan (overlap)*.

### Suatu jadwal dianggap **konflik** jika:
```
(Existing.waktu_mulai <= New.waktu_berakhir)
AND
(New.waktu_mulai <= Existing.waktu_berakhir)
```

---

## **Code Logic Cek Jadwal Overlap**

```php
$reservasiConflict = Reservation::where('room_id', $roomId)
    ->where('tanggal', $tanggal)
    ->where(function ($query) use ($waktuMulai, $waktuBerakhir) {
        $query->whereBetween('waktu_mulai', [$waktuMulai, $waktuBerakhir])
              ->orWhereBetween('waktu_berakhir', [$waktuMulai, $waktuBerakhir])
              ->orWhere(function ($q) use ($waktuMulai, $waktuBerakhir) {
                  $q->where('waktu_mulai', '<=', $waktuMulai)
                    ->where('waktu_berakhir', '>=', $waktuBerakhir);
              });
    })
    ->exists();
```

Jika `$reservasiConflict === true`, maka sistem menolak reservasi.

---

## **Visualisasi Logika**

Misalkan jadwal lama:

```
09:00 — 11:00
```

Kasus jadwal baru:

| Jadwal Baru        | Bentrok? | Alasan |
|-------------------|-----------|--------|
| 08.00–09.00       | Tidak  | Tidak bersinggungan |
| 09.00–10.00       | Ya     | Mulai tepat saat jadwal lama mulai |
| 10.00–11.00       | Ya     | Beririsan |
| 11.00–12.00       | Tidak  | Tidak ada overlap |
| 08.00–12.00       | Ya     | Mencakup seluruh rentang waktu lama |

---

