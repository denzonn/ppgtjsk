# Periode Kepengurusan Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Panel admin dibagi per periode kepengurusan. Akun terikat ke periode dan hanya bisa dipakai selama periodenya aktif. Data per periode terisolasi, data warisan berlanjut antar periode, dan semua perubahan tercatat di log.

**Architecture:** Model `Periode` dan helper `Periode::aktif()` menentukan konteks periode untuk request admin. Trait `BerPeriode` memasang global scope dan mengisi `periode_id` otomatis, tapi hanya kalau yang login adalah ADMIN, jadi website publik tidak berubah. Trait `TercatatDiLog` menulis ke `activity_logs` lewat event Eloquent. Middleware `periode.aktif` memblokir akun yang periodenya sudah lewat, baik di web maupun API.

**Tech Stack:** Laravel 12, PHP 8.3, MySQL (produksi), SQLite in-memory (test), Passport (API), Blade dan Tailwind v4 (admin).

**Spec:** `docs/superpowers/specs/2026-11-26-periode-kepengurusan-design.md`

## Global Constraints

- Periode memakai tahun saja: `tahun_mulai`, `tahun_selesai`. Aktif artinya `tahun_mulai <= now()->year <= tahun_selesai`.
- Semua data yang sudah ada masuk ke periode **2024–2026**.
- Model per periode (9): `Bidang`, `JabatanBidang`, `AnggotaBidang`, `FotoKsb`, `ProgramKerja`, `NotulensiRapat`, `Artikel`, `Kegiatan`, `GalleryKegiatan`.
- Model warisan: `Inventaris`, `JenisInventaris`, `DataAnggota`, `PemasukanKeuangan`, `PengeluaranKeuangan`, `PiutangKeuangan`, `Iuran`, `Dokument`, `RenunganHarian`, `KegiatanMingguan`, `faq`, `SekilasAnggota`, `LinkTerkait`, `PundiKasih`, `SiteImage`, `Saran`, ditambah `Admin\Profil`.
- Admin utama: `role = 'ADMIN'` dan `periode_id = null`. Admin periode: `role = 'ADMIN'` dan `periode_id` terisi.
- Website publik dan Beranda **tidak disentuh**. Untuk pengunjung tanpa login, scope tidak aktif.
- Tidak ada dependency baru. Tidak ada soft delete.
- `password` dan `remember_token` tidak pernah ditulis ke log.
- Teks UI memakai Bahasa Indonesia dan mengikuti gaya view admin yang sudah ada (`resources/views/pages/admin/**`, `layouts/admin.blade.php`).
- Test memakai `$this->withoutVite()` dan `RefreshDatabase`.

## Review Focus

1. **Tahun 2026, ketika dua periode sama-sama aktif.** Akun 2024–2026 dan akun 2026–2028 harus sama-sama bisa login, dan masing-masing hanya melihat datanya sendiri. (Task 1: test `test_dua_periode_aktif_di_tahun_peralihan`.)
2. **Akses langsung lewat URL ke data periode lain**, misalnya `admin/bidang/{id}/edit` dengan id milik periode lain. Harus menghasilkan 404, bukan menampilkan form. (Task 2: `test_edit_data_periode_lain_404`.)
3. **Sesi login yang sudah berjalan saat periode berakhir.** Request berikutnya harus logout lalu diarahkan ke halaman login. (Task 3: `test_sesi_aktif_diputus_setelah_periode_lewat`.)
4. **Saat pengurus dipindah ke bidang yang sudah penuh lewat form edit**, permintaan harus ditolak. Sebaliknya, kalau pengurus diedit tanpa pindah bidang, tidak boleh dihitung dua kali. (Task 6: `test_edit_pengurus_di_bidang_penuh_tetap_boleh`.)
5. **Nilai lama di log harus nilai mentah**, misalnya path foto yang relatif, bukan URL hasil cast `PublicUrl`. (Task 4: `test_log_menyimpan_nilai_mentah`.)

---

### Task 1: Master Periode, kolom user, dan test harness

