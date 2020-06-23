-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 07. September 2019 jam 07:07
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `petshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `addretur`
--

CREATE TABLE IF NOT EXISTS `addretur` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data_retur` text,
  `status` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `addretur`
--

INSERT INTO `addretur` (`id`, `data_retur`, `status`) VALUES
(1, '&lt;p&gt;tgdgdfg&lt;/p&gt;', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama_admin`, `password`) VALUES
(1, 'suci', 'suci indayani', '1cc6545f956f39a79c80b05f65df3c0a'),
(7, 'dini', 'dini aminarti', '83476316a972856163fb987b861a0a2c'),
(8, 'melly', 'melly adi', 'mely');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` varchar(6) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `kd_kategori` int(11) NOT NULL,
  `harga` int(5) NOT NULL,
  `stok` int(5) NOT NULL,
  `spesifikasi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `nm_barang`, `kd_kategori`, `harga`, `stok`, `spesifikasi`, `gambar`) VALUES
('001', 'Hannochs Tricolour Lampu LED [14 Watt]', 2, 35, 48, 'Lampu hemat energi\r\nUmur Lampu : 15.000 jam\r\nWatt : 14W\r\nLumen : CW=1452lm, WW=1323lm, CF=1417lm\r\nVoltase : 90-260V/50-60Hz CRI (Color Rendering Index) : > 80            ', 'lampu.PNG'),
('002', 'Hannochs Motion Sensor CDL Lampu LED [13W]', 2, 49, 29, 'Fitur Produk\r\n\r\nLampu hemat energi\r\nUmur Lampu : 10.000 jam\r\nWatt : 13W\r\nLumen : 1330lm\r\nTegangan : 100-240 V/50-60Hz CRI (Color Rendering Index) : &#8805; 80      ', 'lampu2.PNG'),
('004', 'Hannochs Billboard Lampu Sorot LED [50W]', 1, 263, 50, 'Fitur Produk\r\n\r\nVoltase : 100-277v 3500lumen\r\nStandar IP65 kedap air\r\nBahan produk : aluminium + Kaca\r\nBebas Radiasi UV dan IR\r\nSudut Pencahayaan 120 derajat                     ', 'lampu 4.PNG'),
('005', 'Hannochs Genius CDL Lampu LED [15W]', 2, 105, 30, 'Fitur Produk\r\n\r\nLampu hemat energi\r\nUmur lampu : 15.000 Jam\r\nVoltase : 90-260V/50-60Hz\r\nWatt : 15W\r\nLumen : 1270lm         ', 'lampu 5.PNG'),
('006', 'Hannochs HFL 10W LED Flood Light Lampu Tembak [10 W]', 1, 100, 40, 'Fitur Produk\r\n\r\nHFL 10W menggantikan lampu sorot Halogen 100W 700 lumens\r\nTersedia pilihan warna cahaya Cool White\r\nDapat beroperasi pada tegangan 100-240V\r\nCocok digunakan untuk di dalam dan di luar ruangan, seperti Bill Board, sign board, area parkir, lapangan, hall, gedung olahraga, dll\r\nVoltase 100-240v 700 lumen         ', 'lampu 6.PNG'),
('007', 'Hannochs Spiral Bohlam Lampu [20 Watt]', 2, 47, 35, 'Fitur Produk\r\n\r\nBohlam lampu\r\nDidesain dalam bentuk spiral\r\nTahan lama hingga 8000 jam\r\nDapat beroperasi pada tegangan 170 - 250 Volt\r\nDaya : 20 Watt   ', 'lampu 7.PNG'),
('008', 'Hannochs Rendah Voltage Bolam Lampu [5 W/ 2 pcs]', 2, 50, 25, 'Fitur Produk\r\n\r\nDaya : 5 Watt\r\nHemat energi hingga 80%\r\nDapat beroperasi pada tegangan turun naik atau 110 - 230 V\r\nTahan lama hingga 8000 jam\r\nCertified efficiency labelisation         ', 'lampu 8.PNG'),
('009', 'Hannochs Music Lamp Cdl Lampu LED [9W]', 2, 180, 20, 'Fitur Produk\r\n\r\nUmur Lampu : 15.000 jam\r\nWatt : 6W\r\nBola Lampu LED + 3W Speaker\r\nLumen : 470lm\r\nFitting : E27   ', 'lampu 9.PNG'),
('00JK1', 'Hannochs Tricolour Lampu LED [10 W]', 2, 27, 40, 'Fitur Produk\r\n\r\nLampu LED\r\nMemiliki 3 warna pilihan dalam 1 lampu (cool white, warm white & comfort)\r\nUmur Lampu : 15.000 jam\r\nWatt : 10W\r\nLumen : CW=1100 lm, WW=1000 lm, CF=1100 lm               ', 'lampu3.PNG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE IF NOT EXISTS `detail_order` (
  `id_order` varchar(8) NOT NULL,
  `kd_barang` varchar(6) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id_order`, `kd_barang`, `jumlah`, `harga`, `total`) VALUES
