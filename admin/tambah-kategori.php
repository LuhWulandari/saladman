<h2>Tambah Kategori</h2>
<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form><br>
<?php
	if(isset($_POST['save'])){
		//Query menyimpan data pada form input ke tabel "kategori" dalam database 
		$koneksi->query("INSERT INTO kategori (nama_kategori) VALUES ('$_POST[nama]')");
		//Notif tersimpan
		echo "<div class='alert alert-info'>Data tersimpan!</div>";
		//Merefresh halaman ketika sukses menyimpan
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
	}
?>	
