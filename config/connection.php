<?php
    $user = "n1566458_asuan_motor";
    $server = "localhost";
    $password = "ED2XbfWTvFdZ";
    $db = "n1566458_asuan_motor";

    $conn = mysqli_connect($server, $user, $password, $db);
    if(!$conn) {
        die("gagal koneksi ke database");

        // echo "koneksi kedatabase berhasil";

        //mysqli_close($conn);
    }

?>