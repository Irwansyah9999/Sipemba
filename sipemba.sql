-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2021 at 02:32 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipemba`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(10) NOT NULL,
  `keterangan_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `keterangan_barang`) VALUES
('1234', 'dfgds');

-- --------------------------------------------------------

--
-- Table structure for table `barang_detail`
--

CREATE TABLE `barang_detail` (
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `status_barang` varchar(20) NOT NULL,
  `jenis_barang` varchar(15) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `massa_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_detail`
--

INSERT INTO `barang_detail` (`kode_barang`, `nama_barang`, `status_barang`, `jenis_barang`, `jumlah_barang`, `massa_barang`) VALUES
('120', 'trafo', 'Baik', '1', 2, 0),
('12032', 'pakaian batik', 'Baik', '2', 2, 3),
('12143', 'Pisang', 'Baik', '2', 1, 4354),
('1234', 'Celana', 'Baik', 'Texstil', 100, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cek_point`
--

CREATE TABLE `cek_point` (
  `kode_cp` varchar(10) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kab_kota` varchar(25) NOT NULL,
  `titik_point` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cek_point`
--

INSERT INTO `cek_point` (`kode_cp`, `provinsi`, `kab_kota`, `titik_point`) VALUES
('JW01', 'Banten', 'Kabupaten Tangerang', '1'),
('JW01-1', 'Banten', 'Kota Serang', '0'),
('JW123', 'Jawa Tengah', 'Pekalongan', '0'),
('SM01', 'Nangroe Aceh Darusalam', 'Banda Aceh', '0'),
('SM10', 'Lampung', 'Bandar Lampung', '0');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` varchar(10) NOT NULL,
  `nama_karyawan` varchar(25) NOT NULL,
  `tempat_lahir_karyawan` varchar(25) NOT NULL,
  `tanggal_lahir_karyawan` date NOT NULL,
  `jenis_kelamin_karyawan` varchar(2) NOT NULL,
  `divisi_karyawan` varchar(20) NOT NULL,
  `jabatan_karyawan` varchar(20) NOT NULL,
  `email_karyawan` varchar(30) NOT NULL,
  `telepon_karyawan` varchar(15) NOT NULL,
  `alamat_karyawan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama_karyawan`, `tempat_lahir_karyawan`, `tanggal_lahir_karyawan`, `jenis_kelamin_karyawan`, `divisi_karyawan`, `jabatan_karyawan`, `email_karyawan`, `telepon_karyawan`, `alamat_karyawan`) VALUES
('2015141802', 'Irwansyah', 'Tangerang', '1996-08-02', 'L', 'admin', 'kepala bagian', 'irwan@gmail.com', '08111', 'Panaruk'),
('2015141803', 'Budi', 'Bogor', '1996-10-15', 'L', 'pengantar', 'karyawan', 'budi@gmail.com', '08111', 'Pamulang'),
('2015141804', 'Neni', 'Serang', '1996-10-27', 'P', 'admin', 'karyawan', 'neni@gmail.com', '08111', 'Pasar kemis'),
('2015141805', 'Yaya', 'Depok', '1996-10-13', 'P', 'admin', 'karyawan', 'yaya@gmail.com', '08111', 'Cikupa'),
('2015141807', 'Alfin', 'Ciputat', '1997-06-16', 'L', 'admin', 'karyawan', 'alfin@gmail.com', '08111', 'Ciputat'),
('2015146532', 'Pupung Akram', 'rumah sakit', '1998-11-18', 'P', 'admin', 'karyawan', 'pupung@gmail.com', '08111', 'Jakarta'),
('2016142062', 'Qisthy', 'Jakarta', '1997-09-02', 'P', 'admin', 'karyawan', 'fqis@gmail.com', '086555555555555', 'Jl jauh jauh');

-- --------------------------------------------------------

--
-- Table structure for table `penerima`
--

CREATE TABLE `penerima` (
  `kode_penerima` varchar(15) NOT NULL,
  `nama_penerima` varchar(25) NOT NULL,
  `telepon_penerima` varchar(15) NOT NULL,
  `alamat_penerima` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerima`
--

INSERT INTO `penerima` (`kode_penerima`, `nama_penerima`, `telepon_penerima`, `alamat_penerima`) VALUES
('kpe1612962', 'Adi', '08787797977', ' Tes');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kode_pengguna` varchar(10) NOT NULL,
  `nama_pengguna` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `akses_pengguna` varchar(15) NOT NULL,
  `akses_pembuatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kode_pengguna`, `nama_pengguna`, `username`, `password`, `akses_pengguna`, `akses_pembuatan`) VALUES
('2015141802', 'Irwansyah', 'irwan@gmail.com', '54321', 'kb', '2020-10-14 13:18:26'),
('2015141803', 'Budi', 'budi@gmail.com', '12345', 'karyawan', '2020-10-14 18:48:53'),
('2015141804', 'Neni', 'neni@gmail.com', '19961027', 'karyawan', '2020-10-14 18:50:04'),
('2015141805', 'Yaya', 'yaya@gmail.com', '19961013', 'karyawan', '2020-10-14 18:51:54'),
('2015141807', 'Alfin', 'alfin@gmail.com', '19970616', 'karyawan', '2020-10-14 18:55:20'),
('2015146532', 'Pupung Akram', 'pupung@gmail.com', '19981118', 'karyawan', '2020-11-03 14:37:54'),
('2016142062', 'Qisthy', 'fqis@gmail.com', '19970902', 'karyawan', '2020-11-03 15:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `pengirim`
--

CREATE TABLE `pengirim` (
  `kode_pengirim` varchar(15) NOT NULL,
  `nama_pengirim` varchar(25) NOT NULL,
  `telepon_pengirim` varchar(15) NOT NULL,
  `alamat_pengirim` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengirim`
--

INSERT INTO `pengirim` (`kode_pengirim`, `nama_pengirim`, `telepon_pengirim`, `alamat_pengirim`) VALUES
('kp16129628', 'Tedi', '08112', 'Banten-Kota Serang Tes');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `kode_pengiriman` varchar(15) NOT NULL,
  `tanggal_pengiriman` datetime NOT NULL,
  `status_pengiriman` varchar(15) NOT NULL,
  `massa_pengiriman` int(11) NOT NULL,
  `harga_pengiriman` int(11) NOT NULL,
  `kode_pengirim` varchar(15) NOT NULL,
  `kode_penerima` varchar(15) NOT NULL,
  `kode_barang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`kode_pengiriman`, `tanggal_pengiriman`, `status_pengiriman`, `massa_pengiriman`, `harga_pengiriman`, `kode_pengirim`, `kode_penerima`, `kode_barang`) VALUES
('P1612962805', '2021-02-10 20:13:25', 'diproses', 310, 100000, 'kp16129628', 'kpe1612962', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_detail`
--

CREATE TABLE `pengiriman_detail` (
  `kode_pengiriman` varchar(15) NOT NULL,
  `tanggal_detail` datetime NOT NULL,
  `status_detail` varchar(15) NOT NULL,
  `cek_point` varchar(100) NOT NULL,
  `jenis_detail` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `nip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `no_provinsi` varchar(10) NOT NULL,
  `nama_provinsi` varchar(25) NOT NULL,
  `pulau` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `barang_detail`
--
ALTER TABLE `barang_detail`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `cek_point`
--
ALTER TABLE `cek_point`
  ADD PRIMARY KEY (`kode_cp`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`kode_penerima`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kode_pengguna`);

--
-- Indexes for table `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`kode_pengirim`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`kode_pengiriman`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
