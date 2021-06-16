-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2021 pada 08.32
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bandung_clothing_corporation`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `kode_akun` char(10) NOT NULL,
  `nama_akun` varchar(255) NOT NULL,
  `header_akun` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kode_akun`, `nama_akun`, `header_akun`) VALUES
('1', 'Aktiva', ''),
('11', 'Aktiva Lancar', '1'),
('111', 'Kas', '11'),
('112', 'Piutang', '11'),
('113', 'Persediaan Barang Dagang', '11'),
('2', 'Utang', ''),
('211', 'Utang Usaha', '2'),
('3', 'Modal', ''),
('311', 'Modal', '3'),
('312', 'Prive', '3'),
('4', 'Pendapatan', ''),
('411', 'Penjualan', '4'),
('5', 'Beban', ''),
('511', 'Beban Listrik dan Air', '5'),
('512', 'Beban Gaji dan Upah', '5'),
('513', 'Beban Sewa Kantor', '5'),
('514', 'Beban Iklan', '5'),
('515', 'Beban Administrasi Lain-Lain', '5'),
('516', 'HPP', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` char(10) NOT NULL,
  `nama_bahan_baku` varchar(200) NOT NULL,
  `satuan` varchar(200) NOT NULL,
  `harga_satuan` double NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama_bahan_baku`, `satuan`, `harga_satuan`, `stok`) VALUES
('BB001', 'Cotton Combed Black', 'Meter', 35000, 0),
('BB002', 'Benang Hitam', 'Roll', 5000, 0),
('BB003', 'Kain Katun', 'Meter', 35000, 0),
('BB004', 'Kancing Kemeja', 'Lusin', 10000, 0),
('BB005', 'Coil Zipper Ykk', 'Pcs', 7000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` char(10) NOT NULL,
  `kategori_barang_id` char(10) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `harga_jual_satuan` double NOT NULL,
  `harga_produk_satuan` double NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `is_popular` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kategori_barang_id`, `nama_barang`, `harga_jual_satuan`, `harga_produk_satuan`, `stok`, `gambar`, `is_popular`) VALUES
