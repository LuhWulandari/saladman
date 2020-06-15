<h2>Ubah kategori</h2>
<?php
	//Query menampilkan tabel "kategori" berdasarkan id_kategori
	$query = $koneksi->query("SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'");
	$data  = $query->fetch_assoc();
?>
<form method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $data["id_kategori"];?>">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_kategori']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form><br>
<?php 
	if(isset($_POST['ubah'])){
		$id       = $_GET['id'];
		$nama     = $_POST['nama'];

		$query = "UPDATE kategori SET  nama_kategori     = '$nama'
		                               WHERE id_kategori = '$id'";
		$sql = mysqli_query($koneksi, $query) or die (mysqli_error());

		if($query){
			echo "Data berhasil dirubah!";
		}else{
			echo "Error".$query."<br>".mysqli_error($koneksi);
		}
		mysqli_close($koneksi);
		echo "<script>alert('Data produk telah dirubah!');</script>";
		echo "<script>location='index.php?halaman=kategori';</script>";
	}
?>
