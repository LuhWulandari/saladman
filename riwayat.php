<?php
	session_start();
    include 'koneksi.php';
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | RIWAYAT BELANJA</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<section class="riwayat">
		<div class="container">
			<h3>Riwayat Belanja <?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?></h3>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Total</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$nomor = 1;
						//Mendapatkan id_pelanggan
						$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
						//Mendapatkan data berdasarkan id_pelanggan pada tabel pembelian
						$query = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
						while($data = $query->fetch_assoc()){
					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $data['tanggal_pembelian']; ?></td>
						<td>Rp. <?php echo number_format($data['total_pembelian']); ?> ,-</td>
						<td>
							<?php echo $data['status_pembelian']; ?>
							<br>
							<?php if(!empty($data['resi_pengiriman'])) : ?>
							Resi : <?php echo $data['resi_pengiriman']; ?>
							<?php endif ?>
						</td>
						<td>
							<a href="nota.php?id=<?php echo $data['id_pembelian']; ?>" class="btn btn-info">Nota</a>
							<a href="pembayaran.php?id=<?php echo $data['id_pembelian']; ?>" class="btn btn-success">Pembayaran</a>
						</td>
					</tr>
					<?php
						$nomor++;
						}
					?>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>