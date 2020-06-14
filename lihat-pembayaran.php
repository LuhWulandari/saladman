<?php 
	session_start();
	include 'koneksi.php';

	$id_pembelian = $_GET['id'];

	$query	= $koneksi->query("SELECT * FROM pembayaran 
		                          LEFT JOIN pembelian 
		                          ON    pembayaran.id_pembelian = pembelian.id_pembelian 
		                          WHERE pembelian.id_pembelian  = '$id_pembelian'");
	$data   = $query->fetch_assoc();

	//Jika tidak ada data pembayaran
	if(empty($data)){
		echo "<script>alert('Belum ada data pembayaran!');</script>";
		echo "<script>location='riwayat.php';</script>";
		exit();
	}
	//Jika pelanggan yang bayar tidak sesuai dengan pelanggan yang login
	if($_SESSION['pelanggan']['id_pelanggan'] !== $data['id_pelanggan']){
		echo "<script>alert('Data tidak sesuai!')</script>";
    	echo "<script>location='riwayat.php'</script>";
        exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | LIHAT PEMBAYARAN</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include'menu.php'; ?>
	<div class="container">
		<h3>Lihat Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<th>
						<tr>
							<th>Nama</th>
							<td><?php echo $data['nama']; ?></td>
						</tr>
						<tr>
							<th>Bank</th>
							<td><?php echo $data['bank']; ?></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td><?php echo $data['tanggal']; ?></td>
						</tr>
						<tr>
							<th>Jumlah</th>
							<td>Rp. <?php echo number_format($data['jumlah']) ?> ,-</td>
						</tr>
					</th>
				</table>
			</div>
			<div class="col-md-6">
				<img src="bukti_pembayaran/<?php echo $data['bukti']; ?>" alt="" class="img-responsive">
			</div>
		</div>
	</div>
</body>
</html>