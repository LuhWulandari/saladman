<?php
	session_start();
	include 'koneksi.php';

	// echo "<pre>";
	// print_r($_SESSION['keranjang']);
	// echo "</pre>";
	if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
		echo "<script>alert('Keranjang kosong!');</script>";
		echo "<script>location='index.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | KERAJANG BELANJA</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<!-- Jika sudah login -->
				<?php if(isset($_SESSION['pelanggan'])) : ?>
					<li><a href="logout.php">Logout</a></li>
				<!-- Jika belum login -->
				<?php else : ?>
					<li><a href="login.php">Login</a></li>
				<?php endif ?>
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
		</div>
	</nav>
	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody> 
					<?php $nomor = 1; ?>
					<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
					<?php 
						$query    = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
						$data     = $query->fetch_assoc();
						$subharga = $data["harga_produk"] * $jumlah;
						// echo "<pre>";
						// print_r($data);
						// echo "</pre>";
					?> 
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $data['nama_produk']; ?></td>
						<td>Rp. <?php echo number_format($data['harga_produk']); ?> ,-</td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?> ,-</td>
						<td>
							<a href="hapus-keranjang.php?id=<?php echo $id_produk; ?>" class="btn btn-danger btn-xs">Hapus</a>
						</td>
					</tr>
					<?php $nomor++; ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
			<a href="checkout.php" class="btn btn-primary">Checkout</a>
		</div>
	</section>
</body>
</html>