**Files:**
- Create: `phpunit.xml` (sqlite `:memory:`, `APP_ENV=testing`, `BCRYPT_ROUNDS=4`, `SESSION_DRIVER=array`)
- Create: `tests/TestCase.php`, `tests/Feature/PeriodeTest.php`
- Create: `database/migrations/2026_11_26_000001_create_periodes_table.php`
- Create: `app/Models/Periode.php`
- Modify: `app/Models/User.php`
- Modify: `database/factories/UserFactory.php` (state `admin(?Periode $p = null)`)

**Interfaces:**
- Produces: `Periode` (`tahun_mulai`, `tahun_selesai`, `dibuat_oleh`), `Periode::isAktif(): bool`, `Periode::aktif(): ?Periode`, `Periode::sebelumnya(): ?Periode` (periode dengan `tahun_selesai` = `$this->tahun_mulai`), `Periode::label(): string` → `"2024-2026"`.
- Produces: `User::periode()` (belongsTo), `User::isAdminUtama(): bool`, `User::bolehMasuk(): bool` (admin utama → true; selain itu `periode?->isAktif()`). Kolom `users.periode_id` dan `users.dibuat_oleh` masuk ke `$fillable`.
- Produces: `UserFactory::admin(?Periode $p)` membuat user dengan `role = ADMIN` dan `periode_id = $p?->id`.

- [ ] **Step 1: Tulis test yang gagal** di `tests/Feature/PeriodeTest.php`:
  - `test_periode_aktif_berdasarkan_tahun`: `Carbon::setTestNow('2026-06-01')`. Periode 2024–2026 `isAktif()` → true, 2021–2023 → false, 2027–2029 → false.
  - `test_dua_periode_aktif_di_tahun_peralihan`: di 2026, user A (2024–2026) dan user B (2026–2028) sama-sama `bolehMasuk()` → true. Setelah `setTestNow('2027-01-01')`, A → false dan B → true.
  - `test_aktif_untuk_admin_periode_dan_utama`: `actingAs(A)` → `Periode::aktif()->id === A->periode_id`. `actingAs(utama)` dengan session `periode_id` = B → B. `actingAs(utama)` tanpa session → periode aktif dengan `tahun_mulai` terbesar. Tanpa login → null. User dengan role USER → null.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter PeriodeTest`. Hasil yang diharapkan: FAIL (class `Periode` belum ada).
- [ ] **Step 3: Migrasi.** Buat tabel `periodes` (id, `tahun_mulai` smallint, `tahun_selesai` smallint, `dibuat_oleh` nullable FK ke users dengan nullOnDelete, timestamps, unique(tahun_mulai, tahun_selesai)). Insert baris 2024–2026. Tambah `users.periode_id` (nullable FK, nullOnDelete) dan `users.dibuat_oleh` (nullable FK ke users, nullOnDelete). `down()` menghapus semuanya.
- [ ] **Step 4: Implementasi `Periode` dan helper di `User`.** `Periode::aktif()`: kalau user tidak login atau role bukan ADMIN → null. Kalau user punya `periode_id` → `$user->periode`. Selain itu (admin utama) → `Periode::find(session('periode_id'))` (hanya kalau `request()->hasSession()`), dengan fallback periode aktif yang `tahun_mulai`-nya terbesar, lalu periode terbaru.
- [ ] **Step 5:** Jalankan `php vendor/bin/phpunit --filter PeriodeTest`. Hasil yang diharapkan: PASS.
- [ ] **Step 6: Commit** `feat: master periode kepengurusan dan relasi user`

### Task 2: Isolasi data per periode (trait `BerPeriode`) dan migrasi data

**Files:**
- Create: `app/Models/Concerns/BerPeriode.php`
- Create: `database/migrations/2026_11_26_000002_add_periode_id_to_data_per_periode.php`
- Modify: 9 model per periode (lihat Global Constraints): tambah `use BerPeriode`, dan tambah `periode_id` ke `$fillable`. Perbaiki juga typo `$tabel` di `Bidang.php` menjadi `$table`.
- Modify: `database/seeders/BidangSeeder.php`, `JabatanBidangSeeder.php`, `KsbSeeder.php`: isi `periode_id` dengan periode 2024–2026 (`Periode::firstOrCreate`).
- Modify: `routes/web.php`: pindahkan `Route::delete('kegiatan/checked', ...)` ke dalam grup `admin` (sekarang route ini bisa diakses tanpa login).
- Test: `tests/Feature/IsolasiPeriodeTest.php`

**Interfaces:**
- Consumes: `Periode::aktif()`
- Produces: trait `BerPeriode`. `bootBerPeriode()` menambah global scope `'periode'` (`where {table}.periode_id = aktif->id`, hanya kalau `Periode::aktif()` tidak null) dan event `creating` (isi `periode_id` dengan `Periode::aktif()?->id` kalau masih kosong). Relasi `periode()`.

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_admin_periode_hanya_melihat_bidang_periodenya`: Bidang "Lama" ada di P1, Bidang "Baru" ada di P2. Akun P2 membuka `GET route('bidang.index')` → ada teks "Baru", tidak ada teks "Lama".
  - `test_edit_data_periode_lain_404`: akun P2 membuka `GET route('bidang.edit', bidangLama)` → 404. Begitu juga `DELETE route('bidang.destroy', bidangLama)` → 404, dan datanya masih ada di database.
  - `test_data_baru_otomatis_masuk_periode_akun`: akun P2 POST `route('jabatan.store')` dengan `nama_jabatan` = 'Ketua' → di database tercatat dengan `periode_id = P2`.
  - `test_api_ikut_terisolasi`: `Passport::actingAs(akunP2, [], 'api')`, lalu `GET /api/bidang` → JSON hanya berisi "Baru".
  - `test_publik_tidak_difilter`: tanpa login, `Bidang::count() === 2`.
  - `test_kegiatan_checked_butuh_login`: tanpa login, `DELETE route('checked-activity')` → redirect ke login.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter IsolasiPeriodeTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3: Migrasi.** Tambah `periode_id` (nullable FK ke `periodes`, cascadeOnDelete) ke tabel: `bidangs`, `jabatan_bidangs`, `anggota_bidangs`, `foto_ksbs`, `program_kerjas`, `notulensi_rapats`, `artikels`, `kegiatans`, `gallery_kegiatans`. Setelah itu `update(['periode_id' => id 2024–2026])` untuk semua baris yang sudah ada.
