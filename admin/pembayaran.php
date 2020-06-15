<?php
	//Mendapatkan id_pembelian dari url
	$id_pembelian = $_GET['id']; 

	$query = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
	$data  = $query->fetch_assoc();
?>
<h2>Detail Pembayaran</h2>
<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nama</th>
				<td><?php echo $data['nama']?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $data['bank']?></td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>Rp. <?php echo number_format($data['jumlah']); ?> ,-</td> 
			</tr>
			<tr>
				<th>Tanggal</th>
				<td><?php echo $data['tanggal']?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<img src="../bukti_pembayaran/<?php echo $data['bukti'] ?>" alt="" class="img-responsive">
	</div>
</div>
<form method="POST">
	<div class="form-group">
		<label>No Resi Pengiriman</label>
		<input type="text" class="form-control" name="resi">
	</div>
	<div class="form-group">
		<label>Status</label>
		<select class="form-control" name="status">
			<option value="">Pilih Status</option>
			<option value="Di Batalkan">Di Batalkan</option>
			<option value="Barang dikirim">Barang Dikirim</option>
			<option value="Lunas">Lunas</option>
			<option value="Batal">Batal</option>
		</select>
	</div>
	<button class="btn btn-primary" name="proses">Proses</button>
</form>
<?php
	if(isset($_POST['proses'])){
		$resi   = $_POST['resi'];
		$status = $_POST['status'];
		$koneksi->query("UPDATE pembelian SET resi_pengiriman  = '$resi',
			                                  status_pembelian = '$status'
			                            WHERE id_pembelian     = '$id_pembelian'");
		echo "<script>alert('Data pembelian terupdate!');</script>";
		echo "<script>location='index.php?halaman=pembelian';</script>";
	}
?>