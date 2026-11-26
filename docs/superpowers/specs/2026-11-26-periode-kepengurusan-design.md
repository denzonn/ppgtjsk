# Desain: Periode Kepengurusan, Akun per Periode, dan Log Aktivitas

Tanggal: 2026-11-26 · Branch dasar: `feature/admin-ui-file-url`

## Tujuan & alasan

Setiap periode kepengurusan PPGT bekerja di datanya sendiri. Pengurus baru tidak bisa melihat atau mengubah
data periode lalu, dan akun hanya berlaku selama periodenya. Data yang sifatnya berkelanjutan (inventaris,
keuangan, anggota, dan lain-lain) diwariskan ke periode berikutnya, dan setiap perubahannya tercatat
(siapa, periode apa, apa yang diubah) supaya ada akuntabilitas saat serah terima.

## Sasaran

1. Master **Periode** (tahun mulai–tahun selesai).
2. Akun admin terikat ke satu periode. Login hanya bisa selama periode masih aktif.
3. Data **per periode** terisolasi. Data **warisan** berlanjut antar periode dan tercatat di log.
4. Master **Bidang** dan **Jabatan** dibuat per periode, dengan tombol "Pakai format periode sebelumnya".
5. Bidang punya **maksimal orang**.
6. **Log aktivitas** untuk semua perubahan data admin, beserta halaman untuk melihatnya.
7. Semua data yang sudah ada dimasukkan ke periode **2024–2026**.

## Bukan sasaran

- Website publik/end user (ditunda ke tahap berikutnya).
- Menyalin (snapshot) data warisan setiap kali pergantian periode.
- Approval atau workflow serah terima selain aturan "1 akun" di bawah.

## Anti-sasaran (dianggap gagal walaupun "jalan")

- Ada endpoint web atau API yang masih bisa membaca atau mengubah data per periode milik periode lain.
- Akun periode yang sudah lewat masih bisa login, atau sesi lamanya masih jalan setelah tahun berganti.
- Inventaris yang hilang tidak bisa dilacak lagi (log hapus wajib menyimpan salinan lengkap datanya).

## Aturan periode

- Tabel `periodes`: `id`, `tahun_mulai`, `tahun_selesai`, `dibuat_oleh` (user_id, nullable), timestamps. Kombinasi
  (tahun_mulai, tahun_selesai) unik.
- **Aktif** artinya `tahun_mulai <= tahun sekarang <= tahun_selesai`. Contoh: di 2026, periode 2024–2026 dan 2026–2028
  sama-sama aktif. Itu tidak masalah karena setiap akun terikat ke periodenya sendiri.
- Periode lama yang tidak punya akun (misalnya sejarah 2018–2020 di Profil) tetap boleh ada sebagai record.

## Akun & hak akses

- `users.periode_id` (nullable, FK ke `periodes`).
- **Admin utama**: `role = ADMIN` dan `periode_id = null`. Bisa membuat periode, membuat akun di periode mana pun,
  memilih periode yang sedang dilihat lewat dropdown di navbar (disimpan di session), dan melihat semua log.
  *Keputusan saya:* semua akun ADMIN yang ada sekarang menjadi admin utama.
- **Admin periode**: `role = ADMIN` dan `periode_id` terisi. Hanya bisa bekerja di periodenya sendiri, dan bisa membuat
  akun lain untuk periodenya sendiri.
- **Serah terima**: admin periode P boleh membuat **periode berikutnya** (yang `tahun_mulai` = `P.tahun_selesai`) kalau
  periode itu belum ada. Dia juga boleh membuat **tepat 1 akun** di periode berikutnya. Batas ini dicek dengan
  menghitung akun di periode tujuan yang `dibuat_oleh`-nya user dari periode P (kolom `users.dibuat_oleh`).
- **Blokir saat periode selesai**: dicek di login web (`LoginController`), login API (`Api\AuthController`), dan di
  middleware `isAdmin` serta guard API. Dengan begitu sesi atau token yang masih jalan juga ditolak setelah tahun
  berganti. Admin utama tidak pernah diblokir.
- Menu baru **Akun** untuk membuat, melihat, dan menghapus akun (tidak bisa menghapus diri sendiri). Menu baru **Periode** untuk admin utama dan
  untuk serah terima.

## Klasifikasi data

**Per periode** (kolom `periode_id`, terisolasi):
Bidang (`bidangs`), Jabatan (`jabatan_bidangs`), Pengurus (`anggota_bidangs`), Foto KSB (`foto_ksbs`),
Program Kerja (`program_kerjas`), Notulensi Rapat (`notulensi_rapats`), Artikel (`artikels`),
Kegiatan (`kegiatans`), Galeri Kegiatan (`gallery_kegiatans`).

**Profil/Sejarah** (`profils`): kolom teks `periode` diganti menjadi `periode_id`. Semua admin bisa melihat dan
mengubah profil periode mana pun, dan semua perubahannya tercatat di log.

**Warisan** (tanpa `periode_id`, berlanjut terus, setiap perubahan tercatat di log; log hapus menyimpan salinan lengkap data — tanpa soft delete, karena `site_images.key` unik dan soft delete akan bentrok):
Inventaris dan Jenis Inventaris, Data Anggota, Pemasukan, Pengeluaran, Piutang, Iuran, Dokumen, isi Beranda
(Renungan, Kegiatan Mingguan, FAQ, Sekilas Anggota, Link Terkait, Pundi Kasih, Gambar Situs), Saran.
Inventaris juga dapat kolom `periode_id` nullable yang berarti "ditambahkan di periode", supaya barang baru di
periode sekarang terlihat langsung di daftar.

