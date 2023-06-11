<?php
require "config/connection.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukLain = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
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
        <title>Asuan Motor | Detail</title>
    </head>
    <body>
        <?php require "navbar.php"?>

        <!-- Detail Produk -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-4 img-fluid">
                        <img src="images/<?php echo $produk['foto']; ?>" class="w-100 img-thumbnail produk-lain" alt="Gambar <?php echo $produk['nama']; ?>">
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <h1><?php echo $produk['nama']; ?></h1>
                        <p class="fs-5"><?php echo $produk['detail']; ?></p>
                        <p class="text-harga">Rp <?php
                                    $harga = $produk['harga'];
                                    $harga_format = number_format($harga, 0, ',', '.');
                                    echo $harga_format; ?></p>
                        <p class="fs-5">Stock :
                            <strong><?php echo $produk['stock']; ?></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produk yg sama -->
        <div class="container-fluid py-5">
            <div class="container">
                <h2 class="text-center">Produk Terkait</h2>

                <div class="row">
                    <?php while($data=mysqli_fetch_array($queryProdukLain)) { ?>
                    <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                           <img src="images/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-lain" alt="">
                        </a>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>

        <?php require "footer.php"; ?>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="fontawesome/all.min.js"></script>
    </body>
</html>