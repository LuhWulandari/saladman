<?php
	include 'koneksi.php';
	session_start();
	unset($_SESSION['pelanggan']);
	unset($_SESSION['keranjang']);
	echo "<script>alert('Anda telah logout!');</script>";
	echo "<script>location='index.php';</script>";
?>