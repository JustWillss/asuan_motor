<?php
session_start();
require "../config/connection.php";

$id = $_GET['nama'];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Asuan Motor | Detail Kategori</title>
    </head>
    <body>
        <?php require "navbar.php"; ?>

        <div class="container mt-5">
            <h2>Detail Kategori</h2>
            <div class="col-12 col-md-6">
                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input
                            type="text"
                            name="kategori"
                            id="kategori"
                            class="form-control"
                            value="<?php echo $data['nama']; ?>">
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                        <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                    </div>
                </form>

                <?php
                if(isset($_POST['editBtn'])){
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if($data['nama']==$kategori){
                        ?>
                <meta http-equiv="refresh" content="0; url=kategori.php"/>
                <?php
                    }
                    else{
                        $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahdata = mysqli_num_rows($query);

                        if($jumlahdata > 0){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">Kategori Sudah Ada</div>
                            <?php
                        }
                        else{
                            $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
                            if($querySimpan){
                                ?>
                                <meta http-equiv="refresh" content="0; url=kategori.php"/>
                                <?php
                            }
                            else{
                                echo mysqli_error($conn);
                            }
                        }
                    }
                }

                if(isset($_POST['deleteBtn'])){
                    $queryCheck = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);
                    
                    if($dataCount>0){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">Kategori Tidak Bisa Dihapus</div>
                        <?php
                        die();
                    }

                    $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");

                    if($queryDelete){
                        ?>
                        <meta http-equiv="refresh" content="0; url=kategori.php"/>
                        <?php
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
                ?>
            </div>
        </div>

        <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>