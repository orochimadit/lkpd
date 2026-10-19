# E-Modul Pembelajaran Interaktif: Materi Iklan Berbasis Kearifan Lokal Pontianak

Aplikasi E-Modul Pembelajaran Interaktif berbasis web untuk mendukung peningkatan **Motivasi Belajar ($Y_1$)** dan **Kreativitas ($Y_2$)** peserta didik Kelas VI SD Negeri 21 Pontianak Barat pada materi iklan (Bahasa Indonesia).

Dikembangkan sebagai bagian dari penelitian tesis Magister Pendidikan Guru Sekolah Dasar (S2 PGSD), Fakultas Keguruan dan Ilmu Pendidikan, Universitas Tanjungpura (UNTAN) oleh **Fildzah Rahmawati (NIM: F2211251014)**.

---

## 🌟 Landasan Teori & Model Pengembangan
1. **Model ADDIE**: *Analysis, Design, Development, Implementation, Evaluation*.
2. **Cognitive Theory of Multimedia Learning (Mayer, 2009)**: Dual-coding (audio-verbal dan visual) yang meminimalkan beban kognitif.
3. **Self-Determination Theory (Ryan & Deci, 2017)**: Pemenuhan kebutuhan *Autonomy*, *Competence*, dan *Relatedness* untuk memicu motivasi intrinsik siswa.
4. **Teori Kreativitas Guilford (1967)**: Pengukuran 4 indikator berpikir divergen:
   - *Fluency* (Kelancaran gagasan)
   - *Flexibility* (Keluwesan/variasi sudut pandang)
   - *Originality* (Keaslian ide iklan, tidak meniru)
   - *Elaboration* (Kerincian detail visual dan pesan persuasi)
5. **Kebaruan Kontekstual**: Integrasi kearifan lokal Kota Pontianak / Kalimantan Barat (Es Lidah Buaya, Tenun Corak Insang, Kuliner Bingke & Pisang Srikaya, serta slogan khas lokal).

---

## 🛠️ Tech Stack
- **Backend Framework**: Laravel 11 (PHP 8.2+)
- **Database**: MySQL
- **Frontend & Styling**: Blade Templating, Tailwind CSS (Primary Learning System), Vanilla/Alpine.js
- **Typography**: *Plus Jakarta Sans* & *Be Vietnam Pro*
- **Icons**: Google Material Symbols Outlined

---

## 🚀 Fitur Utama
### 1. Portal Siswa (Kelas VI)
- **Halaman Utama Dashboard**: Navigasi Bento Grid ramah anak (*Modern Corporate for Kids*).
- **Eksplorasi Materi Runtut**: Pengenalan iklan, struktur, jenis, dan membedakan fakta vs opini.
- **Video Pembelajaran**: Contoh iklan lokal audio-visual.
- **LKPD Digital Interaktif**: Analisis iklan media cetak dengan stimulus produk lokal Pontianak.
- **Kuis Tantangan**: Uji pemahaman dengan *instant pedagogical feedback* & skor bintang.
- **Studio Proyek Iklan Kreatif**: Panduan langkah demi langkah merancang iklan berbasis 4 indikator Guilford.

### 2. Portal Guru / Peneliti
- **Monitoring Progres**: Pemantauan langsung capaian belajar 26 siswa kelas VI.
- **Penilaian Rubrik Kreativitas**: Instrumen penilaian otomatis (skor 4–16) dengan kategori tingkat kreativitas.
- **Export Data SPSS**: Ekspor data nilai pretest, posttest motivasi, dan skor kreativitas ke format Excel/CSV siap uji $N\text{-Gain}$ & *Paired Sample t-Test*.
