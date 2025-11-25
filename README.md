# TP9DPBO2425C2

/*saya Ajipati Alaga Putra dengan NIM 2409682
mengerjakan TP9 dalam mata kuliah DPBO
untuk keberkahannya maka saya tidak akan melakukan kecurangan
sepertu yang telah di spesifikasikan Aamiin.*/

# 📘 README — Desain Program + UML Lengkap (ASCII)

Semua diagram memakai **ASCII** (background item / block hitam) dan seluruh penjelasan juga **di dalam block** sesuai permintaan.

---

# 1. 📌 Desain Program (Ringkasan)
```
Aplikasi manajemen Pembalap & Sirkuit menggunakan arsitektur MVP
(Model–View–Presenter) dengan database MySQL.

Struktur utama:
- Model  : TabelPembalap, TabelSirkuit, Pembalap, Sirkuit, DB (PDO wrapper)
- View   : ViewPembalap, ViewSirkuit, skin.html, form.html
- Presenter: PresenterPembalap, PresenterSirkuit
- Router: index.php (mengatur page/nav/screen)
```


# 2. 🎭 Use Case Diagram (ASCII)
```
   [Admin]
     |
     +---> (Melihat daftar pembalap)
     |
     +---> (Menambah pembalap)
     |
     +---> (Mengedit pembalap)
     |
     +---> (Menghapus pembalap)
     |
     +---> (Melihat daftar sirkuit)
     |
     +---> (Menambah sirkuit)
     |
     +---> (Mengedit sirkuit)
     |
     +---> (Menghapus sirkuit)
```

**Penjelasan**
```
Admin melakukan operasi CRUD pada kedua entity.
```

---

# 3. 🔃 Sequence Diagram — Tambah Pembalap
```
Admin -> Browser: Klik "Tambah Pembalap"
Browser -> index.php: GET ?page=pembalap&screen=add
index.php -> PresenterPembalap: tampilkanForm()

PresenterPembalap -> ViewPembalap: tampilForm()
ViewPembalap -> Browser: render HTML form

Admin -> Browser: Submit form (POST)
Browser -> index.php: POST data pembalap
index.php -> PresenterPembalap: tambah()

PresenterPembalap -> TabelPembalap: add()
TabelPembalap -> DB: INSERT
DB -> Presenter: success

Presenter -> index.php: redirect
index.php -> Browser: tampilkan daftar pembalap
```

**Penjelasan**
```
Form POST harus punya field: nama, tim, negara, poinMusim, jumlahMenang.
```

---

# 4. ❌ Sequence Diagram — Hapus Sirkuit
```
Admin -> Browser: Klik tombol "Delete"
Browser -> JS: buat POST {nav=sirkuit, action=delete, id=X}

Browser -> index.php: POST delete
index.php -> PresenterSirkuit: hapus(id)

PresenterSirkuit -> TabelSirkuit: delete(id)
TabelSirkuit -> DB: DELETE FROM sirkuit WHERE id=:id
DB -> Presenter: success

Presenter -> index.php: redirect ke list
Browser: render ulang daftar sirkuit (tanpa data yang dihapus)
```

**Penjelasan**
```
Delete gagal kalau:
- form tidak kirim nav/action/id
- index.php tidak menangkap POST
- query delete salah nama kolom/tabel
```

---

# 5. 🔁 Activity Diagram — Tambah Data Umum
```
[Start]
   |
   v
Tampilkan Form
   |
   v
User Input -> Submit
   |
   v
Validasi Input?
   |-- NO --> Tampilkan Error -> [End]
   |
   v
Model Insert ke DB
   |
   v
Jika sukses -> Redirect ke List
   |
   v
[End]
```


# 6. 🧩 Mapping Struktur File
```
index.php
 - routing page/nav/screen
 - handle POST add/edit/delete

models/
 - DB.php (PDO)
 - Pembalap.php, Sirkuit.php
 - TabelPembalap.php
 - TabelSirkuit.php

presenters/
 - PresenterPembalap.php
 - PresenterSirkuit.php

views/
 - ViewPembalap.php
 - ViewSirkuit.php
 - skin.html
 - form.html
```

---

#Dokumentasi

