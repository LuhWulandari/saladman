<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | UBAH PELANGGAN</title>
</head>
<body>
	<h2>Ubah Pelanggan</h2>
	<?php
		//Query menampilkan tabel "pelanggan" berdasarkan id_pelanggan
		$query = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");
		$data = $query->fetch_assoc();

		// echo "<pre>";
		// 	print_r($data);
		// echo "</pre>";
	?>
	<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $data["id_pelanggan"];?>">

		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_pelanggan']; ?>">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" value="<?php echo $data['email_pelanggan']; ?>">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="text" class="form-control" name="password" value="<?php echo $data['password_pelanggan']; ?>">
		</div>
		<div class="form-group">
			<label>Telepon</label>
			<input type="text" class="form-control" name="telepon" value="<?php echo $data['telepon_pelanggan']; ?>">
		</div>
		<div class="form-group">
			<label>Alamat</label>
			<textarea class="form-control" name="alamat" rows="10">
				<?php echo $data['alamat_pelanggan']; ?>
			</textarea>
		</div>
		<button class="btn btn-primary" name="ubah">Ubah</button>
	</form><br>
	<?php 
		if(isset($_POST['ubah'])){
			$id       = $_GET['id'];
			$nama     = $_POST['nama'];
			$email    = $_POST['email'];
			$password = $_POST['password'];
			$telepon  = $_POST['telepon'];
			$alamat   = $_POST['alamat'];

			$query = "UPDATE pelanggan SET nama_pelanggan     = '$nama',
			                               email_pelanggan    = '$email',
			                               password_pelanggan = '$password',
			                               telepon_pelanggan  = '$telepon',
			                               alamat_pelanggan   = '$alamat'
			                               WHERE id_pelanggan = '$id'";
			$sql = mysqli_query($koneksi, $query) or die (mysqli_error());

			if($query){
				echo "Data berhasil dirubah!";
			}else{
				echo "Error".$query."<br>".mysqli_error($koneksi);
			}
			mysqli_close($koneksi);
			echo "<script>alert('Data produk telah dirubah!');</script>";
			echo "<script>location='index.php?halaman=pelanggan';</script>";
		}
	?>
</body>
</html> 