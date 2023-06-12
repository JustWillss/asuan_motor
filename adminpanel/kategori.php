<?php
session_start();
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
        <link rel="stylesheet" href="../css/styleadmin2.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Asuan Motor | Kategori</title>
    </head>
    <body>
        <?php require "navbar.php"; ?>
        <div class="container mt-5">
                <td>
                                        <a href="kategori_tambah.php" class="btn btn-primary"><i class=" fas fa-plus"></i> Tambah</a>
                                    </td>
                <div class="mt-3">
                    <h2>List Kategori</h2>

                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($jumlahkategori==0){
                                    ?>
                                <tr>
                                    <td colspan="3" class="text-center">Data Kategori Tidak Tersedia</td>
                                </tr>
                            <?php
                                }
                                else{
                                    $jumlah = 1;
                                    while($data=mysqli_fetch_array($querykategori)){
                                        ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>
                                        <a href="kategori_detail.php?nama=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i></a>
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