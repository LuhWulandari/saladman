<h2>Data Kategori</h2>
<hr>
<?php
    $semuadata  = array();
    $query      = $koneksi->query("SELECT * FROM kategori");
    while($data = $query->fetch_assoc())
    {
        $semuadata[] = $data;
    }
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($semuadata as $key =>$value): ?>
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $value["nama_kategori"] ?></td>
                <td>
                    <a href="index.php?halaman=ubah-kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                    <a href="index.php?halaman=hapus-kategori&id=<?php echo $value['id_kategori']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<a href="index.php?halaman=tambah-kategori" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
