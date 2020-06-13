<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | LIST PELANGGAN</title>
</head>
<body>
	<h2>Data Produk</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Telepon</th>
				<th>Alamat</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				//Query menampilkan data pada tabel "pelanggan" 
				$query = $koneksi->query("SELECT * FROM pelanggan");
				//Membuat nomor urut
				$nomor = 1;
				//Menampilkan data
				while ($data = $query->fetch_assoc()){  
			?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $data['nama_pelanggan']; ?></td>
				<td><?php echo $data['email_pelanggan']; ?></td>
				<td><?php echo $data['telepon_pelanggan']; ?></td>
				<td><?php echo $data['alamat_pelanggan']; ?></td>
				<td>
					<a href="index.php?halaman=ubah-pelanggan&id=<?php echo $data['id_pelanggan']; ?>" class="btn btn-warning">Ubah</a>
					<a href="index.php?halaman=hapus-pelanggan&id=<?php echo $data['id_pelanggan']; ?>" class="btn-danger btn">Hapus</a>
				</td>
			</tr>
			<?php
				$nomor++;
				}
			?>
		</tbody>
	</table>
	<a href="index.php?halaman=tambah-pelanggan" class="btn btn-primary">Tambah Data</a>
</body>
</html>