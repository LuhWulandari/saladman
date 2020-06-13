<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | LIST PRODUK</title>
</head>
<body>
	<h2>Data Produk</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Harga</th>
				<th>Berat (gr)</th>
				<th>Foto</th>
				<th>Deskripsi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//Query menampilkan data pada tabel "produk" 
				$query = $koneksi->query("SELECT * FROM produk");
				//Membuat nomor urut
				$nomor = 1;
				//Menampilkan data
				while ($data = $query->fetch_assoc()){  
			?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $data['nama_produk']; ?></td>
				<td>Rp. <?php echo number_format($data['harga_produk']); ?> ,-</td>
				<td><?php echo $data['berat_produk']; ?></td>
				<td>
					<img src="../foto_produk/<?php echo $data['foto_produk']; ?>" width="100px">
				</td> 
				<td><?php echo $data['deskripsi_produk']; ?></td>
				<td>
					<a href="index.php?halaman=ubah-produk&id=<?php echo $data['id_produk']; ?>" class="btn btn-warning">Ubah</a>
					<a href="index.php?halaman=hapus-produk&id=<?php echo $data['id_produk']; ?>" class="btn-danger btn">Hapus</a>
				</td>
			</tr>
			<?php
				$nomor++;
				}
			?>
		</tbody>
	</table>
	<a href="index.php?halaman=tambah-produk" class="btn btn-primary">Tambah Data</a>
</body>
</html>