- [ ] **Step 4:** Implementasikan trait, pasang di 9 model, perbaiki seeder dan route.
- [ ] **Step 5:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 6: Commit** `feat: isolasi data per periode untuk admin dan API`

### Task 3: Blokir akun yang periodenya sudah selesai

**Files:**
- Create: `app/Http/Middleware/PeriodeAktif.php`
- Modify: `app/Http/Kernel.php` (alias `'periode.aktif'`)
- Modify: `routes/web.php` (grup admin: `['auth', 'isAdmin', 'periode.aktif']`), `routes/api.php` (grup `auth:api` ditambah `'periode.aktif'`)
- Modify: `app/Http/Controllers/Auth/LoginController.php` (`authenticated()`), `app/Http/Controllers/Api/AuthController.php` (cek sebelum membuat token)
- Test: `tests/Feature/LoginPeriodeTest.php`

**Interfaces:**
- Consumes: `User::bolehMasuk()`
- Produces: middleware `periode.aktif`. Kalau `!bolehMasuk()`: untuk web → logout, invalidate session, lalu redirect ke `route('login')` dengan error `email` = "Masa periode {label} sudah berakhir." Untuk JSON → hapus token yang sedang dipakai, lalu balas 403 dengan pesan yang sama.

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_login_ditolak_periode_lewat`: `setTestNow('2026-06-01')`, user dari periode 2021–2023 POST `/login` → `assertGuest()` dan session punya error `email`.
  - `test_login_periode_aktif_berhasil`: user dari periode 2024–2026 → redirect ke `/admin/dashboard`.
  - `test_sesi_aktif_diputus_setelah_periode_lewat`: `actingAs(user 2024–2026)`, lalu `setTestNow('2027-01-02')`, lalu `GET /admin/dashboard` → redirect ke login dan `assertGuest()`.
  - `test_api_login_ditolak_periode_lewat`: POST `/api/login` → bukan 200 dan tidak ada `token` di respons.
  - `test_admin_utama_tidak_pernah_diblokir`.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter LoginPeriodeTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3:** Implementasi.
- [ ] **Step 4:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 5: Commit** `feat: akun hanya bisa dipakai selama periodenya aktif`

### Task 4: Log aktivitas

**Files:**
- Create: `database/migrations/2026_11_26_000003_create_activity_logs_table.php`. Tabel `activity_logs`: id, `user_id` (nullable FK, nullOnDelete), `periode_id` (nullable FK, nullOnDelete), `per_periode` bool, `aksi` enum('tambah','ubah','hapus'), `model` string, `model_id` unsignedBigInteger, `sebelum` json nullable, `sesudah` json nullable, `created_at`. Index pada (`model`, `model_id`). Migrasi yang sama juga menambah `inventaris.periode_id` (nullable FK, nullOnDelete) dan mengisinya dengan id 2024–2026.
- Create: `app/Models/ActivityLog.php`, `app/Models/Concerns/TercatatDiLog.php`
- Modify: semua model per periode, model warisan, dan `Admin\Profil` (tambah `use TercatatDiLog`). Untuk `User`, juga pakai trait ini dengan `password` dan `remember_token` dikecualikan.
- Modify: `app/Models/Inventaris.php`: tambah `periode_id` ke fillable, relasi `periode()`, dan `creating` mengisi `periode_id` dengan `Periode::aktif()?->id` kalau kosong. Model ini **tidak** memakai `BerPeriode`.
- Modify: `resources/views/pages/admin/inventaris/index.blade.php`: tambah kolom "Masuk Periode".
- Test: `tests/Feature/LogAktivitasTest.php`

**Interfaces:**
- Consumes: `Periode::aktif()`, trait `BerPeriode` (untuk mengisi `per_periode = in_array(BerPeriode::class, class_uses_recursive($model))`)
- Produces: `ActivityLog` (cast `sebelum`/`sesudah` ke array, relasi `user()`, `periode()`), `ActivityLog::LABEL` (array: class → nama menu, misalnya `Inventaris::class => 'Inventaris'`), `scopeTerlihatOleh($q, User $u)` (admin utama melihat semua; admin periode melihat `per_periode = false` ATAU `periode_id = $u->periode_id`).
- Isi log: `tambah` → `sesudah` = atribut mentah. `ubah` → `sebelum` = `getRawOriginal()` dan `sesudah` = `getChanges()`, keduanya hanya untuk key yang berubah dan tanpa `updated_at`. Kalau setelah filter tidak ada yang berubah, log tidak ditulis. `hapus` → `sebelum` = semua atribut mentah. `periode_id` log = `Periode::aktif()?->id`.

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_ubah_inventaris_tercatat_hanya_field_berubah`: akun P1 PUT `inventaris.update` dengan `jumlah` dari 3 menjadi 2 → ada log `aksi = ubah`, `sebelum = ['jumlah' => 3]`, `sesudah = ['jumlah' => 2]`, `user_id` = akun, `periode_id` = P1.
  - `test_hapus_menyimpan_salinan_lengkap`: DELETE inventaris → `sebelum['nama']` sama dengan nama barang, dan barisnya sudah tidak ada di tabel.
  - `test_log_menyimpan_nilai_mentah`: ubah `photo` → `sebelum['photo']` diawali `assets/` dan bukan `http`.
  - `test_password_tidak_dicatat`: update password user → tidak ada key `password` di log mana pun.
  - `test_inventaris_baru_mencatat_periode_masuk`: akun P2 membuat inventaris → `periode_id = P2`, dan akun P1 tetap bisa melihatnya (karena warisan).
  - `test_visibilitas_log`: log per_periode dari P1 tidak terlihat oleh akun P2 lewat `ActivityLog::terlihatOleh(P2user)`. Log Inventaris dari P1 tetap terlihat.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter LogAktivitasTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3:** Implementasi.
