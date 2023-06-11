<?php
require "config/connection.php";
$queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
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
        <title>Asuan Motor | Home</title>
    </head>
    <body>
        <?php require "navbar.php"; ?>

        <!-- banner -->
        <div class="container-fluid banner d-flex align-items-center">
            <div class="container text-center text-white">
                <h1>Asuan Motor</h1>
                <h3>What Do You Need?</h3>
                <div class="col-md-8 offset-md-2">
                    <form method="get" action="produk.php">
                        <div class="input-group input my-4">
                            <input
                                type="text"
                                class="form-control"
                                aria-label="Nama Barang"
                                aria-describedby="basic-addon2"
                                name="keyword"
                                placeholder="Name Product">
                            <button type="submit" class="btn warna1">Find Out</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kategori -->
        <div class="container-fluid py-5">
            <div class="container text-center">
                <h3>Popular Categories</h3>

                <div class="row mt-5">
                    <div class="col-md-4 mb-3">
                        <div
                            class="box-kategori kat-oli d-flex justify-content-center align-items-center">
                            <h4 class="">
                                <a href="produk.php?kategori=Oli Mesin">A</a>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div
                            class="box-kategori kat-banluar d-flex justify-content-center align-items-center">
                            <h4 class="">
                                <a href="produk.php?kategori=Ban Luar">B</a>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div
                            class="box-kategori kat-bandalam d-flex justify-content-center align-items-center">
                            <h4 class="">
                                <a href="produk.php?kategori=Ban Dalam">C</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- produk -->
        <div class="container-fluid py-5">
            <div class="container text-center">
                <h3>Our Product</h3>

                <div class="row mt-5">
                    <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box img-thumbnail produk-lain">
                            <img src="images/<?php echo $data['foto']; ?>" class="card-img-top" alt="">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['nama']; ?></h5>
                                <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                <p class="card-text card-harga">Rp <?php
                                    $harga = $data['harga'];
                                    $harga_format = number_format($harga, 0, ',', '.');
                                    echo $harga_format; ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <a class="btn btn-outline-primary mt-3" href="produk.php">See More</a>
            </div>
        </div>

        <!-- footer -->
        <?php require "footer.php"; ?>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="fontawesome/all.min.js"></script>
    </body>
</html>