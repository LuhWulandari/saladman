<h2>Data Produk</h2>
<a href="index.php?halaman=tambah-produk" class="btn btn-success navbar-right"> <span class="glyphicon glyphicon-plus"></span> Tambah Produk</a>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Stok</th>
			<th>Berat (gr)</th>
			<th>Foto</th>
			<th>Deskripsi</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//Query menampilkan data pada tabel "produk" 
			$query = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori"); 
			//Membuat nomor urut
			$nomor = 1;
			//Menampilkan data
			while ($data = $query->fetch_assoc()){  
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $data['nama_kategori']; ?></td>
			<td><?php echo $data['nama_produk']; ?></td>
			<td>Rp. <?php echo number_format($data['harga_produk']); ?> ,-</td>
			<td><?php echo $data['stok_produk']; ?></td>
			<td><?php echo $data['berat_produk']; ?></td>
			<td>
				<img src="../foto_produk/<?php echo $data['foto_produk']; ?>" width="100px">
			</td> 
			<td><?php echo $data['deskripsi_produk']; ?></td>
			<td>
				<a href="index.php?halaman=ubah-produk&id=<?php echo $data['id_produk']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
				<a href="index.php?halaman=hapus-produk&id=<?php echo $data['id_produk']; ?>" class="btn-danger btn"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
				<a href="index.php?halaman=detail-produk&id=<?php echo $data['id_produk']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span> Detail</a>
			</td>
		</tr>
		<?php
			$nomor++;
			}
		?>
	</tbody>
</table>