('PS000001', '001', 1, 1000000, 0),
('PS000002', '001', 1, 1000000, 0),
('PS000003', '00JK1', 1, 1200000, 0),
('PS000004', '002', 1, 22222, 0),
('PS000005', '00JK1', 1, 1200000, 0),
('PS000006', '001', 1, 1000000, 0),
('PS000007', '001', 1, 1000000, 0),
('PS000008', '001', 1, 1000000, 0),
('PS000009', '002', 1, 200000, 0),
('PS000010', '002', 1, 200000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kd_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kategori` varchar(25) NOT NULL,
  PRIMARY KEY (`kd_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kd_kategori`, `nm_kategori`) VALUES
(1, 'Lampu Sorot'),
(2, 'Lampu LED');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `kd_keranjang` int(6) NOT NULL AUTO_INCREMENT,
  `kd_barang` varchar(6) NOT NULL,
  `kd_pelanggan` int(8) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `harga` int(5) NOT NULL,
  PRIMARY KEY (`kd_keranjang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`kd_keranjang`, `kd_barang`, `kd_pelanggan`, `jumlah`, `tgl`, `harga`) VALUES
(1, '00JK1', 7, 2, '2019-09-07', 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id_konf` int(4) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(8) NOT NULL,
  `nm_pelanggan` varchar(50) NOT NULL,
  `jml_tf` int(8) NOT NULL,
  `ket` text NOT NULL,
  `tgl` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_konf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konf`, `id_order`, `nm_pelanggan`, `jml_tf`, `ket`, `tgl`, `gambar`) VALUES
(5, 'PS000001', 'Dendi kurniawan', 2000000, 'baru', '2019-09-07', 'lampu 9.PNG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota_kirim`
--

CREATE TABLE IF NOT EXISTS `kota_kirim` (
  `kd_kota` int(3) NOT NULL AUTO_INCREMENT,
  `nm_kota` varchar(100) NOT NULL,
  `ongkir` int(12) NOT NULL,
  PRIMARY KEY (`kd_kota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kota_kirim`
--

INSERT INTO `kota_kirim` (`kd_kota`, `nm_kota`, `ongkir`) VALUES
(1, 'Medan', 20000),
(2, 'Jakarta', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderan`
--

CREATE TABLE IF NOT EXISTS `orderan` (
  `id_order` varchar(8) NOT NULL,
  `kd_pelanggan` int(8) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `nm_kota` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pos` int(5) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `status` enum('PESAN','LUNAS','BATAL') NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orderan`
--

INSERT INTO `orderan` (`id_order`, `kd_pelanggan`, `nama_pelanggan`, `tgl`, `nm_kota`, `alamat`, `pos`, `telp`, `status`) VALUES
('PS000001', 7, 'Dendi kurniawan', '2019-09-07', '2', 'Kp.cikoneng ilir Rt.03/06 jatake jatiuwung Kota Tangerang', 15136, '+6285215417364', 'LUNAS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kd_pelanggan` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nm_kota` varchar(30) NOT NULL,
  PRIMARY KEY (`kd_pelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `username`, `password`, `nama_pelanggan`, `jk`, `alamat`, `telp`, `email`, `nm_kota`) VALUES
(5, 'suci', '1cc6545f956f39a79c80b05f65df3c0a', 'suci indayani', 'Perempuan', 'Jalan Mahoni 4 perum 2', '089788765467', 'suci@gmail.com', 'Tangerang'),
(6, 'nindy672', '4240f2f2a09b05b4d4e3b2fcde6cb105', 'nindy', 'Laki-Laki', 'jatake', '08138070667', 'dendi.info@gmail.com', 'tangerang'),
(7, 'dendi672', 'd1516f23f6bd6661359aaf6625de3b05', 'askl', 'Laki-Laki', 'sdfhjkl', '12346789', 'dendi.info@gmail.com', 'tangerang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur`
--

CREATE TABLE IF NOT EXISTS `retur` (
  `id_retur` int(4) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(8) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  `tgl` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_retur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `retur`
--

INSERT INTO `retur` (`id_retur`, `id_order`, `nm_barang`, `ket`, `tgl`, `gambar`) VALUES
(8, 'PS000001', 'Lampu LED', 'Tidak Nyala', '2019-09-07', 'lampu.PNG');
