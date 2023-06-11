<?php
 require "config/connection.php";

 $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// Cari produk dengan nama produk/keyword
if(isset($_GET['keyword'])){
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}
// Cari produk dengan kategori
else if(isset($_GET['kategori'])){
    $querygetKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($querygetKategoriId);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}
// Cari produk dengan default
else{
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styleuser1.css">
        <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
        <link rel="website icon" type="png" href="foto/icon.png">
        <title>Asuan Motor | Produk</title>
    </head>
    <body>
        <?php require "navbar.php"?>

        <!-- banner -->
        <div class="container-fluid banner-produk d-flex align-items-center">
            <div class="container">
                <h1 class="text-white text-center">Produk</h1>
            </div>
        </div>

        <!-- Body -->
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3 mb-5">
                    <h3>Kategori</h3>
                    <ul class="list-group">
                        <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                        <a href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                        <?php
                }
                ?>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <h3 class="text-center mb-3">Produk</h3>
                    <div class="row">
                        <?php
if($countData < 1) {
    ?>
                        <h4 class="text-center my-5">Tidak Ada Produk.</h4>
                        <?php
}
                        ?>
                        <?php while($produk = mysqli_fetch_array($queryProduk)){ ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="image-box">
                                    <img src="images/<?php echo $produk['foto']; ?>" class="card-img-top" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                                    <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                                    <p class="card-text card-harga">Rp <?php
                                    $harga = $produk['harga'];
                                    $harga_format = number_format($harga, 0, ',', '.');
                                    echo $harga_format; ?></p>
                                    <a
                                        href="produk-detail.php?nama=<?php echo $produk['nama']; ?>"
                                        class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php require "footer.php"; ?>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="fontawesome/all.min.js"></script>
    </body>
</html>