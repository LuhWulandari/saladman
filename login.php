<?php
	session_start();
    include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>SALADMAN</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
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
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Login Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="POST">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="password">
							</div>
							<button class="btn btn-primary" name="login">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(isset($_POST['login'])){
			$email    = $_POST['email'];
			$password = $_POST['password'];
			//Mengambil data email_pelanggan dan password_pelanggan pada tabel "pelanggan"
			$query = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan    = '$email' 
				                                              AND   password_pelanggan = '$password'");
			//Menghitung data(akun)
			$data = $query->num_rows;
			//Jika akun ada yang cocok
			if($data == 1){
				$akun = $query->fetch_assoc(); 
				$_SESSION['pelanggan'] = $akun;
				echo "<script>alert('Anda berhasil login!');</script>";
				echo "<script>location='index.php';</script>";
			}
			//Jika akun tidak ada yang cocok
			else{
				echo "<script>alert('Anda gagal login, silahkan mencoba kembali!');</script>";
				echo "<script>location='login.php';</script>";
			}
		}
	?>
</body>
</html>