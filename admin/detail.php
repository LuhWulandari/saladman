<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | DETAIL PEMBELIAN</title>
</head>
<body>
	<h2>Detail Pembelian</h2>
	<?php 
		//Query Inner Join pada tabel "pembelian" dan tabel "pelanggan"
		$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
			                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan
			                      WHERE pembelian.id_pembelian = '$_GET[id]'");

		$detail = $query->fetch_assoc();
	?>
	<!-- <pre>
		<?php print_r($detail); ?>	
	</pre> -->
	<strong>
		Nama : <?php echo $detail['nama_pelanggan']; ?>
	</strong><br>
	<p>
		Telepon : <?php echo $detail['telepon_pelanggan']; ?> <br>
		Email : <?php echo $detail['email_pelanggan']; ?> <br>
		Alamat : <?php echo $detail['alamat_pelanggan']; ?>
	</p>
	<p>
		Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
		Total : <?php echo $detail['total_pembelian']; ?>
	</p>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			<?php
			    //Query Inner Join pada tabel "pembelian_produk" dan tabel "produk" 
				$query = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
					                   ON pembelian_produk.id_produk = produk.id_produk
					                   WHERE pembelian_produk.id_pembelian = '$_GET[id]'");
				//Membuat nomor urut
				$nomor = 1;
				//Menampilkan data
				while($data = $query->fetch_assoc()){                   
		    ?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $data['nama_produk']; ?></td>
				<td>Rp. <?php echo number_format($data['harga_produk']); ?> ,-</td>
				<td><?php echo $data['jumlah']; ?></td>
				<td>
					Rp. <?php echo $data['harga_produk'] * $data['jumlah']; ?> ,-
				</td>
			</tr>
			<?php
				$nomor++; 
				}
			?>
		</tbody>
	</table>
</body>
</html>