- [ ] **Step 4:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 5: Commit** `feat: log aktivitas untuk semua perubahan data admin`

### Task 5: Kelola Periode dan Akun (termasuk serah terima 1 akun)

**Files:**
- Create: `app/Http/Controllers/Admin/PeriodeController.php` (index, create, store, pilih), `app/Http/Controllers/Admin/AkunController.php` (index, create, store, destroy)
- Create: `resources/views/pages/admin/periode/{index,create}.blade.php`, `resources/views/pages/admin/akun/{index,create}.blade.php`
- Modify: `app/Models/User.php`: tambah aturan hak akses
- Modify: `routes/web.php`: `Route::resource('periode', ...)->only(['index','create','store'])`, `Route::post('periode/pilih', ...)->name('periode.pilih')`, `Route::resource('akun', ...)->only(['index','create','store','destroy'])`
- Test: `tests/Feature/AkunPeriodeTest.php`

**Interfaces:**
- Consumes: `Periode::sebelumnya()`, `User::isAdminUtama()`
- Produces:
  - `User::bolehBuatPeriode(int $mulai, int $selesai): bool`. Admin utama → true. Admin periode → `$mulai === periode->tahun_selesai`.
  - `User::bolehBuatAkunDi(Periode $p): bool`. Admin utama → true. Periode sendiri → true. Periode berikutnya (`$p->tahun_mulai === periode->tahun_selesai`) → true hanya kalau `User::where('periode_id', $p->id)->whereIn('dibuat_oleh', id semua user periode sendiri)->doesntExist()`. Selain itu → false.
  - `PeriodeController@store` memvalidasi `tahun_selesai > tahun_mulai`, kombinasi tahun unik, dan `bolehBuatPeriode` (403 kalau tidak boleh). Field `dibuat_oleh` diisi `auth()->id()`.
  - `PeriodeController@pilih` hanya untuk admin utama (403 untuk yang lain). Menyimpan `session(['periode_id' => ...])` lalu kembali ke halaman sebelumnya.
  - `AkunController@store` memvalidasi `name`, `email` (unik), `password` (min 8, confirmed), `periode_id` (exists). Kalau `bolehBuatAkunDi` false → error validasi `periode_id` "Akun serah terima untuk periode ini sudah dibuat." atau 403 kalau periodenya bukan periode berikutnya. Field `role` diisi 'ADMIN' dan `dibuat_oleh` diisi `auth()->id()`.
  - `AkunController@index`: admin utama melihat semua akun ADMIN dikelompokkan per periode. Admin periode melihat akun periodenya sendiri. Dropdown periode di form create hanya berisi periode yang `bolehBuatAkunDi`.
  - `AkunController@destroy`: tidak boleh menghapus diri sendiri (error). Admin periode hanya boleh menghapus akun di periodenya sendiri (selain itu 403).

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_admin_periode_buat_akun_periode_sendiri_berkali_kali`: dua kali POST → dua user dengan `periode_id = P(2024–2026)`.
  - `test_serah_terima_hanya_satu_akun`: P2 (2026–2028) sudah ada. Akun P1 membuat 1 akun di P2 → berhasil. Akun P1 lainnya membuat akun kedua di P2 → error di `periode_id` dan jumlah user P2 tetap 1.
  - `test_tidak_bisa_buat_akun_di_periode_lain`: akun P1 membuat akun di 2028–2030 → 403.
  - `test_admin_periode_hanya_buat_periode_berikutnya`: akun P1 membuat 2026–2028 → berhasil. Membuat 2030–2032 → 403.
  - `test_admin_utama_pilih_periode`: POST `periode.pilih` → `session('periode_id')` terisi. Admin periode melakukan hal yang sama → 403.
  - `test_tidak_bisa_hapus_diri_sendiri`.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter AkunPeriodeTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3:** Implementasi controller, view (ikuti pola form di `resources/views/pages/admin/pengurus/jabatan/create.blade.php`), dan route.
- [ ] **Step 4:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 5: Commit** `feat: kelola periode dan akun dengan serah terima satu akun`

### Task 6: Maksimal orang per bidang dan salin format periode sebelumnya

**Files:**
- Create: `database/migrations/2026_11_26_000004_add_maksimal_orang_to_bidangs.php` (`maksimal_orang` unsignedInteger nullable)
- Modify: `app/Models/Bidang.php`: fillable `maksimal_orang`, relasi `pengurus()` (hasMany `AnggotaBidang`, `bidangs_id`), `sudahPenuh(?int $kecualiPengurusId = null): bool`
- Modify: `app/Http/Controllers/Admin/BidangController.php`, `JabatanController.php`: tambah `salinFormat()`
- Modify: `app/Http/Controllers/Admin/PengurusController.php` (store, update), `app/Http/Controllers/Api/PengurusController.php` (store, update): tolak kalau bidang penuh
- Modify: view bidang create/edit/index (input "Maksimal orang", tombol "Pakai format periode sebelumnya"), view jabatan index (tombol yang sama)
- Modify: `routes/web.php`: `POST bidang-salin-format` → `bidang.salin-format`, `POST jabatan-salin-format` → `jabatan.salin-format` (didaftarkan sebelum `Route::resource`)
- Test: `tests/Feature/BidangPeriodeTest.php`

**Interfaces:**
- Consumes: `Periode::aktif()`, `Periode::sebelumnya()`
- Produces: `salinFormat()` menyalin dari `withoutGlobalScope('periode')->where('periode_id', sebelumnya->id)` untuk Bidang (`nama_bidang`, `foto_bidang` dengan path mentah lewat `getRawOriginal`, `maksimal_orang`) dan Jabatan (`nama_jabatan`) ke periode aktif, dalam satu transaksi. Kalau daftar di periode aktif sudah ada isinya atau tidak ada periode sebelumnya, kembali dengan error. Tombol hanya ditampilkan kalau daftar kosong dan `Periode::aktif()?->sebelumnya()` tidak null.
- Pesan kalau penuh (error di field `bidangs_id`): `"Bidang {nama} sudah penuh ({n} orang)."`

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_salin_format_bidang_dari_periode_sebelumnya`: P1 punya 5 bidang. Akun P2 POST `bidang.salin-format` → ada 5 bidang dengan `periode_id = P2`, nama dan `maksimal_orang` sama, dan `foto_bidang` mentahnya sama.
  - `test_salin_format_ditolak_kalau_sudah_ada_isi`: P2 sudah punya 1 bidang → jumlahnya tetap 1 dan session punya error.
  - `test_salin_format_jabatan`.
  - `test_pengurus_ditolak_kalau_bidang_penuh`: bidang dengan `maksimal_orang = 1` dan sudah ada 1 pengurus → POST `pengurus.store` → error `bidangs_id`. Lakukan juga lewat API (`POST /api/pengurus`) → status bukan 2xx.
  - `test_edit_pengurus_di_bidang_penuh_tetap_boleh`: pengurus satu-satunya di bidang itu diedit namanya → berhasil. Pengurus lain dipindah ke bidang yang penuh → error.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter BidangPeriodeTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3:** Implementasi.
