<?php 
include "connection.php";

$username = $_POST['username'];
$fullname = $_POST['fullname'];
$password = md5($_POST['password']);

$sql_check = "select * from users where username='$username'";
$query_check = mysqli_query($conn,$sql_check) or die();
$num_check = mysqli_num_rows($query_check);

if($num_check == 0){
    $sql = "insert into users (username,fullname,password) values ('$username','$fullname','$password')";
    $query = mysqli_query($conn, $sql);
    // $result = mysqli_fetch_array($query);
?>
    <script>
        alert("data berhasil diregistrasi");
        location.href = "../adminpanel/index.php";
    </script>
<?php 
}else{
 ?>
 <script>
    alert("username sudah ada");
    location.href = "../adminpanel/register.php";
 </script>
<?php
 }
?>
