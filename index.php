<?php
	session_start();
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN</title>
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
			<h1>Produk Terbaru</h1>
			<div class="row">
				<?php
					$query = $koneksi->query("SELECT * FROM produk");
					while($data = $query->fetch_assoc()){
				?>
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="foto_produk/<?php echo $data['foto_produk']; ?>" width="100px">
						<div class="caption">
							<h3><?php echo $data['nama_produk']; ?></h3>
							<h5><?php echo number_format($data['harga_produk']); ?></h5>
							<a href="beli.php?id=<?php echo $data['id_produk']; ?>" class="btn btn-primary">Beli</a>
							<a href="detail.php" class="btn btn-default"> Detail </a>
						</div>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</section>
</body>
</html>