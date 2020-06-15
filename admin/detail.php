<h2>Detail Pembelian</h2>
<?php 
	//Query Inner Join pada tabel "pembelian" dan tabel "pelanggan"
	$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
		                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan
		                      WHERE pembelian.id_pembelian = '$_GET[id]'");
	$detail = $query->fetch_assoc();
?>
<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong> No. Pembelian <?php echo $detail['id_pembelian']; ?></strong><br>
		 Tanggal : <?php echo $detail['tanggal_pembelian']; ?>
		<br>
		 Total : Rp. <?php echo number_format($detail['total_pembelian']); ?>
		 ,-<br>
		 Status : <?php echo $detail['status_pembelian']; ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong> Nama : <?php echo $detail['nama_pelanggan']; ?></strong><br>
		 Telepon : <?php echo $detail['telepon_pelanggan']; ?>
		<br>
		 Email : <?php echo $detail['email_pelanggan']; ?>
		<br>
		 Alamat : <?php echo $detail['alamat_pelanggan']; ?>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong> Nama Kota : <?php echo $detail['nama_kota']; ?></strong><br>
		 Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?>
		 ,- <br>
		 Alamat Pengiriman: <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>
<br>
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
				                      ON pembelian_produk.id_produk       = produk.id_produk
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
