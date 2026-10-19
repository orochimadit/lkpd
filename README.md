# 📱 Cerdas Beriklan: E-Modul Pembelajaran Interaktif Materi Iklan Berbasis Kearifan Lokal Pontianak

Aplikasi media pembelajaran interaktif berbasis web untuk mendukung peningkatan **Motivasi Belajar ($Y_1$)** dan **Kreativitas ($Y_2$)** peserta didik Kelas VI SD Negeri 21 Pontianak Barat pada materi Bahasa Indonesia (Iklan).

Dikembangkan sebagai bagian dari penelitian tesis Magister Pendidikan Guru Sekolah Dasar (S2 PGSD), Fakultas Keguruan dan Ilmu Pendidikan, Universitas Tanjungpura (UNTAN) oleh **Fildzah Rahmawati (NIM: F2211251014)**.

---

## 🌟 Landasan Teori & Model Pengembangan
1. **Model Pengembangan ADDIE**: *Analysis, Design, Development, Implementation, Evaluation*.
2. **Cognitive Theory of Multimedia Learning (Mayer, 2009)**: Penyajian materi ganda (audio-verbal dan grafis visual) terstruktur untuk mengoptimalkan kapasitas kognitif siswa SD.
3. **Self-Determination Theory (Ryan & Deci, 2017)**: Pemenuhan kebutuhan psikologis dasar (*Autonomy*, *Competence*, *Relatedness*) melalui navigasi mandiri, pelacak progres, dan umpan balik belajar instan.
4. **Teori Berpikir Kreatif Guilford (1967)**: Pembimbingan dan penilaian 4 indikator kreativitas:
   - **Fluency** (Kelancaran menghasilkan ragam ide produk lokal).
   - **Flexibility** (Keluwesan mengembangkan variasi sudut pandang/target promosi).
   - **Originality** (Keaslian ide & slogan, tidak meniru iklan komersial televisi).
   - **Elaboration** (Kerincian pesan persuasi dan tata letak visual poster).
5. **Kontekstualisasi Kearifan Lokal Pontianak**: Integrasi potensi daerah (Es Lidah Buaya Siantan, Kain Tenun Corak Insang, Kue Tradisional Bingke Berendam, Pisang Selai Srikaya, dan Tugu Khatulistiwa) serta penguatan berpikir kritis membedakan **fakta vs opini**.

---

## 🛠️ Tech Stack
- **Backend Framework**: Laravel 11 / 12 (PHP 8.2+)
- **Database**: MySQL (Didukung SQLite untuk pengujian lokal)
- **Frontend & UI/UX**: Laravel Blade, Tailwind CSS (*Primary Learning System - Modern Corporate for Kids*), JavaScript
- **Typography**: *Plus Jakarta Sans* & *Be Vietnam Pro*
- **Iconography**: Google Material Symbols Outlined

---

## 🚀 Fitur Unggulan

### 1. Portal Peserta Didik (Kelas VI)
- **Beranda & Progress Tracker**: Dashboard navigasi Bento Grid dengan persentase capaian belajar interaktif.
- **Eksplorasi Materi Runtut (4 Topik)**:
  - *Topik 1: Pengertian & Tujuan Iklan*
  - *Topik 2: Unsur & Struktur Iklan Efektif*
  - *Topik 3: Membedakan Fakta vs Opini dalam Iklan (Berpikir Kritis)*
  - *Topik 4: Iklan Kreatif Berbasis Kearifan Lokal Pontianak*
- **Video Pembelajaran Interaktif**: Pemutar video bedah iklan kontekstual.
- **LKPD Digital (Split-Screen)**: Stimulus iklan produk lokal vs lembar analisis esai terstruktur (simpan draf & kumpulkan jawaban).
- **Kuis Tantangan Gamifikasi**: Uji pemahaman dengan *instant pedagogical feedback*, pembahasan jawaban, dan skor bintang.
- **Studio Proyek Iklan Kreatif**: *Scaffolding builder* 4 langkah Guilford dilengkapi **Live Poster Preview**.
- **Evaluasi & Angket Motivasi**: Angket skala Likert (Pretest & Posttest Motivasi Belajar).

### 2. Portal Guru & Peneliti
- **Live Class Monitoring**: Pantauan status 26 siswa kelas VI (kelengkapan LKPD, kuis, proyek, motivasi).
- **Penilaian Rubrik Kreativitas**: Formulir penilaian interaktif 4 indikator Guilford dengan perhitungan otomatis skor total (4–16), persentase, dan predikat (*Sangat Kreatif*, *Kreatif*, *Cukup Kreatif*, *Kurang Kreatif*).
- **Ekspor Data SPSS (.CSV / Excel)**: Satu tombol untuk mengunduh seluruh data riset (*Pretest, Posttest, Skor N-Gain, Skor Rubrik per Indikator, dan Nilai Kuis*) yang sudah siap dianalisis di SPSS untuk Uji Normalitas, Uji $t$, dan Uji $N$-Gain.

---

## 💻 Panduan Menjalankan Aplikasi Secara Lokal

### 1. Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL (bisa melalui XAMPP / Laragon)

### 2. Langkah Instalasi
```bash
# 1. Masuk ke direktori proyek
cd /path/ke/lkpd

# 2. Salin environment file
cp .env.example .env

# 3. Generate Application Key
php artisan key:generate

# 4. Konfigurasi database di file .env (Pastikan MySQL aktif di XAMPP/Laragon)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_emodul_iklan
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migrasi dan seeder data awal
php artisan migrate --seed

# 6. Kompilasi aset frontend
npm run build

# 7. Jalankan server lokal
php artisan serve
```
Akses aplikasi melalui browser di: `http://localhost:8000`

---

## 🔑 Akun Demo (Pengujian Langsung)
Pada halaman login tersedia tombol **Akses Cepat Demo**:
- **Guru / Peneliti**:
  - Username: `guru`
  - Password: `password`
- **Siswa Kelas VI**:
  - Username: `siswa1` (Ahmad Pratama), `siswa2` (Siti Rahma), `siswa3` (Budi Setiawan)
  - Password: `password`
