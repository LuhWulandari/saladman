<?php
	session_start();
	include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | NOTA PEMBELIAN</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<section class="konten">
		<div class="container">
			<h2>Detail Pembelian</h2>
			<?php 
				//Query Inner Join pada tabel "pembelian" dan tabel "pelanggan"
				$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
					                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan
					                      WHERE pembelian.id_pembelian = '$_GET[id]'");

				$detail = $query->fetch_assoc();
			?>
			
			
			<div class ="row">
					<div class="col-md-4">
						<h3> Pembelian </h3>
						<strong> No. Pembelian <?php echo $detail['id_pembelian']; ?></strong><br>
						Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
						Total : Rp. <?php echo number_format($detail['total_pembelian']); ?> ,-
					</div>
					<div class="col-md-4">
						<h3> Pelanggan </h3>
						<strong> Nama : <?php echo $detail['nama_pelanggan']; ?></strong><br>
						<p>
							Telepon : <?php echo $detail['telepon_pelanggan']; ?> <br>
							Email : <?php echo $detail['email_pelanggan']; ?> <br>
							Alamat : <?php echo $detail['alamat_pelanggan']; ?>
						</p>
					</div>
					<div class="col-md-4">
						<h3> Pengiriman </h3>
						<strong> Nama Kota : <?php echo $detail['nama_kota']; ?></strong><br>
						Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?> ,- <br>
						Alamat Pengiriman: <?php echo $detail['alamat_pengiriman']; ?>
					</div>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Berat</th>
						<th>Jumlah</th>
						<th>Subberat</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php
					    //Query Inner Join pada tabel "pembelian_produk" dan tabel "produk" 
						$query = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian= '$_GET[id]'");
						//Membuat nomor urut
						$nomor = 1;
						//Menampilkan data
						while($data = $query->fetch_assoc()){                   
				    ?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td>Rp. <?php echo number_format($data['harga']); ?> ,-</td>
						<td><?php echo $data['berat']; ?> gr. </td>
						<td><?php echo $data['jumlah']; ?></td>
						<td><?php echo $data['subberat']; ?> gr. </td>
						<td>Rp. <?php echo number_format($data['subharga']); ?></td>
					</tr>
					<?php
						$nomor++; 
						}
					?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-7">
					<div class="alert alert-info">
						<p>
							Silahkan melakukan pembayaran sebesar Rp. <?php echo number_format($detail['total_pembelian']); ?> ,-
							<br>
							<strong>BANK MANDIRI 143-00103022-3242 An/ ADMIN SALADMAN</strong>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>