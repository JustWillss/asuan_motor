<?php
require "../config/connection.php";

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Kategori</title>
    </head>
    <body>
        <?php require "navbar.php"; ?>
        <div class="container mt-5">
        <div class="my-5 col-12 col-md-6">
                    <h3>Asuan Motor | Tambah Kategori</h3>
                    <form action="" method="post">
                        <div>
                            <label for="kategori">Kategori</label>
                            <input
                                type="text"
                                id="kategori"
                                name="kategori"
                                placeholder="input nama kategori"
                                class="form-control">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" type="submit" name="simpan_kategori"><i class="fas fa-save"></i> Simpan</button>
                                        <a href="kategori.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                                    </div>
                    </form>

                    <?php
                    if(isset($_POST['simpan_kategori'])){
                        $kategori = htmlspecialchars($_POST['kategori']);

                        $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");
                        $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                        if ($jumlahDataKategoriBaru > 0){
                            ?>
                    <div class="alert alert-warning mt-3" role="alert">Kategori Sudah Ada</div>
                <?php
                        }
                        else{
                            $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                            if($querySimpan){
                                ?>
                                <meta http-equiv="refresh" content="0; url=kategori.php"/>
                                <?php
                            }
                            else {
                                echo mysqli_error($conn);
                            }
                        }
                    }
                    ?>
                </div>
                <script src="../fontawesome/all.min.js"></script>
                </body>
                </html>