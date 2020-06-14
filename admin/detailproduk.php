<?php 
$id_produk = $_GET["id"];
$query	= $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk='$id_produk'");
$detailproduk = $query->fetch_assoc();

$fotoproduk = array();
$queryfoto	= $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while($tiap = $queryfoto->fetch_assoc())
{
    $fotoproduk[] = $tiap;
}

echo"<pre>";
//print_r($detailproduk);
print_r($fotoproduk);
echo"</pre>";
?>

<table class="table">
    <tr>
        <th> Kategori </th>
        <td><?php echo $detailproduk["nama_kategori"];?></td>
    </tr>
    <tr>
        <th> Produk </th>
        <td><?php echo $detailproduk["nama_produk"];?></td>
    </tr>
    <tr>
        <th> Harga </th>
        <td>Rp. <?php echo number_format($detailproduk["harga_produk"]);?></td>
    </tr>
    <tr>
        <th> Berat </th>
        <td><?php echo $detailproduk["berat_produk"];?></td>
    </tr>
    <tr>
        <th> Deskripsi </th>
        <td><?php echo $detailproduk["deskripsi_produk"];?></td>
    </tr>
    <tr>
        <th> Stok </th>
        <td><?php echo $detailproduk["stok_produk"];?></td>
    </tr>
</table>

<div class="row">
    <?php foreach ($fotoproduk as $key => $value): ?>
    
    <div class="col-md-3 text-center">
        <img src="../foto_produk/<?php echo $value["nama_produk_foto"] ?>" alt="" class="img-responsive"><br>
        <a href="index.php?halaman=hapusfotoproduk&idfoto=<?php echo $value["id_foto_produk"] ?>&idproduk=<?php echo $value["id_produk"] ?> " class="btn btn-danger btn-sm">Hapus</a>
    </div>
    <?php endforeach ?>
</div>

<form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label> File Foto </label>
            <input type="file" name="produk_foto">
        </div>
        <button class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
</form>

<?php 
if(isset($_POST["simpan"]))
{
    $lokasifoto = $_FILES["produk_foto"]["tmp_name"];
    $namafoto = $_FILES["produk_foto"]["name"];

   $namafoto =  date("YmdHis").$namafoto;

   //upload
   move_uploaded_file($lokasifoto,"../foto_produk/".$namafoto);

   $koneksi->query("INSERT INTO produk_foto(id_produk,nama_produk_foto) VALUES('$id_produk','$namafoto') ");

    echo "<script>alert('Foto Produk berhasil tersimpan!');</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";
}
?>