('BR001', 'KB001', 'Vneck T-shirt Black', 80000, 30000, 81, '', 1),
('BR002', 'KB002', 'Cotton Black Shirt', 75000, 50000, 87, '608bed68ad141.jpg', 1),
('BR003', 'KB002', 'Long Sleve Black Shirt', 150000, 100000, 75, '608bed3fe96cb.jpg', 1),
('BR004', 'KB003', 'Zipper White Hoodie', 250000, 200000, 100, '608bed2e38997.jpg', 1),
('BR005', 'KB003', 'Hoodie Black', 230000, 150000, 100, '608bed02b3339.jpg', 1),
('BR006', 'KB003', 'Jaket Zipper Black', 225000, 185000, 80, '608bec2376997.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom`
--

CREATE TABLE `bom` (
  `id` char(10) NOT NULL,
  `barang_id` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bom`
--

INSERT INTO `bom` (`id`, `barang_id`) VALUES
('BM002', 'BR001'),
('BM001', 'BR002'),
('BM003', 'BR003'),
('BM004', 'BR005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `pelanggan_id` varchar(30) NOT NULL,
  `barang_id` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `pelanggan_id`, `barang_id`, `jumlah`) VALUES
(1, 'PL008', 'BR006', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_bom`
--

CREATE TABLE `detail_bom` (
  `id` int(11) NOT NULL,
  `bom_id` char(10) NOT NULL,
  `bahan_baku_id` char(10) NOT NULL,
  `komposisi` float(11,1) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_bom`
--

INSERT INTO `detail_bom` (`id`, `bom_id`, `bahan_baku_id`, `komposisi`, `satuan`, `keterangan`) VALUES
(94, 'BM001', 'BB004', 1.0, 'Lusin', ''),
(95, 'BM001', 'BB003', 1.0, 'Meter', ''),
(96, 'BM002', 'BB001', 1.5, 'meter', ''),
(97, 'BM002', 'BB002', 1.0, 'roll', ''),
(98, 'BM003', 'BB001', 1.8, 'meter', ''),
(99, 'BM003', 'BB002', 0.5, 'roll', ''),
(103, 'BM004', 'BB005', 1.0, 'Pcs', 'Bahan Penolong'),
(104, 'BM004', 'BB001', 1.8, 'Meter', 'Bahan Baku'),
(105, 'BM004', 'BB002', 0.5, 'Roll', 'Bahan Penolong');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` int(11) NOT NULL,
  `pembelian_id` char(20) NOT NULL,
  `bahan_baku_id` char(10) NOT NULL,
  `harga_satuan` double NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `sub_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id`, `pembelian_id`, `bahan_baku_id`, `harga_satuan`, `jumlah_pembelian`, `sub_total`) VALUES
(53, 'PM01052100001', 'BB001', 35000, 45, 1575000),
(54, 'PM01052100001', 'BB002', 5000, 30, 150000),
(55, 'PM01052100001', 'BB003', 35000, 20, 700000),
(56, 'PM01052100001', 'BB004', 10000, 20, 200000),
(57, 'PM21052100002', 'BB001', 35000, 5, 157500),
(58, 'PM21052100002', 'BB002', 5000, 3, 15000),
(59, 'PM05062100003', 'BB001', 35000, 150, 5250000),
(60, 'PM05062100003', 'BB002', 5000, 100, 500000),
(61, 'PM05062100004', 'BB001', 35000, 45, 1575000),
(62, 'PM05062100004', 'BB002', 5000, 30, 150000),
(63, 'PM05062100005', 'BB001', 35000, 45, 1575000),
(64, 'PM05062100005', 'BB002', 5000, 30, 150000),
(65, 'PM05062100006', 'BB001', 35000, 75, 2625000),
(66, 'PM05062100006', 'BB002', 5000, 50, 250000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penerimaan`
--

CREATE TABLE `detail_penerimaan` (
  `id` int(11) NOT NULL,
  `id_penerimaan` varchar(30) NOT NULL,
  `id_barang` varchar(30) NOT NULL,
  `biaya_bahan_baku` double NOT NULL,
  `biaya_produksi` double NOT NULL,
  `biaya_tambahan` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penerimaan`
--

INSERT INTO `detail_penerimaan` (`id`, `id_penerimaan`, `id_barang`, `biaya_bahan_baku`, `biaya_produksi`, `biaya_tambahan`, `qty`) VALUES
(30, 'PNR05062100001', 'BR001', 1725000, 500000, 100000, 30),
(31, 'PNR05062100001', 'BR002', 900000, 450000, 75000, 20),
(33, 'PNR05062100002', 'BR001', 172500, 50000, 10000, 3),
(34, 'PNR05062100003', 'BR001', 5750000, 1500000, 1000000, 100),
(36, 'PNR05062100004', 'BR001', 1725000, 600000, 12000, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengadaan`
--

CREATE TABLE `detail_pengadaan` (
  `id_transaksi` varchar(30) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pengadaan`
--

INSERT INTO `detail_pengadaan` (`id_transaksi`, `id_barang`, `qty`, `subtotal`, `harga_satuan`) VALUES
('PG-01052100001', 'BR001', 30, 0, 0),
('PG-01052100001', 'BR002', 20, 0, 0),
('PG-05062100003', 'BR001', 100, 0, 0),
('PG-05062100004', 'BR001', 30, 0, 0),
('PG-05062100005', 'BR001', 30, 0, 0),
('PG-05062100006', 'BR001', 50, 0, 0),
('PG-21052100002', 'BR001', 3, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` int(11) NOT NULL,
  `penjualan_id` char(20) NOT NULL,
  `barang_id` char(10) NOT NULL,
  `harga_satuan` double NOT NULL,
  `jumlah_penjualan` int(11) NOT NULL,
  `sub_total` double NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `barang_id`, `harga_satuan`, `jumlah_penjualan`, `sub_total`, `keterangan`) VALUES
(6, 'PNJF-26122000004', 'BR006', 225000, 20, 4500000, ''),
(7, 'PNJF-26122000004', 'BR003', 150000, 15, 2250000, ''),
(8, 'PNJF-28122000005', 'BR003', 150000, 10, 750000, ''),
(9, 'PNJF-28122000006', 'BR001', 50000, 10, 500000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `kode_akun` varchar(10) NOT NULL,
  `id_transaksi` varchar(20) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `posisi_dr_cr` varchar(6) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`kode_akun`, `id_transaksi`, `tgl_transaksi`, `posisi_dr_cr`, `nominal`) VALUES
('111', 'MD-04062100004', '2021-06-04', 'debet', 600000),
('111', 'MD-26122000002', '2020-12-26', 'debet', 1000000),
('111', 'MD-28122000003', '2020-12-28', 'debet', 500000),
('111', 'PNJF-26122000004', '2020-12-26', 'debet', 6750000),
('111', 'PNJF-28122000005', '2020-12-28', 'debet', 750000),
('111', 'PYMNT-04062100003', '2021-06-04', 'kredit', 100000),
('111', 'PYMNT-26122000002', '2020-12-26', 'kredit', 150000),
('113', 'PNJF-26122000004', '2020-12-26', 'kredit', 3700000),
('113', 'PNJF-28122000005', '2020-12-28', 'kredit', 1000000),
('311', 'MD-04062100004', '2021-06-04', 'kredit', 600000),
('311', 'MD-26122000002', '2020-12-26', 'kredit', 1000000),
('311', 'MD-28122000003', '2020-12-28', 'kredit', 500000),
('411', 'PNJF-26122000004', '2020-12-26', 'kredit', 6750000),
('411', 'PNJF-28122000005', '2020-12-28', 'kredit', 750000),
('511', 'PYMNT-26122000002', '2020-12-26', 'debet', 150000),
('512', 'PYMNT-04062100003', '2021-06-04', 'debet', 100000),
('516', 'PNJF-26122000004', '2020-12-26', 'debet', 3700000),
('516', 'PNJF-28122000005', '2020-12-28', 'debet', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartu_stok`
--

CREATE TABLE `kartu_stok` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jml_masuk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jml_keluar` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `jml_saldo` int(11) NOT NULL,
  `harga_saldo` int(11) NOT NULL,
  `id_barang` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `id_transaksi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kartu_stok`
--

INSERT INTO `kartu_stok` (`id`, `keterangan`, `jml_masuk`, `harga`, `jml_keluar`, `hpp`, `jml_saldo`, `harga_saldo`, `id_barang`, `tanggal`, `id_transaksi`) VALUES
(7, 'Pembelian', 30, 77500, 0, 0, 30, 77500, 'BR001', '2021-06-05', 'PNR05062100001'),
(8, 'Pembelian', 20, 71250, 0, 0, 20, 71250, 'BR002', '2021-06-05', 'PNR05062100001'),
(9, 'Pembelian', 3, 77500, 0, 0, 33, 77500, 'BR001', '2021-06-05', 'PNR05062100002'),
(10, 'Pembelian', 100, 82500, 0, 0, 33, 77500, 'BR001', '2021-06-05', 'PNR05062100003'),
(11, 'Pembelian', 100, 82500, 0, 0, 33, 77500, 'BR001', '2021-06-05', 'PNR05062100003'),
(12, 'Saldo Stok', 0, 0, 0, 0, 100, 82500, 'BR001', '2021-06-05', 'PNR05062100003'),
(13, 'Pembelian', 30, 77900, 0, 0, 33, 77500, 'BR001', '2021-06-05', 'PNR05062100004'),
(14, 'Saldo Stok', 0, 0, 0, 0, 100, 82500, 'BR001', '2021-06-05', 'PNR05062100004'),
(15, 'Saldo Stok', 0, 0, 0, 0, 30, 77900, 'BR001', '2021-06-05', 'PNR05062100004');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id` char(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id`, `nama`, `gambar`) VALUES
('KB001', 'T-Shirts Collection', '608bb705337b5.jpg'),
('KB002', 'Shirt Collection', '608ba695b0c3b.jpg'),
('KB003', 'Jacket Collection', '608b97d443064.jpg'),
('KB004', 'Pants Collection', '608ba6da72561.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_beban`
--

CREATE TABLE `kategori_beban` (
  `id` char(10) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL,
  `no_akun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_beban`
--

INSERT INTO `kategori_beban` (`id`, `nama_kategori`, `no_akun`) VALUES
('KB001', 'Beban Listrik dan Air', '511'),
('KB002', 'Beban Gaji Karyawan', '512'),
('KB003', 'Beban Sewa Kantor', '513'),
('KB004', 'Beban Iklan', '514'),
('KB005', 'Beban Administrasi Lain-lain', '515');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logcart`
--

CREATE TABLE `logcart` (
  `id` int(11) NOT NULL,
  `id_cart` int(11) NOT NULL,
  `pelanggan_id` varchar(30) NOT NULL,
  `barang_id` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_transaksi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `logcart`
--

INSERT INTO `logcart` (`id`, `id_cart`, `pelanggan_id`, `barang_id`, `jumlah`, `status`, `id_transaksi`) VALUES
(22, 6, 'PL006', 'BR005', 2, 3, 'PNJOL-04062100001'),
(23, 5, 'PL006', 'BR002', 2, 3, 'PNJOL-04062100001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logsaldo`
--

CREATE TABLE `logsaldo` (
  `id` int(11) NOT NULL,
  `jml_saldo` int(11) NOT NULL,
  `hrg_saldo` int(11) NOT NULL,
  `id_barang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `logsaldo`
--

INSERT INTO `logsaldo` (`id`, `jml_saldo`, `hrg_saldo`, `id_barang`) VALUES
(3, 33, 77500, 'BR001'),
(4, 20, 71250, 'BR002'),
(5, 100, 82500, 'BR001'),
(6, 30, 77900, 'BR001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` char(10) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` char(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `email`, `nomor_telepon`, `username`, `password`, `level`) VALUES
('PL001', 'Doni', 'Jl. Budiman', '', '081223230946', '', '', 0),
('PL002', 'Della Fadila Rahmawati', 'bandung\r\n', '', '081212126043', '', '', 0),
('PL003', 'Nayaa', 'Jl. Sukapura', '', '081213012391', '', '', 0),
('PL004', 'Reynaldo', 'Jl. Mangga Dua', '', '082291239102', '', '', 0),
('PL005', 'Rundina', 'Jl. Telekomunikasi', '', '081200391201', '', '', 0),
('PL006', 'Lady Diana', '', 'diana@gmail.com', '089657426022', 'ladyd', '123456', 5),
('PL007', 'Derby Norman', '', 'derby@gmail.co', '087231234', 'derby', '123456', 5),
('PL008', 'Naratama Putra', '', 'naratama@gmail.com', '0876783728', 'nara', '123456', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasok`
--

CREATE TABLE `pemasok` (
  `id` char(10) NOT NULL,
  `nama` char(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasok`
--

INSERT INTO `pemasok` (`id`, `nama`, `alamat`, `nomor_telepon`) VALUES
('SP002', 'PT Vorteks Inti Persada', 'Jl. Kiaracondong', '081223230941'),
('SP003', 'PT. Altra Multi Sandang', 'Jl. Buah Batu\r\n', '081223230946'),
('SP004', 'Griya Textil Pasar Baru', 'Pasar Baru Mall Bandung Blok. A5', '081213012391'),
('SP005', 'Cv. Kriya Textil Bandung', 'Jl. Dalam kaum No.51\r\n', '0812339912391');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_beban`
--

CREATE TABLE `pembayaran_beban` (
  `id_pembayaran` varchar(20) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `id_kategori_beban` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran_beban`
--

INSERT INTO `pembayaran_beban` (`id_pembayaran`, `tgl_transaksi`, `id_kategori_beban`, `keterangan`, `total_transaksi`) VALUES
('PYMNT-04062100003', '2021-06-04', 'KB002', NULL, 100000),
('PYMNT-26122000002', '2020-12-26', 'KB001', NULL, 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` char(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` double NOT NULL,
  `pemasok_id` char(10) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `pengadaan_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal_transaksi`, `total_transaksi`, `pemasok_id`, `status`, `pengadaan_id`) VALUES
('PM01052100001', '2021-05-01', 2625000, 'SP002', 4, 'PG-01052100001'),
('PM05062100003', '2021-06-05', 5750000, 'SP004', 4, 'PG-05062100003'),
('PM05062100004', '2021-06-05', 1725000, 'SP003', 4, 'PG-05062100004'),
('PM05062100005', '2021-06-05', 1725000, 'SP004', 3, 'PG-05062100005'),
('PM05062100006', '2021-06-05', 2875000, 'SP005', 3, 'PG-05062100006'),
('PM21052100002', '2021-05-21', 172500, 'SP003', 4, 'PG-21052100002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id_penerimaan` varchar(30) NOT NULL,
  `id_pengadaan` varchar(30) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` double NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerimaan`
--

INSERT INTO `penerimaan` (`id_penerimaan`, `id_pengadaan`, `tanggal_transaksi`, `total`, `status`) VALUES
('PNR05062100001', 'PG-01052100001', '2021-06-05', 3750000, 2),
('PNR05062100002', 'PG-21052100002', '2021-06-05', 232500, 2),
('PNR05062100003', 'PG-05062100003', '2021-06-05', 8250000, 2),
('PNR05062100004', 'PG-05062100004', '2021-06-05', 2337000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan_barang`
--

CREATE TABLE `pengadaan_barang` (
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengadaan_barang`
--

INSERT INTO `pengadaan_barang` (`id_transaksi`, `tanggal_transaksi`, `total`, `status`, `is_created`) VALUES
('PG-01052100001', '2021-05-01', 0, 3, 2),
('PG-05062100003', '2021-06-05', 0, 3, 2),
('PG-05062100004', '2021-06-05', 0, 3, 2),
('PG-05062100005', '2021-06-05', 0, 2, 2),
('PG-05062100006', '2021-06-05', 0, 2, 2),
('PG-21052100002', '2021-05-21', 0, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` char(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` double NOT NULL,
  `pelanggan_id` char(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal_transaksi`, `total_transaksi`, `pelanggan_id`, `status`) VALUES
('PNJF-26122000004', '2020-12-26', 6750000, 'PL001', 4),
('PNJF-28122000005', '2020-12-28', 750000, 'PL003', 3),
('PNJF-28122000006', '0000-00-00', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_online`
--

CREATE TABLE `penjualan_online` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_pelanggan` varchar(30) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `jenis_ekspedisi` varchar(100) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `batas_bayar` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan_online`
--

INSERT INTO `penjualan_online` (`id`, `id_transaksi`, `tanggal_transaksi`, `id_pelanggan`, `total_transaksi`, `jenis_ekspedisi`, `nama_penerima`, `alamat`, `kota`, `ongkir`, `email`, `notelp`, `batas_bayar`, `status`) VALUES
(8, 'PNJOL-04062100001', '2021-06-04', 'PL006', 54000, 'tiki - ECO', 'Reynaldo', 'kaslal', 'Buleleng', 664000, 'naratama@gmail.com', '12132938', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perubahan_modal`
--

CREATE TABLE `perubahan_modal` (
  `id_modal` varchar(20) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `total_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perubahan_modal`
--

INSERT INTO `perubahan_modal` (`id_modal`, `keterangan`, `tgl_transaksi`, `total_transaksi`) VALUES
('MD-04062100004', 'Penambahan Modal', '2021-06-04', 600000),
('MD-26122000002', 'Penambahan Modal', '2020-12-26', 1000000),
('MD-28122000003', 'Penambahan Modal', '2020-12-28', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` char(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal_transaksi`, `total_transaksi`) VALUES
('MD-04062100004', '2021-06-04', 600000),
('MD-26122000002', '2020-12-26', 1000000),
('MD-28122000003', '2020-12-28', 500000),
('PG-01052100001', '2021-05-01', 0),
('PG-05062100003', '2021-06-05', 0),
('PG-05062100004', '2021-06-05', 0),
('PG-05062100005', '2021-06-05', 0),
('PG-05062100006', '2021-06-05', 0),
('PG-21052100002', '2021-05-21', 0),
('PG-24032100001', '2021-03-24', 0),
('PG-24032100002', '2021-03-24', 0),
('PG-24032100003', '2021-03-24', 0),
('PG-24032100004', '2021-03-24', 0),
('PM01052100001', '2021-05-01', 2625000),
('PM05062100003', '2021-06-05', 5750000),
('PM05062100004', '2021-06-05', 1725000),
('PM05062100005', '2021-06-05', 1725000),
('PM05062100006', '2021-06-05', 2875000),
('PM21052100002', '2021-05-21', 172500),
('PNJF-26122000004', '2020-12-26', 6750000),
('PNJF-28122000005', '2020-12-28', 750000),
('PNJF-28122000006', '0000-00-00', 0),
('PYMNT-04062100003', '2021-06-04', 100000),
('PYMNT-26122000002', '2020-12-26', 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(1, 'Rundina', 'rundina', '123456', 1),
(2, 'Rey', 'rey', '123456', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_kategori_barang_id_foreign` (`kategori_barang_id`);

--
-- Indeks untuk tabel `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bom_barang_id_foreign` (`barang_id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_bom`
--
ALTER TABLE `detail_bom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_bom_bahan_baku_id_foreign` (`bahan_baku_id`),
  ADD KEY `detail_bom_bom_id_foreign` (`bom_id`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pembelian_bahan_baku_id_foreign` (`bahan_baku_id`),
  ADD KEY `detail_pembelian_pembelian_id_foreign` (`pembelian_id`);

--
-- Indeks untuk tabel `detail_penerimaan`
--
ALTER TABLE `detail_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  ADD PRIMARY KEY (`id_transaksi`,`id_barang`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_penjualan_penjualan_id` (`penjualan_id`),
  ADD KEY `detail_penjualan_barang_id_foreign` (`barang_id`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`kode_akun`,`id_transaksi`);

--
-- Indeks untuk tabel `kartu_stok`
--
ALTER TABLE `kartu_stok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_beban`
--
ALTER TABLE `kategori_beban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logcart`
--
ALTER TABLE `logcart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `logsaldo`
--
ALTER TABLE `logsaldo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran_beban`
--
ALTER TABLE `pembayaran_beban`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_pemasok_id_foreign` (`pemasok_id`);

--
-- Indeks untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indeks untuk tabel `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_pelanggan_id_foreign` (`pelanggan_id`);

--
-- Indeks untuk tabel `penjualan_online`
--
ALTER TABLE `penjualan_online`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perubahan_modal`
--
ALTER TABLE `perubahan_modal`
  ADD PRIMARY KEY (`id_modal`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_bom`
--
ALTER TABLE `detail_bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `detail_penerimaan`
--
ALTER TABLE `detail_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kartu_stok`
--
ALTER TABLE `kartu_stok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `logcart`
--
ALTER TABLE `logcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `logsaldo`
--
ALTER TABLE `logsaldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `penjualan_online`
--
ALTER TABLE `penjualan_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_kategori_barang_id_foreign` FOREIGN KEY (`kategori_barang_id`) REFERENCES `kategori_barang` (`id`);

--
-- Ketidakleluasaan untuk tabel `bom`
--
ALTER TABLE `bom`
  ADD CONSTRAINT `bom_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);

--
-- Ketidakleluasaan untuk tabel `detail_bom`
--
ALTER TABLE `detail_bom`
  ADD CONSTRAINT `detail_bom_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_bom_bom_id_foreign` FOREIGN KEY (`bom_id`) REFERENCES `bom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_pembelian_id_foreign` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_penjualan_id` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_pemasok_id_foreign` FOREIGN KEY (`pemasok_id`) REFERENCES `pemasok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
