-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 01:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saladman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Buah'),
(2, 'Sayur');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Kota Denpasar', 10000),
(2, 'Denpasar Barat', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'cempana@gmail.com', 'cempana', 'cempana', '085349985345', 'Jl. Kenari 5								'),
(2, 'awidyaandika@gmail.com', 'aan', 'Awidya Andika', '085858839746', 'Jl Buana Kubu (Toko Brahman)'),
(3, 'wulan@gmail.com', 'wulan', 'Wulan', '0853495843485', 'Jl Pasutri '),
(5, 'ekasuwitra@gmail.com', 'eka', 'Eka Suwitra', '085678594596', 'Jl. Tegal Harum');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 26, 'Awidya Andika', 'BNI', 16500, '2020-06-13', '20200613200143download.jpg'),
(3, 27, 'Awidya Andika', 'BCA', 13000, '2020-06-14', '2020061403085160320989_568cf4ce-70ce-4905-b641-e8b5f6ed36c9_690_690.jpg'),
(4, 32, 'Wulan', 'BCA', 19500, '2020-06-14', '20200614063629struk-pembayaran-tagihan-listrik-indomaret.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `resi_pengiriman` varchar(50) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `resi_pengiriman`, `status_pembelian`) VALUES
(26, 2, 1, '2020-06-13', 16500, 'Kota Denpasar', 10000, 'Jl. Buana Kubu, No. 65', 'ABC123', 'Barang dikirim'),
(27, 2, 2, '2020-06-13', 13000, 'Denpasar Barat', 10000, 'Jl Pasutri Gaje', 'BCA132', 'Barang dikirim'),
(28, 2, 1, '2020-06-13', 11000, 'Kota Denpasar', 10000, 'Jl. Gunung Agung 3', '', 'Pending'),
(29, 2, 1, '2020-06-13', 23000, 'Kota Denpasar', 10000, 'Jl. Watu Renggong', '', 'Pending'),
(30, 2, 2, '2020-06-13', 16500, 'Denpasar Barat', 10000, 'Jl. Subak Badra', '', 'Pending'),
(31, 2, 1, '2020-06-14', 11000, 'Kota Denpasar', 10000, 'Jl. Kenari 25', '', 'Pending'),
(32, 3, 1, '2020-06-14', 19500, 'Kota Denpasar', 10000, 'Jl. Badak 3', '', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(34, 26, 7, 1, 'Apel', 1000, 100, 100, 1000),
(35, 26, 8, 1, 'Tomat', 2500, 200, 200, 2500),
(36, 26, 9, 1, 'Brokoli', 3000, 300, 300, 3000),
(37, 27, 9, 1, 'Brokoli', 3000, 300, 300, 3000),
(38, 28, 7, 1, 'Apel', 1000, 100, 100, 1000),
(39, 29, 7, 2, 'Apel', 1000, 100, 200, 2000),
(40, 29, 8, 2, 'Tomat', 2500, 200, 400, 5000),
(41, 29, 9, 2, 'Brokoli', 3000, 300, 600, 6000),
(42, 30, 7, 1, 'Apel', 1000, 100, 100, 1000),
(43, 30, 8, 1, 'Tomat', 2500, 200, 200, 2500),
(44, 30, 9, 1, 'Brokoli', 3000, 300, 300, 3000),
(45, 31, 7, 1, 'Apel', 1000, 100, 100, 1000),
(46, 32, 7, 1, 'Apel', 1000, 100, 100, 1000),
(47, 32, 8, 1, 'Tomat', 2500, 200, 200, 2500),
(48, 32, 9, 1, 'Brokoli', 3000, 300, 300, 3000),
(49, 32, 11, 1, 'Salak', 3000, 500, 500, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `stok_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`) VALUES
(7, 1, 'Apel', 1000, 3, 100, 'apple1.jpg', 'Apel Segar			\r\n			'),
(8, 2, 'Tomat', 2500, 3, 200, '7f703281cd786114dd4ca14cab56dcdb.jpg', 'Tomat Segar'),
(9, 2, 'Brokoli', 3000, 3, 300, 'brokoli.jpg', 'Brokoli Segar'),
(11, 1, 'Salak', 3000, 3, 500, '8882996_edf79751-98c0-4bb8-a1b7-2955db6515ba_1000_875.jpg', 'Salak Segar'),
(13, 1, 'Rambutan', 5000, 800, 200, 'rambutan.jpg', 'Rambutan Segar'),
(14, 2, 'Kangkung', 1500, 5, 40, 'kangkung.jpg', 'Kangkung Segar');

-- --------------------------------------------------------

--
-- Table structure for table `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_foto_produk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_foto`
--

INSERT INTO `produk_foto` (`id_foto_produk`, `id_produk`, `nama_produk_foto`) VALUES
(1, 14, 'kangkung.jpg'),
(3, 14, '20200615010900kangkung 1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_foto_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_foto_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
