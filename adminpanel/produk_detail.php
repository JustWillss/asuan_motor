<?php
session_start();
require "../config/connection.php";

$id = $_GET['nama'];

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styleadmin2.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Asuan Motor | Produk Detail</title>
    </head>
    <body>
        <?php require "navbar.php"; ?>

        <div class="container mt-5">
            <h2>Detail Produk</h2>

            <div class="col-12 col-md-6 mb-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama">Nama</label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="<?php echo $data['nama']; ?>"
                            class="form-control"
                            autocoplete="off"
                            placeholder="Nama Produk"
                            required="required">
                    </div>
                    <div>
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required="required">
                            <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                            <?php
                            while($dataKategori=mysqli_fetch_array($queryKategori)) {
                                ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input
                            type="number"
                            class="form-control"
                            value="<?php echo $data['harga']; ?>"
                            name="harga"
                            placeholder="(Contoh: 15000)"
                            required="required">
                    </div>
                    <div>
                        <label for="currentFoto">Foto Produk Sekarang</label>
                        <img src="../images/<?php echo $data['foto']; ?>" alt="" width="300px">
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                            <?php echo $data['detail']; ?></textarea>
                    </div>
                    <div>
                        <label for="stock">Stock</label>
                        <select name="stock" id="stock" class="form-control">
                            <option value="<?php echo $data['stock']; ?>"><?php echo $data['stock']; ?></option>
                            <?php
                            if($data['stock']=='Tersedia'){
                                ?>
                            <option value="habis">Habis</option>
                        <?php
                            }
                            else{
                                ?>
                            <option value="tersedia">Tersedia</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                    </div>
                </form>
                <?php
            if(isset($_POST['simpan'])){
                $nama = htmlspecialchars ($_POST['nama']);
                $kategori = htmlspecialchars ($_POST['kategori']);
                $harga = htmlspecialchars ($_POST['harga']);
                $detail = htmlspecialchars ($_POST['detail']);
                $stock = htmlspecialchars ($_POST['stock']);

                //Untuk foto
                $target = "../images/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target . $nama_file;
                $image_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $name_new = $random_name .".". $image_file;

                if($nama=='' || $kategori=='' || $harga==''){
                    ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama, Kategori, dan Harga wajib diisi.
                </div>
            <?php
                }
                else{
                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', stock='$stock' WHERE id=$id");
                    ?>
                    <meta http-equiv="refresh" content="0; url=produk.php"/>
                    <?php
                    if($nama_file!=''){
                        if($image_size > 500000) {
                            ?>
                <div class="alert alert-warning mt-3" role="alert">
                    File tidak boleh lebih dari 500 Kb.
                </div>
            <?php
                        }
                        else{
                            if($image_file != 'jpg' && $image_file != 'png' && $image_file != 'gif'){
                                ?>
                <div class="alert alert-warning mt-3" role="alert">
                    File wajib (.jpg .png atau .gif)
                </div>
                <?php
                            }
                            else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target . $name_new);

                                $queryUpdate = mysqli_query($conn, "UPDATE produk SET foto='$name_new' WHERE id='$id'");

                                if($queryUpdate){
                                    ?>
                <meta http-equiv="refresh" content="0; url=produk.php"/>
            <?php
                                }
                                else{
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }

            if(isset($_POST['hapus'])){
                $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

                if($queryHapus){
                    ?>
                    <meta http-equiv="refresh" content="0; url=produk.php"/>
                    <?php
                }
            }
            ?>
            </div>
        </div>

        <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>
