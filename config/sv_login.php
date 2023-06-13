<?php
session_start();
include "connection.php";

$username = $_POST['username'];
$password = md5($_POST['password']);//untuk hashing
var_dump($password);

$sql = "SELECT * from users where username='$username' and password='$password'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query); // mengambil jumlah data yang muncul
$result = mysqli_fetch_array($query); //mengambil array data

if ($num > 0) {
?>
    <script>
        location.href = "../adminpanel/home.php";
    </script>
<?php
}else{
    ?>
    <script>
    alert("Username atau password salah!");
    location.href = "../adminpanel/index.php";
</script>
<?php
}
?>