- [ ] **Step 4:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 5: Commit** `feat: maksimal orang per bidang dan salin format periode sebelumnya`

### Task 7: Profil memakai master periode

**Files:**
- Create: `database/migrations/2026_11_26_000005_profils_pakai_periode_id.php`. Isinya: tambah `profils.periode_id` (nullable FK). Untuk setiap `periode` yang cocok dengan `/^(\d{4})\s*-\s*(\d{4})$/`, lakukan `firstOrCreate` di `periodes` lalu isi `periode_id`. Yang tidak cocok diisi 2024–2026. Setelah itu kolom `periode` dihapus. `down()` mengembalikan kolom `periode` dari relasinya.
- Modify: `app/Models/Admin/Profil.php`: fillable `periode_id`, relasi `periodeKepengurusan()`, accessor `periode` (mengembalikan `periodeKepengurusan?->label()`) supaya view publik `pages/profil.blade.php` tetap jalan tanpa diubah.
- Modify: `app/Http/Controllers/Admin/ProfilController.php`, `app/Http/Controllers/Api/ProfilController.php`: validasi `periode_id` (required, exists), nama file foto memakai `label()`. Index diurutkan dari periode terbaru.
- Modify: `resources/views/pages/admin/profil/{create,edit,index}.blade.php`: input teks `periode` diganti `<select name="periode_id">` berisi semua periode.
- Test: `tests/Feature/ProfilPeriodeTest.php`

