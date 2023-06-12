<?php
session_start();
require "../config/connection.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
        <title>Asuan Motor | Produk</title>
    </head>
    <body>
        <?php require "navbar.php"; ?>
        <div class="container mt-5">

            <!-- Untuk Tambah Produk -->
            <td>
            <a href="produk_tambah.php" class="btn btn-primary"><i class=" fas fa-plus"></i> Tambah</a>
                                </td>
            <div class="mt-3 mb-5">
                <h2>List Produk</h2>
                <div class="table table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($jumlahProduk==0){
                                    ?>
                            <tr>
                                <td colspan="6" class="text-center">Data Produk Tidak Tersedia</td>
                            </tr>
                        <?php
                            }
                            else {
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($query)){
                                    ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td>Rp <?php
                                    $harga = $data['harga'];
                                    $harga_format = number_format($harga, 0, ',', '.');
                                    echo $harga_format; ?></td>
                                
                                <td><?php echo $data['stock']; ?></td>
                                <td>
                                    <a href="produk_detail.php?nama=<?php echo $data['id']; ?>" class="btn btn-info">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                    $jumlah++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../fontawesome/all.min.js"></script>
    </body>
</html>