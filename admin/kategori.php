<h2> Data Kategori </h2>
<hr>

<?php
$semuadata=array();
$query=$koneksi->query("SELECT * FROM kategori");
while($data = $query->fetch_assoc())
{
    $semuadata[]=$data;
}
//echo"<pre>";
//print_r($semuadata);
//echo"</pre>";
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th> No </th>
            <th> Kategori </th>
            <th> Aksi </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($semuadata as $key =>$value): ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $value["nama_kategori"] ?></td>
            <td>
                <a href="" class="btn btn-warning btn-sm">Ubah</a>
                <a href="" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<a href="" class="btn btn-default">Tambah Data</a>