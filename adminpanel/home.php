<?php
session_start();
require "../config/connection.php";

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);

$queryproduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);

if(!isset($_SESSION['login'])){
	header("location:index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styleadmin2.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Asuan Motor | Home</title>

    </head>
    <body>
        <?php require "navbar.php"; ?>
        <div class="container mt-5">
            <h2>Home Page</h2>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="sum-kategori p-3">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-align-justify fa-7x text-red-50"></i>
                                </div>
                                <div class="col-6 text-black">
                                    <h3 class="fs-2">Kategori</h3>
                                    <p class="fs-4"><?php echo $jumlahkategori; ?>
                                        Kategori</p>
                                    <p>
                                        <a href="kategori.php" class="text-black decoration">Lihat Detail</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="sum-produk p-3">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-box fa-7x text-red-50"></i>
                                </div>
                                <div class="col-6">
                                    <h3 class="fs-2 warna1">Produk</h3>
                                    <p class="fs-4 warna1"><?php echo $jumlahproduk; ?>
                                        Produk</p>
                                    <p>
                                        <a href="produk.php" class="text-black decoration">Lihat Detail</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../fontawesome/all.min.js"></script>
    </body>
</html>