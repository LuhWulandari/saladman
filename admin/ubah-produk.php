<?php
	$datakategori = array();
	$query = $koneksi->query("SELECT * FROM kategori");
	while($data = $query->fetch_assoc())
	{
    	$datakategori[]=$data;
	}
?>
<h2>Ubah Produk</h2>
<?php
	//Query menampilkan tabel "produk" berdasarkan id_produk
	$query = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
	$data  = $query->fetch_assoc();
?>
<form method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kategori</label>
		<select class="form-control" name="id_kategori">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key =>$value): ?>
			<option value="<?php echo $value["id_kategori"] ?>"<?php if($data["id_kategori"]==$value["id_kategori"]){echo "selected";} ?> >
				<?php echo $value["nama_kategori"] ?>
			</option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $data['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $data['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" value="<?php echo $data['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Berat (gr)</label>
		<input type="number" class="form-control" name="berat" value="<?php echo $data['berat_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Foto Produk</label><br>
		<img src="../foto_produk/<?php echo $data['foto_produk']; ?>" width="100px">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10">
			<?php echo $data['deskripsi_produk']; ?>		
		</textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form><br>
<?php 
	if(isset($_POST['ubah'])){
		//Mengubah dan menyimpan File
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		//Jika mangganti foto
		if(!empty($lokasi)){
			move_uploaded_file($lokasi, "../foto_produk/$nama");
			$koneksi->query("UPDATE produk SET nama_produk      = '$_POST[nama]',
				                               harga_produk     = '$_POST[harga]',
				                               stok_produk      = '$_POST[stok]',
				                               berat_produk     = '$_POST[berat]',
				                               foto_produk      = '$nama',
				                               deskripsi_produk = '$_POST[deskripsi]',
											   id_kategori 		= '$_POST[id_kategori]
					                           WHERE id_produk  = '$_GET[id]'");
		}
		//Jika tidak mengganti mengganti foto
		else{
			$koneksi->query("UPDATE produk SET nama_produk      = '$_POST[nama]',
					                           harga_produk     = '$_POST[harga]',
					                           stok_produk      = '$_POST[stok]',
					                           berat_produk     = '$_POST[berat]',
					                           deskripsi_produk = '$_POST[deskripsi]',
											   id_kategori 		= '$_POST[id_kategori]
					                           WHERE id_produk  = '$_GET[id]'");
		}
		echo "<script>alert('Data produk telah dirubah!');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
?>
