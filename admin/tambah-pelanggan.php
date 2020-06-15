<h2>Tambah Produk</h2>
<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" class="form-control" name="email">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" class="form-control" name="password">
	</div>
	<div class="form-group">
		<label>Telepon</label>
		<input type="text" class="form-control" name="telepon">
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<textarea class="form-control" name="alamat" rows="10"></textarea>
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form><br>
<?php
	if(isset($_POST['save'])){
		//Query menyimpan data pada form input ke tabel "pelanggan" dalam database 
		$koneksi->query("INSERT INTO pelanggan (nama_pelanggan, email_pelanggan, password_pelanggan, telepon_pelanggan, alamat_pelanggan)
		                     VALUES ('$_POST[nama]',
		                             '$_POST[email]',
		                             '$_POST[password]',
		                             '$_POST[telepon]',
		                             '$_POST[alamat]')");
		//Notif tersimpan
		echo "<div class='alert alert-info'>Data tersimpan!</div>";
		//Merefresh halaman ketika sukses menyimpan
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
	}
?>	