**Interfaces:**
- Consumes: `Periode::label()`, trait `TercatatDiLog` (sudah terpasang di Task 4)
- Produces: `Profil::periodeKepengurusan()`

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_admin_periode_bisa_ubah_profil_periode_lain`: profil milik periode 2018–2020, akun P2 PUT `profil-ppgt.update` dengan `content` baru → konten berubah dan ada log `ubah` dengan `user_id` akun P2.
  - `test_accessor_periode_untuk_halaman_publik`: `$profil->periode === '2018-2020'`, dan `GET route('profil')` → 200 dengan teks "2018-2020".
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter ProfilPeriodeTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3:** Implementasi.
- [ ] **Step 4:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 5: Commit** `feat: profil sejarah terhubung ke master periode`

### Task 8: Halaman Log, menu Sistem, dan pemilih periode di navbar

**Files:**
- Create: `app/Http/Controllers/Admin/LogController.php` (index), `resources/views/pages/admin/log/index.blade.php`
- Modify: `routes/web.php`: `Route::get('log', ...)->name('log.index')`
- Modify: `resources/views/includes/admin/sidebar.blade.php`: submenu Pengurus ditambah `'Bidang' => 'bidang.index'` dan `'Jabatan' => 'jabatan.index'`. Tambah grup `'Sistem'` berisi Periode (`periode.index`, `admin/periode*`), Akun (`akun.index`, `admin/akun*`), dan Log (`log.index`, `admin/log*`).
- Modify: `resources/views/includes/admin/navbar.blade.php`: tampilkan label periode aktif. Untuk admin utama, tampilkan `<select>` periode dalam form POST `periode.pilih` yang submit saat `onchange`.
- Test: `tests/Feature/LogPageTest.php`

**Interfaces:**
- Consumes: `ActivityLog::terlihatOleh()`, `ActivityLog::LABEL`
- Produces: `GET admin/log?model=&periode_id=&user_id=&aksi=`, dipaginasi 25 per halaman dengan `withQueryString()` dan diurutkan dari yang terbaru. Setiap baris menampilkan waktu, user, periode, menu (`LABEL`), aksi, dan detail sebelum → sesudah per field. Detail itu ditampilkan dalam `<details>` native, tanpa JS.

- [ ] **Step 1: Tulis test yang gagal:**
  - `test_log_page_tampil_dan_terfilter`: ada log Inventaris (P1) dan log Bidang (P1). Akun P2 membuka `GET route('log.index')` → ada "Inventaris" dan tidak ada log Bidang. Dengan `?model=App\Models\Inventaris` hanya log Inventaris yang tampil.
  - `test_navbar_admin_utama_punya_pemilih_periode`: admin utama membuka `GET dashboard` → ada `name="periode_id"`. Admin periode → tidak ada.
- [ ] **Step 2:** Jalankan `php vendor/bin/phpunit --filter LogPageTest`. Hasil yang diharapkan: FAIL.
- [ ] **Step 3:** Implementasi.
- [ ] **Step 4:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
- [ ] **Step 5: Commit** `feat: halaman log, menu sistem, dan pemilih periode`

### Task 9: Verifikasi di database MySQL lokal

- [ ] **Step 1:** Backup database: `mysqldump -u root ppgtjsk > "%SCRATCHPAD%/ppgtjsk-before-periode.sql"`.
- [ ] **Step 2:** Jalankan `php artisan migrate`. Hasil yang diharapkan: 5 migrasi baru berhasil tanpa error.
- [ ] **Step 3:** Cek data. Jalankan `php artisan tinker --execute="dump(App\Models\Periode::all()->map->label(), App\Models\Bidang::whereNull('periode_id')->count(), App\Models\Admin\Profil::with('periodeKepengurusan')->get()->pluck('periode'))"`. Hasil yang diharapkan: ada 2024-2026 (beserta periode-periode dari Profil), 0 bidang tanpa periode, dan label profil sesuai data lama.
- [ ] **Step 4:** Jalankan `php artisan migrate:rollback --step=5` lalu `php artisan migrate`. Hasil yang diharapkan: keduanya sukses, dan teks periode di profil kembali seperti semula setelah rollback.
- [ ] **Step 5:** Jalankan `php vendor/bin/phpunit`. Hasil yang diharapkan: semua PASS.
