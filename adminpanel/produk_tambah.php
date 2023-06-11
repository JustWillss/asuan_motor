<?php
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
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="website icon" type="png" href="../foto/icon.png">
        <title>Asuan Motor | Tambah Produk</title>
    </head>

    <body>
        <?php require "navbar.php"; ?>
        <div class="container my-5 col-12 col-md-6">
            <h3>Tambah Produk</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        autocoplete="off"
                        placeholder="Nama Produk"
                        required="required">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required="required">
                        <option value="">Pilih Kategori</option>
                        <?php
                            while($data=mysqli_fetch_array($queryKategori)) {
                                ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="(Contoh: 15000)" required="required">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="stock">Stock</label>
                    <select name="stock" id="stock" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan</button>
                    <a href="produk.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        if($nama_file!=='') {
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
                                }
                            }
                        }
                        // Insert
                        $queryTambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, stock) VALUES ('$kategori', '$nama', '$harga', '$name_new', '$detail', '$stock')");

                        if($queryTambah){
                            ?>
            <meta http-equiv="refresh" content="0; url=produk.php"/>
        <?php
                        }
                        else {
                            echo mysqli_error($conn);
                        }
                    }
                }
                ?>
        </div><script src="../fontawesome/all.min.js"></script>
            </body>
            </html>