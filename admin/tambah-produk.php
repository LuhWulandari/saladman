<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | TAMBAH PRODUK</title>
</head>
<body>
	<h2>Tambah Produk</h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class="form-group">
			<label>Harga</label>
			<input type="number" class="form-control" name="harga">
		</div>
		<div class="form-group">
			<label>Berat (gr)</label>
			<input type="number" class="form-control" name="berat">
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<textarea class="form-control" name="deskripsi" rows="10"></textarea>
		</div>
		<div class="form-group">
			<label>Foto</label>
			<input type="file" class="form-control" name="foto">
		</div>
		<button class="btn btn-primary" name="save">Simpan</button>
	</form><br>
	<?php
		if(isset($_POST['save'])){
			//Meyimpan File
			$nama = $_FILES['foto']['name'];
			$lokasi = $_FILES['foto']['tmp_name'];
			move_uploaded_file($lokasi, "../foto_produk/".$nama);
			//Query menyimpan data pada form input ke tabel "produk" dalam database 
			$koneksi->query("INSERT INTO produk (nama_produk, harga_produk, berat_produk, foto_produk, deskripsi_produk)
		                     VALUES ('$_POST[nama]',
		                             '$_POST[harga]',
		                             '$_POST[berat]',
		                             '$nama',
		                             '$_POST[deskripsi]')");
			//Notif tersimpan
			echo "<div class='alert alert-info'>Data tersimpan!</div>";
			//Merefresh halaman ketika sukses menyimpan
			echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
		}
	?>	
</body>
</html>