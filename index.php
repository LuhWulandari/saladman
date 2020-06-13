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
	<?php include 'menu.php'; ?>
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
							<a href="beli.php?id=<?php echo $data['id_produk']; ?>" 
							class="btn btn-primary">Beli</a>
							<a href="detail.php?id=<?php echo $data ['id_produk']; ?>" 
							class="btn btn-default"> Detail </a>
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