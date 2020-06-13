<?php
	session_start();
    include 'koneksi.php';
    
    if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
        echo "<script>alert('Anda harus login!');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }
    //Mendapatkan id_pembelian dari url
    $idpembeli            = $_GET['id'];
    $query                = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$idpembeli'");
    $detail_pembelian     = $query->fetch_assoc();

    //Jika pelanggan yang beli tidak sesuai dengan pelanggan yang login (tidak berhak melihat pembayaran orang lain)
	//Pelanggan yang beli harus sama dengan pelanggan yang login
    	//Mendapatkan id_pelanggan yang beli
    $user_beli  = $detail_pembelian['id_pelanggan'];
    	//Mendapatkan id_pelanggan yang login
    $user_login = $_SESSION['pelanggan']['id_pelanggan'];
    
    if($user_beli !== $user_login){
		echo "<script>alert('Data tidak sesuai!')</script>";
        echo "<script>location='riwayat.php'</script>";
        exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN | PEMBAYARAN</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim bukti pembayaran anda disini...</p>
		<div class="alert alert-info">
			Total tagihan anda <strong>Rp. <?php echo number_format($detail_pembelian['total_pembelian']); ?> ,-</strong>
		</div>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Penyetor</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto Bukti</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div>
	<?php
		if(isset($_POST['kirim'])){
			//Menyimpan file
			$namabukti   = $_FILES['bukti']['name'];
			$lokasibukti = $_FILES['bukti']['tmp_name'];
			$namafix     = date("YmdHis").$namabukti;
			move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

			$nama    = $_POST['nama'];
			$bank    = $_POST['bank'];
			$jumlah  = $_POST['jumlah'];
			$tanggal = date("Y-m-d");

			//Simpan pembayaran
			$koneksi->query("INSERT INTO pembayaran (id_pembelian,
		                                             nama,
		                                             bank,
		                                             jumlah, 
		                                             tanggal,
		                                             bukti)
		                                    VALUES  ('$idpembeli',
		                                            '$nama',
		                                            '$bank',
		                                            '$jumlah',
		                                            '$tanggal',
		                                            '$namafix')");
			
			//Ubah status pembelian dari pending menjadi processing
			$koneksi->query("UPDATE pembelian SET status_pembelian = 'Processing'
				                              WHERE id_pembelian   = '$idpembeli'");
			echo "<script>alert('Data terkirim, kami akan meninjau pembayaran anda!')</script>";
   			echo "<script>location='keranjang.php'</script>";
		}
	?>
</body>
</html>