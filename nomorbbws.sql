-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Sep 2023 pada 17.57
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nomorbbws`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_klasifikasi`
--

CREATE TABLE `kode_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `kode_klasifikasi` varchar(15) NOT NULL,
  `jenis_arsip` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `persetujuan` enum('Ya','Tidak') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kode_klasifikasi`
--

INSERT INTO `kode_klasifikasi` (`id_klasifikasi`, `kode_klasifikasi`, `jenis_arsip`, `id_user`, `persetujuan`, `created_at`) VALUES
(1, 'MD', 'Memo Dinas', 1, 'Tidak', '2023-09-12 00:17:13'),
(2, 'ND', 'Nota Dinas', 1, 'Tidak', '2023-09-12 00:17:31'),
(3, 'SE', 'Surat Edaran', 1, 'Tidak', '2023-09-12 00:17:56'),
(4, 'KPTS', 'Surat Keputusan', 1, 'Tidak', '2023-09-12 00:18:16'),
(5, 'HK0101', 'Produk Hukum Bersifat Pengaturan', 1, 'Ya', '2023-09-12 00:18:50'),
(6, 'HK0102', 'Produk Hukum Bersifat Penetapan', 1, 'Ya', '2023-09-12 00:19:23'),
(7, 'PS0602', 'Inventarisasi dan Penilaian Kembali (Revaluasi BMN)', 1, 'Ya', '2023-09-12 00:20:33'),
(8, 'UM0102', 'Peringatan Hari Kemerdekaan, Hari Besar Nasional, dan Hari Bhakti PUPR', 1, 'Ya', '2023-09-13 16:51:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_surat`
--

CREATE TABLE `nomor_surat` (
  `id_nomor` int(11) NOT NULL,
  `nomor` varchar(25) NOT NULL,
  `sifat` varchar(15) NOT NULL,
  `tujuan_surat` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `status_verifikasi` enum('Sudah','Belum','Tolak') NOT NULL,
  `file_surat` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_klasifikasi` int(11) NOT NULL,
  `id_pejabat` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nomor_surat`
--

INSERT INTO `nomor_surat` (`id_nomor`, `nomor`, `sifat`, `tujuan_surat`, `perihal`, `tanggal_surat`, `status_verifikasi`, `file_surat`, `id_user`, `id_klasifikasi`, `id_pejabat`, `created_at`) VALUES
(1, '001/MD/Aw/2023', 'Terbatas', 'Pejabat Administrator', 'Penggunaan Mobile e-absensi', '2023-05-15', 'Sudah', '814b3d462821123.pdf', 2, 1, 1, '2023-09-12 01:00:07'),
(2, 'HK0101-Aw/001', 'Terbatas', 'Kepala Pusat Pengembangan', 'Izin lokasi studi lapangan', '2023-06-05', 'Sudah', 'c9f170ae8e6e68571c96.pdf', 2, 5, 1, '2023-09-12 01:01:55'),
(3, '002/MD/Aw/2023', 'Biasa', 'Direktur Kepatuhan Intern', 'Penyampaian peserta pengganti', '2023-07-29', 'Sudah', '', 2, 1, 3, '2023-09-12 01:04:21'),
(4, '003/MD/Aw/2023', 'Biasa', 'Kementrian PUPR', 'Penyampaian rekap', '2023-09-01', 'Sudah', '', 5, 1, 4, '2023-09-12 01:07:36'),
(5, 'HK0101-Aw/002', 'Penting', 'Kepala BPKP', 'Permohonan Audit', '2023-09-05', 'Sudah', '8685e82100d07af8d1ae.pdf', 5, 5, 5, '2023-09-12 01:09:14'),
(6, 'HK0101-Aw/003', 'Biasa', 'Balai hidrologi', 'Permohonan Konsultasi', '2023-09-09', 'Belum', '', 5, 5, 5, '2023-09-12 01:10:58'),
(7, 'HK0102-Aw/001', 'Umum', 'Direktorat jenderal SDA', 'Tanggapan laporan masyarakat', '2023-09-06', 'Sudah', '', 5, 6, 6, '2023-09-12 02:06:45'),
(8, '001/ND/Aw/2023', 'Penting', 'Kepala UPTD', 'Rapat Koordinasi', '2023-09-11', 'Sudah', '', 2, 2, 1, '2023-09-12 11:43:57'),
(9, 'UM0102-Aw/001', 'Umum', 'Pegawai BBWS Mesuji Sekampung', 'Upacara 17 Agustus 2023', '2023-08-14', 'Belum', '', 2, 8, 1, '2023-09-20 00:53:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pejabat`
--

CREATE TABLE `pejabat` (
  `id_pejabat` int(11) NOT NULL,
  `nama_pejabat` varchar(30) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pejabat`
--

INSERT INTO `pejabat` (`id_pejabat`, `nama_pejabat`, `nip`, `jabatan`, `created_at`) VALUES
(1, 'Roy Panagom Pardede, S.T.,M.Te', '197311091998031008', 'Kepala Balai Besar Wilayah Sungai Mesuji Sekampung', '2023-09-12 00:10:05'),
(2, 'Eko Murwanto, S.T., M.Tech.', '197009042002121002', 'Kepala Bagian Umum dan Tata Usaha', '2023-09-12 00:10:39'),
(3, 'Albert Devidson, S.E.,M.M.', '196604222006041002', 'Subkoordinator Kepegawaian, Pengelolaan Arsip dan Layanan Umum', '2023-09-12 00:11:15'),
(4, 'Joharmas, S.T.,M.T.', '196805122007011003', 'Subkoordinator Keuangan, Fasilitas Pengelolaan Barang Persediaan Bencana dan Pengelolaan BMN', '2023-09-12 00:11:46'),
(5, 'Yanti Suri, S.E.,M.M.', '197601042008122001', 'Subkoordinator Hukum dan Komunikasi Publik', '2023-09-12 00:12:20'),
(6, 'Martius, S.ST, MT', '197508151998021001', 'Kepala Bidang Pelaksanaan Jaringan Sumber Air', '2023-09-12 00:14:07'),
(7, 'Sudarto, S.T.,M.T.', '196908091999031002', 'Kepala Bidang Operasi dan Pemeliharaan', '2023-09-13 15:58:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` enum('Admin','Pegawai') NOT NULL,
  `photo` varchar(30) NOT NULL,
  `aktivasi` enum('Aktif','Tidak Aktif') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `nip`, `jabatan`, `email`, `password`, `role`, `photo`, `aktivasi`, `created_at`) VALUES
(1, 'Admin', '123456789012345678', 'Admin', 'admin@gmail.com', '$2y$10$8/vF9oDT9ZzTGx360qg7guZE415g6MLX3pp7RYAFmqauu1GefwHEq', 'Admin', 'default.jpg', 'Aktif', '2023-09-11 23:56:20'),
(2, 'Pegawai', '123451234512345123', 'Pegawai', 'pegawai@gmail.com', '$2y$10$54MAb/w2R9THhjMkC992D.SK4BhS.qgIxlW0RwOGw0kKlRaWustN2', 'Pegawai', 'default.jpg', 'Aktif', '2023-09-11 23:58:56'),
(3, 'Yuandari Astuti', '098765432123456789', 'Direktur', 'yuandari@gmail.com', '$2y$10$cdOxAIpHvzCIgFDGEwBMaOl6zQR2Du9mEqKtCq7juntfAc7i9MmFW', 'Admin', 'IMG_20200906_1009021.jpg', 'Aktif', '2023-09-12 00:40:41'),
(4, 'Rina Aulia', '987659876598765987', 'Sekretaris', 'rina@gmail.com', '$2y$10$MQX5wOrBLEy9vRzyzKzlV.1y1sEWK.zJJngMOjl9VI/VjrxgOOLuK', 'Pegawai', 'download.jpg', 'Aktif', '2023-09-12 00:41:55'),
(5, 'Hana', '456784567845678456', 'Pejabat Pembuat Komitmen (PPK)', 'hana@gmail.com', '$2y$10$avTbrvHPnbjmeBTlLHkftOYCa0ptItRIhYabuccC6oBenSt1Wh9V.', 'Pegawai', 'download_(1).jpg', 'Aktif', '2023-09-12 00:43:23'),
(6, 'Warsih', '876789876787656789', 'Pelaksana Teknik', 'warsih@gmail.com', '$2y$10$VPYS6.JqLDqCb7S4PjiNUeQShHmbat9ODl.omrMTezKTbqmJ95x8u', 'Pegawai', 'default.jpg', 'Tidak Aktif', '2023-09-12 00:44:24'),
(8, 'Yuni Farlin', '199987876578657657', 'Pelaksana Administrasi', 'yuni@gmail.com', '$2y$10$O3B5eeClsSI.9UjhUJD2zeJ8blap5KjxoIXUYIAppn23In/lZ0IXy', 'Pegawai', 'default.jpg', 'Aktif', '2023-09-13 18:37:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  ADD PRIMARY KEY (`id_nomor`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_klasifikasi` (`id_klasifikasi`),
  ADD KEY `id_pejabat` (`id_pejabat`);

--
-- Indeks untuk tabel `pejabat`
--
ALTER TABLE `pejabat`
  ADD PRIMARY KEY (`id_pejabat`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  MODIFY `id_nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pejabat`
--
ALTER TABLE `pejabat`
  MODIFY `id_pejabat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kode_klasifikasi`
--
ALTER TABLE `kode_klasifikasi`
  ADD CONSTRAINT `kode_klasifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `nomor_surat`
--
ALTER TABLE `nomor_surat`
  ADD CONSTRAINT `nomor_surat_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `nomor_surat_ibfk_5` FOREIGN KEY (`id_klasifikasi`) REFERENCES `kode_klasifikasi` (`id_klasifikasi`),
  ADD CONSTRAINT `nomor_surat_ibfk_6` FOREIGN KEY (`id_pejabat`) REFERENCES `pejabat` (`id_pejabat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