## Pendekatan (yang dipertimbangkan)

| Keputusan | Dipilih | Alternatif | Alasan |
|---|---|---|---|
| Isolasi per periode | Trait `BerPeriode` di model: global scope `where periode_id = periode aktif` dan otomatis mengisi `periode_id` saat create | `where` manual di setiap controller | Controller web dan API ada puluhan. Satu yang terlewat sudah cukup untuk membocorkan data. Trait memasang aturannya di satu tempat. |
| Data warisan | Satu tabel berlanjut dan log (hapus = salinan lengkap di log) | Menyalin data ke periode baru setiap pergantian | Data dan foto tidak dobel, dan selisih antar periode terbaca dari log. |
| Log | Tabel sendiri `activity_logs` dan trait `TercatatDiLog` (event created/updated/deleted) | `spatie/laravel-activitylog` | Kebutuhannya kecil, jadi cukup sekitar 50 baris tanpa menambah dependency. |

Dipilih oleh user: ketiga pilihan di atas ("boleh").

## Komponen

- **Periode aktif**: helper `Periode::aktif()`. Isinya periode milik user yang login. Untuk admin utama, isinya
  periode pilihan di session (default: periode aktif terbaru). Untuk pengunjung publik, nilainya null, jadi tidak ada filter.
- **Trait `BerPeriode`** dipasang di 9 model per periode. Admin utama yang sengaja melihat periode lain cukup mengganti
  pilihan di session. Untuk kebutuhan lintas periode tidak dibuat scope khusus, cukup `withoutGlobalScope`.
- **Trait `TercatatDiLog`** dipasang di semua model admin (per periode, warisan, dan Profil).
  Tabel `activity_logs`: `id`, `user_id`, `periode_id` (periode si pelaku), `aksi` (tambah/ubah/hapus),
  `model` (nama class), `model_id`, `sebelum` (json), `sesudah` (json), `created_at`. Untuk aksi ubah, yang disimpan
  hanya field yang berubah. Kolom `password` dan `remember_token` tidak pernah dicatat.
- **Halaman Log** (`admin/log`): bisa difilter per menu, periode, user, dan aksi, dan dipaginasi. Admin periode
  melihat log dari data warisan dan Profil (dari semua periode, karena data itu milik bersama), ditambah log dari
  data periodenya sendiri. Admin utama melihat semuanya.
- **"Pakai format periode sebelumnya"**: tombol di halaman Bidang dan Jabatan. Tombol ini menyalin `nama_bidang`,
  `foto_bidang`, `maksimal_orang` (atau `nama_jabatan`) dari periode yang `tahun_selesai` = `tahun_mulai` periode aktif.
  Tombol hanya muncul kalau daftar di periode aktif masih kosong, supaya tidak terjadi duplikasi.
- **Maksimal orang**: kolom `bidangs.maksimal_orang` (integer, nullable = tidak dibatasi). Dicek saat menambah atau
  memindahkan Pengurus (web dan API). Kalau penuh, muncul pesan "Bidang X sudah penuh (n orang)".
- **Bidang manajemen** (`is_manajemen`): ditunda ke tahap website publik.

## Migrasi data

1. Buat tabel `periodes`. Insert 2024–2026, lalu insert juga setiap nilai unik `profils.periode` yang formatnya
   `YYYY-YYYY`.
2. Tambah `periode_id` ke 9 tabel per periode, lalu isi semuanya dengan id 2024–2026.
3. Profil: isi `periode_id` dari teks `periode`. Kalau formatnya tidak cocok, pakai 2024–2026. Setelah itu kolom
   `periode` lama dihapus.
4. Tambah `periode_id` (nullable) ke inventaris.
5. Tambah `users.periode_id`, `users.dibuat_oleh`, dan `bidangs.maksimal_orang`.
6. Migrasi harus bisa di-rollback (`down()` mengembalikan kolom `profils.periode` dari relasinya).

## Website publik — DI LUAR LINGKUP (permintaan user: fokus panel admin dulu)

- Controller dan view publik (Beranda, dan seterusnya) tidak diubah.
- Global scope `BerPeriode` **hanya aktif kalau yang login adalah admin**, yaitu di panel admin dan di API dengan
  token admin. Untuk pengunjung tanpa login, query tidak difilter, jadi website publik tetap menampilkan semua data
  seperti sekarang.
- Akibat yang sudah diketahui: begitu periode baru mulai mengisi Pengurus atau Bidang, Beranda akan menampilkan data
  gabungan semua periode, dan logika "bidang id 1 = manajemen" tetap seperti sekarang. Ini diselesaikan di tahap
  berikutnya, yaitu penyesuaian website publik.
- Halaman Profil publik membaca `periode` lewat relasi. Ini satu-satunya penyesuaian kecil di sisi publik, dan
  diperlukan karena kolom teksnya dihapus. Supaya view publik tidak perlu diubah sama sekali, dipakai accessor
  `periode` di model Profil yang mengembalikan "2024-2026".

## Yang diserahkan ke builder

- Tata letak halaman Periode, Akun, dan Log, mengikuti gaya admin Tailwind yang sudah ada dan partial-partialnya.
- Posisi menu baru di sidebar (usulan: grup baru "Sistem" berisi Periode, Akun, Log).
- Bentuk respons API untuk endpoint baru, kalau memang diperlukan (minimal: endpoint yang sudah ada harus ikut ter-scope).
- Test: satu test feature untuk isolasi (akun periode A tidak bisa melihat data periode B), satu untuk blokir login
  periode yang sudah selesai, satu untuk batas serah terima 1 akun, dan satu untuk log yang tercatat saat update.
