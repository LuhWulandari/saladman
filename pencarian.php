<?php
    include 'koneksi.php';
    $keyword = $_GET["keyword"];

    $semuadata  = array();
    $query      = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
    OR deskripsi_produk LIKE '%$keyword%' ORDER BY nama_produk ASC");
    while($data = $query->fetch_assoc())
    {
        $semuadata[] = $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Saladman | List Produk</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <h1 class="my-4">Jenis Produk</h1>
                    <div class="list-group">
                        <?php
                            $query_kategori = $koneksi->query("SELECT * FROM kategori ORDER BY nama_kategori ASC");
                            while($kategori = $query_kategori->fetch_assoc()){
                        ?>
                        <a href="#" class="list-group-item"><?php echo $kategori['nama_kategori']; ?></a>
                    <?php } ?>
                    </div>
                </div>

                <div class="col-lg-9">
                    <!-- Carousel Slide -->
                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                      <!-- <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a> -->
                    </div>

                    <!-- List Product -->
                    <h3>Hasil Pencarian : <?php echo $keyword ?></h3>
                    <?php if (empty($semuadata)): ?>
                        <div class="alert alert-danger"> Produk <strong><?php echo $keyword ?></strong> Tidak Ditemukan</div>
                    <?php endif ?>
                    <div class="row">
                        <?php foreach ($semuadata as $key => $value): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                              <a href="#"><img class="card-img-top" src="foto_produk/<?php echo $value["foto_produk"] ?>" alt=""></a>
                              <div class="card-body">
                                <h4 class="card-title">
                                  <a href="#"><?php echo $value['nama_produk']; ?></a>
                                </h4>
                                <h5>Rp. <?php echo number_format($value['harga_produk']); ?> ,-</h5>
                              </div>
                              <div class="card-footer">
                                <a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary" role="button">Beli</a>
                              </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <?php include 'footer.php'; ?>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>