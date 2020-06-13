<?php 
	session_start();
	include 'koneksi.php';

	//Jika belum login
	if(!isset($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
    }

    //Jika checkout kosong
    if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
		echo "<script>alert('Checkout kosong!');</script>";
		echo "<script>location='index.php';</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | CHECKOUT</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<!-- Jika sudah login -->
				<?php if(isset($_SESSION['pelanggan'])) : ?>
					<li><a href="logout.php">Logout</a></li>
				<!-- Jika belum login -->
				<?php else : ?>
					<li><a href="login.php">Login</a></li>
				<?php endif ?>
				<li><a href="checkout.php">Checkout</a></li>
			</ul>
		</div>
	</nav>
	<section class="konten">
		<div class="container">
			<h1>Keranjang Belanja</h1>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
					</tr>
				</thead>
				<tbody> 
					<?php $nomor = 1; ?>
					<?php $totalbelanja = 0; ?>
					<?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
					<?php 
						$query    = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
						$data     = $query->fetch_assoc();
						$subharga = $data["harga_produk"] * $jumlah;
					?> 
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $data['nama_produk']; ?></td>
						<td>Rp. <?php echo number_format($data['harga_produk']); ?> ,-</td>
						<td><?php echo $jumlah; ?></td>
						<td>Rp. <?php echo number_format($subharga); ?> ,-</td>
					</tr>
					<?php $nomor++; ?>
					<?php $totalbelanja += $subharga; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp. <?php echo number_format($totalbelanja); ?> ,-</th>
					</tr>
				</tfoot>
			</table>
			<form method="POST">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Nama</label>
							<input class="form-control" type="text" name="" readonly="" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Telepon</label>
							<input class="form-control" type="text" name="" readonly="" value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Alamat</label>
							<input class="form-control" type="text" name="" readonly="" value="<?php echo $_SESSION['pelanggan']['alamat_pelanggan']; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Ongkir</label>
							<select class="form-control" name="id_ongkir">
								<option value="">Pilih Ongkos Kirim</option>
								<?php
									$query = $koneksi->query("SELECT * FROM ongkir");
									while($data  = $query->fetch_assoc()){
								?>
								<option value="<?php echo $data['id_ongkir']; ?>">
									<?php echo $data['nama_kota']; ?> -
						            Rp.<?php echo number_format($data['tarif']); ?> ,-
								</option>
								<?php 
									} 
								?>	
							</select>
						</div>
					</div>
				</div>
				<div class="form-group"> 
					<label> Alamat Lengkap Pengiriman </label>
					<textarea class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap" ></textarea>
				</div>
				<button class="btn btn-primary" name="checkout">Checkout</button>
			</form>
			<?php
				if(isset($_POST['checkout'])){
					//Mengambil data field pada tabel pembelian dan menyimpannya di beberapa variabel
					$id_pelanggan      = $_SESSION['pelanggan']['id_pelanggan'];
					$id_ongkir         = $_POST['id_ongkir'];
					$tanggal_pembelian = date("Y-m-d");
					$alamat_pengiriman = $_POST['alamat_pengiriman'];

					//Menghitung Ongkir
					$query           = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
					$ongkir          = $query->fetch_assoc();
					$nama_kota		= $ongkir['nama_kota'];
						//Mengambil data field tarif dan menyimpannya di $tarif_ongkir
					$tarif   = $ongkir['tarif'];
						//Menghitung total belanja beserta ongkirnya dan disimpan di total_pembelian
					$total_pembelian = $totalbelanja + $tarif_ongkir;

					//Menyimpan data checkout ke tabel "pembelian"
					$koneksi->query("INSERT INTO pembelian (id_pelanggan, 
						                                    id_ongkir,
						                                    tanggal_pembelian,
						                                    total_pembelian,nama_kota,tarif,alamat_pengiriman)
								                    VALUES ('$id_pelanggan',
								                            '$id_ongkir',
								                            '$tanggal_pembelian',
								                            '$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

					//Menyimpan hasil dari data checkout (produk yang dibeli) ke tabel pembelian_produk
					$id_pembelian_produk = $koneksi->insert_id;

					foreach ($_SESSION['keranjang'] as $id_produk => $jumlah)
					{
						//mendapatkan data produk berdasarkan id_produk
						$query = $koneksi->query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
						$data  = $query->fetch_assoc();
						$nama = $data ['nama_produk'];
						$harga = $data ['harga_produk'];
						$berat  = $data ['berat_produk'];

						$subberat = $data ['berat_produk']*$jumlah;
						$subharga = $data ['harga_produk']*$jumlah;
						$koneksi->query("INSERT INTO pembelian_produk (id_pembelian, 
							                                           id_produk,nama,harga,
																	   berat,subberat,subharga,
							                                           jumlah)
							                                   VALUES ('$id_pembelian_produk',
							                                           '$id_produk', '$nama', '$harga', '$berat', 
																	   '$subberat', '$subharga',
							                                           '$jumlah')");
					}

					//Mengosongkan keranjang belanja
					unset($_SESSION['keranjang']);

					//Mengalihkan tampilan ke halaman nota
					echo "<script>alert('Pembelian sukses!');</script>";
					echo "<script>location='nota.php?id=$id_pembelian_produk';</script>";
				}
			?>
		</div>
	</section>
</body>
</html>