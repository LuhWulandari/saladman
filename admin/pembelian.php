<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | LIST PEMBELIAN</title>
</head>
<body>
	<h2>Data Pembelian</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal</th>
				<th>Total</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//Query Inner Join pada tabel "pembelian" dan "pelanggan" untuk menampilkan nama pelanggan pada tabel "pelanggan" dan menampilkan tanggal pembelian dan total pembelian pada tabel "pembelian"
				$query = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
					                      ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
				//Membuat nomor urut
				$nomor = 1; 
				//Menampilkan data
				while($data = $query->fetch_assoc()){
			?> 
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $data['nama_pelanggan']; ?></td>
				<td><?php echo $data['tanggal_pembelian']; ?></td> 
				<td>Rp. <?php echo number_format($data['total_pembelian']); ?> ,-</td>
				<td><?php echo $data['status_pembelian']; ?></td>
				<td>
					<a href="index.php?halaman=detail&id=<?php echo $data['id_pembelian']; ?>" class="btn btn-info">Detail</a>
					<?php if($data['status_pembelian']=='Processing') : ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $data['id_pembelian']; ?>" class="btn btn-success">Cek</a>
					<?php endif ?>
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